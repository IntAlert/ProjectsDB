<?php echo $this->Html->script('dashboard/map', array('inline' => false)); ?>

<script type="text/javascript">
	var series = <?php echo json_encode($mapData);?>;
	var year = <?php echo json_encode($year);?>;
</script>


<div id="map" style="width: 100%; height: 475px; position: relative;"></div>


