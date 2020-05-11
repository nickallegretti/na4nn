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
        
// Checks for existing user. If user does not exist add user to userProfile table
    $sql = "SELECT uName FROM userProfile WHERE uId= '" . $uId . "'";    
    $result = $mysqli->query($sql);
    if($result->num_rows == 0) {
    
        $sql = 'INSERT INTO userProfile (uId, uName, uEmail, uProfileURL, numOfCreations) VALUES ("' . $uId . '", "' . $userProfile->displayName . '", "' . $userProfile->email . '", "' . $userProfile->photoURL . '", 0)';
        
        if($mysqli->query($sql) === TRUE) {
            //Space if I want to impilment something here later
        }   
    }

//If character is recieved add it to characterData table
    if(isset($_POST['character'])) {
        $character = json_decode($_POST['character']);
       
        $sql = 'INSERT INTO characterData(cName, cDescription, cBaseImageURL, cLikes, uId) VALUES ("' . $character->cName . '", "' . $character->cDescription . '", "' . $character->cBaseImageURL . '", 0, "' . $uId . '")';
        
        if($mysqli->query($sql) === TRUE) {
            
        //Gets id of the character just added
            $last_id = $mysqli->insert_id;
            
        //If cParts array present, add each part to partData table
            if(isset($_POST['cParts'])) {
                $cParts = json_decode($_POST['cParts']);
                
                for($i = 0; $i < count($cParts); $i++) {
                    $sql = 'INSERT INTO partData(cId, pName, pBaseImageURL, pColorImageURL, pWidth, pLeft, pTop, pBrightness, pHue, uId) VALUES (' . $last_id . ', "' . $cParts[$i]->pName . '", "' . $cParts[$i]->pBaseImageURL . '", "' . $cParts[$i]->pColorImageURL . '", ' . $cParts[$i]->pWidth . ', ' . $cParts[$i]->pLeft . ', ' . $cParts[$i]->pTop . ', ' . $cParts[$i]->pBrightness . ', ' . $cParts[$i]->pHue . ', "' . $uId . '")';
                    
                    if($mysqli->query($sql) === TRUE) {
                        
                    }
                     else {
                        echo "Error: " . $sql . "<br>" . $mysqli->error;
                    }
                }
                
            }
            
        }
        else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
        
        echo "Character Preset Uploaded Successfully";
    }
    
    
     // Close the result set
    $result->close();
    // Close the database connection
    $mysqli->close(); 

?>