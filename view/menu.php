<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt");
global $data;
?>
<table>
    <tbody>
    <tr align="center">
        <?php foreach ($data["menu"] as $key) : ?>
            <?php if ($data["menuactif"] == $key["url"]) : ?>
                <th>
                                            <?php echo $key["nom"]; ?></php>
                               </th>
            <?php else : ?>
                <td class="c">
                    <a href="index.php?action=oversight&page=<?php echo $key["url"]; ?>">
                        <?php echo $key["nom"]; ?></php>
                    </a>
                </td>
            <?php endif; ?>
        <?php endforeach; ?>
    </tr>
    </tbody>
</table>