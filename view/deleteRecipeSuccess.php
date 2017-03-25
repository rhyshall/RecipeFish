<?php 
/******************************************************************************************
*******************************************************************************************
** Name: deleteRecipeSuccess.php													   ****
** Description: Displays success pop-up message for deleting a user's recipe           ****
** Author: Rhys Hall																   ****
** Date Created: 09/21/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/popUpSuccess.css">
		
		<!--stylesheet for tab icon-->
		<link rel="shortcut icon" type="image/ico" href="/RecipeFish/images/standard/fish tab icon.ico"/>
		
		<!--Bootstrap stylesheets-->
		<link rel="stylesheet" href="/RecipeFish/Bootstrap/css/bootstrap.min.css">
	</head>
	
	<body>
		<div id="container">
			<div id="message">
				<p><?php echo $_GET["name"] ?> successfully removed from recipes</p>
			</div>
		
			<div id="close">
				<button id="close-button" class="btn btn-success" type="button" onclick="window.close()">Close</button>
			</div>
		</div>
	</body>
</html>
