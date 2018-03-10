<?php
class BudgetsController extends BaseController {
    
    public function showIndex() 
	{
        $this->loadHelper("url");
		$data = array(
			
		);
        echo $this->plates->render('views::index', $data);
	}

	public function getBudgets()
	{
		$this->loadSharedModel("BudgetModel");
		$this->loadHelper("api");
		$this->api->outputJSON($this->smodels->budgetmodel->getBudgets());
	}

	public function getBudget($id)
	{
		$this->loadSharedModel("BudgetModel");
		$this->loadHelper("api");
		$this->api->outputJSON($this->smodels->budgetmodel->getBudget($id));
	}

	public function createBudget()
	{
		$this->loadSharedModel("BudgetModel");
		$this->loadHelper("api");

		$name	= $_POST['name'];
		
		$response = $this->smodels->budgetmodel->insertBudget($name);
		$this->api->outputJSON(['error' => !$response]);
	}

	public function updateBudget()
	{
		$this->loadSharedModel("BudgetModel");
		$this->loadHelper("api");
		$id		= $_POST['id'];
		$name	= $_POST['name'];
		
		$response = $this->smodels->budgetmodel->updateBudget($id, $name);
		$this->api->outputJSON(['error' => !$response]);
	}

	public function deleteBudget($id)
	{
		$this->loadSharedModel("BudgetModel");
		$this->loadHelper("api");
		
		$response = $this->smodels->budgetmodel->deleteBudget($id);
		$this->api->outputJSON(['error' => !$response]);
	}

}