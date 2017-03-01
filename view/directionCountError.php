<?php
/******************************************************************************************
*******************************************************************************************
** Name: directionCountError.php												       ****
** Description: Displays error message for invalid direction count during direction    ****
**              input				   												   ****
** Author: Rhys Hall																   ****
** Date Created: 08/23/2016														   	   ****
*******************************************************************************************
******************************************************************************************/
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeMingle/stylesheets/directionCountError.css">
	<head>
	
	<body>
		<?php 
			if (isset($_SESSION["invalidDirectionCount"]) == true)
			{
		?>		<!--direction count error message (if required)-->	
				<div id="direction-count-message">
					<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>At least one direction must be entered</p>
				</div>
				
			<?php 
				unset($_SESSION["invalidDirectionCount"]);
			}
			?>
	</body>
</html>
