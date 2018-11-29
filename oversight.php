<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt");
include_once("mod/oversight/common.php");
$data = array();
///TITRE
$data["titre"] = "Oversight";

//menu
$data["menu"] = array();
$data["menu"][] = array("nom" => "Liste", "url" => "list");
$data["menu"][] = array("nom" => "Mise en surveillance", "url" => "add");
$data["menu"][] = array("nom" => "Insertions", "url" => "insert");
$data["menu"][] = array("nom" => "Stat", "url" => "stat");

//datas communes
$data["players"] = getPlayer();

//Message avertissements
$data["msg"] = array();
$data["alert"] = array();
if (!superapixinstalled()) {
    $data["alert"][] = "Attention, le mod superapix est requis";
}

//liste des pages autorisées
$allowedPages = array("list", "insert","add","stat","analyse");
if (!in_array($pub_page, $allowedPages)) {
    $pub_page = "list";
}


switch ($pub_page) {
    case "insert":
        //-------Logique-----------
        $data["menuactif"] = "insert";
        $data["getListOgspyUsers"]=getListOgspyUsers();
        $data["player_id"] = (int)$pub_player_id;
        if (isset($pub_all))
        {
            $data["insert"] = getALLInsert($data["player_id"]);
        }
        else
        {
            $data["insert"] = getMyInsert($data["player_id"]);
        }
        $data["ListSurveillance"] = getListSurveillance();
        //-------------------------

        //-------Appel Vue---------
        include_once(FOLDER_VIEW . "header.php");
        include_once(FOLDER_VIEW . "menu.php");
        include_once(FOLDER_VIEW . "insert.php");
        include_once(FOLDER_VIEW . "footer.php");
        //-------------------------
        break;
    case "list":
        //-------Logique-----------
        if (isset($pub_remove)&&isset($pub_player_id))
        {
            delSurveillance($pub_player_id);
            $data["msg"][] = "Suppression de la surveillance";
        }
        $data["menuactif"] = "list";
        $data["ListSurveillance"] = getListSurveillance();
        //-------------------------

        //-------Appel Vue---------
        include_once(FOLDER_VIEW . "header.php");
        include_once(FOLDER_VIEW . "menu.php");
        include_once(FOLDER_VIEW . "list.php");
        include_once(FOLDER_VIEW . "footer.php");
        //-------------------------
        break;
    case  "add":
        //-------Logique-----------
        if (isset($pub_id)) {
            addSurveillance((int)$pub_id);
            $data["msg"][] = "Joueur " . $data["players"][(int)$pub_id]["name_player"] . " ajouté";
        }
        $data["mySurveillance"] = getMySurveillance();
        array_push($data["mySurveillance"], "0"); // player 0 ... :/ ne pas mettre en surveillance
        $data["menuactif"] = "add";
        $data["playerStatus"] = getStatus();
        //-------------------------

        //-------Appel Vue---------
        include_once(FOLDER_VIEW . "header.php");
        include_once(FOLDER_JS . "jsadd.php");
        include_once(FOLDER_VIEW . "menu.php");
        include_once(FOLDER_VIEW . "add.php");
        include_once(FOLDER_VIEW . "footer.php");
        //-------------------------
        break;
    case  "stat":
        //-------Logique-----------
        $data["menuactif"] = "stat";
        //-------------------------

        //-------Appel Vue---------
        include_once(FOLDER_VIEW . "header.php");
        include_once(FOLDER_VIEW . "menu.php");
        include_once(FOLDER_VIEW . "stat.php");
        include_once(FOLDER_VIEW . "footer.php");
        //-------------------------
        break;
    case  "analyse":
        //-------Logique-----------
        $data["menuactif"] = "analyse";
        $data["player_id"] = (int)$pub_player_id;
        $data["cssfile"] = FOLDER_CSS . "jscss.css";
        //-------------------------

       //-------Appel Vue---------
        include_once(FOLDER_VIEW . "header.php");
        include_once(FOLDER_VIEW . "menu.php");
        include_once(FOLDER_VIEW . "analyse.php");
        include_once(FOLDER_VIEW . "footer.php");
        //-------------------------
        break;
    default:
        break;

}

