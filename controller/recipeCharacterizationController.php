<?php 
/******************************************************************************************
*******************************************************************************************
** Name: recipeCharacterizationController.php										   ****
** Description: Provides functionality for verifying recipe name and description       ****
** entered by a given user and assigning to global variables for further use 		   ****					
** Date Created: 03/22/2017														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

include($root . "/utilities/recipeCharacterizationUtilities.php");
include($root . "utilities/database.php");
include($root . "/model/recipe.php");

$missingField = false; /* becomes true if any field is left empty */

/* save input values for all fields filled in */
//if recipe name input entered
if (strlen($_POST["recipe-name"]) > 0)
{
	//assign name value to global variable
	$_SESSION["recipeNameField"] = $_POST["recipe-name"];
}

else 
{
	$missingField = true;
}

//if recipe description input entered
if (strlen($_POST["description"]) > 0)
{
	//assign description value to global variable
	$_SESSION["descriptionField"] = $_POST["description"];
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

//check validity of recipe name 
if (isValidNameLength($_POST["recipe-name"]) == true)
{
	if (isValidNameSymbols($_POST["recipe-name"]) == true)
	{
		//recipe name is valid- assign to global variable 
		$_SESSION["recipeName"] = $_POST["recipe-name"];
	}
	
	else 
	{
		//recipe name symbols is invalid
		$_SESSION["nameSymbolsInvalid"] = "set";
	
		reEnterInput();
	}
}

else 
{
	//recipe name length is invalid
	$_SESSION["nameLengthInvalid"] = "set";
	
	reEnterInput();
}

//check validity of recipe description
if (isValidDescriptionLength($_POST["description"]) == true)
{
	//recipe description is valid- assign to global variable 
	$_SESSION["description"] = $_POST["description"];
}

else 
{
	//recipe description length is invalid
	$_SESSION["descriptionLengthInvalid"] = "set";

	reEnterInput();
}

//go to recipe features page 
header("Location: http://localhost/RecipeFish/view/addRecipeTimes.php"); 
exit(); 
?>
