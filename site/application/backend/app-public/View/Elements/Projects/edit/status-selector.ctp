<?

echo $this->Html->script('projects/elements/status-selector', array('inline' => false));
echo $this->Html->css('projects/elements/status-selector', array('inline' => false));

?>


<?
		echo $this->Form->input('status_id', array(
			'legend' => 'Status',
			'type' => 'radio',
			'div' => 'input radio status',
			'tooltip' => 'Please check the main box which applies',
		));

?>

<?
		echo $this->Form->input('likelihood_id', array(
			'legend' => 'Likelihood',
			'type' => 'radio',
			'div' => 'input radio likelihood',
			'tooltip' => 'Please check the main box which applies',
		));
		
?>