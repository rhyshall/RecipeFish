<?php 
/******************************************************************************************
*******************************************************************************************
** Name: deleteRecipeController.php													   ****
** Description: Provides functionality for deleting a given recipe			   		   ****					
** Date Created: 09/18/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

include($root . "utilities/database.php");
include($root . "/model/recipe.php");
include($root . "/model/ingredient.php");
include($root . "/model/direction.php");
include($root . "/model/recipeIngredient.php");
include($root . "/model/recipeDirection.php");

//remove all information from database pertaining to given recipe 
$recipeID = $_GET["id"];

//retrieve recipe name corresponding to ID
$recipeSelector = new Recipe;

$recipeInfo = $recipeSelector->selectByRecipeID($recipeID);
$recipeName = $recipeInfo["name"];

//remove basic recipe info
$recipeSelector->remove($recipeID);

//retrieve ingredient IDs for given recipe
$recipeIngredientSelector = new RecipeIngredient;
$ingredientIDs = array();

$ingredientIDs = $recipeIngredientSelector->selectByRecipeID($recipeID);

//remove meta-data between recipe and ingredient tables
$recipeIngredientSelector->remove($recipeID);
	
//retrieve direction IDs for given recipe
$recipeDirectionSelector = new RecipeDirection;
$directionIDs = array();

$directionIDs = $recipeDirectionSelector->selectByRecipeID($recipeID);

//remove meta-data between recipe and direction tables
$recipeDirectionSelector->remove($recipeID);
	
//remove recipe ingredients 
$ingredientSelector = new Ingredient;

$ingredientCount = count($ingredientIDs);

for ($i = 0; $i < $ingredientCount; $i++)
{
	if ($ingredientSelector->remove($ingredientIDs[$i]) == false)
	{
		//could not remove ingredient 
	}
}


//remove recipe directions
$directionSelector = new Direction;

$directionCount = count($directionIDs);

for ($i = 0; $i < $directionCount; $i++)
{
	if ($directionSelector->remove($directionIDs[$i]) == false)
	{
		//could not remove direction
	}
}

$_SESSION["deleteRecipeSuccess"] = $recipeName;

header("Location: http://localhost/RecipeFish/view/recipes.php");
exit(); 
?>
