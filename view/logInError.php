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
		?>		
				<!--display empty field(s) error message-->
				<div id="empty-error-panel">
					<img id="empty-error-speech-bubble" src="/RecipeFish/images/standard/error speech bubble.png">
							
					<p id="empty-error-speech-text">Email and password must both be entered</p>
				</div>
				
			<?php 
				unset($_SESSION["emptyField"]);
			}
			
			else
			{
				if (isset($_SESSION["nonExistingEmail"]) == true)
				{
			?>		
					<!--display existent email error message-->
					<div id="email-error-panel">
						<img id="email-error-speech-bubble" src="/RecipeFish/images/standard/error speech bubble.png">
								
						<p id="email-error-speech-text">The given email is not registered</p>
					</div>
					
				<?php 
					unset($_SESSION["nonExistingEmail"]);
				}
				
				else 
				{
					if (isset($_SESSION["combinationInvalid"]) == true)
					{
				?>		
						<!--display username/password combination error message-->
						<div id="combination-error-panel">
							<img id="combination-error-speech-bubble" src="/RecipeFish/images/standard/error speech bubble.png">
							
							<p id="combination-error-speech-text">Invalid password....try again</p>
						</div>
					
		<?php 
						unset($_SESSION["combinationInvalid"]);
					}
				}
			}
		?>
	</body>
</html>
