<?php
class LoginController extends BaseController {
    
    public function index() {
        if(isset($_SESSION['user'])) {
			$this->loadHelper("url");
            $this->url->redirect("dashboard", "index");
        }
        echo $this->plates->render('views::index');
    }

    public function authenticate() {
        $this->loadHelper("api");
		
        $username = trim($_POST['username']);
        $password = $_POST['password'];
		
		$user = $this->model->findUser($username);
		if(!$user) {
			$this->api->outputJSON(['error' => "Brugernavn eller adgangskode er forkert"]);
		}
		
        if(password_verify($password, $user->password)) {
            $_SESSION['user'] = (object)[
                "id" => $user->id
            ];
        } else {
            $this->api->outputJSON(['error' => "Brugernavn eller adgangskode er forkert"]);
        }
    }

    public function deauthenticate() {
		$this->loadHelper("url");
        session_destroy();
        session_start();
        $this->url->redirect("login", "index");
    }

}