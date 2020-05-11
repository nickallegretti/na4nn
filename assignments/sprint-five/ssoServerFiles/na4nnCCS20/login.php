<?php
    require_once 'config.php';

//Prompts user with login 
    try {
        $adapter->authenticate();
        $userProfile = $adapter->getUserProfile();
        print_r($userProfile);
        
    //If login successful reloads home page to show username and closes popup window
        echo "
            <script>
                window.opener.location.reload();
                window.close();
            </script>";
        echo "<h1>" . $userProfile . "</h1>";
    }

//If login fails
     catch( Exception $e ){
        echo $e->getMessage() ;
    }

?>