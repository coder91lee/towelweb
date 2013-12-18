<?php
/*******************************************************************
* 
* Updated by: Ha Viet Duc
* Update Date: 14/11/2012
* 
********************************************************************/
class ControllerExtensionModule extends Controller {
	/*public function index() {
		$this->load->language('extension/module');
		 
		$this->document->setTitle($this->language->get('heading_title')); 

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_confirm'] = $this->language->get('text_confirm');

		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_action'] = $this->language->get('column_action');

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		if (isset($this->session->data['error'])) {
			$this->data['error'] = $this->session->data['error'];
		
			unset($this->session->data['error']);
		} else {
			$this->data['error'] = '';
		}

		$this->load->model('setting/extension');

		$extensions = $this->model_setting_extension->getInstalled('module');
		
		foreach ($extensions as $key => $value) {
			if (!file_exists(DIR_APPLICATION . 'controller/module/' . $value . '.php')) {
				$this->model_setting_extension->uninstall('module', $value);
				
				unset($extensions[$key]);
			}
		}
		
		$this->data['extensions'] = array();
						
		$files = glob(DIR_APPLICATION . 'controller/module/*.php');
		
		if ($files) {
			foreach ($files as $file) {
				$extension = basename($file, '.php');
				
				$this->load->language('module/' . $extension);
	
				$action = array();
				
				if (!in_array($extension, $extensions)) {
					$action[] = array(
						'text' => $this->language->get('text_install'),
						'href' => $this->url->link('extension/module/install', 'token=' . $this->session->data['token'] . '&extension=' . $extension, 'SSL')
					);
				} else {
					$action[] = array(
						'text' => $this->language->get('text_edit'),
						'href' => $this->url->link('module/' . $extension . '', 'token=' . $this->session->data['token'], 'SSL')
					);
								
					$action[] = array(
						'text' => $this->language->get('text_uninstall'),
						'href' => $this->url->link('extension/module/uninstall', 'token=' . $this->session->data['token'] . '&extension=' . $extension, 'SSL')
					);
				}
												
				$this->data['extensions'][] = array(
					'name'   => $this->language->get('heading_title'),
					'action' => $action
				);
			}
		}

		$this->template = 'extension/module.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}*/
	
	public function index() {

		$this->load->language('extension/module');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module');

		$this->getList();
		
	}
	
	public function insert(){
		/*
		 * Thuc hien viec them chi tiet module
		 *  
		 */
		$this->load->language('extension/module');

		$this->document->setTitle($this->language->get('heading_title'));

		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		
		$this->load->model('extension/module');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this -> validateForm()) {
		
			$this -> model_extension_module -> addModule( $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'] , 'SSL'));
		}

		$this->getForm();
	}
	
	public function update(){
		/*
		 * Thuc hien viec sua chi tiet module
		 *  
		 */
		$this->load->language('extension/module');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('extension/module');
		
		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this -> validateForm()) {	
			
			//$module = $this->model_extension_module->getmoduleById($_GET['module_id']);

			$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
	    
	
	    $this -> getForm();
	}
	
	public function delete(){
		/*
		 * Thuc hien viec xoa module
		 *  
		 */
		$this->load->language('extension/module');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module');
		
		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		else 
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $module_id) {
				
				$module = $this->model_extension_module->getmoduleById($module_id);
				$this->model_extension_module->deleteModule($module_id);

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

			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}
	
