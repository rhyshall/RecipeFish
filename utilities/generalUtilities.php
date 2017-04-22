<?php
/******************************************************************************************
*******************************************************************************************
** Name: generalUtilities.php														   ****
** Description: Provides general-use functions to improve software design and 		   ****
** 				productivity	   													   ****
** Author: Rhys Hall																   ****
** Date Created: 04/17/2017													   	   	   ****
*******************************************************************************************
******************************************************************************************/

/****
 ** Prints given length of characters from given output
 **
 ** @param    string  $output  chars to be displayed
 ** @param	  int  $length  total number of chars to display 
 **/
function echoX($output, $length)
{
	$substring = "";
	
    if (strlen($output) <= $length)
    {
        echo $output;
    }
	
	else
    {
		$substring = substr($output, 0, $length) . "...";
		
		echo $substring;
	}
}

/****
 ** Prints words from given text up to given length of chars
 **
 ** @param    string  $text  words to be displayed
 ** @param	  int  $limit  char limit for words to be displayed 
 **/
function echoWordsX($text, $limit)
{
	$index = 0;
	$charTracker = 0;
	
    if (strlen($text) <= $limit)
    {
        echo $text;
    }
	
	else
    {
		$words = split(" ", $text);
	
		while (1)
		{
			if (isset($words[$index]) ==true)
			{
				$charTracker = $charTracker + strlen($words[$index]);
				
				if ($charTracker <= $limit)
				{
					if ($index != 0)
					{
						echo " ";
						
						$charTracker++;
					}
					
					echo $words[$index];
				}
			}
			
			else 
			{
				echo "...";
				
				break;
			}
			
			$index++;
		}
	}
}

/****
 ** Parses relative recipe image path from absolute recipe image path 
 ** 
 **
 ** @param    string  $absolutePath  path of given recipe image file 
 ** @return	  string  parsed relative recipe image path 
 **/
function relativeImagePath($absolutePath)
{
	$relativePath = "";
	
	return $relativePath;
}
?>
