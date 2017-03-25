<?php
/******************************************************************************************
*******************************************************************************************
** Name: recipeTimesError.php											   			   ****
** Description: Displays error message for invalid input during recipe times           ****
**				submission															   ****
** Author: Rhys Hall																   ****
** Date Created: 03/24/2017														   	   ****
*******************************************************************************************
******************************************************************************************/
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/recipeTimesError.css">
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
			?>
	</body>
</html>