<?php

if (!defined('IN_SPYOGAME')) die("Hacking Attemp!");


//retourne la liste des joueur id/nom
function getPlayer($defaultname="")
{
    global $db;
    $query="SELECT id_player, name_player ,	status";
    $query.=" FROM " . TABLE_SPA_PLAYERS . " ";
    if ($defaultname!="")
    {
        $query.="WHERE  name_player like '%".$db->sql_escape_string($defaultname)."%' ";
    }
    $query.=" order by name_player ASC";



    $result = $db->sql_query($query);
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


function getCountALLInsert()
{
    global $db;
    $query = "SELECT count(*) as nbtotal FROM " . TABLE_OVERSIGHT . "";
    $result = $db->sql_query($query);
    return $db->sql_fetch_row($result)["nbtotal"];


}



function getALLInsert($player_id,$since=1500000000 , $weekday=-1)
{
    $player = "";
    $player.=  "  WHERE   `player_id` > 0 ";

    if ($player_id!=0)
    {
        $player.=  "  AND   `player_id` =".$player_id;

    }
    $player.=  "  AND   `datatime` >  " .(int)(time() - $since * 24*60*60 );

    if ($weekday!=-1)
    {
        $player.=  "  AND   WEEKDAY(CAST(FROM_UNIXTIME(`datatime`) as date))= ".$weekday." ";


    }

    $query = "SELECT * ,  WEEKDAY(CAST(FROM_UNIXTIME(`datatime`) as date)) as newdate FROM " . TABLE_OVERSIGHT . " ".$player;
    return get_Insert($query);
}


function getMyInsert($player_id,$since=1500000000 , $weekday=-1)
{
    global  $user_data;
    $user_id = $user_data["user_id"];

    $player = " WHERE  `sender_id`=" . $user_id ." ";
    if ($player_id!=0)
    {
        $player .=  " AND `player_id` =".$player_id;
    }
    $player.=  "  AND   `datatime` >  " .(int)(time() - $since * 24*60*60 );
    if ($weekday!=-1)
    {
        //   $player.=  "  AND  valeur_date = ".$weekday."  ";
        $player.=  "  AND   WEEKDAY(CAST(FROM_UNIXTIME(`datatime`) as date))= ".$weekday." ";

    }

    $query = "SELECT * ,  WEEKDAY(CAST(FROM_UNIXTIME(`datatime`) as date)) as newdate FROM " . TABLE_OVERSIGHT . " ".$player;

    return get_Insert($query);
}


function get_Insert($query)
{
    global $db;

    $result = $db->sql_query($query);
    $tRetour = array();

    while ($tStatus = $db->sql_fetch_row($result)) {
        ;
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


function get_DisctinctCoord($player_id)
{
    global $db;
    $query = "SELECT distinct(coord) FROM " . TABLE_OVERSIGHT . "  WHERE `player_id` =".$player_id;
    $result = $db->sql_query($query);
    $tRetour = array();

    while ($tStatus = $db->sql_fetch_row($result)) {
        $tRetour[]= $tStatus["coord"];
    }
    return $tRetour;
}


function get_DisctinctPlayerId()
{
    global $db;
    $query = "SELECT count(distinct(player_id)) as total_player FROM " . TABLE_OVERSIGHT_PLAYERS . " ";
    $result = $db->sql_query($query);
    $tRetour =  $db->sql_fetch_row($result);
    return $tRetour["total_player"];
}

function get_DisctinctSenderId()
{
    global $db;
    $query = "SELECT count(distinct(sender_id))  as total_sender FROM " . TABLE_OVERSIGHT_PLAYERS . " ";
    $result = $db->sql_query($query);
    $tRetour =  $db->sql_fetch_row($result);
    return $tRetour["total_sender"];
}

function get_Orphan()
{
    global $db;
    $query = "SELECT  count(player_id) as total_orphan FROM " . TABLE_OVERSIGHT . " ";
    $query .= " WHERE player_id NOT IN (select player_id as pid from   " . TABLE_OVERSIGHT_PLAYERS . "  )";
    $result = $db->sql_query($query);
    $tRetour =  $db->sql_fetch_row($result);
    return $tRetour["total_orphan"];
}

function purgeInsertOrphan()
{
    global $db;
    $query = "delete FROM " . TABLE_OVERSIGHT . " ";
    $query .= " WHERE player_id NOT IN (select player_id as pid from   " . TABLE_OVERSIGHT_PLAYERS . "  )";
    $db->sql_query($query);

}

function makeDM($coodepart, $cooarrivee, $playerID) {
    if (count(explode(":",$coodepart)) == 3 && count(explode(":",$cooarrivee)) == 3) {
        global $db;
        $query = "UPDATE ". TABLE_OVERSIGHT . " SET `coord` ='".$cooarrivee."' ";
        $query .= " WHERE `player_id` = '" . $playerID . "' AND `coord` = '" . $coodepart . "' ";
        $result = $db->sql_query($query);
        return "Le DM a bien eu lieu !";
    }
    else {
        return "Les coordonées du DM n'ont pas l'air ok il faut x:xxx:xx ex : 2:32:8. Valeurs fournies : $coodepart et $cooarrivee";
    }
}

