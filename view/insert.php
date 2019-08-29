<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt"); ?>
    <?php if ($data["player_id"]!=null) : ?>
    <h2> Liste des insertions <?php echo $data["players"][$data["player_id"]]["name_player"]; ?>
        <?php if (isset($pub_all)) : ?>
            [<?php echo implode(", ",($data["ListSurveillance"][$data["player_id"]])); ?>]
            <small>
                <a href="index.php?action=oversight&page=insert&player_id=<?php echo $data["player_id"]; ?>">
                    Mes Insertions
                </a>
            </small>
        <?php else : ?>
            [<?php echo $user_data["user_name"]; ?>]
            <small>
                <a href="index.php?action=oversight&page=insert&all&player_id=<?php echo $data["player_id"]; ?>">
                    Insertions alliance
                </a>
            </small>
        <?php endif; ?>

    </h2>
    <?php else : ?>
    <h2>
        <?php if (isset($pub_all)) : ?>
            Toutes mes insertions
        <?php else : ?>
           Toutes les insertions de l'alliance
        <?php endif; ?>
    </h2>


    <?php endif; ?>

    <table>
        <thead>
        <tr>
            <th>
                coord
            </th>
            <th>
                Date
            </th>
            <th colspan="2">
                Activité Planete
            </th>
            <th colspan="2">
                Activité Lune
            </th>
            <th>
                cdr
            </th>
            <th>
                Envoyé par
            </th>
            <th colspan="2">
                Joueur
            </th>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($data["insert"] as $insert): ?>
            <tr>
                <td class="c">
                    <?php echo $insert["coord"]; ?>
                </td>
                <td class="c">
                    <?php echo myFormatTime($insert["datatime"]); ?>
                </td>
                <td class="c">
                    <?php echo myFormatPActiviy($insert["p_activiy_value"]); ?>
                </td>
                <td class="c">
                    <?php echo myFormatTime($insert["p_activiy"]); ?>
                </td>
                <td class="c">
                    <?php echo myFormatPActiviy($insert["m_activiy_value"]); ?>
                </td>
                <td class="c">
                    <?php echo myFormatTime($insert["m_activiy"]); ?>
                </td>
                <td class="c">
                    <?php echo $insert["cdr"]; ?>
                </td>
                <td class="c">
                    <?php echo $data["getListOgspyUsers"][$insert["sender_id"]]; ?>
                </td>
                <td class="c">
                    <?php echo $insert["player_id"]; ?>
                </td>
                <td class="c">
                    <?php echo $data["players"][$insert["player_id"]]["name_player"] ; ?>
                </td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php

