<?php  
class ControllerModuleRegister extends Controller {
	protected function index() {
	    
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/register.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/register.tpl';
		} else {
			$this->template = 'default/template/module/register.tpl';
		}
		
		$this->render();
	}
}
?>