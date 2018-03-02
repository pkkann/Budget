<?php
class MyProfileController extends BaseController {
	
	public function index() {
		$profile = $this->model->getProfile($_SESSION['user']->id);
		echo $this->plates->render("views::index", ['profile' => $profile]);
	}
	
	public function save() {
		$this->loadHelper("api");
		
		$id = $_SESSION['user']->id;
		$name = trim($_POST['name']);
		
		if( empty($name) ) {
			$this->api->outputJSON(['error' => "Alle felter skal udfyldes"]);
		}
		
		$this->model->saveProfile($id, $name);
		
		$this->api->outputJSON([]);
	}
	
	public function saveNewPass() {
		$this->loadHelper("api");
		
		$id = $_SESSION['user']->id;
		$pass = $_POST['pass'];
		$pass2 = $_POST['pass2'];
		
		if( empty(trim($pass)) || empty(trim($pass2)) ) {
			$this->api->outputJSON(['error' => "Alle felter skal udfyldes"]);
		} 
		
		if($pass != $pass2) {
			$this->api->outputJSON(['error' => "Adgangskoderne er ikke ens"]);
		}
		
		$this->model->setNewPass($id, $pass);
		
		$this->api->outputJSON([]);
	}
}