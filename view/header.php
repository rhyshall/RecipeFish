<?php
/******************************************************************************************
*******************************************************************************************
** Name: header.php																       ****
** Description: Provides header interface (such as recipe search field and sign-in 	   ****
** 				button) for all Recipe Fish pages		   						   	   ****
** Author: Rhys Hall																   ****
** Date Created: 04/13/2016														   	   ****
*******************************************************************************************
******************************************************************************************/
?>

<html>
	<head>
		<title>Recipe Fish | Discover and share your creativity with tasty recipes outside of the kitchen</title>
	
		<!--stylesheet for given page-->
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/header.css?<?php echo date('l jS \of F Y h:i:s A'); ?>"/>
		
		<!--custom button stylesheets-->
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/customButtons.css"/>
		
		<!--Bootstrap stylesheets-->
		<link rel="stylesheet" href="/RecipeFish/Bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="/RecipeFish/Bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="/RecipeFish/Bootstrap/css/bootstrap-theme.css">
		<link rel="stylesheet" href="/RecipeFish/Bootstrap/css/bootstrap-theme-min.css">
		
		<!--Bootstrap scripts-->
		<script src="/RecipeFish/Bootstrap/js/bootstrap.js"></script>
		<script src="/RecipeFish/Bootstrap/js/bootstrap.min.js"></script>
		<script src="/RecipeFish/Bootstrap/js/npm.js"></script>
		
		<script type="text/javascript">
			function showDropdown()
			{
				document.getElementById("user-drop-down-menu").classList.toggle("show");
			}
			
			window.onclick = function(event)
			{
				if (!event.target.matches('.btn'))
				{
					var dropdowns = document.getElementsByClassName("dropdown-menu");
					
					var i;
					
					for (i = 0; i < dropdowns.length; i++)
					{
						var openDropdown = dropdowns[i];
						
						if (openDropdown.classList.contains('show'))
						{
							openDropdown.classList.remove('show');
						}
					}
				}
			}
		</script>
	</head>
	
	<body>
		<div id="container-header">
			<div id="colour-canvas-header1">
				<!--colour border separating top of page and header content-->
			</div>
			
			<div id ="header-canvas">
				<div id="logo">
					<a href="/RecipeFish"><img src="/RecipeFish/images/standard/recipe fish logo.png"></a>
				</div>
				
				<div id="categories">
					<button id="categories-button" class="btn btn-grey1" type="button">Categories</button>
			
					<div id="categories-drop-down" class="categories-drop-down">
						<button id="categories-drop-down-button" class="btn btn-grey2 dropdown-toggle" type="button" data-toggle="dropdown">
						<span class="caret"></span></button>
					</div>
				</div>
		
				<form id="search-form" action="/RecipeFish/controller/searchController.php" role="search">
					<input id="search-field" type="text" class="form-control" placeholder="Search recipe..."></input>

					<button id="search-button" class="btn btn-info" type="submit"><i class="glyphicon glyphicon-search"></i></button>
				</form>
				<!--
				<div id="advanced-search">
					<button id="advanced-search-button" class="btn btn-grey1" type="submit">Advanced Search</button>
				</div> -->
			
				<?php 
					//if user signed in
					if (isset($_SESSION["username"]) == true)
					{
				?>		<!-- display appropriate gender pic-->
						<div id="user-menu">
							<?php 
								//if user is male 
								if (strcmp($_SESSION["gender"], "male") == 0)
								{
							?>		<!--display user button with male pic-->
									<button id="user-button" class="btn btn-grey1" type="submit"><span id="male-pic" class="glyphicon glyphicon-user pull-left"></span>
									<?php echo $_SESSION["username"] ?></button>
							<?php 
								}
							
								else 
								{
							?>		<!--display user button with female pic-->	
									<button id="user-button" class="btn btn-grey1" type="submit"><img id="female-pic" src="/RecipeFish/images/standard/female user.png"></span>
									<?php echo $_SESSION["username"] ?></button>
							<?php	
								} 
							?>
						
							<!--user options (drop-down)-->
							<div id="user-drop-down" class="dropdown">
								<button id="user-drop-down-button" class="btn btn-grey2 dropdown-toggle" type="button" onclick="showDropdown()">
								<span class="caret"></span></button>
							
								<ul id="user-drop-down-menu" class="dropdown-menu">
									<li><a href="/RecipeFish/view/profile.php">Profile<span class="glyphicon glyphicon-user pull-right"></span></a></li>
									<li><a href="#">Cookbook<span class="glyphicon glyphicon-book pull-right"></span></a></li>
									<li><a href="/RecipeFish/view/recipes.php">Recipes<span class="glyphicon glyphicon-cutlery pull-right"></span></a></li>
									<li><a href="#">Reviews<span class="glyphicon glyphicon-list-alt pull-right"></span></a></li>
									<li><a href="#">Stats<span class="glyphicon glyphicon-stats pull-right"></span></a></li>
									<li><a href="#">History<span class="glyphicon glyphicon-align-left pull-right"></span></a></li>
									<li class="divider"></li>
									<li><a href="/RecipeFish/controller/logOutController.php">Log Out<span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
								</ul>
							</div>
						</div>
				<?php
					}
				
					else
					{
				?>
						<div id="account">
							<a href="/RecipeFish/view/register.php" id="register-button">Register</a>
							<h5>|</h5> 
							<a href="/RecipeFish/view/logIn.php" id="log-in-button">Log In</a>
						</div>
				<?php 
					}
				?>
				
				<div id="clear-float-header1">
					<!--clear float from previous content-->
				</div>
			</div>
		
			<div id="colour-canvas-header2">
				<!--colour border separating header content and recipes-->
			</div>
		</div>
	</body>
</html>
