<?php 

class TemplateHandler {

// Properties
	private $template_vars 	= array();
	private $temp_vars 		= array(); // User by () replaceInTemplate

	private $path 			= '../public_html/templates/';
	private $file_extension = '.tpl.php';
// End Properties

	public function __construct(){

	}

// Getters

// End Getters

// Setters

// End Setters

// Methods
	public function assign($key, $value){
		// Assign new variable
		$this->template_vars[$key] = $value;
	}

	public function render($template){
		$file = $this->path . $template . $this->file_extension;

		if(file_exists($file)){
			$content = file_get_contents($file);

			foreach($this->template_vars as $key => $value){
				$content = $this->setPreg($key, $value, $content);
			}

			eval(' ?>' . $content . '<?php ');
		}
		else {
			// File not found
			$this->throwError('404', $file);
		}
	}

	/*
	De preg is goed, maar toch, een 2D array slaat die over.
	$var[0][0]

	Ook als er meerdere template_vars zijn, doet die alleen de 1e
	*/

	private function setPreg($parent, $vars, $content, $preg = ''){

		// Begin preg string
		if(empty($preg))
			$preg = '/\{\$'.$parent;

		if(is_array($vars)){
			foreach($vars as $key => $value){

				if(is_array($value)){
					$preg .= $this->addToPreg($key);

					$this->setPreg($parent, $value, $content, $preg);
					
				}
				else {

					$content = preg_replace($preg.'\.'.$key.'\}/', $value, $content);
				}
			}
		}
		else {
			$content = preg_replace($preg.'\.'.$parent.'\}/', $vars, $content);
		}
		
		// Output
		return $content;
	}

	private function addToPreg($var){
		return '\.'.$var;
	}

	private function throwError($code, $debug = ''){
		// Set message
		switch($code){
			// Not found error
			case '404':
				$message = 'Page not found';
			break;
			case 'ActionNotSupported':
				$message = 'This action is not supported yet';
			break;
			default:
				$message 	= 'Something went wrong';
				$debug 		= $code;
		}

		// Show error page
		$this->assign('error', '<b>'.$message.'<br />'.$debug.'</b>');
		$this->render('error');
	}
// End Methods

}



 ?>