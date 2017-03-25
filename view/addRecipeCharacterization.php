<?php 
/******************************************************************************************
*******************************************************************************************
** Name: addRecipeCharacterization.php												   ****
** Description: Provides interface for uploading name and description for a desired    ****
** 				recipe																   ****
** Author: Rhys Hall																   ****
** Date Created: 03/20/2017													   	   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/addRecipeCharacterization.css">
		
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
			
			<div id="chef-fish-panel">
				<img id="chef-fish" src="/RecipeFish/images/standard/chef fish.png">
			</div>
			
			<?php 
				//name and description error message (if required)
				if ((isset($_SESSION["emptyField"]) == true) || (isset($_SESSION["nameLengthInvalid"]) == true) || (isset($_SESSION["nameSymbolsInvalid"]) == true) || (isset($_SESSION["descriptionLengthInvalid"]) == true))
				{
					include($root . "view/recipeCharacterizationError.php");	
				}
				
				else 
				{
			?>
					<!--display default recipe name and description prompt-->
					<div id="speech-bubble-panel">
						<img id="speech-bubble" src="/RecipeFish/images/standard/speech bubble.png">
								
						<p id="speech-text1">First things first, enter a name and description</p>
						<p id="speech-text2">for your recipe!</p>
					</div>
			<?php
				}
			?>
			
			<div id="clear-float1">
				<!--clear float from previous content-->
			</div>
			
			<form id="brief-form" action="/RecipeFish/controller/recipeCharacterizationController.php" method="post">
				<div id="panel">
					<?php
						//if recipe name input previously filled
						if (isset($_SESSION["recipeNameField"]) == true)
						{
					?>		<!--set recipe name field as previous value-->
							<div id="recipe-name">
								<p>Name</p>
							
								<input id="recipe-name-field" name="recipe-name" type="text" class="form-control" value="<?php echo $_SESSION["recipeNameField"] ?>"></input>
							</div>
						<?php 
							unset($_SESSION["recipeNameField"]);
						}
					
						else 
						{
							?>	<!--insert recipe name placeholder-->
							<div id="recipe-name">
								<p>Name</p>
							
								<input id="recipe-name-field" name="recipe-name" type="text" class="form-control"></input>
							</div>
					<?php
						}
					?>
						
					<?php
						//if recipe name input previously filled
						if (isset($_SESSION["descriptionField"]) == true)
						{
					?>		<!--set recipe name field as previous value-->
							<div id="description">
								<p>Description</p>
							
								<textarea id="description-field" name="description" type="text" class="form-control"><?php echo $_SESSION["descriptionField"] ?></textarea>
							</div>
						<?php 
							unset($_SESSION["descriptionField"]);
						}
					
						else 
						{
						?>	<!--insert recipe name placeholder-->
							<div id="description">
								<p>Description</p>
							
								<textarea id="description-field" name="description" type="text" class="form-control"></textarea>
							</div>
					<?php
						}
					?>
				</div>
				
				<div id="next">
					<button id="next-button" class="btn btn-warning" type="submit">Next</button>
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
	</body>
</html>
	