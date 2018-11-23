
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

function feedFarmerAnimal(){
        ajaxRequestObject = createAjaxObject();	

        ajaxRequestObject.onreadystatechange = function(){
           if(ajaxRequestObject.readyState == 4){
                if(ajaxRequestObject.responseText == 'FCE'){
                    alert('Sorry you have exceeded the feed limit, Start a New game');
                    //Disable click to feed button 
                    document.getElementById('feedFarmerAnimal').disabled = true;
                }
                else if(ajaxRequestObject.responseText == 'FDGO'){
                    alert('Sorry Farmer died, Game Over - Start a New game');
                    //Disable click to feed button 
                    document.getElementById('feedFarmerAnimal').disabled = true;
                }
                else{
                    //alert(ajaxRequestObject.responseText);
                    //var ajaxDisplay = document.getElementById(ajaxRequestObject.responseText);
                    var arrDisplay = ajaxRequestObject.responseText.split('|');
                    alert(arrDisplay[1] +'==='+arrDisplay[0]);

                    var ajaxDisplay = document.getElementById(arrDisplay[0]);
                    ajaxDisplay.innerHTML = 'Fed';
                    ajaxDisplay.style.fontStyle = "italic"
                    ajaxDisplay.style.backgroundColor = "#33ff33"; 
                }
            }
        }
        
        var date = new Date();
        var timestamp = date.getTime();
		var queryString = "?tmp=" + timestamp ;
        ajaxRequestObject.open("GET", "feedFarmerAnimals.php" + queryString, true);
        ajaxRequestObject.send(null);  	
}