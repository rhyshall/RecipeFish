<?php
/******************************************************************************************
*******************************************************************************************
** Name: indexUtilities.php														   	   ****
** Description: Provides helper functions for "index.php"			   	   			   ****
** Author: Rhys Hall																   ****
** Date Created: 11/03/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

include($root . "model/recipe.php");

/****
 ** Generates random meal type heading for given recipe slot on home page
 **
 ** @return    string  meal type heading
 **/
function getMealTypeHeading()
{
	$mealTypeHeading = "";
	$mealTypeHeadings = array("Jump-Start the Day", "Delicious Desserts", "Luscious Lunches", "Dinner Dining", "Appetizers & Snacks", "Adult Drinks", "Quench Your Thirst!", "Dinner Dining");
	
	$randomNum = rand(0, 7);
	
	for ($i = 0; $i <= 7; $i++)
	{
		if ($randomNum == $i)
		{
			$mealTypeHeading = $mealTypeHeadings[$i];
			
			break;
		}
	}
	
	return $mealTypeHeading;
}

/****
 ** Generates heading corresponding to next holiday for given recipe slot on home page
 **
 ** @return    string  holiday heading
 **/
function getNextHolidayHeading()
{
	$nextHolidayHeading = "";
	$holidayNames = array("New Year", "Valentine's Day", "Saint Patrick's Day", "Easter", "Oktoberfest", "Thanksgiving", "Halloween", "Thanksgiving", "Christmas");
	$currentDate = date("m/d");
	$holidayDateBounds = array("01/04", "02/17", "03/20", "04/30", "09/19", "10/14", "11/02", "11/26", "12/27"); /* upper bound for corresponding holiday dates */
	$numHolidays = 9;
	
	$currentMonth = substr($currentDate, 0, 2);
	
	if ((strcmp($currentMonth, "04") > 0) && (strcmp($currentMonth, "09") < 0))
	{
		$nextHolidayHeading = "None";
	}
	
	else 
	{
		for ($i = 0; $i < $numHolidays; $i++)
		{
			if ($currentDate <= $holidayDateBounds[$i])
			{
				$nextHolidayHeading = $holidayNames[$i];
				
				break;
			}
		}
		
		if ($i >= 9)
		{
			$nextHolidayHeading = $holidayNames[0];
		}
	}
	
	return $nextHolidayHeading;
}

/****
 ** Generates heading corresponding to target ingredient for given recipe slot on home page
 **
 ** @return    string  target ingredient heading
 **/
function getPopularIngredientHeading()
{
	$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";
	$INGREDIENT_PRIORITY_TOTAL = 276;
	$ingredientHeading = "None";
	
	$randomNum = rand(1, $INGREDIENT_PRIORITY_TOTAL);
	
	$handle = fopen($root . "catalogs/popularIngredientsPriorities.txt", "r");
	
	$prioritySum = 0;
	
	while (($ingredient = fgets($handle)) !== false)
	{
		//remove new line char from string
		$ingredient = substr($ingredient, 0, strlen($ingredient)-2);
		
		//split ingredient string into name and priority value
		$tokens = explode("%", $ingredient);
		
		$ingredientName = $tokens[0];
		$priority = $tokens[1];
		
		$prioritySum = $prioritySum + $priority;
		
		if ($prioritySum >= $randomNum)
		{
			$ingredientHeading = $ingredientName . " Recipes";
			
			break;
		}
	}
	
	fclose($handle);
	
	return $ingredientHeading;
}

/****
 ** Generates heading corresponding to unique feature for given recipe slot on home page
 **
 ** @return    string  unique feature heading
 **/
function getOtherFeatureHeading()
{
	$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";
	$OTHER_PRIORITY_TOTAL = 33;
	$otherFeatureHeading = "None";
	
	$randomNum = rand(1, $OTHER_PRIORITY_TOTAL);
	
	$handle = fopen($root . "catalogs/otherFeaturesPriorities.txt", "r");
	
	$prioritySum = 0;
	
	while (($otherFeature = fgets($handle)) !== false)
	{
		//remove new line char from string
		$otherFeature = substr($otherFeature, 0, strlen($otherFeature)-2);
		
		//split other feature string into name and priority value
		$tokens = explode("%", $otherFeature);
		
		$feature = $tokens[0];
		$priority = $tokens[1];
		
		$prioritySum = $prioritySum + $priority;
		
		if ($prioritySum >= $randomNum)
		{
			$otherFeatureHeading = $feature;
			
			break;
		}
	}
	
	fclose($handle);
	
	return $otherFeatureHeading;
}

