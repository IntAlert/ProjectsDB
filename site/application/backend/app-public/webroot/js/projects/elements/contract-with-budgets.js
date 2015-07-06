$(function(){


	// initalise indexes for any new payments or contracts
	$(".component-contracts").data("index-new-contract-id", 0);
	$(".component-contracts").data("index-new-contractbudget-id", 0);

	// handle add contractbudget
	$(".component-contracts").delegate(".btn-contractbudget-add-after", 'click', function(){
	
		var contractDiv = $(this).parents('div.contract');

		var newYear = createContractBudget(contractDiv, 'after');

		$(".component-contracts").trigger('fields-added');

		return false;

	});

	$(".component-contracts").delegate(".btn-contractbudget-add-before", 'click', function(){
	
		var contractDiv = $(this).parents('div.contract');

		var newYear = createContractBudget(contractDiv, 'before');

		$(".component-contracts").trigger('fields-added');

		return false;

	});



	// handle add contract
	$(".component-contracts").delegate(".btn-contract-add", 'click', function(){

		createContract();

		$(".component-contracts").trigger('fields-added');

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

	// handle expenditure update, update total contract value
	$(".component-contracts").delegate(
		".value_donor_currency, .value_gbp", 
		'keyup', 
		updateContractBudgetTotals
	);

	// update totals on project value change
	$("#ProjectValueRequired").keyup(updateContractBudgetTotals);

	// update totals, as above, on page load
	updateContractBudgetTotals();
	
	// activate buttons
	$( ".btn-contract-add" ).button({
      icons: {
        primary: "ui-icon-plus"
      }
    })

    // make contract buttons attractive
    activateContractButtons();

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
	updateContractBudgetTotals();

}

function updateContractEarliestLatestYears(contractDiv) {
	var earliestYear = null;
	var latestYear = null;

	$(contractDiv).find('.contractbudget').each(function(){
		var year = $(this).find('input.year').val();

		if (!earliestYear || year < earliestYear) {
			earliestYear = year;
		}

		if (!latestYear || year > latestYear) {
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

	console.log(earliestYear);
	console.log(latestYear);

	// get new year, update contract data
	if ( !earliestYear ) { // don't test for latest year as they'll both be null or both be not null
		var startDate = $( ".timespan .start .datepicker-placeholder" ).datepicker('getDate');
	
		var newYear = +startDate.getFullYear();
	} else if (beforeAfter == 'before') {
		var newYear = earliestYear - 1;
	} else {
		var newYear = +latestYear + 1;
	}


	// update input names
	contractBudgetTrClone.find("input").each(function(){
		
		var contract_id = $(contractDiv).data('contract-id');
		
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


function updateContractBudgetTotals() {

	var contracts_grand_total_gbp = 0;

	$(".component-contracts div.contract").each(function(){
		var contractDiv = $(this);
		// DONOR CURRENCY
		var total_value_donor_currency = 0;
		contractDiv
			.find('.value_donor_currency')
			.each(function(){
				total_value_donor_currency += Number($(this).val());
			});

		// GBP
		var total_value_gbp = 0;
		contractDiv
			.find('.value_gbp')
			.each(function(){
				total_value_gbp += Number($(this).val());
			});

		// update contract totals
		$(contractDiv.find(".total_value_donor_currency")).text(total_value_donor_currency);
		$(contractDiv.find(".total_value_gbp")).text(total_value_gbp);

		contracts_grand_total_gbp += total_value_gbp;

		
	});

	// update grand total for all contracts
	$(".total-contracts-value .value_gbp").text(contracts_grand_total_gbp);

	// update shortfall
	var shortfall = Number($("#ProjectValueRequired").val()) - contracts_grand_total_gbp;
	$(".shortfall .value_gbp").text(shortfall);
	
}


function activateContractButtons() {

	$(".contract .btn-contract-add").button({
	  icons: {
	    primary: "ui-icon-plus"
	  }
	});

	$(".contract .btn-contractbudget-add-before").button({
	  icons: {
	    primary: "ui-icon-plus"
	  }
	});

	$(".contract .btn-contractbudget-add-after").button({
	  icons: {
	    primary: "ui-icon-plus"
	  }
	});

	$(".contract .btn-contractbudget-delete").button({
	  icons: {
	    primary: "ui-icon-closethick"
	  },
	  'text' : false
	});

	$(".contract .btn-contract-delete").button({
	  icons: {
	    primary: "ui-icon-closethick"
	  }
	});

		
}




