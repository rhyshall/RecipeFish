<?php 
/******************************************************************************************
*******************************************************************************************
** Name: cookbookSortTypeController.php												   ****
** Description: Provides functionality for changing a given user's cookbook sort type  ****
**              ID in the Recipe Fish database 										   ****
** Date Created: 06/24/2017													   	   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

include($root . "utilities/database.php");
include($root . "/model/user.php");

$sortType = $_GET["sortType"];

$sortID = 1;

//if recipe sort set to "most recent"
if (strcmp($sortType, "mostRecent") == 0)
{
	$sortID = 1;
}

//if recipe sort set to "alphabetical"
if (strcmp($sortType, "alphabetical") == 0)
{
	$sortID = 2;
}

//if recipe sort set to "reverse alphabetical"
if (strcmp($sortType, "reverseAlphabetical") == 0)
{
	$sortID = 3;
}

//if recipe sort set to "least recent"
if (strcmp($sortType, "leastRecent") == 0)
{
	$sortID = 4;
}

$user = new User;
$userSelector = new User;

$user = $userSelector->selectByUsername($_SESSION["username"]);

$user->setCookbookSortID($sortID);

$user->update();
	
header("Location: http://localhost/RecipeFish/view/cookbookRecipes.php");
exit();
?>
