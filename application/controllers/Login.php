<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/Web_Controller.php';

class Login extends Web_Controller {
	
	public function index()
	{
		$data = [];
        $data['breadcrumb'] = [
            [
                'name' => 'Dashboard',
                'href' => null
            ]
        ];
		
        $this->load->view('modules/admin/login', $data);
	}
}
