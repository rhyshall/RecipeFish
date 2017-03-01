<?php 
/******************************************************************************************
*******************************************************************************************
** Name: profileMenu.php													   		   ****
** Description: Displays menu for user profile  				   					   ****
** Author: Rhys Hall																   ****
** Date Created: 10/08/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeMingle/";
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeMingle/stylesheets/profileMenu.css">
		
		<script type="text/javascript">
			function showContent(element)  
			{
				var buttons = document.getElementsByClassName("tab");
				var tabContents = document.getElementsByClassName("tabContent");
				var i = 0;
				var upperBound = tabContents.length;
				
				for (i = 0; i < upperBound; i++)
				{
					buttons[i].className = "tab";
				}
				
				for (i = 0; i < upperBound; i++) 
				{ 
					tabContents[i].style.display = "none";
				}

				//display content for matching tab 
				var tabToShow = element.id.replace(/(\d)/g, '-$1');
				
				document.getElementById(tabToShow).style.display = "block";
				element.className = "tab active";
			}
		</script>
	</head>
	
	<body <?php if (isset($_SESSION["skinSaved"]) == false) { ?> onload="showContent(document.getElementById('tabs1'));" <?php } else { ?> onload="showContent(document.getElementById('tabs4'));" <?php } ?>>
	
		<div id="profile-menu">
			<ul id="navigation" class="nav nav-pills">
				<li id="tabs1" class="tab" onclick="showContent(this);"><a href="#">Basic Info</a></li>
				<li id="tabs2" class="tab" onclick="showContent(this);"><a href="#">Additional Info</a></li>
				<li id="tabs3" class="tab" onclick="showContent(this);"><a href="#">Photo</a></li>
				<li id="tabs4" class="tab" onclick="showContent(this);"><a href="#">Background Skin</a></li>
				<li id="tabs5" class="tab" onclick="showContent(this);"><a href="#">Password</a></li>
				<li id="tabs6" class="tab" onclick="showContent(this);"><a href="#">Remove Account</a></li>
			</ul>
		</div>
		
		<div class="tab-content">
			<div id="tabs-1" class="tabContent">
				<?php 
					include($root . "view/basicInfo.php");
				?>
			</div>
			
			<div id="tabs-2" class="tabContent">
				<p>additional info here</p>
			</div>
			
			<div id="tabs-3" class="tabContent">
				<p>photo here</p>
			</div>
			
			<div id="tabs-4" class="tabContent">
				<?php 
					include($root . "view/skins.php");
				?>
			</div>
			
			<div id="tabs-5" class="tabContent">
				<p>password here</p>
			</div>
			
			<div id="tabs-6" class="tabContent">
				<p>remove account here</p>
			</div>
		</div>
	</body> 
</html>
