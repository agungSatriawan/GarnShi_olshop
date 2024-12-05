<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
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

	public function midtrans($nama, $telp, $total, $email)
	{
		/*Install Midtrans PHP Library (https://github.com/Midtrans/midtrans-php)
composer require midtrans/midtrans-php
                              
Alternatively, if you are not using **Composer**, you can download midtrans-php library 
(https://github.com/Midtrans/midtrans-php/archive/master.zip), and then require 
the file manually.    */

		require_once dirname(__FILE__) . '/midtrans-php-master/Midtrans.php';


		//SAMPLE REQUEST START HERE

		// Set your Merchant Server Key
		// sandbox
		// \Midtrans\Config::$serverKey = 'SB-Mid-server-jXezuGlnCU4c5yttbzW1CcP5';

		// production
		\Midtrans\Config::$serverKey = 'Mid-server-BgHylnKXkD02l-Tfd-XGECuO';
		// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
		\Midtrans\Config::$isProduction = true;
		// \Midtrans\Config::$isProduction = true;
		// Set sanitization on (default)
		\Midtrans\Config::$isSanitized = true;
		// Set 3DS transaction for credit card to true
		\Midtrans\Config::$is3ds = true;

		$params = array(
			'transaction_details' => array(
				'order_id' => rand(),
				'gross_amount' => $total,
			),
			'customer_details' => array(
				'first_name' => $nama,
				'email' => $email,
				'phone' => $telp,
			),
		);

		// var_dump($params);
		// die;
		echo $snapToken = \Midtrans\Snap::getSnapToken($params);
	}

	public function makeOrder()
	{
		$kurir 					= $this->input->post('kurir');
		$kurirService 			= $this->input->post('kurirService');
		$kurirDesc 				= $this->input->post('kurirDesc');
		$kurirEtd 				= $this->input->post('kurirEtd');
		$kurirPrice 			= $this->input->post('kurirPrice');
		$user					= $this->db->get_where('auth_user', ['email' => $this->session->userdata('email')])->row_array();

		$res = $this->Admin_model->makeOrder($kurir, $kurirService,	$kurirDesc,	$kurirEtd, $kurirPrice, $user['id']);

		$totalAll = $res['total'] + 4000;

		$this->midtrans($res['firstName'], $res['telp'], $totalAll, $res['email']);
	}

	public function status()
	{
		$order_id = $this->input->get('order_id');

		$status_code = $this->input->get('status_code');
		$transaction_status = $this->input->get('transaction_status');
		if ($status_code == 200) {
			$res = $this->Admin_model->payment($order_id, $transaction_status);
			if ($res == 1) {
				redirect('home/pesanan');
			} else {
				redirect('home/error');
			}
		} else {
			redirect('home/error');
		}
	}
}
