<?php
/******************************************************************************************
*******************************************************************************************
** Name: notesLengthError.php												           ****
** Description: Displays error message for invalid notes length during notes input	   ****
** Author: Rhys Hall																   ****
** Date Created: 09/05/2016														   	   ****
*******************************************************************************************
******************************************************************************************/
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeMingle/stylesheets/addNotesError.css">
	<head>
	
	<body>
		<?php 
			if (isset($_SESSION["notesLengthError"]) == true)
			{
		?>		<!--notes length error message (if required)-->	
				<div id="notes-length-message">
					<p><span id="exclamation-mark" class="glyphicon glyphicon-exclamation-sign"></span>Notes may not exceed 500 characters</p>
				</div>
				
			<?php 
				unset($_SESSION["notesLengthError"]);
			}
			?>
	</body>
</html>
