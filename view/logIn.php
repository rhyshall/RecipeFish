<?php 
/******************************************************************************************
*******************************************************************************************
** Name: logIn.php																	   ****
** Description: Provides interface for user log-in  		   						   ****
** Author: Rhys Hall																   ****
** Date Created: 04/26/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/logIn.css">
		
		<!--stylesheet for tab icon-->
		<link rel="shortcut icon" type="image/ico" href="/RecipeFish/images/standard/fish tab icon.ico"/>
	</head>
	
	<body>
		<div id="margin-canvas1">
			<!--left-side coloured border-->
		</div>
		
		<div id="container">
			<div id="header">
				<?php 
					include($root . "view/header.php");
				?>
			</div>
			
			<div id="chef-fish-panel">
				<img id="chef-fish" src="/RecipeFish/images/standard/chef fish.png">
			</div>
		
			<div id="speech-bubble-panel">
				<img id="speech-bubble" src="/RecipeFish/images/standard/log in speech bubble.png">
			</div>
			
			<div id="clear-float1">
				<!--clear float from previous content-->
			</div>
		
			<form id="log-in-form" action="/RecipeFish/controller/logInController.php" method="post">
				<!--invalid log-in error message (if necessary)-->
				<?php 
					include($root . "view/logInError.php");
				?>
			
				<!--hidden input field to prevent form autofill-->
				<div id="blank">
					<input id="hidden-field" name="log-in-email" type="text" class="form-control" value="<?php echo $_SESSION["emailField"] ?>"></input>
				</div>

				<?php 
					//if email input previously filled
					if (isset($_SESSION["emailField"]) == true)
					{
				?>		<!--set email field value as previous value-->
						<div id="log-in-email">
							<input id="log-in-email-field" name="log-in-email" type="text" class="form-control" value="<?php echo $_SESSION["emailField"] ?>"></input>
						</div>
					<?php
						unset($_SESSION["emailField"]);
					}
				
					else 
					{
				?>		<!--insert email field placeholder-->
						<div id="log-in-email">
							<input id="log-in-email-field" name="log-in-email" type="email" class="form-control" placeholder="Email"></input>
						</div>
				<?php 
					}
			
					//if password input previously filled
					if (isset($_SESSION["passwordField"]) == true)
					{
				?>		<!--set password field value as previous value-->
						<div id="log-in-password">
							<input id="log-in-password-field" name="log-in-password" type="password" class="form-control" value="<?php echo $_SESSION["passwordField"] ?>"input>
				
							<a id="forgot-password" href="/RecipeFish/view/retrievePassword.php">Forgot Password?</a>
						</div>
					<?php 
						unset($_SESSION["passwordField"]);
					}
				
					else 
					{
				?>		<!--insert password field placeholder-->
						<div id="log-in-password">
							<input id="log-in-password-field" name="log-in-password" type="password" class="form-control" placeholder="Password"></input>
				
							<a id="forgot-password" href="/RecipeFish/view/retrievePassword.php">Forgot Password?</a>
						</div>
						
						<div id="clear-float2">
							<!--clear float from previous content-->
						</div>
				<?php 
					}
				?>
		
				<div id="log-in-submit">
					<button id="log-in-submit-button" class="btn btn-info" type="submit">Log In</button>
				</div>
			</form> 
		
			<hr>
		
			<div id="register-link">
				<h3>New user? &nbsp </h3>
			
				<a href="/RecipeFish/view/register.php">Create an account</a>
			
				<h3>&nbsp to access every feature</h3>
			</div>
			
			<div id="clear-float3">
				<!--clear float from previous content-->
			</div>
			
			<div id="footer">
				<?php 
					include($root . "view/footer.php");
				?>
			</div>
		</div>
		
		<div id="margin-canvas2">
			<!--right-side coloured border-->
		</div>
	</body>
</html>
