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
include($root . "model/review.php");
include($root . "model/cookbook.php");

/****
 ** Generates random meal type heading for given recipe slot on home page
 **
 ** @return    string  meal type heading
 **/
function getMealTypeHeading()
{
	$mealTypeHeading = "";
	$mealTypeHeadings = array("Jump-Start the Day", "Breakfast Ideas", "Delicious Desserts", "Sweet Treats", "Time for Dessert", "Lunch Time", "Lovable Lunches", "Dinner Dining", "Supper Time", 
							"Appetizers", "Starters", "Snacks", "Snack Ideas", "Adult Drinks", "Alcoholic Beverages", "Quench Your Thirst!", "Tasty Beverages");
	
	$randomNum = rand(0, 16);
	
	for ($i = 0; $i <= 16; $i++)
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
	$INGREDIENT_PRIORITY_TOTAL = 292;
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
	$OTHER_PRIORITY_TOTAL = 32;
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
	$ETHNICITY_PRIORITY_TOTAL = 141;
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
	 
	if (($randomNum >= 1) && ($randomNum <= 26))
	{
		$heading = getMealTypeHeading();
	}

	if (($randomNum >= 27) && ($randomNum <= 30))
	{
	    $heading = "Under the Clock";
	}

	if (($randomNum >= 31) && ($randomNum <= 32))
	{
		$heading = "Newest";
	}
	
	if (($randomNum >= 33) && ($randomNum <= 40))
	{
		$heading = "Top Hits";
	}
	
	if (($randomNum >= 41) && ($randomNum <= 42))
	{
		$heading = "Chef Favourites";
	}
	
	if (($randomNum >= 43) && ($randomNum <= 50))
	{
		$heading = "Trending Now";
	}
	
	if (($randomNum >= 51) && ($randomNum <= 52))
	{
		$heading = "Spotlight";
	}
	
	if (($randomNum >= 53) && ($randomNum <= 57))
	{
		$heading = getNextHolidayHeading();
		
		if (strcmp($heading, "None") == 0)
		{
			generateHeading();
		}
	}
	
	if (($randomNum >= 58) && ($randomNum <= 62))
	{
		$heading = "New";
	}
	
	if (($randomNum >= 63) && ($randomNum <= 77))
	{
		$heading = getPopularIngredientHeading();
	}
	
	if (($randomNum >= 78) && ($randomNum <= 90))
	{
		$heading = getOtherFeatureHeading();
	}
	
	if (($randomNum >= 91) && ($randomNum <= 100))
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
	$mealHeadings = array("Jump-Start the Day", "Breakfast Ideas", "Delicious Desserts", "Sweet Treats", "Time for Dessert", "Lunch Time", "Lovable Lunches", "Dinner Dining", "Supper Time", 
							"Appetizers", "Starters", "Snacks", "Snack Ideas", "Adult Drinks", "Alcoholic Beverages", "Quench Your Thirst!", "Tasty Beverages");
	
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
	
	if ((strcmp($heading, "Top Hits") == 0) || (strcmp($heading, "Chef Favourites") == 0))
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
	
	if ((strcmp($heading, "Trending Now") == 0) || (strcmp($heading, "Spotlight") == 0))
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
 ** Randomly selects one array value from list of given arrays
 **
 ** @param    double array  $arrayList  list of given arrays
 ** @return    array  array value
 **/
function selectRandomCandidate($arrayList)
{
	$arrayValue = array();
	$listCount = count($arrayList);
	$randomNum = 0;
	
	$randomNum = rand(0, $listCount-1);
	
	$arrayValue = $arrayList[$randomNum];
	
	return $arrayValue;
}

/****
 ** Generates recipe that corresponds to "meal" feature headings 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    array  recipe
 **/
function generateByMealType($heading)
{
	$recipe = array();
	$recipeSelector = new Recipe;
	$mealType = "";
	$candidates = array();
	
	array("Jump-Start the Day", "Breakfast Ideas", "Delicious Desserts", "Sweet Treats", "Time for Dessert", "Lunch Time", "Lovable Lunches", "Dinner Dining", "Supper Time", 
							"Appetizers", "Starters", "Snacks", "Snack Ideas", "Adult Drinks", "Alcoholic Beverages", "Quench Your Thirst!", "Tasty Beverages");

	//get recipe based on given meal category
	switch ($heading)
	{
		case "Jump-Start the Day":
		{
			$candidates = $recipeSelector->selectByMealType("Breakfast");
			
			break;
		}
		
		case "Breakfast Ideas":
		{
			$candidates = $recipeSelector->selectByMealType("Breakfast");
			
			break;
		}
		
		case "Delicious Desserts":
		{
			$candidates = $recipeSelector->selectByMealType("Dessert");
			
			break;
		}
		
		case "Sweet Treats":
		{
			$candidates = $recipeSelector->selectByMealType("Dessert");
			
			break;
		}
		
		case "Time for Dessert":
		{
			$candidates = $recipeSelector->selectByMealType("Dessert");
			
			break;
		}
		
		case "Lunch Time":
		{
			$candidates = $recipeSelector->selectByMealType("Lunch");
			
			break;
		}
		
		case "Lovable Lunches":
		{
			$candidates = $recipeSelector->selectByMealType("Lunch");
			
			break;
		}
		
		case "Dinner Dining":
		{
			$candidates = $recipeSelector->selectByMealType("Dinner");
			
			break;
		}
		
		case "Supper Time":
		{
			$candidates = $recipeSelector->selectByMealType("Dinner");
			
			break;
		}

		case "Appetizers":
		{
			$candidates = $recipeSelector->selectByMealType("Appetizer");
			
			break;
		}
		
		case "Starters":
		{
			$candidates = $recipeSelector->selectByMealType("Appetizer");
			
			break;
		}
		
		case "Snacks":
		{
			$candidates = $recipeSelector->selectByMealType("Snack");
			
			break;
		}
		
		case "Snack Ideas":
		{
			$candidates = $recipeSelector->selectByMealType("Snack");
			
			break;
		}
		
		case "Adult Drinks":
		{
			$candidates = $recipeSelector->selectByMealType("Alcohol");
			
			break;
		}
		
		case "Alcoholic Beverages":
		{
			$candidates = $recipeSelector->selectByMealType("Alcohol");
			
			break;
		}
		
		case "Quench Your Thirst!":
		{
			$candidates = $recipeSelector->selectByMealType("Beverage");
			
			break;
		}
		
		case "Tasty Beverages":
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
 ** @return    array  recipe
 **/
function generateByUnderClock()
{
	$recipe = array();
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
 ** @return    array  recipe
 **/
function generateByNewest()
{
	$recipe = array();
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
 ** Filters given recipe IDs into 5-star, 4.5-star and 4-star 
 ** categories then returns one of the category groups using
 ** calculated odds
 **
 ** @param    double array  $candidates  recipe IDs and corresponding average rating (descending order)
 ** @return    double array  rating group of recipe IDs 
 **/
function randomRatingCategory($candidates)
{
	$index = 0;
	$groupIndex = 0;
	$randomNum = 0;
	$chosenGroup = array(); /* group of recipe IDs to return (by chosen rating value) */
	
	$randomNum = rand(1, 100);
	
	//assign required recipe IDs to 4-star rating group (if group chosen)
	if ($randomNum <= 3)
	{
		//traverse to 4-star ratings in sorted rating array
		while (1)
		{
			//traverse to 4.5-star ratings in sorted rating array
			if ($candidates[$index][1] < 3.75)
			{
				break;
			}
				
			if (($candidates[$index][1] < 4.25) && ($candidates[$index][1] >= 3.75))
			{
				$chosenGroup[$groupIndex] = $candidates[$index][0];
					
				$groupIndex++;
			}
				
			$index++;
		}
	}
	
	//assign required recipe IDs to 4.5-star rating group (if group chosen)
	if (($randomNum >= 4) && ($randomNum <= 33))
	{
		while (1)
		{
			//traverse to 4.5-star ratings in sorted rating array
			if ($candidates[$index][1] < 4.25)
			{
				break;
			}
				
			if (($candidates[$index][1] < 4.75) && ($candidates[$index][1] >= 4.25))
			{
				$chosenGroup[$groupIndex] = $candidates[$index][0];
					
				$groupIndex++;
			}
				
			$index++;
		}
	}
	
	//assign required recipe IDs to 5-star rating group (if group chosen)
	if ($randomNum >= 34)
	{
		//already begins at 5-star ratings
		while (1)
		{
			if ($candidates[$index][1] < 4.75)
			{
				break;
			}
			
			else 
			{
				$chosenGroup[$groupIndex] = $candidates[$index][0];
				
				$index++;
				$groupIndex++;
			}
		}
	}
	
	return $chosenGroup;
}

/****
 ** Generates recipe that corresponds to "top hit" feature headings 
 **
 ** @return    array  recipe
 **/
function generateByTopHit()
{
	$recipe = array();
	$review = array();
	$reviewSelector = new Review;
	$recipeSelector = new Recipe;
	$candidates = array();
	$randomNum = 0;
	
	$candidates = $reviewSelector->selectAverageRatings();
	
	$candidates = randomRatingCategory($candidates);
	
	if (count($candidates) != 0)
	{
		$review = selectRandomCandidate($candidates);
		
		$recipe = $recipeSelector->selectByRecipeID($review);
		
		if (count($recipe) == 0)
		{
			$recipe = null;
		}
	}
	
	else 
	{
		$recipe = null;
	}
	
	return $recipe;
}

/****
 ** Generates recipe that corresponds to "trending now" feature headings 
 **
 ** @return    array  recipe
 **/
function generateByTrendingNow()
{
	$recipe = array();
	$cookbook = array();
	$recipeSelector = new Recipe;
	$cookbookSelector = new Cookbook;
	$candidates = array();
	
	$candidates = $cookbookSelector->frequentRecipeIDs();
	
	$cookbook = selectRandomCandidate($candidates);
	
	$recipe = $recipeSelector->selectByRecipeID($cookbook[0]);
	
	return $recipe;
}

/****
 ** Generates recipe that corresponds to "holiday" feature headings 
 **
 ** @param    string  $heading  recipe slot heading
 ** @return    array  recipe
 **/
function generateByHoliday($heading)
{
	$recipe = array();
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
 ** @return    array  recipe
 **/
function generateByNew()
{
	$recipe = array();
	$recipeSelector = new Recipe;
	$newOdds = array(10, 11, 12, 13, 14, 15, 16, 17, 18, 19); /* odds of randomly selecting newest recipes IDs (oldest to newest)*/ 
	$newOddsTotal = 145;
	$sum = 0;
	$chosenID = 0;
	
	$newestID = $recipeSelector->selectNextID() - 1;
	
	$eleventhNewest = $newestID - 10;
	
	//choose random number within odds range 
	$randomNum = rand(1, 145);
	
	$upperBound = count($newOdds);
	
	for ($i = 0; $i < $upperBound; $i++)
	{
		$sum = $sum + $newOdds[$i];
		
		if ($randomNum <= $sum)
		{
			$chosenID = $eleventhNewest + $i;
			
			break;
		}
	}
		
	$recipe = $recipeSelector->selectByRecipeID($chosenID);
	
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
 ** @return    array  recipe
 **/
function generateByPopularIngredient($heading)
{
	$recipe = array();
	$recipeSelector = new Recipe;
	$candidates = array();
	
	//split heading string into name and priority value
	$tokens = explode(" ", $heading);
	
	$ingredient = $tokens[0];
	
	//find recipes in database with popular ingredient (plural form) in heading (singular form) 
	if ((strcmp("Berry", $ingredient ) == 0) || (strcmp("Pastry", $ingredient ) == 0))
	{
		//special singular form "berry" not sub-string of plural form (won't detect in database)
		if (strcmp("Berry", $ingredient) == 0)
		{
			$candidates = $recipeSelector->selectByPopularIngredient("Berries");
		}
		
		//special singular form "pastry" not sub-string of plural form (won't detect in database)
		if (strcmp("Pastry", $ingredient) == 0)
		{
			$candidates = $recipeSelector->selectByPopularIngredient("Pastries");
		}
	}
	
	else 
	{
		$candidates = $recipeSelector->selectByPopularIngredient($ingredient);
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
 ** @return    array  recipe
 **/
function generateByOtherFeature($heading)
{
	$recipe = array();
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
 ** @return    array  recipe
 **/
function generateByEthnicity($heading)
{
	$recipe = array();
	$recipeSelector = new Recipe;
	$ethnicity = "";
	$candidates = array();
	
	//split heading string into name and literal "ethnicity" value
	$tokens = explode(" ", $heading);
	$tokenCount = count($tokens);
	
	$upperBound = $tokenCount - 1;
	
	//ethnicity name contains all space values excluding last space 
	for ($i = 0; $i < $upperBound; $i++)
	{
		$ethnicity = $ethnicity . $tokens[$i];
		
		if ($i != ($upperBound-1))
		{
			$ethnicity = $ethnicity . " ";
		}
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
 ** @return    array  recipe
 **/
function generateRecipe($heading)
{
	$recipe = array();
	
	if (isMealType($heading) == true)
	{
		$recipe = generateByMealType($heading);
	}
	
	if (isUnderClock($heading) == true)
	{
		$recipe = generateByUnderClock();
	}
	
	if (isNewest($heading) == true)
	{
		$recipe = generateByNewest();
	}
	
	if (isTopHit($heading) == true)
	{
		$recipe = generateByTopHit();
	}
	
	if (isTrendingNow($heading) == true)
	{
		$recipe = generateByTrendingNow();
	}
	
	if (isHoliday($heading) == true)
	{
		$recipe = generateByHoliday($heading);
	}
	
	if (isNew($heading) == true)
	{
		$recipe = generateByNew();
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