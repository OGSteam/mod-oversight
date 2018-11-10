<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt"); ?>
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

    <table>
        <thead>
        <tr>
            <th>
                coord
            </th>
            <th>
                datatime
            </th>
            <th>
                p_activiy_value
            </th>
            <th>
                p_activiy
            </th>
            <th>
                m_activiy_value
            </th>
            <th>
                m_activiy
            </th>
            <th>
                cdr
            </th>
            <th>
                sender_id
            </th>
            <th>
                player_id
            </th>
            <th>

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
                    <?php echo $insert["sender_id"]; ?>
                </td>
                <td class="c">
                    <?php echo $insert["player_id"]; ?>
                </td>
                <td class="c">

                </td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php

