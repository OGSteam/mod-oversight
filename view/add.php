<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt");
global $data;
$px = 100;

?>
<link href="<?php echo $data['cssfile']; ?>" rel="stylesheet" type="text/css" media="all">

<h2> AJOUT</h2>

<br/>
<table>
    <thead>
    <tr>
        <!-- version utletieur ...
        <th class="c">
            Filtre Nom:
        </th>
        <td width="<?php echo $px; ?>px" class="c Filtre_name">
        <input type="text" id="Filtre_name" class="targetName"/>

        </td>
        -->
        <th class="c">
            Filtre Status:
        </th>
        <?php foreach ($data["playerStatus"] as $sStatus) : ?>
            <td width="<?php echo $px; ?>px" class="c Filtre_status" data-status="status_<?php echo strtolower($sStatus); ?>">
                <?php echo $sStatus; ?>
            </td>
        <?php endforeach; ?>
    </tr>
    </thead>
</table>
<table class="findingplayer">
    <thead>
    <form action="#"" method="post">
    <tr>
            <td class="c">
                Recherche :
            </td>
            <td>
                Nom
            </td>
            <td>
                <input type="text" value="<?php echo $data["lastfind"]; ?>" name="findplayer" />
            </td>
            <td>
                <p><input type="submit" value="Rechercher"></p>
            </td>
        </tr>
    </form>
    </thead>
</table>

<br/>
<table>
    <thead>
    <tr>
        <th>
            Nom
        </th>
        <th>
            status
        </th>
        <th>

        </th>
    </tr>
    </thead>
    <?php foreach ($data["players"] as $player) : ?>

        <tr class="id_player_<?php echo $player["id_player"]; ?> status_<?php echo strtolower($player["status"]); ?>">
            <td class="c">
                <?php echo $player["name_player"]; ?>
            </td>
            <td class="c">
                <?php echo $player["status"]; ?>
            </td>
            <td class="c">
                <?php if (in_array($player["id_player"], $data["mySurveillance"])) : ?>
                    -
                <?php else : ?>

                    <a href="index.php?action=oversight&page=add&id=<?php echo $player["id_player"] ?>">Mise en
                        Surveillance</a>
                <?php endif; ?>
            </td>
        </tr>

    <?php endforeach; ?>


</table>

