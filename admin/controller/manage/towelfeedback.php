<?php  
class ControllerManageTowelfeedback extends Controller {  
	//private $error = array();
   
  	public function index() {
    	$this->load->language('manage/towel_feedback');

    	$this->document->setTitle($this->language->get('heading_title'));
  		if(!$this->validateDelete())
		{
			$this->session->data['error'] = $this->language->get('error_permission');
			$this->redirect($this->url->link('manage/towelfeedback', 'token=' . $this->session->data['token'] , 'SSL'));
		}
	
		$this->load->model('manage/towel_feedback');
		
    	$this->getList();
  	}
   
  	public function insert() {
    	$this->load->language('manage/towel_feedback');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('manage/towel_feedback');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
    		
			$this->model_manage_towel_feedback->addTowelFeedback($this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
						
			$this->redirect($this->url->link('manage/towelfeedback', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}
	
    	$this->getForm();
  	}

  	public function update() {
    	$this->load->language('manage/towel_feedback');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('manage/towel_feedback');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
		    $towel_feedback = $this->model_manage_towel_feedback-> getTowelFeedbackById($_GET['towel_feedback_id']);
    			
    		$this->model_manage_towel_feedback->editTowelFeedback($this->request->get['towel_feedback_id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
					
			
			$this->redirect($this->url->link('manage/towelfeedback', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}
	
    	$this->getForm();
  	}
 
  	public function delete() { 
    	$this->load->language('manage/towel_feedback');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('manage/towel_feedback');
		
    	if (isset($this->request->post['selected']) && $this->validateDelete()) {
      		foreach ($this->request->post['selected'] as $towel_feedback_id) {
				$this->model_manage_towel_feedback ->deleteTowelFeedback($towel_feedback_id);	
			}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';
			
			$this->redirect($this->url->link('manage/towelfeedback', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
			'href'      => $this->url->link('manage/towelfeedback', 'token=' . $this->session->data['token'] , 'SSL'),
      		'separator' => ' :: '
   		);
			
		$this->data['insert'] = $this->url->link('manage/towelfeedback/insert', 'token=' . $this->session->data['token'] , 'SSL');
		$this->data['delete'] = $this->url->link('manage/towelfeedback/delete', 'token=' . $this->session->data['token'] , 'SSL');			
			
    
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
		
		$this->load->model('manage/towel_feedback');
		$list = $this->model_manage_towel_feedback-> getTowelFeedbackList();

		$towel_feedbackList = array();
		if($list){
		foreach ($list as $tf){
			$towel_feedback = array(
				'towel_feedback_id' => $tf['towel_feedback_id'],
				'name' => $tf['name'],
				'email' => $tf['email'],
				'content' => $tf['content'],  
				'status' => $tf['status'], 
				'action' => $this->url->link('manage/towelfeedback/update', 'token=' . $this->session->data['token'] . '&towel_feedback_id=' . $tf['towel_feedback_id'], 'SSL'),
				'selected' => isset($this->request->post['selected']) && in_array($tf['towel_feedback_id'], $this->request->post['selected']),
			);
			
			$towel_feedbackList[] = $towel_feedback;
		}
		
		$this-> data['list'] = $towel_feedbackList;
	}
		$this->template = 'manage/towel_feedback.tpl';
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
		 if (!isset($this->request->get['towel_feedback_id'])) {
				$this->data['action'] = $this->url->link('manage/towelfeedback/insert',  '&token=' . $this->session->data['token'] , 'SSL');
			} else {
				$this->data['action'] = $this->url->link('manage/towelfeedback/update', 'token=' . $this->session->data['token'] . '&towel_feedback_id=' . $this->request->get['towel_feedback_id'], 'SSL');
			}
	
			
		$this->data['cancel'] = $this->url->link('manage/towelfeedback',   '&token=' . $this->session->data['token'], 'SSL');
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
			'href'      => $this->url->link('manage/towelfeedback', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
		
		if (!isset($this->request->get['towel_feedback_id'])) {
			$this->data['action'] = $this->url->link('manage/towelfeedback/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('manage/towelfeedback/update', 'token=' . $this->session->data['token'] . '&towel_feedback_id=' . $this->request->get['towel_feedback_id'] . $url, 'SSL');
		}
		  
    	$this->data['cancel'] = $this->url->link('manage/towelfeedback', 'token=' . $this->session->data['token'] . $url, 'SSL');

    	if (isset($this->request->get['towel_feedback_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$towel_feedback_info = $this->model_manage_towel_feedback->getTowelFeedbackById($this->request->get['towel_feedback_id']);
    	}

    	if (isset($this->request->post['name'])) {
      		$this->data['name'] = $this->request->post['name'];
    	} elseif (!empty($towel_feedback_info)) {
			$this->data['name'] = $towel_feedback_info['name'];
		} else {
      		$this->data['name'] = '';
    	}
    	
    	if (isset($this->request->post['email'])) {
      		$this->data['email'] = $this->request->post['email'];
    	} elseif (!empty($towel_feedback_info)) {
			$this->data['email'] = $towel_feedback_info['email'];
		} else {
      		$this->data['email'] = '';
    	}
    	
	    if (isset($this->request->post['content'])) {
      		$this->data['content'] = $this->request->post['content'];
    	} elseif (!empty($towel_feedback_info)) {
			$this->data['content'] = $towel_feedback_info['content'];
		} else {
      		$this->data['content'] = '';
    	}
    	
	    if (isset($this->request->post['status'])) {
      		$this->data['status'] = $this->request->post['status'];
    	} elseif (!empty($towel_feedback_info)) {
			$this->data['status'] = $towel_feedback_info['status'];
		} else {
      		$this->data['status'] = '';
    	}

		$this->template = 'manage/towel_feedback_form.tpl';
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