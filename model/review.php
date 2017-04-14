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
