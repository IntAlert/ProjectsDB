<div class="project-activity block">
	<h3>Project Activity</h3>
	
	<ul>
		<? foreach ($project_activity as $activity):?>
		<li>

			<p>
				<strong>
					<?php echo $activity['User']['name']; ?>
				</strong>

				<?php switch($activity['Audit']['event']) {

					case "EDIT":
						$action = 'updated';
					break;

					case "CREATE":
						$action = 'created';
					break;

					case "READ":
						$action = 'read';
					break;

					default:
						$action = $activity['Audit']['event'];



				}

				echo $action; 

				?>


				this project
				<br>
				<em>
					<?php echo $this->Time->timeAgoInWords($activity['Audit']['created'], array('format' => 'F jS, Y')); ?>
				</em>
			</p>
		</li>
		<? endforeach; ?>

	</ul>

</div>
