<?php
/******************************************************************************************
*******************************************************************************************
** Name: switchBasicInfoError.php												       ****
** Description: Displays error message corresponding to updated username or password   ****
** 				when updating basic profile info 									   ****
** Author: Rhys Hall																   ****
** Date Created: 11/02/2016														   	   ****
*******************************************************************************************
******************************************************************************************/
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/switchBasicInfoError.css">
	<head>
	
	<body>
		<!--username error messages (if required)-->
		<?php 
			if (isset($_SESSION["switchUsernameInvalid"]) == true)
			{
		?>		<!--invalid username character(s) message-->
				<div id="invalid-username-message-1">
					<p id="invalid-username-message-p1"><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>Username may only have 1-20 characters and consist of</p>
				</div>
				
				<div id="invalid-username-message-2">
					<p id="invalid-username-message-p2">symbols [A-Z], [a-z], [0-9], "-" and "_"</p>
				</div>
				
			<?php 
					unset($_SESSION["switchUsernameInvalid"]);
				}
				
				else 
				{
					if (isset($_SESSION["switchUsernameExists"]) == true)
					{
				?>		<!--existing username message-->
						<div id="existing-username-message">
							<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>A user has already registered with the given username</p>
						</div>
				<?php 
						unset($_SESSION["switchUsernameExists"]);
					}
					
					else 
					{
				?>		<!--existing email error message (if required)-->
						<?php 
							if (isset($_SESSION["switchEmailExists"]) == true)
							{
						?>		<!--existing email message-->
								<div id="existing-email-message">
									<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>A user has already registered with the given email</p>
								</div>
								
							<?php 
								unset($_SESSION["switchEmailExists"]);
							}
							
							else 
							{
						?>		<!--false edit error message (if required)-->
								<?php 
									if (isset($_SESSION["falseEdit"]) == true)
									{
								?>		<!--false edit message-->
										<div id="false-edit-message">
											<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>Info has not been changed</p>
										</div>
											
									<?php 
										unset($_SESSION["falseEdit"]);
									}
										
							}
					}
				}
			?>
	</body>
</html>