/****
 ** Generates heading corresponding to next holiday for given recipe slot on home page
 **
 ** @return    string  holiday heading
 **/
function getEthnicityHeading()
{
	$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";
	$ETHNICITY_PRIORITY_TOTAL = 140;
	$ethnicityHeading = "None";
	
	$randomNum = rand(1, $ETHNICITY_PRIORITY_TOTAL);
	
	$handle = fopen($root . "catalogs/ethnicityPriorities.txt", "r");
	
	$prioritySum = 0;
	
	while (($ethnicity = fgets($handle)) !== false)
	{
		//remove new line char from string
		$ethnicity = substr($ethnicity, 0, strlen($ethnicity)-2);
		
		//split ethnicity string into name and priority value
		$tokens = explode("%", $ethnicity);
		
		$ethnicity = $tokens[0];
		$priority = $tokens[1];
		
		$prioritySum = $prioritySum + $priority;
		
		if ($prioritySum >= $randomNum)
		{
			$ethnicityHeading = $ethnicity . " Ethnicity";
			
			break;
		}
	}
	
	fclose($handle);
	
	return $ethnicityHeading;
}

/****
 ** Generates random recipe heading for given recipe slot on home page
 **
 ** @return    string  recipe slot heading
 **/
function generateHeading()
{
	$heading = "";
	 
    $randomNum = rand(1, 100);
	 
	if (($randomNum >= 1) && ($randomNum <= 24))
	{
		$heading = getMealTypeHeading();
	}

	if (($randomNum >= 25) && ($randomNum <= 28))
	{
	    $heading = "Under the Clock";
	}

	if (($randomNum >= 29) && ($randomNum <= 31))
	{
		$heading = "Newest";
	}
	
	if (($randomNum >= 32) && ($randomNum <= 42))
	{
		$heading = "Top Hit";
	}
	
	if (($randomNum >= 43) && ($randomNum <= 53))
	{
		$heading = "Trending Now";
	}
	
	if (($randomNum >= 54) && ($randomNum <= 58))
	{
		$heading = getNextHolidayHeading();
		
		if (strcmp($heading, "None") == 0)
		{
			generateHeading();
		}
	}
	
	if (($randomNum >= 59) && ($randomNum <= 63))
	{
		$heading = "New";
	}
	
	if (($randomNum >= 64) && ($randomNum <= 79))
	{
		$heading = getPopularIngredientHeading();
	}
	
	if (($randomNum >= 80) && ($randomNum <= 91))
	{
		$heading = getOtherFeatureHeading();
	}
	
	if (($randomNum >= 92) && ($randomNum <= 100))
	{
		$heading = getEthnicityHeading();
	}

	return $heading;
}

/****
 ** Determines if given recipe heading is a "meal" feature 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    boolean  true if recipe heading is "meal" type, false otherwise
 **/
function isMealType($heading)
{
	$isMealType = false;
	$mealHeadings = array("Jump-Start the Day", "Delicious Desserts", "Luscious Lunches", "Dinner Dining", "Appetizers & Snacks", "Adult Drinks", "Quench Your Thirst!");
	
	$mealHeadingCount = count($mealHeadings);
	
	for ($i = 0; $i < $mealHeadingCount; $i++)
	{
		if (strcmp($heading, $mealHeadings[$i]) == 0)
		{
			$isMealType = true;
			
			break;
		}
	}
	
	return $isMealType;
}

/****
 ** Determines if given recipe heading is an "under the clock" feature 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    boolean  true if recipe heading is "under the clock", false otherwise
 **/
function isUnderClock($heading)
{
	$isUnderClock = false;
	
	if (strcmp($heading, "Under the Clock") == 0)
	{
		$isUnderClock = true;
	}
	
	return $isUnderClock;
}

/****
 ** Determines if given recipe heading is a "newest" feature 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    boolean  true if recipe heading is "newest" type, false otherwise
 **/
function isNewest($heading)
{
	$isNewest = false;
	
	if (strcmp($heading, "Newest") == 0)
	{
		$isNewest = true;
	}
	
	return $isNewest;
}

/****
 ** Determines if given recipe heading is a "top hit" feature 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    boolean  true if recipe heading is "top hit" type, false otherwise
 **/
function isTopHit($heading)
{
	$isTopHit = false;
	
	if (strcmp($heading, "Top Hit") == 0)
	{
		$isTopHit = true;
	}
	
	return $isTopHit;
}

/****
 ** Determines if given recipe heading is a "trending now" feature 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    boolean  true if recipe heading is "trending now" type, false otherwise
 **/
