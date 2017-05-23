<?php 
/******************************************************************************************
*******************************************************************************************
** Name: addRecipeError.php													           ****
** Description: Displays error pop-up message for adding a user's recipe               ****
** Author: Rhys Hall																   ****
** Date Created: 09/05/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/popUpError.css">
		
		<!--stylesheet for tab icon-->
		<link rel="shortcut icon" type="image/ico" href="/RecipeFish/images/standard/fish tab icon.ico"/>
		
		<!--Bootstrap stylesheets-->
		<link rel="stylesheet" href="/RecipeFish/Bootstrap/css/bootstrap.min.css">
	</head>
	
	<body>
		<div id="container">
			<div id="message">
				<p>A problem occurred while uploading recipe data to the server.</p>
				<p>Sorry for the inconvenience!</p>
			</div>
		
			<div id="close">
				<button id="close-button" class="btn btn-danger" type="button" onclick="window.close()">Close</button>
			</div>
		</div>
	</body>
</html>
