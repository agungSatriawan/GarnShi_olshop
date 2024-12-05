<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Login extends CI_Controller
{


	public function index()
	{
		$data['title'] 			= 'Login';

		$this->form_validation->set_rules('username', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('login/index', $data);
		} else {
			$this->_login();
		}
	}
	public function forgotPassword()
	{
		$data['title'] 			= 'Lupa Password';

		$this->form_validation->set_rules('username', 'Email', 'trim|required');
		if ($this->form_validation->run() == false) {
			$this->load->view('login/forgotPassword', $data);
		} else {
			$email = $this->input->post('username');
			$user = $this->db->get_where('login', ['email' => $email])->row_array();

			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' 		=> $email,
					'token' 		=> $token,
					'date_created'	=> time()
				];
				$this->db->insert('token', $user_token);

				$this->_sendEmail($token, 'forgot');

				$this->session->set_flashdata('message', '<div class="alert alert-success text-center" 												role="alert">
													  Plese check your email to reset password!
													</div>');
				redirect('login/forgotPassword');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger text-center" 												role="alert">
													  Email is not registered!
													</div>');
				redirect('login/forgotPassword');
			}
		}
	}

	public function resetpassword()
	{
		$email 	= htmlspecialchars($this->input->get('email'));
		$token 	= htmlspecialchars($this->input->get('token'));

		$user = $this->db->get_where('login', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('token', ['token' => $token])->row_array();
			if ($user_token) {

				if (time() - $user_token['date_created'] < (60 * 60 * 24)) {

					$this->session->set_userdata('reset_email', $email);
					$this->changepassword();

					$this->session->set_flashdata('message', '<div class="alert alert-success text-center" 												role="alert">
													  ' . $email . ' Create New Password
													</div>');
					redirect('login/changepassword');
				} else {

					$this->db->delete('token', ['email' => $email]);
					$this->session->set_flashdata('message', '<div class="alert alert-danger text-center" 												role="alert">
													  Account activation failed! token expired
													</div>');
					redirect('login');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger text-center" 												role="alert">
													  Account activation failed! invalid token
													</div>');
				redirect('login');
			}
		} else {

			$this->session->set_flashdata('message', '<div class="alert alert-danger text-center" 												role="alert">
													  Reset password failed! wrong email
													</div>');
			redirect('login');
		};
	}

	public function changepassword()
	{

		if (!$this->session->userdata('reset_email')) {
			redirect('login');
		}

		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]|matches[password2]', [
			'matches' 		=> 'Password not match',
			'min_length' 	=> 'Password too short'
		]);

		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password1]');

		if ($this->form_validation->run() == false) {

			$data['title'] = "Change Password";
			$this->load->view('login/changePassword', $data);
		} else {
			$password 	= $this->input->post('password1');
			$email 		= htmlspecialchars($this->session->userdata('reset_email'));

			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('login');


			$this->session->unset_userdata('reset_email');

			$this->session->set_flashdata('message', '<div class="alert alert-success text-center" 												role="alert">
													  Password has been changed! Please login
													</div>');
			redirect('login');
		}
	}


	// function untuk login
	private function _login()
	{
		$username 		 	= htmlspecialchars($this->input->post('username'));
		$password 	     	= htmlspecialchars($this->input->post('password'));
		$user 				= $this->db->get_where('login', ['nama' => $username, 'password' => $password])->row_array();
		if (is_countable($user) < 1) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger text-center" 												role="alert">
							  Username atau Password anda tidak sesuai
							</div>');
			redirect('login');
		} else {
			$data = [
				'username' => $user['nama'],
				'role_id' => $user['role_id']
			];
			$this->session->set_userdata($data);
			redirect('admin');
		}
	}
	// end function untuk login...

	private function _sendEmail($token, $type)
	{

		error_reporting(E_STRICT | E_ALL);

		ini_set('max_execution_time', 0);
		set_time_limit(0);
		$email = $this->db->get('email_setting')->row_array();
		// var_dump($email);
		// die;
		$mail = new PHPMailer;

		$output = '';

		$mail->IsSMTP();
		//Sets Mailer to send message using SMTP

		$mail->Timeout       =   60;
		$mail->SMTPDebug = SMTP::DEBUG_SERVER;
		$mail->SMTPKeepAlive = true;
		$mail->Host = $email['smtp'];
		//Sets the SMTP hosts of your Email hosting, this for Gmail

		// $mail->Port = '465';
		$mail->Port = $email['port'];
		// $mail->Port = '587';
		//Sets the default SMTP server port

		$mail->SMTPAuth = true;
		//Sets SMTP authentication. Utilizes the Username and Password variables

		// $mail->Username = 'admloginsystem@gmail.com';
		$mail->Username = $email['email'];
		//Sets SMTP username

		// $mail->Password = '!Agungsat2102';
		$mail->Password = $email['password'];
		//Sets SMTP password

		// $mail->SMTPSecure = 'ssl';
		$mail->SMTPSecure = $email['smtp_secure'];
		// $mail->SMTPSecure = 'tls';
		//Sets connection prefix. Options are "", "ssl" or "tls"

		$mail->From = $email['email'];
		//Sets the From email address for the message

		// $mail->FromName = 'Admin login system';	
		$mail->FromName = $email['nama_pengirim'];
		//Sets the From name of the message

		//Adds a "To" address
		$mail->addBCC('agungsatriawan21@gmail.com');
		// $mail->addBCC($row["email"], $row["name"]);
		$mail->WordWrap = 50;
		//Sets word wrapping on the body of the message to a given number of characters

		$mail->IsHTML(true);
		//Sets message type to HTML
		$mail->addCustomHeader('MIME-Version: 1.0\r\n');
		$mail->addCustomHeader('Content-Type: text/html; charset=UTF-8\r\n');

		// $mail->SMTPDebug = 100;
		$mail->AltBody = '';
		if ($type == 'verify') {
			$mail->AddAddress($this->input->post('username'));
			$mail->Subject = 'Account Verification';
			//Sets the Subject of the message

			//An HTML or plain text message body
			$mail->Body = 'Click this link to verify your account : <a href="' . base_url('') . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '" >Activate</a>';
		} else if ($type == 'forgot') {

			$mail->AddAddress($this->input->post('username'));
			$mail->Subject = 'Reset Password';
			//Sets the Subject of the message

			//An HTML or plain text message body
			$mail->Body = 'Click this link to reset your password : <a href="' . base_url('') . 'login/resetpassword?email=' . $this->input->post('username') . '&token=' . urlencode($token) . '" >Reset Password</a>';
		}
		$mail->send();
	}
}
