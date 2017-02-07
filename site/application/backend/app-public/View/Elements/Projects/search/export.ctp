<div class="export">
	<a class="btn" href="<?php echo $csv_download_link; ?>">
		<?php 

		echo $this->Paginator->counter(array(
			'format' => __('Download {:count} projects in CSV')
		));

		?>
	</a>
</div>