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
    setlocale(LC_TIME, "fr");
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
    $arrayTab = array("P" => 0, "M" => 0, "cdr" => 0);
    foreach ($tInsert as $insert) {


        if (!isset($retour[$insert["p_activiy"]])) {
            $retour[$insert["p_activiy"]][$insert["coord"]] = $arrayTab;
        }
        if (!isset($retour[$insert["m_activiy"]])) {
            $retour[$insert["m_activiy"]][$insert["coord"]] = $arrayTab;
        }
        if (!isset($retour[$insert["datetime"]])) {
            $retour[$insert["datetime"]][$insert["coord"]] = $arrayTab;
        }

        if ($insert["m_activiy"] >= 0) {
            $retour[$insert["m_activiy"]][$insert["coord"]]["M"] = 1;
        }
        if ($insert["p_activiy"] >= 0) {
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
    $tmstampTodaystr = strftime("%A %d %B", $tmstampToday);
    $step = 15 * 60;
    ?>


    <thead>
    <tr>
        <th colspan="<?php echo 3 + 3 + ($CoordCount * 3); ?>">
            <?php echo myFormatTimeQuick($tmstampToday); ?>
        </th>
    </tr>
    <tr>
        <th>
            coordonnées
        </th>
        <th>
            heure
        </th>
        <th>
            Tranche
        </th>
        <?php foreach ($tCoord as $coord) : ?>
            <th colspan="3">
                <?php echo $coord; ?>
            </th>
        <?php endforeach; ?>
        <th colspan="3">

            Total
        </th>

    </tr>

    <tr>
        <th>
            Type
        </th>
        <th>

        </th>
        <th>

        </th>
        <?php foreach ($tCoord as $coord) : ?>
            <th>
                P
            </th>
            <th>
                L
            </th>
            <th>
                CDR
            </th>
        <?php endforeach; ?>
        <th>
            Total P
        </th>
        <th>
            Total L
        </th>
        <th>
            Total CDR
        </th>
    </tr>

    </thead>
    <tbody>
    <?php for ($i = $tmstampToday; $i <= $tmstampTomorrow - 1; $i = $i + $step) : ?>
        <?php if (isset($tInsert[$i])) : ?>
            <tr>
                <td>
                    <?php echo $tmstampTodaystr ?>
                </td>
                <td>
                    <?php echo myFormatTimeGetHours($i); ?>
                </td>
                <td>
                    <?php echo myFormatTimeGetMS($i); ?>
                </td>
                <?php foreach ($tCoord as $coord) : ?>
                    <th>

                        <?php echo $tInsert[$i][$coord]["P"]; ?>

                    </th>
                    <th>

                        <?php echo $tInsert[$i][$coord]["M"]; ?>

                    </th>
                    <th>
                        <?php echo $tInsert[$i][$coord]["cdr"]; ?>
                    </th>
                <?php endforeach; ?>
                <th>
                    Total 1
                </th>
                <th>
                    Total 2
                </th>
                <th>
                    Total 3
                </th>
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