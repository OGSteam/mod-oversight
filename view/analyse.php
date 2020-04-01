<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt");

setlocale(LC_TIME, "fr");

$tCoord = get_DisctinctCoord($data["player_id"]);
function sortCoo($a, $b) {
    $a = explode(":", $a);
    $b = explode(":", $b);
    for ($i = 0; $i < count($a); $i++) {
        if ($a[$i] != $b[$i])
            return ($a < $b) ? -1 : 1;
    }
    return 0;
}

usort($tCoord, "sortCoo");

$insterts = $data["insert"];
$tInsert = formatMyInsert($insterts);
$DisctinctDAte = getDisctinctDAte($insterts);

?>
<link href="<?php echo $data['cssfile']; ?>" rel="stylesheet" type="text/css" media="all">
<h2> Joueur <?php echo $data["players"][$data["player_id"]]["name_player"]; ?>
    <?php if (isset($pub_all)) : ?>
        <small>
            <a href="index.php?action=oversight&page=analyse&player_id=<?php echo $data["player_id"]; ?>">
                Mes Insertions seulement
            </a>
        </small>
    <?php else : ?>
        <small>
            <a href="index.php?action=oversight&page=analyse&all&player_id=<?php echo $data["player_id"]; ?>">
                Toutes les infos
            </a>
        </small>
    <?php endif; ?>
</h2>

<table class="">
    <span class="alertDM"><?= isset($data["messageDM"]) ? $data["messageDM"] : ""?></span>
    <form action="#"  method="post">
        <tr>
            <td class="c">
                Enregistrer un DM :
            </td>
            <th class="c">
                <label>Coord départ : </label>
                <input type="text" value="" name="coodepart" placeholder="x:xxx:xx">
            </th>
            <th class="c">
                <label>Coord arrivée : </label>
                <input type="text" value="" name="cooarrivee" placeholder="x:xxx:xx">
            </th>
            <th class="c">
                <input type="submit" value="Valider !">
            </th>
        </tr>
    </form>
</table>

<table class="">
    <form action="#"  method="post">
        <tr>
            <td class="c">
                Nombre de jour à afficher :
            </td>
            <th class="c">
                <input type="text" value="<?php echo $data["nblastday"]?>" name="nblastday">
            </th>
            <th class="c" rowspan="2">
                <input type="submit" value="Rechercher!">
            </th>
        </tr>
        <tr>
            <td class="c">
                Chercher un jour en particulier :
            </td>
            <th class="c">
                <select name="findday">
                    <?php foreach ($data["daylist"] as $index => $day ) : ?>
                        <option value="<?php echo $index ; ?>"
                            <?php if ($data["findday"]== $index) { echo " selected" ; }?>>
                            <?php echo $day ; ?>
                        </option>
                    <?php endforeach ; ?>
                </select>
            </th>
        </tr>
    </form>
</table>

<hr />


<table width="100%" class="oversight">
    <?php foreach ($DisctinctDAte as $key => $value) : ?>
        <?php echo getAnalyseHTMLTable($key, $tCoord, $tInsert); ?>
    <?php endforeach; ?>
    <?php //echo getAnalyseHTMLTable($tmstampToday, $tCoord, $tInsert); ?>
</table>

