<?php
/******************************************************************************************
*******************************************************************************************
** Name: registerUsernameError.php												       ****
** Description: Displays error message for duplicate and length/symbolic username 	   ****
**				error(s) during registration (if necessary)							   ****
** Author: Rhys Hall																   ****
** Date Created: 05/01/2016														   	   ****
*******************************************************************************************
******************************************************************************************/
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/registerUsernameError.css">
	<head>
	
	<body>
		<!--username error messages (if required)-->
		<?php 
			if (isset($_SESSION["registerUsernameInvalid"]) == true)
			{
		?>		
				<!--display invalid username error message-->
				<div id="username-invalid-error-panel">
					<img id="username-invalid-speech-bubble" src="/RecipeFish/images/standard/error speech bubble.png">
							
					<p id="username-invalid-speech-text1">Username may only have 1-20 characters and consist</p>
					<p id="username-invalid-speech-text2">of symbols [A-Z], [a-z], [0-9], "-" and "_"</p>
				</div>
				
		<?php 
				unset($_SESSION["registerUsernameInvalid"]);
			}
				
			else 
			{
				if (isset($_SESSION["registerUsernameExists"]) == true)
				{
				?>		
					<!--display existing username error message-->
					<div id="username-exists-error-panel">
						<img id="username-exists-speech-bubble" src="/RecipeFish/images/standard/error speech bubble.png">
								
						<p id="username-exists-speech-text">The given username has already been taken</p>
					</div>
				<?php 
						unset($_SESSION["registerUsernameExists"]);
					}
				}
			?>
	</body>
</html>
