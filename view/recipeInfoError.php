<?php
/******************************************************************************************
*******************************************************************************************
** Name: recipeInfoError.php												           ****
** Description: Displays error message for invalid input during recipe header info 	   ****
**				submission															   ****
** Author: Rhys Hall																   ****
** Date Created: 07/17/2016														   	   ****
*******************************************************************************************
******************************************************************************************/
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/recipeInfoError.css">
	<head>
	
	<body>
		<?php 
			if (isset($_SESSION["emptyField"]) == true)
			{
		?>		<!--empty field(s) error message (if required)-->	
				<div id="empty-field-message">
					<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>One or more fields were left empty</p>
				</div>
				
			<?php 
				unset($_SESSION["emptyField"]);
			}
			
			if (isset($_SESSION["nameLengthInvalid"]) == true)
			{
			?>	<!--recipe name length error message (if required)-->
				<div id="name-length-message">
					<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>Recipe name may only contain 1-40 characters</p>
				</div>
					
			<?php 
				unset($_SESSION["nameLengthInvalid"]);
			}
			
			if (isset($_SESSION["nameSymbolsInvalid"]) == true)
			{
			?>	<!--recipe name symbols error message (if required)-->
				<div id="name-symbols-message">
					<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>Recipe name may only consist of symbols [A-Z], [a-z], [0-9], "-", " ' " and space</p>
				</div>
					
			<?php 
				unset($_SESSION["nameSymbolsInvalid"]);
			}
			
			if (isset($_SESSION["descriptionLengthInvalid"]) == true)
			{
			?>	<!--recipe name symbols error message (if required)-->
				<div id="description-length-message">
					<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>Recipe description may only contain 1-500 characters</p>
				</div>
					
			<?php 
				unset($_SESSION["descriptionLengthInvalid"]);
			}
			
			if (isset($_SESSION["imageTypeInvalid"]) == true)
			{
			?>	<!--image file type error message (if required)-->
				<div id="image-type-message">
					<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>Chosen recipe photo not valid image file</p>
				</div>
					
			<?php 
				unset($_SESSION["imageTypeInvalid"]);
			}
			
			if (isset($_SESSION["imageSizeInvalid"]) == true)
			{
			?>	<!--image size error message (if required)-->
				<div id="image-size-message">
					<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>Recipe image must have height and width between 256px and 1280px</p>
				</div>
					
			<?php 
				unset($_SESSION["imageSizeInvalid"]);
			}
			?>
	</body>
</html>
