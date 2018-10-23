<?php

if (!defined('IN_SPYOGAME')) die("Hacking Attemp!");
/// constante
define("FOLDER","mod/oversight/");
define("FOLDER_JS","mod/oversight/js/");
define("FOLDER_CSS","mod/oversight/css/");
define("FOLDER_VIEW","mod/oversight/view/");
define("FOLDER_FN","mod/oversight/functions/");
define("FOLDER_IMG","mod/oversight/img/");
define("FOLDER_MODEL","mod/oversight/model/");

//include
include_once(FOLDER_MODEL."oversight.php");
include_once(FOLDER_FN."utils.php");


//table
define("TABLE_SPA_PLAYERS", $table_prefix . "superapix_players");