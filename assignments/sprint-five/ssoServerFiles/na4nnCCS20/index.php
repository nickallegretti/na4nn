<!--
    Name: Nick Allegretti
    Pawprint: na4nn
    Date: 5/8/2020
    Challenge: Final Project 2020


References:
    https://stackoverflow.com/questions/3237161/jquery-draggable-how-to-limit-the-draggable-area
    https://stackoverflow.com/questions/4127118/can-you-detect-dragging-in-jquery
    https://stackoverflow.com/questions/1828924/array-inside-a-javascript-object
    https://stackoverflow.com/questions/6429959/objects-inside-objects-in-javascript
    https://www.w3schools.com/sql/sql_datatypes.asp
    https://stackoverflow.com/questions/24990554/how-to-include-a-font-ttf-using-css
    https://stackoverflow.com/questions/9334636/how-to-create-a-dialog-with-yes-and-no-options
    https://www.w3schools.com/php/php_mysql_insert_lastid.asp
    https://stackoverflow.com/questions/5232310/htmlcss-how-to-force-div-contents-to-stay-in-one-line
-->




<!DOCTYPE html>
<html lang= "en">
    <head>
        <meta charset="utf-8">
	   <title>Character Creator</title>
        
        
        <link rel="stylesheet" type="text/css" href="jquery-ui-1.11.4.custom/jquery-ui.min.css">
        
        <link rel="stylesheet" href="../styles.css">
        
         <script src="jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
        <script src="jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
        
        <script src = "ccJavascript.js"></script>
        
<!--        Checks if user is signed into Google. Runs when page is loaded or refreshed-->
        <?php
            require_once 'config.php';
            try {
                $userProfile = $adapter->getUserProfile();
                
            }
            catch( Exception $e ){
                
            }
        ?>    
    </head>
    
    <body class="ccBackground" onload ="onCCLoad()">
        <div>
            
            <ul id = "ccNavbar">
                <li class = "ccName"><a>Character Creator</a></li>
                <li class = "ccTab"><a class= "hyper" href="../na4nnProjectsS20.html">Return to Projects</a></li>
                <li class = "ccTab"><a class= "hyper" href="moreInfo.html">More Info</a></li>
                
<!--                If user is logged in to Google display user's display name. If not provide a login button-->
               <?php
                    if(!$userProfile) {
                        echo '<li class = "ccTab"><a class= "hyper" onclick = "authPopup()">Login</a></li>';
                    }
                    else {
                        echo '<li class = "ccTab"><a>Logged in as </a><a class= "hyper" href= "userInfo.php">' . $userProfile->displayName . '</a></li>';
                        echo '<li class = "ccTab"><a class= "hyper" href="logout.php">Log Out</a></li>';
                    }
                ?>
                <li id = "ccSort">
                    <label for= "sortType">Sort By:</label>
                    <select id= "sortType" name= "sortBy" onchange = "updatePreviews(this.value)">
                        <option value="oldest">Oldest</option>
                        <option value="newest">Newest</option>
                    </select>
                </li>
                
            </ul>
        </div>
        
<!--        Div that contains the character previews loaded from the database-->
        <div id = "characterPreviews" class = "clearHack"></div>
        
        <div id = "CCWrapperDiv">
            
<!--            Div that contains the character creator-->
            <div id = "CCDisplayDiv">
                <img id ="characterBase" src= "media/defaultCBackground.jpg" alt = "CharacterBase">
                
<!--                Div that contains the info about the preset used and the users custom character-->
            </div>
            <div id = "CCInfoDiv">
                <h1 class ="cInfoHeader">Preset Info:</h1>
                <h2 id = "characterName" class = "cInfo">No Character Selected</h2>
                <p id = "characterDescription">Click on a preset to see its information.</p>
                
                <h1 class ="cInfoHeader">Customize Character:</h1>
                <h2 id = "partName" class = "cInfo">No Element Selected</h2>
                
                 <button class = "cCustomize" onclick="adjustPartSize(10)">++</button>
                <span class = "cCustomize">Part Size</span>
                <button class = "cCustomize" onclick="adjustPartSize(-10)">--</button>
                
                <br>
                 <label for="partHue" class = "cCustomize">Part Hue (between 0 and 360 degrees):</label>
                <input type="range" id="partHue" name="partHue" min="0" max="360" oninput = "updatePartColor(this.value, 'hue')" onchange = "setPartColor(this.value, 'hue')">
                
                <br>
                <label for="partBrightness" class = "cCustomize">Part Brightness (between 0 and 100%):</label>
                <input type="range" id="partBrightness" name="partBrightness" min="0" max="360" oninput = "updatePartColor(this.value, 'brightness')" onchange = "setPartColor(this.value, 'brightness')">
                
                <br><br>
                 <form>
                    <label for="newName" class = "cCustomize">Character's Name:</label><br>
                    <input type="text" id="newName" class = "cCustomize" name = "newName" value=""><br><br>
                     <label for="newDesc" class = "cCustomize">Character's Description:</label><br>
                     <textarea id="newDesc" class = "cCustomize" name= "newDesc" ></textarea><br><br>
                     
<!--                     If user is logged in to Google allow them to submit a character. If not prompt them to login-->
                     <?php
                        if(!$userProfile){
                            echo '<input type="button" class = "cCustomize" onclick = "loginAlert()" value="Login to Submit as Preset">';
                        }
                        else {
                            echo '<input type="button" class = "cCustomize" onclick = "submitCharacter()" value="Submit as Preset">';
                        }
                    ?>
                     
                </form> 
                
            </div>
            
        </div>
        
<!--        Footer common element Div-->
        <div id ="ccFooter"></div>
            
            
            
    </body>
</html>