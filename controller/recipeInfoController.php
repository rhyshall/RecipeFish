<?php 
/******************************************************************************************
*******************************************************************************************
** Name: recipeInfoController.php													   ****
** Description: Provides functionality for verifying recipe header info entered by a   ****
** given user and assigning to global variables for further use 					   ****					
** Date Created: 05/24/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeMingle/";

include($root . "/utilities/recipeInfoUtilities.php");
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

//if image path was not input
if (strcmp($_FILES["recipe-image"]["name"], "") != 0)
{
	$_SESSION["imageField"] = $_FILES["recipe-image"]["name"];
}

else 
{
	//set flag
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

if (isImageType($_FILES["recipe-image"]["tmp_name"]) === true)
{
	if (validImageSize($_FILES["recipe-image"]["tmp_name"]) === true)
	{
		//recipe image is valid 
		
		//get extension of uploaded file 
		$extension = pathinfo($_FILES["recipe-image"]["name"], PATHINFO_EXTENSION);
		
		//get next available database ID for uploaded recipe image 
		$recipeSelector = new Recipe;

		$recipeID = $recipeSelector->selectNextID();
		
		//assign appropriate image path name to global variable
		$_SESSION["imagePath"] = $root . "images/uploads/recipes/recipe" . $recipeID . "." . $extension;
		
		//move file to temp folder (until recipe is submitted)
		$_SESSION["tempImagePath"] = $root . "images/uploads/temporary/recipe" . $recipeID . "." . $extension;
		
		move_uploaded_file($_FILES["recipe-image"]["tmp_name"], $_SESSION["tempImagePath"]);
	}
	
	else 
	{
		//image file not valid image size
		$_SESSION["imageSizeInvalid"] = "set";
		
		reEnterInput();
	}
}

else 
{
	//file not valid image type
	$_SESSION["imageTypeInvalid"] = "set";
	
	reEnterInput();
}

//go to recipe features page 
header("Location: http://localhost/RecipeMingle/view/addRecipeFeatures.php"); 
exit(); 
?>
