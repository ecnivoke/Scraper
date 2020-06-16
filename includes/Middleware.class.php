<?php 

class Middleware extends Session {
// Properties
	private $permission;
// End Properties

	public function __construct(){
		$this->permission = true;
	}
// Getters
// End Getters
// Setters
	public function setPermission($permission){
		$this->permission = $permission;
	}
// End Setters
// Methods

	/**
	* 
	*/
	public function checkPermission($file){

		switch($file){
			case 'index':
			break;
			case 'login':
			break;
			case 'register':
			break;
			case 'manager':
				if(!empty($this->getVar('fake_login'))){
					$this->setPermission(false);
				}
				$user_group = $this->getVar('user_group');
				if($user_group !== 'super_admin' && $user_group !== 'admin'){
					$this->setPermission(false);
				}
			break;
			default:
				if($this->logged_in() === false){
					$this->setPermission(false);
				}
		}

		// Output
		return $this->permission;
	}
// End methods
}


 ?>