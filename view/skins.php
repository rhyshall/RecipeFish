<?php 
/******************************************************************************************
*******************************************************************************************
** Name: skins.php													   		  		   ****
** Description: Provides interface for selecting user background skin for profile      ****
** Author: Rhys Hall																   ****
** Date Created: 10/09/2016														   	   ****
*******************************************************************************************
******************************************************************************************/

$root = $_SERVER["DOCUMENT_ROOT"] . "/RecipeFish/";
$SKIN_COUNT = 12;
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/RecipeFish/stylesheets/skins.css">
		
		<script type="text/javascript">
			function saveSkin(ID)
			{
				window.location.href = "/RecipeFish/controller/skinController.php?skinID=" + ID;
			}
		</script>
	</head>
	
	<body>
		<?php 
			if (isset($_SESSION["skinSaved"]) == true)
			{	
				unset($_SESSION["skinSaved"]);
			}
		?>
		
		<div id="skin-instructions">
			<p>Select a new skin to apply to your profile header</p>
		</div>
		
		<div id="skin-gallery">
			<?php 
				for ($i = 1; $i <= $SKIN_COUNT; $i = $i + 4)
				{
					echo '<div class="row">';
				
					$lowerBound = $i;
					$upperBound = $lowerBound + 4;
					
					for ($j = $lowerBound; $j < $upperBound; $j++)
					{
						echo '<div class="col-md-3"><a href="#" onclick="saveSkin(' . $j . ');"' . 'class="thumbnail"><img src="/RecipeFish/images/skins/skin' . $j . '.png"></a></div>';
					}
					
					echo '</div>';
				}
			?>
		</div>
	</body>
</html>
