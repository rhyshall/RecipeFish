<?php
/******************************************************************************************
*******************************************************************************************
** Name: ingredientCountError.php												       ****
** Description: Displays error message for invalid ingredient count during ingredient  ****
**              input				   												   ****
** Author: Rhys Hall																   ****
** Date Created: 08/14/2016														   	   ****
*******************************************************************************************
******************************************************************************************/
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/ingredientCountError.css">
	<head>
	
	<body>
		<?php 
			if (isset($_SESSION["invalidIngredientCount"]) == true)
			{
		?>		<!--ingredient count error message (if required)-->	
				<div id="ingredient-count-message">
					<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>Two or more ingredients must be entered</p>
				</div>
				
			<?php 
				unset($_SESSION["invalidIngredientCount"]);
			}
			?>
	</body>
</html>
