<?php 
/******************************************************************************************
*******************************************************************************************
** Name: skinController.php												       		   ****
** Description: Provides functionality for switching recipe pages corresponding to the ****
**              user's request									  					   ****
** Date Created: 09/25/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeMingle/";

include($root . "utilities/database.php");
include($root . "/model/user.php");

//retrieve saved skin ID from URL
$skinID = $_GET["skinID"];

$user = new User;
$userSelector = new User;

//set user info as class object, change saved skin ID and update database info 
$user = $userSelector->selectByID($_SESSION["userID"]);
$user->setSkinID($skinID);
$user->update();

$_SESSION["skinSaved"] = "set";

header("Location: http://localhost/RecipeMingle/view/profile.php");
exit();
?>
