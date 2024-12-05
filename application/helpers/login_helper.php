<?php
function check()
{
	$ci = get_instance();
	if (!$ci->session->userdata('email')) {
		redirect('auth');
	}
}
function get_client_ip()
{
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if (getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if (getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if (getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if (getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
	else if (getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
}

function check_selected($user_id, $id_product)
{

	$ci = get_instance();
	$result = $ci->db->get_where('cart', [
		'id_user' => $user_id,
		'id_varian' => $id_product,
		'selected' => 1,
		'invoice' => null
	]);

	if ($result->num_rows() > 0) {

		return "checked='checked'";
	}
}
function check_whiteList($id_varian)
{

	$ci = get_instance();

	if ($ci->session->userdata('email') != '') {
		$id_user = $ci->db->get_where('auth_user', ['email' => $ci->session->userdata('email')])->row_array();
		$id_user = $id_user['id'];

		$id_product = $ci->db->get_where('varian', ['id' => $id_varian])->row_array();
		$id_product = $id_product['id_product'];

		$result = $ci->db->get_where('white_list', [
			'id_user' => $id_user,
			'id_product' => $id_product

		]);



		if ($result->num_rows() > 0) {
			return "text-danger";
		}
	}
}

function memory()
{
	ini_set('memory_limit', '???');
}




function check_adm()
{

	$ci = get_instance();
	$role_id = $ci->session->userdata('role_id');
	// var_dump($role_id);
	// die;
	if ($role_id == 3) {
		redirect('auth');
	}
}
