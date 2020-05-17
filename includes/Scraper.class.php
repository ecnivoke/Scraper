<?php 

require('librarys/simple_html_dom.php');

class Scraper {

// Properties
	public 	$url; // Full site URL
	public 	$results = array(); // Scrape results gets stored here
	private $site; // Only site name => 'coolblue', 'bol', 'mediamarkt', etc..
	private $extensions = array( // All supported extensions
		".nl",
		".com"
	);
// End Properties

	public function __construct($url){
		$this->url 	= $url;
		$this->site = $this->getSite();
	}

// Getters

// End Getters

// Setters

// End Setters

// Methods
	private function getSite(){

		// Check for http protocol
		$protocol = strpos($this->url, "https://");
		if($protocol !== false){ // True
			$protocol = 'https://www.';
		}
		else { // False
			$protocol = 'http://www.';
		}

		// Remove protocol from string
		$site = explode($protocol, $this->url)[1];

		// Remove site extions
		foreach($this->extensions as $ext){

			$extension = strpos($site, $ext);

			if($extension !== false){
				$extension = $ext;
				break;
			}
		}

		// Set site name
		$site = explode($extension, $site)[0];

		// Output
		return $site;
	}

	public function scrape(){

		// Get html
		$html = file_get_html($this->url);

		switch($this->site){
			case "coolblue":
				// Get prices
				$this->results['price'] = $html->find('strong[class="sales-price__current"]', 0)->plaintext;
				
				// Get old price if one exists
				if(isset($html->find('span[class="sales-price__former-price"]', 0)->plaintext)){
					$this->results['old_price'] = $html->find('span[class="sales-price__former-price"]', 0)->plaintext;
					// Remove spaces for a clean text :)
					$this->results['old_price'] = str_replace(' ', '', $this->results['old_price']);
				}
				
			break;
		}
	}
// End Methods

}



 ?>