<?php  
class ControllerModuleTowelContact extends Controller {
	protected function index() {
	    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/towel_contact.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/towel_contact.tpl';
		} else {
			$this->template = 'default/template/module/towel_contact.tpl';
		}
		$this->render();
	}
}
?>