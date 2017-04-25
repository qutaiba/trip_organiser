<html>
    <head></head>
    <body style="margin: 0 30px">
        <h1>Welcome to trip sorter</h1>
        <h3>Please paste the boarding passes in a JSON format:</h3>
        <pre>ex:
{  
   "boardingPasses":[  
      {  
         "pointA":"Amman",
         "pointB":"Dubai",
         "type":"flight",
         "info":"Seat Number 15B"
      }
   ]
}
        </pre>
        <p>Please Note:<br/>
        - pointA and pointB doesn't specifically refer to start and end point, each can be either.<br/>
        - Add the boarding passes in any order you want.</p>
        <form method="post">
            <textarea name="boarding_passes" cols="100" rows="20">{"boardingPasses":[
 {"pointA":"Amman","pointB":"Jerash","type":"Bus","info":"No seat assigned"}
,{"pointA":"Jerash","pointB":"Dammam","type":"Flight","info":"Flight number AK47 Gate 15B"}
,{"pointA":"Dammam","pointB":"Cairo","type":"Flight","info":"Flight number M16 Terminal 2"}
,{"pointA":"Cairo","pointB":"Riyadh","type":"Train","info":"Seat 34"}
,{"pointA":"Riyadh","pointB":"Irbid","type":"Bus","info":"No seat assigned"}
,{"pointA":"Zarqa","pointB":"Irbid","type":"Flight","info":"D3"}
,{"pointA":"Zarqa","pointB":"Demuscus","type":"Flight","info":"Flight Number SY15 Gate 5"}
,{"pointA":"Rome","pointB":"Demuscus","type":"Flight","info":"Flight Number SY15 Gate 5, Luggage will follow"}
,{"pointA":"Rome","pointB":"Alain","type":"Ship","info":"Dock 4, seat 15A"}
,{"pointA":"Jeddah","pointB":"Alain","type":"Train","info":"First class, seat A3"}
,{"pointA":"Mekka","pointB":"Jeddah","type":"Taxi","info":"Booking reference XV3456"}
,{"pointA":"Mekka","pointB":"Sharm","type":"Flight","info":"Flight number 30A Seat 33C"}
,{"pointA":"Sharm","pointB":"Birut","type":"Train","info":"You don't have a seat jump to the cargo carriages."}
,{"pointA":"Dubai","pointB":"Birut","type":"Flight","info":"Flight Number 666AE First Class Seat 4A"}
]}</textarea>
            <br/>
            <input type="submit" value="Sort" style="width: 300px; height: 30px" />
        </form>
    </body>
</html>