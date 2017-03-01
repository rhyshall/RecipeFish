<?php 
/******************************************************************************************
*******************************************************************************************
** Name: addRecipeController.php													   ****
** Description: Provides functionality for uploading a given user's recipe			   ****					
** Date Created: 06/04/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeMingle/";

include($root . "utilities/database.php");
include($root . "/model/recipe.php");
include($root . "/model/ingredient.php");
include($root . "/model/direction.php");
include($root . "/model/recipeIngredient.php");
include($root . "/model/recipeDirection.php");
include($root . "/model/user.php");

/****
 ** Converts array values to single string with each 
 ** value separated by a '%' delimiter
 **
 **/
function arrayToString($array)
{
	$string = "";
	
	$size = count($array);
	
	for ($i = 0; $i < $size; $i++)
	{
		$string = $string . $array[$i] . "%";
	}
	
	return $string;
}

/****
 ** Clears the global ethnicity value that is set
 **
 **/
function clearGlobalEthnicity()
{
	for ($i = 1; $i <= 52; $i++)
	{
		if (isset($_SESSION["ethnicity" . $i]) == true)
		{
			unset($_SESSION["ethnicity" . $i]);
			
			break;
		}
	}
}

/****
 ** Clears the global meal type value that is set
 **
 **/
function clearGlobalMealType()
{
	for ($i = 1; $i <= 8; $i++)
	{
		if (isset($_SESSION["meal-type" . $i]) == true)
		{
			unset($_SESSION["meal-type" . $i]);
			
			break;
		}
	}
}

/****
 ** Clears the global popular type values that are set
 **
 **/
function clearGlobalPopularTypes()
{
	for ($i = 1; $i <= 60; $i++)
	{
		if (isset($_SESSION["popular-type" . $i]) == true)
		{
			unset($_SESSION["popular-type" . $i]);
		}
	}
}

/****
 ** Clears the global other type values that are set
 **
 **/
function clearGlobalOtherTypes()
{
	for ($i = 1; $i <= 13; $i++)
	{
		if (isset($_SESSION["other" . $i]) == true)
		{
			unset($_SESSION["other" . $i]);
		}
	}
}

/****
 ** Clears the global holiday type values that are set
 **
 **/
function clearGlobalHoliday()
{
	for ($i = 1; $i <= 9; $i++)
	{
		if (isset($_SESSION["holiday" . $i]) == true)
		{
			unset($_SESSION["holiday" . $i]);
			
			break;
		}
	}
}

//check validity of notes length
if (strlen($_POST["notes"]) > 500)
{
	$_SESSION["notesLengthError"] = "set";
	
	$_SESSION["notes"] = $_POST["notes"]; 
	
	header("Location: http://localhost/RecipeMingle/view/addRecipeNotes.php");
	exit(); 
}

//move uploaded image from temp directory to appropriate directory  
if (file_exists($_SESSION["tempImagePath"]) == true)
{
	rename($_SESSION["tempImagePath"], $_SESSION["imagePath"]);
}		

//assign basic recipe info variables
$name = $_SESSION["recipeNameField"];
$description = $_SESSION["descriptionField"];
$prepTimeHour = $_SESSION["prepHoursField"];
$prepTimeMinute = $_SESSION["prepMinutesField"];
$cookTimeHour = $_SESSION["cookHoursField"];
$cookTimeMinute = $_SESSION["cookMinutesField"];
$waitTimeHour = $_SESSION["waitHoursField"];
$waitTimeMinute = $_SESSION["waitMinutesField"];
$servings = $_SESSION["servingsField"];
$imagePath = $_SESSION["imagePath"];
$ethnicity = $_SESSION["ethnicity"];
$mealType = $_SESSION["meal-type"];
$popularFeatures = arrayToString($_SESSION["popular-type"]);
$otherFeatures = arrayToString($_SESSION["other-type"]);
$holiday = $_SESSION["holiday"];
$notes = $_POST["notes"];
$authorID = $_SESSION["userID"];

date_default_timezone_set('US/Eastern');
$date = date("y/m/d h:i:sa");

//assign in-putted values to recipe class variables
$recipe = new Recipe;

//save recipe ID for ingredient/direction insert 
$recipeID = $recipe->selectNextID();

$recipe->setName($name);
$recipe->setDescription($description);
$recipe->setPrepHour($prepTimeHour);
$recipe->setPrepMin($prepTimeMinute);
$recipe->setCookHour($cookTimeHour);
$recipe->setCookMin($cookTimeMinute);
$recipe->setWaitHour($waitTimeHour);
$recipe->setWaitMin($waitTimeMinute);
$recipe->setServings($servings);
$recipe->setImagePath($imagePath);
$recipe->setEthnicity($ethnicity);
$recipe->setMealType($mealType);
$recipe->setPopularFeatures($popularFeatures);
$recipe->setOtherFeatures($otherFeatures);
$recipe->setHoliday($holiday);
$recipe->setNotes($notes);
$recipe->setAuthorID($authorID);
$recipe->setDateUploaded($date);

//insert recipe class variables into the Recipe Mingle database 
$success1 = $recipe->insert();

