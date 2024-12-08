<?php

use SebastianBergmann\CodeCoverage\Driver\Selector;

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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


	public function index()
	{

		$this->data_product();
		// $data['title'] 						= 'Admin';
		// $data['user'] 						= $this->db->get_where('auth_user', ['email' => $this->session->userdata('email')])->row_array();



		// $this->load->view('admin/header', $data);
		// $this->load->view('admin/navbar', $data);
		// $this->load->view('admin/sidebar', $data);
		// $this->load->view('admin/main', $data);
		// $this->load->view('admin/script', $data);
		// $this->load->view('admin/footer', $data);
	}

	public function getIdProduct()
	{
		$id_product = uniqid() . time();
		echo json_encode($id_product);
	}

	public function loadSize()
	{
		$res = $this->db->get('master_size')->result_array();
		echo json_encode($res);
	}

	public function addVarian()
	{
		$id = $this->input->post('id');
		$color[] = $this->input->post('color');
		$size[] = $this->input->post('size');



		$cek = $this->db->get_where('varian_temp', ['id_product' => $id])->result_array();
		// var_dump($color);
		$data_varian = [];
		if (is_array($size[0]) && is_array($color[0])) {


			// $rowColor = is_array($color[0]) ? count($color[0]) : 1;
			// $rowsize = is_array($size[0]) ? count($size[0]) : 0;
			$rowColor = is_array($color[0]) ? count($color[0]) : 0;
			$rowsize = is_array($size[0]) ? count($size[0]) : 0;
			// $rowpose = is_array($pose[0]) ? count($pose[0]) : 0;
			// var_dump($rowColor);
			// die;
			for ($i = 0; $i < $rowColor; $i++) {
				for ($j = 0; $j < $rowsize; $j++) {
					$this->db->or_where(['color', $color[0][$i]]);
					$cekColor = $this->db->query("	SELECT
													*
													FROM
													master_color
													WHERE
													id = '" . $color[0][$i] . "'
													OR
													color = '" . $color[0][$i] . "'")->num_rows();


					if ($cekColor == 0) {
						$this->db->insert('master_color', ['color' => $color[0][$i], 'status' => 1, 'date_created' => date('Y-m-d H:i:sa')]);
						$getIdColor = $this->db->get_where('master_color', ['color' => $color[0][$i]])->row_array();
						$colorRes = $getIdColor['id'];
					} else {
						$colorRes = $color[0][$i];
					}

					$cekSize = $this->db->get_where('master_size', ['id' => $size[0][$j]])->num_rows();
					if ($cekSize == 0) {
						$this->db->insert('master_size', ['size' => $size[0][$j], 'status' => 1, 'date_created' => date('Y-m-d H:i:sa')]);
						$getIdSize = $this->db->get_where('master_size', ['size' => $size[0][$j]])->row_array();
						$sizeRes = $getIdSize['size'];
					} else {
						$sizeRes = $size[0][$j];
					}



					array_push($data_varian, [
						'id_product' => $id,
						'id_color' => $colorRes,
						'id_size' => $sizeRes,
						// 'id_pose' => $pose[0][$x],
						'date_created' => date('Y-m-d H:i:sa')
					]);

					// var_dump($size[$j][$j]);


					// $this->db->insert('varian', $data_varian);
				}
			}

			$this->db->delete('varian_temp', ['id_product' => $id]);
			$res = $this->db->insert_batch('varian_temp', $data_varian);
			if ($res) {
				$callBack = $this->Admin_model->getVarian($id);
				$rowColor = $this->Admin_model->rowColor($id);
				$rowSize = $this->Admin_model->rowSize($id);
				$rowPose = $this->Admin_model->rowPose($id);
				echo json_encode([
					'data' => $callBack,
					'row_color' => $rowColor,
					'row_size' => $rowSize,
					'row_pose' => $rowPose
				]);
			}
		} else {
			echo json_encode([
				'data' => 0,
				'row_color' => 0,
				'row_size' => 0,
				'row_pose' => 0
			]);
		}
	}

	public function data_product()
	{
		// var_dump($_POST);
		// die;

		$this->form_validation->set_rules('product_name', 'Product Name', 'required|trim');
		$this->form_validation->set_rules('uom', 'UoM', 'required|trim');
		$this->form_validation->set_rules('size[]', 'Size', 'required|trim');
		$this->form_validation->set_rules('color[]', 'Color', 'required|trim');
		// $this->form_validation->set_rules('price[]', 'Price', 'required|trim');
		$this->form_validation->set_rules('category[]', 'Category', 'required|trim');
		$this->form_validation->set_rules('desc', 'Description', 'required|trim');




		$data['title'] 						= 'Data Product';
		$data['user'] 						= $this->db->get_where('auth_user', ['email' => $this->session->userdata('email')])->row_array();
		$data['uom']						= $this->db->get_where('master_uom', ['status' => 1])->result_array();
		$data['size']						= $this->db->get_where('master_size', ['status' => 1])->result_array();
		$data['color']						= $this->db->get_where('master_color', ['status' => 1])->result_array();
		$data['member']						= $this->Admin_model->member();
		$data['category'] 					= $this->db->get('master_category')->result_array();
		$data['pose'] 						= $this->db->get('master_pose')->result_array();



		if ($this->form_validation->run() == false) {

			if (isset($_POST['submitAddProduct'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" 												role="alert">
															 Please check your data again
															</div>');
			}
			$this->load->view('admin/header', $data);
			$this->load->view('admin/navbar', $data);
			$this->load->view('admin/sidebar', $data);
			$this->load->view('admin/data_product', $data);
			$this->load->view('admin/script', $data);
		} else {
			$time 						= time();
			$product_name 				= htmlspecialchars($this->input->post('product_name'));
			$uom 						= htmlspecialchars($this->input->post('uom'));
			$category					= $this->input->post('category');
			$desc 						= htmlspecialchars($this->input->post('desc'));
			$filename 					= '';


			// varian
			$size 						= $this->input->post('size');
			$color 						= $this->input->post('color');
			$price 						= $this->input->post('price');
			$priceDiskon 				= $this->input->post('priceDiskon');
			$stock 						= $this->input->post('stock');
			$keterangan 				= $this->input->post('keterangan');
			$fileVarian 				= '';
			$id_product 				= uniqid();
			$data_varian				= [];
			$arrayFilename 				= [];
			$coverImage 				= '';

			$image_row = count($_FILES['product_image']['name']);
			for ($k = 0; $k < $image_row; $k++) {
				$_FILES['doc']['name']      = $_FILES['product_image']['name'][$k];
				$_FILES['doc']['type']      = $_FILES['product_image']['type'][$k];
				$_FILES['doc']['tmp_name']  = $_FILES['product_image']['tmp_name'][$k];
				$_FILES['doc']['error']     = $_FILES['product_image']['error'][$k];
				$_FILES['doc']['size']      = $_FILES['product_image']['size'][$k];

				$config['allowed_types']        = 'png|jpeg|jpg';
				$config['max_size']             = '100000';
				$config['upload_path']          = './assets/images/desktop/';

				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('doc')) {
					$error = $this->upload->display_errors();
					echo $error;
				} else {
					$this->load->library('image_lib');
					$dataGambar = array('upload_data' => $this->upload->data());

					// Cek ukuran gambar
					if ($dataGambar['upload_data']['image_width'] > 1024 || $dataGambar['upload_data']['image_height'] > 768) {
						// Resize gambar dan simpan ke folder product
						$config['image_library']  		= 'gd2';
						$config['source_image']     	= './assets/images/desktop/' . $dataGambar['upload_data']['file_name'];
						$config['new_image']       		= './assets/images/product/' . $dataGambar['upload_data']['file_name'];
						$config['width']             	= 500; // Atur ukuran resize sesuai kebutuhan


						$this->load->library('image_lib', $config);

						if (!$this->image_lib->resize()) {
							echo $this->image_lib->display_errors();
						}
					}
				}

				$filename = $this->upload->data('file_name');
				$coverImage .= $k == 0 ? $filename : "";
				array_push($arrayFilename, [
					'id_product' => $id_product,
					'image' => $filename,
					'status' => 1,
					'cover' => $k == 0 ? $filename : '',
					'date_created' => date('Y-m-d H:i:sa')
				]);
			}

			$data = [
				'id_product' => $id_product,
				'product_name' => $product_name,
				'uom' => $uom,
				'time' => $time,
				'description' => $desc,
				'image' => $coverImage,
				'date_created' => date('Y-m-d H:i:sa')
			];



			foreach ($category as $c) {
				$cek = $this->db->get_where('access_category', ['id_product' => $id_product, 'id_category' => $c])->num_rows();
				if ($cek < 1) {
					$data_category = [
						'id_product' => $id_product,
						'id_category' => $c,
						'date_created' => date('Y-m-d H:i:sa')
					];
					$this->db->insert('access_category', $data_category);
				}
			}

			$imagevarianrow = count($_FILES['image_varian']['name']);
			// $imagevarianrow = 1;
			// var_dump($_FILES['image_varian']);
			if ($imagevarianrow > 0) {
				$p = 0;
				$rc = 0;


				for ($i = 0; $i < $imagevarianrow; $i++) {
					$_FILES['doc']['name']      = $_FILES['image_varian']['name'][$i];
					$_FILES['doc']['type']      = $_FILES['image_varian']['type'][$i];
					$_FILES['doc']['tmp_name']  = $_FILES['image_varian']['tmp_name'][$i];
					$_FILES['doc']['error']     = $_FILES['image_varian']['error'][$i];
					$_FILES['doc']['size']      = $_FILES['image_varian']['size'][$i];

					$config['allowed_types']        = 'png|jpeg|jpg';
					$config['max_size']             = '100000';
					$config['upload_path']          = './assets/images/product/';

					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('doc')) {
						$error = $this->upload->display_errors();
						echo $error;
					}
					$fileVarian = $this->upload->data('file_name');

					for ($sr = 0; $sr < count($size); $sr++) {
						array_push($data_varian, [
							'id_product' => $id_product,
							'image' => $fileVarian,
							'id_color' => $color[$i],
							'id_size' => $size[$sr],
							'price' => $price[$p],
							'price_diskon' => $priceDiskon[$p],
							'stock' => $stock[$p],
							'keterangan' => $keterangan[$p],
							'date_created' => date('Y-m-d H:i:sa'),

						]);


						$p++;

						$rc++;
					}
				}
			}
			// var_dump($data_varian);
			// die;

			$this->db->insert_batch('product_image', $arrayFilename);
			$res = $this->db->insert('product', $data);
			$this->db->insert_batch('varian', $data_varian);





			if ($res) {
				$this->session->set_flashdata('message', '<div class="alert alert-success" 												role="alert">
															 Data Anda Berhasil Ditambahkan
															</div>');
				redirect('Admin/data_product');
			}
		}
	}
	public function member()
	{
		$data['title'] 						= 'Data Member';
		$data['user'] 						= $this->db->get_where('auth_user', ['email' => $this->session->userdata('email')])->row_array();
		$data['member']						= $this->Admin_model->member();


		$this->load->view('admin/header', $data);
		$this->load->view('admin/navbar', $data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/member', $data);
		$this->load->view('admin/script', $data);
	}
	public function order()
	{
		$data['title'] 						= 'Data Penjualan';
		$data['user'] 						= $this->db->get_where('auth_user', ['email' => $this->session->userdata('email')])->row_array();
		$data['penjualan']						= $this->Admin_model->penjualan();


		$this->load->view('admin/header', $data);
		$this->load->view('admin/navbar', $data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/order', $data);
		$this->load->view('admin/script', $data);
	}
	public function detailVarian($id_product)
	{
		// var_dump($_POST);
		// die;

		$this->form_validation->set_rules('product_name', 'Product Name', 'required|trim');
		$this->form_validation->set_rules('uom', 'UoM', 'required|trim');
		$this->form_validation->set_rules('size[]', 'Size', 'required|trim');
		$this->form_validation->set_rules('color[]', 'Color', 'required|trim');
		// $this->form_validation->set_rules('price[]', 'Price', 'required|trim');
		$this->form_validation->set_rules('category[]', 'Category', 'required|trim');
		$this->form_validation->set_rules('desc', 'Description', 'required|trim');




		$data['title'] 						= 'Data Product';
		$data['user'] 						= $this->db->get_where('auth_user', ['email' => $this->session->userdata('email')])->row_array();
		$data['uom']						= $this->db->get_where('master_uom', ['status' => 1])->result_array();
		$data['size']						= $this->db->get_where('master_size', ['status' => 1])->result_array();
		$data['color']						= $this->db->get_where('master_color', ['status' => 1])->result_array();
		$data['category'] 					= $this->db->get('master_category')->result_array();
		// $data['pose'] 						= $this->db->get('master_pose')->result_array();



		if ($this->form_validation->run() == false) {

			if (isset($_POST['submitAddProduct'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" 												role="alert">
															 Please check your data again
															</div>');
			}
			$this->load->view('admin/header', $data);
			$this->load->view('admin/navbar', $data);
			$this->load->view('admin/sidebar', $data);
			$this->load->view('admin/data_product_varian', $data);
			$this->load->view('admin/script', $data);
		} else {
			$time 						= time();
			$product_name 				= htmlspecialchars($this->input->post('product_name'));
			$uom 						= htmlspecialchars($this->input->post('uom'));
			$category					= $this->input->post('category');
			$desc 						= htmlspecialchars($this->input->post('desc'));
			$filename 					= '';


			// varian
			$size 						= $this->input->post('size');
			$color 						= $this->input->post('color');
			$price 						= $this->input->post('price');
			$stock 						= $this->input->post('stock');
			$fileVarian 				= '';
			$id_product 				= uniqid();
			$data_varian				= [];
			$arrayFilename 				= [];
			$coverImage 				= '';

			$image_row = count($_FILES['product_image']['name']);
			for ($k = 0; $k < $image_row; $k++) {
				$_FILES['doc']['name']      = $_FILES['product_image']['name'][$k];
				$_FILES['doc']['type']      = $_FILES['product_image']['type'][$k];
				$_FILES['doc']['tmp_name']  = $_FILES['product_image']['tmp_name'][$k];
				$_FILES['doc']['error']     = $_FILES['product_image']['error'][$k];
				$_FILES['doc']['size']      = $_FILES['product_image']['size'][$k];

				$config['allowed_types']        = 'png|jpeg|jpg';
				$config['max_size']             = '100000';
				$config['upload_path']          = './assets/images/product/';

				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('doc')) {
					$error = $this->upload->display_errors();
					echo $error;
				}
				$filename = $this->upload->data('file_name');
				$coverImage .= $k == 0 ? $filename : "";
				array_push($arrayFilename, [
					'id_product' => $id_product,
					'image' => $filename,
					'status' => 1,
					'cover' => $k == 0 ? $filename : '',
					'date_created' => date('Y-m-d H:i:sa')
				]);
			}

			$data = [
				'id_product' => $id_product,
				'product_name' => $product_name,
				'uom' => $uom,
				'time' => $time,
				'description' => $desc,
				'image' => $coverImage,
				'date_created' => date('Y-m-d H:i:sa')
			];



			foreach ($category as $c) {
				$cek = $this->db->get_where('access_category', ['id_product' => $id_product, 'id_category' => $c])->num_rows();
				if ($cek < 1) {
					$data_category = [
						'id_product' => $id_product,
						'id_category' => $c,
						'date_created' => date('Y-m-d H:i:sa')
					];
					$this->db->insert('access_category', $data_category);
				}
			}

			$imagevarianrow = count($_FILES['image_varian']['name']);
			// $imagevarianrow = 1;
			// var_dump($_FILES['image_varian']);
			if ($imagevarianrow > 0) {
				$p = 0;
				$rc = 0;


				for ($i = 0; $i < $imagevarianrow; $i++) {
					$_FILES['doc']['name']      = $_FILES['image_varian']['name'][$i];
					$_FILES['doc']['type']      = $_FILES['image_varian']['type'][$i];
					$_FILES['doc']['tmp_name']  = $_FILES['image_varian']['tmp_name'][$i];
					$_FILES['doc']['error']     = $_FILES['image_varian']['error'][$i];
					$_FILES['doc']['size']      = $_FILES['image_varian']['size'][$i];

					$config['allowed_types']        = 'png|jpeg|jpg';
					$config['max_size']             = '100000';
					$config['upload_path']          = './assets/images/product/';

					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('doc')) {
						$error = $this->upload->display_errors();
						echo $error;
					}
					$fileVarian = $this->upload->data('file_name');

					for ($sr = 0; $sr < count($size); $sr++) {
						array_push($data_varian, [
							'id_product' => $id_product,
							'image' => $fileVarian,
							'id_color' => $color[$i],
							'id_size' => $size[$sr],
							'price' => $price[$i],
							'stock' => $stock[$i],
							'date_created' => date('Y-m-d H:i:sa'),

						]);


						$p++;

						$rc++;
					}
				}
			}
			// var_dump($data_varian);
			// die;

			$this->db->insert_batch('product_image', $arrayFilename);
			$res = $this->db->insert('product', $data);
			$this->db->insert_batch('varian', $data_varian);





			if ($res) {
				$this->session->set_flashdata('message', '<div class="alert alert-success" 												role="alert">
															 Data Anda Berhasil Ditambahkan
															</div>');
				redirect('Admin/data_product');
			}
		}
	}

	public function variance()
	{
		$color = $this->db->get_where('master_color', ['status' => 1])->result_array();
		$size = $this->db->get_where('master_size', ['status' => 1])->result_array();
		$uom = $this->db->get_where('master_uom', ['status' => 1])->result_array();
		echo json_encode([
			'color' => $color,
			'size' => $size,
			'uom' => $uom
		]);
	}

	public function loadListProduct()
	{
		$draw 				= $this->input->post('draw');
		$start 				= $this->input->post('start');
		$length 			= $this->input->post('length');
		$search 			= $this->input->post('search');
		$orderColumn 		= $this->input->post('order[0][column]');
		$orderSort 			= $this->input->post('order[0][dir]');

		$recordsTotal = $this->Admin_model->loadListProduct('', '', $search['value'], $orderColumn, $orderSort)->num_rows();

		$recordsFiltered = $recordsTotal;
		$data = [];
		$data = $this->Admin_model->loadListProduct($length, $start, $search['value'], $orderColumn, $orderSort)->result_array();



		echo json_encode([
			// 'cek' => $cek,
			'draw' => $draw,
			'recordsTotal' => $recordsTotal,
			'recordsFiltered' => $recordsFiltered,
			'data' => $data,
			'start' => $start,
			'length' => $length,
			'search' => $search['value']
		]);
	}
	public function loadListProductVarian()
	{
		$id_product 				= $this->input->post('id_product');
		$draw 				= $this->input->post('draw');
		$start 				= $this->input->post('start');
		$length 			= $this->input->post('length');
		$search 			= $this->input->post('search');
		$orderColumn 		= $this->input->post('order[0][column]');
		$orderSort 			= $this->input->post('order[0][dir]');

		$recordsTotal = $this->Admin_model->loadListProductVarian($id_product, '', '', $search['value'], $orderColumn, $orderSort)->num_rows();

		$recordsFiltered = $recordsTotal;
		$data = [];
		$data = $this->Admin_model->loadListProductVarian($id_product, $length, $start, $search['value'], $orderColumn, $orderSort)->result_array();

		echo json_encode([
			// 'cek' => $cek,
			'draw' => $draw,
			'recordsTotal' => $recordsTotal,
			'recordsFiltered' => $recordsFiltered,
			'data' => $data,
			'start' => $start,
			'length' => $length,
			'search' => $search['value']
		]);
	}

	public function submitUpdateProduct($id_product)
	{
		$this->form_validation->set_rules('product_name', 'Product Name', 'required|trim');
		// $this->form_validation->set_rules('uom', 'UoM', 'required|trim');
		// $this->form_validation->set_rules('size', 'Size', 'required|trim');
		// $this->form_validation->set_rules('color', 'Color', 'required|trim');
		// $this->form_validation->set_rules('price', 'Price', 'required|trim');
		// $this->form_validation->set_rules('category', 'Category', 'required|trim');
		// $this->form_validation->set_rules('desc', 'Description', 'required|trim');
		// var_dump($_POST);
		// die;

		// if ($this->form_validation->run() == false) {
		$product_name 				= htmlspecialchars($this->input->post('product_name'));
		$uom 						= htmlspecialchars($this->input->post('uom'));
		$size 						= ($this->input->post('size'));
		$color 						= ($this->input->post('color'));
		$price 						= $this->input->post('price');

		$category 					= $this->input->post('category');
		$desc 						= $this->input->post('desc');
		$filename 					= '';
		$data 						= [];
		$dataImage					= [];
		$image_row					= [];


		$image_row = $_FILES['product_image']['name'];

		if ($_FILES['product_image']['name'][0] != '') {
			for ($k = 0; $k < count($image_row); $k++) {
				$_FILES['doc']['name']      = $_FILES['product_image']['name'][$k];
				$_FILES['doc']['type']      = $_FILES['product_image']['type'][$k];
				$_FILES['doc']['tmp_name']  = $_FILES['product_image']['tmp_name'][$k];
				$_FILES['doc']['error']     = $_FILES['product_image']['error'][$k];
				$_FILES['doc']['size']      = $_FILES['product_image']['size'][$k];

				$config['allowed_types']        = 'png|jpeg|jpg';
				$config['max_size']             = '100000';
				$config['upload_path']          = './assets/images/product/';

				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('doc')) {
					$error = $this->upload->display_errors();
					echo $error;
				}
				$filename = $this->upload->data('file_name');

				array_push($data, [
					'id_product' => $id_product,
					'product_name' =>  $product_name,
					'uom' => $uom,
					'description' => $desc,
					'image' => $k == 0 ? $filename : "",
					'date_modified' => date('Y-m-d H:i:sa')
				]);
				array_push($dataImage, [
					'id_product' => $id_product,
					'image' =>  $filename,
					'status' => 1,
					'cover' => $k == 0 ? $filename : "",
					'date_modified' => date('Y-m-d H:i:sa')
				]);
			}
		} else {
			array_push($data, [
				'id_product' => $id_product,
				'product_name' =>  $product_name,
				'uom' => $uom,
				'description' => $desc,
				'date_modified' => date('Y-m-d H:i:sa')
			]);
		}


		if (count($dataImage) > 0) {
			$this->db->where('id_product', $id_product);
			$this->db->delete('product_image');
			$this->db->insert_batch('product_image', $dataImage);
		}

		// var_dump($data);
		// die;
		$this->db->where('id_product', $id_product);
		$this->db->delete('access_category');
		foreach ($category as $c) {
			$this->db->insert('access_category', ['id_product' => $id_product, 'id_category' => $c]);
		}
		$this->db->where('id_product', $id_product);

		$res = $this->db->update('product', $data[0]);


		if ($res) {
			$this->session->set_flashdata('message', '<div class="alert alert-success" 												role="alert">
															 Data Anda Berhasil Diupdate
															</div>');
			redirect('Admin/data_product');
		}
		// } else {
		// 	$this->session->set_flashdata('message', '<div class="alert alert-danger peringatan text-center" 												role="alert">
		// 					  Please check your data again!
		// 					</div>');
		// 	redirect('admin/data_product');
		// }
	}
	public function submitUpdateProductVarian($id)
	{
		$getIdProduct = $this->db->get_where('varian', ['id' => $id])->row_array();
		$id_product = $getIdProduct['id_product'];
		// $this->form_validation->set_rules('product_name', 'Product Name', 'required|trim');
		// $this->form_validation->set_rules('uom', 'UoM', 'required|trim');
		// $this->form_validation->set_rules('size', 'Size', 'required|trim');
		// $this->form_validation->set_rules('color', 'Color', 'required|trim');
		// $this->form_validation->set_rules('price', 'Price', 'required|trim');
		// $this->form_validation->set_rules('category', 'Category', 'required|trim');
		// $this->form_validation->set_rules('desc', 'Description', 'required|trim');
		// var_dump($_POST);
		// die;

		if ($this->form_validation->run() == false) {

			$product_name 				= htmlspecialchars($this->input->post('product_name'));
			$uom 						= htmlspecialchars($this->input->post('uom'));
			$size 						= ($this->input->post('size'));
			$color 						= ($this->input->post('color'));
			$price 						= $this->input->post('price');
			$priceDiskon 				= $this->input->post('priceDiskon');
			$stock 						= $this->input->post('stock');
			$keterangan 					= $this->input->post('keterangan');

			$category 					= $this->input->post('category');
			$desc 						= htmlspecialchars($this->input->post('desc'));
			$filename 					= '';
			$data 						= [];

			$price = str_replace("Rp. ", "", $price[0]);
			$price = str_replace(".", "", $price);
			$price = intval($price);

			$priceDiskon = str_replace("Rp. ", "", $priceDiskon[0]);
			$priceDiskon = str_replace(".", "", $priceDiskon);
			$priceDiskon = intval($priceDiskon);

			// $price[0] = intval(str_replace(".", "", $price[0]));

			// $image_row = $_FILES['product_image']['name'][0];
			$image_row = 1;
			if ($_FILES['product_image']['name'][0] != '') {
				for ($k = 0; $k < $image_row; $k++) {
					$_FILES['doc']['name']      = $_FILES['product_image']['name'][$k];
					$_FILES['doc']['type']      = $_FILES['product_image']['type'][$k];
					$_FILES['doc']['tmp_name']  = $_FILES['product_image']['tmp_name'][$k];
					$_FILES['doc']['error']     = $_FILES['product_image']['error'][$k];
					$_FILES['doc']['size']      = $_FILES['product_image']['size'][$k];

					$config['allowed_types']        = 'png|jpeg|jpg';
					$config['max_size']             = '100000';
					$config['upload_path']          = './assets/images/product/';

					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('doc')) {
						$error = $this->upload->display_errors();
						echo $error;
					}
					$filename = $this->upload->data('file_name');

					array_push($data, [
						'id_size' => $size[0],
						'id_color' => $color[0],
						'price' => $price,
						'price_diskon' => $priceDiskon,
						'stock' => $stock[0],
						'keterangan' => $keterangan[0],
						'image' => $filename,
						'date_modified' => date('Y-m-d H:i:sa')
					]);
				}
			} else {
				array_push($data, [
					'id_size' => $size[0],
					'id_color' => $color[0],
					'price' => $price,
					'price_diskon' => $priceDiskon,
					'stock' => $stock[0],
					'keterangan' => $keterangan[0],
					'date_modified' => date('Y-m-d H:i:sa')
				]);
			}

			// var_dump($image_row);
			// die;



			$this->db->where('id', $id);
			$res = $this->db->update('varian', $data[0]);


			if ($res) {
				$this->session->set_flashdata('message', '<div class="alert alert-success" 												role="alert">
															 Data Anda Berhasil Diupdate
															</div>');
				redirect('Admin/detailVarian/' . $id_product);
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger peringatan text-center" 												role="alert">
							  Please check your data again!
							</div>');
			redirect('admin/detailVarian/' . $id_product);
		}
	}

	public function updateProduct()
	{
		$id 			= $this->input->post('id');
		$id_product 	= $this->input->post('id_product');
		// $res = $this->db->get_where('product', ['id' => $id])->row_array();
		$res = $this->Admin_model->updateProduct($id);
		$category = $this->db->get_where('access_category', ['id_product' => $id_product])->result_array();
		$dataImage = $this->db->get_where('product_image', ['id_product' => $id_product])->result_array();
		echo json_encode([
			'res' => $res,
			'category' => $category,
			'dataImage' => $dataImage
		]);
	}
	public function updateProductVarian()
	{
		$id 			= $this->input->post('id');
		$id_product 	= $this->input->post('id_product');
		// $res = $this->db->get_where('product', ['id' => $id])->row_array();
		$res = $this->Admin_model->updateProductDetail($id);
		$category = $this->db->get_where('access_category', ['id_product' => $id_product])->result_array();
		// $dataImage = $this->db->get_where('product_image', ['id_product' => $id_product])->result_array();
		echo json_encode([
			'res' => $res,
			'category' => $category
		]);
	}

	public function deleteProduct()
	{
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$id_product = $this->db->get_where('varian', ['id' => $id])->row_array();
		$id_product = $id_product['id_product'];
		$this->db->where('id_product', $id_product);
		$res = $this->db->delete('product');
		$this->db->where('id_product', $id_product);
		$res = $this->db->delete('varian');
		$feedback = '';
		if ($res) {
			$feedback = 1;
		} else {
			$feedback = 0;
		}
		echo json_encode($feedback);
	}
	public function deleteProductVarian()
	{
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$res = $this->db->delete('varian');

		$feedback = '';
		if ($res) {
			$feedback = 1;
		} else {
			$feedback = 0;
		}
		echo json_encode($feedback);
	}
}
