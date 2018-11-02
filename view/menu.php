<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt");
global $data;
$px=150;
?>
<table>
    <tbody>
    <tr align="center">
        <?php foreach ($data["menu"] as $key) : ?>
            <?php if ($data["menuactif"] == $key["url"]) : ?>
                <th width="<?php echo $px; ?>px" >
                    <?php echo $key["nom"]; ?>
                </th>
            <?php else : ?>
                <td class="c"  width="<?php echo $px; ?>px">
                    <a href="index.php?action=oversight&page=<?php echo $key["url"]; ?>">
                        <?php echo $key["nom"]; ?>
                    </a>
                </td>
            <?php endif; ?>
        <?php endforeach; ?>
    </tr>
    </tbody>
</table>