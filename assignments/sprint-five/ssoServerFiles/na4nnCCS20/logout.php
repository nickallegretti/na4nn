<?php
    require_once 'config.php';
 
//If user is signed in, sign them out
    try {
        if ($adapter->isConnected()) {
            $adapter->disconnect();
        }
    }
    catch( Exception $e ){
        echo $e->getMessage() ;
    }

//Return to homepage
    header("Location: /na4nnCCS20"); 
    exit();
?>