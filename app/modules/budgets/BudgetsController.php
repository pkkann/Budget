<?php
class BudgetsController extends BaseController {
    
    public function indexView() 
	{
        $this->loadHelper("url");
		$data = array(
			'budgets' 	=> $this->model->getBudgets(),
			'months' 	=> $this->model->months
		);
		if(!isset($_SESSION['budget_id'])) 
		{
			$_SESSION['budget_id'] = $data['budgets'][0]->id;
		}
        echo $this->plates->render('views::index', $data);
	}
	
	public function setBudget($budget_id) 
	{
		$_SESSION['budget_id'] = $budget_id;
	}
	
	public function getPostsJSON($type)
	{
		$posts = $this->model->getPosts($type);
		$this->loadHelper("api");
		$this->api->outputJSON($posts);
	}

}