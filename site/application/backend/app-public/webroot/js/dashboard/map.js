$(function(){

	var dataset = {};
	var map = {};

	// var totalProjectCount = 0;
    var onlyValues = Object.keys(series).map(function(iso, index) {
    	// if (series[iso].length > 10) console.log(iso)
		// totalProjectCount++
	   return series[iso].projects.length
	});
	// console.log(totalProjectCount);



    var minValue = Math.min.apply(null, onlyValues),
        maxValue = Math.max.apply(null, onlyValues);
    // create color palette function
    // color can be whatever you wish
    var paletteScale = d3.scale.linear()
            .domain([minValue,maxValue])
            .range(["#EFEFFF","#02386F"]); // blue color
    // fill dataset in appropriate format
    for(iso in series) {
    	var territory = series[iso]
    	dataset[iso] = {
    		projectCount: territory.projects.length,
    		fillColor: paletteScale(territory.projects.length),
    		projects: territory.projects // not very intuitive data stucture
    	}
    }

    // render map
    map = new Datamap({
        element: document.getElementById('map'),
        projection: 'mercator', // big world map
        // countries don't listed in dataset will be painted with this color
        fills: { defaultFill: '#F5F5F5' },
        data: dataset,
        geographyConfig: {
            borderColor: '#DEDEDE',
            highlightBorderWidth: 2,
            // don't change color on mouse hover
            highlightFillColor: function(geo) {
                return geo['fillColor'] || '#F5F5F5';
            },
            // only change border
            highlightBorderColor: '#B7B7B7',
            // show desired information in tooltip
            popupTemplate: function(geo, data) {
                // don't show tooltip if country don't present in dataset
                if (!data) { return ; }
                // tooltip content

                // project links
                var projectLinks = data.projects.map(function(project){
                	
                	return [
                		// '<li><a href="/pdb/projects/view/' + project.Project.id + '">',
                		'<li>',
                		project.Project.title,
                		'</li>'
                		// '</a></li>'
                	].join('')
                })

                var tooltipContent = [
                	'<div class="hoverinfo">',
                    '<strong>', geo.properties.name, '</strong>',
                    '<br>Count: <strong>', data.projects.length, '</strong><br>',
                    projectLinks.join(''),
                    '</div>'
                ].join('');
                
                // console.log(projectLinks);
                return tooltipContent
            }
        }, done: function(datamap) {
        	
            datamap.svg.selectAll('.datamaps-subunit').on('click', function(geography,a,b,c,d) {
                // console.log(geography.properties.name, geography);
                var iso = geography.id;
                if (typeof series[iso] != undefined) {
                	window.location = '/pdb/projects?action=search&territory_id=' + series[iso].territory.id
                }
            });
        }
    });

})