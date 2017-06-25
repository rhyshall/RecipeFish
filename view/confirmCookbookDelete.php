<?php 
/******************************************************************************************
*******************************************************************************************
** Name: confirmCookbookDelete.php													   ****
** Description: Displays confirm pop-up message for removing a user's cookbook entry   ****
** Author: Rhys Hall																   ****
** Date Created: 06/24/2017														   	   ****
*******************************************************************************************
******************************************************************************************/

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/popUpConfirm.css">
		
		<!--stylesheet for tab icon-->
		<link rel="shortcut icon" type="image/ico" href="/RecipeFish/images/standard/fish tab icon.ico"/>
		
		<!--Bootstrap stylesheets-->
		<link rel="stylesheet" href="/RecipeFish/Bootstrap/css/bootstrap.min.css">
	</head>
	
	<body>
		<div id="container">
			<div id="message">
				<p>Are you sure you want to remove this entry from cookbook?</p>
			</div>
		
			<div id="yes">
				<button id="yes-button" class="btn btn-success" type="button" onclick="parent.window.opener.location='<?php echo "/RecipeFish/controller/deleteCookbookController.php?id=" . $_GET["id"] ?>'; window.close();">Yes</button>
			</div>
			
			<div id="no">
				<button id="no-button" class="btn btn-danger" type="button" onclick="window.close()">No</button>
			</div>
			
			<div id="clear-float">
				<!--clear float-->
			</div>
		</div>
	</body>
</html>
