$(function(){


	// Handle Project comment creation
	$('.projectnotes form').submit(function(){
		var comment = $('.projectnotes textarea').val();

		if(comment) {

			
			
			// post the new comment
			$.post('/api/projectnotes/add', {

				"Projectnote": {
					"project_id":data.Project.id,
					"content":comment
				}

			}, function(projectnote){

				console.log(projectnote);

				// create the element
				var li = $('<li>');
				li.hide();

				// add comment and author
				li.html('<p>' + projectnote.Projectnote.content + ' by <strong>me</strong></p>');

				// add delete button
				var $a = $('<a class="delete" href="#">Delete</a>');
				$a.data('projectnote-id', projectnote.Projectnote.id);
				li.append($a);

				$('.projectnotes ul').append(li);

				// reset the textarea
				$('.projectnotes textarea').val('');



				// fade it in the element to say it's been saved
				li.fadeIn();
			})

			
		}
		
		return false;
	});


	// Handle Project comment deletion
	$(".projectnotes").on('click', '.delete', function(){

		var msg = "Are you sure you want to delete this comment?";

		if (confirm(msg) === false) return false;

		// get project id
		var projectnote_id = $(this).data('projectnote-id');

		// get li
		var li = $(this).parents('li');


		// post the new comment
		$.post('/api/projectnotes/delete/' + projectnote_id, function(){
			
			

		})

		// fade it in the element to say it's been saved
		li.slideUp();

		return false;


	})




});