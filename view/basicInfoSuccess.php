<?php 
/******************************************************************************************
*******************************************************************************************
** Name: addRecipeSuccess.php													       ****
** Description: Displays success pop-up message for adding a user's recipe             ****
** Author: Rhys Hall																   ****
** Date Created: 09/05/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/popUpSuccess.css">
		
		<!--Bootstrap stylesheets-->
		<link rel="stylesheet" href="/RecipeFish/Bootstrap/css/bootstrap.min.css">
	</head>
	
	<body>
		<div id="container">
			<div id="message">
				<p>Profile updated successfully.</p>
			</div>
		
			<div id="close">
				<button id="close-button" class="btn btn-success" type="button" onclick="window.close()">Close</button>
			</div>
		</div>
	</body>
</html>
