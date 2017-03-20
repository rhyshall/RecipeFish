<?php 
/******************************************************************************************
*******************************************************************************************
** Name: addRecipeNotes.php													   		   ****
** Description: Provides interface for uploading optional notes for a desired recipe   ****
** Author: Rhys Hall																   ****
** Date Created: 06/04/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/addRecipeNotes.css">
		
		<!--stylesheet for tab icon-->
		<link rel="shortcut icon" type="image/ico" href="/RecipeFish/images/standard/fish tab icon.ico"/>
	</head>
	
	<body>
		<div id="margin-canvas1">
			<!--left-side coloured border-->
		</div>
		
		<div id="container">
			<div id="header">
				<?php 
					include($root . "view/header.php");
				?>
			</div>
		
			<div id="title">
				<p>Add Recipe</p>
			</div>
		
			<div id="sub-title">
				<p>Notes</p>
			</div>
			
			<div id="bar">
				<div class="progress">
					<div id="blue-bar" class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
						<span class="sr-only">100% Complete</span>
					</div>
				</div>
			</div>
		
			<form id="notes-form" action="/RecipeFish/controller/addRecipeController.php" method="post">
				<div id="notes-box">
					<p id="notes-instructions-1">Enter any additional comments about your recipe (maximum 500 characters)</p>
					
					<?php 
						//notes length error (if required)
						include($root . "view/addNotesError.php");
					?>
				
					<div id="notes">
						<p id="notes-title">Notes (Optional)</p>
						
						<?php 
							if (isset($_SESSION["notes"]) == true)
							{
						?>		<!--display notes from previous input-->
								<textarea id="notes-field" name="notes" type="text" class="form-control"><?php echo $_SESSION["notes"] ?></textarea>
						<?php 
						
								unset($_SESSION["notes"]);
							}
							
							else 
							{
						?>
								<!--display notes with default "none" placeholder-->
								<textarea id="notes-field" name="notes" type="text" class="form-control" placeholder="None"></textarea>
						<?php
							}
						?>
					</div>
				</div>
			
				<div id="submit">
					<button id="submit-button" class="btn btn-success" type="submit">Submit</button>
				</div>
			</form>
			
			<div id="footer">
				<?php 
					include($root . "view/footer.php");
				?>
			</div>
		</div>
		
		<div id="margin-canvas2">
			<!--right-side coloured border-->
		</div>
		
		<div id="clear-float">
			<!--clear float from previous content-->
		</div>
	</body>
</html>
