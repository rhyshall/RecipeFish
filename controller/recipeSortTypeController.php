<?php 
/******************************************************************************************
*******************************************************************************************
** Name: recipeSortTypeController.php												   ****
** Description: Provides functionality for changing a given user's recipe sort type ID ****
**              in the Recipe Fish database 										   ****
** Date Created: 04/25/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

include($root . "utilities/database.php");
include($root . "/model/user.php");

$sortType = $_GET["sortType"];

$sortID = 1;

//if recipe sort set to "alphabetical"
if (strcmp($sortType, "alphabetical") == 0)
{
	$sortID = 1;
}

//if recipe sort set to "newest to oldest"
if (strcmp($sortType, "newestToOldest") == 0)
{
	$sortID = 2;
}

//if recipe sort set to "oldest to newest"
if (strcmp($sortType, "oldestToNewest") == 0)
{
	$sortID = 3;
}

//if recipe sort set to "reverse alphabetical"
if (strcmp($sortType, "reverseAlphabetical") == 0)
{
	$sortID = 4;
}

$user = new User;
$userSelector = new User;

$user = $userSelector->selectByUsername($_SESSION["username"]);

$user->setRecipeSortID($sortID);

$user->update();
	
header("Location: http://localhost/RecipeFish/view/recipes.php");
exit();
?>
