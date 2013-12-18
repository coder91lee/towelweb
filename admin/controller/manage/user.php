<?php  
class ControllerManageUser extends Controller {  
	//private $error = array();
   
  	public function index() {
    	$this->load->language('manage/user');

    	$this->document->setTitle($this->language->get('heading_title'));
  		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/user', 'token=' . $this->session->data['token'] , 'SSL'));
		}
	
		$this->load->model('manage/user');
		
    	$this->getList();
  	}
   
  	public function insert() {
    	$this->load->language('manage/user');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('manage/user');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
    		
    		if ($_FILES['image']['name'] != '')
    		{
    			//$image = $this->getDirSmallImage();
    			$image= $_FILES['image']['name'];
    			var_dump($image);
    			// upload small image
      			if (isset($_FILES['image']))
      			{
      			  	move_uploaded_file($_FILES['image']['tmp_name'], DIR_IMAGE_USER_SMALL . $image);   
      			}
    		}
    		else 
    			$image = '';
    			
			$this->model_manage_user->addUser($this->request->post,$image);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
						
			$this->redirect($this->url->link('manage/user', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}
	
    	$this->getForm();
  	}

  	public function update() {
    	$this->load->language('manage/user');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('manage/user');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
		    $user = $this->model_manage_user-> getUserById($_GET['user_id']);
    		if ($_FILES['image']['name'] != '')
    		{
    			//$image = $this->getDirSmallImage();
    			$image= $_FILES['image']['name'];
    			
    			// upload small image
      			if (isset($_FILES['image']))
      			{
      			  	move_uploaded_file($_FILES['image']['tmp_name'], DIR_IMAGE_USER_SMALL . $image);   
      			}
    		}
    		else {
    			$image = $user['image'];
    		}
    			
    		$this->model_manage_user->editUser($this->request->get['user_id'], $this->request->post,$image);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
					
			
			$this->redirect($this->url->link('manage/user', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}
	
    	$this->getForm();
  	}
 
  	public function delete() { 
    	$this->load->language('manage/user');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('manage/user');
		
    	if (isset($this->request->post['selected']) && $this->validateDelete()) {
      		foreach ($this->request->post['selected'] as $user_id) {
				$this->model_manage_user ->deleteUser($user_id);	
			}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			$this->redirect($this->url->link('manage/user', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}
	
    	$this->getList();
  	}

  	private function getList() {
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('manage/user', 'token=' . $this->session->data['token'] , 'SSL'),
      		'separator' => ' :: '
   		);
			
		$this->data['insert'] = $this->url->link('manage/user/insert', 'token=' . $this->session->data['token'] , 'SSL');
		$this->data['delete'] = $this->url->link('manage/user/delete', 'token=' . $this->session->data['token'] , 'SSL');			
			
    
		// truyen vao mang data	
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_user_name'] = $this->language->get('column_user_name');
		$this->data['column_password'] = $this->language->get('column_password');
		$this->data['column_full_name'] = $this->language->get('column_full_name');
		$this->data['column_email'] = $this->language->get('column_email');
		$this->data['column_action'] = $this->language->get('column_action');
		
		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
		$this->load->model('manage/user');
		$list = $this->model_manage_user-> getUserList();

		$userList = array();
		if($list){
		foreach ($list as $u){
			$user = array(
				'user_id' => $u['user_id'],
				'user_name' => $u['user_name'],
				'pass' => $u['pass'],
				'full_name' => $u['full_name'],
				'email' => $u['email'],
				'image' => $u['image'],  
			    'role' => $u['role'],
				'code_user' => $u['code_user'], 
				'point_user' => $u['point_user'],    
				'action' => $this->url->link('manage/user/update', 'token=' . $this->session->data['token'] . '&user_id=' . $u['user_id'], 'SSL'),
				'selected' => isset($this->request->post['selected']) && in_array($u['user_id'], $this->request->post['selected']),
			);
			
			$userList[] = $user;
		}
		
		$this-> data['list'] = $userList;
	}
		$this->template = 'manage/user.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}
	
	private function getForm() {
    	$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['entry_user_name'] = $this->language->get('entry_user_name');
    	$this->data['entry_password'] = $this->language->get('entry_password');
    	$this->data['entry_confirm'] = $this->language->get('entry_confirm');
    	$this->data['entry_full_name'] = $this->language->get('entry_full_name');
    	$this->data['entry_email'] = $this->language->get('entry_email');
    	$this->data['entry_birthday'] = $this->language->get('entry_birthday');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_captcha'] = $this->language->get('entry_captcha');

    	$this->data['button_save'] = $this->language->get('button_save');
    	$this->data['button_cancel'] = $this->language->get('button_cancel');
    	
    	if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		 if (!isset($this->request->get['user_id'])) {
				$this->data['action'] = $this->url->link('manage/user/insert',  '&token=' . $this->session->data['token'] , 'SSL');
			} else {
				$this->data['action'] = $this->url->link('manage/user/update', 'token=' . $this->session->data['token'] . '&user_id=' . $this->request->get['user_id'], 'SSL');
			}
	
			
		$this->data['cancel'] = $this->url->link('manage/user',   '&token=' . $this->session->data['token'], 'SSL');
		$this->data['token'] = $this->session->data['token'];
    
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['user_name'])) {
			$this->data['error_user_name'] = $this->error['user_name'];
		} else {
			$this->data['error_user_name'] = '';
		}

 		if (isset($this->error['password'])) {
			$this->data['error_password'] = $this->error['password'];
		} else {
			$this->data['error_password'] = '';
		}
		
 		if (isset($this->error['confirm'])) {
			$this->data['error_confirm'] = $this->error['confirm'];
		} else {
			$this->data['error_confirm'] = '';
		}
		
	 	if (isset($this->error['full_name'])) {
			$this->data['error_full_name'] = $this->error['full_name'];
		} else {
			$this->data['error_full_name'] = '';
		}
		
	 	
		
		$url = '';
			
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('manage/user', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
		
		if (!isset($this->request->get['user_id'])) {
			$this->data['action'] = $this->url->link('manage/user/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('manage/user/update', 'token=' . $this->session->data['token'] . '&user_id=' . $this->request->get['user_id'] . $url, 'SSL');
		}
		  
    	$this->data['cancel'] = $this->url->link('manage/user', 'token=' . $this->session->data['token'] . $url, 'SSL');

    	if (isset($this->request->get['user_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$user_info = $this->model_manage_user->getUserById($this->request->get['user_id']);
    	}

    	if (isset($this->request->post['user_name'])) {
      		$this->data['user_name'] = $this->request->post['user_name'];
    	} elseif (!empty($user_info)) {
			$this->data['user_name'] = $user_info['user_name'];
		} else {
      		$this->data['user_name'] = '';
    	}
    	
	    if (isset($this->request->post['info'])) {
      		$this->data['info'] = $this->request->post['info'];
    	} elseif (!empty($user_info)) {
			$this->data['info'] = $user_info['info'];
		} else {
      		$this->data['info'] = '';
    	}
  
		if (isset($this->request->post['password'])) {
      		$this->data['pass'] = $this->request->post['pass'];
    	} elseif (!empty($user_info)) {
			$this->data['pass'] = $user_info['pass'];
		} else {
      		$this->data['pass'] = '';
    	}
  
    	if (isset($this->request->post['full_name'])) {
      		$this->data['full_name'] = $this->request->post['full_name'];
    	} elseif (!empty($user_info)) {
			$this->data['full_name'] = $user_info['full_name'];
		} else {
      		$this->data['full_name'] = '';
    	}

    	
  
    	if (isset($this->request->post['email'])) {
      		$this->data['email'] = $this->request->post['email'];
    	} elseif (!empty($user_info)) {
			$this->data['email'] = $user_info['email'];
		} else {
      		$this->data['email'] = '';
    	}

    	if (isset($this->request->post['birth_day'])) {
      		$this->data['birth_day'] = $this->request->post['birth_day'];
    	} elseif (!empty($user_info)) {
			$this->data['birth_day'] = $user_info['birth_day'];
		} else {
      		$this->data['birth_day'] = '';
    	}
		
		/*$this->load->model('user/user_group');
		
    	$this->data['user_groups'] = $this->model_user_user_group->getUserGroups();*/
 
     	if (isset($this->request->post['image'])) {
      		$this->data['image'] = $this->request->post['image'];
    	} elseif (!empty($user_info)) {
			$this->data['image'] = $user_info['image'];
		} else {
      		$this->data['image'] = '';
    	}
		
	   /*
		 * Lay Danh Sach 
		 * 	- useneame
		 * 	- email
		 *  sau do truyen vao mang data
		 */
			
		/*$listUsername = $this->model_manage_user-> layDanhSachUser();
		if(isset($listUsername)){
			$Username = array();
			foreach ($listUsername as $row){
				$un = array(
					'user_id' => $row['user_id'],
					'user_name'		 => $row['user_name']
				);
				$Username[] = $un;
			}
		}
		$listEmail = $this->model_manage_user-> layDanhSachUser();
		if(isset($listEmail)){
			$Email = array();
			foreach ($listEmail as $row){
				$em = array(
					'user_id' => $row['user_id'],
					'email'		 => $row['email']
				);
				$Email[] = $em;
			}
		}
		$listFullname = $this->model_manage_user-> layDanhSachUser();
		if(isset($listFullname)){
			$Fullname = array();
			foreach ($listFullname as $row){
				$fn = array(
							'user_id' => $row['user_id'],
							'full_name' => $row['full_name']
				);
				$Fullname[] = $fn;
			}
		}

		// truyen du lieu vao mang data
		$this->data['listUsername'] = $Username;
		$this->data['listEmail'] = $Email;
		$this->data['listFullname'] = $Fullname;
		*/
    	
		$this->template = 'manage/user_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());	
  	}
  	
	private function validateForm() {
	    $error = null; 
    	if (!$this->user->hasPermission('modify', 'extension/module')) {
      		$error = $this->language->get('error_permission');
			$this->error['warning'] = $error;
    	}
					
    	if (!$error) {
			return true;
    	} else {
      		return false;
    	}
  	}
	
	private function validateDelete() {
		$error = null;
		if (!$this->user->hasPermission('modify', 'extension/module')) {
			$error = $this->language->get('error_permission');
			$this->error['warning'] = $error;
		}

		if (!$error) {
			return true;
		} else {
			return false;
		}
	}
}
?>