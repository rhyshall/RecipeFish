<?php 
/******************************************************************************************
*******************************************************************************************
** Name: profile.php													   		       ****
** Description: Provides interface for managing the user's profile					   ****
** Author: Rhys Hall																   ****
** Date Created: 09/13/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

include($root . "utilities/database.php");
include($root . "/model/user.php");
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/profile.css">
		
		<!--stylesheet for tab icon-->
		<link rel="shortcut icon" type="image/ico" href="/RecipeFish/images/standard/fish tab icon.ico"/>
	</head>
	
	<body onFocus="parentDisable();" onclick="parentDisable();">
		<div id="margin-canvas1">
			<!--left-side coloured border-->
		</div>
		
		<div id="container">
			<div id="header">
				<?php 
					include($root . "view/header.php");
				?>
			</div>
		
			<?php 
				include($root . "view/profileHeader.php");
			?>
			
			<div id="title">
				<p>Profile</p>
			</div>
		
			<?php 
				include($root . "view/profileMenu.php");
			?>
			
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