function isTrendingNow($heading)
{
	$isTrendingNow = false;
	
	if (strcmp($heading, "Trending Now") == 0)
	{
		$isTrendingNow = true;
	}
	
	return $isTrendingNow;
}

/****
 ** Determines if given recipe heading is a "holiday" feature 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    boolean  true if recipe heading is "holiday" type, false otherwise
 **/
function isHoliday($heading)
{
	$isHoliday = false;
	
	$holidayNames = array("New Year", "Valentine's Day", "Saint Patrick's Day", "Easter", "Oktoberfest", "Thanksgiving", "Halloween", "Thanksgiving", "Christmas");
	
	$holidayCount = count($holidayNames);
	
	for ($i = 0; $i < $holidayCount; $i++)
	{
		if (strcmp($heading, $holidayNames[$i]) == 0)
		{
			$isHoliday = true;
			
			break;
		}
	}
	
	return $isHoliday;
}

/****
 ** Determines if given recipe heading is a "new" feature 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    boolean  true if recipe heading is "new" type, false otherwise
 **/
function isNew($heading)
{
	$isNew = false;
	
	if (strcmp($heading, "New") == 0)
	{
		$isNew = true;
	}
	
	return $isNew;
}

/****
 ** Determines if given recipe heading is a "popular ingredient" feature 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    boolean  true if recipe heading is "popular ingredient" type, false otherwise
 **/
function isPopularIngredient($heading)
{
	$isPopularIngredient = false;
	$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

	$handle = fopen($root . "catalogs/popularIngredientsPriorities.txt", "r");

	while (($ingredient = fgets($handle)) !== false)
	{
		//remove new line char from string
		$ingredient = substr($ingredient, 0, strlen($ingredient)-2);
		
		//split ingredient string into name and priority value
		$tokens = explode("%", $ingredient);
		
		$ingredientName = $tokens[0];

		if (strcmp($heading, $ingredientName . " Recipes") == 0)
		{
			$isPopularIngredient = true;
			
			break;
		}
	}
	
	fclose($handle);
	
	return $isPopularIngredient;
}

/****
 ** Determines if given recipe heading is a "other feature" feature 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    boolean  true if recipe heading is "other feature" type, false otherwise
 **/
function isOtherFeature($heading)
{
	$isOtherFeature = false;
	$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

	$handle = fopen($root . "catalogs/otherFeaturesPriorities.txt", "r");

	while (($otherFeature = fgets($handle)) !== false)
	{
		//remove new line char from string
		$otherFeature = substr($otherFeature, 0, strlen($otherFeature)-2);
		
		//split other feature string into name and priority value
		$tokens = explode("%", $otherFeature);
		
		$feature = $tokens[0];

		if (strcmp($heading, $feature) == 0)
		{
			$isOtherFeature = true;
			
			break;
		}
	}
	
	fclose($handle);
	
	return $isOtherFeature;
}

/****
 ** Determines if given recipe heading is an "ethnicity" feature 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    boolean  true if recipe heading is "ethnicity" type, false otherwise
 **/
function isEthnicity($heading)
{
	$isEthnicity = false;
	
	$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

	$handle = fopen($root . "catalogs/ethnicityPriorities.txt", "r");

	while (($ethnicity = fgets($handle)) !== false)
	{
		//remove new line char from string
		$ethnicity = substr($ethnicity, 0, strlen($ethnicity)-2);
		
		//split ethnicity string into name and priority value
		$tokens = explode("%", $ethnicity);
		
		$ethnicity = $tokens[0];

		if (strcmp($heading, $ethnicity . " Ethnicity") == 0)
		{
			$isEthnicity = true;
			
			break;
		}
	}
	
	fclose($handle);
	
	return $isEthnicity;
}

/****
 ** Randomly selects one recipe from list of given recipes
 **
 ** @param    string  $recipes  list of recipes
 ** @return    Recipe  recipe
 **/
function selectRandomCandidate($recipes)
{
	$recipe = new Recipe;
	$recipeCount = count($recipes);
	$randomNum = 0;
	
	$randomNum = rand(0, $recipeCount-1);
	
	$recipe = $recipes[$randomNum];
	
	return $recipe;
}

/****
 ** Generates recipe that corresponds to "meal" feature headings 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    Recipe  recipe
 **/
