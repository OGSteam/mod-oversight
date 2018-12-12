<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt");

?>
<h2> Configuration </h2>

<table width="100%">
    <thead>
    <tr>
        <td class="c_stats" width="25%">Configuration</td>
        <td class="c" width="25%">Valeur</td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th><a>Nombre d'utilisateur</a></th>
        <th><?php echo $data["total_sender"]; ?></th>
    </tr>
    <tr>
        <th><a>Nombre de joueur surveiller</a></th>
        <th><?php echo $data["total_player"]; ?></th>
    </tr>
    <tr>
        <th><a>Nombre de scanne </a></th>
        <th><?php echo $data["CountALLInsert"]; ?></th>
    </tr>
    <tr>
        <th><a>Entrées orphelines</a></th>
        <th><?php echo $data["total_orphan"]; ?></th>
    </tr>

    <tr>
        <th></th>
        <th><a href="index.php?action=oversight&page=stat&purge">Purger</a></th>
    </tr>
    </tbody>
</table>



