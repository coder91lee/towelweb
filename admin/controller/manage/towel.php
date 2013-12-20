<?php  
class ControllerManageTowel extends Controller {  
	public function index() {
		$this->load->language('manage/towel');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('manage/towel');

		$this->getList();
	}
	
	public function insert(){
		$this->load->language('manage/towel');

		$this->document->setTitle($this->language->get('heading_title'));

		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/towel', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		
		$this->load->model('manage/towel');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this -> validateForm()) {
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			
		    if ($_FILES['towel_image']['name'] != '')
    		{
    			$towel_image = $_FILES['towel_image']['name'];
    			
    			// upload small image
      			if (isset($_FILES['towel_image']))
      			{
      			  	move_uploaded_file($_FILES['towel_image']['tmp_name'], DIR_IMAGE_TOWEL_SMALL . $towel_image);   
      			}
    		}
    		else{
    			$towel_image = '';	
    		}
    		

    		$this -> model_manage_towel -> addTowel( $this->request->post,$towel_image);
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('manage/towel', 'token=' . $this->session->data['token'] , 'SSL'));
		}

		$this->getForm();
	}
	
	public function  update(){
		$this->load->language('manage/towel');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('manage/towel');		
		
		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/towel', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this -> validateForm()) {	
			
			$towel = $this->model_manage_towel->getTowelById($_GET['towel_id']);
		    if ($_FILES['towel_image']['name'] != '')
    		{
    			$towel_image = $_FILES['towel_image']['name'];
    			
    			// upload small image
      			if (isset($_FILES['towel_image']))
      			{
      			  	move_uploaded_file($_FILES['towel_image']['tmp_name'], DIR_IMAGE_TOWEL_SMALL . $towel_image);   
      			}
    		}
    		else{
    			$towel_image = $towel['towel_image'];	
    		}
    		
			$this-> model_manage_towel ->editTowel($this->request->get['towel_id'], $this->request->post,$towel_image);
			
			$this->redirect($this->url->link('manage/towel', 'token=' . $this->session->data['token'], 'SSL'));
		}
	
	    $this -> getForm();
	}
	
	public function delete(){
		$this->load->language('manage/towel');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('manage/towel');
		
		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/towel', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		else 
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $id) {
				
				$this->model_manage_towel->deleteTowel($id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

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

			$this->redirect($this->url->link('manage/towel', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}
	
	public function getForm(){
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['entry_towel_name'] = $this->language->get('entry_title');
		$this->data['entry_price'] = $this->language->get('entry_cate');
		$this->data['entry_title'] = $this->language->get('entry_title');
		

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		$this->data['tab_general'] = $this->language->get('tab_general');
		
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
		'text'      => $this->language->get('text_home'),
		'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
		'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
		'text'      => $this->language->get('heading_title'),
		'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'] , 'SSL'),
		'separator' => ' :: '
		);
		
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
	    if (!isset($this->request->get['towel_id'])) {
			$this->data['action'] = $this->url->link('manage/towel/insert',  '&token=' . $this->session->data['token'] , 'SSL');
		} else {
			$this->data['action'] = $this->url->link('manage/towel/update', 'token=' . $this->session->data['token'] . '&towel_id=' . $this->request->get['towel_id'], 'SSL');
		}
			
			
		$this->data['cancel'] = $this->url->link('manage/towel',   '&token=' . $this->session->data['token'], 'SSL');
		$this->data['token'] = $this->session->data['token'];
			
		   if (isset($this->request->get['towel_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
				$info = $this->model_manage_towel-> getTowelById($this->request->get['towel_id']);
			}
		
		    if (isset($this->request->post['towel_id'])) {
				$this->data['towel_id'] = $this->request->post['towel_id'];
			} elseif (isset($info)) {
				$this->data['towel_id'] = $info['towel_id'];
			} else {
				$this->data['towel_id'] = 0;
			} 
			
			if (isset($this->request->post['towel_name'])) {
				$this->data['towel_name'] = $this->request->post['towel_name'];
			} else if (isset($info)) {
				$this->data['towel_name'] = $info['towel_name'];
			} else {
				$this->data['towel_name'] = '';
			}
	  		if (isset($this->request->post['price'])) {
				$this->data['price'] = $this->request->post['price'];
			} elseif (isset($info)) {
				$this->data['price'] = $info['price'];
			} else {
				$this->data['price'] = '';
			}
			
	        if (isset($this->request->post['overview'])) {
				$this->data['overview'] = $this->request->post['overview'];
			} elseif (isset($info)) {
				$this->data['overview'] = $info['overview'];
			} else {
				$this->data['overview'] = '';
			}
			
	        if (isset($this->request->post['specification'])) {
				$this->data['specification'] = $this->request->post['specification'];
			} elseif (isset($info)) {
				$this->data['specification'] = $info['specification'];
			} else {
				$this->data['specification'] = '';
			}
			
	        if (isset($this->request->post['delivery'])) {
				$this->data['delivery'] = $this->request->post['delivery'];
			} elseif (isset($info)) {
				$this->data['delivery'] = $info['delivery'];
			} else {
				$this->data['delivery'] = '';
			}
			
			
		$this->load->model('manage/towel_cate');
	    $cates = $this->model_manage_towel_cate-> getTowelCateList();
	    $this-> data['cates'] = $cates;
		
	    $this->template = 'manage/towel_form.tpl';
		$this->children = array(
		'common/header',
		'common/footer',
		);

		$this->response->setOutput($this->render());
	}
	
	public function getList(){
    // Load file language
	$this->load->language('manage/towel');
    $this->data['breadcrumbs'] = array();

	$this->data['breadcrumbs'][] = array(
	'text'      => $this->language->get('text_home'),
	'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
	'separator' => false
	);

	$this->data['breadcrumbs'][] = array(
	'text'      => $this->language->get('heading_title'),
	'href'      => $this->url->link('manage/towel', 'token=' . $this->session->data['token'] , 'SSL'),
	'separator' => ' :: '
	);
	
	$this->data['insert'] = $this->url->link('manage/towel/insert', 'token=' . $this->session->data['token'] , 'SSL');
	$this->data['delete'] = $this->url->link('manage/towel/delete', 'token=' . $this->session->data['token'] , 'SSL');

	$limit = $this->language->get('limit');
	
	//Truyen vao mang data
	$this->data['heading_title'] = $this->language->get('heading_title');
	$this->data['text_no_results'] = $this->language->get('text_no_results');
	$this->data['text_success'] = $this->language->get('text_success');
	$this->data['text_towel_name'] = $this->language->get('text_towel_name');
	$this->data['text_price'] = $this->language->get('text_price');
	$this->data['column_name'] = $this->language->get('column_name');
	$this->data['column_module_type'] = $this->language->get('column_module_type'); 
	$this->data['column_module_cate'] = $this->language->get('column_module_cate');
	$this->data['column_action'] = $this->language->get('column_action');
	$this->data['column_status'] = $this->language->get('column_status');
	$this->data['button_filter'] = $this->language->get('button_filter');
	$this->data['button_insert'] = $this->language->get('button_insert');
	$this->data['button_delete'] = $this->language->get('button_delete');
	
	$this->data['token'] = $this->session->data['token'];	
		
	 if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];

			$this->session->data['success'] = null;
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
		if (isset($this->session->data['error'])) {
			$this->data['error'] = $this->session->data['error'];

			$this->session->data['error'] = null;
			unset($this->session->data['error']);
		} else {
			$this->data['error'] = '';
		}
		
		
	$this->load->model('manage/towel');
	$this->load->model('manage/towel_cate');
	$towels = $this->model_manage_towel-> getTowelList();
	$towelList = array();
	if($towels){
		foreach ($towels as $towel){
		    $towel_cate = $this->model_manage_towel_cate->getTowelCateById($towel['towel_cate_id']);
		  
			$towel = array(
					'towel_id'  => $towel['towel_id'],
					'towel_cate_id'  => $towel['towel_cate_id'],
			        'towel_cate_name' => $towel_cate['towel_cate_name'],
					'towel_name'      => $towel['towel_name'],
					'towel_image'      => $towel['towel_image'],
					'price'      => $towel['price'],
					'overview'      => $towel['overview'],
					'specification'      => $towel['specification'],
					'delivery'      => $towel['delivery'],
					'action'         => $this->url->link('manage/towel/update', 'token=' . $this->session->data['token'] . '&towel_id=' . $towel['towel_id'], 'SSL'),
					'selected'       => isset($this->request->post['selected']) && in_array($towel['towel_id'], $this->request->post['selected']),
			        'status' => $towel['status'],
			);
			
			$towelList[] = $towel;
		}
		
		// Truyen vao mang data
        $this-> data['towels'] = $towelList;
	}
	
	//Lien ket toi file template
	$this->template = 'manage/towel.tpl';
		$this->children = array(
		'common/header',
		'common/footer',
		);

    $this->response->setOutput($this->render());
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
}

?>
