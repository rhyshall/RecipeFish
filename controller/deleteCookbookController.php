<?php 
/******************************************************************************************
*******************************************************************************************
** Name: deleteCookbookController.php												   ****
** Description: Provides functionality for deleting a given cookbook recipe		   	   ****					
** Date Created: 06/24/2017														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

include($root . "utilities/database.php");
include($root . "/model/cookbook.php");

//remove all information from database pertaining to given recipe 
$recipeID = $_GET["id"];

//retrieve recipe name corresponding to ID
$cookbookSelector = new Cookbook;

$success = $cookbookSelector->remove($_SESSION["userID"], $recipeID);

header("Location: http://localhost/RecipeFish/view/cookbookRecipes.php");
exit(); 
?>
