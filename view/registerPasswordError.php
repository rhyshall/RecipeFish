<?php
/******************************************************************************************
*******************************************************************************************
** Name: registerPasswordError.php												       ****
** Description: Displays error message for length or symbolic password error(s) during **** 
** 				registration (if necessary)											   ****
** Author: Rhys Hall																   ****
** Date Created: 04/30/2016														   	   ****
*******************************************************************************************
******************************************************************************************/
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/registerPasswordError.css">
	<head>
	
	<body>
		<!--password error messages (if required)-->
		<?php
			if (isset($_SESSION["passwordLengthInvalid"]) == true)
			{
		?>		
				<!--display invalid password length message-->
				<div id="password-length-error-panel">
					<img id="password-length-speech-bubble" src="/RecipeFish/images/standard/error speech bubble.png">
							
					<p id="password-length-speech-text">Password may only consist of 6-25 characters</p>
				</div>
			
			<?php 
				unset($_SESSION["passwordLengthInvalid"]);
			}
			
			else 
			{
				if (isset($_SESSION["passwordSymbolsInvalid"]) == true)
				{
			?>		
					<!--display invalid password symbols message-->
					<div id="password-symbols-error-panel">
						<img id="password-symbols-speech-bubble" src="/RecipeFish/images/standard/error speech bubble.png">
								
						<p id="password-symbols-speech-text">Password may not contain any spaces</p>
					</div>
					
				<?php 
					unset($_SESSION["passwordSymbolsInvalid"]);
				}
			}
				?>
	</body>
</html>
