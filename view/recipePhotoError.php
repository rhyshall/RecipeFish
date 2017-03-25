<?php
/******************************************************************************************
*******************************************************************************************
** Name: recipePhotoError.php											   			   ****
** Description: Displays error message for invalid input during recipe photo 		   ****
**				submission												   			   ****
** Author: Rhys Hall																   ****
** Date Created: 03/24/2017														   	   ****
*******************************************************************************************
******************************************************************************************/
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/recipePhotoError.css">
	<head>
	
	<body>
		<?php 
			if (isset($_SESSION["emptyField"]) == true)
			{
		?>		<!--empty field(s) error message (if required)-->	
				<div id="empty-field-message">
					<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>You have not selected a photo</p>
				</div>
				
			<?php 
				unset($_SESSION["emptyField"]);
			}
			
			if (isset($_SESSION["imageTypeInvalid"]) == true)
			{
			?>	<!--image file type error message (if required)-->
				<div id="image-type-message">
					<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>Selected photo is not a valid image file</p>
				</div>
					
			<?php 
				unset($_SESSION["imageTypeInvalid"]);
			}
			
			if (isset($_SESSION["imageSizeInvalid"]) == true)
			{
			?>	<!--image size error message (if required)-->
				<div id="image-size-message">
					<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>Image height & width must be between 256px and 1280px</p>
				</div>
					
			<?php 
				unset($_SESSION["imageSizeInvalid"]);
			}
			?>
	</body>
</html>
