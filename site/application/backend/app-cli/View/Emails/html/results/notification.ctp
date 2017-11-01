<h1>A result needs approval for publication</h1>

<p>
	The following result has been submitted on PROMPT. Please click the link at the bottom of this email to approve the result for publication by the Communications department.
</p>


<table width="100%">

	<tr>
		<th style="text-align:left">
			Project Name
		</th>

		<td>
			<?php echo $result['Project']['title']; ?>
		</td>
	</tr>

	<tr>
		<th style="text-align:left">Title</th>
		<td><?php echo $result['Result']['title']; ?></td>
	</tr>

	<tr>
		<th style="text-align:left">Tell us who you are/who is reporting this result?</th>
		<td><?php echo $result['Result']['reporter']; ?></td>
	</tr>

	<tr>
		<th style="text-align:left">Tell us who is this result about: who did something differently as a result of our work?</th>
		<td><?php echo $result['Result']['who']; ?></td>
	</tr>

	<tr>
		<th style="text-align:left">Tell us what they did differently (not what activity you did).</th>
		<td><?php echo $result['Result']['what']; ?></td>
	</tr>

	<tr>
		<th style="text-align:left">Tell us where or in which environment, and when.</th>
		<td><?php echo $result['Result']['where']; ?></td>
	</tr>

	<tr>
		<th style="text-align:left">Tell us why you think this change in practice or relationship is significant.</th>
		<td><?php echo $result['Result']['significance']; ?></td>
	</tr>

	<tr>
		<th style="text-align:left">Partner contribution</th>
		<td><?php echo $result['Result']['contribution_partner']; ?></td>
	</tr>

	<tr>
		<th style="text-align:left">Alert Contribution</th>
		<td><?php echo $result['Result']['contribution_alert']; ?></td>
	</tr>

	<tr>
		<th style="text-align:left">Evidence</th>
		<td><?php echo $result['Result']['evidence']; ?></td>
	</tr>

	<tr>
		<th style="text-align:left">Kinds of impact</th>
		<td><?php 
			$impact_names = [];
			foreach($result['Impact'] as $impact) {
				$impact_names[] = $impact['name'];
			}

			echo implode (', ', $impact_names);
		?></td>
	</tr>

	<tr>
		<th style="text-align:left">Approved For Publication</th>
		<td>
			<strong>
				<?php echo $result['Result']['publication_approved'] ? "YES" : "NO"; ?>
			</strong>
		</td>
	</tr>

</table>

<p>If you <strong>DO NOT</strong> want this result to be publically available, you do not need to do anything. Results are marked as <strong>not approved for publication</strong> by default.</p>

<p>
	<a href="http://staging-prompt.intalert.org/forms/resultsframework/approveResult/<?php echo $result['Result']['id'];?>">
	http://staging-prompt.intalert.org/forms/resultsframework/approveResult/<?php echo $result['Result']['id'];?>
	</a>
</p>
