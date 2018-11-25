/**
Usage : create and return XMLHttpRequest Object for Ajax operations
**/
function createAjaxObject(){
   var ajaxRequestObject;
               
    try {
        // Opera 8.0+, Firefox, Safari
        ajaxRequestObject = new XMLHttpRequest();
    }
    catch (e) {
        // Internet Explorer Browsers
        try {
            ajaxRequestObject = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e) {
                try{
                    ajaxRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
                }
                catch (e){
                        alert("Your browser not working!");
                        return false;
                }
        }
    }
    return ajaxRequestObject;
}    

/**
Usage : Ajax function call to create and return intial game matrix 
**/
               
function createGameMatrix(){
        ajaxRequestObject = createAjaxObject();	

        ajaxRequestObject.onreadystatechange = function(){
           if(ajaxRequestObject.readyState == 4){
                var ajaxDisplay = document.getElementById('divContentGame');
                ajaxDisplay.innerHTML = ajaxRequestObject.responseText;
            }
        }
        
        var date = new Date();
        var timestamp = date.getTime();
		var queryString = "?tmp=" + timestamp ;
        ajaxRequestObject.open("GET", "gameMatrix.php" + queryString, true);
        ajaxRequestObject.send(null); 
}

/**
Usage : Ajax function call to set and return fed to and isAlive farmers/animals 
**/
function feedFarmerAnimal(){
        ajaxRequestObject = createAjaxObject();	

        ajaxRequestObject.onreadystatechange = function(){
           if(ajaxRequestObject.readyState == 4){
                if(ajaxRequestObject.responseText == 'FCE'){//This would indicate max feed counter exceeded
                    alert('Sorry you have exceeded the feed limit, Start a New game');
                    //Disable click to feed button 
                    document.getElementById('feedFarmerAnimal').disabled = true;
                }
                else{
                    var arrDisplay = ajaxRequestObject.responseText.split('|');
                    //alert(arrDisplay[0]+ ' == '+arrDisplay[1]+ ' == '+arrDisplay[2]);
                    
                    var ajaxDisplay = document.getElementById(arrDisplay[0]);
                    ajaxDisplay.innerHTML = 'Fed';
                    ajaxDisplay.style.fontStyle = "italic"
                    ajaxDisplay.style.backgroundColor = "#33ff33";

                    if(arrDisplay[1] == 'FOAD'){
                        var arrDeadIds = arrDisplay[2].split('~');
                        for(var intIterator = 0; intIterator < arrDeadIds.length; intIterator++) {
                            var intDeadId = arrDeadIds[intIterator];
                            //alert('DeadId == '+intDeadId);
                            if(intDeadId!=''){
                                var ajaxDisplay = document.getElementById('type_'+intDeadId);
                                ajaxDisplay.style.backgroundColor = "#e60000";
                                ajaxDisplay.style.color = "#ffffff";

                                if(intDeadId == 1){ //Check if farmer died then game over
                                    document.getElementById('feedFarmerAnimal').disabled = true;
                                    alert('Sorry Farmer died, Game Over - Start a New game');
                                }
                            }
                        }
                        
                        if(arrDisplay[3]!=''){
                            alert(arrDisplay[3]);
                        }   

                    }
                    else if(arrDisplay[1] == 'GFDS'){
                        var ajaxDisplay = document.getElementById('gameSummary');
                        ajaxDisplay.innerHTML = arrDisplay[2];
                        ajaxDisplay.style.display = '';
                        //Disable click to feed button 
                        document.getElementById('feedFarmerAnimal').disabled = true;
                    }    
                }
            }
        }
        
        var date = new Date();
        var timestamp = date.getTime();
		var queryString = "?tmp=" + timestamp ;
        ajaxRequestObject.open("GET", "feedFarmerAnimals.php" + queryString, true);
        ajaxRequestObject.send(null);  	
}