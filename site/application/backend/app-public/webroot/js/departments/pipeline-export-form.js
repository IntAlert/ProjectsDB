$(function(){


	// keep totals up to date


	// local storage key
	// var localStorageKey = 'macpipeline-export-form-' + selectedYear;

	// // get any data in local storage
	// if (localStorage) {
	// 	var formValues = localStorage.getItem(localStorageKey)


	// 	if (formValues) {


	// 	}


	// }

	// // store any values here in user's local storage
	// if (localStorage) {

	// 	localStorage.setItem(localStorageKey);

	// }

	// persist comparisson data
	$('.garlic-persist').garlic({
		getPath: function ( $elem ) {
			var path = selectedYear + '-' + $elem.attr( 'name' );
			return path;
		}
	});

	// activate datepicker 
	$('.departments-pipelineExportForm .datepicker').datepicker({
		dateFormat: 'dd-mm-yy'
	});


	// keep totals and percentages up to date
	$('.pipeline.this-year .department-cfhl, .pipeline.this-year .department-budget').keyup(function(){
		mirrorFields();
		updatePercentages();
		updateTotals();
	}).keyup()





})

var mirrorFields = function(){
	$('.pipeline .department-budget').each(function(){
		var department_id = $(this).data('department-id');
		var thisYearInput = $('[name="department-budget[' + department_id + ']"]')
		$(this).html('&pound;' + $.number(thisYearInput.val()));
	})

	$('.pipeline .department-cfhl').each(function(){
		var department_id = $(this).data('department-id');
		var thisYearInput = $('[name="department-cfhl[' + department_id + ']"]')
		$(this).html('&pound;' + $.number(thisYearInput.val()));
	})
}


var updateTotals = function() {
	
	// build totals
	var department_budget_total = 0;
	$(".pipeline.this-year .department-budget").each(function(){
		department_budget_total += Number($(this).val());
	});

	var department_cfhl_total = 0;
	$(".pipeline.this-year .department-cfhl").each(function(){
		department_cfhl_total += Number($(this).val());
	});

	if (department_budget_total > 0) {
		var department_cfhl_percentage = Math.round(100 * department_cfhl_total/department_budget_total)
	} else {
		department_cfhl_percentage = 0
	}
	

	$('.department-budget-total').text($.number(department_budget_total)); // comma-formatted
	$('.department-cfhl-total').text($.number(department_cfhl_total)); // comma-formatted
	$('.department-cfhl-total-percentage').text(department_cfhl_percentage);

}

var updatePercentages = function() {


	var department_budgets = {}
	var department_cfhls = {}

	// collect budget values
	$(".pipeline.this-year input.department-budget").each(function(){

		var department_id = $(this).data('department-id')
		var department_budget = $(this).val()
		department_budgets[department_id] = department_budget

	});

	// collect cfhl values
	$(".pipeline.this-year input.department-cfhl").each(function(){

		var department_id = $(this).data('department-id')
		var department_cfhl = $(this).val()
		department_cfhls[department_id] = department_cfhl

	});

	// update slave and master
	$(".department-cfhl-percentage").each(function(){

		var department_id = $(this).data('department-id')
		if (department_budgets[department_id] > 0) {
			var department_chfl_percentage = Math.round(100 * department_cfhls[department_id] / department_budgets[department_id])	
		} else {
			var department_chfl_percentage = 0
		}
		
		$(this).text(department_chfl_percentage)

	});

}




