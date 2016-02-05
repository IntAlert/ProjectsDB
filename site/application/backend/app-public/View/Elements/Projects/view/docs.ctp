<?php

debug($fileTree);

?>


<? if (!isset($fileTree)): ?>




<p>Sharepoint docs not available, sorry</p>

<p>You may find the docs <a href="https://intlalert.sharepoint.com/prompt/Documents/Forms/AllItems.aspx?">here</a>.</p>




<? else: // (!isset($fileTree)): ?>




<nav class='subnav'>

	<ul>
		<li>
			<a 
			target="_blank"
			href="https://intlalert.sharepoint.com/prompt/Documents/Forms/AllItems.aspx?RootFolder=<?php echo urlencode($sharepoint_root_folder); ?>">
				View Sharepoint Folder
			</a>
		</li>
	</ul>

</nav>


<h3>Documents</h3>


<!-- printFolder($fileTree); -->
<?php


?>



<table class="table">


<?php foreach ($fileList as $file): ?>

	<tr>

		<td>
			<?php echo $file->Name; ?>
		</td>

		<td>
			<?php echo $file->TimeLastModified; ?>
		</td>

		<td>
			<a href="https://intlalert.sharepoint.com<?php echo $file->ServerRelativeUrl; ?>">Download</a>
		</td>

		<td>

<?php 

	// Show Edit/View links for docx
	$parts = explode('.', $file->Name);
	$extension = $parts[count($parts) - 1 ];

	if (in_array($extension, array('xls','xlsx','doc','docx',))):


?>

			<a href="https://intlalert.sharepoint.com/prompt/_layouts/15/WopiFrame.aspx?sourcedoc={<?php echo $file->UniqueId; ?>}&file=<?php echo urlencode($file->Name); ?>&action=default">
				Edit/View
			</a>

<?php endif; // (in_array($extension, array('xls','xlsx','doc','docx',))):

?>
		</td>

		<!-- <td>
			<a href="">Delete</a>
		</td> -->

		<!-- <td>
			<a href="">Replace</a>
		</td> -->

	</tr>

<?php endforeach; // ($fileList as $file): ?>


</table>

<?php //else: // (count($fileList)): ?>

<p>No documents</p>

<?php // endif; // (count($fileList)): ?>

<?

	function printFolder($folder) {
		echo '<ul>';

		foreach ($folder->Folders->results as $folder) {
			echo '<li>' . $folder->Name . '</li>';
		}

		echo '</ul>';
	}

endif; // (!isset($fileTree)): ?>