<?php
class DashboardController extends BaseController {
    
    public function index() {
        $this->loadHelper("url");
        echo $this->plates->render('views::test');
    }

}