<?php
class LayoutController extends BaseController {

    public function init() {
		$this->loadSharedModel("BudgetModel");
		if(!isset($_SESSION['budget_id'])) {
			$budgets = $this->smodels->budgetmodel->getBudgets();
			$_SESSION['budget_id'] = $budgets[0]->id;
		}
		if(!isset($_SESSION['month'])) {
			$_SESSION['month'] = date("n");
		}
		if(!isset($_SESSION['year'])) {
			$_SESSION['year'] = date("Y");
		}

        $this->loadHelper("url");

        $this->plates->registerFunction("action", function($module, $action) {
            return $this->url->action($module, $action);
        });

        $this->plates->registerFunction("menuActive", function($module, $action) {
            if($this->url->currentModule() == $module && $this->url->currentAction() == $action) {
                return "active";
            }
        });
		
		$this->plates->registerFunction("modal", function($title, $content, $actions, $id = "modal", $options= null) {
			$this->loadHelper("modal");
			return $this->modal->make($title, $content, $actions, $id, $options);
		});
		
		$this->plates->registerFunction("objPHPToJS", function($obj) {
			$t = "{";
			$s = false;
			foreach($obj as $key => $value) {
				if($s) {
					$t .= ", ";
				}
				if( is_string($value) ) {
					$value = "'".$value."'";
				}
				$t .= $key." : ".$value;
				$s = true;
			}
			$t .= "}";
			return $t;
		});
    }

}