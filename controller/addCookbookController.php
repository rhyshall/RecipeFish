<?php 
/******************************************************************************************
*******************************************************************************************
** Name: addCookbookController.php													   ****
** Description: Provides functionality for adding given recipe to user's cookbook	   ****					
** Date Created: 06/24/2017														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

include($root . "utilities/database.php");
include($root . "/model/cookbook.php");

$recipeID = $_GET["recipe_id"];
$userID = $_SESSION["userID"];

date_default_timezone_set('US/Eastern');
$date = date("y/m/d h:i:sa");

$cookbook = new Cookbook();
$cookbook->setUserID($userID);
$cookbook->setRecipeID($recipeID);
$cookbook->setDateAdded($date);

$cookbook->insert();

header("Location: http://localhost/RecipeFish/view/recipeProfile.php?id=" . $recipeID);
exit(); 
?>
