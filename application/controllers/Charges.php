<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Charges extends CI_Controller 
{

	public function index()
	{
		$this->load->model('Charge');
        $data['charges'] = $this->Charge->getCharges();
        $this->load->view('index', $data);
	}

}
