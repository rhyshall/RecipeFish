<?php
/******************************************************************************************
*******************************************************************************************
** Name: recipeCharacterizationError.php											   ****
** Description: Displays error message for invalid input during recipe name and 	   ****
**				description submission												   ****
** Author: Rhys Hall																   ****
** Date Created: 03/24/2017														   	   ****
*******************************************************************************************
******************************************************************************************/
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/recipeCharacterizationError.css">
	<head>
	
	<body>
		<?php 
			if (isset($_SESSION["emptyField"]) == true)
			{
		?>		<!--display empty field(s) error message-->
				<div id="empty-panel">
					<img id="empty-speech-bubble" src="/RecipeFish/images/standard/error speech bubble.png">
							
					<p id="empty-speech-text">One or more fields were left empty</p>
				</div>
				
			<?php 
				unset($_SESSION["emptyField"]);
			}
			
			if (isset($_SESSION["nameLengthInvalid"]) == true)
			{
			?>	<!--display invalid name length error message-->
				<div id="name-length-panel">
					<img id="name-length-speech-bubble" src="/RecipeFish/images/standard/error speech bubble.png">
							
					<p id="name-length-speech-text">Name may only contain a maximum of 40 characters</p>
				</div>
					
			<?php 
				unset($_SESSION["nameLengthInvalid"]);
			}
			
			if (isset($_SESSION["nameSymbolsInvalid"]) == true)
			{
			?>	<!--display invalid name symbols error message-->
				<div id="name-symbols-panel">
					<img id="name-symbols-speech-bubble" src="/RecipeFish/images/standard/error speech bubble.png">
							
					<p id="name-symbols-speech-text1">Name may only consist of symbols [A-Z],</p>
					<p id="name-symbols-speech-text2">[a-z], [0-9], "-", " ' " and space</p>
				</div>
					
			<?php 
				unset($_SESSION["nameSymbolsInvalid"]);
			}
			
			if (isset($_SESSION["descriptionLengthInvalid"]) == true)
			{
			?>	<!--display empty field(s) error message-->
				<div id="description-length-panel">
					<img id="description-length-speech-bubble" src="/RecipeFish/images/standard/error speech bubble.png">
							
					<p id="description-length-speech-text1">Description may only contain a maximum of</p>
					<p id="description-length-speech-text2">500 characters</p>
				</div>
					
			<?php 
				unset($_SESSION["descriptionLengthInvalid"]);
			}
			?>
	</body>
</html>
