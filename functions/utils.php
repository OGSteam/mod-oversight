<?php
if (!defined('IN_SPYOGAME')) die("Hacking Attemp!");

function superapixinstalled()
{
    global $db;
    $result = $db->sql_query("SELECT `id` FROM `" . TABLE_MOD . "` WHERE `action`='superapix' AND `active`='1' LIMIT 1");
    if ($db->sql_numrows($result) == 0) {
        return false;
    } else {
        return true;
    }
}

/// arrondir le timestamp (900 => 15 * 60 secondes )
function roundtimestamp($value, $round = 900)
{
    $retour = floor($value / $round) * $round;
    return $retour;
}

function weekdaylist()
{
    $retour = array();
    $retour[-1] = 'Auncun';

    $retour[0] = 'Lundi';
    $retour[1] = 'Mardi';
    $retour[2] = 'Mercredi';
    $retour[3] = 'Jeudi';
    $retour[4] = 'Vendredi';
    $retour[5] = 'Samedi';
    $retour[6] = 'Dimanche';

    return $retour;
}


function myFormatTime($timestamp)
{
    if ($timestamp == -1) {
        return "";
    }
    return date("Y-m-d H:i:s", $timestamp);

}

function myFormatTimeQuick($timestamp)
{
    if ($timestamp == -1) {
        return "";
    }
    setlocale(LC_ALL, 'fr_FR.UTF-8');//utf8

    return strftime("%A %d %B %Y", $timestamp);


}

function myFormatTimeGetHours($timestamp)
{
    if ($timestamp == -1) {
        return "";
    }
    return date("H", $timestamp);

}

function myFormatTimeGetMS($timestamp)
{
    if ($timestamp == -1) {
        return "";
    }
    return date("i:s", $timestamp);

}

function myFormatPActiviy($value)
{
    if ($value == -1) {
        return "";
    }
    return $value;

}

function formatMyInsert($tInsert, $tCoord)
{
    $retour = array();
    $arrayTab = array("P" => -1, "M" => -1, "cdr" => '');
    foreach ($tInsert as $insert) {

        if (!isset($retour[$insert["p_activiy"]])) {
            $retour[$insert["p_activiy"]][$insert["coord"]] = $arrayTab;
        }
        if (!isset($retour[$insert["m_activiy"]])) {
            $retour[$insert["m_activiy"]][$insert["coord"]] = $arrayTab;
        }
        if (!isset($retour[$insert["datatime"]])) {
            $retour[$insert["datatime"]][$insert["coord"]] = $arrayTab;
        }


        if ($insert["m_activiy_value"] >= 0) {
            $retour[$insert["m_activiy"]][$insert["coord"]]["M"] = 1;
        }
        if ($insert["p_activiy_value"] >= 0) {
            $retour[$insert["p_activiy"]][$insert["coord"]]["P"] = 1;
        }
        if ($insert["datatime"] >= 0) {
            $retour[$insert["datatime"]][$insert["coord"]]["cdr"] = $insert["cdr"];
        }

        //$retour[$insert["m_activiy"]][$insert["coord"]]["M"]=1;
        //$retour[$insert["p_activiy"]][$insert["coord"]]["P"]=1;
        //$retour[$insert["datatime"]][$insert["coord"]]["cdr"]=$insert["cdr"]; ///récuperer sur le timestamp et pas l'insertion ....


    }

    return $retour;
}

