<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt");

?>
<table class="og-table og-small-table">
    <thead>
        <tr>
            <th>
                Configuration
            </th>
            <th>
                Valeur
            </th>
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