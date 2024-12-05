<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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

			$data['user']			= $this->db->get_where('auth_user', ['email' => $this->session->userdata('email')])->row_array();
			$data['cart'] 			= $this->Admin_model->cart($data['user']['id']);
		}




		$data['title'] 			= 'Gar&Shi';
		$data['product']		= $this->Admin_model->slide1('new arrival');
		$data['carousel']		= $this->Admin_model->slide1('carousel');
		$data['diskon']		= $this->Admin_model->slide1('diskon');


		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('template/main', $data);
		$this->load->view('template/footer', $data);
		$this->load->view('template/script', $data);
	}

	public function detail($id)
	{



		$data['title'] 			= 'Gar&Shi';
		if ($this->session->userdata('email') != '') {
			$data['user']			= $this->db->get_where('auth_user', ['email' => $this->session->userdata('email')])->row_array();
			$data['cart'] 			= $this->Admin_model->cart($data['user']['id']);
		}

		$data['product']		= $this->Admin_model->slide1('For Women');
		$data['detail_product']	= $this->Admin_model->detail_product($id);
		$data['prov_kurir']		= $this->db->get('prov_kurir')->result_array();
		$getIdProduct = $this->db->get_where('varian', ['id' => $id])->row_array();
		$getIdProduct = $getIdProduct['id_product'];
		$data['varian'] 			= $this->Admin_model->color($getIdProduct);
		$data['varianSize'] 			= $this->Admin_model->size($getIdProduct);

		// $data['varian'] = $this->db->get_where('varian', ['id_product' => $getIdProduct])->result_array();

		$data['id_color'] = $this->db->get('master_color')->result_array();

		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('template/detail_product', $data);
		$this->load->view('template/footer', $data);
		$this->load->view('template/script', $data);
	}


	public function AddCart()
	{

		if ($this->session->userdata('email') == null) {
			echo json_encode('login');
			return false;
		}

		$user = $this->db->get_where('auth_user', ['email' => $this->session->userdata('email')])->row_array();
		$id_user = $user['id'];

		$getId = $this->db->get_where('varian', ['id' => $this->input->post('id_product')])->row_array();
		$id_product1 = $getId['id_product'];
		$qty = $this->input->post('qty');
		$color = $this->input->post('color');
		$size = $this->input->post('size');

		$getIdVarian = $this->db->get_where('varian', ['id_product' => $id_product1, 'id_color' => $color, 'id_size' => $size])->row_array();
		$id_product = $getIdVarian['id'];
		// $cek = $this->db->get_where('cart', ['id_user' => $id_user, 'id_product' => $id_product])->num_rows();

		$data = [
			'id_user' => $id_user,
			'id_varian' => $id_product,
			'qty' => $qty,
			'id_color' => $color,
			'id_size' => $size,
			'date_created' => date('Y-m-d H:i:sa')
		];
		$res = $this->db->insert('cart', $data);
		if ($res) {
			echo 1;
		}
	}
	public function UpdateQtyCart()
	{

		if ($this->session->userdata('email') == null) {
			echo json_encode('login');
			return false;
		}

		$user = $this->db->get_where('auth_user', ['email' => $this->session->userdata('email')])->row_array();
		$id_user = $user['id'];
		$id_product = $this->input->post('id_product');
		$qty = $this->input->post('qty');
		$cek = $this->db->get_where('cart', ['id_user' => $id_user, 'id_varian' => $id_product, 'invoice' => null])->row_array();

		$data = [
			'id_user' => $id_user,
			'id_varian' => $id_product,
			'qty' => $qty,
			'selected' => $cek['selected'],
			'invoice' => $cek['invoice'],
			'date_created' => $cek['date_created'],
			'date_modified' => date('Y-m-d H:i:sa')
		];
		$this->db->delete('cart', ['id_varian' => $id_product, 'id_user' => $id_user, 'invoice' => null]);
		$res = $this->db->insert('cart', $data);
		if ($res) {
			echo 1;
		}
	}

	public function whiteList()
	{
		$idVarian = $this->input->post('id');
		if ($this->session->userdata('email') == null) {
			echo json_encode('login');
			return false;
		}
		$user = $this->db->get_where('auth_user', ['email' => $this->session->userdata('email')])->row_array();
		$id_user = $user['id'];
		$cekIdProduct = $this->db->get_where('varian', ['id' => $idVarian])->row_array();
		$cekIdProduct = $cekIdProduct['id_product'];
		$cek_whiteList = $this->db->get_where('white_list', ['id_product' => $cekIdProduct, 'id_user' => $id_user])->num_rows();
		if ($cek_whiteList > 0) {
			$res = $this->db->delete('white_list', ['id_product' => $cekIdProduct, 'id_user' => $id_user]);
			if ($res) {
				$res = json_encode('0');
			}
		} else {
			$res = $this->db->insert('white_list', ['id_product' => $cekIdProduct, 'id_user' => $id_user]);
			if ($res) {
				$res = json_encode('1');
			}
		}
		echo $res;
	}



	// function untuk logout
	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->unset_userdata('invoice');
		$this->session->set_flashdata('message', '<div class="alert alert-success text-center" 																							role="alert">
													  You have been logout
													</div>');
		redirect('home');
	}
	// end function untuk logout

	public function pesanan()
	{
		check();
		$data['title'] 			= 'Gar&Shi';
		if ($this->session->userdata('email') != '') {
			$data['user']			= $this->db->get_where('auth_user', ['email' => $this->session->userdata('email')])->row_array();
			$data['cart'] 			= $this->Admin_model->cart($data['user']['id']);
		}

		$data['pesanan']		= $this->Admin_model->pesanan($data['user']['id']);

		$data['prov_kurir']		= $this->db->get('prov_kurir')->result_array();

		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('template/pesanan', $data);
		$this->load->view('template/footer', $data);
		$this->load->view('template/script', $data);
	}
	public function error()
	{
		$this->session->unset_userdata('invoice');
		$this->load->view('template/payment_failed');
	}
}
