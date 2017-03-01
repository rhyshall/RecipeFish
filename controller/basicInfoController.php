<?php 
/******************************************************************************************
*******************************************************************************************
** Name: basicInfoController.php												       ****
** Description: Provides functionality for modifying basic user profile information    ****
** Date Created: 10/13/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeMingle/";

include($root . "utilities/database.php");
include($root . "/model/user.php");
include($root . "/utilities/registerUtilities.php");

//retrieve saved user data from input 
$username = $_POST["username"];
$email = $_POST["email"];
$gender = $_POST["gender"];

//activate warning pop-up if no info changed 
if ((strcmp($username, $_SESSION["username"]) == 0) && (strcmp($email, $_SESSION["email"]) == 0) && (strcmp($gender, $_SESSION["gender"]) == 0))
{
	$_SESSION["falseEdit"] = "set";
	
	header("Location: http://localhost/RecipeMingle/view/profile.php");
	exit();
}

$user = new User;
$userSelector = new User;

//set user info as class object, change saved skin ID and update database info 
$user = $userSelector->selectByID($_SESSION["userID"]);

//if user switched their gender 
if (strcmp($gender, $user->getGender()) != 0)
{
	$imagePath = $user->getImagePath();
	
	//if user is using default gender photo
	if ((strcmp("/RecipeMingle/images/uploads/users/user1.png", $imagePath) == 0) || (strcmp("/RecipeMingle/images/uploads/users/user2.png", $imagePath) == 0))
	{
		//if gender is male
		if (strcmp($gender, "male") == 0)
		{
			//switch to default male photo
			$user->setImagePath("/RecipeMingle/images/uploads/users/user1.png");
		}
		
		//if gender is female 
		else 
		{
			//switch to default female photo
			$user->setImagePath("/RecipeMingle/images/uploads/users/user2.png");
		}	
	}
}

//verify if username is valid and non-existent 
if (isValidUsername($username) == true)
{
	//verify if username already exists
	if ((usernameExists($username) == true) && (strcmp($_SESSION["username"], $username) != 0))
	{
		//username already exists
		$_SESSION["switchUsernameExists"] = "set";
	
		header("Location: http://localhost/RecipeMingle/view/profile.php");
		exit();
	}
}

else
{
	//username is invalid
	$_SESSION["switchUsernameInvalid"] = "set";

	header("Location: http://localhost/RecipeMingle/view/profile.php");
	exit();
}

if ((emailExists($email) == true) && (strcmp($_SESSION["email"], $email) != 0))
{
	//email already exists
	$_SESSION["switchEmailExists"] = "set";
	
	header("Location: http://localhost/RecipeMingle/view/profile.php");
	exit();
}

$user->setUsername($username);
$user->setEmail($email);
$user->setGender($gender);

$user->update();

$_SESSION["username"] = $username;
$_SESSION["email"] = $email;
$_SESSION["gender"] = $gender;

$_SESSION["basicInfoUpdated"] = "set";

header("Location: http://localhost/RecipeMingle/view/profile.php");
exit();
?>
