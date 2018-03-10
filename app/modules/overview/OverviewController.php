<?php
class OverviewController extends BaseController {
    
    public function showIndex()
    {
        $this->loadSharedModel("BudgetModel");
        $this->loadSharedModel("PostModel");
        $this->loadHelper("url");
		$data = array(
            'budgets'       => $this->smodels->budgetmodel->getBudgets(),
            'years'         => $this->smodels->budgetmodel->getYears(),
            'months'        => $this->smodels->budgetmodel->months,
            'posttypes'     => $this->smodels->postmodel->types
		);
        echo $this->plates->render('views::index', $data);
    }

    public function createPost()
    {
        $this->loadHelper("api");
        $this->loadSharedModel("PostModel");

        $name = $_POST['name'];
        $type = $_POST['type'];

        $this->api->outputJSON(['error' => !$this->smodels->postmodel->createPost($name, $type, $_SESSION['year'], $_SESSION['budget_id'])]);
    }

    public function setBudget($budget_id)
    {

    }

    public function setMonth($month)
    {
        
    }

    public function setYear($year)
    {

    }

}