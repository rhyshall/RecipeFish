<?php 
/******************************************************************************************
*******************************************************************************************
** Name: addRecipePhoto.php												   			   ****
** Description: Provides interface for uploading photo for a desired recipe			   ****
** Author: Rhys Hall																   ****
** Date Created: 03/20/2017													   	   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/addRecipePhoto.css">
		
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
				<p>Photo</p>
			</div>
			
			<div id="bar">
				<div class="progress">
					<div id="blue-bar" class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="29" aria-valuemin="0" aria-valuemax="100">
						<span class="sr-only">29% Complete</span>
					</div>
				</div>
			</div>
			
			<div id="clear-float1">
				<!--clear float from previous content-->
			</div>
			
			<form id="brief-form" action="/RecipeFish/controller/recipePhotoController.php" method="post" enctype="multipart/form-data">
				<div id="panel">
					<div id="photo-instructions">
						<p>Choose a photo of your prepared recipe to display to users</p>
					</div>
					
					<?php 
						//add recipe features error messages (if required)
						include($root . "view/recipePhotoError.php");
					?>
					
					<div id="tip">
						<img id="lightbulb" src="/RecipeFish/images/standard/lightbulb.png">
						
						<p>Appealing photos will help reel users in</p>
					</div>
				
					<?php
						//if recipe image input previously filled
						if (isset($_SESSION["imageField"]) == true)
						{
					?>		<!--set recipe image field as previous value-->
							<div id="recipe-image">
								<label for="recipe-image-field">
									<i id="photo-icon" class="glyphicon glyphicon-camera"></i>
								</label>
						
								<input id="recipe-image-field" name="recipe-image" type="file" class="file" value="<?php echo $_SESSION["imageField"] ?>"></input>
							</div>
						<?php 
							unset($_SESSION["imageField"]);
						}
				
						else 
						{
						?>	<!--insert recipe image placeholder-->
							<div id="recipe-image">
								<label for="recipe-image-field">
									<i id="photo-icon" class="glyphicon glyphicon-camera"></i>
								</label>
						
								<input id="recipe-image-field" name="recipe-image" type="file" class="file" value="Upload Photo"></input>
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
