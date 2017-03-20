<?php
/******************************************************************************************
*******************************************************************************************
** Name: recipeFeaturesError.php												       ****
** Description: Displays error message for invalid input during recipe features 	   ****
**				submission															   ****
** Author: Rhys Hall																   ****
** Date Created: 07/24/2016														   	   ****
*******************************************************************************************
******************************************************************************************/
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/recipeFeaturesError.css">
	<head>
	
	<body>
		<?php 
			if (isset($_SESSION["emptyEthnicity"]) == true)
			{
		?>		<!--empty ethnicity field error message (if required)-->	
				<div id="ethnicity-message">
					<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>You must select at least one ethnicity feature</p>
				</div>
				
			<?php 
				unset($_SESSION["emptyEthnicity"]);
			}
			
			if (isset($_SESSION["emptyMealType"]) == true)
			{
			?>	<!--empty meal type field error message (if required)-->	
				<div id="meal-type-message">
					<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>You must select at least one meal type feature</p>
				</div>
				
			<?php 
				unset($_SESSION["emptyMealType"]);
			}
			
			if (isset($_SESSION["emptyHoliday"]) == true)
			{
			?>	<!--empty holiday field error message (if required)-->	
				<div id="holiday-message">
					<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>You must select at least one holiday feature</p>
				</div>
				
			<?php 
				unset($_SESSION["emptyHoliday"]);
			}
			?>
	</body>
</html>
