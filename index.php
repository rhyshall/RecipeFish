<?php 
/******************************************************************************************
*******************************************************************************************
** Name: index.php																	   ****
** Description: Home page of Recipe Fish interface displaying favourite dishes  	   ****
** Author: Rhys Hall																   ****
** Date Created: 04/13/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

include($root . "utilities/database.php");
include($root . "utilities/indexUtilities.php");

$RECIPE_COUNT = 16;
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/index.css">
		
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
									<img class="recipe-image" src="/RecipeFish/images/skins/skin1.png">
									
									<p id="<?php echo "recipe-heading" . $j ?>" class="recipe-heading"><?php echo $heading?></p>
									
									<p id="<?php echo "recipe-name" . $j ?>" class="recipe-name">Name</p>
									
									<!--5-star rating system widget: retrieved from https://codepen.io/jamesbarnett/pen/vlpkh-->
									<fieldset class="rating">
										<input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Magnificent!"></label>
										<input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Amazing"></label>
										<input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Great"></label>
										<input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Good"></label>
										<input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Fair"></label>
										<input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Poor"></label>
										<input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Very poor"></label>
										<input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Sucked!"></label>
										<input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Really sucked!"></label>
										<input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Worst recipe ever!"></label>
									</fieldset>
									
									<div id="clear-float1">
										<!--clear float from previous content-->
									</div>
									
									<p id="<?php echo "recipe-description" . $j ?>" class="recipe-description">Description</p>
									
									<div class="recipe-separator">
										<hr>
									</div>
									
									<span class="glyphicon glyphicon-user"></span><p id="<?php echo "recipe-author" . $j ?>" class="recipe-author">Author</p>
									
									<div id="clear-float2">
										<!--clear float from previous content-->
									</div>
									
									<span class="glyphicon glyphicon-time"></span><p id="<?php echo "recipe-time" . $j ?>" class="recipe-time">Time</p>
									
									<div id="clear-float3">
										<!--clear float from previous content-->
									</div>
									
									<span class="glyphicon glyphicon-book"></span><p id="<?php echo "recipe-cookbook" . $j ?>" class="cookbook-adds">0</p>
									
									<div id="clear-float4">
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
