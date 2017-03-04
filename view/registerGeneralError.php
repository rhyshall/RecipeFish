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
		?>		<!--empty field(s) error message (if required)-->	
				<div id="empty-field-message">
					<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>One or more fields were left empty</p>
				</div>
				
			<?php 
				unset($_SESSION["emptyField"]);
			}
			
			else
			{
				if (isset($_SESSION["passwordConfirmInvalid"]) == true)
				{
			?>		<!--password confirmation error message (if required)-->
					<div id="confirm-message">
						<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>Confirmed password does not match password</p>
					</div>
					
				<?php 
					unset($_SESSION["passwordConfirmInvalid"]);
				}
			}
				?>
	</body>
</html>
