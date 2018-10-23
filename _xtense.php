<?php


if (!defined('IN_SPYOGAME'))
    die("Hacking attempt");

global $db, $table_prefix, $user, $xtense_version;
$xtense_version = "2.2";


// TEST XTENSE2
if (class_exists("Callback")) {
    class oversight_Callback extends Callback
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
            return array(array('function' => 'oversight', 'type' => 'system'));
        }


        function oversight($system)
        {
            global $user, $db, $table_prefix;
            //dump($system);
            // echo $system["galaxy"].":".$system["system"];
          // print_r($system);
            return true;
        }


    }

    //cf doc
    // system 	array
    //  [galaxy] (int)
    //  [system] (int)
    //  [data] (array #15)
    //              array
    //              [planet_name] (string)
    //              [moon] (int) défini par les constantes TYPE_PLANET ou TYPE_MOON Ogame
    //              [player_name] (string)
    //              [status] (string)
    //              [ally_tag] (string)
    //              [debris] (array)
    //              [metal] (int) Ogame
    //              [cristal] (int) Ogame
    //              [titanium] (int) E-Univers
    //              [carbon] (int) E-Univers
    //              [tritium] (int) E-Univers
    //              [activity] (string) au format du jeu, * ou 37mn par exemple Ogame


    //cf print_r
    //[data] => Array
    //(
    //etc
    // [12] => Array
    //      (
    //          [player_id] => 100881
    //          [planet_name] => Exia
    //          [planet_id] => 33631656
    //          [moon_id] => 33631658
    //          [moon] => 1
    //          [player_name] => SetsunaFSeiei
    //          [status] => v
    //          [ally_id] => 500762
    //          [ally_tag] => BISOUS
    //          [debris] => Array
    //                      (
    //                      [metal] => 0
    //                      [cristal] => 0
    //                      )
    //          [activity] => -1
    //          [activityMoon] => -1
    //          )
    //etc
    //}
    //[galaxy] => 3
    //[system] => 38


}


?>
