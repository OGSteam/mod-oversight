<?php


if (!defined('IN_SPYOGAME'))
    die("Hacking attempt");

global $db, $table_prefix, $user, $xtense_version;
$xtense_version = "2.2";

include_once("mod/oversight/common.php");




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
            global $user_data, $db, $table_prefix;
            $players = getAllSurveillance();
            $forDebug=array();
            $forDebug[]= "Oversight Debug";
            $_gal = $system["galaxy"];
            $_sys = $system["system"];
            $row= 1;
            foreach ($system["data"] as $rowContent)
            {
                //print_r($rowContent);
                if (isset($rowContent["player_id"]) && in_array($rowContent["player_id"],$players)) // todo mettre uniquement ceux recherché
                {
                    $forDebug[]= "Insertion de ".$rowContent["player_id"]." =>  ".$rowContent["player_name"];
                    $datatime = time();
                    $fomatDatetime = (int)roundtimestamp($datatime );

                    $p_activiy=-1;
                    switch ($rowContent["activity"]) {
                        case 0:
                            $p_activiy = roundtimestamp($datatime - (int)(15 * 60));
                            break;
                        case -1:
                            $p_activiy = $fomatDatetime;
                            break;
                        default:
                            $p_activiy = roundtimestamp($datatime - (int)($rowContent["activity"] * 60));
                            break;
                    }

                    $m_activiy=-1;
                    switch ($rowContent["activityMoon"]) {
                        case 0:
                            $m_activiy = roundtimestamp($datatime - (int)(15 * 60));
                            break;
                        case -1:
                            $m_activiy = $fomatDatetime;
                            break;
                        default:
                            $m_activiy = roundtimestamp($datatime - (int)($rowContent["activityMoon"] * 60));
                            break;
                    }

                    $query = " REPLACE INTO  ".TABLE_OVERSIGHT ;
                    $query .= "  (coord, datatime, p_activiy_value,p_activiy,   m_activiy_value, m_activiy, cdr,sender_id, player_id) ";
                    $query .= " VALUES ('".$_gal.":".$_sys.":".$row."', '".(int)roundtimestamp($datatime )."', '".$rowContent["activity"]."', '".$p_activiy."' ,'".$rowContent["activityMoon"]."','".$m_activiy."' , '".($rowContent["debris"]["metal"] + $rowContent["debris"]["cristal"] )."', '".$user_data["user_id"]."','".$rowContent["player_id"]."');" ;

                    $db->sql_query($query);
                    $forDebug[]=$query;
                }

                $row++;
            }
           // print_r($forDebug);
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
