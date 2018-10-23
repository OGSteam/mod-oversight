<?php
if (!defined('IN_SPYOGAME')) die("Hacking Attemp!");


function superapixinstalled()
{
    global $db;
    $result = $db->sql_query("SELECT `id` FROM `" . TABLE_MOD . "` WHERE `action`='superapix' AND `active`='1' LIMIT 1");
    if ($db->sql_numrows($result) == 0) {
        return false;
    } else {
        return true;
    }
}

