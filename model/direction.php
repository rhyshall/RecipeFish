<?php
/******************************************************************************************
*******************************************************************************************
** Name: direction.php																   ****
** Description: Provides functionality for storing and retrieving direction data to    ****
** and from the Recipe Mingle database				   								   ****
** Author: Rhys Hall																   ****
** Date Created: 05/11/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeMingle/";

class Direction
{
	private $ID;
	private $stepNum;
	private $content;
	
	/****
	** retrieve content of given direction corresponding to its ID
	**
	** @return    string  content of given direction
	*/
	function selectByID($id)
	{
		$connection = RecipeMingle::connect();
		
		$query = "select content from direction where id=:id;";
		
		$statement = $connection->prepare($query);	
		
		// bind class values to query values
		$statement->bindValue(":id", $id);	

		$statement->execute();
		$result = $statement->fetch();
		
		RecipeMingle::close($connection);
		
		return $result[0];
	}
	
	/****
	** return value of next available direction ID
	**
	** @return    integer  next available direction ID
	*/
	function selectNextID()
	{
		$connection = RecipeMingle::connect();
		
		$query = "select auto_increment from information_schema.tables where table_name='direction' and table_schema ='recipe_mingle'";
		
		$statement = $connection->prepare($query);	

		$statement->execute();
		$resultArray = $statement->fetchAll();
		
		//assign only possible result to int variable
		$ID = $resultArray[0][0];
		
		RecipeMingle::close($connection);
		
		return $ID;
	}
	
	/****
	** insert information corresponding to a given recipe direction
	** into the database system
	**
	** @return    boolean  insertion status
	*/
	function insert()
	{
		$connection = RecipeMingle::connect();
		
		$query = "insert into direction(id, step_num, content) values (:id, :step_num, :content)";
			
		$statement = $connection->prepare($query);
		
		// bind class values to query values
		$statement->bindValue(":id", $this->getID());	
		$statement->bindValue(":step_num", $this->getStepNum());	
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
	** remove all information corresponding to a given direction 
	** ID from the database system 
	**
	** @return    boolean  deletion status
	*/
	function remove($id)
	{
		$connection = RecipeMingle::connect();
		
		$query = "delete from direction where id=:id;";
			
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
	
	function getStepNum()
	{
		return $this->stepNum;
	}
	
	function getContent()
	{
		return $this->content;
	}
	
	function setID($param)
	{
		$this->ID = $param;	
	}
	
	function setStepNum($param)
	{
		$this->stepNum = $param;	
	}
	
	function setContent($param)
	{
		$this->content = $param;	
	}
}
?>
