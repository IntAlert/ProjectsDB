$(function(){



	// persist comparisson data
	$('.garlic-persist').garlic({
		destroy: false,
		getPath: function ( $elem ) {
			var path = selectedYear + '-' + $elem.attr( 'name' );
			return path;
		}
	});

	// handle print
	$('nav a.print').click(function(){
		window.print();
		return false;
	})



	// keep totals up to date
	$('table.pipeline').each(function(){


		var $pipeline = $(this),
			$datepicker = $pipeline.find('.datepicker'),
			$datepickerNice = $pipeline.find('.datepicker-nice'),
			$inputs = $pipeline.find('.department-cfhl, .department-budget'),
			$budgetTotal = $pipeline.find('.department-budget-total'),
			$cfhlTotal = $pipeline.find('.department-cfhl-total'),
			$cfhlTotalPercentage = $pipeline.find('.department-cfhl-total-percentage'),
			uniquePipelineIdentifier = $pipeline.hasClass('this-year') ? 'this_year' : 'next_year'

		var updateTotals = function() {
			
			// build totals
			var department_budget_total = 0;
			$pipeline.find("input.department-budget").each(function(){
				department_budget_total += Number( $(this).val() );
			});

			var department_cfhl_total = 0;
			$pipeline.find("input.department-cfhl").each(function(){
				department_cfhl_total += Number( $(this).val() );
			});

			if (department_budget_total > 0) {
				var department_cfhl_percentage = Math.round(100 * department_cfhl_total/department_budget_total)
			} else {
				department_cfhl_percentage = 0
			}
			

			$budgetTotal.text($.number(department_budget_total)); // comma-formatted
			$cfhlTotal.text($.number(department_cfhl_total)); // comma-formatted
			$cfhlTotalPercentage.text(department_cfhl_percentage);

		}

		var updatePercentages = function() {

			var department_budgets = {}
			var department_cfhls = {}

			// collect budget values
			$pipeline.find("input.department-budget").each(function(){

				var department_id = $(this).data('department-id')
				var department_budget = $(this).val()
				department_budgets[department_id] = department_budget

			});

			// collect cfhl values
			$pipeline.find("input.department-cfhl").each(function(){

				var department_id = $(this).data('department-id')
				var department_cfhl = $(this).val()
				department_cfhls[department_id] = department_cfhl

			});



			// update slave and master
			$pipeline.find(".department-cfhl-percentage").each(function(){

				var department_id = $(this).data('department-id')
				if (department_budgets[department_id] > 0) {
					var department_chfl_percentage = Math.round(100 * department_cfhls[department_id] / department_budgets[department_id])	
				} else {
					var department_chfl_percentage = 0
				}
				
				$(this).text(department_chfl_percentage)

			});

		}

		var niceDateUpdater = function(dateText) {
			var niceDate = Date.parse(dateText).toString('MMMM d, yyyy')
			$pipeline.find(".datepicker-nice").text(niceDate)
		}

		var saveComparisonDate = function(dateText) {
			localStorage[selectedYear + '-comparisson-date-' + uniquePipelineIdentifier] = dateText
		}

		var getComparisonDate = function() {
			return localStorage[selectedYear + '-comparisson-date-' + uniquePipelineIdentifier]
		}

		// activate datepicker 
		$pipeline.find('.datepicker').datepicker({
			dateFormat: 'yy-mm-dd',
			onSelect: function(dateText){
				niceDateUpdater(dateText)
				saveComparisonDate(dateText)
			}
		});

		// open datepicker on click
		$pipeline.find(".datepicker-nice").click(function(){
			$pipeline.find('.datepicker').datepicker('show')
			return false
		})

		// update comparisson nice date if one is already set	
		if ( getComparisonDate() ) {
			var dateText = getComparisonDate()
			niceDateUpdater(dateText)
			$pipeline.find( 'input.comparisson-date' ).val(dateText) // because garlic doesn't work on hidden fields
		}



		// keep totals and percentages up to date
		$inputs.bind('keyup, change', function(){
			updatePercentages();
			updateTotals();
		})

		// initialise percentages and totals
		updatePercentages();
		updateTotals();


	})


});

