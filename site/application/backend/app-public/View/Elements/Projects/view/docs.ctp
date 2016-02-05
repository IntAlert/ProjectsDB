<?php

// debug($fileTree);


?>


<? if (!isset($fileTree)): ?>

<p>Sharepoint docs not available, sorry</p>

<p>You may find the docs <a href="https://intlalert.sharepoint.com/prompt/Documents/Forms/AllItems.aspx?">here</a>.</p>




<? else: // (!isset($fileTree)):




// get folder names and reorder according to name
// SP API is terrible

$folders = [];

foreach ($fileTree->Folders->results as $folder):




	$folders[$folder->Name] = array(
		'name' => $folder->Name,
		'uri' => 'https://intlalert.sharepoint.com/prompt/Documents/Forms/AllItems.aspx?RootFolder=' . rawurlencode($sharepoint_root_folder . '/' . $folder->Name),
	);

endforeach; // ($fileTree->Folders->results as $folder):

ksort($folders);

 ?>




<h3>
	<a 
			target="_blank"
			href="https://intlalert.sharepoint.com/prompt/Documents/Forms/AllItems.aspx?RootFolder=<?php echo urlencode($sharepoint_root_folder); ?>">
			Documents
	</a>
</h3>



<table class="table">


<?php foreach ($folders as $folder): ?>

	<tr>

		<td>
			<?php echo $folder['name']; ?>
		</td>

		<td>
			<a 
				href="<?php echo $folder['uri']; ?>" 
				target="_blank"
			>
				View Folder
			</a>
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


<? endif; // (!isset($fileTree)): ?>