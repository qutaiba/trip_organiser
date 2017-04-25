<?php

use models\Api;



/**
 * Show the form or show the ordered trips in case the json is submitted
 *
 * @author qutaiba
 */
class home {
   
    public function index() {
        
        $boardingPassesJSON = filter_input(INPUT_POST,'boarding_passes');
        
        if(isset($boardingPassesJSON) && $boardingPassesJSON != '') {
            $boardingPassesArray = json_decode($boardingPassesJSON);
            $sortedTrips = new Api($boardingPassesArray->boardingPasses);
            $orderedTrips = $sortedTrips->sortTrips();
            include VIEW_DIR.'result.php';
        } else {
            include VIEW_DIR.'home.php';
        }
            
        
        
    }
}