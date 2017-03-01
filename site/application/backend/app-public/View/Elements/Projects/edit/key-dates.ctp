<?php 

echo $this->Html->script('projects/elements/key-dates', array('inline' => false)); 

// for convenience
$project = $this->request->data;

?>


<h3>
	Key Dates
</h3>


<div class="component-key-dates">
	<table>
		<thead>
			<tr>
				<th>
					Date
				</th>

				<th>
					Title
				</th>

				<th>
					<a class="btn btn-projectdate-add" href="#">
						Add
					</a>
				</th>
			</tr>
		</thead>

		<tbody>

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
