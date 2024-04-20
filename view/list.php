<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt"); ?>
<h2> Liste des surveillances en cours</h2>

<table class="og-table og-little-table">
    <thead>
        <tr>
            <th>
                Joueur surveillé
            </th>
            <th>
                Membre de l'alliance surveillant
            </th>
            <!-- cf lien insert du menu
            <th>
                Liste
            </th>
            -->
            <th>
                Traitement
            </th>
            <th>

            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data["ListSurveillance"] as $key => $surveillance) : ?>
            <tr>
                <td>
                    <?php if (isset($data["players"][$key])) : ?>
                        <?php echo $data["players"][$key]["name_player"]; ?>
                    <?php else : ?>
                        Joueur Inconnu (Enore present ?)
                    <?php endif; ?>

                </td>
                <td>
                    <?php echo implode(", ", ($surveillance)); ?>
                </td>
                <!-- cf lien insert du menu
                <td>
                    <a href="index.php?action=oversight&page=insert&player_id=<?php echo $key; ?>">
                        Voir
                    </a>
                </td>
                -->
                <td>
                    <a class="og-button og-button-little " href="index.php?action=oversight&page=analyse&all&player_id=<?php echo $key; ?>">
                        Analyser
                    </a>
                </td>
                <td>
                    <a onclick="return confirm('Êtes-vous sûr de vouloir effectuer cette action?') ? window.location.href='index.php?action=oversight&page=list&remove&player_id=<?php echo $key; ?>' : false;" class="og-button og-button-little  og-button-danger" href="#">
                        Supprimer
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>