<?php
class UsersController extends BaseController {
	
	public function index() {
		$users = $this->model->getUsers();
		echo $this->plates->render("views::index", ['users' => $users]);
	}
}