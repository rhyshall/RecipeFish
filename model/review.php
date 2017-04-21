<?php
/******************************************************************************************
*******************************************************************************************
** Name: review.php																	   ****
** Description: Provides functionality for storing and retrieving review data to and   ****
** from the Recipe Fish database				   									   ****
** Author: Rhys Hall																   ****
** Date Created: 05/11/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

class Review
{
	private $ID;
	private $recipeID;
	private $authorID;
	private $dateUploaded;
	private $rating;
	private $comment;
	
	/****
	** retrieve review data from Recipe Fish database corresponding to given 
	** recipe ID
	**
	** @param    int  $recipeID  ID of corresponding recipe  	
	** @return    double array  data of all reviews corresponding to given recipe
	*/
	function selectByRecipeID($recipeID)
	{
		$connection = RecipeFish::connect();
	
		$query = "select id, recipe_id, author_id, date_uploaded, rating, comment from review where recipe_id=:recipe_id;";
		
		$statement = $connection->prepare($query);

		$statement->bindValue(":recipe_id", $recipeID);				

		$statement->execute();
		$result = $statement->fetchAll();
		
		RecipeFish::close($connection);
		
		return $result;
	}
	
	/****
	** retrieve review data from Recipe Fish database corresponding to given 
	** author ID
	**
	** @param    int  $authorID  ID of corresponding author 	
	** @return    double array  data of all reviews corresponding to given author
	*/
	function selectByAuthorID($authorID)
	{
		$connection = RecipeFish::connect();
	
		$query = "select id, recipe_id, author_id, date_uploaded, rating, comment from review where author_id=:author_id;";
		
		$statement = $connection->prepare($query);

		$statement->bindValue(":author_id", $authorID);				

		$statement->execute();
		$result = $statement->fetchAll();
		
		RecipeFish::close($connection);
		
		return $result;
	}
	
	/****
	** retrieve average rating of given recipe in the Recipe Fish database
	**
	** @return    double  average rating of given recipe 
	*/
	function averageRecipeRating($recipeID)
	{
		$connection = RecipeFish::connect();
		$rating = 0;
	
		$query = "select avg(rating) as avg_rating from review where recipe_id=:recipe_id";
		
		$statement = $connection->prepare($query);	

		$statement->bindValue(":recipe_id", $recipeID);			

		$statement->execute();
		$result = $statement->fetch();
		
		if (empty($result) == false)
		{
			$rating = $result[0];
		}
		
		RecipeFish::close($connection);
		
		return $rating;
	}
	
	/****
	** retrieve average ratings of each recipe in the Recipe Fish database
	**
	** @return    double array  recipe IDs and their average ratings
	*/
	function selectAverageRatings()
	{
		$connection = RecipeFish::connect();
	
		$query = "select recipe_id, avg(rating) as avg_rating from review group by recipe_id order by avg_rating desc";
		
		$statement = $connection->prepare($query);				

		$statement->execute();
		$result = $statement->fetchAll();
		
		RecipeFish::close($connection);
		
		return $result;
	}
	
	function getID()
	{
		return $this->ID;
	}
	
	function getRecipeID()
	{
		return $this->recipeID;
	}
	
	function getAuthorID()
	{
		return $this->authorID;
	}
	
	function getDateUploaded()
	{
		return $this->dateUploaded;
	}
	
	function getRating()
	{
		return $this->rating;
	}
	
	function getComment()
	{
		return $this->comment;
	}
	
	function setID($param)
	{
		$this->ID = $param;	
	}
	
	function setRecipeID($param)
	{
		$this->recipeID = $param;	
	}
	
	function setAuthorID($param)
	{
		$this->authorID = $param;	
	}
	
	function setDateUploaded($param)
	{
		$this->dateUploaded = $param;	
	}
	
	function setRating($param)
	{
		$this->rating = $param;	
	}
	
	function setComment($param)
	{
		$this->comment = $param;	
	}
}
?>
