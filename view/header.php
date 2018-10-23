<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt");
require_once("views/page_header.php");
?>

<h1>Oversight</h1>
<?php if (!superapixinstalled()) : ?>
    <div class"alert">
    <p> Attention, le mod superapix est requis</p>
    </div>
<?php endif; ?>
