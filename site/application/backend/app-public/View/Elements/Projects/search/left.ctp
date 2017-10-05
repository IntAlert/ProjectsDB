
<div class="project-search-left">


		<fieldset>
			
			
			<div class="advanced advanced_shown">


				<?php

						echo $this->Form->input('advanced', array(
							'type' => 'hidden',
							'value' => $this->request->query('advanced'),
						));
					?>


					<div>
					<?php

						echo $this->Form->input('donor_id', array(
							// 'empty' => '--- Select Donor ---',
							'label' => 'Donor',
							'multiple' => true,
							'options' => $donors,
							'value' => $this->request->query('donor_id'),
						));
					?>

					</div>
					
					
					<div>
					<?php

						echo $this->Form->input('status_id', array(
							'multiple' => true,
							'options' => $statuses,
							'value' => $this->request->query('status_id'),
						));
					?>
					</div>
					<div>
					<?php

						echo $this->Form->input('likelihood_id', array(
							'empty' => '--- Select Likelihood ---',
							'label' => false,
							'options' => $likelihoods,
							'value' => $this->request->query('likelihood_id'),
						));
					?>
					</div>

					<div>
					<?php

						echo $this->Form->input('department_id', array(
							'label' => 'Programme',
							'empty' => '--- Select Programme ---',
							'label' => false,
							'options' => $departments,
							'value' => $this->request->query('department_id'),
						));
					?>
					</div>

					<div>
					<?php

						echo $this->Form->input('secondary_department_id', array(
							'label' => 'Programme',
							'empty' => '--- Select Secondary Programme ---',
							'label' => false,
							'options' => $departments,
							'value' => $this->request->query('secondary_department_id'),
						));
					?>
					</div>

					
					<div>
					<?php

						
						echo $this->Form->input('owner_user_id', array(
							'label' => 'Budget Holder',
							'empty' => '--- Select Budget Holder ---',
							'label' => false,
							'options' => $budget_holders,
							'value' => $this->request->query('owner_user_id'),
						));
					?>
					</div>
					<div>
					<?php
						
						
						echo $this->Form->input('territory_id', array(
							'empty' => '--- Select Territory/Sub-programme ---',
							'label' => false,
							'options' => $territories,
							'value' => $this->request->query('territory_id'),
						));
					?>
					</div>
					<div>
					<?php

						echo $this->Form->input('pathway_id', array(
							'empty' => '--- Select Strategic Pathway ---',
							'label' => false,
							'options' => $pathways,
							'value' => $this->request->query('pathway_id'),
						));
					?>
					</div>

					<div>
					<?php

						echo $this->Form->input('theme_id', array(
							'empty' => '--- Select Theme ---',
							'label' => false,
							'options' => $themes,
							'value' => $this->request->query('theme_id'),
						));
					?>
					</div>


					<div>
					<?php

						echo $this->Form->input('contractcategory_id', array(
							'empty' => '--- Select Contract Category ---',
							'label' => false,
							'options' => $contractcategories,
							'value' => $this->request->query('contractcategory_id'),
						));
					?>
					</div>

					<div>
					<?php

						echo $this->Form->input('commercial_tender', array(
							'empty' => '--- Contract procured through a commercial tender ---',
							'label' => false,
							'options' => array(
								'unknown' => 'Don\'t know',
								'yes' => 'Yes',
								'no' => 'No',
							),
							'value' => $this->request->query('commercial_tender'),
						));
					?>
					</div>

					<div>
					<?php

						echo $this->Form->input('framework_id', array(
							'empty' => '--- Select Donor Framework ---',
							'label' => false,
							'options' => $frameworks,
							'value' => $this->request->query('framework_id'),
						));
					?>
					</div>

					<div>
					<?php

						echo $this->Form->input('solicited_proposal', array(
							'label' => false,
							'options' => array(
								-1 => '--- Select Opportunity Type ---',
								0 => 'Unsolicted Opportunity',
								1 => 'Solicited/Published Opportunity',
							),
							'value' => $this->request->query('solicited_proposal'),
						));
					?>
					</div>



					<div>



					<?php

						echo $this->Form->input('fund_code', array(
							'label' => 'Fund Code',
							'value' => $this->request->query('fund_code'),
						));
					?>
					</div>

			
				
					<div>
						<?php echo $this->Form->input('value_from', array(
							'value' => $this->request->query('value_from'),
							'label' => "Project Value from (GBP)",
						)); ?>
					</div>
					<div>
						<?php echo $this->Form->input('value_to', array(
							'value' => $this->request->query('value_to'),
							'label' => "Project Value to (GBP)",
						)); ?>
					</div>
				

				

					<div class="date-block clearfix">

						<!-- Start Date Modifier -->
						<div class="modifier">
							<?php echo $this->Form->input('start_date_modifier', array(
								'value' => $this->request->query('start_date_modifier'),
								'label' => "Project Start Date",
								'type' => 'select',
								'options' => [
									'before' => 'Starting before',
									'after' => 'Starting after',
								]
							)); ?>
						</div>

						<!-- Start Date -->
						<div class="date">
							<?php echo $this->Form->input('start_date', array(
								'value' => $this->request->query('start_date'),
								'label' => false,
								'type' => 'text',
							)); ?>
						</div>

					</div>

					


					<div class="date-block clearfix">

						<!-- Finish Date Modifier -->
						<div class="modifier">
							<?php echo $this->Form->input('finish_date_modifier', array(
								'value' => $this->request->query('finish_date_modifier'),
								'label' => "Project Finish Date",
								'options' => [
									'after' => 'Finishing after',
									'before' => 'Finishing before',
								]
							)); ?>
						</div>

						<!-- Finish Date -->
						<div class="date">
							<?php echo $this->Form->input('finish_date', array(
								'value' => $this->request->query('finish_date'),
								'label' => false,
								'type' => 'text',
							)); ?>
						</div>

					</div>


					
					
					<div>
						<a class="reset btn" href="#">Reset Form</a>
					</div>
					

				
			</div>
			
			</fieldset>
		

	
	</div>
