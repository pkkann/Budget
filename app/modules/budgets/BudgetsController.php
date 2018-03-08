<?php
class BudgetsController extends BaseController {
    
    public function indexView() 
	{
        $this->loadHelper("url");
		$data = array(
			'budgets' 	=> $this->model->getBudgets(),
			'months' 	=> $this->model->months,
			'years'		=> $this->model->getYears(),
			'posttypes'	=> $this->model->postTypes
		);
		if(!isset($_SESSION['budget_id'])) 
		{
			$_SESSION['budget_id'] = $data['budgets'][0]->id;
		}
		if(!isset($_SESSION['year'])) 
		{
			$_SESSION['year'] = date("Y");
		}
        echo $this->plates->render('views::index', $data);
	}
	
	public function setBudget($budget_id) 
	{
		$_SESSION['budget_id'] = $budget_id;
	}
	
	public function createPost()
	{
		$name 	= $_POST['name'];
		$type 	= $_POST['type'];
		
		$this->model->insertPost($name, $type);
		
		$this->loadHelper("api");
		$this->api->outputJSON(array('error' => false));
	}
	
	public function getPostsJSON($type)
	{
		$posts = $this->model->getPosts($type);
		$this->loadHelper("api");
		$this->api->outputJSON($posts);
	}
	
	public function getDisposablesJSON()
	{
		$disposables = $this->model->getDisposables();
		$this->loadHelper("api");
		$this->api->outputJSON($disposables);
	}

}