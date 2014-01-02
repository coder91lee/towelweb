<?php  
class ControllerModuleTowelContact extends Controller {
	protected function index() {
	     if($this->request->server['REQUEST_METHOD'] == 'POST'){
	         $data = $this->request->post;
	         
	         $this->load->model('module/towel_feedback');
	         $this->model_module_towel_feedback->addTowelFeedback($this->request->post);
	     }
	    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/towel_contact.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/towel_contact.tpl';
		} else {
			$this->template = 'default/template/module/towel_contact.tpl';
		}
		
		$this->render();
	}
}
?>