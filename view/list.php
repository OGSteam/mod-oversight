<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt");?>
<h2> Liste des surveillances en cours</h2>

<table>
    <thead>
    <tr>
        <th>
            Joueur surveillé
        </th>
        <th>
            Membre de l'alliance surveillant
        </th>
        <th>
            Exploitation
        </th>
        <th>
            Traitement
        </th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data["ListSurveillance"] as $key => $surveillance): ?>
        <tr>
            <td class="c">
                <?php  echo $data["players"][$key]["name_player"] ;?>
            </td>
            <td class="c">
                 <?php echo implode(", ",($surveillance)); ?>
            </td>
            <td class="c">
                <a href="index.php?action=oversight&page=insert&player_id=<?php echo $key; ?>">
                    Voir
                </a>
            </td>
            <td class="c">
                <a>
                    Gerer
                </a>
            </td>
        </tr>
    <?php endforeach ; ?>

    </tbody>
    </table>