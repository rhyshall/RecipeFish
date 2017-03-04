<?php 
/******************************************************************************************
*******************************************************************************************
** Name: recipeDirectionsController.php											       ****
** Description: Provides functionality for verifying recipe directions entered by a    ****
** given user and assigning to global variables for further use 					   ****					
** Date Created: 08/23/2016														   	   ****
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
	header("Location: http://localhost/RecipeFish/view/addRecipeDirections.php"); 
	exit(); 
}

if (isset($_POST["direction1"]) == true)
{
	$count = 1;
	
	$_SESSION["directions"] = array();
	
	while (true)
	{
		if (isset($_POST["direction" . $count]) == true)
		{
			$_SESSION["directions"][$count-1] = $_POST["direction" . $count];
			
			$count++;
		}
		
		else
		{
			break;
		}
	}
}

else 
{
	$_SESSION["invalidDirectionCount"] = "set";
	
	reEnterInput();
}

//go to recipe notes page 
header("Location: http://localhost/RecipeFish/view/addRecipeNotes.php"); 
exit();
?>
