<?php
/******************************************************************************************
*******************************************************************************************
** Name: database.php																   ****
** Description: Provides interface for connecting to and closing the Recipe Fish 	   ****
** database			   																   ****
** Author: Rhys Hall																   ****
** Date Created: 04/13/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

class RecipeFish
{	
	private $connection;

	/**
     * establish connection to Recipe Fish database
     * @return database connection
     */
	function connect()
	{
		$host = "localhost";
		$databaseName = "recipe_fish";
		
		$connectionString =  "mysql:host=" . $host . ";dbname=" . $databaseName;
		
		try
		{
			$connection = new PDO($connectionString, "root", "roadkill182");
		}
		
		catch (PDOException $pe)
		{
			die("Could not connect to the database, $databaseName.\n\n" . $pe->getMessage());
		}

		return $connection;
	}


	/**
     * close connection to Recipe Fish database
     * @param database connection
     * @return none
     */
	function close($connection)
	{
		$connection = null;
	}
}
?>