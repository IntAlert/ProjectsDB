
<div class="project-search-top">
						
	<ul>
		<li class="q">
			<?php

				echo $this->Form->input('q', array(
					'label' => false, //'Query',
					'placeholder' => 'Enter search terms here',
					'value' => $this->request->query('q'),
					'class' => "search-autocomplete",
				));

			?>
		</li>

		<li class="submit">
			
			<input type="submit" value="Search">
			
		</li>
	</ul>
	
</div>