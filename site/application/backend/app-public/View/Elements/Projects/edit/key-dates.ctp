<?php 

echo $this->Html->script('projects/elements/key-dates', array('inline' => false)); 

// for convenience
$project = $this->request->data;


$keyDateOptions = array(
	"donor report", 
	"general", 
	"extension end date", 
	"mid term evaluation", 
	"final evaluation", 
	"audit",
	"other",
);


$reminderFrequencyOptions = array(
	-1 => "Never", 
	1 => "Daily", 
	7 => "Weekly",
	14 => "Fortnightly",
	28 => "Monthly",
);

?>


<h3>
	Key Dates
</h3>


<div class="component-key-dates">

	<div class="instruction-block">
		<p>
		Use the <strong>Key Dates</strong> section to record important dates such as reporting due dates or 
		original end date of project date (when the project end date has been extended).
		</p>
	</div>

	<div class="no-dates-message">
		No key dates yet. <a class="btn btn-projectdate-add" href="#">Add a key date</a>.
	</div>

	<table>
		<thead>
			<tr>
				<th>
					Type
				</th>

				<th>
					Title
				</th>

				<th>
					Date
				</th>

				<th>
					Remind By
				</th>

				<th>
					Reminder Frequency
				</th>

				<th>
					Complete?
				</th>

				<th>
					<a class="btn btn-projectdate-add" href="#">
						Add date
					</a>
				</th>
			</tr>
		</thead>

		<tbody>
<?php if(!empty($project['Projectdate'])): ?>
<?php foreach($project['Projectdate'] as $projectdate): ?>
			<tr>
				<td>
					<?php echo $this->Form->input('Projectdate.'.$projectdate['id'].'.type', array(

							'id' => false,
							'value' => $projectdate['type'],
							'required' => true,
							'type' => 'select',
							'label' => false,
							'class' => 'project-date-type',
							'options' => $keyDateOptions,

						)); ?>
				</td>

				<td>
					<?php echo $this->Form->input('Projectdate.'.$projectdate['id'].'.title', array(

							'id' => false,
							'value' => $projectdate['title'],
							'required' => true,
							'type' => 'text',
							'label' => false,
							'class' => 'project-date-title',

						)); ?>
				</td>

				<td>
					<?php echo $this->Form->input('Projectdate.'.$projectdate['id'].'.date', array(

							'id' => false,
							'required' => true,
							'value' => (new DateTime($projectdate['date']))->format('d/m/Y'),
							'type' => 'text',
							'label' => false,
							'class' => 'project-date',

						)); ?>
				</td>

				<td>
					<?php echo $this->Form->input('Projectdate.'.$projectdate['id'].'.remind_by', array(

							'id' => false,
							'required' => true,
							'value' => (new DateTime($projectdate['remind_by']))->format('d/m/Y'),
							'type' => 'text',
							'label' => false,
							'class' => 'project-date-remind-by',

						)); ?>
				</td>

				<td>
					<?php echo $this->Form->input('Projectdate.'.$projectdate['id'].'.reminder_frequency_days', array(

							'id' => false,
							'required' => true,
							'value' => $projectdate['reminder_frequency_days'],
							'type' => 'select',
							'label' => false,
							'options' => $reminderFrequencyOptions,
							'class' => 'project-reminder-freq',

						)); ?>
				</td>

				<td>
					<?php echo $this->Form->input('Projectdate.'.$projectdate['id'].'.completed', array(

							'id' => false,
							'value' => 1,
							'type' => 'checkbox',
							'checked' => $projectdate['completed'],
							'label' => false,
							'class' => 'project-date-completed',

						)); ?>
				</td>

				<td>
					<a class="btn btn-projectdate-delete" href="#">
						Delete
					</a>
				</td>
			</tr>

<?php endforeach; // ($project['Projectdate'] as $projectdate): ?>
<?php endif; //(!empty($project['Projectdate'])): ?>

			<tr class="template">
				<td>
					<?php echo $this->Form->input('Projectdate.{projectdate_id}.type', array(

							'id' => false,
							'value' => '',
							'required' => true,
							'type' => 'select',
							'options' => $keyDateOptions,
							'label' => false,
							'class' => 'project-date-type',

						)); ?>
				</td>

				<td>
					<?php echo $this->Form->input('Projectdate.{projectdate_id}.title', array(

							'id' => false,
							'value' => '',
							'required' => true,
							'type' => 'text',
							'label' => false,
							'class' => 'project-date-title',

						)); ?>
				</td>

				<td>
					<?php echo $this->Form->input('Projectdate.{projectdate_id}.date', array(

							'id' => false,
							'required' => true,
							'value' => date('d/m/Y'),
							'type' => 'text',
							'label' => false,
							'class' => 'project-date',

						)); ?>
				</td>

				<td>
					<?php echo $this->Form->input('Projectdate.{projectdate_id}.remind_by', array(

							'id' => false,
							'required' => true,
							'value' => date('d/m/Y'),
							'type' => 'text',
							'label' => false,
							'class' => 'project-date-remind-by',

						)); ?>
				</td>
				
				<td>
					<?php echo $this->Form->input('Projectdate.{projectdate_id}.reminder_frequency_days', array(

							'id' => false,
							'required' => true,
							'value' => '',
							'type' => 'select',
							'options' => $reminderFrequencyOptions,
							'label' => false,
							'class' => 'project-remind-freq',

						)); ?>
				</td>

				<td>
					<?php echo $this->Form->input('Projectdate.{projectdate_id}.completed', array(

							'id' => false,
							'value' => 0,
							'type' => 'checkbox',
							'label' => false,
							'class' => 'project-date-completed',

						)); ?>
				</td>

				<td>
					<a class="btn btn-projectdate-delete" href="#">
						Delete
					</a>
				</td>
			</tr>
		</tbody>
		
	</table>
</div>
