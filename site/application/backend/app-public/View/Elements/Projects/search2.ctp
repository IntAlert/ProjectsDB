<?php echo $this->Html->script('projects/elements/search', array('inline' => false)); ?>
<?php echo $this->Html->css('projects/elements/search', array('inline' => false)); ?>

<div class="project-search2">

<?php echo $this->Form->create('Project', array('type' => 'get')); ?>




		<fieldset>
			<div class="standard">
				<ul class="clearfix">

					<li class="q">
						<?php

							echo $this->Form->input('q', array(
								'label' => false,
								'value' => $this->request->query('q'),
							));

						?>
					</li>
					
					<li class="submit">
						<input type="submit" value="Search Projects">
					</li>
					
				</ul>
				<a class="show-advanced btn" href="#">Show Advanced</a>
				<a class="reset btn" href="#">Reset Form</a>
			</div>

			
			
			
			<div class="advanced">
				<ul class="clearfix">
					
					<li>
					<?php

						echo $this->Form->input('fund_code', array(
							'label' => 'Fund Code',
							'value' => $this->request->query('fund_code'),
						));
					?>
					</li>
					<li>
					<?php

						echo $this->Form->input('status_id', array(
							'empty' => '--- Select Status ---',
							'options' => $statuses,
							'value' => $this->request->query('status_id'),
						));
					?>
					</li>
					<li>
					<?php

						echo $this->Form->input('likelihood_id', array(
							'empty' => '--- Select Likelihood ---',
							'options' => $likelihoods,
							'value' => $this->request->query('likelihood_id'),
						));
					?>
					</li>
					<li>
					<?php

						echo $this->Form->input('programme_id', array(
							'empty' => '--- Select Programme ---',
							'options' => $programmes,
							'value' => $this->request->query('programme_id'),
						));
					?>
					</li>
					<li>
					<?php

						echo $this->Form->input('donor_id', array(
							'empty' => '--- Select Donor ---',
							'options' => $donors,
							'value' => $this->request->query('donor_id'),
						));
					?>
					</li>
					<li>
					<?php

						
						echo $this->Form->input('owner_user_id', array(
							'label' => 'Budget Holder',
							'empty' => '--- Select Budget Holder ---',
							'options' => $employees,
							'value' => $this->request->query('owner_user_id'),
						));
					?>
					</li>
					<li>
					<?php
						
						
						echo $this->Form->input('territory_id', array(
							'empty' => '--- Select Territory ---',
							'options' => $territories,
							'value' => $this->request->query('territory_id'),
						));
					?>
					</li>
					<li>
					<?php

						echo $this->Form->input('theme_id', array(
							'empty' => '--- Select Theme ---',
							'options' => $themes,
							'value' => $this->request->query('theme_id'),
						));
					?>
					</li>

				</ul>
				<table>
					<tr>
						<td>
							<?php echo $this->Form->input('value_from', array(
								'value' => $this->request->query('value_from'),
							)); ?>
						</td>
						<td>
							<?php echo $this->Form->input('value_to', array(
								'value' => $this->request->query('value_to'),
							)); ?>
						</td>
					</tr>
				</table>
			</div>
			
			</fieldset>
		</form>

		



	
	</div>