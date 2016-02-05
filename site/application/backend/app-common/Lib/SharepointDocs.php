<?php
App::uses('HttpSocket', 'Network/Http');

class SharepointDocs {

	private $access_token = false;
    private $refresh_token = false;
	private $api_base = 'https://intlalert.sharepoint.com/prompt/_api/web/';
    private $api_search_base = 'https://intlalert.sharepoint.com/prompt/_api/search/postquery';
	private $web_base = 'https://intlalert.sharepoint.com/prompt/Documents/Forms/AllItems.aspx?RootFolder=%2Fprompt%2F';

    


	public function __construct($user_id, &$Office365userModel) { // model passed by reference

        // store model
        $this->Office365user = &$Office365userModel;

        // get tokens
        $result = $this->Office365user->findByUserId($user_id);

    
        // always refresh
        $tokens = $this->refreshTokens($result['Office365user']['sharepoint_refresh_token']);
        $Office365userModel->updateSharepointTokens($user_id, $tokens);

        $this->access_token = $tokens['access_token'];
        $this->refresh_token = $tokens['refresh_token'];
        
	}

	private function createSocket() {

        $data = array(
            "api-version" => "1.5"
        );

        $socket = new HttpSocket(array(
            'ssl_verify_host' => false
        ));

        return $socket;

    }

    private function createOptions($headers = array()) {

    	if (!$this->access_token) {
			throw new Exception("No access token", 1);
		}

		// Default options
        $options = array( 
            'header' => array( 
                'Authorization' => 'Bearer ' . $this->access_token,
                'Content-Type' => 'text/plain;odata=verbose',
                'Accept' => 'application/json;odata=verbose',
            ),
        );

        // merge passed options
        $options['header'] = array_merge($options['header'], $headers);

        return $options;


    }

    function createTemplateFolders($project_id, $ensureFoldersCreated = true) {

        $parent_folder = Configure::read('ENVIRONMENT') . '/projects/project_id_' . $project_id;
        $general_folder = $parent_folder . '/' . 'general';

        // build list of folders to create
        $subfoldersToCreate = array(
            '1 Tender Documents',
            '2 Workplans',
            '3 Research and Background',
            '4 Communications',
            '5 Draft Proposal Documents',
            '6 Submitted Proposal Documents',
            '7 Donor Feedback',
            '8 Partnership',
            'P1 Contract',
            'P2 Project Inception',
        );


        if ($ensureFoldersCreated):
            // parent folder exists
            $folderExists = $this->folderExists($general_folder);
            
            if ( !$folderExists ) {
                // ensure that the folders exist
                $this->createFolder($parent_folder);
                $this->createFolder($general_folder);

                foreach($subfoldersToCreate as $subfolder_name) {
                    $sub_folder_path = $general_folder . '/' . $subfolder_name;
                    $this->createFolder($sub_folder_path);
                }
            }
        endif; // ($ensureFoldersCreated):

        $sharepoint_root_folder = '/prompt/Documents/' . $general_folder;


        
        // get list of files on Sharepoint
        $fileTree = $this->getFolderContents($general_folder);

        return compact('sharepoint_root_folder', 'fileTree');
    }

    function createFolder($folder) {

    	// add content length of 0, otherwise SP endpoint gets upset
    	$additional_headers = array('Content-Length' => 0);

    	$socket = $this->createSocket();
    	$options = $this->createOptions($additional_headers);

    	$folder_encoded = rawurlencode('Documents/' . $folder);

    	$url = $this->api_base . "folders/add('" . $folder_encoded . "')";

    	$result = $socket->post($url, null, $options);

    	// TODO: check result
    	// TODO: log result
    }

    function recycleFolder($folder) {

        // add content length of 0, otherwise SP endpoint gets upset
        $additional_headers = array('Content-Length' => 0);

        $socket = $this->createSocket();
        $options = $this->createOptions($additional_headers);

        $folder_encoded = rawurlencode('Documents/' . $folder);

        $url = $this->api_base . "GetFolderByServerRelativeUrl('" . $folder_encoded . "')/recycle";

        $result = $socket->post($url, null, $options);

        $responseObj = json_decode($result->body);

        // TODO: check response

        return;
    }

