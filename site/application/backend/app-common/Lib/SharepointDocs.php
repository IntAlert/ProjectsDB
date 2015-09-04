<?php
App::uses('HttpSocket', 'Network/Http');

class SharepointDocs {

	private $access_token = false;
	private $api_base = 'https://intlalert.sharepoint.com/prompt/_api/web/';
	private $web_base = 'https://intlalert.sharepoint.com/prompt/Documents/Forms/AllItems.aspx?RootFolder=%2Fprompt%2F';


	public function __construct($access_token) {
		$this->access_token = $access_token;
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
                'Content-Type' => 'text/plain; odata=verbose',
            ),
        );

        // merge passed options
        $options['header'] = array_merge($options['header'], $headers);

        return $options;


    }

    function createFolder($folder) {

    	// add content length of 0, otherwise SP endpoint gets upset
    	$additional_headers = array('Content-Length' => 0);

    	$socket = $this->createSocket();
    	$options = $this->createOptions($additional_headers);

    	$folder_encoded = urlencode('Documents/' . $folder);

    	$url = $this->api_base . "folders/add('" . $folder_encoded . "')";

    	$result = $socket->post($url, null, $options);

    	// TODO: check result
    	// TODO: log result
    }

    function deleteFolder($folder) {

    	$socket = $this->createSocket();
    	$options = $this->createOptions();

    	$folder_encoded = urlencode('Documents/' . $folder);

    	$url = $this->api_base . "GetFolderByServerRelativeUrl('" . $folder_encoded . "')";

    	$result = $socket->delete($url, null, $options);

    	// TODO: check result
    	// TODO: log result
    }

    function getWebUrl($folder) {

    	$folder_encoded = urlencode('Documents/' . $folder);

    	return $this->web_base . $folder_encoded;
    }


}