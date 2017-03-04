<?php 
/******************************************************************************************
*******************************************************************************************
** Name: logOutController.php														   ****
** Description: Provides functionality for signing out of a given user's account	   ****
** Date Created: 05/02/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

unset($_SESSION["username"]);
unset($_SESSION["gender"]);

header("Location: http://localhost/RecipeFish");
exit(); 
?>
