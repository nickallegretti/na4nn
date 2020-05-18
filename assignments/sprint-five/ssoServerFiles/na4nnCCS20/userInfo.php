<!DOCTYPE html>


<html lang= "en">
    <head>
        <meta charset="utf-8">
        <title>User Info</title>
        
        <script src="jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
        <script src="jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
        
        
        <script src = "ccJavascript.js"></script>
        <link rel="stylesheet" href="../styles.css">
        
        <?php
            require_once 'config.php';
            require_once "db.conf";
            
            $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
        
            try {
                $adapter->authenticate();
                $userProfile = $adapter->getUserProfile();

                
            }
            catch( Exception $e ){
              header("Location: /na4nnFinalS20"); 
                exit();  
            }
        
        
        ?>    
        
    </head>
    <body class="ccBackground">
        
        <div>
            
                <ul id = "ccNavbar">
                    
                    <?php
                        echo '<li class = "ccName"><a>Hello ' . $userProfile->displayName . '</a></li>';
                    ?>
                    <li class = "ccTab"><a class= "hyper" href="/na4nnCCS20">Home</a></li>
                    <li class = "ccTab"><a class= "hyper" href="moreInfo.html">More Info</a></li>
                
<!--                If user is logged in to Google display user's display name. If not provide a login button-->
                
                    <li class = "ccTab"><a class= "hyper" href="logout.php">Log Out</a></li>
                   
                </ul>
            </div>  
        
        <div id= "ccUserInfoWrapper" class = "clearHack">
            <div id= ssOInfoColumn>
                
                <h2>User Info:</h2>
                
                <?php
                    if($userProfile->identifier) {
                        $sql = 'SELECT COUNT(*), SUM(cLikes) FROM characterData WHERE uId = "' . $userProfile->identifier . '"';
                        $result = $mysqli->query($sql);
                        $data= $result->fetch_array();
                        echo '<p class= "ssOInfoItem">You have made ' . $data[0] . ' presets</p>';
                        echo '<p class= "ssOInfoItem">You have ' . $data[1] . ' likes</p>';
                        
                        

                    }
                
                    if($userProfile->email){
                        echo '<p class= "ssOInfoItem">Email: ' . $userProfile->email . '</p>';
                    }
                
                // Close the result set
//                $result->close();
                // Close the database connection
                $mysqli->close();
                ?>
                        
            </div>
            <div id= "ccProfileColumn">
                <?php
                if($userProfile->photoURL) {
                    echo '<img id= "ssOProfilePicture" src= ' . $userProfile->photoURL . ' alt= "ProfileImage">';
                } else {
                    echo '<img id= "ssOProfilePicture" src= "UserIcon.jpg" alt= "ProfileImage">';
                echo '<p>No Profile Picture Linked to Account Found.</p>';
                }
               ?>
            </div>
        
        
        </div>

        
    </body>