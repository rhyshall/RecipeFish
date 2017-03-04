<?php 
/******************************************************************************************
*******************************************************************************************
** Name: profileHeader.php													   		   ****
** Description: Displays header for basic user account information   				   ****
** Author: Rhys Hall																   ****
** Date Created: 09/11/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

include($root . "/model/user.php");
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/profileHeader.css">
	</head>
	
	<body>
		<?php 
			$userSelector = new User;
					
			$userObj = $userSelector->selectByUsername($_SESSION["username"]);	
			
			$profilePicURL = $userObj->getImagePath();
			$skinURL = "/RecipeFish/images/skins/skin" . $userObj->getSkinID() . ".png";
		?>
	
		<div id="profile-container" style="background-image: url(<?php echo $skinURL; ?>)">
			<div id="profile-picture">
				<!--profile picture display-->
				<img id="profile-picture-image" src="<?php echo $profilePicURL; ?>"></img>
			</div>
		</div>
	</body> 
</html>
