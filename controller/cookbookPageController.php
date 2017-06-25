<?php 
/******************************************************************************************
*******************************************************************************************
** Name: cookbookPageController.php												       ****
** Description: Provides functionality for switching cookbook pages corresponding to   ****
**              the user's request									  				   ****
** Date Created: 06/24/2017														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$_SESSION["pageNumber"] = $_GET["pageNumber"];

header("Location: http://localhost/RecipeFish/view/cookbookRecipes.php");
exit();
?>
