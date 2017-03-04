<?php
/******************************************************************************************
*******************************************************************************************
** Name: user.php																	   ****
** Description: Provides functionality for storing and retrieving user data to and     ****
** from the Recipe Fish database				   									   ****
** Author: Rhys Hall																   ****
** Date Created: 04/13/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

class User
{
	private $ID;
	private $username;
	private $password;
	private $email; 
	private $gender;
	private $imagePath;
	private $skinID;
	private $recipeSortID; /* 1 = alphabetical, 2 = newest to oldest, 3 = oldest to newest, 4 = reverse alphabetical */
	
	/****
	** retrieve user data from Recipe Fish database corresponding
	** to given user ID
	**
	** @param    str  $ID  user ID  	
	** @return    array  user class data corresponding to given user ID
	*/
	function selectByID($ID)
	{
		$connection = RecipeFish::connect();
	
		$query = "select id, username, password, email, gender, image_path, skin_id, recipe_sort_id from user where id=:id;";
		
		$statement = $connection->prepare($query);

		$statement->bindValue(":id", $ID);				

		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);
		
		$userObj = new User;
		$userObj->setID($result["id"]);
		$userObj->setUsername($result["username"]);
		$userObj->setPassword($result["password"]);
		$userObj->setEmail($result["email"]);
		$userObj->setGender($result["gender"]);
		$userObj->setImagePath($result["image_path"]);
		$userObj->setSkinID($result["skin_id"]);
		$userObj->setRecipeSortID($result["recipe_sort_id"]);
		
		RecipeFish::close($connection);
		
		return $userObj;
	}
	
	/****
	** retrieve user data from CookBook database corresponding to given 
	** username
	**
	** @param    str  $username  account username  	
	** @return    array  user class data corresponding to given username
	*/
	function selectByUsername($username)
	{
		$connection = RecipeFish::connect();
	
		$query = "select id, username, password, email, gender, image_path, skin_id, recipe_sort_id from user where username=:username;";
		
		$statement = $connection->prepare($query);

		$statement->bindValue(":username", $username);				

		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);
		
		$userObj = new User;
		$userObj->setID($result["id"]);
		$userObj->setUsername($result["username"]);
		$userObj->setPassword($result["password"]);
		$userObj->setEmail($result["email"]);
		$userObj->setGender($result["gender"]);
		$userObj->setImagePath($result["image_path"]);
		$userObj->setSkinID($result["skin_id"]);
		$userObj->setRecipeSortID($result["recipe_sort_id"]);
		
		RecipeFish::close($connection);
		
		return $userObj;
	}
	
	/****
	** retrieve user data from CookBook database corresponding to 
	** given email
	**
	** @param    str  $email  account email 	
	** @return    array  user class data corresponding to given email
	*/
	function selectByEmail($email)
	{
		$connection = RecipeFish::connect();
	
		$query = "select id, username, password, email, gender, image_path, skin_id, recipe_sort_id from user where email=:email;";
		
		$statement = $connection->prepare($query);

		$statement->bindValue(":email", $email);				

		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);
		
		$userObj = new User;
		$userObj->setID($result["id"]);
		$userObj->setUsername($result["username"]);
		$userObj->setPassword($result["password"]);
		$userObj->setEmail($result["email"]);
		$userObj->setGender($result["gender"]);
		$userObj->setImagePath($result["image_path"]);
		$userObj->setSkinID($result["skin_id"]);
		$userObj->setRecipeSortID($result["recipe_sort_id"]);
		
		RecipeFish::close($connection);
		
		return $userObj;
	}
	
	/****
	** retrieve all class data of all users from Recipe Fish database
	**
	** @return    double array  class data of all users
	*/
	function selectAll()
	{
		$connection = RecipeFish::connect();
		
		$query = "select * from user;";
		
		$statement = $connection->prepare($query);	

		$statement->execute();
		$result = $statement->fetchAll();
		
		RecipeFish::close($connection);
		
		return $result;
	}
	
	/****
	** insert information corresponding to a given user into the database 
	** system
	**
	** @return    boolean  insertion status
	*/
	function insert()
	{
		$connection = RecipeFish::connect();
		
		$query = "insert into user(id, username, password, email, gender, image_path, skin_id, recipe_sort_id) 
				values (:id, :username, :password, :email, :gender, :image_path, :skin_id, :recipe_sort_id)";
			
		$statement = $connection->prepare($query);
		
		// bind class values to query values
		$statement->bindValue(":id", $this->getID());	
		$statement->bindValue(":username", $this->getUsername());	
		$statement->bindValue(":password", $this->getPassword());		
		$statement->bindValue(":email", $this->getEmail());	
		$statement->bindValue(":gender", $this->getGender());
		$statement->bindValue(":image_path", $this->getImagePath());		
		$statement->bindValue(":skin_id", $this->getSkinID());	
		$statement->bindValue(":recipe_sort_id", $this->getRecipeSortID());	
		
		
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
	** Edit user information corresponding to given user 
	** class object 
	**
	** @return    boolean  update status
	*/
	function update()
	{
		$connection = RecipeFish::connect();
		
		$query = "update user set username=:username, email=:email, gender=:gender, password=:password, image_path=:image_path,
				skin_id=:skin_id, recipe_sort_id=:recipe_sort_id where id=:id;";
			
		$statement = $connection->prepare($query);
		
		// bind class values to query values
		$statement->bindValue(":id", $this->getID());	
		$statement->bindValue(":username", $this->getUsername());	
		$statement->bindValue(":password", $this->getPassword());		
		$statement->bindValue(":email", $this->getEmail());	
		$statement->bindValue(":gender", $this->getGender());
		$statement->bindValue(":image_path", $this->getImagePath());		
		$statement->bindValue(":skin_id", $this->getSkinID());	
		$statement->bindValue(":recipe_sort_id", $this->getRecipeSortID());	
		
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
	
	function getID()
	{
		return $this->ID;
	}
	
	function getUsername()
	{
		return $this->username;
	}
	
	function getPassword()
	{
		return $this->password;
	}
	
	function getEmail()
	{
		return $this->email;
	}
	
	function getGender()
	{
		return $this->gender;
	}
	
	function getImagePath()
	{
		return $this->imagePath;
	}
	
	function getSkinID()
	{
		return $this->skinID;
	}
	
	function getRecipeSortID()
	{
		return $this->recipeSortID;
	}
	
	function setID($param)
	{
		$this->ID = $param;	
	}
	
	function setUsername($param)
	{
		$this->username = $param;	
	}
	
	function setPassword($param)
	{
		$this->password = $param;	
	}
	
	function setEmail($param)
	{
		$this->email = $param;	
	}
	
	function setGender($param)
	{
		$this->gender = $param;	
	}
	
	function setImagePath($param)
	{
		$this->imagePath = $param;	
	}
	
	function setSkinID($param)
	{
		$this->skinID = $param;	
	}
	
	function setRecipeSortID($param)
	{
		$this->recipeSortID = $param;	
	}
}
?>
