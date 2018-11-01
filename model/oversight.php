<?php

if (!defined('IN_SPYOGAME')) die("Hacking Attemp!");



//retourne la liste des joueur id/nom
function getPlayer()
{
    global $db;
    $result = $db->sql_query("SELECT id_player, name_player , 	status FROM " . TABLE_SPA_PLAYERS." order by name_player ASC");
    $Tretour=array();

    while ($tPlayer = $db->sql_fetch_row($result))
    {
        $Tretour[$tPlayer["id_player"]] = array("id_player" => $tPlayer["id_player"],"name_player"=>$tPlayer["name_player"],"status"=>$tPlayer["status"]);

    }
    return $Tretour;

}



//obetenir les differents status des joueurs
function getStatus()
{
    global $db;
    $result = $db->sql_query("SELECT distinct(status)FROM " . TABLE_SPA_PLAYERS ." order by status ASC ");
    $tRetour=array();

    while ($tStatus = $db->sql_fetch_row($result))
    {
        $tRetour[] = $tStatus["status"];

    }
    return $tRetour;

}

function getAllSurveillance()
{
    global $db;
    $result = $db->sql_query("SELECT player_id FROM " . TABLE_OVERSIGHT_PLAYERS ." ");
    $tRetour=array();

    while ($tStatus = $db->sql_fetch_row($result))
    {
        $tRetour[] = $tStatus["player_id"];

    }
    return $tRetour;

}

function getMySurveillance()
{
    global $db, $user_data;
    $user_id = $user_data["user_id"];
    $result = $db->sql_query("SELECT player_id FROM " . TABLE_OVERSIGHT_PLAYERS ." WHERE  `sender_id`=".$user_id );
    $tRetour=array();

    while ($tStatus = $db->sql_fetch_row($result))
    {
        $tRetour[] = $tStatus["player_id"];

    }
    return $tRetour;

}




//met e surveillance un joueur
function addSurveillance($player)
{
    global $db, $user_data;
    $user_id = $user_data["user_id"];

    $query = "REPLACE INTO ".TABLE_OVERSIGHT_PLAYERS;
    $query .= " SET " ;
    $query .= " `sender_id` = ".$user_id;
    $query .= ", `player_id` = ".$player;

    $db->sql_query($query);



}

//met e surveillance un joueur
function delSurveillance($player)
{
    global $db, $user_data;
    $user_id = $user_data["user_id"];

    $query = "FROM".TABLE_OVERSIGHT_PLAYERS;
    $query .= " WHERE " ;
    $query .= " `sender_id` = ".$user_id;
    $query .= ", `player_id` = ".$player;

    $db->sql_query($query);



}