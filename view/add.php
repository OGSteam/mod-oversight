<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt");
global $data;
$px = 100;

?>
<link href="<?php echo $data['cssfile']; ?>" rel="stylesheet" type="text/css" media="all">

<h2> AJOUT</h2>

<br /> <!-- 
<table>
    <thead>
        <tr>
       version utletieur ...
        <th class="c">
            Filtre Nom:
        </th>
        <td width="<?php echo $px; ?>px" class="c Filtre_name">
        <input type="text" id="Filtre_name" class="targetName"/>

        </td>
        
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
</table>-->
<table class="og-table og-little-table">
    <thead>
        <tr>
            <th colspan="3">
                Recherche
            </th>
    </thead>
    <tbody>
        <form action="#" method="post">
            <tr>
                <td>
                    Nom
                </td>
                <td>
                    <input type="text" value="<?php echo $data["lastfind"]; ?>" name="findplayer" />
                </td>
                <td>
                    <input class="og-button" type="submit" value="Rechercher">
                </td>
            </tr>
        </form>
    </tbody>
</table>
<br />
<?php if (count($data["players"]) > 0) : ?>
<table class="og-table og-little-table">
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
    <tbody>
        <?php foreach ($data["players"] as $player) : ?>

            <tr class="id_player_<?php echo $player["id_player"]; ?>">
                <td class="tdstat">
                    <?php echo $player["name_player"]; ?>
                </td>
                <td class="tdcontent">
                    <?php $tstatus = str_split($player["status"]); ?>
                    <?php foreach ($tstatus as $status) : ?>
                        <span class="ogame-status-<?php echo $status; ?>">
                            <?php echo $status; ?>
                        </span>
                    <?php endforeach; ?>
                </td>
                <td class="c">
                    <?php if (in_array($player["id_player"], $data["mySurveillance"])) : ?>
                        <span class="og-warning">-</span>
                    <?php else : ?>
                        <a class="og-button og-button-little" href="index.php?action=oversight&page=add&id=<?php echo $player["id_player"] ?>">Mise en
                            Surveillance</a>
                    <?php endif; ?>
                </td>

            </tr>

        <?php endforeach; ?>
    </tbody>

</table>
<?php endif ;?>