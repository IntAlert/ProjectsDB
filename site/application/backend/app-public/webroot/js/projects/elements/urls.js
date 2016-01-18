$(function(){

	var serialise
	var component = $(".project-urls")

	// make sortable
	$(".project-urls ul").sortable({handle: '.move'})

	$("#url_add_form input[type=button]").click(function(){

		var url = component.find('#url_add_form .url').val().trim()
		var title = component.find('#url_add_form .title').val().trim()

		if ( !url || !title ) {
			// something's wrong
			alert('Please enter a url and a title')
			return false
		}

		console.log(url)
		console.log(title)

		var template = component.find('.template').clone().removeClass('template')
		template.find('input.url').val(url)
		template.find('input.title').val(title)
		template.find('a').attr('href', url)
		template.find('a').text(title)

		console.log(template)

		$(".project-urls ul").append(template)

		serialise()

		// clear inputs
		component.find('#url_add_form .url').val('')
		component.find('#url_add_form .title').val('')

		return false
	})

	// handle delete
	component.delegate('.delete', 'click', function(){

		$(this).parents('li').remove()

		serialise()

	})

	// serialise to JSON
	serialise = function(){
		var urls = []
		component.find('li:not(.template)').each(function(){

			var url = $(this).find('.url').val()
			var title = $(this).find('.title').val()

			urls.push({url: url, title: title})

		})

		console.log(urls)

		$('#ProjectWebLinksJson').val(JSON.stringify(urls))
	}

})