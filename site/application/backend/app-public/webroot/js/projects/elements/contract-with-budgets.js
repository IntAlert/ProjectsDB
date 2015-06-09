$(function(){


	// initalise indexes for any new payments or contracts
	$(".component-contracts").data("index-new-contract-id", 0);
	$(".component-contracts").data("index-new-contractbudget-id", 0);


	// handle parent form submission, remove templates
	$(".component-contracts").parents('form').submit(function(){
		$(".component-contracts .template").remove();
	});

	// handle add contractbudget
	$(".component-contracts").delegate(".btn-contractbudget-add-after", 'click', function(){
	
		var contractDiv = $(this).parents('div.contract');

		var newYear = createContractBudget(contractDiv, 'after');

		return false;

	});

	$(".component-contracts").delegate(".btn-contractbudget-add-before", 'click', function(){
	
		var contractDiv = $(this).parents('div.contract');

		var newYear = createContractBudget(contractDiv, 'before');

		return false;

	});



	// handle add contract
	$(".component-contracts").delegate(".btn-contract-add", 'click', function(){

		createContract();

		return false;
	});

	// handle delete contract
	$(".component-contracts").delegate(".btn-contractbudget-delete", 'click', function(){

		var msg = 'Are you sure you want to delete this year?';

		if ( !confirm(msg) ) return false;

		// get TR
		var contractbudgetTr = $(this).parents('tr');

		deleteContractBudget(contractbudgetTr);

		return false;
	});

	// handle delete payment
	$(".component-contracts").delegate(".btn-contract-delete", 'click', function(){

		var msg = 'Are you sure you want to delete this contract?';

		if ( !confirm(msg) ) return false;

		var contractDiv = $(this).parents('div.contract');

		deleteContract(contractDiv);

		return false;
	});



});

function createContract() {

	// clone payment template
	var contractDivClone = $('.contract.template').clone();
	contractDivClone.removeClass('template');

	// give contract a unique index
	var new_contract_id = $(".component-contracts").data("index-new-contract-id");
	contractDivClone.data('contract-id', "new-contract-" + new_contract_id);

	// amend contract-level inputs
	contractDivClone.find("input, select, textarea").each(function(){
		var inputName = $(this).attr('name');
		var newName = inputName.replace('{contract_id}', "new-contract-"+new_contract_id);
		$(this).attr('name', newName);
	});

	// remove payment template
	contractDivClone.find('tr.contractbudget').remove();

	// add one payment
	createContractBudget(contractDivClone, 'after');

	// increment component data
	$(".component-contracts").data("index-new-contract-id", new_contract_id+1);

	// get contracts parent div
	var contractsDiv = $('.contracts');

	// append
	contractsDiv.prepend(contractDivClone);

	// animate
	contractDivClone.hide().slideDown();
}

function deleteContractBudget(budgetContractTr) {

	// get contractDiv
	var contractDiv = $(budgetContractTr).parents('div.contract');

	// delete row
	budgetContractTr.remove();

	// update earliest / latest years
	updateContractEarliestLatestYears(contractDiv);

}

function updateContractEarliestLatestYears(contractDiv) {
	var earliestYear = null;
	var latestYear = null;

	$(contractDiv).find('.contractbudget').each(function(){
		var year = $(this).find('input.year').val();

		if (!earliestYear == null || year < earliestYear) {
			earliestYear = year;
		}

		if (!latestYear == null || year > latestYear) {
			latestYear = year;
		}
	});

	// update contract
	$(contractDiv).data('contractbudget-earliest-year', earliestYear);
	$(contractDiv).data('contractbudget-latest-year', latestYear);

}

function deleteContract(contractDiv) {
	// set contract and all payments as deleted
	var deletedInputs = contractDiv.find('input.deleted');
	deletedInputs.val(1);

	// HIDE
	contractDiv.slideUp(function(){

		// if this a contract created in this session (i.e. not already in the DB),
		// don't bother saving anything to the database
		// delete all the fields
		if (deletedInputs.length == 0) {
			$(this).remove();
		}

	});
	
}

function createContractBudget(contractDiv, beforeAfter) {

	// clone payment template
	var contractBudgetTrClone = $('.contract.template tr.contractbudget').clone();

	// get new payment id
	var new_contractbudget_id = $(".component-contracts").data("index-new-contractbudget-id");



	// get component data
	var earliestYear = $(contractDiv).data('contractbudget-earliest-year');
	var latestYear = $(contractDiv).data('contractbudget-latest-year');

	// get new year, update contract data
	if ( !earliestYear ) { // don't test for latest year as they'll both be null or both be not null
		var startDate = $( ".timespan .start .datepicker-placeholder" ).datepicker('getDate');
	console.log(startDate);
		var newYear = +startDate.getFullYear();
	} else if (beforeAfter == 'before') {
		var newYear = earliestYear - 1;
	} else {
		var newYear = +latestYear + 1;
	}


	// update input names
	contractBudgetTrClone.find("input").each(function(){
		
		var contract_id = $(contractDiv).data('contract-id');
		// console.log($(contractDiv));
		var inputName = $(this).attr('name');
		var newName = inputName
						.replace('{contractbudget_id}', "new-contractbudget-"+new_contractbudget_id)
						.replace('{contract_id}', contract_id);

		$(this).attr('name', newName);

	});

	// update year input
	contractBudgetTrClone.find('input.year').val(newYear);

	// and label
	contractBudgetTrClone.find('span.year').text(newYear);

	// increment payment id for new payments
	$(".component-contracts").data("index-new-contractbudget-id", new_contractbudget_id+1)

	// payments
	var contractBudgetsTableBody = $(contractDiv).find('.contractbudgets tbody');

	// append or prepend?
	if (beforeAfter == 'before') {
		contractBudgetsTableBody.prepend(contractBudgetTrClone);
	} else {
		contractBudgetsTableBody.append(contractBudgetTrClone);	
	}


	// update component data
	updateContractEarliestLatestYears(contractDiv);
	

	// animate
	contractBudgetTrClone.hide().fadeIn();

	return newYear;

}





