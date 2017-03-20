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
		?>		
				<!--display existing email error message-->
				<div id="email-exists-error-panel">
					<img id="email-exists-speech-bubble" src="/RecipeFish/images/standard/error speech bubble.png">
							
					<p id="email-exists-speech-text">A user has already registered with the given email</p>
				</div>
				
			<?php 
				unset($_SESSION["registerEmailExists"]);
			}
			?>
	</body>
</html>