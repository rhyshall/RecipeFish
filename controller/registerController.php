<?php 
/******************************************************************************************
*******************************************************************************************
** Name: registerController.php														   ****
** Description: Provides functionality for registering a new user account			   ****
** Date Created: 04/25/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeMingle/";

include($root . "utilities/database.php");
include($root . "/model/user.php");
include($root . "/utilities/registerUtilities.php");

//save input values for all fields filled in 
if (strlen($_POST["register-username"]) > 0)
{
	$_SESSION["usernameField"] = $_POST["register-username"];
}
	
if (strlen($_POST["register-email"]) > 0)
{
	$_SESSION["emailField"] = $_POST["register-email"];
}

if (strlen($_POST["register-password"]) > 0)
{
	$_SESSION["passwordField"] = $_POST["register-password"];
}

if (strlen($_POST["register-password-confirmation"]) > 0)
{
	$_SESSION["passwordConfirmationField"] = $_POST["register-password-confirmation"];
}

if (isset($_POST["gender"]) == true)
{
	$_SESSION["genderButton"] = $_POST["gender"];
}

//verify if all registration fields are complete 
if ((strlen($_POST["register-username"]) > 0) && (strlen($_POST["register-email"]) > 0) && (strlen($_POST["register-password"]) > 0) 
	&& (strlen($_POST["register-password-confirmation"]) > 0) && (isset($_POST["gender"]) == true))
{
	//fields are complete and can be assigned
	$username = $_POST["register-username"];
	$email = $_POST["register-email"];
	$password = $_POST["register-password"];
	$passwordConfirmation = $_POST["register-password-confirmation"];
	$gender = $_POST["gender"];
	
	if (strcmp($gender, "male") == 0)
	{
		$imagePath = "/RecipeMingle/images/uploads/users/user1.png";
	}
	
	else 
	{
		$imagePath = "/RecipeMingle/images/uploads/users/user2.png";
	}
	
	$skinID = 1;
	$recipeSortID = 1;
}

else 
{
	//fields are empty 
	$_SESSION["emptyField"] = "set";
	
	header("Location: http://localhost/RecipeMingle/view/register.php");
	exit(); 
}

//verify if username is valid and non-existent 
if (isValidUsername($username) == true)
{
	//verify if username already exists
	if (usernameExists($username) == true)
	{
		//username already exists
		$_SESSION["registerUsernameExists"] = "set";
	
		header("Location: http://localhost/RecipeMingle/view/register.php");
		exit();
	}
}

else
{
	//username is invalid
	$_SESSION["registerUsernameInvalid"] = "set";

	header("Location: http://localhost/RecipeMingle/view/register.php");
	exit();
}

if (emailExists($email) == true)
{
	//email already exists
	$_SESSION["registerEmailExists"] = "set";
	
	header("Location: http://localhost/RecipeMingle/view/register.php");
	exit();
}

//verify if password length is valid 
if (isValidPasswordLength($password) == true)
{
	//verify if password chars are valid
	if (isValidPasswordSymbols($password) == false)
	{
		$_SESSION["passwordSymbolsInvalid"] = "set";
		unset($_SESSION["passwordField"]);
		unset($_SESSION["passwordConfirmationField"]);
	
		header("Location: http://localhost/RecipeMingle/view/register.php");
		exit();
	}
}

else 
{
	$_SESSION["passwordLengthInvalid"] = "set";
	
	unset($_SESSION["passwordField"]);
	unset($_SESSION["passwordConfirmationField"]);
	
	header("Location: http://localhost/RecipeMingle/view/register.php");
	exit();
}

if (passwordConfirmed($password, $passwordConfirmation) == false)
{
	$_SESSION["passwordConfirmInvalid"] = "set";
	
	unset($_SESSION["passwordField"]);
	unset($_SESSION["passwordConfirmationField"]);
	
	header("Location: http://localhost/RecipeMingle/view/register.php");
	exit();
}

//store registration information into user database
$user = new User;

$user->setUsername($username);
$user->setEmail($email);
$user->setPassword($password);
$user->setGender($gender);
$user->setImagePath($imagePath);
$user->setSkinID($skinID);
$user->setRecipeSortID($recipeSortID);

$success = $user->insert();

if ($success == 1)
{
	//set required global log-in data values 
	$_SESSION["username"] = $username;
	$_SESSION["gender"] = $gender;
	
	//retrieve user ID
	$user = new User;
	$userSelector = new User;
	
	$user = $userSelector->selectByUsername($username);

	$_SESSION["userID"] = $user->getID();
	$_SESSION["email"] = $user->getEmail();
	
	//unset any remembered sign-up fields 
	if (isset($_SESSION["usernameField"]) == true)
	{
		unset($_SESSION["usernameField"]);
	}
	
	if (isset($_SESSION["emailField"]) == true)
	{
		unset($_SESSION["emailField"]);
	}
	
	if (isset($_SESSION["passwordField"]) == true)
	{
		unset($_SESSION["passwordField"]);
	}
	
	if (isset($_SESSION["passwordConfirmationField"]) == true)
	{
		unset($_SESSION["passwordConfirmationField"]);
	}
	
	if (isset($_SESSION["genderButton"]) == true)
	{
		unset($_SESSION["genderButton"]);
	}
	
	header("Location: http://localhost/RecipeMingle");
	exit();
}
?>
