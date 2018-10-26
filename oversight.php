<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt");
include_once("mod/oversight/common.php");
$data=array();
$data["titre"] = "Oversight";
$data["menu"]=array();
$data["menu"][]=array("nom" => "Liste", "url" => "list" );
$data["menu"][]=array("nom" => "Mise en surveillance", "url" => "add");

$data["players"] = getPlayer();


// vue par defaut
switch ($pub_page) {
        case "list":
            $data["menuactif"]="list";
            include_once(FOLDER_VIEW . "header.php");
            include_once(FOLDER_VIEW . "menu.php");
            include_once(FOLDER_VIEW . "list.php");
            include_once(FOLDER_VIEW . "footer.php");
            break;
        case  "add":
            $data["menuactif"]="add";
            include_once(FOLDER_VIEW . "header.php");
            include_once(FOLDER_VIEW . "menu.php");
            include_once(FOLDER_VIEW . "add.php");
            include_once(FOLDER_VIEW . "footer.php");
            break;
        default:
            $data["menuactif"]="list";
            include_once(FOLDER_VIEW . "header.php");
            include_once(FOLDER_VIEW . "menu.php");
            include_once(FOLDER_VIEW . "list.php");
            include_once(FOLDER_VIEW . "footer.php");
            break;

}

