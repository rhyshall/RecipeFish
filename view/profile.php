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
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/profile.css">
		
		<!--stylesheet for tab icon-->
		<link rel="shortcut icon" type="image/ico" href="/RecipeFish/images/standard/colour wheel.ico"/>
	</head>
	
	<body onFocus="parentDisable();" onclick="parentDisable();">
		<div id="header">
			<?php 
				include($root . "view/header.php");
			?>
		</div>
		
		<div id="margin-canvas1">
			<!--left-side coloured border-->
		</div>
		
		<div id="container">
			<?php 
				include($root . "view/profileHeader.php");
			?>
		
			<?php 
				include($root . "view/profileMenu.php");
			?>
		</div>
		
		<div id="margin-canvas2">
			<!--right-side coloured border-->
		</div>
		
		<div id="clear-float">
			<!--clear float from previous content-->
		</div>
		
		<div id="footer">
			<?php 
				include($root . "view/footer.php");
			?>
		</div>
	</body>
</html>