//if insert is successful
if ($success1 == true)
{
	//delete all recipe global variables
	if (isset($_SESSION["recipeNameField"]) == true)
	{
		unset($_SESSION["recipeNameField"]);
	}
	
	if (isset($_SESSION["descriptionField"]) == true)
	{
		unset($_SESSION["descriptionField"]);
	}
	
	if (isset($_SESSION["prepHoursField"]) == true)
	{
		unset($_SESSION["prepHoursField"]);
	}
	
	if (isset($_SESSION["prepMinutesField"]) == true)
	{
		unset($_SESSION["prepMinutesField"]);
	}
	
	if (isset($_SESSION["cookHoursField"]) == true)
	{
		unset($_SESSION["cookHoursField"]);
	}
	
	if (isset($_SESSION["cookMinutesField"]) == true)
	{
		unset($_SESSION["cookMinutesField"]);
	}
	
	if (isset($_SESSION["waitHoursField"]) == true)
	{
		unset($_SESSION["waitHoursField"]);
	}
	
	if (isset($_SESSION["waitMinutesField"]) == true)
	{
		unset($_SESSION["waitMinutesField"]);
	}
	
	if (isset($_SESSION["servingsField"]) == true)
	{
		unset($_SESSION["servingsField"]);
	}
	
	if (isset($_SESSION["recipeName"]) == true)
	{
		unset($_SESSION["recipeName"]);
	}
	
	if (isset($_SESSION["description"]) == true)
	{
		unset($_SESSION["description"]);
	}
	
	if (isset($_SESSION["imagePath"]) == true)
	{
		unset($_SESSION["imagePath"]);
	}
	
	if (isset($_SESSION["tempImagePath"]) == true)
	{
		unset($_SESSION["tempImagePath"]);
	}
	
	//clear all global features
	clearGlobalEthnicity();
	clearGlobalMealType();
	clearGlobalPopularTypes();
	clearGlobalOtherTypes();
	clearGlobalHoliday();
	
	if (isset($_SESSION["ethnicity"]) == true)
	{
		unset($_SESSION["ethnicity"]);
	}
	
	if (isset($_SESSION["meal-type"]) == true)
	{
		unset($_SESSION["meal-type"]);
	}
	
	if (isset($_SESSION["popular-type"]) == true)
	{
		unset($_SESSION["popular-type"]);
	}
	
	if (isset($_SESSION["other-type"]) == true)
	{
		unset($_SESSION["other-type"]);
	}
	
	if (isset($_SESSION["holiday"]) == true)
	{
		unset($_SESSION["holiday"]);
	}
}

//insert recipe ingredient class variables into Recipe Mingle database 
$ingredientCount = count($_SESSION["ingredients"]);

for ($i = 0; $i < $ingredientCount; $i++)
{
	$recipeIngredient = new RecipeIngredient;
	$ingredient = new Ingredient;
	
	$ingredientID = $ingredient->selectNextID();
	
	$recipeIngredient->setIngredientID($ingredientID);
	$recipeIngredient->setRecipeID($recipeID);
	
	$success2 = $recipeIngredient->insert();
	
	$ingredient->setContent($_SESSION["ingredients"][$i]);
	
	$success3 = $ingredient->insert();
	
	if ($success3 == true)
	{
		unset($_SESSION["ingredients"][$i]);
	}
}

//insert recipe direction class variables into Recipe Mingle database 
$directionCount = count($_SESSION["directions"]);

for ($i = 0; $i < $directionCount; $i++)
{
	$recipeDirection = new RecipeDirection;
	$direction = new Direction;
	
	$directionID = $direction->selectNextID();
	
	$recipeDirection->setDirectionID($directionID);
	$recipeDirection->setRecipeID($recipeID);
	
	$success4 = $recipeDirection->insert();
	
	$direction->setStepNum($i + 1);
	$direction->setContent($_SESSION["directions"][$i]);
	
	$success5 = $direction->insert();
	
	if ($success5 == true)
	{
		unset($_SESSION["directions"][$i]);
	}
}

//if all values successfully entered into database
if (($success1 == true) && ($success2 == true) && ($success3 == true) && ($success4 == true) && ($success5 == true))
{
	//set global variable for success pop-up
	$_SESSION["addRecipeSuccess"] = "set";
}

else
{
	//remove all values that were previously entered into database 
	//set global variable for error pop-up 
	$_SESSION["addRecipeError"] = "set";
	
	$recipeSelector = new Recipe;
	$recipeSelector->remove($recipeID);
	
	$recipeIngredientSelector = new RecipeIngredient;
	$recipeIngredientSelector->remove($recipeID);
	
	$recipeDirectionSelector = new RecipeDirection;
	$recipeDirectionSelector->remove($recipeID);
	
	$ingredientSelector = new Ingredient;
	
	//traverse back to ID of first ingredient 
	$upperBound = $ingredientID;
	$ingredientID = $ingredientID - $ingredientCount + 1;
	
	//remove all ingredients for given recipe
	for ($i = $ingredientID; $i <= $upperBound; $i++)
	{
		$ingredientSelector->remove($i);
	}
	
	$directionSelector = new Direction;
	
	//traverse back to ID of first ingredient 
	$upperBound = $directionID;
	$directionID = $directionID - $directionCount + 1;
	
	//remove all ingredients for given recipe
	for ($i = $directionID; $i <= $upperBound; $i++)
	{
		$directionSelector->remove($i);
	}
}

header("Location: http://localhost/RecipeMingle/view/recipes.php");
exit(); 
?>
