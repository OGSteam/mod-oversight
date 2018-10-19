<?php


if (!defined('IN_SPYOGAME'))
    die("Hacking attempt");

global $db, $table_prefix, $user, $xtense_version;
$xtense_version = "2.2";



// TEST XTENSE2

if (class_exists("Callback")) {
    class cdr_Callback extends Callback
    {
        public $version = '2.3.9';
        public function cdr($system)
        {
            global $io;
            if (cdr($system))
                return Io::SUCCESS;
            else
                return Io::ERROR;
        }
        public function getCallbacks()
        {
            return array(array('function' => 'srv', 'type' => 'system'));
        }
    }
}
function srv($system)
{
    global , $user, $db, $table_prefix; 
    dump($system);
   
    return true;
}

?>
