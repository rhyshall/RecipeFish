<?php 
/******************************************************************************************
*******************************************************************************************
** Name: directionLengthError.php													   ****
** Description: Displays error pop-up message for direction input of invalid length    ****
** Author: Rhys Hall																   ****
** Date Created: 08/14/2016														   	   ****
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
				<p>Each step may not exceed 500 characters</p>
			</div>
		
			<div id="close">
				<button id="close-button" class="btn btn-danger" type="button" onclick="window.close()">Close</button>
			</div>
		</div>
	</body>
</html>
