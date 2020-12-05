<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ErrorController extends CI_Controller {
	

	public function error(){

		$result=$this->output->set_status_header('404');
		$errors=$this->output->set_status_header('403');
		
		if (!empty($result) || !empty($errors)) 
		{
			
			$this->data['page_title']='product view';      
            $this->data['subview']='error_page/custom_error_page';
            $this->load->view('user/layout/default', $this->data);
		}
	

	}


}