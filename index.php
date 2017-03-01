<?php 
/******************************************************************************************
*******************************************************************************************
** Name: index.php																	   ****
** Description: Home page Recipe Mingle interface displaying favourite dishes  		   ****
** Author: Rhys Hall																   ****
** Date Created: 04/13/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeMingle/";

include($root . "utilities/database.php");
include($root . "utilities/indexUtilities.php");

$RECIPE_COUNT = 16;
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeMingle/stylesheets/index.css">
		
		<!--stylesheet for tab icon-->
		<link rel="shortcut icon" type="image/ico" href="/RecipeMingle/images/standard/colour wheel.ico"/>
	</head>
	
	<body>
		<div id="header">
			<?php 
				include($root . "view/header.php");
			?>
		</div>
		
		<div id="margin-canvas1">
			<!--left-side coloured border-->
		</div>
		
		<div id="container">
			<div id="top-separator">
				<hr>
			</div>
		
			<div id="recipe-canvas">
				<?php 
					for ($i = 1; $i < $RECIPE_COUNT; $i = $i + 4)
					{
						echo '<div class="row">';
					
						$lowerBound = $i;
						$upperBound = $lowerBound + 4;
						
						for ($j = $lowerBound; $j < $upperBound; $j++)
						{
				?>
							<div id="<?php echo "recipe" . $j ?>" class="col-md-3">
								<?php 
									$heading = generateHeading();
								
									$recipe = new Recipe;
									$recipe = generateRecipe($heading);
								?>
							
								<a href="#" class="thumbnail">
									<img class="recipe-image" src="/RecipeMingle/images/skins/skin1.png">
									
									<p id="<?php echo "recipe-heading" . $j ?>" class="recipe-heading"><?php echo $heading?></p>
									
									<p id="<?php echo "recipe-name" . $j ?>" class="recipe-name">Name</p>
									
									<p id="<?php echo "recipe-description" . $j ?>" class="recipe-description">Description</p>
									
									<div class="recipe-separator">
										<hr>
									</div>
									
									<p id="<?php echo "recipe-author" . $j ?>" class="recipe-author">Author</p>
									
									<span class="glyphicon glyphicon-time"></span><p id="<?php echo "recipe-time" . $j ?>" class="recipe-time">Time</p>
									
									<div id="clear-float1">
										<!--clear float from previous content-->
									</div>
								</a>
							
								<!---->
							</div>	
					<?php 
						}
						
						echo '</div>';
					}
					?>
			</div>
			
			<div id="bottom-separator">
				<hr>
			</div>
		</div>
		
		<div id="margin-canvas2">
			<!--right-side coloured border-->
		</div>
		
		<div id="clear-float2">
			<!--clear float from previous content-->
		</div>
		
		<div id="footer">
			<?php 
				include($root . "view/footer.php");
			?>
		</div>
	</body>
</html>
