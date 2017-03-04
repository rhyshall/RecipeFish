<?php
/******************************************************************************************
*******************************************************************************************
** Name: registerEmailError.php												           ****
** Description: Displays error message for duplicate email during registration (if 	   ****
** 				necessary)				   											   ****
** Author: Rhys Hall																   ****
** Date Created: 05/01/2016														   	   ****
*******************************************************************************************
******************************************************************************************/
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/registerEmailError.css">
	<head>
	
	<body>
		<!--existing email error message (if required)-->
		<?php 
			if (isset($_SESSION["registerEmailExists"]) == true)
			{
		?>		<!--existing email message-->
				<div id="existing-email-message">
					<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>A user has already registered with the given email</p>
				</div>
				
			<?php 
				unset($_SESSION["registerEmailExists"]);
			}
			?>
	</body>
</html>