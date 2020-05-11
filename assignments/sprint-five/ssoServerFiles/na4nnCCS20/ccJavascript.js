var previewMode = true;
            
            var activePart;
            
            
// Opens Google login popup
            function authPopup(){
                // replace 'path/to/hybridauth' with the real path to this script
                var authWindow = window.open('login.php?', 'authWindow', 'width=600,height=400,scrollbars=yes');
                return false;
            }
            
          

            
// Loads characters from database into preview div. Takes sort by parameter            
            function loadCharacters(sortType) {
                var xmlhttp = new XMLHttpRequest();
                
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var cObject = JSON.parse(xmlhttp.responseText);
                        for( var i= 0; i < cObject.characters.length; i++){
                           
                            var cDiv = document.createElement("div");
                            cDiv.setAttribute("style","width:110px;height:96%;display:inline-block;margin: 0px 2px 0px 0px;border-style: solid;border-height:2%;border-color:#808080;background-color:lightgrey;white-space:nowrap;cursor:pointer");
                            cDiv.id = "preview" + i;
                            
                            
                            
                            var name =cObject.characters[i].cName;
                            
                            
                            
                            
                            var cPreview = document.createElement("img");
                            cPreview.src = cObject.characters[i].cBaseImageURL;
                            cPreview.setAttribute("style", "height:80%;width:100%;display:inline;margin: 0px;padding-bottom:-3px");
                            
                             cDiv.onclick =function() {
                                 
                                 if(!previewMode) {
                                     if(confirm("You have unsaved changes. Continue?")) {
        
                                       loadCharacter(this);
                                         
                                         
                                     }
                                 }
                                 else{
                                        
                                     loadCharacter(this);
                                 }
                                
                            };
                            
                            
                            cDiv.onmouseover = function(){
                                
                                this.childNodes[0].style.color = "white";
//                                this.style.cursor = "pointer";
                                
                            };
                            
                            cDiv.onmouseout = function() {
                                
                                this.childNodes[0].style.color = "gray";
//                                this.style.cursor = "auto";
                            }
                            
                            
                            var cName = document.createElement("p");
                            cName.innerHTML = cObject.characters[i].cName;
                            cName.setAttribute("style", "height:25%;margin: 0px;color:gray;width: 110px;font-size:17px;word-wrap: breakword;overflow-x: auto;overflow-y: hidden");
                            
                            
                            var cData = document.createElement("span");
                            cData.setAttribute("style","width:0%;visibility:collapse;position: absolute");
                            cData.innerHTML = JSON.stringify(cObject.characters[i]);
                            
                            
                            cDiv.appendChild(cName);
                            cDiv.appendChild(cPreview);
                            cDiv.appendChild(cData);
                            
                            
                            document.getElementById("characterPreviews").appendChild(cDiv);
                            
                            

                            
                        }
                        
                        document.getElementById("demo").innerHTML = cObject.characters[i].cBaseImageURL;
                    }
                    
                };
                xmlhttp.open("GET", "getCharacters.php?sortBy=" + sortType, true);
                xmlhttp.send();
            }
            
// Loads selected character from preview div into character editor
            function loadCharacter(cDiv) {
                
                var previewData = JSON.parse(cDiv.childNodes[2].innerHTML);
                document.getElementById("characterBase").src = previewData.cBaseImageURL;
                document.getElementById("characterName").innerHTML= previewData.cName;
                document.getElementById("characterDescription").innerHTML= previewData.cDescription;
                                     
                clearParts();
                loadParts(previewData.cId);
                document.getElementById("partName").innerHTML = "No Element Selected";
                previewMode = true;
            }
            
// Clears characters from preview div
            function clearCharacters(){
                var cPreviews = document.getElementById("characterPreviews").childNodes;
                for(var i = cPreviews.length -1 ; i >= 0 ; i--) {
                    document.getElementById("characterPreviews").removeChild(cPreviews[i]);
                }
            }
            
// Clears preview div, then reloads characters into preview div
            function updatePreviews(sortType) {
                clearCharacters();
                loadCharacters(sortType);
            }
            
// Loads part data from database and adds them to character creator
            function loadParts(cId) {
                var xmlhttp = new XMLHttpRequest();
                
                xmlhttp.onreadystatechange = function() {
                    
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var pObject = JSON.parse(xmlhttp.responseText);
                        for( var i= 0; i < pObject.parts.length; i++) {
                            
                            var pDiv = document.createElement("div");
                            document.getElementById("CCDisplayDiv").appendChild(pDiv);
                            pDiv.setAttribute("style", "width:" +pObject.parts[i].pWidth +"px;cursor:pointer");
                            pDiv.style.position = "absolute";
                            var pDivLeft = pObject.parts[i].pLeft+'px';

                            pDiv.style.left = pObject.parts[i].pLeft+'px';
                                
                            pDiv.style.top = pObject.parts[i].pTop+'px';
                            
                            
                            pDiv.id = "part"+i;
                            pDiv.class = "activePart";
                            
    
                            var pData = document.createElement("span");
                            pData.setAttribute("style","width:0%;visibility:collapse;position:absolute");
                            pData.innerHTML = JSON.stringify(pObject.parts[i]);
                            pDiv.appendChild(pData);
                            
                            var pBase = document.createElement("img");
                            pBase.setAttribute("style","width: 100%");
                            pBase.src = pObject.parts[i].pBaseImageURL;
                            pDiv.appendChild(pBase);
                            
                            
                            if(pObject.parts[i].pColorImageURL) {
                                var pColor = document.createElement("img");
                                pColor.setAttribute("style","left: 0%;position: absolute; width: 100%");
                                pColor.src = pObject.parts[i].pColorImageURL;                            
                                pColor.style.filter= "brightness("+ pObject.parts[i].pBrightness + "%) sepia(100%) hue-rotate(" + pObject.parts[i].pHue + "deg)";
                                pDiv.appendChild(pColor);
                            }
                            
                        
                    // Adds the JQuery UI function "draggable" to each part to allow the user to move them around the creator
                            $("#"+pDiv.id).draggable({
                                containment: "parent",
                                stop: function() {
                                    var pData = JSON.parse(this.childNodes[0].innerHTML);
                                    pData.pLeft = parseInt(this.style.left.substring(0,this.style.left.length-2), 10);
                                    pData.pTop = parseInt(this.style.top.substring(0,this.style.top.length-2), 10);
                                    
                                    this.childNodes[0].innerHTML= JSON.stringify(pData);
                                }
                            });
                            
                    // On drag or click, the part customization inputs will be set to edit the clicked or dragged part
                            $("#"+pDiv.id).mousedown(function() {
                                previewMode = false;
                                
                                var pData = JSON.parse(this.childNodes[0].innerHTML);
                                document.getElementById("partName").innerHTML = pData.pName;
                                document.getElementById("partHue").value = pData.pHue;
                                document.getElementById("partBrightness").value = pData.pBrightness;
                                activePart = this;
                                
                                
                                
                            });
                        }
                    }

                };
                xmlhttp.open("GET", "getParts.php?cId=" + cId, true);
                xmlhttp.send();
            }
                
