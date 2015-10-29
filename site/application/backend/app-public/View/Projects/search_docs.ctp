
<h2>Document Search</h2>


<p>
	This page allows you to search for all documents stored on the system. Currently, there are very few documents.
</p>

<form action="" method="get">
	
	<?php echo $this->Form->input('action', array('type' => "hidden", 'value' => "search")); ?>
	<?php echo $this->Form->input('q', array('label' => "Document Search Query", 'value' => $this->request->query('data.q'))); ?>
	<input type="submit" value="Search">
</form>


<?php if (isset($searchResults)): ?>

<div class="results">

<h3>Document Search Results</h3>



<?php if ( count($searchResults['fileList']) ): ?>

<?php // debug($searchResults['fileList']); ?>




<table class="table">


<?php foreach ($searchResults['fileList'] as $file):


// work out associated project if any
// if project_id_ID patern exists

preg_match("/project_id_([1-9]*)\w+/", $file->Path, $results);

if (count($results)) {
	$project_id = (int) str_replace('project_id_', '', $results[0]);
} else {
	$project_id = false;
}



 ?>

	<tr>

		<td>
			<?php echo $file->Title; ?>
		</td>

		<td>
			<?php 
			
			// replace c0 tags with strong tags
			$hitHighlightedSummary = $file->HitHighlightedSummary;
			$hitHighlightedSummary = str_replace('<c0>', '<strong>', $hitHighlightedSummary);
			$hitHighlightedSummary = str_replace('</c0>', '</strong>', $hitHighlightedSummary);


			echo $hitHighlightedSummary; 

			?>
		</td>

		<td>
			<a href="<?php echo $file->Path; ?>">Download</a>
		</td>

		<td>

<?php if ($file->ServerRedirectedURL): ?>

			<a href="<?php echo $file->ServerRedirectedURL; ?>">
				Edit
			</a>

<?php endif; // (in_array($extension, array('xls','xlsx','doc','docx',))):

?>
		</td>

		<td>
			<?php if ($project_id): ?>
				<a href="/pdb/projects/view/<?php echo $project_id?>">View Project</a>
			<?php endif; // ($project_id): ?>
		</td>

		<!-- <td>
			<a href="">Delete</a>
		</td> -->

		<!-- <td>
			<a href="">Replace</a>
		</td> -->

	</tr>

<?php endforeach; // ($searchResults['fileList'] as $file): ?>


</table>
<?php else: // (count($searchResults['fileList'])): ?>

<p>No documents found for &quot;<?php echo $this->request->query('data.q'); ?>&quot;</p>

<?php endif; // (count($searchResults['fileList'])): ?>

<?php endif; // (isset($searchResults['fileList'])): ?>


</div>