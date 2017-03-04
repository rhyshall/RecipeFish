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
		?>		<!--invalid username character(s) message-->
				<div id="invalid-message-1">
					<p id="invalid-message-p1"><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>Username may only have 1-20 characters and consist of</p>
				</div>
				
				<div id="invalid-message-2">
					<p id="invalid-message-p2">symbols [A-Z], [a-z], [0-9], "-" and "_"</p>
				</div>
				
			<?php 
					unset($_SESSION["registerUsernameInvalid"]);
				}
				
				else 
				{
					if (isset($_SESSION["registerUsernameExists"]) == true)
					{
				?>		<!--existing username message-->
						<div id="existing-username-message">
							<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>A user has already registered with the given username</p>
						</div>
				<?php 
						unset($_SESSION["registerUsernameExists"]);
					}
				}
			?>
	</body>
</html>
