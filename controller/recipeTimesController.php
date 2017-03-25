<?php 
/******************************************************************************************
*******************************************************************************************
** Name: recipeTimesController.php											   		   ****
** Description: Provides functionality for verifying recipe time and servings values   ****
** entered by a given user and assigning to global variables for further use 		   ****					
** Date Created: 03/22/2017													   	       ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

include($root . "utilities/database.php");
include($root . "/model/recipe.php");

/****
 ** Loads the recipe info input page
 **
 **/
function reEnterInput()
{
	//go back to recipe times input 
	header("Location: http://localhost/RecipeFish/view/addRecipeTimes.php"); 
	exit(); 
}

$missingField = false; /* becomes true if any field is left empty */

//if prep hours input selected
if ($_POST["prep-hours"] != '')
{
	//assign prep hours value to global variable
	$_SESSION["prepHoursField"] = $_POST["prep-hours"];
}

else 
{
	$missingField = true;
}

//if prep minutes input selected
if ($_POST["prep-minutes"] != '')
{
	//assign prep minutes value to global variable
	$_SESSION["prepMinutesField"] = $_POST["prep-minutes"];
}

else 
{
	$missingField = true;
}

//if cook hours input selected
if ($_POST["cook-hours"] != '')
{
	//assign cook hours value to global variable
	$_SESSION["cookHoursField"] = $_POST["cook-hours"];
}

else 
{
	$missingField = true;
}

//if cook minutes input selected
if ($_POST["cook-minutes"] != '')
{
	//assign cook minutes value to global variable
	$_SESSION["cookMinutesField"] = $_POST["cook-minutes"];
}

else 
{
	$missingField = true;
}

//if wait hours input selected
if ($_POST["wait-hours"] != '')
{
	//assign wait hours value to global variable
	$_SESSION["waitHoursField"] = $_POST["wait-hours"];
}

else 
{
	$missingField = true;
}

//if wait minutes input selected
if ($_POST["wait-minutes"] != '')
{
	//assign wait minutes value to global variable
	$_SESSION["waitMinutesField"] = $_POST["wait-minutes"];
}

else 
{
	$missingField = true;
}

//if servings input selected
if ($_POST["servings"] != '')
{
	//assign wait minutes value to global variable
	$_SESSION["servingsField"] = $_POST["servings"];
}

else 
{
	$missingField = true;
}

/* go back to recipe info input if any input invalid- otherwise, continue to next page */

//check if any missing fields exist
if ($missingField == true)
{
	//one or more fields were left empty
	$_SESSION["emptyField"] = "set";
	
	reEnterInput();
}

//go to recipe features page 
header("Location: http://localhost/RecipeFish/view/addRecipePhoto.php"); 
exit(); 
?>
