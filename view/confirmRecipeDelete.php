<?php 
/******************************************************************************************
*******************************************************************************************
** Name: confirmRecipeDelete.php													   ****
** Description: Displays confirm pop-up message for removing a user's recipe           ****
** Author: Rhys Hall																   ****
** Date Created: 09/17/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/popUpConfirm.css">
		
		<!--Bootstrap stylesheets-->
		<link rel="stylesheet" href="/RecipeFish/Bootstrap/css/bootstrap.min.css">
	</head>
	
	<body>
		<div id="container">
			<div id="message">
				<p>Are you sure you want to remove this recipe?</p>
			</div>
		
			<div id="yes">
				<button id="yes-button" class="btn btn-success" type="button" onclick="parent.window.opener.location='<?php echo "/RecipeFish/controller/deleteRecipeController.php?id=" . $_GET["id"] ?>'; window.close();">Yes</button>
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
