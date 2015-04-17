$(function(){


	// Handle Project comment creation
	$('.projectnotes form').submit(function(){
		var comment = $('.projectnotes textarea').val();

		if(comment) {

			// create the element
			var li = $('<li>');
			li.hide();
			li.html('<p>' + comment + ' by <strong>me</strong></p>');
			$('.projectnotes ul').append(li);
			
			// post the new comment
			$.post('/api/projectnotes/add', {

				"Projectnote": {
					"project_id":data.Project.id,
					"content":comment
				}

			}, function(){
				// fade it in the element to say it's been saved
				li.fadeIn();
			})

			// reset the textarea
			$('.projectnotes textarea').val('');
		}
		
		return false;
	})




});