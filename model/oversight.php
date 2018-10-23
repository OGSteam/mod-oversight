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
        $Tretour[$tPlayer["id_player"]] = array($tPlayer["id_player"],$tPlayer["name_player"],$tPlayer["status"]);

    }
    return $Tretour;

}