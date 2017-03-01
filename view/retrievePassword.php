<?php 
/******************************************************************************************
*******************************************************************************************
** Name: retrievePassword.php														   ****
** Description: Provides interface for retrieving user's password  		   			   ****
** Author: Rhys Hall																   ****
** Date Created: 04/26/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeMingle/";
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeMingle/stylesheets/retrievePassword.css">
		
		<!--stylesheet for tab icon-->
		<link rel="shortcut icon" type="image/ico" href="/RecipeMingle/images/colour sheets.ico"/>
	</head>
	
	<body>
		<div id="header">
			<?php 
				include($root . "view/header.php");
			?>
		</div>
		
		<div id="footer">
			<?php 
				include($root . "view/footer.php");
			?>
		</div>
	</body>
</html>