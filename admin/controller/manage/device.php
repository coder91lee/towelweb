<?php  
class ControllerManageDevice extends Controller {  
	public function index() {
		$this->load->language('manage/device');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('manage/device');

		$this->getList();
	}
	
	public function insert(){
		$this->load->language('manage/device');

		$this->document->setTitle($this->language->get('heading_title'));

		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/device', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		
		$this->load->model('manage/device');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this -> validateForm()) {
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			
		    if ($_FILES['device_image']['name'] != '')
    		{
    			$device_image = $_FILES['device_image']['name'];
    			
    			// upload small image
      			if (isset($_FILES['device_image']))
      			{
      			  	move_uploaded_file($_FILES['device_image']['tmp_name'], DIR_IMAGE_CATEGORY_SMALL . $device_image);   
      			}
    		}
    		else{
    			$device_image = '';	
    		}
    		

    		$this -> model_manage_device -> addDevice( $this->request->post,$device_image);
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('manage/device', 'token=' . $this->session->data['token'] , 'SSL'));
		}

		$this->getForm();
	}
	
	public function  update(){
		$this->load->language('manage/device');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('manage/device');		
		
		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/device', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this -> validateForm()) {	
			
			$device = $this->model_manage_device->getDeviceById($_GET['device_id']);
		    if ($_FILES['device_image']['name'] != '')
    		{
    			$device_image = $_FILES['device_image']['name'];
    			
    			// upload small image
      			if (isset($_FILES['device_image']))
      			{
      			  	move_uploaded_file($_FILES['device_image']['tmp_name'], DIR_IMAGE_CATEGORY_SMALL . $device_image);   
      			}
    		}
    		else{
    			$device_image = $device['device_image'];	
    		}
    		
			$this-> model_manage_device ->editDevice($this->request->get['device_id'], $this->request->post,$device_image);
			
			$this->redirect($this->url->link('manage/device', 'token=' . $this->session->data['token'], 'SSL'));
		}
	
	    $this -> getForm();
	}
	
	public function delete(){
		$this->load->language('manage/device');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('manage/device');
		
		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/device', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		else 
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $id) {
				
				$this->model_manage_device->deleteDevice($id);
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

			$this->redirect($this->url->link('manage/device', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}
	
	public function getForm(){
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['entry_device_name'] = $this->language->get('entry_title');
		$this->data['entry_device_code'] = $this->language->get('entry_cate');
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
		
	    if (!isset($this->request->get['device_id'])) {
			$this->data['action'] = $this->url->link('manage/device/insert',  '&token=' . $this->session->data['token'] , 'SSL');
		} else {
			$this->data['action'] = $this->url->link('manage/device/update', 'token=' . $this->session->data['token'] . '&device_id=' . $this->request->get['device_id'], 'SSL');
		}
			
			
		$this->data['cancel'] = $this->url->link('manage/device',   '&token=' . $this->session->data['token'], 'SSL');
		$this->data['token'] = $this->session->data['token'];
			
		   if (isset($this->request->get['device_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
				$info = $this->model_manage_device-> getDeviceById($this->request->get['device_id']);
			}
		
		    if (isset($this->request->post['device_id'])) {
				$this->data['device_id'] = $this->request->post['device_id'];
			} elseif (isset($info)) {
				$this->data['device_id'] = $info['device_id'];
			} else {
				$this->data['device_id'] = 0;
			} 
			
			if (isset($this->request->post['device_name'])) {
				$this->data['device_name'] = $this->request->post['device_name'];
			} else if (isset($info)) {
				$this->data['device_name'] = $info['device_name'];
			} else {
				$this->data['device_name'] = '';
			}
	  		
			if (isset($this->request->post['device_code'])) {
				$this->data['device_code'] = $this->request->post['device_code'];
			} elseif (isset($info)) {
				$this->data['device_code'] = $info['device_code'];
			} else {
				$this->data['device_code'] = '';
			}
			
		$this->template = 'manage/device_form.tpl';
		$this->children = array(
		'common/header',
		'common/footer',
		);

		$this->response->setOutput($this->render());
	}
	
	public function getList(){
    // Load file language
	$this->load->language('manage/device');
    $this->data['breadcrumbs'] = array();

	$this->data['breadcrumbs'][] = array(
	'text'      => $this->language->get('text_home'),
	'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
	'separator' => false
	);

	$this->data['breadcrumbs'][] = array(
	'text'      => $this->language->get('heading_title'),
	'href'      => $this->url->link('manage/device', 'token=' . $this->session->data['token'] , 'SSL'),
	'separator' => ' :: '
	);
	
	$this->data['insert'] = $this->url->link('manage/device/insert', 'token=' . $this->session->data['token'] , 'SSL');
	$this->data['delete'] = $this->url->link('manage/device/delete', 'token=' . $this->session->data['token'] , 'SSL');

	$limit = $this->language->get('limit');
	
	//Truyen vao mang data
	$this->data['heading_title'] = $this->language->get('heading_title');
	$this->data['text_no_results'] = $this->language->get('text_no_results');
	$this->data['text_success'] = $this->language->get('text_success');
	$this->data['text_device_name'] = $this->language->get('text_device_name');
	$this->data['text_device_code'] = $this->language->get('text_device_code');
	$this->data['column_name'] = $this->language->get('column_name');
	$this->data['column_module_type'] = $this->language->get('column_module_type'); 
	$this->data['column_module_cate'] = $this->language->get('column_module_cate');
	$this->data['column_action'] = $this->language->get('column_action');
	$this->data['column_status'] = $this->language->get('column_status');
	$this->data['button_filter'] = $this->language->get('button_filter');
	$this->data['button_insert'] = $this->language->get('button_insert');
	$this->data['button_delete'] = $this->language->get('button_delete');
	
		
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
		
		
	$this->load->model('manage/device');
	
	$devices = $this->model_manage_device-> getDeviceList();
	$deviceList = array();
	if($devices){
		foreach ($devices as $devi){
			$device = array(
				'device_id'  => $devi['device_id'],
				'device_name' => $devi['device_name'],
				'device_code' => $devi['device_code'],
				'device_image' => $devi['device_image'],
				'status' => $devi['status'],
				'action' => $this->url->link('manage/device/update', 'token=' . $this->session->data['token'] . '&device_id=' . $devi['device_id'], 'SSL'),
				'selected' => isset($this->request->post['selected']) && in_array($devi['device_id'], $this->request->post['selected']),
			
			);
			
			$deviceList[] = $device;
		}
		
		// Truyen vao mang data
        $this-> data['devices'] = $deviceList;
	}
	
	//Lien ket toi file template
	$this->template = 'manage/device.tpl';
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