function getAnalyseHTMLTable( $tmstampToday, $tCoord, $tInsert)
{

    $HTMLReturn = "";
    ob_start(); //capture
    $CoordCount = count($tCoord);
    $tmstampTomorrow = $tmstampToday + 86400;

    setlocale(LC_ALL, 'fr_FR.UTF-8');//utf8

    $tmstampTodaystr = strftime("%A %d %B", $tmstampToday);
    $step = 15 * 60;
    $totalcdr='';
    $totalpresence='';
    ?>


    <thead>
    <tr>
        <td colspan="<?php echo 3 + 3 + ($CoordCount * 3); ?>" class="fullDate">
            <?php echo myFormatTimeQuick($tmstampToday); ?>
        </td>
    </tr>
    <tr class="tdhead">
        <td>
            coordonnées
        </td>
        <td>
            heure
        </td>
        <td>
            Tranche
        </td>
        <?php foreach ($tCoord as $coord) : ?>
            <td colspan="3">
                <?php echo $coord; ?>
            </td>
        <?php endforeach; ?>
        <td colspan="3">

            Total
        </td>

    </tr>

    <tr class="tdhead">
        <td>
            Type
        </td>
        <td>

        </td>
        <td>

        </td>
        <?php foreach ($tCoord as $coord) : ?>
            <td>
                P
            </td>
            <td>
                L
            </td>
            <td>
                CDR
            </td>
        <?php endforeach; ?>
        <td>
           Présence
        </td>
        <td>
           CDR
        </td>
    </tr>

    </thead>
    <tbody>
    <?php for ($i = $tmstampToday; $i <= $tmstampTomorrow - 1; $i = $i + $step) : ?>
            <?php if (isset($tInsert[$i])) : ?>

            <?php $totalcdr='';?>
            <?php $totalpresence='';?>
            <tr>
                <td>
                    <?php echo $tmstampTodaystr ?>
                </td>
                <td class="tdtime">
                    <?php echo myFormatTimeGetHours($i); ?>
                </td>
                <td  class="tdtime">
                    <?php echo myFormatTimeGetMS($i); ?>
                </td>
                <?php foreach ($tCoord as $coord) : ?>

                    <?php $tInsert[$i][$coord]["P"]    = (isset($tInsert[$i][$coord]["P"]))       ? $tInsert[$i][$coord]["P"]     : "";?>
                    <td  class="tdinfo value<?php echo $tInsert[$i][$coord]["P"]; ?>">
                        <?php echo $tInsert[$i][$coord]["P"]; ?>
                       <?php $totalpresence = ($tInsert[$i][$coord]["P"] == 1) ? 1 : $totalpresence;;?>

                    </td>
                    <?php $tInsert[$i][$coord]["M"]    = (isset($tInsert[$i][$coord]["M"]))       ? $tInsert[$i][$coord]["M"]     : "";?>
                    <td class="tdinfo value<?php echo $tInsert[$i][$coord]["M"]; ?>">
                        <?php echo $tInsert[$i][$coord]["M"]; ?>
                        <?php $totalpresence = ($tInsert[$i][$coord]["M"] == 1) ? 1 : $totalpresence;;?>

                    </td>
                    <?php $tInsert[$i][$coord]["cdr"]    = (isset($tInsert[$i][$coord]["cdr"]))       ? $tInsert[$i][$coord]["cdr"]     : "";?>
                    <td class="tdinfo tdcdr tdcdr_<?php echo $tInsert[$i][$coord]["cdr"]; ?>">
                        <?php echo $tInsert[$i][$coord]["cdr"]; ?>
                        <?php if (is_numeric($tInsert[$i][$coord]["cdr"])) : ?>
                            <?php $totalcdr=$tInsert[$i][$coord]["cdr"] + (int)$totalcdr;?>
                        <?php endif ; ?>
                    </td>
                <?php endforeach; ?>
                <td class="tdtotal<?php echo $totalpresence ; ?>">
                    <?php echo $totalpresence ; ?>
                </td>
                <td class="tdtotal">
                    <?php echo $totalcdr ; ?>
                </td>
            </tr>
        <?php endif; ?>

    <?php endfor; ?>


    </tbody>

    <?php
    $HTMLReturn = ob_get_contents();
    ob_end_clean();
    return $HTMLReturn;

}


function getDisctinctDAte($insterts)
{
    $tTmstampToday=array();
    foreach ($insterts as $element)
    {
        $tTmstampToday[strtotime(date("Y-m-d", $element["datatime"]), $element["datatime"])]=true;
        $tTmstampToday[strtotime(date("Y-m-d", $element["p_activiy"]), $element["p_activiy"])]=true;
        $tTmstampToday[strtotime(date("Y-m-d", $element["m_activiy"]), $element["m_activiy"])]=true;
    }
   return $tTmstampToday;
}