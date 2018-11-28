<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt");
$playerId = 119354;

setlocale(LC_TIME, "fr");
$tmstamp = time();
$tmstampToday = strtotime(date("Y-m-d", $tmstamp), $tmstamp);
$tmstampTodaystr = strftime("%A %d %B", $tmstampToday);
$tmstampTomorrow = strtotime(date("Y-m-d", $tmstamp + 86400), $tmstamp);
$step = 15 * 60;

$tCoord = get_DisctinctCoord($playerId);
sort($tCoord);
$CoordCount = count($tCoord);
$insterts = getMyInsert($playerId);
$tInsert = formatMyInsert($insterts, $tCoord);
//$tInsert = (getMyInsert($playerId));
$DisctinctDAte = getDisctinctDAte($insterts);

?>
<h2> Joueur <?php echo $playerId; ?></h2>

<table width="100%">
    <?php foreach ($DisctinctDAte as $key => $value ) : ?>
        <?php echo getAnalyseHTMLTable($key, $tCoord, $tInsert); ?>
        <?php endforeach ; ?>
       <?php //echo getAnalyseHTMLTable($tmstampToday, $tCoord, $tInsert); ?>
</table>

