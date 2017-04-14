<?php 
/******************************************************************************************
*******************************************************************************************
** Name: addRecipeFeatures.php													       ****
** Description: Provides interface for uploading features for a desired recipe         ****
** Author: Rhys Hall																   ****
** Date Created: 07/06/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";

$ETHNICITY_COUNT = 40;
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/addRecipeFeatures.css">
		
		<!--stylesheet for tab icon-->
		<link rel="shortcut icon" type="image/ico" href="/RecipeFish/images/standard/fish tab icon.ico"/>
		
		<script type="text/javascript">
			<!--deselects all check-boxes for corresponding category IDs except current one-->
			function selectThisOnly(boxId)
			{
				var ETHNICITY_COUNT = 40;
				
				//if check-box category is "ethnicity"
				if (boxId.substring(0, 9) === "ethnicity")
				{
					for (var i = 1; i <= ETHNICITY_COUNT; i++)
					{
						document.getElementById("ethnicity" + i).checked = false;
					}
				
					document.getElementById(boxId).checked = true;
				}
				
				else
				{
					//if check-box category is meal type 
					if (boxId.substring(0, 9) === "meal-type")
					{
						for (var i = 1; i <= 8; i++)
						{
							document.getElementById("meal-type" + i).checked = false;
						}
				
						document.getElementById(boxId).checked = true;
					}
					
					else 
					{
						//if check-box category is holiday type 
						if (boxId.substring(0, 7) === "holiday")
						{
							for (var i = 1; i <= 9; i++)
							{
								document.getElementById("holiday" + i).checked = false;
							}
				
							document.getElementById(boxId).checked = true;
						}
					}	
				}
			}
		</script>
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
				<p>Features</p>
			</div>
			
			<div id="bar">
				<div class="progress">
					<div id="blue-bar" class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100">
						<span class="sr-only">43% Complete</span>
					</div>
				</div>
			</div>
		
			<form id="categories-form" action="/RecipeFish/controller/recipeFeaturesController.php" method="post">
				<div id="categories-box">
					<div id="categories-instructions">
						<p>Check the features from each category that relate to your recipe</p>
					</div>
					
					<?php 
						//add recipe features error messages (if required)
						include($root . "view/recipeFeaturesError.php");
					?>
					
					<div id="ethnicity-categories">
						<div id="ethnicity-step">
							<p>1.</p>
						</div>
						
						<div id="ethnicity-title">
							<p>Ethnicity (Select one)</p>
						</div>
						
						<div id="clear-float1">
							<!--clear float from previous content-->
						</div>
						
						<div id="color-line1">
							<!--color underline for ethnicity category title-->
						</div>
					
						<!--ethnicity category check-box list-->
						<div id="ethnicity-columns">
							<?php 
								$handle = fopen($root . "catalogs/ethnicityFeatures.txt", "r");
								$count = 0;
								
								echo '<div id="ethnicity-column1">';
								
								while (($ethnicity = fgets($handle)) !== false)
								{
							?>
									<input id="ethnicity<?php echo ($count+1) ?>" type="checkbox" name="ethnicity" value="<?php echo $ethnicity ?>" onclick="selectThisOnly(this.id)" 
										<?php if (isset($_SESSION["ethnicity" . $count]) == true) 
											  {
										?> 
												   checked
										<?php 
											  }
											  
											  unset($_SESSION["ethnicity" . ($count+1)]);
										?>
									>
												   
										<p><?php echo $ethnicity?></p>
									</input>
							<?php 
									$count++;
									
									//start new column on multiple of 10 
									if (($count % 10) == 0)
									{
										echo '</div>';
										echo '<div id="ethnicity-column' . (($count/10)+1) . '" class="column">';
									}
								}

								echo '</div>';
							?>
						
							<div id="clear-float2">
								<!--clear float from previous content-->
							</div>
						</div>
					</div>
					
					<div id="meal-type-categories">
						<div id="meal-type-step">
							<p>2.</p>
						</div>
						
						<div id="meal-type-title">
							<p>Meal Type (Select one)</p>
						</div>
						
						<div id="clear-float3">
							<!--clear float from previous content-->
						</div>
						
						<div id="color-line2">
							<!--color underline for type category title-->
						</div>
					
						<!--meal type category check-box list-->
						<div id="meal-type-columns">
							<div id="meal-type-column1">
								<input id="meal-type1" type="checkbox" name="meal-type" value="Alcohol" onclick="selectThisOnly(this.id)" 
									<?php if (isset($_SESSION["meal-type1"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["meal-type1"]);
									?>
								>
										       
									<p>Alcohol</p>
								</input>

								<input id="meal-type2" type="checkbox" name="meal-type" value="Appetizer" onclick="selectThisOnly(this.id)" 
									<?php if (isset($_SESSION["meal-type2"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["meal-type2"]);
									?>
								>
										       
									<p>Appetizer</p>
								</input>
							</div>
				
							<div id="meal-type-column2" class="column">
								<input id="meal-type3" type="checkbox" name="meal-type" value="Beverage" onclick="selectThisOnly(this.id)" 
									<?php if (isset($_SESSION["meal-type3"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["meal-type3"]);
									?>
								>
										       
									<p>Beverage (non-alcoholic)</p>
								</input>

								<input id="meal-type4" type="checkbox" name="meal-type" value="Breakfast" onclick="selectThisOnly(this.id)" 
									<?php if (isset($_SESSION["meal-type4"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["meal-type4"]);
									?>
								>
										       
									<p>Breakfast</p>
								</input>
							</div>
							
							<div id="meal-type-column3" class="column">
								<input id="meal-type5" type="checkbox" name="meal-type" value="Dessert" onclick="selectThisOnly(this.id)" 
									<?php if (isset($_SESSION["meal-type5"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["meal-type5"]);
									?>
								>
										       
									<p>Dessert</p>
								</input>
							
								<input id="meal-type6" type="checkbox" name="meal-type" value="Dinner" onclick="selectThisOnly(this.id)" 
									<?php if (isset($_SESSION["meal-type6"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["meal-type6"]);
									?>
								>
										       
									<p>Dinner</p>
								</input>
							</div>
							
							<div id="meal-type-column4" class="column">
								<input id="meal-type7" type="checkbox" name="meal-type" value="Lunch" onclick="selectThisOnly(this.id)" 
									<?php if (isset($_SESSION["meal-type7"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["meal-type7"]);
									?>
								>
										       
									<p>Lunch</p>
								</input>
							
								<input id="meal-type8" type="checkbox" name="meal-type" value="Snack" onclick="selectThisOnly(this.id)" 
									<?php if (isset($_SESSION["meal-type8"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["meal-type8"]);
									?>
								>
										       
									<p>Snack</p>
								</input>
							</div>
						
							<div id="clear-float4">
								<!--clear float from previous content-->
							</div>
						</div>
					</div>
					
					<div id="popular-type-categories">
						<div id="popular-type-step">
							<p>3.</p>
						</div>
						
						<div id="popular-type-title">
							<p>Popular Food/Drinks (Select any)</p>
						</div>
						
						<div id="clear-float5">
							<!--clear float from previous content-->
						</div>
						
						<div id="color-line3">
							<!--color underline for type category title-->
						</div>
					
						<!--popular ingredients category check-box list-->
						<div id="popular-type-columns">
							<?php 
								$handle = fopen($root . "catalogs/popularIngredients.txt", "r");
								$count = 0;
								
								echo '<div id="popular-type-column1">';
								
								while (($ingredient = fgets($handle)) !== false)
								{
							?>
									<input id="popular-type<?php echo ($count+1) ?>" type="checkbox" name="popular-type[]" value="<?php echo $ingredient ?>" onclick="selectThisOnly(this.id)" 
										<?php if (isset($_SESSION["popular-type" . $count]) == true) 
											  {
										?> 
												   checked
										<?php 
											  }
											  
											  unset($_SESSION["popular-type" . ($count+1)]);
										?>
									>
												   
										<p><?php echo $ingredient?></p>
									</input>
							<?php 
									$count++;
									
									//start new column on multiple of 10 
									if (($count % 19) == 0)
									{
										echo '</div>';
										echo '<div id="popular-type-column' . (($count/19)+1) . '" class="column">';
									}
								}

								echo '</div>';
							?>
						
							<div id="clear-float6">
								<!--clear float from previous content-->
							</div>
						</div>
					</div>
					
					<div id="other-categories">
						<div id="other-step">
							<p>4.</p>
						</div>
						
						<div id="other-title">
							<p>Other Features (Select any)</p>
						</div>
						
						<div id="clear-float7">
							<!--clear float from previous content-->
						</div>
						
						<div id="color-line4">
							<!--color underline for type category title-->
						</div>
					
						<!--other category check-box list-->
						<div id="other-columns">
							<div id="other-column1">
								<input id="other1" type="checkbox" name="other[]" value="BBQ & Grilling"
									<?php if (isset($_SESSION["other1"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other1"]);
									?>
								>
										       
									<p>BBQ & Grilling</p>
								</input>
								
								<input id="other2" type="checkbox" name="other[]" value="Deep Fryer"
									<?php if (isset($_SESSION["other2"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other2"]);
									?>
								>
										       
									<p>Deep Fryer</p>
								</input>
								
								<input id="other3" type="checkbox" name="other[]" value="Fine Dining"
									<?php if (isset($_SESSION["other3"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other3"]);
									?>
								>
										       
									<p>Fine Dining</p>
								</input>
								
								<input id="other4" type="checkbox" name="other[]" value="Frozen"
									<?php if (isset($_SESSION["other4"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other4"]);
									?>
								>
										       
									<p>Frozen</p>
								</input>
							</div>
				
							<div id="other-column2" class="column">
								<input id="other5" type="checkbox" name="other[]" value="Gluten-free"
									<?php if (isset($_SESSION["other5"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other5"]);
									?>
								>
										       
									<p>Gluten-free</p>
								</input>
							
								<input id="other6" type="checkbox" name="other[]" value="Healthy"
									<?php if (isset($_SESSION["other6"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other6"]);
									?>
								>
										       
									<p>Healthy</p>
								</input>
								
								<input id="other7" type="checkbox" name="other[]" value="Main Dish"
									<?php if (isset($_SESSION["other7"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other7"]);
									?>
								>
										       
									<p>Main Dish</p>
								</input>
								
								<input id="other8" type="checkbox" name="other[]" value="Oven-baked"
									<?php if (isset($_SESSION["other8"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other8"]);
									?>
								>
										       
									<p>Oven-baked</p>
								</input>
							</div>
							
							<div id="other-column3" class="column">
								<input id="other9" type="checkbox" name="other[]" value="Quick & Easy"
									<?php if (isset($_SESSION["other9"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other9"]);
									?>
								>
										       
									<p>Quick & Easy</p>
								</input>
								
								<input id="other10" type="checkbox" name="other[]" value="Side Dish"
									<?php if (isset($_SESSION["other10"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other10"]);
									?>
								>
										       
									<p>Side Dish</p>
								</input>

								<input id="other11" type="checkbox" name="other[]" value="Slow Cooker"
									<?php if (isset($_SESSION["other11"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other11"]);
									?>
								>
										       
									<p>Slow Cooker</p>
								</input>
							</div>
							
							<div id="other-column4" class="column">
								<input id="other12" type="checkbox" name="other[]" value="Stove-top"
									<?php if (isset($_SESSION["other12"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other12"]);
									?>
								>
										       
									<p>Stove-top</p>
								</input>
							
								<input id="other13" type="checkbox" name="other[]" value="Vegan"
									<?php if (isset($_SESSION["other13"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other13"]);
									?>
								>
										       
									<p>Vegan</p>
								</input>
								
								<input id="other14" type="checkbox" name="other[]" value="Vegetarian"
									<?php if (isset($_SESSION["other14"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other14"]);
									?>
								>
										       
									<p>Vegetarian</p>
								</input>
							</div>
						
							<div id="clear-float8">
								<!--clear float from previous content-->
							</div>
						</div>
					</div>
					
					<div id="holiday-categories">
						<div id="holiday-step">
							<p>5.</p>
						</div>
						
						<div id="holiday-title">
							<p>Holidays (Select one)</p>
						</div>
						
						<div id="clear-float9">
							<!--clear float from previous content-->
						</div>
						
						<div id="color-line5">
							<!--color underline for type category title-->
						</div>
					
						<!--holiday category check-box list-->
						<div id="holiday-columns">
							<div id="holiday-column1">
								<input id="holiday1" type="checkbox" name="holiday" value="None" onclick="selectThisOnly(this.id)" 
									<?php if (isset($_SESSION["holiday1"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["holiday1"]);
									?>
								>
										       
									<p>None</p>
								</input>
							
								<input id="holiday2" type="checkbox" name="holiday" value="Christmas" onclick="selectThisOnly(this.id)" 
									<?php if (isset($_SESSION["holiday2"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["holiday2"]);
									?>
								>
										       
									<p>Christmas</p>
								</input>
								
								<input id="holiday3" type="checkbox" name="holiday" value="Easter" onclick="selectThisOnly(this.id)" 
									<?php if (isset($_SESSION["holiday3"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["holiday3"]);
									?>
								>
										       
									<p>Easter</p>
								</input>
							</div>
				
							<div id="holiday-column2" class="column">
								<input id="holiday4" type="checkbox" name="holiday" value="Halloween" onclick="selectThisOnly(this.id)" 
									<?php if (isset($_SESSION["holiday4"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["holiday4"]);
									?>
								>
										       
									<p>Halloween</p>
								</input>
								
								<input id="holiday5" type="checkbox" name="holiday" value="New Year" onclick="selectThisOnly(this.id)" 
									<?php if (isset($_SESSION["holiday5"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["holiday5"]);
									?>
								>
										       
									<p>New Year</p>
								</input>
							</div>
							
							<div id="holiday-column3" class="column">
								<input id="holiday6" type="checkbox" name="holiday" value="Oktoberfest" onclick="selectThisOnly(this.id)" 
									<?php if (isset($_SESSION["holiday6"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["holiday6"]);
									?>
								>
										       
									<p>Oktoberfest</p>
								</input>
							
								<input id="holiday7" type="checkbox" name="holiday" value="Saint Patrick's Day" onclick="selectThisOnly(this.id)" 
									<?php if (isset($_SESSION["holiday7"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["holiday7"]);
									?>
								>
										       
									<p>Saint Patrick's Day</p>
								</input>
							</div>
							
							<div id="holiday-column4">
								<input id="holiday8" type="checkbox" name="holiday" value="Thanksgiving" onclick="selectThisOnly(this.id)" 
									<?php if (isset($_SESSION["holiday8"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["holiday8"]);
									?>
								>
										       
									<p>Thanksgiving</p>
								</input>
								
								<input id="holiday9" type="checkbox" name="holiday" value="Valentine's Day" onclick="selectThisOnly(this.id)" 
									<?php if (isset($_SESSION["holiday9"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["holiday9"]);
									?>
								>
										       
									<p>Valentine's Day</p>
								</input>
							</div>
						
							<div id="clear-float10">
								<!--clear float from previous content-->
							</div>
						</div>
					</div>
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
