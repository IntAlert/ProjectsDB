<ul class="export">
	
	<li>
		<a class="btn" href="<?php echo $csv_download_link_contracts; ?>">
			<?php 

			echo $this->Paginator->counter(array(
				'format' => __('Download contracts in CSV')
			));

			?>
		</a>
	</li>

	<li>
		<a class="btn" href="<?php echo $csv_download_link_projects; ?>">
			<?php 

			echo $this->Paginator->counter(array(
				'format' => __('Download projects in CSV')
			));

			?>
		</a>
	</li>

</ul>