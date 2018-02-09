<h1>A new trip has been submitted</h1>

<!--<p>
	<a href="<?php echo Router::url('/travelapplications/view', true); ?>/<?php echo $travelapplication_id; ?>">
		View on PROMPT
	</a>
</p>-->


<h2>Travel Destination(s)</h2>
<?php 
	// create CSV of destinations
	$destinations = [];
	foreach ($travelapplicationObj->itinerary as $i => $itineraryItem): 
		$destinations[] = $itineraryItem->destination->Territory->name;
	endforeach;
	echo implode(',', $destinations);
?>

<?php echo $this->element('Travelapplications/email/general'); ?>

<?php echo $this->element('Travelapplications/email/applicant'); ?>

<?php echo $this->element('Travelapplications/email/contacts'); ?>

<?php echo $this->element('Travelapplications/email/itinerary'); ?>

<?php echo $this->element('Travelapplications/email/meetings'); ?>

<?php echo $this->element('Travelapplications/email/security'); ?>
