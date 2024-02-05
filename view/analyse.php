<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt");

setlocale(LC_TIME, "fr");

$tCoord = get_DisctinctCoord($data["player_id"]);
function sortCoo($a, $b)
{
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
<?php if (isset($data["messageDM"]) && $data["messageDM"] != "") : ?>
    <div class="og-msg og-msg-warning">
        <h3 class="og-title">Information</h3>
        <p class="og-content"><?php echo $data["messageDM"]; ?></p>
    </div>
<?php endif ?>
<form action="#" method="post">
    <table class="og-table og-little-table">
        <thead>
            <tr>
                <th colspan="2"> Enregistrer un DM :</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="tdstat">
                    Coord départ :
                </td>
                <td>
                    <input type="text" value="" name="coodepart" placeholder="x:xxx:xx">
                </td>
            </tr>
            <tr>
                <td class="tdstat">
                    Coord arrivée :
                </td>
                <td>
                    <input type="text" value="" name="cooarrivee" placeholder="x:xxx:xx">
                </td>
            </tr>
            <tr>
                <th colspan="2">
                    <input class="og-button" type="submit" value="Valider !">
                </th>
            </tr>
        </tbody>
    </table>
</form>

<form action="#" method="post">
    <table class="og-table og-little-table">
    <thead>
            <tr>
                <th colspan="2"> Rechercher</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="tdstat">
                    Nombre de jour à afficher :
                </td>
                <td>
                    <input type="text" value="<?php echo $data["nblastday"] ?>" name="nblastday">
                </td>
            </tr>
            <tr>
                <td class="tdstat">
                    Chercher un jour en particulier :
                </td>
                <td>
                    <select name="findday">
                        <?php foreach ($data["daylist"] as $index => $day) : ?>
                            <?php $selected = (($data["findday"] == $index) ? " selected" : ""); ?>
                            <option value="<?php echo $index; ?>" <?php echo $selected; ?>>
                                <?php echo $day; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th colspan="2">
                    <input class="og-button" type="submit" value="Rechercher !">
                </th>
            </tr>
        </tbody>
    </table>
</form>


<hr />

<table width="100%" class="oversight">
    <?php foreach ($DisctinctDAte as $key => $value) : ?>
        <?php echo getAnalyseHTMLTable($key, $tCoord, $tInsert); ?>
    <?php endforeach; ?>
    <?php //echo getAnalyseHTMLTable($tmstampToday, $tCoord, $tInsert); 
    ?>
</table>