<?php 
/******************************************************************************************
*******************************************************************************************
** Name: cookbookRecipes.php													   	   ****
** Description: Provides interface for viewing/managing cookbook recipes			   ****
** Author: Rhys Hall																   ****
** Date Created: 06/24/2017 													   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

include($root . "/utilities/cookbookUtilities.php");
include($root . "utilities/database.php");
include($root . "/model/cookbook.php");
include($root . "/model/recipe.php");
include($root . "/model/user.php");

$MAX_DISPLAY_COUNT = 10; /* maximum recipes to display for 1 page */
$MOST_RECENT = 1;
$ALPHABETICAL = 2;
$REVERSE_ALPHABETICAL = 3;
$LEAST_RECENT = 4;
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/cookbookRecipes.css">
		
		<!--stylesheet for tab icon-->
		<link rel="shortcut icon" type="image/ico" href="/RecipeFish/images/standard/fish tab icon.ico"/>
		
		<script type="text/javascript">
			<!--disables parent window until pop-up window closed 
			function parentDisable() 
			{
				if (popUpWindow && !popUpWindow.closed)
				{
					popUpWindow.focus();
				}
			}
			
			<!--confirm deletion of given recipe-->
			function confirmRecipeDelete(id)
			{
				var parameters = "height=200,width=375,left=" + ((screen.width/2)-(375/2)) + ",top=" + ((screen.height/2)-(screen.height/4));
				
				popUpWindow = window.open("confirmCookbookDelete.php?id=" + id, "Confirm Recipe Deletion", parameters);
			}
			
			<!--permanently changes user recipe sort type and reloads page 
			function sortSelect(recipeSortID)
			{
				window.location.href = "/RecipeFish/controller/cookbookSortTypeController.php?sortType=" + recipeSortID;
			}
			
			<!--switches recipe page to selected page number-->
			function switchPage(value)
			{
				var pageNumber = value[0];
				
				window.location.href = "/RecipeFish/controller/cookbookPageController.php?pageNumber=" + pageNumber;
			}
		</script>
	</head>
	
	<body onFocus="parentDisable();" onclick="parentDisable();">	
		<div id="margin-canvas1">
			<!--left-side coloured border-->
		</div>
		
		<div id="container">
			<div id="header">
				<?php 
					include($root . "view/header.php");
				?>
			</div>
		
			<?php 
				include($root . "view/profileHeader.php");
			?>
		
			<div id="title">
				<p>Cookbook</p>
			</div>
			
			<?php
				//get cookbook recipes corresponding to given user ID
				$cookbookRecipes = new Cookbook;
				$recipes = new Recipe;
				$cookbookSelector = new Cookbook;
				$recipeSelector = new Recipe;
				$recipes = array();
				
				$cookbookRecipes = $cookbookSelector->selectByUserID($_SESSION["userID"]);
				$recipeCount = count($cookbookRecipes);
				
				for ($i = 0; $i < $recipeCount; $i++)
				{
					array_push($recipes, $recipeSelector->selectByRecipeID($cookbookRecipes[$i][2]));
					
					$recipes[$i]["date_added"] = $cookbookRecipes[$i][3];
				}
				
				
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
				
				$sortType = $user->getCookbookSortID();
				
				if (($sortType != $MOST_RECENT) && ($sortType != $ALPHABETICAL) && ($sortType != $REVERSE_ALPHABETICAL) && ($sortType != $LEAST_RECENT))
				{
					$sortType = $MOST_RECENT;
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
								<th id="date-added-table-title">Date Added</th>
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
										$splitArray = explode(" ", $recipes[$index]["date_added"]);
										$date = $splitArray[0];
							?>
										<tr>
											<td id="<?php echo 'photo' . $i+1 ?>"><a href="/RecipeFish/view/recipeProfile.php?id=<?php echo $id ?>"><img src="<?php echo $imagePath; ?>"></a></img></td>
											<td id="<?php echo 'name' . $i+1 ?>"><div class="table-name"><a href="/RecipeFish/view/recipeProfile.php?id=<?php echo $id ?>"><?php echo $name ?></a></div></td>
											<td id="<?php echo 'date' . $i+1 ?>"><div class="table-date"><?php echo $date ?></div></td>
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
							<option value="mostRecent" <?php if ($sortType == $MOST_RECENT) { ?> selected='selected' <?php } ?>>Most Recent</option>
							<option value="alphabetical" <?php if ($sortType == $ALPHABETICAL) { ?> selected='selected' <?php } ?>>Alphabetical</option>
							<option value="reverseAlphabetical" <?php if ($sortType == $REVERSE_ALPHABETICAL) { ?> selected='selected' <?php } ?>>Reverse Alphabetical</option>
							<option value="leastRecent" <?php if ($sortType == $LEAST_RECENT) { ?> selected='selected' <?php } ?>>Least Recent</option>
						</select>
						
						<div id="clear-float2">
							<!--clear float from previous content-->
						</div>
					</div>
					
					<div id="clear-float3">
						<!--clear float from previous content-->
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
