$(function(){
	
		$('#ProjectdateStartDate').datepicker({dateFormat: 'dd/mm/yy'});
		$('#ProjectdateFinishDate').datepicker({dateFormat: 'dd/mm/yy'});

		$('#ProjectdateStartDateLimit').change(function(){
			if (this.checked) {
				$('#ProjectdateStartDate').show();
			} else {
				$('#ProjectdateStartDate').hide();
			}
		}).change();

		$('#ProjectdateFinishDateLimit').change(function(){
			if (this.checked) {
				$('#ProjectdateFinishDate').show();
			} else {
				$('#ProjectdateFinishDate').hide();
			}
		}).change();


	});	