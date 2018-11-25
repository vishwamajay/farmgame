<!DOCTYPE html>
<html lang="en">
<head>
<title>Simple Farm Game</title>
<meta charset="utf-8">
<meta name="viewport" content=h3"width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./css/project.css">
</head>
    <body>
	    <script type="text/javascript" src="./js/project.js"></script>
	    
	      <h2>Welcome to Simple Farm Game</h2>
	      <div id="divStartGame" name="divStartGame" border="1px solid red">
	          <input type="button" onclick="createGameMatrix()" value="Start New Game" name="startNewGame" id="startNewGame" />
	      </div><br/>
	      <div id="divContentGame" name="divContentGame">
	      	    <h3>Rules of game</h3>
	      	    <ul>
	      	    	<li>Game includes a Farmer, 2 Cows and 4 Bunny.</li> 
	      		    <li>Farmer: needs to be fed at least once every 15 turns.</li> 
	      	        <li>There are 2 Cows: each cow needs to be fed at least once every 10 turns.</li> 
                    <li>There are 4 bunnies: each bunny needs to be fed at least once every 8 turns.</li>
                    <li>If any of the animals or the farmer are not fed on time, they die.</li>
                    <li>If the farmer dies, all animals die and the game is over.</li>
                    <li>The system would randomly chooses whom to feed</li>
                    <li>The game ends after 50 turns. If the farmer and at least one cow and one bunny are still alive at that point, you win.</li>
                </ul>    
          </div>
    </body>
</html>

