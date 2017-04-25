<?php
namespace models;

/**
 * Extract the start and end points and order the boarding passes
 *
 * @author qutaiba
 */
class Api {
    
    private $orderedBoardings;
    private $boardingPassesArray;
    private $arrayA;
    private $arrayB;
    private $arrayC;
    
    /**
     * Initialize the Api object by assigning the boarding passes array to the 
     * private variable in the class.
     *
     * @author qutaiba
     * 
     */
    public function __construct($boardingPassesArray) {
        $this->boardingPassesArray = $boardingPassesArray;
    }
    
    /**
     * Get the unique points and pass to ordering function
     *
     * @author qutaiba
     * @return array The order list of boarding passes
     * 
     */
    public function sortTrips() {
        $uniquepoints = $this->extractSingularPoints();
        $orderedRoute = $this->routeCreater($uniquepoints);

        return $orderedRoute;
    }

    /**
     * Extract the single points from the boarding passes
     * Will generate Start and End point for the trip
     * Not specifically in that order, will also generate the ArrayA, ArrayB, 
     * ArrayC that will hold the possible combination between locations.
     *
     * @author qutaiba
     * @return array Start and End points
     * 
     */
    private function extractSingularPoints() {
        $pointA = array();
        $pointB = array();
        $count = 0;

        foreach ($this->boardingPassesArray as $boardingPass) {
            $pointA[] = $boardingPass->pointA;
            $pointB[] = $boardingPass->pointB;

            if (!isset($this->arrayA["$boardingPass->pointA"])) {
                $this->arrayA["$boardingPass->pointA"]['point'] = $boardingPass->pointB;
                $this->arrayA["$boardingPass->pointA"]['id'] = $count;
            } else {
                $this->arrayC["$boardingPass->pointA"]['point'] = $boardingPass->pointB;
                $this->arrayC["$boardingPass->pointA"]['id'] = $count;
            }

            if (!isset($this->arrayB["$boardingPass->pointB"])) {
                $this->arrayB["$boardingPass->pointB"]['point'] = $boardingPass->pointA;
                $this->arrayB["$boardingPass->pointB"]['id'] = $count;
            } else {
                $this->arrayC["$boardingPass->pointB"]['point'] = $boardingPass->pointA;
                $this->arrayC["$boardingPass->pointB"]['id'] = $count;
            }
            $count++;
        }



        $allPoints = array_merge($pointA, $pointB);
        $singlePointsWithKeys = array_filter(array_count_values($allPoints), array($this, 'filter_doublicates'));
        $singlePoints = array_keys($singlePointsWithKeys);

        return $singlePoints;
    }

    /**
     * Order the routes between trips
     *
     * @author qutaiba
     * @return array Full ordered route
     * @param Array $uniquepoints The start and end points
     * 
     */
    private function routeCreater($uniquepoints) {

        $searchFor = $lastValue = $uniquepoints[0];// Assuming the $uniquepoints[0] is the start 
        for ($i = 0; $i <= COUNT($this->boardingPassesArray); $i++) {
            $newSearch = $this->tripLocater($searchFor, $lastValue, $i);
            $lastValue = $searchFor;
            $searchFor = $newSearch;

            if ($searchFor == $uniquepoints[1]) // Assuming the $uniquepoints[1] is the end 
                break;
        }

        return $this->orderedBoardings;
    }

    /**
     * Find the connection between trips 
     *
     * @author qutaiba
     *
     * @param string $searchFor The next destination to look for
     * @param string $lastValue The last destination found
     * @param int $i Array index for the orderedBoardings Array
     * @return array Full ordered route
     * 
     */
    private function tripLocater($searchFor, $lastValue, $i) {
        
        if (isset($this->arrayA[$searchFor]) && $this->arrayA[$searchFor]['point'] != $lastValue) {
            $this->orderedBoardings[$i]['from'] = $searchFor;
            $this->orderedBoardings[$i]['to'] = $this->arrayA[$searchFor]['point'];
            $this->orderedBoardings[$i]['type'] = $this->boardingPassesArray[$this->arrayA[$searchFor]['id']]->type;
            $this->orderedBoardings[$i]['info'] = $this->boardingPassesArray[$this->arrayA[$searchFor]['id']]->info;
            return $this->arrayA[$searchFor]['point'];
        } elseif (isset($this->arrayB[$searchFor]) && $this->arrayB[$searchFor]['point'] != $lastValue) {
            $this->orderedBoardings[$i]['from'] = $searchFor;
            $this->orderedBoardings[$i]['to'] = $this->arrayB[$searchFor]['point'];
            $this->orderedBoardings[$i]['type'] = $this->boardingPassesArray[$this->arrayB[$searchFor]['id']]->type;
            $this->orderedBoardings[$i]['info'] = $this->boardingPassesArray[$this->arrayB[$searchFor]['id']]->info;
            return $this->arrayB[$searchFor]['point'];
        } elseif (isset($this->arrayC[$searchFor]) && $this->arrayC[$searchFor]['point'] != $lastValue) {
            $this->orderedBoardings[$i]['from'] = $searchFor;
            $this->orderedBoardings[$i]['to'] = $this->arrayC[$searchFor]['point'];
            $this->orderedBoardings[$i]['type'] = $this->boardingPassesArray[$this->arrayC[$searchFor]['id']]->type;
            $this->orderedBoardings[$i]['info'] = $this->boardingPassesArray[$this->arrayC[$searchFor]['id']]->info;
            return $this->arrayC[$searchFor]['point'];
        } else {
            die('No Connection between trips');
        }
    }

    /**
     * Filter function used in array_filter callback
     * will return only values less than 2 count in array
     *
     * @author qutaiba
     * @param int $count The count of values in array
     * @return bool 
     */
    private function filter_doublicates($count) {
        return $count < 2;
    }

}
