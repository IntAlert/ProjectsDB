$(function(){

	$('.prize-form form').submit(function(){

		// get inputs
		var name = $('.entrant-name input').val();
		var email = $('.entrant-email input').val();
		var over_18 = $('.entrant-over-18 input').is(":checked");
		var agree_tc = $('.entrant-agree-tc input').is(":checked");

		// get alerts
		var nameAlert = $('.entrant-name .alert');
		var emailAlert = $('.entrant-email .alert');
		var over_18Alert = $('.entrant-over-18 .alert');
		var agree_tcAlert = $('.entrant-agree-tc .alert');

		// validate
		var validates = true;

		if(name.length < 3) {
			nameAlert.show();
			validates = false;
		} else nameAlert.hide();

		if( !validateEmail(email)) {
			emailAlert.show();
			validates = false;
		} else emailAlert.hide();

		if( !over_18 ) {
			over_18Alert.show();
			validates = false;
		} else over_18Alert.hide();

		if( !agree_tc ) {
			agree_tcAlert.show();
			validates = false;
		} else agree_tcAlert.hide();

		if (validates) {
			$(this).fadeOut(function(){
				
				$('.prize-form-waiting').fadeIn();

				// save
				// TODO: show waiting
				api.registerPrizeEntry(app.persona_id, name, email, over_18, function(){
					$('.prize-form-waiting').fadeOut('fast', function(){
						$('.prize-form-success').fadeIn();		
					});	
					
				})
			});


			
		}

		return false;
	});
        
})

function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 

function validateDate(dob) {	
	var re = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;
    return re.test(dob);
}