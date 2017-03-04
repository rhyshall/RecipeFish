<?php 
/******************************************************************************************
*******************************************************************************************
** Name: logInController.php														   ****
** Description: Provides functionality for signing in to a given user's account		   ****
** Date Created: 05/02/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

include($root . "utilities/database.php");
include($root . "/model/user.php");

//verify if all log-in fields are complete 
if ((strlen($_POST["log-in-email"]) > 0) && (strlen($_POST["log-in-password"]) > 0))
{
	//fields are complete and can be assigned
	$email = $_POST["log-in-email"];
	$password = $_POST["log-in-password"];
}

else 
{
	//fields are empty 
	$_SESSION["emptyField"] = "set";
	
	if (strlen($_POST["log-in-email"]) > 0)
	{
		$_SESSION["emailField"] = $_POST["log-in-email"];
	}
	
	if (strlen($_POST["log-in-password"]) > 0)
	{
		$_SESSION["passwordField"] = $_POST["log-in-password"];
	}
	
	header("Location: http://localhost/RecipeFish/view/logIn.php");
	exit(); 
}

//verify if log-in email/password combination exists in database
$userSelector = new User;
$user = new User;

$user = $userSelector->selectByEmail($email);

if (strcmp($user->getEmail(), $email) == 0)
{
	if (strcmp($user->getPassword(), $password) == 0)
	{
		//valid log-in- save necessary info to global variables
		$_SESSION["userID"] = $user->getID();
		$_SESSION["username"] = $user->getUsername();
		$_SESSION["email"] = $user->getEmail();
		$_SESSION["gender"] = $user->getGender();
	
		header("Location: http://localhost/RecipeFish");
		exit(); 
	}
	
	else 
	{
		//invalid log-in 
		$_SESSION["combinationInvalid"] = "set";
		$_SESSION["emailField"] = $email;

		header("Location: http://localhost/RecipeFish/view/logIn.php");
		exit(); 
	}
}

else 
{
	$_SESSION["nonExistingEmail"] = "set";
	$_SESSION["emailField"] = $email;
	$_SESSION["passwordField"] = $password;
	
	header("Location: http://localhost/RecipeFish/view/logIn.php");
	exit(); 
}
?>
