<?php
/******************************************************************************************
*******************************************************************************************
** Name: recipeIngredient.php														   ****
** Description: Provides functionality for storing and retrieving recipe/ingredient    ****
** IDs to and from the Recipe Mingle database				   						   ****
** Author: Rhys Hall																   ****
** Date Created: 09/04/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeMingle/";

class RecipeIngredient
{
	private $ingredientID;
	private $recipeID;
	
	/****
	** select all ingredient IDs for given recipe ID
	**
	** @return    array  ingredient IDs 
	*/
	function selectByRecipeID($recipeID)
	{
		$connection = RecipeMingle::connect();
	
		$query = "select ingredient_id, recipe_id from recipe_ingredient where recipe_id=:recipe_id;";
		
		$statement = $connection->prepare($query);

		$statement->bindValue(":recipe_id", $recipeID);				

		$statement->execute();
		$result = $statement->fetchAll();
		
		$ingredientIDs = array();
		
		$count = count($result);
		
		for ($i = 0; $i < $count; $i++)
		{
			$ingredientIDs[$i] = $result[$i]["ingredient_id"];
		}
		
		RecipeMingle::close($connection);
		
		return $ingredientIDs;
	}
	
	/****
	** insert information corresponding to recipe/ingredient IDs
	** into the database system
	**
	** @return    boolean  insertion status
	*/
	function insert()
	{
		$connection = RecipeMingle::connect();
		
		$query = "insert into recipe_ingredient(ingredient_id, recipe_id) values (:ingredient_id, :recipe_id)";
			
		$statement = $connection->prepare($query);
		
		// bind class values to query values
		$statement->bindValue(":ingredient_id", $this->getIngredientID());	
		$statement->bindValue(":recipe_id", $this->getRecipeID());
		
		if ($statement->execute())
		{
			RecipeMingle::close($connection);
			
			return true;
		}
		
		else
		{
			//error reporting for debugging purposes
			/*$arr = $statement->errorInfo();
			print_r($arr);*/
			
			RecipeMingle::close($connection);
			
			return false;
		}
	}
	
	/****
	** remove all information corresponding to given 
	** recipe/ingredient ID references from the database system 
	**
	** @return    boolean  deletion status
	*/
	function remove($recipeID)
	{
		$connection = RecipeMingle::connect();
		
		$query = "delete from recipe_ingredient where recipe_id=:recipe_id;";
			
		$statement = $connection->prepare($query);
		
		$statement->bindValue(":recipe_id", $recipeID);
		
		if ($statement->execute())
		{
			RecipeMingle::close($connection);
			
			return true;
		}
		
		else
		{
			//error reporting for debugging purposes
			$arr = $statement->errorInfo();
			print_r($arr);
			
			RecipeMingle::close($connection);
			
			return false;
		}
	}
	
	function getIngredientID()
	{
		return $this->ingredientID;
	}
	
	function getRecipeID()
	{
		return $this->recipeID;
	}
	
	function setIngredientID($param)
	{
		$this->ingredientID = $param;	
	}
	
	function setRecipeID($param)
	{
		$this->recipeID = $param;	
	}
}
?>
