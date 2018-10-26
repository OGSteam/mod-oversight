<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt");
require_once("views/page_header.php");
global $data;
?>

<h2><?php echo $data["titre"];?></h2>
<?php if (!superapixinstalled()) : ?>
    <div class"alert">
        <p> Attention, le mod superapix est requis</p>
    </div>
<?php endif; ?>
