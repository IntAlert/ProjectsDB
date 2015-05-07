
<ul>

<?php for ($year=$firstYear; $year <= $thisYear; $year++): ?>


<li>
	<a href="/pdb/payments/pipeline/<?php echo $year; ?>">
		<?php echo $year; ?>
	</a>
</li>



<?php endfor; // ($year=$firstYear; $year < $firstYear; $year++): ?>

</ul>