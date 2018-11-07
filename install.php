<?php
/**
* install.php
* @package Mod Cdr
* @author Machine
* @co-author Capi
* @version 1.62
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* @description Fichier d'installation du mod Cdr
*/

if (!defined('IN_SPYOGAME')) die("Hacking attempt");

global $db, $table_prefix;

$security = false;
$mod_folder = "oversight";
$security = install_mod($mod_folder);


if ($security == true) {

    define("TABLE_XTENSE_CALLBACKS", $table_prefix . "xtense_callbacks");
    define("TABLE_OVERSIGHT", $table_prefix . "oversight");
    define("TABLE_OVERSIGHT_PLAYERS", $table_prefix . "oversight_players");


    //Création de la table des oversight_players
    $query = "CREATE TABLE `".TABLE_OVERSIGHT_PLAYERS."` (
					`id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
					`sender_id` INT( 11 ) DEFAULT '0' NOT NULL ,
					`player_id` INT( 11 ) DEFAULT '0' NOT NULL ,
					UNIQUE KEY playeridentity (sender_id, player_id),
					UNIQUE ( `id`))";
    $db->sql_query($query);


    //Création de la table des oversight_players
    $query = "CREATE TABLE `".TABLE_OVERSIGHT."` (
					`id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
					`coord` VARCHAR( 11 ) NOT NULL  ,
					`datatime` INT( 11 ) NOT NULL  ,
					`p_activiy_value` VARCHAR( 11 )   DEFAULT '-' NOT NULL  ,
					`p_activiy` INT( 11 )  DEFAULT '0' NOT NULL  ,
					`m_activiy_value` VARCHAR( 11 )   DEFAULT '-'  NOT NULL  ,
					`m_activiy` INT( 11 )  DEFAULT '0' NOT NULL  ,
					`cdr` VARCHAR( 15 )  DEFAULT '0' NOT NULL  ,
					`sender_id` INT( 11 ) DEFAULT '0' NOT NULL ,
					`player_id` VARCHAR( 9 ) DEFAULT '' NOT NULL ,
					UNIQUE ( `id`))";
    $db->sql_query($query);




// On regarde si la table xtense_callbacks existe :
    $result = $db->sql_query('SHOW tables LIKE "' . TABLE_XTENSE_CALLBACKS . '"');
    echo "<script>alert('" . $lang['no_xtense'] . "')</script>";
    if ($db->sql_numrows($result) != 0) {
        // Quelle est l'ID du mod ?
        // On récupère le n° d'id du mod
        $query = "SELECT `id` FROM `" . TABLE_MOD . "` WHERE `action`='oversight' AND `active`='1' LIMIT 1";
        $result = $db->sql_query($query);
        $mod_id = $db->sql_fetch_row($result);
        $mod_id = $mod_id[0];


        // Maintenant on regarde si oversight est dedans
        $result = $db->sql_query("SELECT * FROM " . TABLE_XTENSE_CALLBACKS . " WHERE mod_id = '$mod_id'");
        $nresult = $db->sql_numrows($result);

        // S'il n'y est pas : alors on l'ajoute !
        if ($nresult == 0) $db->sql_query("INSERT INTO " . TABLE_XTENSE_CALLBACKS . " (mod_id, function, type, active) VALUES ('" . $mod_id . "', 'oversight', 'system', 1)");

    }
}
?>