function generateByMealType($heading)
{
	$recipe = new Recipe;
	$recipeSelector = new Recipe;
	$mealType = "";
	$candidates = array();

	//get recipe based on given meal category
	switch ($heading)
	{
		case "Jump-Start the Day":
		{
			$candidates = $recipeSelector->selectByMealType("Breakfast");
			
			break;
		}
		
		case "Delicious Desserts":
		{
			$candidates = $recipeSelector->selectByMealType("Dessert");
			
			break;
		}
		
		case "Luscious Lunches":
		{
			$candidates = $recipeSelector->selectByMealType("Lunch");
			
			break;
		}
		
		case "Dinner Dining":
		{
			$candidates = $recipeSelector->selectByMealType("Dinner");
			
			break;
		}
		
		case "Appetizers & Snacks":
		{
			//40% chance to choose from appetizers, 60% for snacks
			$randomNum = rand(1, 5);
			
			if ($randomNum <= 2)
			{
				$candidates = $recipeSelector->selectByMealType("Appetizer");
			}
			
			else 
			{
				$candidates = $recipeSelector->selectByMealType("Snack");
			}
			
			break;
		}
		
		case "Adult Drinks":
		{
			$candidates = $recipeSelector->selectByMealType("Alcohol");
			
			break;
		}
		
		case "Quench Your Thirst!":
		{
			$candidates = $recipeSelector->selectByMealType("Beverage");
			
			break;
		}
	}
	
	if (count($candidates) != 0)
	{
		$recipe = selectRandomCandidate($candidates);
	}
	
	else 
	{
		$recipe = null;
	}

	return $recipe;
}

/****
 ** Generates recipe that corresponds to "under the clock" feature headings 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    Recipe  recipe
 **/
function generateByUnderClock($heading)
{
	$recipe = new Recipe;
	$recipeSelector = new Recipe;
	
	$candidates = $recipeSelector->selectByTimeLimit(20);
	
	if (count($candidates) != 0)
	{
		$recipe = selectRandomCandidate($candidates);
	}
	
	else 
	{
		$recipe = null;
	}
	
	return $recipe;
}

/****
 ** Generates recipe that corresponds to "newest" feature headings 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    Recipe  recipe
 **/
function generateByNewest($heading)
{
	$recipe = new Recipe;
	$recipeSelector = new Recipe;
	
	$newestID = $recipeSelector->selectNextID() - 1;
	
	$recipe = $recipeSelector->selectByRecipeID($newestID);
	
	if (count($recipe) == 0)
	{
		$recipe = null;
	}
	
	return $recipe;
}

/****
 ** Generates recipe that corresponds to "top hit" feature headings 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    Recipe  recipe
 **/
function generateByTopHit($heading)
{
	$recipe = new Recipe;
	$recipeSelector = new Recipe;
	
	return $recipe;
}

/****
 ** Generates recipe that corresponds to "trending now" feature headings 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    Recipe  recipe
 **/
function generateByTrendingNow($heading)
{
	$recipe = new Recipe;
	$recipeSelector = new Recipe;
	
	return $recipe;
}

/****
 ** Generates recipe that corresponds to "holiday" feature headings 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    Recipe  recipe
 **/
function generateByHoliday($heading)
{
	$recipe = new Recipe;
	$recipeSelector = new Recipe;
	$holiday = "";
	$candidates = array();
	
	//get recipe based on given holiday category
	switch ($heading)
	{
		case "New Year":
		{
			$candidates = $recipeSelector->selectByHoliday("New Year");
			
			break;
		}
		
		case "Valentine's Day":
		{
			$candidates = $recipeSelector->selectByHoliday("Valentine's Day");
			
			break;
		}
		
		case "Saint Patrick's Day":
		{
			$candidates = $recipeSelector->selectByHoliday("Saint Patrick's Day");
			
			break;
		}
		
		case "Easter":
		{
			$candidates = $recipeSelector->selectByHoliday("Easter");
			
			break;
		}
		
		case "Oktoberfest":
		{
			$candidates = $recipeSelector->selectByHoliday("Oktoberfest");
			
			break;
		}
		
		case "Thanksgiving":
		{
			$candidates = $recipeSelector->selectByHoliday("Thanksgiving");
			
			break;
		}
		
		case "Halloween":
		{
			$candidates = $recipeSelector->selectByHoliday("Halloween");
			
			break;
		}
		
		case "Christmas":
		{
			$candidates = $recipeSelector->selectByHoliday("Christmas");
			
			break;
		}
	}
	
	if (count($candidates) != 0)
	{
		$recipe = selectRandomCandidate($candidates);
	}
	
	else 
	{
		$recipe = null;
	}

	return $recipe;
}

