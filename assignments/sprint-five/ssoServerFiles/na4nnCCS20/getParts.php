<?php

    require_once "db.conf";

    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Error checks database connection
    if ($mysqli->connect_error) {
        print "Could not connect to db";
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }

//If cId empty set $cId to 1. cId 26 is the id of character 'Business Man'
    $cId = empty($_GET['cId']) ? 26 : $_GET['cId'];

    $sql = "SELECT * FROM partData WHERE cId = " . $cId;

    $result = $mysqli->query($sql);

//Echos a JSON containing an array of parts
    $json = '{ "parts" : [';
    while($row = $result->fetch_assoc()) {
            $json .= json_encode($row);
            $json .= ", ";
        }
        echo substr($json, 0, -2) . "]}";

     // Close the result set
    $result->close();
    // Close the database connection
    $mysqli->close(); 