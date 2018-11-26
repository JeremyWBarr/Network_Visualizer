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

    <div id="wrapper">

    	<!-- Sidebar -->
    	<div id="settings-wrapper">
    		<ul class="settings-nav">
    			<li> TEST 1 </li>
				<li> TEST 2 </li>
				<li> TEST 3 </li>
    		</ul>
    	</div>

    	<!-- Page Content -->
    	<div id="graph-wrapper">
    		<div class="container-fluid">
    			<div class="row">
    				<div class="col-lg-12">
    					<a href="#" class="btn btn-success" id="settings-toggle">Toggle Settings</a>
    					<div id="cy"></div>
    				</div>
    			</div>
    		</div>
    	</div>

    	<script type="text/javascript">
    		$("#settings-toggle").click( function(e) {
    			e.preventDefault();
    			$("#wrapper").toggleClass("settingsDisplayed");

    		});

    	</script>
    	<script src="network.js"></script>
    </div>
</html>