<?php
/******************************************************************************************
*******************************************************************************************
** Name: registerGeneralError.php												       ****
** Description: Displays error message for empty field(s) and password/confirm 		   ****
** 				password mismatch during registration (if necessary)				   ****
** Author: Rhys Hall																   ****
** Date Created: 05/01/2016														   	   ****
*******************************************************************************************
******************************************************************************************/
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/registerGeneralError.css">
	<head>
	
	<body>
		<?php 
			if (isset($_SESSION["emptyField"]) == true)
			{
		?>		
				<!--display empty field(s) error message-->
				<div id="empty-error-panel">
					<img id="empty-error-speech-bubble" src="/RecipeFish/images/standard/error speech bubble.png">
							
					<p id="empty-error-speech-text">One or more fields were left empty</p>
				</div>
				
			<?php 
				unset($_SESSION["emptyField"]);
			}
			
			else
			{
				if (isset($_SESSION["passwordConfirmInvalid"]) == true)
				{
			?>		
					<!--password confirmation error message (if required)-->
					<div id="confirm-error-panel">
						<img id="confirm-error-speech-bubble" src="/RecipeFish/images/standard/error speech bubble.png">
								
						<p id="confirm-error-speech-text">Confirmed password does not match password</p>
					</div>
					
				<?php 
					unset($_SESSION["passwordConfirmInvalid"]);
				}
			}
				?>
	</body>
</html>
