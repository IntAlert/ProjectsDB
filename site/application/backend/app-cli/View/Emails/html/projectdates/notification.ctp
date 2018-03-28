<h1>Project Key Date Reminder</h1>

<table width="100%">
	<tr>
		<th style="text-align:left">
			Project Name
		</th>

		<td>
			<?php echo $projectdatenotification['Project']['title']; ?>
		</td>
	</tr>


	<tr>
		<th style="text-align:left">
			Key Date Type
		</th>

		<td>
			<?php echo $projectdatenotification['Projectdate']['type']; ?>
		</td>
	</tr>

	<tr>
		<th style="text-align:left">
			Key Date Title
		</th>

		<td>
			<?php echo $projectdatenotification['Projectdate']['title']; ?>
		</td>
	</tr>


	<tr>
		<th style="text-align:left">
			Due date
		</th>

		<td>
			<?php echo $projectdatenotification['Projectdate']['date']; ?>
		</td>
	</tr>

</table>


<p>
	In order to stop these notifications, please visit the project page and mark this date as complete.

	You can visit the project page here:
	<a href="https://prompt.intalert.org/pdb/projects/view/<?php echo $projectdatenotification['Projectdatenotification']['project_id'];?>">
		https://prompt.intalert.org/pdb/projects/view/<?php echo $projectdatenotification['Projectdatenotification']['project_id'];?>
	</a>
</p>
