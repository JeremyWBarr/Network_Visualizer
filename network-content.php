<!doctype html>
<html lang="en">
    <!-- Based on: https://getbootstrap.com/docs/4.1/examples/sign-in/ -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Network Visualizer</title>

        <!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="style.css">

		<script src="node_modules/cytoscape/dist/cytoscape.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    </head>

    <body id="networkbody">

    	<nav class="navbar navbar-dark bg-dark fixed-top">
			<div class="container-fluid">
				<ul class="navbar-nav">
		    		<li><a href="#" class="btn btn-outline-success" id="settings-toggle">Toggle Settings</a></li>
		    	</ul>

		    	<ul class="nav navbar-nav navbar-center">
		      		<li class="navbar-brand">Network Visualizer</li>
		    	</ul>

		    	<ul class="nav navbar-nav navbar-right">
		      		<li><a href="#" class="btn btn-outline-success" id="data-toggle">Toggle Data</a></li>
		    	</ul>
			</div>
		</nav>

	    <div id="wrapper">

	    	<!-- Settings -->
	    	<div id="settings-wrapper">
	    		<input type="color" id="nodeColor" name="nodeColor">
	    	</div>

	    	<!-- Page Content -->
	    	<div id="graph-wrapper">
				<div id="cy"></div>
	    	</div>

	    	<!-- Data -->
	    	<div id="data-wrapper">
	    		<table>
	    		<?php
	    			$rowCount = count($_SESSION["data"]);
	    			for($i = 1; $i < $rowCount+1; $i++) {
	    				$colCount = count($_SESSION["data"][$i]);
	    				echo '<tr>';
	    				for($j = 1; $j < $colCount; $j++) {
	    					echo ($i == 1 ? '<th>' : '<td>');
	    					echo $_SESSION["data"][$i][$j];
	    					echo ($i == 1 ? '</th>' : '</td>');
	    				}
	    				echo '</tr>';;
	    			}
	    		?>
	    		</table>
	    	</div>

	    	<script src="network.js"></script>
	    	<script type="text/javascript">
	    		$("#settings-toggle").click( function(e) {
	    			e.preventDefault();
	    			$("#wrapper").toggleClass("settingsDisplayed");
	    		});

	    		$("#data-toggle").click( function(e) {
	    			e.preventDefault();
	    			$("#wrapper").toggleClass("dataDisplayed");
	    		});

	    		$("#nodeColor").change( function(e) {
	    			e.preventDefault();
	    			console.log($(this).val());
	    			updateStyle('node','background-color', $(this).val());
	    		});

	    	</script>
	    </div>
	</body>
</html>