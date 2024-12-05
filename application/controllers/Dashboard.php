<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		check();
		$this->load->library('form_validation');
		date_default_timezone_set('Asia/Jakarta');
		// $this->load->library('breadcrumb');
		// $this->load->library('logger');
	}


	public function index()
	{
		if ($this->session->userdata('role_id') == 1) {
			redirect('admin');
		} else {
			redirect('home');
		}
	}
}
