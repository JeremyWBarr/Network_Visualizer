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
		<script src="https://unpkg.com/cytoscape-cola@2.2.3/cytoscape-cola.js"></script>
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


	    	<div id="settings-wrapper">
	    		<div class="input-group mb-3" id="settings">
			    	<div class="row">
			    		<div class="col">Node Color:</div>
					    <div class="col"><input type="color" id="nodeColor" name="nodeColor"></div>
					    <div class="w-100"></div>

					    <div class="col">Edge Color:</div>
					    <div class="col"><input type="color" id="edgeColor" name="edgeColor"></div>
					    <div class="w-100"></div>

					    <div class="col">Node Size:</div>
					    <div class="col"><input type="range" id="nodeSize" name="nodeSize" min="20" max="150" step="1" value="50"></div>
					    <div class="w-100"></div>

					    <div class="col">Show Labels:</div>
					    <div class="col">
					    	<select class="settings-select" id="showLabels" name="showLabels" data-style="btn-outline-light">
								<option value="yes">Yes</option>
								<option value="no">No</option>
				    		</select>
					    </div>
					    <div class="w-100"></div>

					    <div class="col">Layout Algorithm:</div>
					    <div class="col">
					    	<select class="settings-select" id="graphLayout" name="graphLayout">
								<option value="random">Random</option>
								<option value="grid">Grid</option>
								<option value="circle">Circle</option>
								<option value="cose">Cose</option>
								<option value="cola">Cola</option>
							</select>
					    </div>
					    <div class="w-100"></div>

			    	</div>
		    	</div>
			    <div class="row" id="settings-bottom">
				    <div class="col">
				    	<a href="#" class="btn btn-outline-success" id="export">Export Graph</a>
				    </div>
				    <div class="col">
						<a href="index.html" class="btn btn-outline-danger" id="export">Restart</a>
				    </div>
				</div>
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

	    		$("#export").click( function(e) {
	    			e.preventDefault();
	    			exportGraph();
	    		});

	    		$("#graphLayout").click( function(e) {
	    			e.preventDefault();
	    			setLayout($("#graphLayout").val());
	    		});

	    		$("#nodeColor").change( function(e) {
	    			e.preventDefault();
	    			updateStyle('node','background-color', $(this).val());
	    		});

	    		$("#edgeColor").change( function(e) {
	    			e.preventDefault();
	    			updateStyle('edge','line-color', $(this).val());
	    		});

	    		$("#nodeSize").change( function(e) {
	    			e.preventDefault();
	    			updateStyle('node','width', $(this).val());
	    			updateStyle('node','height', $(this).val());
	    		});

	    		$("#showLabels").change( function(e) {
	    			e.preventDefault();
	    			if($(this).val() == "yes") {
	    				updateStyle('node','text-opacity', '1');
	    			} else {
	    				updateStyle('node','text-opacity', '0');
	    			}
	    		});


	    	</script>
	    </div>
	</body>
</html>