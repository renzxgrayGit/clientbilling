<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Charges extends CI_Controller 
{
	public function index()
	{
		$this->load->model('Charge');

		// Get start and end dates from form input
        $start_date = $this->input->post('start');
        $end_date = $this->input->post('end');

		// Fetch charges within the specified date range
		$data['charges'] = $this->Charge->getCharges($start_date, $end_date);

        $this->load->view('index', $data);
	}
}
