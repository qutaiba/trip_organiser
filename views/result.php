<html>
    <head></head>
    <body style="margin: 10px 30px">
        <h3>To start your trip please follow the bellow guides:</h3
        <p>
            <ul>
                <?php
                    if(isset($orderedTrips) && COUNT($orderedTrips) > 0) {
                        foreach ($orderedTrips as $orderedTrip) :
                            echo "<li>Take ".$orderedTrip['type']." From ".$orderedTrip['from']
                                  ." To ".$orderedTrip['to'].". ". $orderedTrip['info']."</li>";
                        endforeach;
                        echo "<li>You have reached your destination</li>";
                    } else {
                        echo "<li>Sorry: the route could't be generated.</li>";
                    }
                ?>
            </ul>
        </p>
        <p>
            <a href="">Go back to Home</a>
        </p>
    </body>
</html>