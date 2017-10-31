<?php echo $this->Html->css('resultsframework/approve_result', array('inline' => false)); ?>


<div ng-app="resultsframework" class="approve_result">


	<h1>
		Approve result for <?php echo $result['Project']['title']; ?>
	</h1>

	<div ng-controller="ResultsframeworkApproveController">

		<table>
			<tr>
				<th>Title</th>
				<td><?php echo $result['Result']['title']; ?></td>
			</tr>

			<tr>
				<th>Tell us who you are/who is reporting this result?</th>
				<td><?php echo $result['Result']['reporter']; ?></td>
			</tr>

			<tr>
				<th>Tell us who is this result about: who did something differently as a result of our work?</th>
				<td><?php echo $result['Result']['who']; ?></td>
			</tr>

			<tr>
				<th>Tell us what they did differently (not what activity you did).</th>
				<td><?php echo $result['Result']['what']; ?></td>
			</tr>

			<tr>
				<th>Tell us where or in which environment, and when.</th>
				<td><?php echo $result['Result']['where']; ?></td>
			</tr>

			<tr>
				<th>Tell us why you think this change in practice or relationship is significant.</th>
				<td><?php echo $result['Result']['significance']; ?></td>
			</tr>

			<tr>
				<th>Partner contribution</th>
				<td><?php echo $result['Result']['contribution_partner']; ?></td>
			</tr>

			<tr>
				<th>Alert Contribution</th>
				<td><?php echo $result['Result']['contribution_alert']; ?></td>
			</tr>

			<tr>
				<th>Evidence</th>
				<td><?php echo $result['Result']['evidence']; ?></td>
			</tr>

			<tr>
				<th>Kinds of impact</th>
				<td><?php 
					$impact_names = [];
					foreach($result['Impact'] as $impact) {
						$impact_names[] = $impact['name'];
					}

					echo implode (', ', $impact_names);
				?></td>
			</tr>

			<tr>
				<th>Approved For Publication</th>
				<td>
					<strong>
						<?php echo $result['Result']['publication_approved'] ? "YES" : "NO"; ?>
					</strong>
				</td>
			</tr>

		</table>


		<md-button 
			class="md-raised" 
			ng-click="approvePublication(<?php echo $result['Result']['id']; ?>)"
		>
			Approve for publication by the Communications department
		</md-button>

		<md-button 
			class="md-raised md-warn" 
			ng-click="blockPublication(<?php echo $result['Result']['id']; ?>)"
		>
			Block from publication
		</md-button>

	</div>
</div>

<?php // debug($result); ?>


<!-- App -->
<?php echo $this->Html->script('resultsframework/app'); ?>

<!-- Services -->
<?php echo $this->Html->script('resultsframework/services/DedupeService'); ?>
<?php echo $this->Html->script('resultsframework/services/ResultsFrameworkService'); ?>
<?php echo $this->Html->script('resultsframework/services/FormOptionsService'); ?>
<?php echo $this->Html->script('resultsframework/services/ResultsService'); ?>

<!-- Controllers -->
<?php echo $this->Html->script('resultsframework/controllers/ResultsframeworkApproveController'); ?>