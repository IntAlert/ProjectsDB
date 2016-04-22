
<table>
<?php

foreach ($leagueTable as $result): 


?>

<tr>
	<td>

		<?php echo ($result[0]['COUNT(`Audit`.`id`)']); ?>

	</td>
	<td>
		<?php echo $result['User']['first_name']; ?>
	</td>
</tr>


<?
endforeach; // ($results as $result): 
?>

</table>