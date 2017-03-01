<?php
/******************************************************************************************
*******************************************************************************************
** Name: ingredient.php																   ****
** Description: Provides functionality for storing and retrieving ingredient data to   ****
** and from the Recipe Mingle database				   								   ****
** Author: Rhys Hall																   ****
** Date Created: 05/11/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeMingle/";

class Ingredient
{
	private $ID;
	private $content;
	
	/****
	** retrieve all class data of all ingredients from Recipe Mingle database
	**
	** @return    double array  class data of all ingredients
	*/
	function selectAll()
	{
		$connection = RecipeMingle::connect();
		
		$query = "select * from ingredient;";
		
		$statement = $connection->prepare($query);	

		$statement->execute();
		$result = $statement->fetchAll();
		
		RecipeMingle::close($connection);
		
		return $result;
	}
	
	/****
	** retrieve content of given ingredient corresponding to its ID
	**
	** @return    string  content of given ingredient
	*/
	function selectByID($id)
	{
		$connection = RecipeMingle::connect();
		
		$query = "select content from ingredient where id=:id;";
		
		$statement = $connection->prepare($query);	
		
		// bind class values to query values
		$statement->bindValue(":id", $id);	

		$statement->execute();
		$result = $statement->fetch();
		
		RecipeMingle::close($connection);
		
		return $result[0];
	}
	
	/****
	** return value of next available ingredient ID
	**
	** @return    integer  next available ingredient ID
	*/
	function selectNextID()
	{
		$connection = RecipeMingle::connect();
		
		$query = "select auto_increment from information_schema.tables where table_name='ingredient' and table_schema ='recipe_mingle'";
		
		$statement = $connection->prepare($query);	

		$statement->execute();
		$resultArray = $statement->fetchAll();
		
		//assign only possible result to int variable
		$ID = $resultArray[0][0];
		
		RecipeMingle::close($connection);
		
		return $ID;
	}
	
	/****
	** insert information corresponding to a given recipe ingredient
	** into the database system
	**
	** @return    boolean  insertion status
	*/
	function insert()
	{
		$connection = RecipeMingle::connect();
		
		$query = "insert into ingredient(id, content) values (:id, :content)";
			
		$statement = $connection->prepare($query);
		
		// bind class values to query values
		$statement->bindValue(":id", "");	
		$statement->bindValue(":content", $this->getContent());
		
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
	** remove all information corresponding to a given ingredient 
	** ID from the database system 
	**
	** @return    boolean  deletion status
	*/
	function remove($id)
	{
		$connection = RecipeMingle::connect();
		
		$query = "delete from ingredient where id=:id;";
			
		$statement = $connection->prepare($query);
		
		$statement->bindValue(":id", $id);
		
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
	
	function getID()
	{
		return $this->ID;
	}
	
	function getContent()
	{
		return $this->content;
	}
	
	function setID($param)
	{
		$this->ID = $param;	
	}
	
	function setContent($param)
	{
		$this->content = $param;	
	}
}
?>
