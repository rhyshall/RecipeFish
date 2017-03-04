<?php 
/******************************************************************************************
*******************************************************************************************
** Name: recipes.php													   		       ****
** Description: Provides interface for managing personal recipes					   ****
** Author: Rhys Hall																   ****
** Date Created: 09/01/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

include($root . "/utilities/recipesUtilities.php");
include($root . "utilities/database.php");
include($root . "/model/recipe.php");

$MAX_DISPLAY_COUNT = 7; /* maximum recipes to display for 1 page */
$ALPHABETICAL = 1;
$NEWEST_TO_OLDEST = 2;
$OLDEST_TO_NEWEST = 3;
$REVERSE_ALPHABETICAL = 4;
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/recipes.css">
		
		<!--stylesheet for tab icon-->
		<link rel="shortcut icon" type="image/ico" href="/RecipeFish/images/standard/colour wheel.ico"/>
		
		<script type="text/javascript">
			<!--disables parent window until pop-up window closed 
			function parentDisable() 
			{
				if (popUpWindow && !popUpWindow.closed)
				{
					popUpWindow.focus();
				}
			}
			
			<!--displays success pop-up window if add recipe was successful
			function displayAddSuccessPopUp()
			{
				var parameters = "height=250,width=425,left=" + ((screen.width/2)-(425/2)) + ",top=" + ((screen.height/2)-(screen.height/4));
				
				popUpWindow = window.open("addRecipeSuccess.php", "Add Recipe Success Message", parameters);
			}
		
			<!--displays error pop-up window if add recipe was unsuccessful
			function displayAddErrorPopUp()
			{
				var parameters = "height=275,width=425,left=" + ((screen.width/2)-(425/2)) + ",top=" + ((screen.height/2)-(screen.height/4));
				
				popUpWindow = window.open("addRecipeError.php", "Add Recipe Error Message", parameters);
			}
			
			<!--confirm deletion of given recipe-->
			function confirmRecipeDelete(id)
			{
				var parameters = "height=275,width=425,left=" + ((screen.width/2)-(425/2)) + ",top=" + ((screen.height/2)-(screen.height/4));
				
				popUpWindow = window.open("confirmRecipeDelete.php?id=" + id, "Confirm Recipe Deletion", parameters);
			}
			
			<!--displays success pop-up window if add recipe was successful
			function displayDeleteSuccessPopUp(name)
			{
				var parameters = "height=275,width=575,left=" + ((screen.width/2)-(575/2)) + ",top=" + ((screen.height/2)-(screen.height/4));
				
				popUpWindow = window.open("deleteRecipeSuccess.php?name=" + name, "Delete Recipe Success Message", parameters);
			}
			
			<!--permanently changes user recipe sort type and reloads page 
			function sortSelect(recipeSortID)
			{
				window.location.href = "/RecipeFish/controller/recipeSortTypeController.php?sortType=" + recipeSortID;
			}
			
			<!--switches recipe page to selected page number-->
			function switchPage(value)
			{
				var pageNumber = value[0];
				
				window.location.href = "/RecipeFish/controller/recipePageController.php?pageNumber=" + pageNumber;
			}
		</script>
	</head>
	
	<body onFocus="parentDisable();" onclick="parentDisable();">
		<div id="header">
			<?php 
				include($root . "view/header.php");
			?>
		</div>
		
		<div id="margin-canvas1">
			<!--left-side coloured border-->
		</div>
		
		<?php
			if (isset($_SESSION["addRecipeSuccess"]) == true)
			{
				echo "<script type='text/javascript'>displayAddSuccessPopUp();</script>";
					
				unset($_SESSION["addRecipeSuccess"]);
			}
		
			if (isset($_SESSION["addRecipeError"]) == true)
			{
				echo "<script type='text/javascript'>displayAddErrorPopUp();</script>";
					
				unset($_SESSION["addRecipeError"]);
			}
			
			if (isset($_SESSION["deleteRecipeSuccess"]) == true)
			{
				$name = $_SESSION["deleteRecipeSuccess"];
				
				echo "<script type='text/javascript'>displayDeleteSuccessPopUp(" . "'" . $name . "'" . ");</script>";
				
				unset($_SESSION["deleteRecipeSuccess"]);
			}
		?>
		
		<div id="container">
			<?php 
				include($root . "view/profileHeader.php");
			?>
		
			<div id="title">
				<p>Recipes</p>
			</div>
			
			<?php 
				//if user has no recipes
				if (hasRecipe() == false)
				{
			?>		<!--prompt user to add first recipe-->
					<form id="add-first-recipe-form" action="/RecipeFish/view/addRecipeInfo.php" method="post">
						<div id="add-first-recipe-messages">
							<p id="recipe-message1">You have not added any personal recipes</p>
						
							<p id="recipe-message2">Share your own tasty creations and boost your name as a chef</p>
						</div>
				
						<div id="add-first-recipe">
							<button id="add-first-recipe-button" class="btn btn-success" type="submit">Add Your First Now!</button>
						</div>
					</form>
			<?php 
				}
				
				//if user has an existing recipe
				else 
				{
					//get recipes corresponding to given user ID
					$recipes = new Recipe;
					$recipeSelector = new Recipe;
					
					$recipes = $recipeSelector->selectByUserID($_SESSION["userID"]);
					$recipeCount = count($recipes);
					
					if ((int)($recipeCount % $MAX_DISPLAY_COUNT) == 0)
					{
						$pageCount = ((int)($recipeCount / $MAX_DISPLAY_COUNT));
					}
					
					else 
					{
						$pageCount = ((int)($recipeCount / $MAX_DISPLAY_COUNT)) + 1;
					}
					
					//get current user recipe sort type 
					$user = new User;
					$userSelector = new User;
					
					$user = $userSelector->selectByUsername($_SESSION["username"]);
					
					$sortType = $user->getRecipeSortID();
					
					if (($sortType != $ALPHABETICAL) && ($sortType != $NEWEST_TO_OLDEST) && ($sortType != $OLDEST_TO_NEWEST) && ($sortType != $REVERSE_ALPHABETICAL))
					{
						$sortType = $ALPHABETICAL;
					}
					
					//get set ordering (by array indexes) of recipes
					$indexes = array();
					$indexes = sortRecipes($recipes, $sortType);
					
			?>		<!--display all user's recipes-->
					<div id="recipes">
						<table id="recipes-table" class="table table-striped" border="0" cellpadding="0" cellspacing="0">
							<thead>
								<tr>
									<th id="photo-table-title">Photo</th>
									<th id="recipe-name-table-title">Name</th>
									<th id="date-uploaded-table-title">Date Uploaded</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
		   
							<tbody>
								<?php 
									if (isset($_SESSION["pageNumber"]) == true)
									{
										$pageNumber = $_SESSION["pageNumber"];
										
										unset($_SESSION["pageNumber"]);
										
										$offset = ($MAX_DISPLAY_COUNT * $pageNumber) - $MAX_DISPLAY_COUNT;
									}
									
									else 
									{
										$pageNumber = 1;
										$offset = 0;
									}
									
									$upperBound = $MAX_DISPLAY_COUNT + $offset;
								
									for ($i = $offset; $i < $upperBound; $i++)
									{
										if (isset($recipes[$i]) == true)
										{
											$index = $indexes[$i];
											
											$id = $recipes[$index]["id"];
											$imagePath = strstr($recipes[$index]["image_path"], "/RecipeFish/");
											$name = $recipes[$index]["name"];
											
											//split time from date 
											$splitArray = array();
											$splitArray = explode(" ", $recipes[$index]["date_uploaded"]);
											$date = $splitArray[0];
								?>
											<tr>
												<td id="<?php echo 'photo' . $i+1 ?>"><a href="/RecipeFish/view/recipeProfile.php?id=<?php echo $id ?>"><img src="<?php echo $imagePath; ?>"></a></img></td>
												<td id="<?php echo 'name' . $i+1 ?>"><div class="table-name"><a href="/RecipeFish/view/recipeProfile.php?id=<?php echo $id ?>"><?php echo $name ?></a></div></td>
												<td id="<?php echo 'date' . $i+1 ?>"><div class="table-date"><?php echo $date ?></div></td>
												<td><span class="glyphicon glyphicon-pencil" style="cursor:pointer"></span></td>
												<td><span id="<?php echo $id ?>" class="glyphicon glyphicon-trash" style="cursor:pointer" onclick="confirmRecipeDelete(this.id)"></span></td>
											</tr>
									<?php 
										}
										
										else 
										{
											break;
										}
									}
									?>
							</tbody>
						</table>
					</div>
					
					<!--display sort, page, and upload options-->
					<div id="options-menu">
						<div id="add-recipe">
							<button id="add-recipe-button" class="btn btn-success" type="button" onclick="window.location.href='/RecipeFish/view/addRecipeInfo.php'">Add
							<span id="plus-symbol" class="glyphicon glyphicon-plus"></span></button>
						</div>
						
						<div id="page-number">
							<p id="page-number-text">Page</p>
						
							<select id="page-number-field" name="page-number-field" class="form-control" onchange="switchPage(value)">
								<?php 
									for ($i = 1; $i <= $pageCount; $i++)
									{
										if ($pageNumber == $i)
										{
											echo '<option value="' . $i . '" selected="selected">' . $i . '/' . $pageCount . '</option>';
										}
										
										else 
										{
											echo '<option value="' . $i . '">' . $i . '/' . $pageCount . '</option>';
										}
									}
								?>
							</select>
							
							<div id="clear-float">
								<!--clear float from previous content-->
							</div>
						</div>
						
						<div id="sort-recipes">
							<p id="sort-recipes-text">Sort</p>
						
							<select id="sort-recipes-field" name="sort-recipes-field" class="form-control" onchange="sortSelect(value)">
								<option value="alphabetical" <?php if ($sortType == $ALPHABETICAL) { ?> selected='selected' <?php } ?>>Alphabetical</option>
								<option value="newestToOldest" <?php if ($sortType == $NEWEST_TO_OLDEST) { ?> selected='selected' <?php } ?>>Newest to Oldest</option>
								<option value="oldestToNewest" <?php if ($sortType == $OLDEST_TO_NEWEST) { ?> selected='selected' <?php } ?>>Oldest to Newest</option>
								<option value="reverseAlphabetical" <?php if ($sortType == $REVERSE_ALPHABETICAL) { ?> selected='selected' <?php } ?>>Reverse Alphabetical</option>
							</select>
							
							<div id="clear-float2">
								<!--clear float from previous content-->
							</div>
						</div>
						
						<div id="clear-float3">
							<!--clear float from previous content-->
						</div>
					</div>
			<?php
				}
			?>
		</div>
		
		<div id="margin-canvas2">
			<!--right-side coloured border-->
		</div>
		
		<div id="clear-float4">
			<!--clear float from previous content-->
		</div>
		
		<div id="footer">
			<?php 
				include($root . "view/footer.php");
			?>
		</div>
	</body>
</html>