// Removes all parts from the character creator. Called when loading a new character preset
            function clearParts() {
                var activeDisplay = document.getElementById("CCDisplayDiv").childNodes;
                
                for(var j = 0; j < activeDisplay.length; j++){
                    for(var i = 0 ; i< activeDisplay.length; i++) {
                        if(activeDisplay[i].class == "activePart")
                            {
                            
                                activeDisplay[i].id = "";
                                document.getElementById("CCDisplayDiv").removeChild(activeDisplay[i]);
                            
                            }
                        
                    }
                }
                
                
            }
            
// Offsets the width of the active part by the value passed in
            function adjustPartSize(addWidth){
                var newWidth = addWidth + parseInt(activePart.style.width.substring(0,activePart.style.width.length-2),10);
                activePart.style.width = newWidth +'px';
                
                var pData = JSON.parse(activePart.childNodes[0].innerHTML);
                pData.pWidth = newWidth;
                                
                activePart.childNodes[0].innerHTML = JSON.stringify(pData);    
            }
            
            function updatePartColor(newColor, adjustType) {
                var pData = JSON.parse(activePart.childNodes[0].innerHTML);
                
                if(adjustType == 'hue'){
                    activePart.childNodes[2].style.filter= "brightness("+ pData.pBrightness + "%) sepia(100%) hue-rotate(" + newColor + "deg)";
                }
                else if(adjustType == 'brightness') {
                    activePart.childNodes[2].style.filter= "brightness("+ newColor + "%) sepia(100%) hue-rotate(" + pData.pHue + "deg)";
                }
            }
            
// Sets the color value in the part data to match the value of the part in the creator
            function setPartColor(newColor, adjustType) {
                var pData = JSON.parse(activePart.childNodes[0].innerHTML); 
                
                
                
                if(adjustType == 'hue'){
                    pData.pHue = newColor;
                }
                else if(adjustType == 'brightness') {
                    pData.pBrightness = newColor;
                }
                
                activePart.childNodes[0].innerHTML = JSON.stringify(pData);
            }
            
// Converts all in use parts into a JSON
            function compileParts() {
                
                var activeParts = document.getElementById("CCDisplayDiv").childNodes;
                
                var cJSON = '[';
                
                for(var i = 0; i < activeParts.length; i++){
                    if(activeParts[i].class == "activePart") {
                        cJSON += activeParts[i].childNodes[0].innerHTML;
                        
                        if( i+1 < activeParts.length) {
                            cJSON += ',';
                        }
                    }
                }
                cJSON += ']';
                    
                    
                return cJSON;
            }
            
// Converts active character into a JSON
            function compileCharacter() {
                var cJSON = '{"cName":"' + document.getElementById("newName").value
                    + '","cDescription":"' + document.getElementById("newDesc").value
                    + '","cBaseImageURL":"' + document.getElementById("characterBase").src
                    +'"}';
                return cJSON;
            }
            
// Alerts user to login. If user is not logged in this will run instead of submit character
            function loginAlert() {
                window.alert("Please log in to submit character to database.");
            }
            
// Submits compiled parts and character to database. Uses JQuery, ajax and POST
           function submitCharacter() {
               var cJSON;
               if((document.getElementById("newName").value != "") && (document.getElementById("newDesc").value != "") && !previewMode) {
                   
                   cJSON = compileCharacter();
                   
                   
                   $.ajax({
                       type: 'POST',
                       url: 'postCharacter.php',
                       data: {"cParts" : compileParts(),
                             "character" : compileCharacter()},
                       success: function(data)
                        {
                            document.getElementById("newName").value = "";
                            document.getElementById("newDesc").value = "";
                            window.alert(data);
                            
                            updatePreviews(document.getElementById("sortType").value);
                            previewMode = true;
                        }
                       
                   });
               }
               else {
                   window.alert("Please ensure your character does not match the preset and that a name and description have been entered.");
               }
           }

//Adds common element ccFooter.html to each page with the id 'ccFooter' (index.php, moreInfo.html)
            $(function(){
                $("#ccFooter").load("ccFooter.html");
            });

//Onload function for index.html. Wraps the loadCharacters function
            function onCCLoad() {
                loadCharacters(document.getElementById("sortType").value);
            }
            
