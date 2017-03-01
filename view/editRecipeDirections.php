<?php 
/******************************************************************************************
*******************************************************************************************
** Name: editRecipeDirections.php													   ****
** Description: Provides interface for editing directions for a desired recipe         ****	   			   														
** Author: Rhys Hall																   ****
** Date Created: 10/08/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

session_start();

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeMingle/";
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeMingle/stylesheets/addRecipeDirections.css">
		
		<!--stylesheet for tab icon-->
		<link rel="shortcut icon" type="image/ico" href="/RecipeMingle/images/standard/colour wheel.ico"/>
		
		<script type="text/javascript">
			var directionCount = 0;
			var directionId = 1;
			
			<!--Outputs current direction step count-->
			function printDirectionCount()
			{
				var directionTitle = document.getElementById("direction-title");
				
				var directionString = "Step ";
				
				directionTitle.innerHTML = directionString.concat(directionCount + 1);
				
				document
			}
			
			<!--removes direction input after added to directions table-->
			function removeInput()
			{
				var textBox = document.getElementById("direction-field");
				
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
			
			<!--reports error message if given direction is not valid-->
			function validDirection(direction)
			{
				var isValid = true;
				
				var parameters = "height=250,width=425,left=" + ((screen.width/2)-(425/2)) + ",top=" + ((screen.height/2)-(screen.height/4));
				
				if (direction.length == 0)
				{
					popUpWindow = window.open("emptyDirectionError.php", "Empty Direction Message", parameters);
					
					isValid = false;
				}
				
				if (direction.length > 500)
				{
					popUpWindow = window.open("directionLengthError.php", "Direction Length Message", parameters);
					
					isValid = false;
				}
				
				return isValid;
			}
		
			<!--adds current direction input to directions table-->
			function addDirection(direction) 
			{
				if (validDirection(direction) == true)
				{
					var table = document.getElementById("directions-table");
				
					var row = table.insertRow(directionCount + 1);
				
					var rowString = "row";
					row.id = rowString.concat(directionId);
				
					var cell1 = row.insertCell(0);
					var cell2 = row.insertCell(1);
					var cell3 = row.insertCell(2);
				
					var directionFormat1 = '<span name="direction';
					var directionFormat2 = '" class="direction-added">';
					var directionFormat3 = '</span>';
					var directionFormat4 = '<input name="direction';
					var directionFormat5 = '" class="direction-input" value="' + direction + '">';
					var directionFormat6 = '</input>';

					var removeFormat1 = '<span id="remove-direction';
					var removeFormat2 = '" class="glyphicon glyphicon-trash" style="cursor:pointer" onclick="removeDirection(this.id)"></span>';
				
					cell1.innerHTML = (directionCount + 1).toString();
					cell2.innerHTML = directionFormat1.concat(directionId, directionFormat2, direction, directionFormat3, directionFormat4, directionId, directionFormat5, directionFormat6);
					cell3.innerHTML = removeFormat1.concat(directionId, removeFormat2);
				
					if (directionCount < 12)
					{
						table.deleteRow(14);
					}
				
					directionCount++;
					directionId++;
					
					printDirectionCount();

					if (directionCount > 1)
					{
						var prevRow = table.rows[directionCount-1];
						prevRow.deleteCell(2);
						var cell = prevRow.insertCell(2);
					}
					
					removeInput();
				}
			}
			
			<!--removes selected direction from directions table-->
			function removeDirection(removeId)
			{
				var table = document.getElementById("directions-table");
				
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
					alert("Remove Direction Error");
				}
				
				else 
				{
					var idNum = parseInt(removeId.substr(index, length-1));
				}
				
				var rowString = "row";
				rowStringX = rowString.concat(idNum);
				
				var row = document.getElementById(rowStringX);
				
				table.deleteRow(row.rowIndex); 
				
				directionCount--;
				
				if (directionCount < 13)
				{
					var row = table.insertRow(13);
					var cell1 = row.insertCell(0);
					var cell2 = row.insertCell(1);
					var cell3 = row.insertCell(2);
					
					cell1.innerHTML = '<span class="blank"></span>';
					cell2.innerHTML = '<span class="blank"></span>';
				}
				
				printDirectionCount();	
				
				if (directionCount > 0)
				{
					var prevRow = table.rows[directionCount];
					prevRow.deleteCell(2);
					var cell = prevRow.insertCell(2);
					
					var removeFormat1 = '<span id="remove-direction';
					var removeFormat2 = '" class="glyphicon glyphicon-trash" style="cursor:pointer" onclick="removeDirection(this.id)"></span>';
					
					cell.innerHTML = removeFormat1.concat(prevRow.id, removeFormat2);
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
				<p>Edit Recipe</p>
			</div>
		
			<div id="sub-title">
				<p>Directions</p>
			</div>
			
			<?php 
				//add recipe direction count error message (if required)
				include($root . "/view/directionCountError.php");
			?>
			
			<div id="add-direction">
				<p id="add-instructions-1">Enter each direction required for your recipe into the text</p>
				<p id="add-instructions-2">area below. Check your results with the given directions list.</p>
			
				<?php 
					//if direction input previously filled
					if (isset($_SESSION["directionField"]) == true)
					{
				?>		<!--set direction name field value as previous value-->
						<div id="direction">
							<p id="direction-title"></p>
							
							<script type="text/javascript">
								printDirectionCount();
							</script>
						
							<textarea id="direction-field" name="direction" type="text" class="form-control" value="<?php echo $_SESSION["directionField"] ?>"></textarea>
						</div>
				<?php 
						unset($_SESSION["directionField"]);
					}
				
					else
					{
				?>		<!--insert direction field placeholder-->
						<div id="direction">
							<p id="direction-title"></p>

							<script type="text/javascript">
								printDirectionCount();
							</script>
							
							<textarea id="direction-field" name="direction" type="text" class="form-control" placeholder="eg. Melt butter on skillet on medium heat."></textarea>
						</div>
				<?php 
					}
				?>
			
				<div id="add">
					<button id="add-button" class="btn btn-success" type="button" onclick="addDirection(document.getElementById('direction-field').value)">Add</button>
				</div>
			</div>
			
			<form id="directions-form" action="/RecipeMingle/controller/recipeDirectionsController.php" method="post">
				<div id="view-directions">
					<table id="directions-table" class="table table-striped">
						<caption>My List</caption>
						
						<thead>
							<tr>
								<th id="step-title">Step</th>
								<th id="direction-title">Direction</th>
							</tr>
						</thead>
   
						<tbody id="table-body">
							<?php 
								for ($i = 0; $i < 13; $i++)
								{
							?>
									<tr>
										<td id="hidden-step">blank</td>
										<td id="hidden-direction">blank</td>
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
