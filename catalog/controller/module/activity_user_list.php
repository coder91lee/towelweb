<?php  
class ControllerModuleActivityUserList extends Controller {
	protected function index() {
		$this->load->model('module/user');
		
	    if (isset($this->request->get['user_id'])) {
			$id =  $this->request->get['user_id'];
			$u = $this->model_module_user->getUserById($id);
			$user = array(
			    'user_name' => $u['user_name'],
				'full_name' => $u['full_name'],
			    'image' => HTTP_IMAGE_USER_SMALL . $u['image'],
			    'href' => HTTP_SERVER . 'index.php?route=user&user_id=' .  $u['user_id'],
			);
	    	$this->data['user'] = $user;
	    	//setcookie("user_id", $user['user_id'], time()+3600 * 12);
		}
		else if(isset($_COOKIE['user_id']) && $_COOKIE['user_id'] != ''){
			$u = $this->model_module_user->getUserById($_COOKIE['user_id']);
			if(isset($u)&& $u){
			    $user = array(
    			    'user_name' => $u['user_name'],
    				'full_name' => $u['full_name'],
    			    'image' => HTTP_IMAGE_USER_SMALL . $u['image'],
    			    'href' => HTTP_SERVER . 'index.php?route=user&user_id=' .  $u['user_id'],
			    );
				$this->data['user'] = $user;
	    		//setcookie("user_id", $user['user_id'], time()+3600 * 12);	
			}
		}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/activity_user_list.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/activity_user_list.tpl';
		} else {
			$this->template = 'default/template/module/activity_user_list.tpl';
		}
		
		$this->render();
	}
}
?>