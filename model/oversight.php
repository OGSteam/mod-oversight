<?php

if (!defined('IN_SPYOGAME')) die("Hacking Attemp!");


//retourne la liste des joueur id/nom
function getPlayer()
{
    global $db;
    $result = $db->sql_query("SELECT id_player, name_player , 	status FROM " . TABLE_SPA_PLAYERS . " order by name_player ASC");
    $Tretour = array();

    while ($tPlayer = $db->sql_fetch_row($result)) {
        $Tretour[$tPlayer["id_player"]] = array("id_player" => $tPlayer["id_player"], "name_player" => $tPlayer["name_player"], "status" => $tPlayer["status"]);

    }
    return $Tretour;

}


//obetenir les differents status des joueurs
function getStatus()
{
    global $db;
    $result = $db->sql_query("SELECT distinct(status)FROM " . TABLE_SPA_PLAYERS . " order by status ASC ");
    $tRetour = array();

    while ($tStatus = $db->sql_fetch_row($result)) {
        $tRetour[] = $tStatus["status"];

    }
    return $tRetour;

}

function getAllSurveillance()
{
    global $db;
    $result = $db->sql_query("SELECT player_id FROM " . TABLE_OVERSIGHT_PLAYERS . " ");
    $tRetour = array();

    while ($tStatus = $db->sql_fetch_row($result)) {
        $tRetour[] = $tStatus["player_id"];

    }
    return $tRetour;

}

function getMySurveillance()
{
    global $db, $user_data;
    $user_id = $user_data["user_id"];
    $result = $db->sql_query("SELECT player_id FROM " . TABLE_OVERSIGHT_PLAYERS . " WHERE  `sender_id`=" . $user_id);
    $tRetour = array();

    while ($tStatus = $db->sql_fetch_row($result)) {
        $tRetour[] = $tStatus["player_id"];

    }
    return $tRetour;

}

function getListSurveillance()
{
    global $db;
    $result = $db->sql_query("SELECT TOP.player_id as my_id_player , TU.user_name as my_user_name  FROM " . TABLE_OVERSIGHT_PLAYERS ."  as TOP  INNER JOIN " . TABLE_USER  . "  as TU ON TOP.sender_id =  TU.user_id    ");
    $tRetour = array();

    while ($tStatus = $db->sql_fetch_row($result)) {
        if (in_array($tStatus["my_id_player"], array_keys($tRetour))) {
            $tRetour[$tStatus["my_id_player"]][] = $tStatus["my_user_name"];
        } else {
            $tRetour[$tStatus["my_id_player"]] = array();
            $tRetour[$tStatus["my_id_player"]][] = $tStatus["my_user_name"];
        }
    }
    return $tRetour;
}

function getListOgspyUsers()
{
    global $db;
    $result = $db->sql_query("SELECT user_id , user_name  FROM  " . TABLE_USER  . "    ");
    $tRetour = array();

    while ($tStatus = $db->sql_fetch_row($result)) {
        $tRetour[$tStatus["user_id"]] = $tStatus["user_name"];
    }
    return $tRetour;
}


//mete surveillance un joueur
function addSurveillance($player)
{
    global $db, $user_data;
    $user_id = $user_data["user_id"];

    $query = "REPLACE INTO " . TABLE_OVERSIGHT_PLAYERS;
    $query .= " SET ";
    $query .= " `sender_id` = " . $user_id;
    $query .= ", `player_id` = " . $player;

    $db->sql_query($query);


}

//met e surveillance un joueur
function delSurveillance($player)
{
    global $db, $user_data;
    $user_id = $user_data["user_id"];

    $query .= "DELETE ";
    $query .= "FROM " . TABLE_OVERSIGHT_PLAYERS;
    $query .= " WHERE ";
    $query .= " `sender_id` = " . $user_id;
    $query .= " AND `player_id` = " . $player;

    $db->sql_query($query);


}




function getALLInsert($player_id)
{
    $player = "";
    if ($player_id!=0)
    {
        $player=  "  WHERE   `player_id` =".$player_id;
    }

    $query = "SELECT * FROM " . TABLE_OVERSIGHT . " ".$player;
    return get_Insert($query);
}

function getMyInsert($player_id)
{
    global  $user_data;
    $user_id = $user_data["user_id"];

    $player = " WHERE  `sender_id`=" . $user_id ." ";
    if ($player_id!=0)
    {
        $player .=  " AND `player_id` =".$player_id;
    }
    $query = "SELECT * FROM " . TABLE_OVERSIGHT . " ".$player;
    return get_Insert($query);
}

//met e surveillance un joueur
function get_Insert($query)
{
    global $db;

    $result = $db->sql_query($query);
    $tRetour = array();

    while ($tStatus = $db->sql_fetch_row($result)) {
        $tRow = array();
        $tRow["id"] = $tStatus["id"];
        $tRow["coord"] = $tStatus["coord"];
        $tRow["datatime"] = $tStatus["datatime"];
        $tRow["p_activiy_value"] = $tStatus["p_activiy_value"];
        $tRow["p_activiy"] = $tStatus["p_activiy"];
        $tRow["m_activiy_value"] = $tStatus["m_activiy_value"];
        $tRow["m_activiy"] = $tStatus["m_activiy"];
        $tRow["cdr"] = $tStatus["cdr"];
        $tRow["sender_id"] = $tStatus["sender_id"];
        $tRow["player_id"] = $tStatus["player_id"];
        $tRetour[] = $tRow;


    }
    return $tRetour;
}