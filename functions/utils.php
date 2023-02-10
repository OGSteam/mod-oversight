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
    setlocale(LC_ALL, 'fr_FR.UTF-8'); //utf8

    return date("l d M Y", $timestamp);
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

function formatMyInsert($tInsert)
{
    //    print_r($tInsert);
    $retour = array();
    foreach ($tInsert as $insert) {
        $retour[$insert["datatime"]][$insert["coord"]]["M"] = $insert["m_activiy_value"];
        $retour[$insert["datatime"]][$insert["coord"]]["P"] = $insert["p_activiy_value"];
        $retour[$insert["datatime"]][$insert["coord"]]["cdr"] = $insert["cdr"] / 1000;
    }
    return $retour;
}

function getAnalyseHTMLTable($tmstampToday, $tCoord, $tInsert)
{

    ob_start(); //capture
    setlocale(LC_ALL, 'fr_FR.UTF-8'); //utf8

    $step = 15 * 60;
    $type =  array('P', 'M', 'cdr');
?>
    <tr>
        <th colspan="50" class="fullDate">
            <?php echo myFormatTimeQuick($tmstampToday); ?>
        </th>
    </tr>

    <tr class="tdhead">
        <th scope="col">
            coordonnées
        </th>
        <th scope="col">
            Type
        </th>
        <?php for ($i = 0; $i < 24; $i++) : ?>
            <th class="oversight-hour" scope="col">
                <?= $i . 'h'; ?>
            </th>
            <th class="oversight-hour" scope="col">
                <?= $i . 'h30'; ?>
            </th>
        <?php endfor; ?>
    </tr>


    <?php foreach ($tCoord as $coord) : ?>
        <?php foreach ($type as $elem) : ?>
            <tr>
                <?php if ($elem == 'P') : ?>
                    <th class="oversight-coord" scope="row" rowspan="3">
                        <?= $coord ?>
                    </th>
                <?php endif; ?>
                <th class="<?= $elem == 'cdr' ? 'oversight-cdr' : '' ?>" scope="row">
                    <?= $elem ?>
                </th>
                <?php for ($i = 0; $i < 48; $i++) : ?>
                    <?php
                    $dateArray = $tmstampToday + ($i * 2 * $step);
                    $dateArray2 = $tmstampToday + (($i * 2 + 1) * $step);
                    if (isset($tInsert[$dateArray2]))
                        $dateArray = $dateArray2;
                    $val = (isset($tInsert[$dateArray][$coord][$elem])) ? $tInsert[$dateArray][$coord][$elem] : "";
                    $class = "";
                    if ($val !== "")
                        $class = ($val == -1 ? "-no" : ($val == 0 ? "-yes" : "-timer"));
                    ?>
                    <?php if ($elem != "cdr") : ?>
                        <th class="tdinfo value<?php echo $class; ?>">
                            <?= $val ?>
                        </th>
                    <?php else : ?>
                        <th class="tdinfo tdcdr tdcdr_<?php echo $val; ?>">
                            <?= $val ?>
                        </th>
                    <?php endif; ?>
                <?php endfor; ?>
            </tr>
        <?php endforeach; ?>
    <?php endforeach ?>

<?php
    $HTMLReturn = ob_get_contents();
    ob_end_clean();
    return $HTMLReturn;
}


function getDisctinctDAte($insterts)
{
    $tTmstampToday = array();
    foreach ($insterts as $element) {
        $tTmstampToday[strtotime(date("Y-m-d", $element["datatime"]), $element["datatime"])] = true;
    }
    return $tTmstampToday;
}
