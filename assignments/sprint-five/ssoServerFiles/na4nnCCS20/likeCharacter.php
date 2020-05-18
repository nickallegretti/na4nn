<?php

    require_once "db.conf";
    require_once 'config.php';

    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);


// Error checks database connection
    if ($mysqli->connect_error) {
        print "Could not connect to db";
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }

// Error checks user data
    try {
        $userProfile = $adapter->getUserProfile();
    }
    catch( Exception $e ){
        die($e->getMessage());
    }

     $uId = $userProfile->identifier;

    if(isset($_POST['cId'])) {
        $cId = json_decode($_POST['cId']);
        
        $sql = 'SELECT COUNT(*) FROM likes WHERE uId = "' . $uId . '" AND cId = "' . $cId . '"';
        
        $result = $mysqli->query($sql);
        $data= $result->fetch_array();
        
        
        if($data[0] == 0) {
            $sql = 'UPDATE characterData SET cLikes = cLikes + 1 WHERE cId = "' . $cId . '"';
            
            if($mysqli->query($sql) === TRUE) {
                
//                echo "Preset Liked";
                
                $sql = 'INSERT INTO likes VALUES (' . $cId . ', "' . $uId . '")';
                if($mysqli->query($sql) === TRUE) {
//                    echo "Like added to db";   
                }
                else {
//                    echo "failed to add like to db";
                }
                
            }
            else {
//                echo "Failed to like preset";
            }
        }
        else {
            $sql = 'UPDATE characterData SET cLikes = cLikes - 1 WHERE cId = "' . $cId . '"';
            
            if($mysqli->query($sql) === TRUE) {
                
//                echo "Preset Unliked";
                
                $sql = 'DELETE FROM likes WHERE cId > 0';
                if($mysqli->query($sql) === TRUE) {
//                    echo "Like removed from db";   
                }
                else {
//                    echo "failed to remove like from db";
                }
                
            }
            else {
//                echo "Failed to unlike preset";
            }
        }
    
        $sql = 'SELECT cLikes FROM characterData WHERE cId = ' . $cId;
        $result = $mysqli->query($sql);
        $data = $result->fetch_array();
        echo $data[0];
    
    }


    else {
        echo 'cId not set';
    }

$mysqli->close();
?>