<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{		
		$data['page']='./admin/dashboard/dashboard_main';
		$data['title']='Dashboard';
		$data['current_page']='dashboard';
		$data['year']=date("Y");

		$data['user']='Made Asthito';

		// COMPLAINT ANALYSIS
		// TODO : INTEGRATE TO BACKEND
		$data['tot_open']="1000";
		$data['tot_on_working']="2000";
		$data['tot_success']="3000";

		// GET DATA
		$data_complaint = 'TODO: GET DATA';

		// Filter 
		$status = $this->input->get("status");
		if($status) {
			// -> Status
			if(strtoupper($status) == 'O') {
				$data_complaint = 'TODO: GET DATA OPEN';
			}else if(strtoupper($status) == 'P') {
				$data_complaint = 'TODO: GET DATA PENDING';
			}else if(strtoupper($status) == 'Y') {
				$data_complaint = 'TODO: GET DATA SUCCESS';
			}else if(strtoupper($status) == 'N') {
				$data_complaint = 'TODO: GET DATA DANGER';
			}
		}
		$filter = $this->input->get("filter");
		// -> Filter
		if($filter) {
			// -> Status
			if(strtoupper($filter) == 'URGENT') {
				$data_complaint = 'TODO: GET DATA URGENT';
			}else if(strtoupper($filter) == 'NOT_URGENT') {
				$data_complaint = 'TODO: GET DATA NOT_URGENT';
			}
		}

		$data['data_complaint'] = $data_complaint;

		// TOTAL COMPLAINT
		// TODO : INTEGRATE TO BACKEND
		$data['tot_closed']="2000";
		$data['tot_urgent']="1000";
		$data['tot_not_urgent']="2000";


		$this->load->view('home', $data); 
	}

}
