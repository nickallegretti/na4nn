<?php

    require_once "db.conf";

    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Error checks database connection
    if ($mysqli->connect_error) {
        print "Could not connect to db";
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }

    $sql = "SELECT * FROM characterData";

// If sortBy empty sort by newest
    $sortBy = empty($_GET['sortBy']) ? 'newest' : $_GET['sortBy'];

    switch($sortBy) {
        case 'newest':
            $sql  = $sql . " ORDER BY cId DESC";
            break;
        case 'oldest':
            $sql = $sql . " ORDER BY cId ASC";
            break;
        case 'ratingHigh':
            $sql = $sql . " ORDER BY cLikes DESC";
            break;
        case 'ratingHigh':
            $sql = $sql . " ORDER BY cLikes ASC";
            break;
    }


        $result = $mysqli->query($sql);

//Echos a JSON containing an array of characters
        $json = '{ "characters" : [';
        while($row = $result->fetch_assoc()) {
            $json .= json_encode($row);
            $json .= ", ";
        }
        echo substr($json, 0, -2) . "]}";
        
    
        

    // Close the result set
    $result->close();
    // Close the database connection
    $mysqli->close(); 

        
?>