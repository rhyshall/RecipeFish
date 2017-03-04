<?php 
/******************************************************************************************
*******************************************************************************************
** Name: addRecipeIngredients.php													   ****
** Description: Provides interface for uploading ingredients for a desired recipe      ****	   			   														
** Author: Rhys Hall																   ****
** Date Created: 05/14/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/addRecipeIngredients.css">
		
		<!--stylesheet for tab icon-->
		<link rel="shortcut icon" type="image/ico" href="/RecipeFish/images/standard/colour wheel.ico"/>
		
		<script type="text/javascript">
			var ingredientCount = 0;
			var ingredientId = 1;
			var popUpWindow = null;
			
			<!--clicks the "Add" button on "Enter" key-->
			function clickAdd(keyCode)
			{
				if (keyCode == 13)
				{
                    document.getElementById("add-button").click();
				}
			}
			
			<!--removes ingredient input after added to ingredients table-->
			function removeInput()
			{
				var textBox = document.getElementById("ingredient-field");
				
				textBox.value = "";
			}
			
			<!--disables parent window until pop-up window closed 
			function parentDisable() 
			{
				if (popUpWindow && !popUpWindow.closed)
				{
					popUpWindow.focus();
				}
			}
			
			<!--reports error message if given ingredient is not valid-->
			function validIngredient(ingredient)
			{
				var isValid = true;
				
				var parameters = "height=250,width=425,left=" + ((screen.width/2)-(425/2)) + ",top=" + ((screen.height/2)-(screen.height/4));
				
				if (ingredient.length == 0)
				{
					popUpWindow = window.open("emptyIngredientError.php", "Empty Ingredient Message", parameters);
					
					isValid = false;
				}
				
				if (ingredient.length > 75)
				{
					popUpWindow = window.open("ingredientLengthError.php", "Ingredient Length Message", parameters);
					
					isValid = false;
				}
				
				return isValid;
			}
		
			<!--adds current ingredient input to ingredients table-->
			function addIngredient(ingredient) 
			{
				if (validIngredient(ingredient) == true)
				{
					var table = document.getElementById("ingredients-table");
				
					var row = table.insertRow(ingredientCount + 1);
				
					var rowString = "row";
					row.id = rowString.concat(ingredientId);
				
					var cell1 = row.insertCell(0);
					var cell2 = row.insertCell(1);
				
					var ingredientFormat1 = '<span name="ingredient';
					var ingredientFormat2 = '" class="ingredient-added">';
					var ingredientFormat3 = '</span>';
					var ingredientFormat4 = '<input name="ingredient';
					var ingredientFormat5 = '" class="ingredient-input" value="' + ingredient + '">';
					var ingredientFormat6 = '</input>';
					
					var removeFormat1 = '<span id="remove-ingredient';
					var removeFormat2 = '" class="glyphicon glyphicon-trash" style="cursor:pointer" onclick="removeIngredient(this.id)"></span>';
					
					cell1.innerHTML = ingredientFormat1.concat(ingredientId, ingredientFormat2, ingredient, ingredientFormat3, ingredientFormat4, ingredientId, ingredientFormat5, ingredientFormat6);
					cell2.innerHTML = removeFormat1.concat(ingredientId, removeFormat2);
				
					if (ingredientCount < 12)
					{
						table.deleteRow(14);
					}
				
					ingredientCount++;
					ingredientId++;
					
					removeInput();
				}
			}
			
			<!--removes selected ingredient from ingredients table-->
			function removeIngredient(removeId)
			{
				var table = document.getElementById("ingredients-table");
				
				var length = removeId.length;
				
				for (var i = length-1; i > 2; i--)
				{
					var substr = removeId.substr(i, length-1);
					
					if (isNaN(substr) == true)
					{
						var index = i + 1;
						
						break;
					}
				}
				
				if (index >= length)
				{
					alert("Remove Ingredient Error");
				}
				
				else 
				{
					var idNum = parseInt(removeId.substr(index, length-1));
				}
				
				var rowString = "row";
				rowString = rowString.concat(idNum);
				
				var row = document.getElementById(rowString);
				
				table.deleteRow(row.rowIndex); 
				
				ingredientCount--;
				
				if (ingredientCount < 13)
				{
					var row = table.insertRow(13);
					var cell1 = row.insertCell(0);
					var cell2 = row.insertCell(1);
					
					cell.innerHTML = '<span class="blank"></span>';
				}
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
		
		<div id="container">
			<div id="title">
				<p>Add Your Recipe</p>
			</div>
		
			<div id="sub-title">
				<p>Ingredients</p>
			</div>
			
			<?php 
				//add recipe ingredient count error message (if required)
				include($root . "/view/ingredientCountError.php");
			?>
			
			<div id="bar">
				<div class="progress">
					<div id="blue-bar" class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
						<span class="sr-only">60% Complete</span>
					</div>
				</div>
			</div>
			
			<div id="add-ingredient">
				<p id="add-instructions-1">Enter each ingredient required for your recipe into the field</p>
				<p id="add-instructions-2">below. Check your results with the given ingredients list.</p>
			
				<?php 
					//if ingredient name input previously filled
					if (isset($_SESSION["ingredientField"]) == true)
					{
				?>		<!--set ingredient name field value as previous value-->
						<div id="ingredient">
							<p id="ingredient-title">Ingredient</p>
						
							<input id="ingredient-field" name="ingredient" type="text" class="form-control" value="<?php echo $_SESSION["ingredientField"] ?>"></input>
						</div>
				<?php 
						unset($_SESSION["ingredientField"]);
					}
				
					else
					{
				?>		<!--insert ingredient name field placeholder-->
						<div id="ingredient">
							<p id="ingredient-title">Ingredient</p>
					
							<input id="ingredient-field" name="ingredient" type="text" class="form-control" placeholder="eg. 1/2 cup unsalted butter" onkeydown="clickAdd(event.keyCode)"></input>
						</div>
				<?php 
					}
				?>
			
				<div id="add">
					<button id="add-button" class="btn btn-success" type="button" onclick="addIngredient(document.getElementById('ingredient-field').value)">Add</button>
				</div>
			</div>
			
			<form id="ingredients-form" action="/RecipeFish/controller/recipeIngredientsController.php" method="post">
				<div id="view-ingredients">
					<table id="ingredients-table" class="table table-striped">
						<caption>My List</caption>
						
						<thead>
							<tr>
								<th id="table-title">Ingredient</th>
							</tr>
						</thead>
   
						<tbody id="table-body">
							<?php 
								for ($i = 0; $i < 13; $i++)
								{
							?>
									<tr>
										<td id="hidden-ingredient">blank</td>
										<td id="hidden-remove"></td>
									</tr>
							<?php 
								}
							?>
						</tbody>
					</table>
				</div>
					
				<div id="clear-float1">
					<!--clear float from previous content-->
				</div>
		
				<div id="next">
					<button id="next-button" class="btn btn-warning" type="submit">Next</button>
				</div>
			</form>
		</div>
		
		<div id="margin-canvas2">
			<!--right-side coloured border-->
		</div>
		
		<div id="clear-float2">
			<!--clear float from previous content-->
		</div>
		
		<div id="footer">
			<?php 
				include($root . "view/footer.php");
			?>
		</div>
	</body>
</html>
