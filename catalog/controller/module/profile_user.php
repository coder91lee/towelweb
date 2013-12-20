<?php  
class ControllerModuleProfileUser extends Controller {
	protected function index() {
	    if (!isset($this->request->get['type'])  || $this->request->get['type'] == 1){
    	    if($this->request->server['REQUEST_METHOD'] == 'POST'){
        	    if(isset($this->request->post['submit_profile']) 
        	        && $this->request->post['submit_profile'] == '10'){
                    
        	        $user = $this->model_module_user->getUserById($this->request->post['user_id']);
        	        
            		 if ($_FILES['image']['name'] != '')
            		 {
            			 $image= $_FILES['image']['name'];
            			
              			if (isset($_FILES['image']))
              			 {
              			  	 move_uploaded_file($_FILES['image']['tmp_name'], DIR_IMAGE_USER_SMALL . $image);   
              			 }
            		 }
            		 else {
            			 $image = $user['image'];
            		 }
    		
        	        $data = $this->request->post;
        	        
    				$this->model_module_user->updateProfile($user['pass'],$this->request->post,$image);
    			} 
    		}
	        
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
    		
    		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/profile_user.tpl')) {
    			$this->template = $this->config->get('config_template') . '/template/module/profile_user.tpl';
    		} else {
    			$this->template = 'default/template/module/profile_user.tpl';
    		}
    		
    		$this->render();
	    }
	    
	    if ($this->request->get['route'] == 'user'){
	        if(isset($user) && $user)
		        $this->document->setTitle(USER_SEO . ' - ' . $user['user_name'] . ' - ' .PAGE_NAME);
		    else 
		        $this->document->setTitle(USER_SEO . ' - ' . PAGE_NAME);
		        
			$this->document->setDescription(USER_SEO . ' - ' . PAGE_NAME);     
		}
	}
}
?>