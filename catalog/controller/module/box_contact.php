<?php  
class ControllerModuleBoxContact extends Controller {
	protected function index() {
	    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/box_contact.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/box_contact.tpl';
		} else {
			$this->template = 'default/template/module/box_contact.tpl';
		}
		$this->render();
	}
}
?>