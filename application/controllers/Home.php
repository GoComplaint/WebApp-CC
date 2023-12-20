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

		// API
		$api_url = "https://backend-dot-go-complaint.et.r.appspot.com/api/";
		$api_resource = "";
		$api_params = '';

		// COMPLAINT ANALYSIS
		$api_resource = "main/analysis?year=".$data['year'];
		$data_analysis = json_decode(file_get_contents($api_url.$api_resource.$api_params));
		$data['tot_open']=$data_analysis->tot_open;
		$data['tot_on_working']=$data_analysis->tot_on_working;
		$data['tot_success']=$data_analysis->tot_success;
		$data['tot_closed']=$data_analysis->tot_closed;

		// TOTAL COMPLAINT
		$data['tot_complaint']=$data_analysis->tot_complaint;
		$data['tot_urgent']=$data_analysis->tot_urgent;
		$data['tot_not_urgent']=$data_analysis->tot_not_urgent;

		// GET DATA
		$api_resource = "main/complaints/?";

		// Filter 
		$status = $this->input->get("status");
		if($status) {
			$api_resource = "main/search?";
			
			// -> Status
			if(strtoupper($status) == 'O') {
				$api_params = 'status=O';
			}else if(strtoupper($status) == 'P') {
				$api_params = 'status=P';
			}else if(strtoupper($status) == 'Y') {
				$api_params = 'status=Y';
			}else if(strtoupper($status) == 'N') {
				$api_params = 'status=N';
			}
		}
		$filter = $this->input->get("filter");
		// -> Filter
		if($filter) {
			$api_resource = "main/search?";
			// -> Status
			if(strtoupper($filter) == 'URGENT') {
				$api_params = 'prediction=URGENT';
			}else if(strtoupper($filter) == 'NOT_URGENT') {
				$api_params = 'prediction=NOT_URGENT';
			}
		}

		$data['api_params'] = $api_url.$api_resource.$api_params;
		$data['analysis'] = $data_analysis;
		$data_complaint = json_decode(file_get_contents($api_url.$api_resource.$api_params));
		$data['data_complaint'] = $data_complaint;


		$this->load->view('home', $data); 
	}

}
