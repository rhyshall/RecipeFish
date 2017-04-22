<?php
/******************************************************************************************
*******************************************************************************************
** Name: cookbook.php														   		   ****
** Description: Provides functionality for storing and retrieving recipe IDs to/from   ****
** 				the database (cookbook) for given user IDs		   					   ****
** Author: Rhys Hall																   ****
** Date Created: 04/14/2017													   	       ****
*******************************************************************************************
******************************************************************************************/

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

class Cookbook
{
	private $ID;
	private $userID;
	private $recipeID;
	private $dateAdded;
	
	/****
	** select data of all entries for given user ID
	**
	** @param    int  $userID  ID of corresponding user 
	** @return    double array  cookbook class data of all corresponding entries 
	*/
	function selectByUserID($userID)
	{
		$connection = RecipeFish::connect();
	
		$query = "select id, user_id, recipe_id, date_added from cookbook where user_id=:user_id;";
		
		$statement = $connection->prepare($query);

		$statement->bindValue(":user_id", $userID);				

		$statement->execute();
		$result = $statement->fetchAll();
		
		RecipeFish::close($connection);
		
		return $result;
	}
	
	/****
	** select IDs of 20 most-occurring recipes, in descending order, from 
	** cookbook table in database 
	**
	** @return    array  20 most-occurring recipe IDs 
	*/
	function frequentRecipeIDs()
	{
		$connection = RecipeFish::connect();
	
		$query = "select recipe_id from cookbook group by recipe_id order by count(recipe_id) desc limit 20;";
		
		$statement = $connection->prepare($query);

		$statement->execute();
		$result = $statement->fetchAll();
		
		RecipeFish::close($connection);
		
		return $result;
	}
	
	/****
	** Get the total number of entries that a given recipe is entered into 
	** users' cookbooks
	**
	** @param    int  $recipeID  ID of corresponding recipe
	** @return    int  cookbook add count 
	*/
	function getEntryCount($recipeID)
	{
		$connection = RecipeFish::connect();
	
		$query = "select count(id) from cookbook where recipe_id=:recipe_id;";
		
		$statement = $connection->prepare($query);
		
		$statement->bindValue(":recipe_id", $recipeID);		
		
		$statement->execute();
		$result = $statement->fetchAll();
		
		RecipeFish::close($connection);
		
		return $result[0][0];
	}
	
	function getID()
	{
		return $this->ID;
	}
	
	function getUserID()
	{
		return $this->userID;
	}
	
	function getRecipeID()
	{
		return $this->recipeID;
	}
	
	function getDateAdded()
	{
		return $this->dateAdded;
	}
	
	function setID($param)
	{
		$this->ID = $param;	
	}
	
	function setUserID($param)
	{
		$this->userID = $param;	
	}
	
	function setRecipeID($param)
	{
		$this->recipeID = $param;	
	}
	
	function setDateAdded($param)
	{
		$this->dateAdded = $param;	
	}
}
?>
