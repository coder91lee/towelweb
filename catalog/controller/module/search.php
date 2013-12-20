<?php
/*
 *  Author: Ha Viet Duc
 *  Date  : 4/12/2012
 *  update : 17/10/2012
 *  module: search app
 */  

class ControllerModuleSearch extends Controller {
	protected function index() {
		$this->load->model('module/app');
		
		if(isset($this->request->get['keyword']))
		{
			$filter=$this->request->get['keyword'];
		}
		else
			$filter='';
			
		$filter = str_replace("'", "", $filter);
		
		if($filter){
			$sql1='(';
			
			$filter_name=explode(" ",$filter);
			for($i=0;$i<count($filter_name);$i++)
			{
				if(strlen($sql1)!=1)	$sql1=$sql1." and ";
				$sql1=$sql1."LOWER(app_name) LIKE LOWER('%".$filter_name[$i]."%')";
			}
			$sql1=$sql1.")";
			$sql2='(';
			
			$filter_name=explode(" ",$filter);
			for($i=0;$i<count($filter_name);$i++)
			{
				if(strlen($sql2)!=1)	$sql2=$sql2." and ";
				$sql2=$sql2."LOWER(category_name) LIKE LOWER('%".$filter_name[$i]."%')";
			}
			$sql2=$sql2.")";
			
			$sql3='(';
			
			$filter_name=explode(" ",$filter);
			for($i=0;$i<count($filter_name);$i++)
			{
				if(strlen($sql3)!=1)	$sql3=$sql3." and ";
				$sql3=$sql3."LOWER(category_code) LIKE LOWER('%".$filter_name[$i]."%')";
			}
			$sql3=$sql3.")";
			
			$sql4='(';
			
			$filter_name=explode(" ",$filter);
			for($i=0;$i<count($filter_name);$i++)
			{
				if(strlen($sql4)!=1)	$sql4=$sql4." and ";
				$sql4=$sql4."LOWER(code) LIKE LOWER('%".$filter_name[$i]."%')";
			}
			$sql4=$sql4.")";
			
			$query="(" .$sql1." or " .$sql2 . " or " . $sql3  . " or " .$sql4 .")";
		}
		else 
		{
			$query = '';
		}
		
		$list = $this->model_module_app->appSearch($query);
		
	    $appSearchList = $this->model_module_app->showAppList($list);
		
		$this->data['list'] = $appSearchList;
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/search.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/search.tpl';
		} else {
			$this->template = 'default/template/module/search.tpl';
		}
		
		$this->render();
		
		if ($this->request->get['route'] == 'search'){
		    $this->document->setTitle(SEARCH_SEO . ' - ' .$filter . ' - ' . PAGE_NAME);
			$this->document->setDescription(SEARCH_SEO . ' - ' . PAGE_NAME);     
		}
	}
}
?>