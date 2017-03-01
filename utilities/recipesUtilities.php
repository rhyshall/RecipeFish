<?php
/******************************************************************************************
*******************************************************************************************
** Name: recipesUtilities.php													       ****
** Description: Provides helper functions for "recipes.php"			   				   ****
** Author: Rhys Hall																   ****
** Date Created: 09/17/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeMingle/";

/****
** Determines if current user has existing recipe in 
** Recipe Mingle database 
**
** @return    boolean  validity of existing recipe
*/
function hasRecipe()
{
	$hasRecipe = false;
	
	$recipeSelector = new Recipe;

	$recipeList = $recipeSelector->selectAll();
	
	$size = count($recipeList);
	
	for ($i = 0; $i < $size; $i++)
	{
		if ($recipeList[$i]["author_id"] == $_SESSION["userID"])
		{
			$hasRecipe = true;
			
			break;
		}
	}
	
	return $hasRecipe;
}

/****
** Sorts user's recipes in alphabetical order by 
** recipe name 
**
** @return    array  indexes of alphabetical recipe name 
**            ordering 
*/
function sortRecipesAlphabetical($recipes)
{
	$count = count($recipes);
	$indexes = array();
	
	//set default index ordering 
	for ($i = 0; $i < $count; $i++)
	{
		$indexes[$i] = $i;
	}
	
	//sort indexes based on recipe name alphabetical ordering 
	for ($i = 0; $i < $count; $i++)
	{
		for ($j = 0; ($j < $count) && ($j != $i); $j++)
		{
			$index1 = $indexes[$i];
			$index2 = $indexes[$j];
			
			if (strcmp($recipes[$index1]["name"], $recipes[$index2]["name"]) < 0)
			{
				$indexes[$i] = $index2;
				$indexes[$j] = $index1;
			}
		}
	}
	
	return $indexes;
}

/****
** Sorts user's recipes in newest-to-oldest 
** order
**
** @return    array  indexes of newest-to-oldest 
**            recipe ordering 
*/
function sortRecipesNewest($recipes)
{
	$count = count($recipes);
	$indexes = array();
	
	//set default index ordering 
	for ($i = 0; $i < $count; $i++)
	{
		$indexes[$i] = $i;
	}
	
	//sort indexes based on recipe newest-to-oldest ordering 
	for ($i = 0; $i < $count; $i++)
	{
		for ($j = 0; ($j < $count) && ($j != $i); $j++)
		{
			$index1 = $indexes[$i];
			$index2 = $indexes[$j];
			
			if (strcmp($recipes[$index1]["date_uploaded"], $recipes[$index2]["date_uploaded"]) > 0)
			{
				$indexes[$i] = $index2;
				$indexes[$j] = $index1;
			}
		}
	}
	
	return $indexes;
}

/****
** Sorts user's recipes in oldest-to-newest
** order by 
**
** @return    array  indexes of oldest-to-newest
**            recipe ordering 
*/
function sortRecipesOldest($recipes)
{
	$count = count($recipes);
	$indexes = array();
	
	//set default index ordering 
	for ($i = 0; $i < $count; $i++)
	{
		$indexes[$i] = $i;
	}
	
	//sort indexes based on recipe newest-to-oldest ordering 
	for ($i = 0; $i < $count; $i++)
	{
		for ($j = 0; ($j < $count) && ($j != $i); $j++)
		{
			$index1 = $indexes[$i];
			$index2 = $indexes[$j];
			
			if (strcmp($recipes[$index1]["date_uploaded"], $recipes[$index2]["date_uploaded"]) < 0)
			{
				$indexes[$i] = $index2;
				$indexes[$j] = $index1;
			}
		}
	}
	
	return $indexes;
}

/****
** Sorts user's recipes in reverse alphabetical order 
** by recipe name 
**
** @return    array  indexes of reverse alphabetical 
**            name ordering 
*/
function sortRecipesReverse($recipes)
{
	$count = count($recipes);
	$indexes = array();
	
	//set default index ordering 
	for ($i = 0; $i < $count; $i++)
	{
		$indexes[$i] = $i;
	}
	
	//sort indexes based on recipe name reverse alphabetical ordering 
	for ($i = 0; $i < $count; $i++)
	{
		for ($j = 0; ($j < $count) && ($j != $i); $j++)
		{
			$index1 = $indexes[$i];
			$index2 = $indexes[$j];
			
			if (strcmp($recipes[$index1]["name"], $recipes[$index2]["name"]) > 0)
			{
				$indexes[$i] = $index2;
				$indexes[$j] = $index1;
			}
		}
	}
	
	return $indexes;
}

/****
** Sorts user's recipes based on user sort type 
**
** @return    array  indexes of sorted recipe ordering 
*/
function sortRecipes($recipes, $sortType)
{
	$ALPHABETICAL = 1;
	$NEWEST_TO_OLDEST = 2;
	$OLDEST_TO_NEWEST = 3;
	$REVERSE_ALPHABETICAL = 4;
	$indexes = array();
	
	//if sort type is set to "alphabetical" 
	if ($sortType == $ALPHABETICAL)
	{
		$indexes = sortRecipesAlphabetical($recipes);
	}
	
	//if sort type is set to "newest to oldest"
	if ($sortType == $NEWEST_TO_OLDEST)
	{
		$indexes = sortRecipesNewest($recipes);
	}
	
	//if sort type is set to "oldest to newest"
	if ($sortType == $OLDEST_TO_NEWEST)
	{
		$indexes = sortRecipesOldest($recipes);
	}
	
	//if sort type is set to "reverse alphabetical" 
	if ($sortType == $REVERSE_ALPHABETICAL)
	{
		$indexes = sortRecipesReverse($recipes);
	}
	
	return $indexes;
}
?>
