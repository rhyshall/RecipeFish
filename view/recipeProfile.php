<?php 
/******************************************************************************************
*******************************************************************************************
** Name: recipeProfile.php													   		   ****
** Description: Displays given recipe and all its contents in an organized fashion	   ****
** Author: Rhys Hall																   ****
** Date Created: 09/25/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

include($root . "utilities/database.php");
include($root . "/model/user.php");
include($root . "/model/recipe.php");
include($root . "/model/recipeIngredient.php");
include($root . "/model/recipeDirection.php");
include($root . "/model/ingredient.php");
include($root . "/model/direction.php");
include($root . "/model/review.php");
include($root . "/model/cookbook.php");

/****
** Delimit feature string with '%' and assign each 
** feature to array 
**
** @return    array  features 
*/
function featureStringToArray($string)
{
	$features = array();
	$featuresIndex = 0;
	$featureStart = 0;
	$featureEnd = 0;
	$feature = "";
	$length = strlen($string);
	
	for ($a = 0; $a < $length; $a++) 
	{
		if ($string[$featureEnd] == '%')
		{
			for ($i = $featureStart; $i < $featureEnd; $i++)
			{
				$feature = $feature . $string[$i];
			}
			
			$features[$featuresIndex] = $feature;
			
			$feature = "";
			$featuresIndex++;
			$featureStart = $featureEnd + 1;
		}

		$featureEnd++;
	}
	
	return $features;
}

$recipeID = $_GET["id"];

//retrieve all recipe info from database and assign to variables for use 
$recipe = new Recipe;
$recipeSelector = new Recipe;
$popularFeatures = array();
$otherFeatures = array();
$ingredients = array();
$directions = array();

$recipe = $recipeSelector->selectByRecipeID($recipeID);

//retrieve/assign basic recipe info 
$name = $recipe["name"];
$description = $recipe["description"];
$prepHour = $recipe["prep_time_hour"];
$prepMin = $recipe["prep_time_minute"];
$cookHour = $recipe["cook_time_hour"];
$cookMin = $recipe["cook_time_minute"];
$waitHour = $recipe["wait_time_hour"];
$waitMin = $recipe["wait_time_minute"];
$servings = $recipe["servings"];
$imagePath = substr($recipe["image_path"], strpos($recipe["image_path"], "/RecipeFish"));
$ethnicity = $recipe["ethnicity"];
$mealType = $recipe["meal_type"];
$popularFeatures = featureStringToArray($recipe["popular_features"]);
$otherFeatures = featureStringToArray($recipe["other_features"]);
$holiday = $recipe["holiday"];
$notes = $recipe["notes"];
$authorID = $recipe["author_id"];

//get rating of given recipe
$reviewSelector = new Review;
$rating = $reviewSelector->averageRecipeRating($recipe["id"]);

//get rating count of given recipe
$recipeReviews = $reviewSelector->selectByRecipeID($recipe["id"]);
$ratingCount = count($recipeReviews);

//get cookbook add count of given recipe
$cookbookSelector = new Cookbook;
$cookbookCount = $cookbookSelector->getEntryCount($recipe["id"]);

//get author's image path 
$author = new User;
$userSelector = new User;

$author = $userSelector->selectByID($authorID);
$authorImagePath = $author->getImagePath();

//split time from date uploaded
$splitArray = array();
$splitArray = explode(" ", $recipe["date_uploaded"]);
$dateUploaded = $splitArray[0];

//retrieve ingredient IDs for given recipe
$recipeIngredientSelector = new RecipeIngredient;
$ingredientIDs = array();

$ingredientIDs = $recipeIngredientSelector->selectByRecipeID($recipeID);

//retrieve direction IDs for given recipe
$recipeDirectionSelector = new RecipeDirection;
$directionIDs = array();

$directionIDs = $recipeDirectionSelector->selectByRecipeID($recipeID);

//retrieve each ingredient content for given recipe 
$ingredientCount = count($ingredientIDs);
$ingredientsSelector = new Ingredient;

