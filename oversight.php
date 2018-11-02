<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt");
include_once("mod/oversight/common.php");
$data=array();
///TITRE
$data["titre"] = "Oversight";

//menu
$data["menu"]=array();
$data["menu"][]=array("nom" => "Liste", "url" => "list" );
$data["menu"][]=array("nom" => "Mise en surveillance", "url" => "add");

//datas communes
$data["players"] = getPlayer();

//Message avertissements
$data["msg"]=array();
$data["alert"] = array();
if (!superapixinstalled())
{
    $data["alert"][] = "Attention, le mod superapix est requis";
}

//liste des pages autorisées
$allowedPages = array("list","add" );
if (!in_array($pub_page,$allowedPages ))
{
    $pub_page="list";
}


switch ($pub_page) {
        case "list":
            $data["menuactif"]="list";
            $data["ListSurveillance"]=getListSurveillance();
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
            array_push($data["mySurveillance"], "0"); // player 0 ... :/ ne pas mettre en surveillance
            $data["menuactif"]="add";
            $data["playerStatus"]=getStatus();
            include_once(FOLDER_VIEW . "header.php");
            include_once(FOLDER_JS . "jsadd.php");
            include_once(FOLDER_VIEW . "menu.php");
            include_once(FOLDER_VIEW . "add.php");
            include_once(FOLDER_VIEW . "footer.php");
            break;
        default:
               break;

}