    function getFolderContents($folder) {
        
        $socket = $this->createSocket();
        $options = $this->createOptions();

        $folder_encoded = rawurlencode('Documents/' . $folder);

        $url = $this->api_base . "GetFolderByServerRelativeUrl('" . $folder_encoded . "')?\$expand=Folders";

        $result = $socket->get($url, null, $options);

        $responseObj = json_decode($result->body);
        
        return $responseObj->d;

    }

    function folderExists($folder) {
        $socket = $this->createSocket();
        $options = $this->createOptions();

        $folder_encoded = rawurlencode('Documents/' . $folder);

        $url = $this->api_base . "GetFolderByServerRelativeUrl('" . $folder_encoded . "')?\$expand=Folders,Files";

        $result = $socket->get($url, null, $options);

        $responseObj = json_decode($result->body);

        return ! isset($responseObj->error);

    }

    function deleteFolder($folder) {

    	$socket = $this->createSocket();
    	$options = $this->createOptions();

    	$folder_encoded = rawurlencode('Documents/' . $folder);

    	$url = $this->api_base . "GetFolderByServerRelativeUrl('" . $folder_encoded . "')";

    	$result = $socket->delete($url, null, $options);

    	// TODO: check result
    	// TODO: log result
    }

    function search($querytext, $RowsPerPage = 80, $StartRow = 0) {

        $socket = $this->createSocket();
        $options = $this->createOptions(array('Content-Type' => 'application/json'));

        $url = $this->api_search_base;

        $querytext .= ' site:https://intlalert.sharepoint.com/prompt/ IsDocument:true';

        $data = array(
            'request' => array(
                'Querytext' => $querytext,
                'RowsPerPage' => $RowsPerPage,
                'StartRow' => $StartRow,
            )
        );

        $result = $socket->post($url, json_encode($data), $options);

        $responseObj = json_decode($result->body);

        // debug($responseObj);

        // get count of results
        $resultCount = $responseObj->d->postquery->PrimaryQueryResult->RelevantResults->RowCount;

        // debug($resultCount);

        // rekey the result as it's returned in a table-like structure
        $fileListUnkeyed = $responseObj->d->postquery->PrimaryQueryResult->RelevantResults->Table->Rows->results;

        $fileListKeyed = [];
        foreach ($fileListUnkeyed as $fileUnkeyed) {

            $fileKeyed = new stdClass();
            foreach ($fileUnkeyed->Cells->results as $property) {
                $fileKeyed->{$property->Key} = $property->Value;
            }
            $fileListKeyed[] = $fileKeyed;
        }

        return array(
            'fullCount' => $resultCount,
            'fileList' => $fileListKeyed,
        );

    }

    function getWebUrl($folder) {

    	$folder_encoded = rawurlencode('Documents/' . $folder);

    	return $this->web_base . $folder_encoded;
    }


    private function refreshTokens($refresh_token) {
        $socket = $this->createSocket();

        $url = 'https://login.windows.net/international-alert.org/oauth2/token';
        $data = array(
            'grant_type' => 'refresh_token',
            'client_id' => OFFICE365_CLIENT_ID,
            'client_secret' => OFFICE365_CLIENT_SECRET,
            'refresh_token' => $refresh_token,
            'resource' => 'https://intlalert.sharepoint.com',
        );


        $result = $socket->post($url, $data); // add no other headers

        // parse response body
        $response = json_decode($result->body);

        // received a well-formed response?
        if ( !$response ) {
            throw new Exception("We received no response from Office365", 1);
        }

        // any errors?
        if ( property_exists($response, 'error') ) {
            throw new Exception("Office365 returned an error when getting Sharepoint details: " . $response->error, 1);
        }

        return array(
            'access_token' => $response->access_token,
            'refresh_token' => $response->refresh_token,
            'expires' => $response->expires_on,
        );



    }


}