<?php
/******************************************************************************************
*******************************************************************************************
** Name: cookbookUtilities.php													       ****
** Description: Provides helper functions for "cookbook.php"			   			   ****
** Author: Rhys Hall																   ****
** Date Created: 06/24/2017														   	   ****
*******************************************************************************************
******************************************************************************************/

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

/****
** Sorts user's recipes in order from most recent 
** to least recent
**
** @return    array  indexes of most-to-least recent
**            recipe ordering 
*/
function sortRecipesMostRecent($recipes)
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
			
			if (strcmp($recipes[$index1]["date_added"], $recipes[$index2]["date_added"]) > 0)
			{
				$indexes[$i] = $index2;
				$indexes[$j] = $index1;
			}
		}
	}
	
	return $indexes;
}

/****
** Sorts user's cookbook recipes in alphabetical order by 
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
** Sorts user's recipes in order from least recent to 
** most recent
**
** @return    array  indexes of least-to-most recent
**            recipe ordering 
*/
function sortRecipesLeastRecent($recipes)
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
			
			if (strcmp($recipes[$index1]["date_added"], $recipes[$index2]["date_added"]) < 0)
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
	$MOST_RECENT = 1;
	$ALPHABETICAL = 2;
	$REVERSE_ALPHABETICAL = 3;
	$LEAST_RECENT = 4;
	$indexes = array();
	
	//if sort type is set to "most recent"
	if ($sortType == $MOST_RECENT)
	{
		$indexes = sortRecipesMostRecent($recipes);
	}
	
	//if sort type is set to "alphabetical" 
	if ($sortType == $ALPHABETICAL)
	{
		$indexes = sortRecipesAlphabetical($recipes);
	}
	
	//if sort type is set to "reverse alphabetical" 
	if ($sortType == $REVERSE_ALPHABETICAL)
	{
		$indexes = sortRecipesReverse($recipes);
	}
	
	//if sort type is set to "least recent"
	if ($sortType == $LEAST_RECENT)
	{
		$indexes = sortRecipesLeastRecent($recipes);
	}
	
	return $indexes;
}
?>
