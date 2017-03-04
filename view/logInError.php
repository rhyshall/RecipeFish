<?php
/******************************************************************************************
*******************************************************************************************
** Name: logInError.php												       		       ****
** Description: Displays error message for empty field(s) and invalid email/password   ****
** 				combination during log-in (if necessary)					   		   ****
** Author: Rhys Hall																   ****
** Date Created: 05/02/2016														   	   ****
*******************************************************************************************
******************************************************************************************/
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/logInError.css">
	<head>
	
	<body>
		<?php 
			if (isset($_SESSION["emptyField"]) == true)
			{
		?>		<!--empty field(s) error message (if required)-->	
				<div id="empty-field-message">
					<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>Email and password must both be entered</p>
				</div>
				
			<?php 
				unset($_SESSION["emptyField"]);
			}
			
			else
			{
				if (isset($_SESSION["nonExistingEmail"]) == true)
				{
			?>		<!--invalid log-in error message (if required)-->
					<div id="exist-message">
						<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>The given email is not registered</p>
					</div>
					
				<?php 
					unset($_SESSION["nonExistingEmail"]);
				}
				
				else 
				{
					if (isset($_SESSION["combinationInvalid"]) == true)
					{
				?>		<!--invalid log-in error message (if required)-->
						<div id="invalid-message">
							<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>Invalid password....try again</p>
						</div>
					
					<?php 
						unset($_SESSION["combinationInvalid"]);
					}
				}
			}
				?>
	</body>
</html>
