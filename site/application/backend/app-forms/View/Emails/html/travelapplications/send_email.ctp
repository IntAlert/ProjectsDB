<h1>A new travel application has been submitted</h1>

<p>
	<a href="<?php echo Router::url('/travelapplications/view', true); ?>/<?php echo $travelapplication_id; ?>">
		View on PROMPT
	</a>
</p>


<h2>Summary</h2>


<?php echo $this->element('Travelapplications/email/general'); ?>

<?php echo $this->element('Travelapplications/email/applicant'); ?>

<?php echo $this->element('Travelapplications/email/contacts'); ?>

<?php echo $this->element('Travelapplications/email/itinerary'); ?>

<?php echo $this->element('Travelapplications/email/meetings'); ?>

<?php echo $this->element('Travelapplications/email/security'); ?>

<?php echo $this->element('Travelapplications/email/checklist'); ?>