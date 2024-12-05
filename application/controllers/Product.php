<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		check();
		$this->load->library('form_validation');
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('Admin_model');
		// $this->load->library('breadcrumb');
		// $this->load->library('logger');
	}


	public function detail($id)
	{
		$data['title'] 			= 'Gar&Shi';
		$data['user']			= $this->db->get_where('auth_user', ['email' => $this->session->userdata('email')])->row_array();
		$data['cart'] 			= $this->Admin_model->cart($data['user']['id']);

		$data['product']		= $this->Admin_model->slide1('Jacket');
		$data['detail_product']	= $this->Admin_model->detail_product($id);
		$data['prov_kurir']		= $this->db->get('prov_kurir')->result_array();

		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('template/detail_product', $data);
		$this->load->view('template/footer', $data);
		$this->load->view('template/script', $data);
	}
	public function checkout()
	{


		$this->form_validation->set_rules('nama', "Recipient's name", 'required|trim');
		$this->form_validation->set_rules('telp', "Phone Number", 'required|trim');
		$this->form_validation->set_rules('prov', "Province", 'required|trim');
		$this->form_validation->set_rules('kabkot', "Regency/City", 'required|trim');
		$this->form_validation->set_rules('kec', "Subdistrict", 'required|trim');
		$this->form_validation->set_rules('kel', "Village", 'required|trim');
		$this->form_validation->set_rules('address', "Address", 'required|trim');

		$data['title'] 			= 'Gar&Shi';
		$data['user']			= $this->db->get_where('auth_user', ['email' => $this->session->userdata('email')])->row_array();
		$data['cart'] 			= $this->Admin_model->cartCheckout($data['user']['id']);
		$data['prov_kurir']		= $this->db->get('prov_kurir')->result_array();
		$data['alamat'] 		= $this->db->get_where('alamat_user', ['id_user' => $data['user']['id']])->result_array();
		if ($this->form_validation->run() == false) {
			if (isset($_POST['addAddress'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" 												role="alert">
															 Please check your data again
															</div>');
			}
			$this->load->view('template/header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('template/checkout', $data);
			$this->load->view('template/footer', $data);
			$this->load->view('template/script', $data);
		} else {
			$nama 				= $this->input->post('nama');
			$telp 				= $this->input->post('telp');
			$prov 				= $this->input->post('prov');
			$kabkot 			= $this->input->post('kabkot');
			$kec 				= $this->input->post('kec');
			$kel 				= $this->input->post('kel');
			$address 			= $this->input->post('address');

			$data = [
				'id_user' => $data['user']['id'],
				'nama' => $nama,
				'telp' => $telp,
				'prov' => $prov,
				'kabkot' => $kabkot,
				'kec' => $kec,
				'kel' => $kel,
				'address' => $address,
				'status' => 1,
				'active' => 1,
				'date_created' => date('Y-m-d H:i:sa')
			];
			$res = $this->db->insert('alamat_user', $data);
			if ($res) {
				$this->session->set_flashdata('message', '<div class="alert alert-success" 												role="alert">
															 Data Anda Berhasil Ditambahkan
															</div>');
				redirect('product/checkout');
			}
		}
	}

	private function _get_prov()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: 76e175bf6df5ed22b7f0d7700a797993"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			// echo $response;
		}
		$data = json_decode($response, true);
		$res = $data['rajaongkir']['results'];
		foreach ($res as $d) {
			$prov = [

				'city_id' => $d['city_id'],
				'province_id' => $d['province_id'],
				'province' => $d['province'],
				'type' => $d['type'],
				'city_name' => $d['city_name'],
				'postal_code' => $d['postal_code']
			];
			$this->db->insert('kab_kurir', $prov);
		}
	}

	public function prov()
	{
		$id = $this->input->post('id');
		$res = $this->db->get_where('kab_kurir', ['province_id' => $id])->result_array();
		echo json_encode($res);
	}
	public function kabkot()
	{
		$kabkot = $this->input->post('kabkot');

		$res = $this->db->get_where('kec', ['KABKOT' => $kabkot])->result_array();
		echo json_encode($res);
	}
	public function kec()
	{
		$kec = $this->input->post('kec');

		$res = $this->db->get_where('kel', ['KEC' => $kec])->result_array();
		echo json_encode($res);
	}
	public function cost()
	{
		$destination = $this->input->post('destination');
		$weight = $this->input->post('weight');
		$courier = $this->input->post('courier');
		$key = '76e175bf6df5ed22b7f0d7700a797993';
		$origin = 23;

		if ($destination != '' && $weight != '' && $courier != '') {



			$curl = curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier . "",
				CURLOPT_HTTPHEADER => array(
					"content-type: application/x-www-form-urlencoded",
					"key: " . $key . ""
				),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
				echo "cURL Error #:" . $err;
			} else {
				echo $response;
			}
		} else {
			return false;
		}
	}
	public function Selectcost()
	{
		$id_user		= $this->db->get_where('auth_user', ['email' => $this->session->userdata('email')])->row_array();
		$alamat = $this->db->get_where('alamat_user', ['id_user' => $id_user['id'], 'active' => 1])->row_array();

		if ($alamat == null) {
			echo json_encode('0');
			return false;
		}

		$destination = $alamat['kabkot'];

		$weight = 1000;
		$courier = $this->input->post('courier');
		$key = '76e175bf6df5ed22b7f0d7700a797993';
		$origin = 23;

		if ($destination != '' && $weight != '' && $courier != '') {



			$curl = curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier . "",
				CURLOPT_HTTPHEADER => array(
					"content-type: application/x-www-form-urlencoded",
					"key: " . $key . ""
				),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
				echo "cURL Error #:" . $err;
			} else {
				echo $response;
			}
		} else {
			return false;
		}
	}

	public function shipping_cart()
	{
		$data['title'] 			= 'Gar&Shi';
		$data['user']			= $this->db->get_where('auth_user', ['email' => $this->session->userdata('email')])->row_array();
		$data['cart'] 			= $this->Admin_model->cart($data['user']['id']);



		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('template/shipping_cart', $data);
		$this->load->view('template/footer', $data);
		$this->load->view('template/script', $data);
	}
	public function updateCart()
	{
		$data['user']			= $this->db->get_where('auth_user', ['email' => $this->session->userdata('email')])->row_array();
		$cart					= $this->Admin_model->cart($data['user']['id']);
		echo json_encode($cart);
	}

	public function delete_cart()
	{
		$id = $this->input->post('id');
		$user			= $this->db->get_where('auth_user', ['email' => $this->session->userdata('email')])->row_array();
		$id_user = $user['id'];
		$res = $this->db->delete('cart', ['id_varian' => $id, 'id_user' => $id_user, 'invoice' => null]);
		if ($res) {
			echo json_encode(1);
		} else {
			echo json_encode(0);
		}
	}
	public function selectCart()
	{
		$id = $this->input->post('id');
		$user			= $this->db->get_where('auth_user', ['email' => $this->session->userdata('email')])->row_array();
		$id_user = $user['id'];
		$id_product = $this->input->post('id_product');
		$cek 		= $this->input->post('cek');
		$val 		= $cek == 'false' ? 0 : 1;

		$data = [
			'selected' => $val,
			'date_modified' => date('Y-m-d H:i:sa')
		];

		$res = $this->db->update('cart', $data, ['id_user' => $id_user, 'id_varian' => $id_product, 'invoice' => null]);
		if ($res) {
			echo json_encode(1);
		} else {
			echo json_encode(0);
		}
	}
	public function loadTotalSelected()
	{
		$id = $this->input->post('id');
		$user			= $this->db->get_where('auth_user', ['email' => $this->session->userdata('email')])->row_array();
		$id_user = $user['id'];
		$res = $this->Admin_model->loadTotalSelected($id_user);
		echo json_encode($res);
	}
}
