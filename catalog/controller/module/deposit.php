<?php  
class ControllerModuleDeposit extends Controller {
	protected function index() {
	    if (isset($this->request->get['type'])  && $this->request->get['type'] == 3){
    	   
    		
	        
	        $this->load->model('module/user');
    	    if (isset($this->request->get['user_id'])) {
    			$id =  $this->request->get['user_id'];
    			$user = $this->model_module_user->getUserById($id);
    			
    	    	$this->data['user'] = $user;
    		}
    		else if(isset($_COOKIE['user_id']) && $_COOKIE['user_id'] != ''){
    			$user = $this->model_module_user->getUserById($_COOKIE['user_id']);
    			if(isset($user)&& $user){
    				$this->data['user'] = $user;
    			}
    		}
    		
    		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/deposit.tpl')) {
    			$this->template = $this->config->get('config_template') . '/template/module/deposit.tpl';
    		} else {
    			$this->template = 'default/template/module/deposit.tpl';
    		}
    		
    		$this->render();
	    }
    }
}
?>