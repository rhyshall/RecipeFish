<?php 
/******************************************************************************************
*******************************************************************************************
** Name: recipePageController.php												       ****
** Description: Provides functionality for switching recipe pages corresponding to the ****
**              user's request									  					   ****
** Date Created: 09/25/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$_SESSION["pageNumber"] = $_GET["pageNumber"];

header("Location: http://localhost/RecipeFish/view/recipes.php");
exit();
?>
