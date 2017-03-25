<?php
/******************************************************************************************
*******************************************************************************************
** Name: recipePhotoUtilities.php											   		   ****
** Description: Provides helper functions for "recipePhotoController.php"	   		   ****
** Author: Rhys Hall																   ****
** Date Created: 03/22/2017													   	       ****
*******************************************************************************************
******************************************************************************************/

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

/****
 ** Loads the recipe info input page
 **
 **/
function reEnterInput()
{
	//go back to recipe info input 
	header("Location: http://localhost/RecipeFish/view/addRecipePhoto.php"); 
	exit(); 
}

/****
** Determines if recipe image file upload is image type
**
** @param    str  $tempFileName  temporary filename stored on server
** @return    boolean  image type validity
**/
function isImageType($tempFileName)
{
	$isImage = true;
	
	// Check if image file is actual image type
    $check = exif_imagetype($tempFileName);
	
    if ($check === false) 
	{
        $isImage = false;
	}
	
	return $isImage;
}
 
/****
 ** Determines if recipe image file upload has appropriate size dimensions 
 **
 ** @param    str  $tempFileName  temporary filename stored on server
 ** @return    boolean  image size validity
 **/
function validImageSize($tempFileName)
{
	$validSize = true;
	
    // Check if image file is valid size
    $imageStats = getimagesize($tempFileName);
	
	//invalid if height or width < 256px or > 1024px
    if (($imageStats[0] < 256) || ($imageStats[1] < 256) || ($imageStats[0] > 1280) || ($imageStats[1] > 1280))
	{
        $validSize = false;
	}
	
	return $validSize;
}
?>
 