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
include($root . "utilities/generalUtilities.php");

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
					$chosenIDList = array(); /* IDs of recipes chosen to display (for anti-duplicate purposes) */
					$reviewSelector = new Review;
					$rating = 0;
				
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
									while (1)
									{
										$heading = generateHeading();
								
										$recipe = array();
										$recipe = generateRecipe($heading);
										
										if ($recipe == null)
										{
											unset($recipe);
										}
										
										else 
										{
											if (in_array($recipe["id"], $chosenIDList))
											{
												unset($recipe);
											}
											
											else 
											{	
												array_push($chosenIDList, $recipe["id"]);
					
												break;
											}
										}
									}
								?>
							
								<a href="#" class="thumbnail">
									<img class="recipe-image" src="/RecipeFish/images/skins/skin1.png">
									
									<p id="<?php echo "recipe-heading" . $j ?>" class="recipe-heading"><?php echo $heading ?></p>
									
									<p id="<?php echo "recipe-name" . $j ?>" class="recipe-name"><?php echo $recipe["name"] ?></p>
									
									<div class="rating">
										<?php 
											$rating = $reviewSelector->averageRecipeRating($recipe["id"]);
											
											//if not rated
											if ($rating < 0.5)
											{
												echo "<i class='glyphicon glyphicon-star-empty'></i>";
												echo "<i class='glyphicon glyphicon-star-empty'></i>";
												echo "<i class='glyphicon glyphicon-star-empty'></i>";
												echo "<i class='glyphicon glyphicon-star-empty'></i>";
												echo "<i class='glyphicon glyphicon-star-empty'></i>";
											}
											
											//if average rating is 0.5 stars
											if (($rating >= 0.5) && ($rating < 0.75))
											{
												echo "<i class='glyphicon glyphicon-star half'></i>";
											}
											
											//if average rating is 1 star
											if (($rating >= 0.75) && ($rating < 1.25))
											{
												echo "<i class='glyphicon glyphicon-star'></i>";
											}
											
											//if average rating is 1.5 stars
											if (($rating >= 1.25) && ($rating < 1.75))
											{
												echo "<i class='glyphicon glyphicon-star'></i>";
												echo "<i class='glyphicon glyphicon-star half'></i>";
											}
											
											//if average rating is 2 stars
											if (($rating >= 1.75) && ($rating < 2.25))
											{
												echo "<i class='glyphicon glyphicon-star'></i>";
												echo "<i class='glyphicon glyphicon-star'></i>";
											}
											
											//if average rating is 2.5 stars
											if (($rating >= 2.25) && ($rating < 2.75))
											{
												echo "<i class='glyphicon glyphicon-star'></i>";
												echo "<i class='glyphicon glyphicon-star'></i>";
												echo "<i class='glyphicon glyphicon-star half'></i>";
											}
											
											//if average rating is 3 stars
											if (($rating >= 2.75) && ($rating < 3.25))
											{
												echo "<i class='glyphicon glyphicon-star'></i>";
												echo "<i class='glyphicon glyphicon-star'></i>";
												echo "<i class='glyphicon glyphicon-star'></i>";
											}
											
											//if average rating is 3.5 stars
											if (($rating >= 3.25) && ($rating < 3.75))
											{
												echo "<i class='glyphicon glyphicon-star'></i>";
												echo "<i class='glyphicon glyphicon-star'></i>";
												echo "<i class='glyphicon glyphicon-star'></i>";
												echo "<i class='glyphicon glyphicon-star half'></i>";
											}
											
											//if average rating is 4 stars
											if (($rating >= 3.75) && ($rating < 4.25))
											{
												echo "<i class='glyphicon glyphicon-star'></i>";
												echo "<i class='glyphicon glyphicon-star'></i>";
												echo "<i class='glyphicon glyphicon-star'></i>";
												echo "<i class='glyphicon glyphicon-star'></i>";
											}
											
											//if average rating is 4.5 stars
											if (($rating >= 4.25) && ($rating < 4.75))
											{
												echo "<i class='glyphicon glyphicon-star'></i>";
												echo "<i class='glyphicon glyphicon-star'></i>";
												echo "<i class='glyphicon glyphicon-star'></i>";
												echo "<i class='glyphicon glyphicon-star'></i>";
												echo "<i class='glyphicon glyphicon-star half'></i>";
											}
											
											//if average rating is 5 stars
											if ($rating >= 4.75)
											{
												echo "<i class='glyphicon glyphicon-star'></i>";
												echo "<i class='glyphicon glyphicon-star'></i>";
												echo "<i class='glyphicon glyphicon-star'></i>";
												echo "<i class='glyphicon glyphicon-star'></i>";
												echo "<i class='glyphicon glyphicon-star'></i>";
											}
										?>
									</div>
									
									<div id="clear-float1">
										<!--clear float from previous content-->
									</div>
									
									<p id="<?php echo "recipe-description" . $j ?>" class="recipe-description"><?php echoWordsX($recipe["description"], 118) ?></p>
									
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
		
		<div id="clear-float5">
			<!--clear float from previous content-->
		</div>
	</body>
</html>
