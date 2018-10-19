<?php


if (!defined('IN_SPYOGAME')) die("Hacking attempt");

global $db, $table_prefix;


$filename = 'mod/oversight/version.txt';
if (file_exists($filename)) $file = file($filename);

$security = false;
$security = update_mod('oversight','oversight');


if ($security == true){


}
?>
