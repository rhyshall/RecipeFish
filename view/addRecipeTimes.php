<?php 
/******************************************************************************************
*******************************************************************************************
** Name: addRecipeTimes.php												   			   ****
** Description: Provides interface for uploading given time values and serving 		   ****
** 				quantity for a desired recipe										   ****
** Author: Rhys Hall																   ****
** Date Created: 03/20/2017													   	   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/addRecipeTimes.css">
		
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
		
			<div id="title">
				<p>Add Recipe</p>
			</div>
			
			<div id="sub-title">
				<p>Times & Servings</p>
			</div>
			
			<div id="bar">
				<div class="progress">
					<div id="blue-bar" class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100">
						<span class="sr-only">14% Complete</span>
					</div>
				</div>
			</div>
			
			<form id="brief-form" action="/RecipeFish/controller/recipeTimesController.php" method="post">
				<div id="panel">
					<div id="times-instructions">
						<p>Select values based on your recipe time and servings</p>
					</div>
					
					<?php 
						//add recipe features error messages (if required)
						include($root . "view/recipeTimesError.php");
					?>
				
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
						
										<option value="24+">24+</option>
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
						
										<option value="24+">24+</option>
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
						
										<option value="24+">24+</option>
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
						
										<option value="24+">24+</option>
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
						
										<option value="24+">24+</option>
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
						
										<option value="24+">24+</option>
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
