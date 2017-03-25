<?php 
/******************************************************************************************
*******************************************************************************************
** Name: recipePhotoController.php											   		   ****
** Description: Provides functionality for verifying recipe photo uploaded by a given  ****
**              user and assigning to global variables for further use 		  		   ****					
** Date Created: 03/22/2017														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

include($root . "/utilities/recipePhotoUtilities.php");
include($root . "utilities/database.php");
include($root . "/model/recipe.php");

$missingField = false; /* becomes true if any field is left empty */

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
header("Location: http://localhost/RecipeFish/view/addRecipeFeatures.php"); 
exit(); 
?>
