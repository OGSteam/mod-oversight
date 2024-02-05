<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt");
require_once("views/page_header.php");
global $data;

?>
<div  class="ogspy-mod-header">
<h2><?php echo $data["titre"];?></h2>
</div>


<?php foreach ($data["alert"] as $alert) : ?>
    <div class="og-msg og-msg-danger">
        <h3 class="og-title">Attention</h3>
        <p class="og-content"><?php echo htmlspecialchars($alert); ?></p>
    </div>
<?php endforeach ; ?>

<?php foreach ($data["msg"] as $msg) : ?>
    <div class="og-msg og-msg-success">
        <h3 class="og-title">Information</h3>
        <p class="og-content"><?php echo htmlspecialchars($msg); ?></p>
    </div>
<?php endforeach ; ?>
