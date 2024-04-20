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
$data["menu"][] = array("nom" => "Information", "url" => "stat");


//Message avertissements
$data["msg"] = array();
$data["alert"] = array();
// le mod superapix n 'est plus requis
//if (!superapixinstalled()) {
  //  $data["alert"][] = "Attention, le mod superapix est requis";
//}

//liste des pages autorisées

$allowedPages = array("list", "insert","add","stat","analyse");
if(!isset($pub_page))
{
    $pub_page = "list";
}
if (!in_array($pub_page, $allowedPages)) {
    $pub_page = "list";
}


switch ($pub_page) {
    case "insert":
        $data["players"] = getPlayer();
        $data['limit'] = 5000; // limite  daffichage TODO modifiable
        //-------Logique-----------
        $data["menuactif"] = "insert";
        $data["getListOgspyUsers"]=getListOgspyUsers();
        //si null on doit tout montrer ....
        $data["player_id"] = (isset($data["player_id"]) )   ? (int)$pub_player_id  : null ;
        $data["insert"] = (isset($pub_all) )   ? getALLInsert($data["player_id"],$data['limit']) : getMyInsert($data["player_id"],$data['limit']) ;

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
        //datas communes
        $data["players"] = getPlayer();
        //-------Logique-----------
        if (isset($pub_remove)&&isset($pub_player_id) && in_array($pub_player_id , getAllSurveillance()))
        {
            $playerName =(getPlayer())[(int)$pub_player_id]["name_player"];
            delSurveillance($pub_player_id);
            $data["msg"][] = "Suppression de la surveillance ".$playerName;
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
        //datas communes
        $data["players"] = (isset($pub_findplayer))    ? getPlayer($db->sql_escape_string($pub_findplayer))  : array();
        $data["lastfind"] = (isset($pub_findplayer))    ? $db->sql_escape_string($pub_findplayer)  : "";

       //-------Logique-----------
        if (isset($pub_id) && !in_array($pub_id , getAllSurveillance())){
            addSurveillance((int)$pub_id);
            $playerName =(getPlayer())[(int)$pub_id]["name_player"];
            $data["msg"][] = "Joueur ". $playerName . "  ajouté";
        }
        $data["cssfile"] = FOLDER_CSS . "jscss.css";
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
        //datas communes
        $data["players"] = getPlayer();
        //-------Logique-----------
        $data["menuactif"] = "stat";
        if (isset($pub_purge))
        {
            purgeInsertOrphan();
        }
        $data["CountALLInsert"] = getCountALLInsert();
        $data["total_player"] = get_DisctinctPlayerId();
        $data["total_sender"] = get_DisctinctSenderId();
        $data["total_orphan"] = get_Orphan();
        //-------------------------

        //-------Appel Vue---------
        include_once(FOLDER_VIEW . "header.php");
        include_once(FOLDER_VIEW . "menu.php");
        include_once(FOLDER_VIEW . "stat.php");
        include_once(FOLDER_VIEW . "footer.php");
        //-------------------------
        break;
    case  "analyse":
        //datas communes
        $data["players"] = getPlayer();
        $data["daylist"] = weekdaylist();
        //si filtre non défini
        $data["nblastday"] = (isset($pub_nblastday))    ? (int)$pub_nblastday  : 30 ; // par defaut 30 jour
        $data["findday"] = (isset($pub_findday))    ? (int)$pub_findday  : -1 ; // par defaut 30 jour
        $data["messageDM"] = "";
        if (isset($pub_coodepart) && isset($pub_cooarrivee) && isset($pub_player_id)) {
            $data["messageDM"] = makeDM($pub_coodepart, $pub_cooarrivee, $pub_player_id);
        }


        //-------Logique-----------
        $data["menuactif"] = "analyse";
        $data["player_id"] = (int)$pub_player_id;
        $data["cssfile"] = FOLDER_CSS . "jscss.css";
        $limit = 9999999999999; // a retravailler :/
        if (isset($pub_all))
        {
            $data["insert"] = getALLInsert($data["player_id"],$limit,$data["nblastday"], $data["findday"] );
        }
        else
        {
            $data["insert"] = getMyInsert($data["player_id"],$limit,$data["nblastday"], $data["findday"] );
        }
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

