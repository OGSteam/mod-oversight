<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt");
require_once("views/page_header.php");
global $data;

?>

<h2><?php echo $data["titre"];?></h2>

<?php foreach ($data["alert"] as $alert) : ?>
    <div class="alert">
        <p>
            <?php echo  $alert; ?>
        </p>
    </div>
<?php endforeach ; ?>

<?php foreach ($data["msg"] as $msg) : ?>
    <div class="msg">
        <p>
            <?php echo  $msg; ?>
        </p>
    </div>
<?php endforeach ; ?>
