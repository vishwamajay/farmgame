
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