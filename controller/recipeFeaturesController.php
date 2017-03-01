<?php 
/******************************************************************************************
*******************************************************************************************
** Name: recipeFeaturesController.php												   ****
** Description: Provides functionality for verifying recipe features entered by a      ****
** given user and assigning to global variables for further use 					   ****					
** Date Created: 07/24/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeMingle/";

/****
 ** Unsets the array feature values saved as global variables 
 **
 **/
function unsetArrays()
{
	//clear popular features global array
	if (isset($_SESSION["popular-type"][0]) == true)
	{
		$upperBound = sizeof($_POST["popular-type"]);

		for ($i = 1; $i <= $upperBound; $i++)
		{
			unset($_SESSION["popular-type"][$i]);
		}
	}
	
	//clear other features global array
	if (isset($_SESSION["other-type"][0]) == true)
	{
		$upperBound = sizeof($_POST["other"]);

		for ($i = 1; $i <= $upperBound; $i++)
		{
			unset($_SESSION["other-type"][$i]);
		}
	}
}

/****
 ** Loads the recipe features input page and removes saved feature 
 ** values 
 **
 **/
function reEnterInput()
{
	//go back to recipe features input 
	header("Location: http://localhost/RecipeMingle/view/addRecipeFeatures.php"); 
	
	unsetArrays();
	
	exit(); 
}

//if ethnicity feature checked, remember it
if (isset($_POST["ethnicity"]) == true)
{
	$handle = fopen($root . "catalogs/ethnicityFeatures.txt", "r");
	
	$count = 1;
	
	while (($ethnicity = fgets($handle)) !== false)
	{
		//remove new line char from string
		$ethnicity = substr($ethnicity, 0, strlen($ethnicity)-2);
		
		if (strcmp($_POST["ethnicity"], $ethnicity) == 0)
		{
			$_SESSION["ethnicity" . $count] = "set";

			break;
		}
		
		$count++;
	}
	
	fclose($handle);
}

//if meal type feature checked, remember it
if (isset($_POST["meal-type"]) == true)
{
	$handle = fopen($root . "catalogs/mealTypeFeatures.txt", "r");
	
	$count = 1;

	while (($mealType = fgets($handle)) !== false)
	{
		//remove new line char from string
		$mealType = substr($mealType, 0, strlen($mealType)-2);

		if (strcmp($_POST["meal-type"], $mealType) == 0)
		{
			$_SESSION["meal-type" . $count] = "set";

			break;
		}
		
		$count++;
	}
	
	fclose($handle);
}

//if popular type feature checked, remember it
if (isset($_POST["popular-type"][0]) == true)
{
	$handle = fopen($root . "catalogs/popularFeatures.txt", "r");
	
	$count = 1;
	$upperBound = sizeof($_POST["popular-type"]);

	while (($popular = fgets($handle)) !== false)
	{
		//remove new line char from string
		$popular = substr($popular, 0, strlen($popular)-2);
		
		for ($i = 0; $i < $upperBound; $i++)
		{
			if (strcmp($_POST["popular-type"][$i], $popular) == 0)
			{
				$_SESSION["popular-type" . $count] = "set";
			}
		}
		
		$count++;
	}
	
	fclose($handle);
}

//if other type features checked, remember them
if (isset($_POST["other"][0]) == true)
{
	$handle = fopen($root . "catalogs/otherFeatures.txt", "r");
	
	$count = 1;
	$upperBound = sizeof($_POST["other"]);

	while (($other = fgets($handle)) !== false)
	{
		//remove new line char from string
		$other = substr($other, 0, strlen($other)-2);
		
		for ($i = 0; $i < $upperBound; $i++)
		{
			if (strcmp($_POST["other"][$i], $other) == 0)
			{
				$_SESSION["other" . $count] = "set";
			}
		}
		
		$count++;
	}
	
	fclose($handle);
}

//if holiday feature checked, remember it
if (isset($_POST["holiday"]) == true)
{
	$handle = fopen($root . "catalogs/holidayFeatures.txt", "r");
	
	$count = 1;

	while (($holiday = fgets($handle)) !== false)
	{
		//remove new line char from string
		$holiday = substr($holiday, 0, strlen($holiday)-2);

		if (strcmp($_POST["holiday"], $holiday) == 0)
		{
			$_SESSION["holiday" . $count] = "set";

			break;
		}
		
		$count++;
	}
	
	fclose($handle);
}

//if ethnicity feature not checked
if (isset($_POST["ethnicity"]) === false)
{
	//go back to features input page
	$_SESSION["emptyEthnicity"] = "set";
	
	reEnterInput();
}

//if meal type feature not checked
if (isset($_POST["meal-type"]) === false)
{
	//go back to features input page
	$_SESSION["emptyMealType"] = "set";
	
	reEnterInput();
}

//if meal type feature not checked
if (isset($_POST["holiday"]) === false)
{
	//go back to features input page
	$_SESSION["emptyHoliday"] = "set";
	
	reEnterInput();
}

//save "select-one" feature values if all inputted
$_SESSION["ethnicity"] = $_POST["ethnicity"];
$_SESSION["meal-type"] = $_POST["meal-type"];
$_SESSION["holiday"] = $_POST["holiday"];

//assign all popular food/drink feature values to session array 
$count = sizeof($_POST["popular-type"]);

$_SESSION["popular-type"] = array();

for ($i = 0; $i < $count; $i++)
{
	$_SESSION["popular-type"][$i] = $_POST["popular-type"][$i];
}

//assign all other feature values to session array 
$count = sizeof($_POST["other"]);

$_SESSION["other-type"] = array();

for ($i = 0; $i < $count; $i++)
{
	$_SESSION["other-type"][$i] = $_POST["other"][$i];
}

//go to recipe ingredients page 
header("Location: http://localhost/RecipeMingle/view/addRecipeIngredients.php"); 
exit(); 
?>
