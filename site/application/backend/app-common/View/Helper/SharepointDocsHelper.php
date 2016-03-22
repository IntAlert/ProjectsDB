<?php

class SharepointDocsHelper extends AppHelper {
    
	var $project = null;

	public function load($project) {
		$this->project = $project;
		echo '<!-- ' . $this->get_browser() . ' -->';
	}

	public function folderHref($subfolder = null) {


		if ($this->useLocalFileLinks()) {
			
			$base = 'file://intlalert.sharepoint.com@SSL/DavWWWRoot/prompt/Documents/';
			
		} else {
			// not IE
			$base = 'https://intlalert.sharepoint.com/prompt/Documents/Forms/AllItems.aspx?RootFolder=/prompt/Documents/';
		}

		
		$folder = $base . Configure::read('ENVIRONMENT') . '/projects/project_id_' . $this->project['Project']['id'];

        $folder .= '/' . 'general';

        if ( !is_null($subfolder) ) {

        	$folder .= '/' . rawurlencode($subfolder);
        }

        return $folder;

	}






	//////
	////// Private functions
	//////

	private function useLocalFileLinks() {
		// return 
		$browser = $this->get_browser();
		
		// return true if IE is browser
		return (substr($browser, 0, 2) == 'ie');
	}

	private function get_browser()
	{
	    $browser = '';
	    $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
	    if (preg_match('~(?:msie ?|trident.+?; ?rv: ?)(\d+)~', $ua, $matches)) $browser = 'ie ie'.$matches[1];
	    elseif (preg_match('~(safari|chrome|firefox)~', $ua, $matches)) $browser = $matches[1];

	    return $browser;
	}



}