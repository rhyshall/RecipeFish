<?php
/******************************************************************************************
*******************************************************************************************
** Name: recipeDirection.php														   ****
** Description: Provides functionality for storing and retrieving recipe/direction     ****
** IDs to and from the Recipe Fish database				   						   ****
** Author: Rhys Hall																   ****
** Date Created: 09/04/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

class RecipeDirection
{
	private $directionID;
	private $recipeID;
	
	/****
	** select all direction IDs for given recipe ID
	**
	** @return    array  direction IDs 
	*/
	function selectByRecipeID($recipeID)
	{
		$connection = RecipeFish::connect();
	
		$query = "select direction_id, recipe_id from recipe_direction where recipe_id=:recipe_id;";
		
		$statement = $connection->prepare($query);

		$statement->bindValue(":recipe_id", $recipeID);				

		$statement->execute();
		$result = $statement->fetchAll();
		
		$directionIDs = array();
		
		$count = count($result);
		
		for ($i = 0; $i < $count; $i++)
		{
			$directionIDs[$i] = $result[$i]["direction_id"];
		}
		
		RecipeFish::close($connection);
		
		return $directionIDs;
	}
	
	/****
	** insert information corresponding to recipe/direction IDs
	** into the database system
	**
	** @return    boolean  insertion status
	*/
	function insert()
	{
		$connection = RecipeFish::connect();
		
		$query = "insert into recipe_direction(direction_id, recipe_id) values (:direction_id, :recipe_id)";
			
		$statement = $connection->prepare($query);
		
		// bind class values to query values
		$statement->bindValue(":direction_id", $this->getDirectionID());	
		$statement->bindValue(":recipe_id", $this->getRecipeID());
		
		if ($statement->execute())
		{
			RecipeFish::close($connection);
			
			return true;
		}
		
		else
		{
			//error reporting for debugging purposes
			/*$arr = $statement->errorInfo();
			print_r($arr);*/
			
			RecipeFish::close($connection);
			
			return false;
		}
	}
	
	/****
	** remove all information corresponding to given 
	** recipe/direction ID references from the database system 
	**
	** @return    boolean  deletion status
	*/
	function remove($recipeID)
	{
		$connection = RecipeFish::connect();
		
		$query = "delete from recipe_direction where recipe_id=:recipe_id;";
			
		$statement = $connection->prepare($query);
		
		$statement->bindValue(":recipe_id", $recipeID);
		
		if ($statement->execute())
		{
			RecipeFish::close($connection);
			
			return true;
		}
		
		else
		{
			//error reporting for debugging purposes
			$arr = $statement->errorInfo();
			print_r($arr);
			
			RecipeFish::close($connection);
			
			return false;
		}
	}
	
	function getDirectionID()
	{
		return $this->directionID;
	}
	
	function getRecipeID()
	{
		return $this->recipeID;
	}
	
	function setDirectionID($param)
	{
		$this->directionID = $param;	
	}
	
	function setRecipeID($param)
	{
		$this->recipeID = $param;	
	}
}
?>
