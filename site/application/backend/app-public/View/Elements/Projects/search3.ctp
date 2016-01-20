<?php echo $this->Html->script('projects/elements/search', array('inline' => false)); ?>
<?php echo $this->Html->css('projects/elements/search', array('inline' => false)); ?>
<?php

$advanced_shown = true; // !! $this->request->query('advanced');

?>

<div class="project-search3">

<?php echo $this->Form->create('Project', array('type' => 'get'));

echo $this->Form->input('action', array(
	'value' => 'search',
	'type' => 'hidden',
));

 ?>




		<fieldset>
			
			
			<div class="advanced <?php echo $advanced_shown ? 'advanced_shown' : ''?>">


				<?php

						echo $this->Form->input('advanced', array(
							'type' => 'hidden',
							'value' => $this->request->query('advanced'),
						));
					?>

				

					<div>
						<?php

							echo $this->Form->input('q', array(
								'label' => false,
								'placeholder' => 'Enter search terms here',
								'value' => $this->request->query('q'),
							));

						?>
					</div>
					
					<div>
					<?php

						echo $this->Form->input('status_id', array(
							'empty' => '--- Select Status ---',
							'options' => $statuses,
							'value' => $this->request->query('status_id'),
						));
					?>
					</div>
					<div>
					<?php

						echo $this->Form->input('likelihood_id', array(
							'empty' => '--- Select Likelihood ---',
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
							'options' => $departments,
							'value' => $this->request->query('department_id'),
						));
					?>
					</div>
					<!-- <div>
					<?php

						echo $this->Form->input('donor_id', array(
							'empty' => '--- Select Donor ---',
							'options' => $donors,
							'value' => $this->request->query('donor_id'),
						));
					?>
					</div> -->
					<div>
					<?php

						
						echo $this->Form->input('owner_user_id', array(
							'label' => 'Budget Holder',
							'empty' => '--- Select Budget Holder ---',
							'options' => $employees,
							'value' => $this->request->query('owner_user_id'),
						));
					?>
					</div>
					<div>
					<?php
						
						
						echo $this->Form->input('territory_id', array(
							'empty' => '--- Select Territory ---',
							'options' => $territories,
							'value' => $this->request->query('territory_id'),
						));
					?>
					</div>
					<div>
					<?php

						echo $this->Form->input('theme_id', array(
							'empty' => '--- Select Theme ---',
							'options' => $themes,
							'value' => $this->request->query('theme_id'),
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
				

				
					<div>
						<?php echo $this->Form->input('start_date', array(
							'value' => $this->request->query('start_date'),
							'label' => "Project Start Date",
							'type' => 'text',
						)); ?>
					</div>
					<div>
						<?php echo $this->Form->input('finish_date', array(
							'value' => $this->request->query('finish_date'),
							'label' => "Project Finish Date",
							'type' => 'text',
						)); ?>
					</div>


					
					
					<div class="submit">
						<input type="submit" value="Search Projects">
						<a class="reset btn" href="#">Reset Form</a>
					</div>
					

				
			</div>
			
			</fieldset>
		</form>

		



	
	</div>