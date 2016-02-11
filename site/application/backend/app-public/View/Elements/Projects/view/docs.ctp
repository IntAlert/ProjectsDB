<?php

// debug($fileTree);

// define tool tips for project folders
$folder_tooltips = array(
    '1 Tender Documents' => 
    	'This includes all announcement and Terms of Reference documents published by donors at all stages - for example Call for Expression of Interest, Call for Proposals, Pre-Qualification Questionnaire, Invitiation to Tender, etc.',
    '2 Workplans' => 
    	'',
    '3 Research and Background' => 
    	'',
    '4 Communications' => 
    	'',
    '5 Draft Proposal Documents' => 
    	'',
    '6 Submitted Proposal Documents' => 
    	'',
    '7 Donor Feedback' => 
    	'',
    '8 Partnership' => 
    	'',
    'P1 Contract' => 
    	'',
    'P2 Project Inception' => 
    	'',
    'P3 Budget and Finance' => 
    	'',
    'P4 Donor Reporting' => 
    	'',
    'P5 Monitoring & Evaluation' => 
    	'',
);




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
		'tooltip' => (isset($folder_tooltips[$folder->Name]) ? $folder_tooltips[$folder->Name] : false),
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
			
			<?php if ($folder['tooltip']) {
				echo $this->Tooltip->element($folder['tooltip']);
			} ?>

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