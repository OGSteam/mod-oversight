<?php

if (!defined('IN_SPYOGAME')) die("Hacking Attemp!");

//retourne la liste des joueur id/nom
function getPlayer()
{
    global $db;
    $result = $db->sql_query("SELECT id_player, name_player , 	status FROM " . TABLE_SPA_PLAYERS);
    $Tretour=array();

    while ($tPlayer = $db->sql_fetch_row($result))
    {
        $Tretour[$tPlayer["id_player"]] = array("id_player" => $tPlayer["id_player"],"name_player"=>$tPlayer["name_player"],"status"=>$tPlayer["status"]);

    }
    return $Tretour;

}