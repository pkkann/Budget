<?php
class BaseController {
    
    public $plates;
	public $model;

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
        if(file_exists("../app/helpers/".ucfirst($helper).".php")) {
            $this->{$helper} = new Helper("../app/helpers/".$helper.".php", ($this->model != null ? $this->model->db : null));
        } else if(file_exists("../system/helpers/".ucfirst($helper).".php")) {
            $this->{$helper} = new Helper("../system/helpers/".$helper.".php", ($this->model != null ? $this->model->db : null));
        } else {
			throw new JellyException("Helper '".$helper."' not found");
		}
    }
}