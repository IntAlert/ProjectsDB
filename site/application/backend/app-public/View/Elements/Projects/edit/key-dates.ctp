<?php 

echo $this->Html->script('projects/elements/key-dates', array('inline' => false)); 

// for convenience
$project = $this->request->data;

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
					Title
				</th>

				<th>
					Date
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
					<a class="btn btn-projectdate-delete" href="#">
						Delete
					</a>
				</td>
			</tr>

<?php endforeach; // ($project['Projectdate'] as $projectdate): ?>
<?php endif; //(!empty($project['Projectdate'])): ?>

			<tr class="template">
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
					<a class="btn btn-projectdate-delete" href="#">
						Delete
					</a>
				</td>
			</tr>
		</tbody>
		
	</table>
</div>
