<?php
/******************************************************************************************
*******************************************************************************************
** Name: recipe.php																	   ****
** Description: Provides functionality for storing and retrieving recipe data to and   ****
** from the Recipe Fish database				   									   ****
** Author: Rhys Hall																   ****
** Date Created: 05/11/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

class Recipe
{
	private $ID;
	private $name;
	private $description;
	private $prepHour;
	private $prepMin;
	private $cookHour;
	private $cookMin;
	private $waitHour;
	private $waitMin;
	private $servings;
	private $imagePath;
	private $ethnicity;
	private $mealType;
	private $popularFeatures;
	private $otherFeatures;
	private $holiday;
	private $notes;
	private $authorID;
	private $dateUploaded;
	
	/****
	** retrieve all class data of all recipes from Recipe Fish database
	**
	** @return    double array  class data of all recipes
	*/
	function selectAll()
	{
		$connection = RecipeFish::connect();
		
		$query = "select * from recipe;";
		
		$statement = $connection->prepare($query);	

		$statement->execute();
		$result = $statement->fetchAll();
		
		RecipeFish::close($connection);
		
		return $result;
	}
	
	/****
	** retrieve all recipe data corresponding to given recipe ID
	**
	** @return    array  data of given recipe  
	*/
	function selectByRecipeID($recipeID)
	{
		$connection = RecipeFish::connect();
		
		$query = "select * from recipe where id=:recipe_id;";
		
		$statement = $connection->prepare($query);	
		
		// bind class values to query values
		$statement->bindValue(":recipe_id", $recipeID);	

		$statement->execute();
		$result = $statement->fetch();
		
		RecipeFish::close($connection);
		
		return $result;
	}
	
	/****
	** retrieve all class data of all recipes corresponding to given user ID
	**
	** @return    double array  class data of all user's recipes 
	*/
	function selectByUserID($userID)
	{
		$connection = RecipeFish::connect();
		
		$query = "select * from recipe where author_id=:user_id;";
		
		$statement = $connection->prepare($query);	
		
		// bind class values to query values
		$statement->bindValue(":user_id", $userID);	

		$statement->execute();
		$result = $statement->fetchAll();
		
		RecipeFish::close($connection);
		
		return $result;
	}
	
	/****
	** return value of next available recipe ID
	**
	** @return    integer  next available recipe ID
	*/
	function selectNextID()
	{
		$connection = RecipeFish::connect();
		
		$query = "select auto_increment from information_schema.tables where table_name='recipe' and table_schema ='recipe_Fish'";
		
		$statement = $connection->prepare($query);	

		$statement->execute();
		$resultArray = $statement->fetchAll();
		
		//assign only possible result to int variable
		$ID = $resultArray[0][0];
		
		RecipeFish::close($connection);
		
		return $ID;
	}
	
	/****
	** retrieve all recipe data corresponding to given meal type
	**
	** @return    double array  class data of all recipes corresponding to given meal type 
	*/
	function selectByMealType($mealType)
	{
		$connection = RecipeFish::connect();
		
		$query = "select * from recipe where meal_type=:meal_type;";
		
		$statement = $connection->prepare($query);	
		
		// bind class values to query values
		$statement->bindValue(":meal_type", $mealType);	

		$statement->execute();
		$result = $statement->fetchAll();
		
		RecipeFish::close($connection);
		
		return $result;
	}
	
	/****
	** retrieve all recipe data meeting given time limit
	**
	** @return    double array  class data of all recipes meeting given time limit 
	*/
	function selectByTimeLimit($timeLimit)
	{
		$connection = RecipeFish::connect();
		
		$query = "select * from recipe where prep_time_hour=0 and cook_time_hour=0 and wait_time_hour=0 and (prep_time_minute+cook_time_minute+wait_time_minute)<=:time_limit 
					and (meal_type='Appetizer' or meal_type='Breakfast' or meal_type='Dinner' or meal_type='Lunch')";
		
		$statement = $connection->prepare($query);	
		
		// bind class values to query values
		$statement->bindValue(":time_limit", $timeLimit);	

		$statement->execute();
		$result = $statement->fetchAll();
		
		RecipeFish::close($connection);
		
		return $result;
	}
	
	/****
	** retrieve all recipe data corresponding to given holiday
	**
	** @return    double array  class data of all recipes corresponding to given holiday
	*/
	function selectByHoliday($holiday)
	{
		$connection = RecipeFish::connect();
		
		$query = "select * from recipe where holiday=:holiday;";
		
		$statement = $connection->prepare($query);	
		
		// bind class values to query values
		$statement->bindValue(":holiday", $holiday);	

		$statement->execute();
		$result = $statement->fetchAll();
		
		RecipeFish::close($connection);
		
		return $result;
	}
	
	/****
	** retrieve all recipe data corresponding to given popular ingredient
	**
	** @return    double array  class data of all recipes corresponding to given popular ingredient
	*/
	function selectByPopularIngredient($popularIngredient)
	{
		$connection = RecipeFish::connect();
		
		$query = "select * from recipe where popular_features like '%" . $popularIngredient . "%';";
		
		$statement = $connection->prepare($query);	

		$statement->execute();
		$result = $statement->fetchAll();
		
		RecipeFish::close($connection);
		
		return $result;
	}
	
	/****
	** retrieve all recipe data corresponding to given other feature
	**
	** @return    double array  class data of all recipes corresponding to given other feature
	*/
	function selectByOtherFeature($otherFeature)
	{
		$connection = RecipeFish::connect();
		
		$query = "select * from recipe where other_features like '%" . $otherFeature . "%';";
		
		$statement = $connection->prepare($query);	
		
		// bind class values to query values
		$statement->bindValue(":other_feature", $otherFeature);	

		$statement->execute();
		$result = $statement->fetchAll();
		
		RecipeFish::close($connection);
		
		return $result;
	}
	
	/****
	** retrieve all recipe data corresponding to given ethnicity
	**
	** @return    double array  class data of all recipes corresponding to given ethnicity
	*/
	function selectByEthnicity($ethnicity)
	{
		$connection = RecipeFish::connect();
		
		$query = "select * from recipe where ethnicity=:ethnicity;";
		
		$statement = $connection->prepare($query);	
		
		// bind class values to query values
		$statement->bindValue(":ethnicity", $ethnicity);	

		$statement->execute();
		$result = $statement->fetchAll();
		
		RecipeFish::close($connection);
		
		return $result;
	}
	
	/****
	** insert information corresponding to a given recipe into the
	** database system
	**
	** @return    boolean  insertion status
	*/
	function insert()
	{
		$connection = RecipeFish::connect();
		
		$query = "insert into recipe(id, name, description, prep_time_hour, prep_time_minute, cook_time_hour, cook_time_minute, wait_time_hour, 
				wait_time_minute, servings, image_path, ethnicity, meal_type, popular_features, other_features, holiday, notes, author_id, date_uploaded) 
				values (:id, :name, :description, :prep_time_hour, :prep_time_minute, :cook_time_hour, :cook_time_minute, :wait_time_hour, 
				:wait_time_minute, :servings, :image_path, :ethnicity, :meal_type, :popular_types, :other_types, :holiday, :notes, :author_id, 
				:date_uploaded)";
			
		$statement = $connection->prepare($query);
		
		// bind class values to query values
		$statement->bindValue(":id", "");	
		$statement->bindValue(":name", $this->getName());
		$statement->bindValue(":description", $this->getDescription());	
		$statement->bindValue(":prep_time_hour", $this->getPrepHour());	
		$statement->bindValue(":prep_time_minute", $this->getPrepMin());	
		$statement->bindValue(":cook_time_hour", $this->getCookHour());	
		$statement->bindValue(":cook_time_minute", $this->getCookMin());	
		$statement->bindValue(":wait_time_hour", $this->getWaitHour());	
		$statement->bindValue(":wait_time_minute", $this->getWaitMin());	
		$statement->bindValue(":servings", $this->getServings());
		$statement->bindValue(":image_path", $this->getImagePath());
		$statement->bindValue(":ethnicity", $this->getEthnicity());
		$statement->bindValue(":meal_type", $this->getMealType());
		$statement->bindValue(":popular_types", $this->getPopularFeatures());
		$statement->bindValue(":other_types", $this->getOtherFeatures());
		$statement->bindValue(":holiday", $this->getHoliday());
		$statement->bindValue(":notes", $this->getNotes());
		$statement->bindValue(":author_id", $this->getAuthorID());
		$statement->bindValue(":date_uploaded", $this->getDateUploaded());
		
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
	** remove all information corresponding to a given recipe 
	** ID from the database system 
	**
	** @return    boolean  deletion status
	*/
	function remove($id)
	{
		$connection = RecipeFish::connect();
		
		$query = "delete from recipe where id=:id;";
			
		$statement = $connection->prepare($query);
		
		$statement->bindValue(":id", $id);
		
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
	
	function getID()
	{
		return $this->ID;
	}
	
	function getName()
	{
		return $this->name;
	}
	
	function getDescription()
	{
		return $this->description;
	}
	
	function getPrepHour()
	{
		return $this->prepHour;
	}
	
	function getPrepMin()
	{
		return $this->prepMin;
	}
	
	function getCookHour()
	{
		return $this->cookHour;
	}
	
	function getCookMin()
	{
		return $this->cookMin;
	}
	
	function getWaitHour()
	{
		return $this->waitHour;
	}
	
	function getWaitMin()
	{
		return $this->waitMin;
	}
	
	function getServings()
	{
		return $this->servings;
	}
	
	function getImagePath()
	{
		return $this->imagePath;
	}
	
	function getEthnicity()
	{
		return $this->ethnicity;
	}
	
	function getMealType()
	{
		return $this->mealType;
	}
	
	function getPopularFeatures()
	{
		return $this->popularFeatures;
	}
	
	function getOtherFeatures()
	{
		return $this->otherFeatures;
	}
	
	function getHoliday()
	{
		return $this->holiday;
	}
	
	function getNotes()
	{
		return $this->notes;
	}
	
	function getAuthorID()
	{
		return $this->authorID;
	}
	
	function getDateUploaded()
	{
		return $this->dateUploaded;
	}
	
	function setID($param)
	{
		$this->ID = $param;	
	}
	
	function setName($param)
	{
		$this->name = $param;	
	}
	
	function setDescription($param)
	{
		$this->description = $param;	
	}
	
	function setPrepHour($param)
	{
		$this->prepHour = $param;
	}
	
	function setPrepMin($param)
	{
		$this->prepMin = $param;	
	}
	
	function setCookHour($param)
	{
		$this->cookHour = $param;
	}
	
	function setCookMin($param)
	{
		$this->cookMin = $param;	
	}
	
	function setWaitHour($param)
	{
		$this->waitHour = $param;
	}
	
	function setWaitMin($param)
	{
		$this->waitMin = $param;	
	}
	
	function setServings($param)
	{
		$this->servings = $param;	
	}
	
	function setImagePath($param)
	{
		$this->imagePath = $param;	
	}
	
	function setEthnicity($param)
	{
		$this->ethnicity = $param;
	}
	
	function setMealType($param)
	{
		$this->mealType = $param;
	}
	
	function setPopularFeatures($param)
	{
		$this->popularFeatures = $param;
	}
	
	function setOtherFeatures($param)
	{
		$this->otherFeatures = $param;
	}
	
	function setHoliday($param)
	{
		$this->holiday = $param;
	}
	
	function setNotes($param)
	{
		$this->notes = $param;	
	}
	
	function setAuthorID($param)
	{
		$this->authorID = $param;	
	}
	
	function setDateUploaded($param)
	{
		$this->dateUploaded = $param;	
	}
}
?>
