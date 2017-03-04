<?php 
/******************************************************************************************
*******************************************************************************************
** Name: recipeIngredientsController.php											   ****
** Description: Provides functionality for verifying recipe ingredients entered by a   ****
** given user and assigning to global variables for further use 					   ****					
** Date Created: 08/14/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

/****
 ** Loads the recipe ingredients input page
 **
 **/
function reEnterInput()
{
	//go back to recipe ingredients input 
	header("Location: http://localhost/RecipeFish/view/addRecipeIngredients.php"); 
	exit(); 
}

$size = count($_POST);

if ($size >= 2)
{
	$count = 0;
	$index = 0;

	$_SESSION["ingredients"] = array();
	
	while (true)
	{
		if ($index == $size)
		{
			break;
		}
		
		if (isset($_POST["ingredient" . $count]) == true)
		{
			$_SESSION["ingredients"][$index] = $_POST["ingredient" . $count];
			
			$index++;
		}
		
		$count++;
	}
}

else 
{
	$_SESSION["invalidIngredientCount"] = "set";
	
	reEnterInput();
}

//go to recipe directions page 
header("Location: http://localhost/RecipeFish/view/addRecipeDirections.php"); 
exit(); 
?>
