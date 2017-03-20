<?php 
/******************************************************************************************
*******************************************************************************************
** Name: register.php																   ****
** Description: Provides interface for creating a user account  		   			   ****
** Author: Rhys Hall																   ****
** Date Created: 04/26/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/register.css?<?php echo date('l jS \of F Y h:i:s A'); ?>"/>
		
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
			
			<!--display error message if required, otherwise display default register prompt-->
			<?php 
				//general register error message (if required)
				if ((isset($_SESSION["emptyField"]) == true) || (isset($_SESSION["passwordConfirmInvalid"]) == true))
				{
					include($root . "view/registerGeneralError.php");	
				}
				
				//username register error message (if required)
				else if ((isset($_SESSION["registerUsernameInvalid"]) == true) || (isset($_SESSION["registerUsernameExists"]) == true))
				{
					include($root . "view/registerUsernameError.php");
				}
				
				//email register error message (if required)
				else if (isset($_SESSION["registerEmailExists"]) == true)
				{
					include($root . "view/registerEmailError.php");
				}
				
				//password register error message (if required)
				else if ((isset($_SESSION["passwordLengthInvalid"]) == true) || (isset($_SESSION["passwordSymbolsInvalid"]) == true))
				{
					include($root . "view/registerPasswordError.php");
				}
				
				else 
				{
			?>
					<!--display default register prompt-->
					<div id="speech-bubble-panel">
						<img id="speech-bubble" src="/RecipeFish/images/standard/speech bubble.png">
						
						<p id="speech-text">Register now. It's quick and easy!</p>
					</div>
			<?php
				}
			?>
			
			<div id="clear-float1">
				<!--clear float from previous content-->
			</div>
		
			<form id="register-form" action="/RecipeFish/controller/registerController.php" method="post">
				<?php 
					//if username input previously filled
					if (isset($_SESSION["usernameField"]) == true)
					{
				?>		<!--set username field value as previous value-->
						<div id="register-username">
							<input id="register-username-field" name="register-username" type="text" class="form-control" value="<?php echo $_SESSION["usernameField"] ?>"></input>
						</div>
				<?php 
						unset($_SESSION["usernameField"]);
					}
				
					else
					{
				?>		<!--insert username field placeholder-->
						<div id="register-username">
							<input id="register-username-field" name="register-username" type="text" class="form-control" placeholder="Username"></input>
						</div>
				<?php 
					}
			
					//if email input previously filled
					if (isset($_SESSION["emailField"]) == true)
					{
				?>		<!--set email field value as previous value-->
						<div id="register-email">
							<input id="register-email-field" name="register-email" type="text" class="form-control" value="<?php echo $_SESSION["emailField"] ?>"></input>
						</div>
				<?php 
						unset($_SESSION["emailField"]);
					}
				
					else 
					{
				?>		<!--insert email field placeholder-->
						<div id="register-email">
							<input id="register-email-field" name="register-email" type="text" class="form-control" placeholder="Email"></input>
						</div>
				<?php
					}
			
					//if password input previously filled
					if (isset($_SESSION["passwordField"]) == true)
					{
				?>		<!--set password field value as previous value-->
						<div id="register-password">
							<input id="register-password-field" name="register-password" type="password" class="form-control" value="<?php echo $_SESSION["passwordField"] ?>"></input>
						</div>
				<?php 
						unset($_SESSION["passwordField"]);
					}
				
					else 
					{
				?>		<!--insert password field placeholder-->
						<div id="register-password">
							<input id="register-password-field" name="register-password" type="password" class="form-control" placeholder="Password"></input>
						</div>
				<?php 
				}
			
					//if password confirmation input previously filled
					if (isset($_SESSION["passwordConfirmationField"]) == true)
					{
				?>		<!--set password confirmation field value as previous value-->
						<div id="register-password-confirmation">
							<input id="register-password-confirmation-field" name="register-password-confirmation" type="password" class="form-control" 
							value="<?php echo $_SESSION["passwordConfirmationField"] ?>"></input>
						</div>
				<?php 
						unset($_SESSION["passwordConfirmationField"]);
					}
				
					else 
					{
				?>		<!--insert password confirmation field placeholder-->
						<div id="register-password-confirmation">
							<input id="register-password-confirmation-field" name="register-password-confirmation" type="password" class="form-control" placeholder="Confirm password"></input>
						</div>
				<?php 
					}
			
					//if gender button previously clicked
					if (isset($_SESSION["genderButton"]) == true)
					{
						//if male button clicked
						if (strcmp("male", $_SESSION["genderButton"]) == 0)
						{
				?>			<!--click male button-->
							<div id="register-gender">
								<h1>Male &nbsp</h1>
								<input id="radio-male" name="gender" type="radio" class="radio" value="male" checked></input>
				
								<h2>Female &nbsp</h2>
								<input id="radio-female "name="gender" type="radio" class="radio" value="female"></input>
							</div>
					<?php
						}
					
						else 
						{
					?>		<!--click female button-->
							<div id="register-gender">
								<h1>Male &nbsp</h1>
								<input id="radio-male" name="gender" type="radio" class="radio" value="male"></input>
				
								<h2>Female &nbsp</h2>
								<input id="radio-female "name="gender" type="radio" class="radio" value="female" checked></input>
							</div>
					<?php 
						}
					
						unset($_SESSION["genderButton"]);
					}
				
					else 
					{
				?>		<!--leave buttons non-clicked-->
						<div id="register-gender">
							<h1>Male &nbsp</h1>
							<input id="radio-male" name="gender" type="radio" class="radio" value="male"></input>
				
							<h2>Female &nbsp</h2>
							<input id="radio-female" name="gender" type="radio" class="radio" value="female"></input>
						</div>
				<?php 
					}
				?>
			
				<div id="clear-float1">
					<!--clear float from previous content-->
				</div>
		
				<div id="register-submit">
					<button id="register-submit-button" class="btn btn-warning" type="submit">Register</button>
				</div>
			</form>
			
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
