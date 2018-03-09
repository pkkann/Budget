<?php
class BudgetsController extends BaseController {
    
    public function indexView() 
	{
        $this->loadHelper("url");
		$data = array(

		);
        echo $this->plates->render('views::index', $data);
	}

}