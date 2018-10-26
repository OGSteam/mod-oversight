<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt");
global $data;
$px=100;
?>

<h2> AJOUT</h2>

<form action="/index.php?action=oversight" id="add">
    <select name="selectPlayer">
        <?php foreach ($data["players"] as $player) : ?>
            <option value="<?php echo $player["id_player"]; ?>">
                <?php echo $player["name_player"]; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <input type="submit">
</form>
<br />
<table>
    <thead>
    <tr>
        <th class="c">
            Filtre :
        </th>
        <td  width="<?php echo $px;?>px" class="c Filtre_status" data-status="status_">
            None
        </td>
        <td  width="<?php echo $px;?>px" class="c Filtre_status" data-status="status_a">
            a
        </td>
        <td  width="<?php echo $px;?>px" class="c Filtre_status" data-status="status_I">
            I
        </th>
        <td  width="<?php echo $px;?>px" class="c Filtre_status" data-status="status_v">
            v
        </th>
        <td  width="<?php echo $px;?>px" class="c Filtre_status" data-status="status_vI">
            vI
        </th>
        <td  width="<?php echo $px;?>px" class="c Filtre_status" data-status="status_vIb">
            vIb
        </th>
        <td  width="<?php echo $px;?>px" class="c Filtre_status" data-status="status_b">
            b
        </th>
    </tr>
    </thead>
</table>

<br />
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
        <tr class="id_player_<?php echo $player["id_player"]; ?> status_<?php echo $player["status"]; ?>">
            <td class="c">
                <?php echo $player["name_player"]; ?>
            </td>
            <td class="c">
                <?php echo $player["status"]; ?>
            </td>
            <td class="c">
                <a>Mise en Surveillance</a>
            </td>
        </tr>

    <?php endforeach; ?>


</table>

