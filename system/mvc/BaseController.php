<?php
class BaseController {
    
    protected $plates;
	protected $model;

    public function __construct(League\Plates\Engine $plates, $model = null) {
        $this->plates = $plates;
		$this->model = $model;

        if(isset($GLOBALS['autoload']['helpers'])) {
            foreach ($GLOBALS['autoload']['helpers'] as $helper) {
                $this->loadHelper($helper);
            }
        }
    }

    public function loadHelper($helper) {
        $helper = strtolower(trim($helper));
        if(file_exists("../system/helpers/".ucfirst($helper).".php")) {
            $this->{$helper} = new Helper("../system/helpers/".$helper.".php");
        } else {
            throw new JellyException("Helper '".$helper."' not found");
        }
    }
}