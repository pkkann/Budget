<?php
class BudgetsController extends BaseController {
    
    public function index_VIEW() {
        $this->loadHelper("url");
		$data = array(
			"months" 		=> $this->model->months,
			"budgets" 		=> $this->model->getBudgets()
		);
        echo $this->plates->render('views::index', $data);
	}
	
	public function newBudget_VIEW() {
		echo $this->plates->render('views::new_budget');
	}

}