<?php
class OverviewController extends BaseController {
    
    public function showIndex()
    {
        $this->loadSharedModel("BudgetModel");
        $this->loadHelper("url");
		$data = array(
            'budgets'       => $this->smodels->budgetmodel->getBudgets(),
            'years'         => $this->model->getYears()
		);
        echo $this->plates->render('views::index', $data);
    }

}