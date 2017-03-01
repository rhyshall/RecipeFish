<?php 
/******************************************************************************************
*******************************************************************************************
** Name: addRecipeInfo.php													   		   ****
** Description: Provides interface for uploading header info for a desired recipe      ****
** Author: Rhys Hall																   ****
** Date Created: 05/24/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeMingle/";
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeMingle/stylesheets/addRecipeInfo.css">
		
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
				<p>Add Your Recipe</p>
			</div>
		
			<div id="sub-title">
				<p>Getting Started...</p>
			</div>
			
			<?php 
				//add recipe info error messages (if required)
				include($root . "view/recipeInfoError.php");
			?>
			
			<div id="bar">
				<div class="progress">
					<div id="blue-bar" class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
						<span class="sr-only">20% Complete</span>
					</div>
				</div>
			</div>
		
			<form id="brief-form" action="/RecipeMingle/controller/recipeInfoController.php" method="post" enctype="multipart/form-data">
				<div id="colour-background">
					<div id="side1">
						<div id="step1">
							<p>1</p>
						</div>
				
						<?php
							//if recipe name input previously filled
							if (isset($_SESSION["recipeNameField"]) == true)
							{
						?>		<!--set recipe name field as previous value-->
								<div id="recipe-name">
									<p>Recipe Name</p>
						
									<input id="recipe-name-field" name="recipe-name" type="text" class="form-control" value="<?php echo $_SESSION["recipeNameField"] ?>"></input>
								</div>
							<?php 
								unset($_SESSION["recipeNameField"]);
							}
				
							else 
							{
							?>	<!--insert recipe name placeholder-->
								<div id="recipe-name">
									<p>Recipe Name</p>
						
									<input id="recipe-name-field" name="recipe-name" type="text" class="form-control"></input>
								</div>
						<?php
							}
						?>
					
						<?php
							//if recipe name input previously filled
							if (isset($_SESSION["descriptionField"]) == true)
							{
						?>		<!--set recipe name field as previous value-->
								<div id="description">
									<p>Description</p>
						
									<textarea id="description-field" name="description" type="text" class="form-control"><?php echo $_SESSION["descriptionField"] ?></textarea>
								</div>
							<?php 
								unset($_SESSION["descriptionField"]);
							}
				
							else 
							{
							?>	<!--insert recipe name placeholder-->
								<div id="description">
									<p>Description</p>
						
									<textarea id="description-field" name="description" type="text" class="form-control"></textarea>
								</div>
						<?php
							}
						?>
					</div>
			
					<div id="side2">
						<div id="step2">
							<p>2</p>
						</div>
				
						<div id="preparation-time">
							<p>Prep Time</p>
			
							<?php
								//if prep hours input previously filled
								if (isset($_SESSION["prepHoursField"]) == true)
								{
							?>	
									<!--set to previous value-->
									<div id="prep-hours">
										<select id="prep-hours-field" name="prep-hours" class="form-control">
											<?php 
												for ($i = 0; $i < 24; $i++)
												{
													echo "<option value='" . $i . "'";
													
													if ($_SESSION["prepHoursField"] == $i)
													{
														echo " selected='selected'";
													}
													
													echo ">" . $i . "</option>";
												}
											?>
						
											<option value=">24">24+</option>
										</select>
					
										<p>Hour(s)</p>
									</div>
									
								<?php 
									unset($_SESSION["prepHoursField"]);
								}
							
								else 
								{
								?>
									<!--set empty value-->
									<div id="prep-hours">
										<select id="prep-hours-field" name="prep-hours" class="form-control">
											<?php 
												echo "<option value=''</option>";
									
												for ($i = 0; $i < 24; $i++)
												{
													echo "<option value='" . $i . "'>" . $i . "</option>";
												}
											?>
						
											<option value=">24">24+</option>
										</select>
					
										<p>Hour(s)</p>
									</div>
							<?php 
								}
							?>
							
							<?php
								//if prep minutes input previously filled
								if (isset($_SESSION["prepMinutesField"]) == true)
								{
							?>	
									<!--set to previous value-->
									<div id="prep-minutes">
										<select id="prep-minutes-field" name="prep-minutes" class="form-control">
											<?php 
												for ($i = 0; $i < 60; $i++)
												{
													echo "<option value='" . $i . "'";
													
													if ($_SESSION["prepMinutesField"] == $i)
													{
														echo " selected='selected'";
													}
													
													echo ">" . $i . "</option>";
												}
											?>
										</select>
					
										<p>Minute(s)</p>
									</div>
									
								<?php 
									unset($_SESSION["prepMinutesField"]);
								}
							
								else 
								{
								?>
									<!--set empty value-->
									<div id="prep-minutes">
										<select id="prep-minutes-field" name="prep-minutes" class="form-control">
											<?php 
												echo "<option value=''</option>";
									
												for ($i = 0; $i < 60; $i++)
												{
													echo "<option value='" . $i . "'>" . $i . "</option>";
												}
											?>
										</select>
					
										<p>Minute(s)</p>
									</div>
							<?php 
								}
							?>
						</div>
				
						<div id="clear-float1">
							<!--clear float from previous content-->
						</div>
			
						<div id="cooking-time">
							<p>Cook Time</p>
			
							<?php
								//if cook hours input previously filled
								if (isset($_SESSION["cookHoursField"]) == true)
								{
							?>	
									<!--set to previous value-->
									<div id="cook-hours">
										<select id="cook-hours-field" name="cook-hours" class="form-control">
											<?php 
												for ($i = 0; $i < 24; $i++)
												{
													echo "<option value='" . $i . "'";
													
													if ($_SESSION["cookHoursField"] == $i)
													{
														echo " selected='selected'";
													}
													
													echo ">" . $i . "</option>";
												}
											?>
						
											<option value=">24">24+</option>
										</select>
					
										<p>Hour(s)</p>
									</div>
									
								<?php 
									unset($_SESSION["cookHoursField"]);
								}
							
								else 
								{
								?>
									<!--set empty value-->
									<div id="cook-hours">
										<select id="cook-hours-field" name="cook-hours" class="form-control">
											<?php 
												echo "<option value=''</option>";
									
												for ($i = 0; $i < 24; $i++)
												{
													echo "<option value='" . $i . "'>" . $i . "</option>";
												}
											?>
						
											<option value=">24">24+</option>
										</select>
					
										<p>Hour(s)</p>
									</div>
							<?php 
								}
							?>
							
							<?php
								//if cook minutes input previously filled
								if (isset($_SESSION["cookMinutesField"]) == true)
								{
							?>	
									<!--set to previous value-->
									<div id="cook-minutes">
										<select id="cook-minutes-field" name="cook-minutes" class="form-control">
											<?php 
												for ($i = 0; $i < 60; $i++)
												{
													echo "<option value='" . $i . "'";
													
													if ($_SESSION["cookMinutesField"] == $i)
													{
														echo " selected='selected'";
													}
													
													echo ">" . $i . "</option>";
												}
											?>
										</select>
					
										<p>Minute(s)</p>
									</div>
									
								<?php 
									unset($_SESSION["cookMinutesField"]);
								}
							
								else 
								{
								?>
									<!--set empty value-->
									<div id="cook-minutes">
										<select id="cook-minutes-field" name="cook-minutes" class="form-control">
											<?php 
												echo "<option value=''</option>";
									
												for ($i = 0; $i < 60; $i++)
												{
													echo "<option value='" . $i . "'>" . $i . "</option>";
												}
											?>
										</select>
					
										<p>Minute(s)</p>
									</div>
							<?php 
								}
							?>
						</div>
				
						<div id="clear-float2">
							<!--clear float from previous content-->
						</div>
				
						<div id="wait-time">
							<p>Wait Time</p>
			
							<?php
								//if wait hours input previously filled
								if (isset($_SESSION["waitHoursField"]) == true)
								{
							?>	
									<!--set to previous value-->
									<div id="wait-hours">
										<select id="wait-hours-field" name="wait-hours" class="form-control">
											<?php 
												for ($i = 0; $i < 24; $i++)
												{
													echo "<option value='" . $i . "'";
													
													if ($_SESSION["waitHoursField"] == $i)
													{
														echo " selected='selected'";
													}
													
													echo ">" . $i . "</option>";
												}
											?>
						
											<option value=">24">24+</option>
										</select>
					
										<p>Hour(s)</p>
									</div>
									
								<?php 
									unset($_SESSION["waitHoursField"]);
								}
							
								else 
								{
								?>
									<!--set empty value-->
									<div id="wait-hours">
										<select id="wait-hours-field" name="wait-hours" class="form-control">
											<?php 
												echo "<option value=''</option>";
									
												for ($i = 0; $i < 24; $i++)
												{
													echo "<option value='" . $i . "'>" . $i . "</option>";
												}
											?>
						
											<option value=">24">24+</option>
										</select>
					
										<p>Hour(s)</p>
									</div>
							<?php 
								}
							?>
							
							<?php
								//if wait minutes input previously filled
								if (isset($_SESSION["waitMinutesField"]) == true)
								{
							?>	
									<!--set to previous value-->
									<div id="wait-minutes">
										<select id="wait-minutes-field" name="wait-minutes" class="form-control">
											<?php 
												for ($i = 0; $i < 60; $i++)
												{
													echo "<option value='" . $i . "'";
													
													if ($_SESSION["waitMinutesField"] == $i)
													{
														echo " selected='selected'";
													}
													
													echo ">" . $i . "</option>";
												}
											?>
										</select>
					
										<p>Minute(s)</p>
									</div>
									
								<?php 
									unset($_SESSION["waitMinutesField"]);
								}
							
								else 
								{
								?>
									<!--set empty value-->
									<div id="wait-minutes">
										<select id="wait-minutes-field" name="wait-minutes" class="form-control">
											<?php 
												echo "<option value=''</option>";
									
												for ($i = 0; $i < 60; $i++)
												{
													echo "<option value='" . $i . "'>" . $i . "</option>";
												}
											?>
										</select>
					
										<p>Minute(s)</p>
									</div>
							<?php 
								}
							?>
						</div>
				
						<div id="clear-float3">
							<!--clear float from previous content-->
						</div>
				
						<div id="servings">
							<p>Servings</p>
							
							<?php
								//if servings input previously filled
								if (isset($_SESSION["servingsField"]) == true)
								{
							?>	
									<!--set to previous value-->
									<select id="servings-field" name="servings" class="form-control">
										<?php 
											for ($i = 1; $i < 50; $i++)
											{
												echo "<option value='" . $i . "'";
													
												if ($_SESSION["servingsField"] == $i)
												{
													echo " selected='selected'";
												}
													
												echo ">" . $i . "</option>";
											}
										?>
						
										<option value="50+">50+</option>
									</select>
									
								<?php 
									unset($_SESSION["servingsField"]);
								}
							
								else 
								{
								?>
									<!--set empty value-->
									<select id="servings-field" name="servings" class="form-control">
										<?php 
											echo "<option value=''</option>";
									
											for ($i = 1; $i < 50; $i++)
											{
												echo "<option value='" . $i . "'>" . $i . "</option>";
											}
										?>
						
										<option value="50+">50+</option>
									</select>
							<?php 
								}
							?>
						</div>
					</div>
				
					<div id="side3">
						<div id="step3">
							<p>3</p>
						</div>
				
						<?php
							//if recipe image input previously filled
							if (isset($_SESSION["imageField"]) == true)
							{
						?>		<!--set recipe image field as previous value-->
								<div id="recipe-image">
									<p>Photo</p>
							
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
									<p>Photo</p>
							
									<label for="recipe-image-field">
										<i id="photo-icon" class="glyphicon glyphicon-camera"></i>
									</label>
						
									<input id="recipe-image-field" name="recipe-image" type="file" class="file" value="Upload Photo"></input>
								</div>
						<?php
							}
						?>
					</div>
				
					<div id="clear-float4">
						<!--clear float from previous content-->
					</div>
		
					<div id="next">
						<button id="next-button" class="btn btn-warning" type="submit">Next</button>
					</div>
				</div>
			</form> 
		</div>
		
		<div id="margin-canvas2">
			<!--right-side coloured border-->
		</div>
		
		<div id="clear-float5">
			<!--clear float from previous content-->
		</div>
		
		<div id="footer">
			<?php 
				include($root . "view/footer.php");
			?>
		</div>
	</body>
</html>
