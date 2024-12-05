<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shop extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();


		$this->load->library('form_validation');
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('Admin_model');
		// $this->load->library('breadcrumb');
		// $this->load->library('logger');
	}


	public function index()
	{
		if ($this->session->userdata('email') != null) {
			$cek = $this->db->get_where('auth_user', ['email' => $this->session->userdata('email')])->row_array();
			if ($cek['role_id'] == 1) {
				redirect('admin');
			}
			$data['user']			= $this->db->get_where('auth_user', ['email' => $this->session->userdata('email')])->row_array();
			$data['cart'] 			= $this->Admin_model->cart($data['user']['id']);
		}

		$data['title'] 				= 'Gar&Shi';
		$data['product']			= $this->Admin_model->slide1('Jacket');
		// $data['shop']			= $this->db->get('product')->result_array();
		$data['shop']				= $this->Admin_model->shop();


		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('template/shop', $data);
		$this->load->view('template/footer', $data);
		$this->load->view('template/script', $data);
	}
}