	public function getList(){
		/*
		 *  Hien thi mot danh sach cac module
		 */
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
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
		
		$this->data['insert'] = $this->url->link('extension/module/insert', 'token=' . $this->session->data['token'] , 'SSL');
		$this->data['delete'] = $this->url->link('extension/module/delete', 'token=' . $this->session->data['token'] , 'SSL');

		$limit = $this->language->get('limit');
		
		//Truyen vao mang data
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_success'] = $this->language->get('text_success');
		$this->data['text_enabled'] = $this->language->get('text_enable');
		$this->data['text_disabled'] = $this->language->get('text_disable');
		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_module_type'] = $this->language->get('column_module_type'); 
		$this->data['column_module_cate'] = $this->language->get('column_module_cate');
		$this->data['column_action'] = $this->language->get('column_action');
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['button_filter'] = $this->language->get('button_filter');
		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
		
		
		//Get all module
		$this -> load -> model('extension/module');
		$extensions = $this -> model_extension_module -> getAllModules(($page - 1) * $limit, $limit);
		$modules = array();
		if ($extensions)
		foreach ($extensions as $row)
		{
			$module = array(
			'module_id' => $row['module_id'],
			'name'  	=> $row['name'],
			'code'  	=> $row['code'],
			'selected'  => isset($this->request->post['selected']) && in_array($module['module_id'], $this->request->post['selected']),
			'action'	=> $this->url->link('extension/module/update', 'token=' . $this->session->data['token'] . '&module_id=' . $row['module_id'], 'SSL'),
			);

			$modules[] = $module;
		}
		
		$this -> data['modules'] = $modules;
		//$this->data['success'] = $this->language->get('text_success');
		//$this->data['error'] = $this->language->get('error_permission');
		$module_total = $this -> model_extension_module -> getTotalModule();
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
		
		
		$this->data['page']=$page;
		
		$this->data['token'] = $this->request->get['token'];
		$pagination = new Pagination();
		$pagination->total = $module_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('extension/module', 'token=' . $this->session->data['token'] . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->template = 'extension/module.tpl';
		$this->children = array(
		'common/header',
		'common/footer',
		);

		$this->response->setOutput($this->render());
	}
	
	
	public  function getForm(){
		/*
		 *  Tao form de sua va them module
		 */
		
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_default'] = $this->language->get('text_default');

		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_module_type'] = $this->language->get('entry_module_type');
		$this->data['entry_category'] = $this->language->get('entry_category');
		$this->data['entry_displayed'] = $this->language->get('entry_displayed');
		$this->data['entry_free'] = $this->language->get('entry_free');
		$this->data['entry_money'] = $this->language->get('entry_money');
		$this->data['entry_number'] = $this->language->get('entry_number');
		$this->data['entry_module_cate'] = $this->language->get('entry_module_cate');
		$this->data['entry_chon'] = $this->language->get('entry_chon');

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
		
		$this->data['cancel'] = $this->url->link('extension/module',   '&token=' . $this->session->data['token'], 'SSL');
		$this->data['token'] = $this->session->data['token'];
		
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}		
	   if (!isset($this->request->get['module_id'])) {
				$this->data['action'] = $this->url->link('extension/module/insert',  '&token=' . $this->session->data['token'] , 'SSL');
			} else {
				$this->data['action'] = $this->url->link('extension/module/update', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
	   }
		
		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModuleById($this->request->get['module_id']);
		}
		
		if (isset($this->request->post['name'])) {
			$this->data['name'] = $this->request->post['name'];
		}else if (isset($module_info['name']) && $module_info['name']) {
			$this->data['name'] = $module_info['name'];
		}else {
			$this->data['name'] = '';
		}
		
		if (isset($this->request->post['code'])) {
			$this->data['code'] = $this->request->post['code'];
		}else if (isset($module_info['code']) && $module_info['code']) {
			$this->data['code'] = $module_info['code'];
		}else {
			$this->data['code'] = '';
		}
		
		$this->template = 'extension/module_form.tpl';
		$this->children = array(
		'common/header',
		'common/footer',
		);

		$this->response->setOutput($this->render());
	}
	public function install() {
		$this->load->language('extension/module');
		
		if (!$this->user->hasPermission('modify', 'extension/module')) {
			$this->session->data['error'] = $this->language->get('error_permission'); 
			
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		} else {
			$this->load->model('setting/extension');
			
			$this->model_setting_extension->install('module', $this->request->get['extension']);

			$this->load->model('user/user_group');
		
			$this->model_user_user_group->addPermission($this->user->getId(), 'access', 'module/' . $this->request->get['extension']);
			$this->model_user_user_group->addPermission($this->user->getId(), 'modify', 'module/' . $this->request->get['extension']);
			
			require_once(DIR_APPLICATION . 'controller/module/' . $this->request->get['extension'] . '.php');
			
			$class = 'ControllerModule' . str_replace('_', '', $this->request->get['extension']);
			$class = new $class($this->registry);
			
			if (method_exists($class, 'install')) {
				$class->install();
			}
			
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
	}
	
	public function uninstall() {
		$this->load->language('extension/module');
		
		if (!$this->user->hasPermission('modify', 'extension/module')) {
			$this->session->data['error'] = $this->language->get('error_permission'); 
			
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		} else {		
			$this->load->model('setting/extension');
			$this->load->model('setting/setting');
					
			$this->model_setting_extension->uninstall('module', $this->request->get['extension']);
		
			$this->model_setting_setting->deleteSetting($this->request->get['extension']);
		
			require_once(DIR_APPLICATION . 'controller/module/' . $this->request->get['extension'] . '.php');
			
			$class = 'ControllerModule' . str_replace('_', '', $this->request->get['extension']);
			$class = new $class($this->registry);
			
			if (method_exists($class, 'uninstall')) {
				$class->uninstall();
			}
		
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));	
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