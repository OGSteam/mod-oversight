<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt");
?>
<div class="nav-page-menu">
    <?php foreach ($data["menu"] as $key) : ?>
        <?php if ($data["menuactif"] == $key["url"]) : ?>
            <div class="nav-page-menu-item  active">
                <a class="nav-page-menu-link" href="#">
                    <?php echo $key["nom"]; ?>
                </a>
            </div>
        <?php else : ?>
            <div class="nav-page-menu-item ">
                <a class="nav-page-menu-link" href="index.php?action=oversight&page=<?php echo $key["url"]; ?>">
                    <?php echo $key["nom"]; ?>
                </a>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>


</div>

