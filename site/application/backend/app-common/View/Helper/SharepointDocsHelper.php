<?php

class SharepointDocsHelper extends AppHelper {
    
	var $project = null;

	var $helpers = array('Html');

	public function load($project) {
		$this->project = $project;
	}

	public function folderHref($subfolder = null) {


		if ($this->useLocalFileLinks()) {
			
			$base = 'file://intlalert.sharepoint.com@SSL/DavWWWRoot/prompt/Documents/';
			
		} else {
			// not IE
			$base = 'https://intlalert.sharepoint.com/prompt/Documents/Forms/AllItems.aspx?RootFolder=/prompt/Documents/';
		}

		
		$url = $base . Configure::read('ENVIRONMENT') . '/projects/project_id_' . $this->project['Project']['id'];

        $url .= '/' . 'general';

        if ( !is_null($subfolder) ) {

        	$url .= '/' . rawurlencode($subfolder);
        }

        return $url;

	}

	public function folderLink($link_text, $subfolder = null, $a_options = array()) {
		
		$url = $this->folderHref($subfolder);

		if ($this->useLocalFileLinks()) {
			$default_options = array();
		} else {
			$default_options = array('target' => '_blank');
		}
		

		$options = array_merge($default_options, $a_options);

		return $this->Html->link(
		    $link_text,
		    $url,
		    $options
		);
	}



	public function embedSharepoint() {
		return false;
		// return 
		$browser = $this->get_browser();
		
		// return true if IE *IS NOT* browser
		return (substr($browser, 0, 2) != 'ie');
	}


	//////
	////// Private functions
	//////

	private function useLocalFileLinks() {
		// return true;
		return false;
		$browser = $this->get_browser();
		
		// return true if IE *IS* browser
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