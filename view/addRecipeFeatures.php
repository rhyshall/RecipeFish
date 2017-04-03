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
					
						<!--popular food/drink type category check-box list-->
						<div id="popular-type-columns">
							<div id="popular-type-column1">
								<input id="popular-type1" type="checkbox" name="popular-type[]" value="Apples"
									<?php if (isset($_SESSION["popular-type1"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type1"]);
									?>
								>
										       
									<p>Apples</p>
								</input>
								
								<input id="popular-type2" type="checkbox" name="popular-type[]" value="Bacon"
									<?php if (isset($_SESSION["popular-type2"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type2"]);
									?>
								>
										       
									<p>Bacon</p>
								</input>
								
								<input id="popular-type3" type="checkbox" name="popular-type[]" value="Bananas"
									<?php if (isset($_SESSION["popular-type3"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type3"]);
									?>
								>
										       
									<p>Bananas</p>
								</input>
								
								<input id="popular-type4" type="checkbox" name="popular-type[]" value="Beans"
									<?php if (isset($_SESSION["popular-type4"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type4"]);
									?>
								>
										       
									<p>Beans</p>
								</input>
								
								<input id="popular-type5" type="checkbox" name="popular-type[]" value="Beef"
									<?php if (isset($_SESSION["popular-type5"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type5"]);
									?>
								>
										       
									<p>Beef</p>
								</input>
								
								<input id="popular-type6" type="checkbox" name="popular-type[]" value="Beer"
									<?php if (isset($_SESSION["popular-type6"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type6"]);
									?>
								>
										       
									<p>Beer</p>
								</input>
								
								<input id="popular-type7" type="checkbox" name="popular-type[]" value="Berries"
									<?php if (isset($_SESSION["popular-type7"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type7"]);
									?>
								>
										       
									<p>Berries</p>
								</input>
								
								<input id="popular-type8" type="checkbox" name="popular-type[]" value="Bread"
									<?php if (isset($_SESSION["popular-type8"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type8"]);
									?>
								>
										       
									<p>Bread</p>
								</input>
								
								<input id="popular-type9" type="checkbox" name="popular-type[]" value="Broccoli"
									<?php if (isset($_SESSION["popular-type9"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type9"]);
									?>
								>
										       
									<p>Broccoli</p>
								</input>
								
								<input id="popular-type10" type="checkbox" name="popular-type[]" value="Cabbage"
									<?php if (isset($_SESSION["popular-type10"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type10"]);
									?>
								>
										       
									<p>Cabbage</p>
								</input>
								
								<input id="popular-type11" type="checkbox" name="popular-type[]" value="Cake"
									<?php if (isset($_SESSION["popular-type11"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type11"]);
									?>
								>
										       
									<p>Cake</p>
								</input>
								
								<input id="popular-type12" type="checkbox" name="popular-type[]" value="Carrots"
									<?php if (isset($_SESSION["popular-type12"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type12"]);
									?>
								>
										       
									<p>Carrots</p>
								</input>
								
								<input id="popular-type13" type="checkbox" name="popular-type[]" value="Cauliflower"
									<?php if (isset($_SESSION["popular-type13"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type13"]);
									?>
								>
										       
									<p>Cauliflower</p>
								</input>
								
								<input id="popular-type14" type="checkbox" name="popular-type[]" value="Cheese"
									<?php if (isset($_SESSION["popular-type14"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type14"]);
									?>
								>
										       
									<p>Cheese</p>
								</input>
								
								<input id="popular-type15" type="checkbox" name="popular-type[]" value="Chicken"
									<?php if (isset($_SESSION["popular-type15"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type15"]);
									?>
								>
										       
									<p>Chicken</p>
								</input>
								
								<input id="popular-type16" type="checkbox" name="popular-type[]" value="Chips"
									<?php if (isset($_SESSION["popular-type16"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type16"]);
									?>
								>
										       
									<p>Chips</p>
								</input>
								
								<input id="popular-type17" type="checkbox" name="popular-type[]" value="Chocolate"
									<?php if (isset($_SESSION["popular-type17"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type17"]);
									?>
								>
										       
									<p>Chocolate</p>
								</input>
							
								<input id="popular-type18" type="checkbox" name="popular-type[]" value="Citrus fruits"
									<?php if (isset($_SESSION["popular-type18"]) == true) 
										  {
									?> 
											   checked
									<?php 
										  }
											  
										  unset($_SESSION["popular-type18"]);
									?>
								>
												   
									<p>Citrus fruits</p>
								</input>
							</div>
				
							<div id="popular-type-column2" class="column">
								<input id="popular-type19" type="checkbox" name="popular-type[]" value="Cocktail"
									<?php if (isset($_SESSION["popular-type19"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type19"]);
									?>
								>
										       
									<p>Cocktail</p>
								</input>
								
								<input id="popular-type20" type="checkbox" name="popular-type[]" value="Coconut"
									<?php if (isset($_SESSION["popular-type20"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type20"]);
									?>
								>
										       
									<p>Coconut</p>
								</input>
								
								<input id="popular-type21" type="checkbox" name="popular-type[]" value="Coffee"
									<?php if (isset($_SESSION["popular-type21"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type21"]);
									?>
								>
										       
									<p>Coffee</p>
								</input>
								
								<input id="popular-type22" type="checkbox" name="popular-type[]" value="Cookies"
									<?php if (isset($_SESSION["popular-type22"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type22"]);
									?>
								>
										       
									<p>Cookies</p>
								</input>
								
								<input id="popular-type23" type="checkbox" name="popular-type[]" value="Corn"
									<?php if (isset($_SESSION["popular-type23"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type23"]);
									?>
								>
										       
									<p>Corn</p>
								</input>
								
								<input id="popular-type24" type="checkbox" name="popular-type[]" value="Crackers"
									<?php if (isset($_SESSION["popular-type24"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type24"]);
									?>
								>
										       
									<p>Crackers</p>
								</input>
								
								<input id="popular-type25" type="checkbox" name="popular-type[]" value="Cream"
									<?php if (isset($_SESSION["popular-type25"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type25"]);
									?>
								>
										       
									<p>Cream</p>
								</input>
								
								<input id="popular-type26" type="checkbox" name="popular-type[]" value="Cucumbers"
									<?php if (isset($_SESSION["popular-type26"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type26"]);
									?>
								>
										       
									<p>Cucumbers</p>
								</input>
								
								<input id="popular-type27" type="checkbox" name="popular-type[]" value="Dip"
									<?php if (isset($_SESSION["popular-type27"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type27"]);
									?>
								>
										       
									<p>Dip</p>
								</input>
								
								<input id="popular-type28" type="checkbox" name="popular-type[]" value="Doughnuts"
									<?php if (isset($_SESSION["popular-type28"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type28"]);
									?>
								>
										       
									<p>Doughnuts</p>
								</input>
								
								<input id="popular-type29" type="checkbox" name="popular-type[]" value="Eggs"
									<?php if (isset($_SESSION["popular-type29"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type29"]);
									?>
								>
										       
									<p>Eggs</p>
								</input>
								
								<input id="popular-type30" type="checkbox" name="popular-type[]" value="Garlic"
									<?php if (isset($_SESSION["popular-type30"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type30"]);
									?>
								>
										       
									<p>Garlic</p>
								</input>
								
								<input id="popular-type31" type="checkbox" name="popular-type[]" value="Gin"
									<?php if (isset($_SESSION["popular-type31"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type31"]);
									?>
								>
										       
									<p>Gin</p>
								</input>
								
								<input id="popular-type32" type="checkbox" name="popular-type[]" value="Grapes"
									<?php if (isset($_SESSION["popular-type32"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type32"]);
									?>
								>
										       
									<p>Grapes</p>
								</input>
								
								<input id="popular-type33" type="checkbox" name="popular-type[]" value="Ice"
									<?php if (isset($_SESSION["popular-type33"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type33"]);
									?>
								>
										       
									<p>Ice</p>
								</input>
								
								<input id="popular-type34" type="checkbox" name="popular-type[]" value="Juice"
									<?php if (isset($_SESSION["popular-type34"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type34"]);
									?>
								>
										       
									<p>Juice</p>
								</input>
								
								<input id="popular-type35" type="checkbox" name="popular-type[]" value="Lamb"
									<?php if (isset($_SESSION["popular-type35"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type35"]);
									?>
								>
										       
									<p>Lamb</p>
								</input>
								
								<input id="popular-type36" type="checkbox" name="popular-type[]" value="Liqueur"
									<?php if (isset($_SESSION["popular-type36"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type36"]);
									?>
								>
										       
									<p>Liqueur (sweet liquor)</p>
								</input>
							</div>
							
							<div id="popular-type-column3" class="column">
								<input id="popular-type37" type="checkbox" name="popular-type[]" value="Melons"
									<?php if (isset($_SESSION["popular-type37"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type37"]);
									?>
								>
										       
									<p>Melons</p>
								</input>
								
								<input id="popular-type38" type="checkbox" name="popular-type[]" value="Milk"
									<?php if (isset($_SESSION["popular-type38"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type38"]);
									?>
								>
										       
									<p>Milk</p>
								</input>
								
								<input id="popular-type39" type="checkbox" name="popular-type[]" value="Muffins"
									<?php if (isset($_SESSION["popular-type39"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type39"]);
									?>
								>
										       
									<p>Muffins</p>
								</input>
								
								<input id="popular-type40" type="checkbox" name="popular-type[]" value="Nuts"
									<?php if (isset($_SESSION["popular-type40"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type40"]);
									?>
								>
										       
									<p>Nuts</p>
								</input>
								
								<input id="popular-type41" type="checkbox" name="popular-type[]" value="Onions"
									<?php if (isset($_SESSION["popular-type41"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type41"]);
									?>
								>
										       
									<p>Onions</p>
								</input>
								
								<input id="popular-type42" type="checkbox" name="popular-type[]" value="Pasta"
									<?php if (isset($_SESSION["popular-type42"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type42"]);
									?>
								>
										       
									<p>Pasta</p>
								</input>
								
								<input id="popular-type43" type="checkbox" name="popular-type[]" value="Pastries"
									<?php if (isset($_SESSION["popular-type43"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type43"]);
									?>
								>
										       
									<p>Pastries</p>
								</input>
								
								<input id="popular-type44" type="checkbox" name="popular-type[]" value="Peaches"
									<?php if (isset($_SESSION["popular-type44"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type44"]);
									?>
								>
										       
									<p>Peaches</p>
								</input>
								
								<input id="popular-type45" type="checkbox" name="popular-type[]" value="Pears"
									<?php if (isset($_SESSION["popular-type45"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type45"]);
									?>
								>
										       
									<p>Pears</p>
								</input>
								
								<input id="popular-type46" type="checkbox" name="popular-type[]" value="Peas"
									<?php if (isset($_SESSION["popular-type46"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type46"]);
									?>
								>
										       
									<p>Peas</p>
								</input>
								
								<input id="popular-type47" type="checkbox" name="popular-type[]" value="Peppers"
									<?php if (isset($_SESSION["popular-type47"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type47"]);
									?>
								>
										       
									<p>Peppers</p>
								</input>
								
								<input id="popular-type48" type="checkbox" name="popular-type[]" value="Pies"
									<?php if (isset($_SESSION["popular-type48"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type48"]);
									?>
								>
										       
									<p>Pies</p>
								</input>
								
								<input id="popular-type49" type="checkbox" name="popular-type[]" value="Pineapple"
									<?php if (isset($_SESSION["popular-type49"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type49"]);
									?>
								>
										       
									<p>Pineapple</p>
								</input>
								
								<input id="popular-type50" type="checkbox" name="popular-type[]" value="Pop"
									<?php if (isset($_SESSION["popular-type50"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type50"]);
									?>
								>
										       
									<p>Pop</p>
								</input>
								
								<input id="popular-type51" type="checkbox" name="popular-type[]" value="Pork"
									<?php if (isset($_SESSION["popular-type51"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type51"]);
									?>
								>
										       
									<p>Pork</p>
								</input>
								
								<input id="popular-type52" type="checkbox" name="popular-type[]" value="Potatoes"
									<?php if (isset($_SESSION["popular-type52"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type52"]);
									?>
								>
										       
									<p>Potatoes</p>
								</input>
								
								<input id="popular-type53" type="checkbox" name="popular-type[]" value="Pudding"
									<?php if (isset($_SESSION["popular-type53"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type53"]);
									?>
								>
										       
									<p>Pudding</p>
								</input>
								
								<input id="popular-type54" type="checkbox" name="popular-type[]" value="Rice"
									<?php if (isset($_SESSION["popular-type54"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type54"]);
									?>
								>
										       
									<p>Rice</p>
								</input>
							</div>
							
							<div id="popular-type-column4">
								<input id="popular-type55" type="checkbox" name="popular-type[]" value="Rum"
									<?php if (isset($_SESSION["popular-type55"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type55"]);
									?>
								>
										       
									<p>Rum</p>
								</input>
							
								<input id="popular-type56" type="checkbox" name="popular-type[]" value="Salad"
									<?php if (isset($_SESSION["popular-type56"]) == true) 
										  {
									?> 
											   checked
									<?php 
										  }
											  
										  unset($_SESSION["popular-type56"]);
									?>
								>
										       
									<p>Salad</p>
								</input>
							
								<input id="popular-type57" type="checkbox" name="popular-type[]" value="Sandwiches"
									<?php if (isset($_SESSION["popular-type57"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type57"]);
									?>
								>
										       
									<p>Sandwiches</p>
								</input>
								
								<input id="popular-type58" type="checkbox" name="popular-type[]" value="Sauce"
									<?php if (isset($_SESSION["popular-type58"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type58"]);
									?>
								>
										       
									<p>Sauce</p>
								</input>
								
								<input id="popular-type59" type="checkbox" name="popular-type[]" value="Sausage"
									<?php if (isset($_SESSION["popular-type59"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type59"]);
									?>
								>
										       
									<p>Sausage</p>
								</input>
								
								<input id="popular-type60" type="checkbox" name="popular-type[]" value="Seafood"
									<?php if (isset($_SESSION["popular-type60"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type60"]);
									?>
								>
										       
									<p>Seafood</p>
								</input>
								
								<input id="popular-type61" type="checkbox" name="popular-type[]" value="Shake"
									<?php if (isset($_SESSION["popular-type61"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type61"]);
									?>
								>
										       
									<p>Shake</p>
								</input>
								
								<input id="popular-type62" type="checkbox" name="popular-type[]" value="Smoothie"
									<?php if (isset($_SESSION["popular-type62"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type62"]);
									?>
								>
										       
									<p>Smoothie</p>
								</input>
								
								<input id="popular-type63" type="checkbox" name="popular-type[]" value="Soup"
									<?php if (isset($_SESSION["popular-type63"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type63"]);
									?>
								>
										       
									<p>Soup</p>
								</input>
								
								<input id="popular-type64" type="checkbox" name="popular-type[]" value="Tea"
									<?php if (isset($_SESSION["popular-type64"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type64"]);
									?>
								>
										       
									<p>Tea</p>
								</input>
								
								<input id="popular-type65" type="checkbox" name="popular-type[]" value="Tequila"
									<?php if (isset($_SESSION["popular-type65"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type65"]);
									?>
								>
										       
									<p>Tequila</p>
								</input>
								
								<input id="popular-type66" type="checkbox" name="popular-type[]" value="Tofu"
									<?php if (isset($_SESSION["popular-type66"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type66"]);
									?>
								>
										       
									<p>Tofu</p>
								</input>
								
								<input id="popular-type67" type="checkbox" name="popular-type[]" value="Tomatoes"
									<?php if (isset($_SESSION["popular-type67"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type67"]);
									?>
								>
										       
									<p>Tomatoes</p>
								</input>
								
								<input id="popular-type68" type="checkbox" name="popular-type[]" value="Turkey"
									<?php if (isset($_SESSION["popular-type68"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type68"]);
									?>
								>
										       
									<p>Turkey</p>
								</input>
								
								<input id="popular-type69" type="checkbox" name="popular-type[]" value="Vodka"
									<?php if (isset($_SESSION["popular-type69"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type69"]);
									?>
								>
										       
									<p>Vodka</p>
								</input>
								
								<input id="popular-type70" type="checkbox" name="popular-type[]" value="Whisky"
									<?php if (isset($_SESSION["popular-type70"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type70"]);
									?>
								>
										       
									<p>Whisky</p>
								</input>
								
								<input id="popular-type71" type="checkbox" name="popular-type[]" value="Wine"
									<?php if (isset($_SESSION["popular-type71"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type71"]);
									?>
								>
										       
									<p>Wine</p>
								</input>
								
								<input id="popular-type72" type="checkbox" name="popular-type[]" value="Yogurt"
									<?php if (isset($_SESSION["popular-type72"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["popular-type72"]);
									?>
								>
										       
									<p>Yogurt</p>
								</input>
							</div>
						
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
								
								<input id="other2" type="checkbox" name="other[]" value="Fine Dining"
									<?php if (isset($_SESSION["other2"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other2"]);
									?>
								>
										       
									<p>Fine Dining</p>
								</input>
								
								<input id="other3" type="checkbox" name="other[]" value="Frozen"
									<?php if (isset($_SESSION["other3"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other3"]);
									?>
								>
										       
									<p>Frozen</p>
								</input>
								
								<input id="other4" type="checkbox" name="other[]" value="Gluten-free"
									<?php if (isset($_SESSION["other4"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other4"]);
									?>
								>
										       
									<p>Gluten-free</p>
								</input>
							</div>
				
							<div id="other-column2" class="column">
								<input id="other5" type="checkbox" name="other[]" value="Healthy"
									<?php if (isset($_SESSION["other5"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other5"]);
									?>
								>
										       
									<p>Healthy</p>
								</input>
								
								<input id="other6" type="checkbox" name="other[]" value="Main Dish"
									<?php if (isset($_SESSION["other6"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other6"]);
									?>
								>
										       
									<p>Main Dish</p>
								</input>
								
								<input id="other7" type="checkbox" name="other[]" value="Oven-baked"
									<?php if (isset($_SESSION["other7"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other7"]);
									?>
								>
										       
									<p>Oven-baked</p>
								</input>
							</div>
							
							<div id="other-column3" class="column">
								<input id="other8" type="checkbox" name="other[]" value="Quick & Easy"
									<?php if (isset($_SESSION["other8"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other8"]);
									?>
								>
										       
									<p>Quick & Easy</p>
								</input>
								
								<input id="other9" type="checkbox" name="other[]" value="Side Dish"
									<?php if (isset($_SESSION["other9"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other9"]);
									?>
								>
										       
									<p>Side Dish</p>
								</input>

								<input id="other10" type="checkbox" name="other[]" value="Slow Cooker"
									<?php if (isset($_SESSION["other10"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other10"]);
									?>
								>
										       
									<p>Slow Cooker</p>
								</input>
							</div>
							
							<div id="other-column4" class="column">
								<input id="other11" type="checkbox" name="other[]" value="Stove-top"
									<?php if (isset($_SESSION["other11"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other11"]);
									?>
								>
										       
									<p>Stove-top</p>
								</input>
							
								<input id="other12" type="checkbox" name="other[]" value="Vegan"
									<?php if (isset($_SESSION["other12"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other12"]);
									?>
								>
										       
									<p>Vegan</p>
								</input>
								
								<input id="other13" type="checkbox" name="other[]" value="Vegetarian"
									<?php if (isset($_SESSION["other13"]) == true) 
									      {
									?> 
										       checked
									<?php 
										  }
										  
										  unset($_SESSION["other13"]);
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
