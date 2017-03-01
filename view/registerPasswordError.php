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
		<link rel="stylesheet" type="text/css" href="/RecipeMingle/stylesheets/registerPasswordError.css">
	<head>
	
	<body>
		<!--password error messages (if required)-->
		<?php
			if (isset($_SESSION["passwordLengthInvalid"]) == true)
			{
		?>		<!--invalid password length message-->
				<div id="password-length-message">
					<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>Password must be 6-25 characters</p>
				</div>
			
			<?php 
				unset($_SESSION["passwordLengthInvalid"]);
			}
			
			else 
			{
				if (isset($_SESSION["passwordSymbolsInvalid"]) == true)
				{
			?>		<!--invalid password symbols message-->
					<div id="password-symbols-message">
						<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>Password may not contain any spacing</p>
					</div>
					
				<?php 
					unset($_SESSION["passwordSymbolsInvalid"]);
				}
			}
				?>
	</body>
</html>