for ($i = 0; $i < $ingredientCount; $i++)
{
	$ingredients[$i] = $ingredientsSelector->selectByID($ingredientIDs[$i]);
}

//retrieve each direction content for given recipe 
$directionCount = count($directionIDs);
$directionsSelector = new Direction;

for ($i = 0; $i < $directionCount; $i++)
{
	$directions[$i] = $directionsSelector->selectByID($directionIDs[$i]);
}

//retrieve author username 
$userObj = new User;
$userSelector = new User;

$userObj = $userSelector->selectByID($authorID);
$authorUsername = $userObj->getUsername();
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/recipeProfile.css">
		
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
		
			<div id="recipe-content">
				<div id="title">
					<p><?php echo $name ?></p>
				</div>
			
				<div id="recipe-header">
					<div id="left-header">
						<div id="recipe-photo">
							<img src="<?php echo $imagePath ?>"></img>
						</div>
					</div>
				
					<div id="right-header">
						<div id="author-photo">
							<img src="<?php echo $authorImagePath ?>"></img>
						</div>
					
						<div id="author-info">
							<p>Recipe by</p>
							
							<a href="#"><?php echo $authorUsername ?></a>
						</div>
						
						<div class="clear-float">
							<!--clear float from previous content-->
						</div>
						
						<div id="rating">
							<div class="rating-stars">
								<?php 
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
						</div>
							
						<?php 
							//align rating count appropriately with trailing half-star
							if ((($rating >= 0.25) && ($rating < 0.75)) || (($rating >= 1.25) && ($rating < 1.75)) || (($rating >= 2.25) && ($rating < 2.75))
								|| (($rating >= 3.25) && ($rating < 3.75)) || (($rating >= 4.25) && ($rating < 4.75)))
							{
								echo "<div class='rating-count1'>";

								echo "<p>(" . $ratingCount . ")" . "</p>";
									
								echo "</div>";
							}
							
							//align rating count appropriately with trailing full-star											
							else 
							{
								echo "<div class='rating-count2'>";

								echo "<p>(" . $ratingCount . ")" . "</p>";
										
								echo "</div>";	
							}
						?>
						
						<div class="clear-float">
							<!--clear float from previous content-->
						</div>
						
						<div id ="cookbook-adds">
							<?php 
								if ($cookbookCount <= 0)
								{
									echo "<p>Be the first to add to cookbook!</p>";
								}
								
								if ($cookbookCount == 1)
								{
									echo "<p>" . $cookbookCount . " user added to cookbook</p>";
								}
								
								if ($cookbookCount >= 2)
								{
									echo "<p>" . $cookbookCount . " users added to cookbook</p>";
								}
							?>
						</div>
						
						<div id="prep-time">
							<span class="glyphicon glyphicon-time"></span> 
							
							<p>Prep<span class="colon">:</span> <?php if (($prepHour > 0) || (strpos($prepHour, "+") == true)) echo $prepHour . " Hr"; if (($prepHour > 0) && ($prepMin > 0)) echo ", "; if ($prepMin > 0) echo $prepMin . " Min"; if (($prepMin <= 0) && ($prepHour <=0)) echo "N/A"; ?></p>
							
							<div class="clear-float">
								<!--clear float from previous content-->
							</div>
						</div>
							
						<div id="cook-time">
							<span class="glyphicon glyphicon-time"></span> 
						
							<p>Cook<span class="colon">:</span> <?php if (($cookHour > 0) || (strpos($cookHour, "+") == true)) echo $cookHour . " Hr"; if (($cookHour > 0) && ($cookMin > 0)) echo ", "; if ($cookMin > 0) echo $cookMin . " Min"; if (($cookMin <= 0) && ($cookHour <=0)) echo "N/A"; ?></p>
						
							<div class="clear-float">
								<!--clear float from previous content-->
							</div>
						</div>
						
						<div class="clear-float">
							<!--clear float from previous content-->
						</div>
						
						<div id="wait-time">
							<span class="glyphicon glyphicon-time"></span> 
						
							<p>Wait<span class="colon">:</span> <?php if (($waitHour > 0) || (strpos($waitHour, "+") == true)) echo $waitHour . " Hr"; if (($waitHour > 0) && ($waitMin > 0)) echo ", "; if ($waitMin > 0) echo $waitMin . " Min"; if (($waitMin <= 0) && ($waitHour <=0)) echo "N/A"; ?></p>
						
							<div class="clear-float">
								<!--clear float from previous content-->
							</div>
						</div>

						<div id="servings">
							<span id="cutlery" class="glyphicon glyphicon-cutlery"></span> 
						
							<p>Servings<span class="colon">:</span> <?php echo $servings ?></p>
							
							<div class="clear-float">
								<!--clear float from previous content-->
							</div>
						</div>
						
						<div class="clear-float">
							<!--clear float from previous content-->
						</div>
					</div>
					
					<div class="clear-float">
						<!--clear float from previous content-->
					</div>
					
					<div id="bottom-header">
						<div id="recipe-options" class="btn-group" role="group">
							<button id="cookbook-button" type="button" class="btn btn-warning"><span id="cookbook-icon" class="glyphicon glyphicon-book"></span>Add</button>
							<button id="review-button" type="button" class="btn btn-warning"><span id="review-icon" class="glyphicon glyphicon-list-alt"></span>Review</button>
							<button id="share-button" type="button" class="btn btn-warning"><span id="share-icon" class="glyphicon glyphicon-share"></span>Share</button>
							<button id="print-button" type="button" class="btn btn-warning"><span id="print-icon" class="glyphicon glyphicon-print"></span>Print</button>
							<button id="fix-button" type="button" class="btn btn-warning"><span id="fix-icon" class="glyphicon glyphicon-wrench"></span>Fix</button>
							<button id="report-button" type="button" class="btn btn-warning"><span id="report-icon" class="glyphicon glyphicon-alert"></span>Report</button>
						</div>
					</div>
				</div>
				
				<div id="recipe-body">
					<div id="recipe-description">
						<div id="description-title">
							<p>Description</p>
						</div>
						
						<div id="description-text">
							<p><?php echo $description ?> </p>
						</div>
					</div>
					
					<div id="recipe-ingredients">
						<div id="ingredients-title">
							<p>Ingredients</p>
						</div>
					
						<div id="ingredients-text">
							<?php 
								$upperBound = count($ingredients);
								
								for ($i = 0; $i < $upperBound; $i++)
								{
									echo "<span class='glyphicon glyphicon-plus'></span><p class='ingredient'>$ingredients[$i]</p>";
									
									echo '<div class="clear-float"><!--clear float from previous content--></div>';
								}
							?>	
						</div>
					</div>
					
					<div id="recipe-directions">
						<div id="directions-title">
							<p>Directions</p>
						</div>
						
						<div id="directions-text">
							<?php 
								$upperBound = count($directions);
								
								for ($i = 0; $i < $upperBound; $i++)
								{
									echo "<div class='step-area'>";
									echo "<p class='step'>" . ($i+1) . ". " . "</p>";
									echo "</div>";
									
									echo "<div class='direction-area'>";
									echo "<p class='direction'>" . $directions[$i] . "</p>";
									echo "</div>";
									
									echo '<div class="clear-float"><!--clear float from previous content--></div>';
								}
							?>	
						</div>
					</div>
					
					<div id="recipe-notes">
						<div id="notes-title">
							<p>Notes</p>
						</div>
						
						<div id="notes-text">
							<?php 
								//display "None" if notes empty
								if (strcmp($notes, "") == 0)
								{
									echo "<p>None</p>"; 
								}
							
								else 
								{
									echo "<p>" . $notes . "</p>";
								}
							?>
						</div>
					</div>
					
					<div id="recipe-reviews">
						<div id="reviews-title">
							<p>Reviews</p>
						</div>
						
						<div id="reviews-text">
							<?php 
							
							?>
						</div>
					</div>
				</div>
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
