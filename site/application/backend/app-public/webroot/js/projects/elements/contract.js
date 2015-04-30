$(function(){


	// initalise indexes for any new payments or contracts
	$(".component-contracts").data("index-new-contract-id", 0);
	$(".component-contracts").data("index-new-payment-id", 0);


	// handle parent form submission, remove templates
	$(".component-contracts").parents('form').submit(function(){
		$(".component-contracts .template").remove();
	});

	// handle add payment
	$(".component-contracts").delegate(".btn-payment-add", 'click', function(){
	
		var contractDiv = $(this).parents('div.contract');

		createPayment(contractDiv);

		return false;

	});

	// handle add contract
	$(".component-contracts").delegate(".btn-contract-add", 'click', function(){

		createContract();

		return false;
	});

	// handle delete contract
	$(".component-contracts").delegate(".btn-payment-delete", 'click', function(){

		var msg = 'Are you sure you want to delete this payment?';

		if ( !confirm(msg) ) return false;

		var paymentTr = $(this).parents('tr');

		deleteContract(paymentTr);

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
	contractDivClone.find("input, select").each(function(){
		var inputName = $(this).attr('name');
		var newName = inputName.replace('{contract_id}', "new-contract-"+new_contract_id);
		$(this).attr('name', newName);
		
	});

	// remove payment template
	contractDivClone.find('tr.payment').remove();

	// add one payment
	createPayment(contractDivClone);

	// increment component data
	$(".component-contracts").data("index-new-contract-id", new_contract_id+1);

	// get contracts parent div
	var contractsDiv = $('.contracts');

	// append
	contractsDiv.prepend(contractDivClone);

	// animate
	contractDivClone.hide().slideDown();
}

function deletePayment(paymentTr) {

	// set deleted
	var deletedInput = paymentTr.find('input.deleted');
	deletedInput.val(1);

	// hide row
	paymentTr.fadeOut();
}

function deleteContract() {
	// set contract and all payments as deleted
	var deletedInputs = contractDiv.find('input.deleted');
	deletedInputs.val(1);
	
	// hide row
	contractDiv.slideUp();
}

function createPayment(contractDiv) {

	// clone payment template
	var paymentTrClone = $('.contract.template tr.payment').clone();

	// get new payment id
	var new_payment_id = $(".component-contracts").data("index-new-payment-id");

	// update input names
	paymentTrClone.find("input").each(function(){
		
		var contract_id = $(contractDiv).data('contract-id');
		console.log($(contractDiv));
		var inputName = $(this).attr('name');
		var newName = inputName
						.replace('{payment_id}', "new-payment-"+new_payment_id)
						.replace('{contract_id}', contract_id);

		$(this).attr('name', newName);

		
	});

	// increment payment id for new payments
	$(".component-contracts").data("index-new-payment-id", new_payment_id+1)

	// payments
	var paymentsTableBody = $(contractDiv).find('.payments tbody');

	// append
	paymentsTableBody.append(paymentTrClone);

	// animate
	paymentTrClone.hide().fadeIn();
}