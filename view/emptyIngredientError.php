<?php 
/******************************************************************************************
*******************************************************************************************
** Name: emptyIngredientError.php													   ****
** Description: Displays error pop-up message for empty ingredient value input         ****
** Author: Rhys Hall																   ****
** Date Created: 08/12/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeMingle/";
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeMingle/stylesheets/popUpError.css">
		
		<!--Bootstrap stylesheets-->
		<link rel="stylesheet" href="/RecipeMingle/Bootstrap/css/bootstrap.min.css">
	</head>
	
	<body>
		<div id="container">
			<div id="message">
				<p>Cannot enter empty ingredient value</p>
			</div>
		
			<div id="close">
				<button id="close-button" class="btn btn-danger" type="button" onclick="window.close()">Close</button>
			</div>
		</div>
	</body>
</html>
