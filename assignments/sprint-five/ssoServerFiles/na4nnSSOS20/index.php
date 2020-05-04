<!--
    References
    https://hybridauth.github.io/developer-ref-user-profile.html
    https://artisansweb.net/how-to-add-google-oauth-login-in-website-with-php/

    Hybridauth Open Source Software used


-->
<!DOCTYPE html>


<html lang= "en">
    <head>
        <meta charset="utf-8">
        <title>User Info</title>
        <link rel="stylesheet" href="../styles.css">
    </head>
    <body class="defaultBodyBackground">
        <div id=topButtons>
           <a href= "logout.php" id="returnToProjects">Logout</a>  
        </div>
        <div id= "ssOWrapper" class = "clearHack">
            <?php
            require_once 'config.php';
 
            try {
                $adapter->authenticate();
                $userProfile = $adapter->getUserProfile();
                
                //print_r($userProfile);
                
                echo '<div id= ssOInfoColumn>';
                    echo '<h2>Hello ' . $userProfile->displayName . '</h2>';
                    echo '<h3>User Info:<br>';
                    if($userProfile->email){
                        echo '<p class= "ssOInfoItem">Email: ' . $userProfile->email . '</p>';
                    }
                    if($userProfile->identifier){
                        echo '<p class= "ssOInfoItem">Unique Identifier: ' . $userProfile->identifier . '</p>';
                    }
                    if($userProfile->phone){
                        echo '<p class= "ssOInfoItem">Phone Number: ' . $userProfile->phone . '</p>';
                    } else {
                        echo '<p class= "ssOInfoItem">No Phone Number Linked to Account Found.</p>';
                    }
                    if($userProfile->age){
                        echo '<p class= "ssOInfoItem">Age: ' . $userProfile->age . '</p>';
                    }
                    if($userProfile->birthDay and $userProfile->birthMonth and $userProfile->birthYear){
                        echo '<p class= "ssOInfoItem">Birthday: ' . $userProfile->birthMonth . ' ' . $userProfile->birthDay . ', ' . $userProfile->birthYear . '</p>';
                    } else {
                        echo '<p class= "ssOInfoItem">No Birthday Linked to Account Found.</p>';
                    }
                    if($userProfile->address and $userProfile->country and $userProfile->city and $userProfile->region and $userProfile->zip){
                        echo '<p class= "ssOInfoItem">Address: ' . $userProfile->address . ' ' . $userProfile->city . ', ' . $userProfile->region . ', ' . $userProfile->country . ', ' . $userProfile->zip . '</p>';
                    } else {
                        echo '<p class= "ssOInfoItem">No Address Linked to Account Found.</p>';
                    }
                
                echo '</div>';
                echo '<div id= "ssOProfileColumn">';
                if($userProfile->photoURL) {
                    echo '<img id= "ssOProfilePicture" src= ' . $userProfile->photoURL . ' alt= "ProfileImage">';
                } else {
                    echo '<img id= "ssOProfilePicture" src= "UserIcon.jpg" alt= "ProfileImage">';
                    echo '<p>No Profile Picture Linked to Account Found.<p>';
                }
                echo '</div>';
                
                
                //echo '<a href="logout.php">Logout</a>';
            }
            catch( Exception $e ){
                echo $e->getMessage() ;
            }
            ?>
        </div>
    </body>