<?php
/******************************************************************************************
*******************************************************************************************
** Name: database.php																   ****
** Description: Provides interface for connecting to and closing the Recipe Mingle 	   ****
** database			   																   ****
** Author: Rhys Hall																   ****
** Date Created: 04/13/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

class RecipeMingle
{	
	private $connection;

	/**
     * establish connection to Recipe Mingle database
     * @return database connection
     */
	function connect()
	{
		$host = "localhost";
		$databaseName = "recipe_mingle";
		
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
     * close connection to Recipe Mingle database
     * @param database connection
     * @return none
     */
	function close($connection)
	{
		$connection = null;
	}
}
?>