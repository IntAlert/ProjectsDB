$(function(){

	// tooltips with HTML enabled
	$('.tooltip').uitooltip({
		// content: function () {
		// 	console.log($(this).prop('title'));
		// 	return $(this).prop('title')
		// }
	});

	$("nav.subnav a").button();

	$("table td.actions a").button();


	// search

	// submit on return
	$( "#search-shortcut input[name=q]" ).keypress(function (e) {

	  if (e.which == 13 && $("input[name=q]").val()) {
	    $( "#search-shortcut form").submit();
	    return false;
	  }
	  
	});

	// Search animation
	$( "#search-shortcut input[name=q]" )
		.focus(function(){
			// expand on focus
			$(this).switchClass( "contracted", "expanded", 500, "easeInOutQuad" );
		})
		.blur(function(){
			// contract on blur (if empty)
			if ($(this).val() == '') {
				$(this).switchClass( "expanded", "contracted", 500, "easeInOutQuad" );
			} 
		})


	// search autocomplete
	$( ".search-autocomplete" )
		.autocomplete({
	      source: function(req, callback){
	      	$.get("/api/projects/search", {q:req.term}, function(results){
	      		if (!results.ok) {
	      			console.log('error')
	      		} else {

	      			// format data for jQueryUI
	      			var dataReformatted = [];
	      			$(results.data).each(function(){
	      				dataReformatted.push({
	      					"id":this.Project.id,
	      					"label":this.Project.title
	      				})
	      			})
	      			callback(dataReformatted)
	      		}
	      	});
	      },
	      minLength: 2,
	      select: function( event, ui ) {

	      	// do nothing, just add this search term in
	        console.log( ui.item ?
	          "Selected: " + ui.item.value + " aka " + ui.item.id :
	          "Nothing selected, input was " + this.value );
	      }
	    });
	});
