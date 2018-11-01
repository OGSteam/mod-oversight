<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt");
include_once("mod/oversight/common.php");
$data=array();
$data["titre"] = "Oversight";
$data["menu"]=array();
$data["menu"][]=array("nom" => "Liste", "url" => "list" );
$data["menu"][]=array("nom" => "Mise en surveillance", "url" => "add");

$data["players"] = getPlayer();

$data["msg"]=array();
$data["alert"] = array();
if (!superapixinstalled())
{
    $data["alert"][] = "Attention, le mod superapix est requis";
}



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
            if (isset($pub_id))
            {
                addSurveillance((int)$pub_id);
                $data["msg"][] = "Joueur ".$data["players"][(int)$pub_id]["name_player"]." ajouté";
            }
            $data["mySurveillance"] = getMySurveillance();
            array_push($data["mySurveillance"], "0"); // player 0 ... :/
            $data["menuactif"]="add";
            $data["playerStatus"]=getStatus();
            include_once(FOLDER_VIEW . "header.php");
            include_once(FOLDER_JS . "jsadd.php");
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

