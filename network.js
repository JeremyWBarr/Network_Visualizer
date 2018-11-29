var myDiv = document.getElementById("cy");

myDiv.style.left = 0;
myDiv.style.width = "100%";
myDiv.style.height = "93vh";
myDiv.style.position = "absolute";

var options = {
	name: 'cose',
	ready: function(){},
	stop: function(){},
	animate: true,
	animationEasing: undefined,
	animationDuration: undefined,
	animateFilter: function ( node, i ){ return true; },
	animationThreshold: 250,
	refresh: 20,
	fit: true,
	padding: 30,
	boundingBox: undefined,
	nodeDimensionsIncludeLabels: false,randomize: false,
	componentSpacing: 40,
	nodeRepulsion: function( node ){ return 2048; },
	nodeOverlap: 4,
	idealEdgeLength: function( edge ){ return 32; },
	edgeElasticity: function( edge ){ return 32; },
	nestingFactor: 1.2,
	gravity: 1,
	numIter: 1000,
	initialTemp: 1000,
	coolingFactor: 0.99,
	minTemp: 1.0,
	weaver: false
};

var cy = cytoscape({
  container: myDiv,

  layout: {
	name: 'cose',
	padding: 10
  },

  style: cytoscape.stylesheet()
    .selector('node')
      .style({
        // 'shape': 'data(faveShape)',
        'width': 'mapData(weight, 40, 80, 20, 60)',
        'content': 'data(name)',
        'text-valign': 'center',
        'text-outline-width': 2,
        // 'text-outline-color': 'data(faveColor)',
        // 'background-color': 'data(faveColor)',
        'color': '#fff'
      })
    .selector(':selected')
      .style({
        'border-width': 3,
        'border-color': '#333'
      })
    .selector('edge')
      .style({
        'opacity': 0.666,
        'width': 'mapData(strength, 70, 100, 2, 6)',
        'target-arrow-shape': 'triangle',
        'source-arrow-shape': 'circle',
        // 'line-color': 'data(faveColor)',
        // 'source-arrow-color': 'data(faveColor)',
        // 'target-arrow-color': 'data(faveColor)'
      })
    .selector('edge.questionable')
      .style({
        'line-style': 'dotted',
        'target-arrow-shape': 'diamond'
      })
    .selector('.faded')
      .style({
        'opacity': 0.25,
        'text-opacity': 0
      }),
});

$.ajax({
    url: 'network.php',
    method: 'post',
    data: {
        action: 'getData'
    },
    success: (response)=>{
        data = JSON.parse(response).data;

        for(var i = 0 in data) {
        	var ver1 = data[i][1];
        	var ver2 = data[i][2];
        	// Add first node if doesn't exist
        	if(cy.elements('node[name = "'+ver1+'"]').length < 1) {
        		cy.add({
        			group: "nodes",
        			data: {
	        			id: ver1,
	        			name: ver1
	        		}
        		});
        	}
        	// Add second node if doesn't exist
        	if(cy.elements('node[name = "'+ver2+'"]').length < 1) {
        		cy.add({
        			group: "nodes",
        			data: {
	        			id:   ver2,
	        			name: ver2
	        		}
        		});
        	}
        	// Add edge
        	cy.add({
        		group: "edges",
        		data: {
        			source: ver1,
        			target: ver2
        		}
        	});
        }
        var layout = cy.layout(options);
        layout.run();
    },
    error: (xhr, status, error)=>{
        alert(error);
    }
});

function updateStyle(elem, property, value) {
	cy.$(elem).style({ [property]: value });
}