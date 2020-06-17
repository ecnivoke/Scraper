<?php 

class Scraper {

// Properties
	private const VERSION = '1.1';

	public 	$url; // Full site URL
	private $site; // Only site name => 'coolblue', 'bol', 'mediamarkt', etc..
	private $extensions = array( // All supported extensions
		".nl",
		".com"
	);
	private $ch;
// End Properties

	public function __construct($url){
		$this->url 	= $url;
		$this->site = $this->getSite();

		// Set curl handler
		$this->ch = $this->initCurlHandler();
	}

// Getters

// End Getters

// Setters
	private function closeCurl(){
		curl_close($this->ch);
	}
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

	private function initCurlHandler(){
		// Init curl handler
		$ch = curl_init();

		// Set curl config
		curl_setopt($ch, CURLOPT_URL, 				$this->url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 	false);
		curl_setopt($ch, CURLOPT_HEADER, 			0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 	true);

		// Output
		return $ch;
	}

	public function scrape(){
		// Get html
		$html = curl_exec($this->ch);
		libxml_use_internal_errors($html);

		// Create DOM object
		$dom = new DOMDocument;
		$dom->loadHTML($html);

		// Call site function

		if(method_exists($this, $this->site)){
			$results = $this->{$this->site}($dom);
		}
		else {
			$results = array();
		}
	
		// Close curl
		$this->closeCurl();

		// Output
		return $results;
	}

	private function coolblue($dom){ // www.coolblue.nl
		// Declade variable
		$current_price 	= '';
		$former_price 	= '';
		$img 			= '';

		// Get elements for prices
		$list  = $dom->getElementsByTagName('strong');
		$list2 = $dom->getElementsByTagName('span');
		$list3 = $dom->getElementsByTagName('img');

		// Loop for current price
		for($i = 0; $i < $list->length; $i++){

			if($list->item($i)->attributes->length > 0){
				if($list->item($i)->attributes[0]->name === 'class'){

					// Set class name
					$class = $list->item($i)->attributes[0]->value;
					
					if($class === 'sales-price__current'){
						// Set current price, break loop
						$current_price = $list->item($i)->textContent;
						break;
					}
				}
			}
		}

		// Loop for former price
		for($i = 0; $i < $list2->length; $i++){

			if($list2->item($i)->attributes->length > 0){
				if($list2->item($i)->attributes[0]->name === 'class'){

					// Set class name
					$class = $list2->item($i)->attributes[0]->value;
					
					if($class === 'sales-price__former-price'){
						// Set former price, break loop
						$former_price = str_replace(' ', '', $list2->item($i)->textContent);
						break;
					}
				}
			}
		}

		// Loop for image
		for($i = 0; $i < $list3->length; $i++){

			if($list3->item($i)->attributes->length > 0){
				if($list3->item($i)->attributes[2]->name === 'alt'){

					// Set alt name
					$alt = $list3->item($i)->attributes[2]->value;

					// Check for Main Image
					if(strpos($alt, 'Main Image') !== false){
						// Set img to src
						$img = $list3->item($i)->attributes[1]->value;
						break;
					}
				}
			}
		}

		// Output
		return ["price"			=> $current_price, 
				"former_price"	=> $former_price, 
				"image"			=> $img];
	}
// End Methods

}



 ?>