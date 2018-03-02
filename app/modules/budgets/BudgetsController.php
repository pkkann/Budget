<?php
class BudgetsController extends BaseController {
    
    public function index() {
        $this->loadHelper("url");
		$data = array(
			"months" 		=> $this->model->months,
			"budgets" 		=> $this->model->getBudgets()
		);
        echo $this->plates->render('views::index', $data);
    }
	
	public function getPostsJSON($budget_id, $type) {
		$this->loadHelper("api");
		$posts = $this->model->getPosts($budget_id, $type);
		$this->api->outputJson($posts);
	}

}