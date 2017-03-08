<?php 
/******************************************************************************************
*******************************************************************************************
** Name: basicInfo.php													   		  	   ****
** Description: Provides interface for editing basic profile information		       ****
** Author: Rhys Hall																   ****
** Date Created: 10/11/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

$user = new User;
$userSelector = new User;

$user = $userSelector->selectByID($_SESSION["userID"]);

$username = $user->getUsername();
$email = $user->getEmail();
$gender = $user->getGender();
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/basicInfo.css">
		
		<!--stylesheet for tab icon-->
		<link rel="shortcut icon" type="image/ico" href="/RecipeFish/images/standard/fish tab icon.ico"/>
		
		<script type="text/javascript">
			<!--displays success pop-up window if add recipe was successful
			function basicInfoSuccessPopUp()
			{
				var parameters = "height=250,width=425,left=" + ((screen.width/2)-(425/2)) + ",top=" + ((screen.height/2)-(screen.height/4));
				
				popUpWindow = window.open("basicInfoSuccess.php", "Basic Info Success Message", parameters);
			}
		</script>
	</head>
	
	<body onFocus="parentDisable();" onclick="parentDisable();">
		<?php 
			if (isset($_SESSION["basicInfoUpdated"]) == true)
			{
				echo "<script type='text/javascript'>basicInfoSuccessPopUp();</script>";
						
				unset($_SESSION["basicInfoUpdated"]);
			}
		?>
	
		<div id="info-box">
			<div id="instructions-text">
				<p>View or modify registered profile information below.</p>
			</div>
			
		<?php 
			include($root . "view/switchBasicInfoError.php");
		?>
		
			<form id="info-form" action="/RecipeFish/controller/basicInfoController.php" method="post">
				<!--insert current username for user-->
				<div id="username">
					<p id="username-label">Username</p>
				
					<input id="username-field" name="username" type="text" class="form-control" value="<?php echo $username ?>"></input>
				</div>
				
				<!--insert current username for user-->
				<div id="email">
					<p id="email-label">Email</p>
				
					<input id="email-field" name="email" type="text" class="form-control" value="<?php echo $email ?>"></input>
				</div>
				
				<div id="gender">
					<?php 
						if (strcmp($gender, "male") == 0)
						{
					?>
							<p id="male-label">Male</p>
							<input id="male-radio" name="gender" type="radio" class="radio" value="male" checked></input>
					
							<p id="female-label">Female</p>
							<input id="female-radio" name="gender" type="radio" class="radio" value="female"></input>
					<?php 
						}
						
						else 
						{
					?>
							<p id="male-label">Male</p>
							<input id="male-radio" name="gender" type="radio" class="radio" value="male"></input>
					
							<p id="female-label">Female</p>
							<input id="female-radio" name="gender" type="radio" class="radio" value="female" checked></input>
					<?php 
						}
					?>
				</div>
			
				<div id="save-info">
					<button id="save-info-button" class="btn btn-success" type="submit">Save
					<span id="save-symbol" class="glyphicon glyphicon-save"></span></button>
				</div>
			</form>
		</div>
	</body>
</html>