/****
 ** Generates recipe that corresponds to "new" feature headings 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    Recipe  recipe
 **/
function generateByNew($heading)
{
	$recipe = new Recipe;
	$recipeSelector = new Recipe;
	
	$newestID = $recipeSelector->selectNextID() - 1;
	
	$lowerBound = $newestID - 10;
	$upperBound = $newestID - 1;
	
	//choose random recipe ranging from 11th newest to 2nd newest 
	$randomNum = rand($lowerBound, $upperBound);
		
	$recipe = $recipeSelector->selectByRecipeID($randomNum);
	
	if (count($recipe) == 0)
	{
		$recipe = null;
	}
	
	return $recipe;
}

/****
 ** Generates recipe that corresponds to "popular ingredient" feature headings 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    Recipe  recipe
 **/
function generateByPopularIngredient($heading)
{
	$recipe = new Recipe;
	$recipeSelector = new Recipe;
	
	//split heading string into name and priority value
	$tokens = explode(" ", $heading);
	
	$ingredient = $tokens[0];
	
	//find recipes in database with popular ingredient (plural form) in heading (singular form) 
	switch ($ingredient)
	{
		//special singular form "berry" not sub-string of plural form (won't detect in database)
		case "berry":
		{
			$candidates = $recipeSelector->selectByPopularIngredient("berries");
		}
		
		//special singular form "pastry" not sub-string of plural form (won't detect in database)
		case "pastry":
		{
			$candidates = $recipeSelector->selectByPopularIngredient("pastries");
		}
		
		default:
		{
			$candidates = $recipeSelector->selectByPopularIngredient($ingredient);
		}
	}
	
	if (count($candidates) != 0)
	{
		$recipe = selectRandomCandidate($candidates);
	}
	
	else 
	{
		$recipe = null;
	}
	
	return $recipe;
}

/****
 ** Generates recipe that corresponds to "other" feature headings 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    Recipe  recipe
 **/
function generateByOtherFeature($heading)
{
	$recipe = new Recipe;
	$recipeSelector = new Recipe;
	
	$candidates = $recipeSelector->selectByOtherFeature($heading);
	
	if (count($candidates) != 0)
	{
		$recipe = selectRandomCandidate($candidates);
	}
	
	else 
	{
		$recipe = null;
	}
	
	return $recipe;
}

/****
 ** Generates recipe that corresponds to "ethnicity" feature headings 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    Recipe  recipe
 **/
function generateByEthnicity($heading)
{
	$recipe = new Recipe;
	$recipeSelector = new Recipe;
	$ethnicity = "";
	$candidates = array();
	
	//split ethnicity string into name and literal "ethnicity" value
	$tokens = explode(" ", $ethnicity);
	$tokenCount = count($tokens);
	
	$upperBound = $tokenCount - 1;
	
	//ethnicity name contains all space values excluding last space 
	for ($i = 0; $i < $upperBound; $i++)
	{
		$ethnicity = $ethnicity . $tokens[$i];
	}
	
	$candidates = $recipeSelector->selectByEthnicity($ethnicity);
	
	if (count($candidates) != 0)
	{
		$recipe = selectRandomCandidate($candidates);
	}
	
	else 
	{
		$recipe = null;
	}
	
	return $recipe;
}
 
/****
 ** Generates recipe that corresponds to recipe slot heading 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    Recipe  recipe
 **/
function generateRecipe($heading)
{
	$recipe = new Recipe;
	
	if (isMealType($heading) == true)
	{
		$recipe = generateByMealType($heading);
	}
	
	if (isUnderClock($heading) == true)
	{
		$recipe = generateByUnderClock($heading);
	}
	
	if (isNewest($heading) == true)
	{
		$recipe = generateByNewest($heading);
	}
	
	if (isTopHit($heading) == true)
	{
		$recipe = generateByTopHit($heading);
	}
	
	if (isTrendingNow($heading) == true)
	{
		$recipe = generateByTrendingNow($heading);
	}
	
	if (isHoliday($heading) == true)
	{
		$recipe = generateByHoliday($heading);
	}
	
	if (isNew($heading) == true)
	{
		$recipe = generateByNew($heading);
	}
	
	if (isPopularIngredient($heading) == true)
	{
		$recipe = generateByPopularIngredient($heading);
	}
	
	if (isOtherFeature($heading) == true)
	{
		$recipe = generateByOtherFeature($heading);
	}
	
	if (isEthnicity($heading) == true)
	{
		$recipe = generateByEthnicity($heading);
	}
	 
	return $recipe;
}
?>