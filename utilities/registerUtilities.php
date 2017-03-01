<?php
/******************************************************************************************
*******************************************************************************************
** Name: registerUtilities.php														   ****
** Description: Provides helper functions for "registerController.php"			   	   ****
** Author: Rhys Hall																   ****
** Date Created: 04/29/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

/****
 ** Determines if username char is valid symbol 
 **
 ** @param    char  $symbol  username char
 ** @return    boolean  username symbol validity
 **/
 function isValidUsernameSymbol($symbol)
 {
	 $isValidSymbol = true;
	 
	 if ((ctype_alpha($symbol) == false) && (ctype_digit($symbol) == false) && ($symbol != '_') && ($symbol != '-'))
	 {
		 $isValidSymbol = false;
	 }
	 
	 return $isValidSymbol;
 }

/****
 ** Determines if username input is valid
 **
 ** @param    str  $username  account username
 ** @return    boolean  username validity
 **/
function isValidUsername($username)
{
	$isValidUsername = true;
	
	//determine if username is valid length
	$length = strlen($username);
	
	if (($length < 1) || ($length > 20))
	{
		$isValidUsername = false;
	}
	
	//determine if username contains appropriate symbols
	for ($i = 0; $i < $length; $i++)
	{
		if (isValidUsernameSymbol($username[$i]) == false)
		{
			$isValidUsername = false;
			
			break;
		}
	}
	
	return $isValidUsername;
}

/****
 ** Determines if username input already exists in database 
 **
 ** @param    str  $username  account username
 ** @return    boolean  existing username validity
 **/
function usernameExists($username)
{
	$usernameExists = false;
	$userSelector = new User;
	$user = new User;
	
	//get all users from database
	$user = $userSelector->selectByUsername($username);
	
	if (strcmp(strtolower($user->getUsername()), strtolower($username)) == 0)
	{
		$usernameExists = true;
	}
	
	return $usernameExists;
}

/****
 ** Determines if email input already exists in database 
 **
 ** @param    str  $email  account email
 ** @return    boolean  existing email validity
 **/
function emailExists($email)
{
	$emailExists = false;
	$userSelector = new User;
	$user = new User;
	
	//get all users from database
	$user = $userSelector->selectByEmail($email);
	
	if (strcmp(strtolower($user->getEmail()), strtolower($email)) == 0)
	{
		$emailExists = true;
	}
	
	return $emailExists;
}

/****
 ** Determines if password input is valid length
 **
 ** @param    str  $password  account password
 ** @return    boolean  password length validity
 **/
function isValidPasswordLength($password)
{
	$isValidLength = true;
	
	$length = strlen($password);
	
	//determine if password is valid length
	if (($length < 6) || ($length > 25))
	{
		$isValidLength = false;
	}
	
	return $isValidLength;
}

/****
 ** Determines if password input contains valid symbols
 **
 ** @param    str  $password  account password
 ** @return    boolean  password symbol validity
 **/
function isValidPasswordSymbols($password)
{	
	$isValidSymbols = true;

	$length = strlen($password);
	
	//determine if password contains appropriate symbols
	for ($i = 0; $i < $length; $i++)
	{
		if (ord(substr($password, $i)) < 33)
		{
			$isValidSymbols = false;
			
			break;
		}
	}
	
	return $isValidSymbols;
}

/****
 ** Determines if password/confirm password input are equivalent
 **
 ** @param    str  $password  account password    str  $confirmPassword  account password confirmation
 ** @return    boolean  password equivalence validity 
 **/
function passwordConfirmed($password, $confirmPassword)
{
	$passwordConfirmed = false;
	
	if (strcmp($password, $confirmPassword) == 0)
	{
		$passwordConfirmed = true;
	}
	
	return $passwordConfirmed;
}
?>
