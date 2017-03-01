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

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeMingle/";

include($root . "utilities/database.php");
include($root . "/model/recipe.php");
include($root . "/model/recipeIngredient.php");
include($root . "/model/recipeDirection.php");
include($root . "/model/ingredient.php");
include($root . "/model/direction.php");
include($root . "/model/user.php");

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

//retrieve/assign basic info 
$recipe = $recipeSelector->selectByRecipeID($recipeID);

$name = $recipe["name"];
$description = $recipe["description"];
$prepHour = $recipe["prep_time_hour"];
$prepMin = $recipe["prep_time_minute"];
$cookHour = $recipe["cook_time_hour"];
$cookMin = $recipe["cook_time_minute"];
$waitHour = $recipe["wait_time_hour"];
$waitMin = $recipe["wait_time_minute"];
$servings = $recipe["servings"];
$imagePath = substr($recipe["image_path"], strpos($recipe["image_path"], "/RecipeMingle"));
$ethnicity = $recipe["ethnicity"];
$mealType = $recipe["meal_type"];
$popularFeatures = featureStringToArray($recipe["popular_features"]);
$otherFeatures = featureStringToArray($recipe["other_features"]);
$holiday = $recipe["holiday"];
$notes = $recipe["notes"];
$authorID = $recipe["author_id"];

//split time from date 
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
		<link rel="stylesheet" type="text/css" href="/RecipeMingle/stylesheets/recipeProfile.css">
		
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
			<div id="title">
				<p><?php echo $name ?></p>
			</div>
			
			<div id="recipe-header">
				<div id="recipe-photo">
					<img src="<?php echo $imagePath ?>"></img>
					
					<div id="photo-stats">
						
					</div>
				</div>
				
				<div id="header-info1">
					<div id="prep-time">
						<span id="clock" class="glyphicon glyphicon-time"></span> 
					
						<p>Prep Time<span class="colon">:</span> <?php if ($prepHour > 0) echo $prepHour . " Hr"; if (($prepHour > 0) && ($prepMin > 0)) echo ", "; if ($prepMin > 0) echo $prepMin . " Min"; if (($prepMin <= 0) && ($prepHour <=0)) echo "N/A"; ?></p>
					
						<div id="clear-float">
							<!--clear float from previous content-->
						</div>
					</div>
					
					<div id="wait-time">
						<span id="clock" class="glyphicon glyphicon-time"></span> 
					
						<p>Wait Time<span class="colon">:</span> <?php if ($waitHour > 0) echo $waitHour . " Hr"; if (($waitHour > 0) && ($waitMin > 0)) echo ", "; if ($waitMin > 0) echo $waitMin . " Min"; if (($waitMin <= 0) && ($waitHour <=0)) echo "N/A"; ?></p>
					
						<div id="clear-float2">
							<!--clear float from previous content-->
						</div>
					</div>
					
					<div id="author">
						<p>Author<span class="colon">:</span></p>
						<a href="#"><?php echo $authorUsername ?></a>
						
						<div id="clear-float3">
							<!--clear float from previous content-->
						</div>
					</div>
					
					<div id="date-uploaded">
						<p>Date Uploaded<span class="colon">:</span> <?php echo $dateUploaded ?></p>
					</div>
				</div>
				
				<div id="header-info2">
					<div id="cook-time">
						<span id="clock2" class="glyphicon glyphicon-time"></span> 
					
						<p>Cook Time<span class="colon">:</span> <?php if ($cookHour > 0) echo $cookHour . " Hr"; if (($cookHour > 0) && ($cookMin > 0)) echo ", "; if ($cookMin > 0) echo $cookMin . " Min"; if (($cookMin <= 0) && ($cookHour <=0)) echo "N/A"; ?></p>
					
						<div id="clear-float4">
							<!--clear float from previous content-->
						</div>
					</div>
				
					<div id="servings">
						<span id="cutlery" class="glyphicon glyphicon-cutlery"></span> 
					
						<p>Servings<span class="colon">:</span> <?php echo $servings ?></p>
						
						<div id="clear-float5">
							<!--clear float from previous content-->
						</div>
					</div>
				</div>
				
				<div id="clear-float6">
					<!--clear float from previous content-->
				</div>
			</div>
			
			<div id="recipe-description">
				<div id="description-title">
					<p>Description</p>
				</div>
				
				<div id="description-text">
					<p> <?php echo $description ?> </p>
				</div>
			</div>
			
			<div id="recipe-ingredients">
				<div id="ingredients-title">
					<p>Ingredients</p>
				</div>
				
				<div id="ingredients-text">
					<div id="ingredients-text1">
						<?php 
							$upperBound = count($ingredients);
							
							for ($i = 0; $i < $upperBound; $i = $i + 2)
							{
								echo "<span class='glyphicon glyphicon-plus'></span><p class='ingredient'>$ingredients[$i]</p>";
								
								echo '<div id="clear-float8"><!--clear float from previous content--></div>';
							}
						?>	
					</div>
					
					<div id="ingredients-text2">
						<?php 
							$upperBound = count($ingredients);
							
							for ($i = 1; $i < $upperBound; $i = $i + 2)
							{
								echo "<span class='glyphicon glyphicon-plus'></span><p class='ingredient'>$ingredients[$i]</p>";
								
								echo '<div id="clear-float8"><!--clear float from previous content--></div>';
							}
						?>	
					</div>
				
					<div id="clear-float9">
						<!--clear float from previous content-->
					</div>
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
								
								echo '<div id="clear-float10"><!--clear float from previous content--></div>';
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
		</div>

		<div id="margin-canvas2">
			<!--right-side coloured border-->
		</div>
		
		<div id="clear-float11">
			<!--clear float from previous content-->
		</div>
		
		<div id="footer">
			<?php 
				include($root . "view/footer.php");
			?>
		</div>
	</body>
</html>
