<?php
defined('BASEPATH') or exit('No direct script access allowed');
// include_once __DIR__ . '../../../vendor/owasp/csrf-protector-php/libs/csrf/csrfprotector.php';
//Initialise CSRFGuard library
// csrfProtector::init();
// include_once  'vendor/autoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('Report_model');
		// $this->load->library('breadcrumb');
	}



	public function index()
	{
		$this->login();
	}
	public function login()
	{
		$url = $this->input->get('url');
		$this->form_validation->set_rules('email', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if ($this->form_validation->run() == false) {
			$data['title'] 			= 'SignIn Gar&Shi';
			$this->load->view('template/header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('template/login', $data);

			$this->load->view('template/footer', $data);
			$this->load->view('template/script', $data);
		} else {
			$this->_login($url);
		}
	}

	private function _login($link)
	{
		$username 		 	= htmlspecialchars($this->input->post('email'));
		$password 	     	= htmlspecialchars($this->input->post('password'));





		// $this->db->or_where('nrp',$email);
		$user 		= $this->db->query("	SELECT 
											auth_user.* ,
											auth_user_group.id as id_group,
											auth_user_group.`group`,
											auth_user_group.`status`
											FROM 
											auth_user
											LEFT JOIN
											auth_user_group
											ON
											auth_user.role_id = auth_user_group.id
											WHERE 
											auth_user.email =   
											'$username' OR auth_user.username = '$username'
											")->row_array();


		$user_group = $this->db->get_where('auth_user_group', array('id' => $user['id_group']))->row_array();
		$user_group = $user_group['group'];

		// jika user ada
		if ($user) {
			// jika account active
			if ($user['active'] != 1) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger peringatan text-center" 												role="alert">
							  This Account has not been activated, Please check your email!
							</div>');
				redirect('auth');
				// header('Clear-Site-Data: "cache", "cookies"');
				return false;
			}

			if ($user['status'] != 1) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger peringatan text-center" 												role="alert">
							  This group has not been activated!
							</div>');
				redirect('auth');
				// header('Clear-Site-Data: "cache", "cookies"');
				return false;
			}
			// akhir pengecekan status

			$p = $user['password'];

			if (password_verify($password, $p)) {
				$data = [
					'email' => $user['email'],
					'role_id' => $user['role_id']
				];

				$this->session->set_userdata($data);
				$role = $data['role_id'];
				if ($user['role_id'] == $user['id_group']) {
					$url = $this->db->query("	SELECT 
												auth_user_sub_menu.*
												FROM 
												auth_user_sub_menu 
												LEFT JOIN
												auth_user_access_menu
												ON
												auth_user_access_menu.menu_id = auth_user_sub_menu.menu_id
												WHERE
												auth_user_access_menu.role_id = '$role'")->row_array();
					if ($link != '') {

						header("Location: " . $link . "");
						die();
					} else {
						redirect('home');
					}
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger peringatan text-center" 												role="alert">
															  Wrong password
															</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger peringatan text-center" 												role="alert">
													  Email is not registered
													</div>');
			redirect('auth');
		}
	}

	public function notif()
	{
		$day 					= date('d');
		$bulan 					= date('m');
		$tahun 					= date('Y');
		$notif 					= $this->db->get('auth_mail_notif')->result_array();
		$warning 				= $this->db->get('auth_mail_warning')->result_array();

		foreach ($notif as $n) {
			if ($n['mail_type'] == 'bulanan') {
				if ($day >= $n['day']) {
					$periode 			= date('m-Y');
					$cek_periode 		= $this->db->get_where('auth_email_blast', ['mail_type' => 'Bulanan', 'bulan' => $bulan, 'tahun' => $tahun]);
					if ($cek_periode->num_rows() < 1) {
						// $email = $this->_sendEmail('bulanan', 'month');

						$data = [
							'token' => 123,
							'bulan' => $bulan,
							'tahun' => $tahun,
							'mail_type' => "Bulanan",
							'date_created' => date("Y-m-d h:i:sa")
						];
						$this->db->insert('auth_email_blast', $data);
						// if ($email == '') {
						// 	echo "Email Bulanan Terkirim";
						// } else {
						// 	echo "Email Bulanan Gagal Terkirim";
						// }
					}
				}
			} else if ($n['mail_type'] == 'triwulan') {
				if ($day == $n['day'] && $bulan == $n['month']) {
					$periode 			= date('d-m-Y');
					$cek_periode 		= $this->db->get_where('auth_email_blast', ['mail_type' => 'Triwulan', 'bulan' => $bulan, 'tahun' => $tahun]);
					if ($cek_periode->num_rows() < 1) {
						// $email = $this->_sendEmail('triwulan', 'triple');
						$data = [
							'token' => 123,
							'bulan' => $bulan,
							'tahun' => $tahun,
							'mail_type' => "Triwulan",
							'date_created' => date("Y-m-d h:i:sa")
						];
						$this->db->insert('auth_email_blast', $data);
						// if ($email == '') {
						// 	echo "Email Triwulan Terkirim";
						// } else {
						// 	echo "Email Triwulan Gagal Terkirim";
						// }
					}
				};
			} else if ($n['mail_type'] == 'tahunan') {
				if ($day == $n['day'] && $bulan == $n['month']) {
					$periode 			= date('d-m-Y');
					$cek_periode 		= $this->db->get_where('auth_email_blast', ['mail_type' => 'Tahunan', 'bulan' => $bulan, 'tahun' => $tahun]);
					if ($cek_periode->num_rows() < 1) {
						// $email = $this->_sendEmail('tahunan', 'years');
						$data = [
							'token' => 123,
							'bulan' => $bulan,
							'tahun' => $tahun,
							'mail_type' => "Tahunan",
							'date_created' => date("Y-m-d h:i:sa")
						];
						$this->db->insert('auth_email_blast', $data);
						// if ($email == '') {
						// 	echo "Email Tahunan Terkirim";
						// } else {
						// 	echo "Email Tahunan Gagal Terkirim";
						// }
					}
				};
			}
		}
		foreach ($warning as $w) {
			if ($w['mail_type'] == 'bulanan_warning') {
				if ($day >= $w['day']) {
					$periode 			= date('m-Y');
					$cek_periode 		= $this->db->get_where('auth_email_blast', ['mail_type' => 'Bulanan', 'bulan' => $bulan, 'tahun' => $tahun]);
					if ($cek_periode->num_rows() < 1) {
						// $email = $this->_sendEmail('123', 'w_month');
						$data = [
							'token' => 123,
							'bulan' => $bulan,
							'tahun' => $tahun,
							'mail_type' => "Bulanan",
							'date_created' => date("Y-m-d h:i:sa")
						];
						$this->db->insert('auth_email_blast', $data);
						// if ($email == '') {
						// 	echo "Email Bulanan Terkirim";
						// } else {
						// 	echo "Email Bulanan Gagal Terkirim";
						// }
					}
				}
			} else if ($w['mail_type'] == 'triwulan_warning') {
				if ($day == $w['day'] && $bulan == $w['month'] || $day == $w['day'] && $bulan == $w['month'] || $day == $w['day'] && $bulan == $w['month'] || $day == $w['day'] && $bulan == $w['month']) {
					$periode 			= date('d-m-Y');
					$cek_periode 		= $this->db->get_where('auth_email_blast', ['mail_type' => 'Triwulan', 'bulan' => $bulan, 'tahun' => $tahun]);
					if ($cek_periode->num_rows() < 1) {
						// $email = $this->_sendEmail('123', 'w_triple');
						$data = [
							'token' => 123,
							'bulan' => $bulan,
							'tahun' => $tahun,
							'mail_type' => "Triwulan",
							'date_created' => date("Y-m-d h:i:sa")
						];
						$this->db->insert('auth_email_blast', $data);
						// if ($email == '') {
						// 	echo "Email Triwulan Terkirim";
						// } else {
						// 	echo "Email Triwulan Gagal Terkirim";
						// }
					}
				};
			} else if ($w['mail_type'] == 'tahunan_warning') {
				if ($day == $w['day'] && $bulan == $w['month']) {
					$periode 			= date('d-m-Y');
					$cek_periode 		= $this->db->get_where('auth_email_blast', ['mail_type' => 'Tahunan', 'bulan' => $bulan, 'tahun' => $tahun]);
					if ($cek_periode->num_rows() < 1) {
						// $email = $this->_sendEmail('123', 'w_years');
						$data = [
							'token' => 123,
							'bulan' => $bulan,
							'tahun' => $tahun,
							'mail_type' => "Tahunan",
							'date_created' => date("Y-m-d h:i:sa")
						];
						$this->db->insert('auth_email_blast', $data);
						// if ($email == '') {
						// 	echo "Email Tahunan Terkirim";
						// } else {
						// 	echo "Email Tahunan Gagal Terkirim";
						// }
					}
				};
			}
		}
	}
	public function signup()
	{
		$data['title'] 			= 'Signup Gar&Shi';
		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('template/signup', $data);

		$this->load->view('template/footer', $data);
		$this->load->view('template/script', $data);
	}


	public function registration()
	{

		$this->form_validation->set_rules('name', 'Nama Depan', 'required|trim');
		$this->form_validation->set_rules('phone', 'No Handphone', 'required|trim');
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|trim|is_unique[auth_user.email]',
			[
				'is_unique' => 'Email ini Sudah Terdaftar'
			]
		);
		// $this->form_validation->set_rules(
		// 	'username',
		// 	'Username',
		// 	'required|trim|is_unique[user.username]',
		// 	[
		// 		'is_unique' => 'Username ini sudah digunakan'
		// 	]
		// );

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|matches[repassword]', [
			'matches' => 'Password not match',
			'min_length' => 'Password too short'
		]);
		$this->form_validation->set_rules('repassword', 'Password Confirmation', 'trim|required|matches[password]');
		// $this->form_validation->set_rules('g-recaptcha-response', 'captcha', 'required|trim');


		if ($this->form_validation->run() == false) {

			if (isset($_POST['signup'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger text-center" 												role="alert">
															  Terjadi kesalahan saat melakukan registrasi, harap periksa kembali data registrasi anda
															</div>');
			}

			$data['title'] = "user Registration";
			$data['logo'] 			= $this->db->get('auth_logo_setting')->row_array();
			// $data['recaptcha'] = $recaptcha;
			$data['mark']                       = $this->uri->segment(3);
			$this->load->view('template/header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('template/login', $data);

			$this->load->view('template/footer', $data);
			$this->load->view('template/script', $data);
		} else {

			$email = htmlspecialchars($this->input->post('email', true));
			$data = [
				'firstName'         => htmlspecialchars($this->input->post('name', true)),

				'telp' 		        => $this->input->post('phone', true),
				'email'             => htmlspecialchars($this->input->post('email', true)),

				'password' 	        => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
				'active' 	        => 0,
				'role_id'	        => 3,
				'created_at' 	    => date("Y-m-d h:i:sa"),
				'update_at'         => date("Y-m-d h:i:sa"),
				'images'			=> "user.png"

			];

			// token

			$token = base64_encode(random_bytes(32));
			$user_token = [
				'email' 		=> $email,
				'token' 		=> $token,
				'time' 			=> time(),
				'date_created'	=> date("Y-m-d h:i:sa")
			];

			$this->db->insert('auth_user', $data);
			$this->db->insert('auth_user_token', $user_token);
			$this->_sendEmail($token, 'verify');
			$this->session->set_flashdata('message', '<div class="alert alert-success text-center" 												role="alert">
															  Congratulation! your account has been created. Please Activate your account. check your email
															</div>');

			$email 	= $this->session->userdata('email');
			$id 	= $this->db->get_where('auth_user', array('email' => $email))->result_array();
			redirect('auth/login');
		}
	}

	public function verify()
	{
		$email 	= htmlspecialchars($this->input->get('email'));
		$token 	= htmlspecialchars($this->input->get('token'));

		$user = $this->db->get_where('auth_user', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('auth_user_token', ['token' => $token])->row_array();

			if ($user_token) {

				if (time() - $user_token['time'] < (60 * 60 * 24)) {

					$this->db->set('active', 1);
					$this->db->where('email', $email);
					$this->db->update('auth_user');

					$this->db->delete('auth_user_token', ['email' => $email]);

					$this->session->set_flashdata('message', '<div class="alert alert-success text-center" 												role="alert">
													  ' . $email . ' Has been activated! Plese login
													</div>');
					redirect('auth');
				} else {


					$this->db->delete('auth_user', ['email' => $email]);
					$this->db->delete('auth_user_token', ['email' => $email]);
					$this->session->set_flashdata('message', '<div class="alert alert-danger text-center" 												role="alert">
													  Account activation failed! token expired
													</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger text-center" 												role="alert">
													  Account activation failed! invalid token
													</div>');
				redirect('auth');
			}
		} else {

			$this->session->set_flashdata('message', '<div class="alert alert-danger text-center" 												role="alert">
													  Account activation failed! wrong email
													</div>');
			redirect('auth');
		};
	}

	private function _sendEmail($token, $type)
	{
		// var_dump($token, $type);
		// die;

		error_reporting(E_STRICT | E_ALL);

		ini_set('max_execution_time', 0);
		set_time_limit(0);
		$email = $this->db->get('auth_email_setting')->row_array();
		// $user = $this->db->get_where('auth_user', ['email_status' => 1, 'role_id' => 3, 'active' => 1])->result_array();
		// $user = $this->db->get('auth_email_dummy')->result_array();
		// $user_warning = $this->Report_model->userNeedWarningMonth()->result_array();
		// $notif = $this->db->get_where('auth_mail_notif', ['mail_type' => $token])->row_array();

		// Load PHPMailer library
		$this->load->library('phpmailer_lib');
		// PHPMailer object
		$mail = $this->phpmailer_lib->load();

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

		$mail->SMTPDebug = 0;
		if ($type == 'verify') {
			$mail->AddAddress($this->input->post('email'));
			$mail->Subject = 'Account Verification';
			//Sets the Subject of the message

			//An HTML or plain text message body
			$mail->Body = 'Click this link to verify your account : <a href="' . base_url('') . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '" >Activate</a>';
		} else if ($type == 'forgot') {
			$mail->AddAddress($this->input->post('email'));
			$mail->Subject = 'Reset Password';
			//Sets the Subject of the message

			//An HTML or plain text message body
			$mail->Body = 'Click this link to reset your password : <a href="' . base_url('') . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '" >Reset Password</a>';
		}



		$mail->AltBody = '';
		// $mail->addAttachment($fileAttachment);
		$result = $mail->Send();
		// $result = 'error';

		// $result;
		// die;

		// if ($result["code"] == '400') {
		// 	$output .= html_entity_decode($result['full_error']);
		// }
		// if ($result["code"] == '200') {
		// 	$output .= "Email Terkirim";
		// }

		// if ($result == false) {
		// 	$output .= "Error, Harap Cek Akun Email Anda";
		// }
	}
	public function mail_manual()
	{
		$user = $this->Report_model->penerima_email('1');
		foreach ($user as $u) {
			$cek = $this->db->get_where('auth_mail_manual', ['to' => $u['email']])->num_rows();

			if ($cek > 0) {
				// echo $u['email'] . 'sudah ada <br>';
				// return false;
			} else {
				// echo $u['email'] . ' Belum ada<br>';;
				$this->sendEmailManual('Bulanan', 'month', $u['email']);
			}
		}
	}
	public function sendEmailManual($token, $type, $user)
	{

		set_time_limit(2000);
		$email = $this->db->get('auth_email_setting')->row_array();
		// $user = $this->db->get_where('auth_user', ['email_status' => 1, 'role_id' => 3, 'active' => 1])->result_array();
		// $user = $this->db->get_where('auth_email_dummy', ['email_status' => 1, 'role_id' => 3, 'active' => 1])->result_array();
		// $notif = $this->db->get_where('auth_mail_notif', ['mail_type' => $token])->row_array();

		// Load PHPMailer library
		// $this->load->library('phpmailer_lib');
		// PHPMailer object
		// $mail = $this->phpmailer_lib->load();
		$mail = new PHPMailer;
		$output = '';

		$mail->IsSMTP();
		//Sets Mailer to send message using SMTP
		// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

		$mail->Host = $email['smtp'];
		// $mail->Host = 'smtp.gmail.com';
		//Sets the SMTP hosts of your Email hosting, this for Gmail

		// $mail->Port = '465';
		$mail->Port = $email['port'];
		// $mail->Port = '587';
		//Sets the default SMTP server port

		$mail->SMTPAuth = true;
		//Sets SMTP authentication. Utilizes the Username and Password variables

		// $mail->Username = 'sipwpt22@gmail.com';
		$mail->Username = $email['email'];
		//Sets SMTP username

		// $mail->Password = 'lqzimklcnmecofbk';
		$mail->Password = $email['password'];
		//Sets SMTP password

		// $mail->SMTPSecure = 'ssl';
		$mail->SMTPSecure = $email['smtp_secure'];
		// $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		// $mail->SMTPSecure = 'tls';
		//Sets connection prefix. Options are "", "ssl" or "tls"

		$mail->From = $email['email'];
		// $mail->From = 'sipwpt22@gmail.com';
		//Sets the From email address for the message

		// $mail->FromName = 'Admin login system';
		$mail->FromName = $email['nama_pengirim'];
		//Sets the From name of the message

		//Adds a "To" address
		// $mail->addBCC('admloginsystem@gmail.com');
		// $mail->addBCC($row["email"], $row["name"]);
		$mail->WordWrap = 50;
		//Sets word wrapping on the body of the message to a given number of characters

		$mail->IsHTML(true);
		//Sets message type to HTML

		if ($type == 'verify') {
			$mail->AddAddress($this->input->post('email'));
			$mail->Subject = 'Account Verification';
			//Sets the Subject of the message

			//An HTML or plain text message body
			$mail->Body = 'Click this link to verify your account : <a href="' . base_url('') . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '" >Activate</a>';
		} else if ($type == 'forgot') {
			$mail->AddAddress($this->input->post('email'));
			$mail->Subject = 'Reset Password';
			//Sets the Subject of the message

			//An HTML or plain text message body
			$mail->Body = 'Click this link to reset your password : <a href="' . base_url('') . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '" >Reset Password</a>';
		} else if ($type == 'month') {
			$notif = $this->db->get_where('auth_mail_notif', ['mail_type' => $token])->row_array();
			// echo "ok";
			$mail->addBCC($user);
			$mail->Subject 		= $notif['subject'];
			$mail->Body 		= htmlspecialchars_decode($notif['body']);
		} else if ($type == 'triple') {
			$notif = $this->db->get_where('auth_mail_notif', ['mail_type' => $token])->row_array();
			// $notif = $this->db->get_where('auth_mail_notif', ['day' => date('d'), 'month' => date('m')])->row_array();
			$mail->AddAddress($user);
			$mail->Subject 		= $notif['subject'];
			$mail->Body 		= $notif['body'];
		} else if ($type == 'years') {
			$notif = $this->db->get_where('auth_mail_notif', ['day' => date('d'), 'month' => date('m')])->row_array();
			// $mail->AddAddress('agungsatriawan21@gmail.com');
			$mail->addBCC($user);
			$mail->Subject 		=  $notif['subject'];
			$mail->Body 		= $notif['body'];
		} else if ($type == 'w_month') {
			$notif = $this->db->get_where('auth_mail_warning', ['mail_type' => 'bulanan_warning'])->row_array();
			// $mail->AddAddress('agungsatriawan21@gmail.com');
			$mail->Subject 		=  $notif['subject'];
			$mail->Body 		= $notif['body'];
		} else if ($type == 'w_triple') {
			$notif = $this->db->get_where('auth_mail_warning', ['day' => date('d'), 'month' => date('m')])->row_array();
			// $mail->AddAddress('agungsatriawan21@gmail.com');
			$mail->Subject 		=  $notif['subject'];
			$mail->Body 		= $notif['body'];
		} else if ($type == 'w_years') {
			$notif = $this->db->get_where('auth_mail_warning', ['day' => date('d'), 'month' => date('m')])->row_array();
			// $mail->AddAddress('agungsatriawan21@gmail.com');
			$mail->Subject 		=  $notif['subject'];
			$mail->Body 		= $notif['body'];
		}

		// $mail->Timeout = 1500;

		$mail->AltBody = '';
		// $mail->addAttachment($fileAttachment);
		// $mail->SMTPDebug = 2;
		$result = $mail->send();
		if ($result) {
			$data = [
				'token' => $token,
				'bulan' => '04',
				'tahun' => '2023',
				'mail_type' => $token,
				'date_created' => date("Y-m-d h:i:sa")
			];
			$this->db->insert('auth_email_blast', $data);

			$data2 = [
				'mail_type' => $token,
				'to' => $user,
				'subject' => $notif['subject'],
				'date_created' => date("Y-m-d h:i:sa")
			];
			$this->db->insert('auth_mail_manual', $data2);
		}

		// $result = 'error';

		// $result;
		// die;

		// if ($result["code"] == '400') {
		// 	$output .= html_entity_decode($result['full_error']);
		// }
		// if ($result["code"] == '200') {
		// 	$output .= "Email Terkirim";
		// }

		// if ($result == false) {
		// 	$output .= "Error, Harap Cek Akun Email Anda";
		// }
	}

	public function logout()
	{
		if ($this->session->userdata('role_id') == 3) {
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('role_id');
			$this->session->unset_userdata('invoice');
			$key = 'E0ZFkqF5';
			$payload = [
				'username' => '',
				'NIB' => ''
			];


			$this->session->set_flashdata('message', '<div class="alert alert-success text-center" 																							role="alert">
													  You have been logout
													</div>');
			redirect('home');
		} else {
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('role_id');
			$key = 'E0ZFkqF5';
			$payload = [
				'username' => '',
				'NIB' => ''
			];


			$this->session->set_flashdata('message', '<div class="alert alert-success text-center" 																							role="alert">
													  You have been logout
													</div>');
			redirect('auth');
		}
	}

	public function block()
	{
		$this->load->view('auth/v_block');
	}
	public function maintenance()
	{
		$this->load->view('welcome_message');
	}

	public function forgotpassword()
	{/*
		 Load the reCAPTCHA library.
		 You can pass the keys here by passing an array to the loader.
		 Check the "Setting the keys" section for more details
		*/
		// $this->load->library('recaptcha');

		/*
		 Create the reCAPTCHA box.
		 You can pass an array of attributes to this method.
		 Check the "Creating the reCAPTCHA box" section for more details
		*/
		// $recaptcha = $this->recaptcha->create_box();
		// $this->form_validation->set_rules('g-recaptcha-response', 'captcha', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if ($this->form_validation->run() == false) {
			// $data['recaptcha'] 		= $recaptcha;
			$data['title'] 			= "Forgot Password";
			$data['logo'] 			= $this->db->get('auth_logo_setting')->row_array();
			$data['mark']           = $this->uri->segment(3);
			$this->load->view('template/header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('template/forgot', $data);

			$this->load->view('template/footer', $data);
			$this->load->view('template/script', $data);
		} else {
			// $score = get_recapture_score($_POST['g-recaptcha-response']);

			// if ($score < RECAPTCHA_ACCEPTABLE_SPAM_SCORE) {
			// return an error of your choosing
			// } else {
			$email = htmlspecialchars($this->input->post('email'));
			$user = $this->db->get_where('auth_user', ['email' => $email, 'active' => 1])->row_array();

			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' 		=> $email,
					'token' 		=> $token,
					'time'			=> time(),
					'date_created'	=> date("Y-m-d h:i:sa")
				];
				$this->db->insert('auth_user_token', $user_token);

				$this->_sendEmail($token, 'forgot');

				$this->session->set_flashdata('message', '<div class="alert alert-success text-center" 												role="alert">
													  Plese check your email to reset password!
													</div>');
				redirect('auth/forgotpassword');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger text-center" 												role="alert">
													  Email is not registered or activated!
													</div>');
				redirect('auth/forgotpassword');
			}
			// }

			// $is_valid = $this->recaptcha->is_valid();

			// if (!$is_valid['success']) {
			// 	redirect($_SERVER['HTTP_REFERER']);
			// }

		}
	}

	public function resetpassword()
	{
		$email 	= htmlspecialchars($this->input->get('email'));
		$token 	= htmlspecialchars($this->input->get('token'));

		$user = $this->db->get_where('auth_user', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('auth_user_token', ['token' => $token])->row_array();
			if ($user_token) {

				if (time() - $user_token['time'] < (60 * 60 * 24)) {

					$this->session->set_userdata('reset_email', $email);
					$this->changepassword();

					$this->session->set_flashdata('message', '<div class="alert alert-success text-center" 												role="alert">
													  ' . $email . ' Create New Password
													</div>');
					redirect('auth/changepassword');
				} else {
					$this->db->delete('user_s', ['email' => $email]);
					$this->db->delete('auth_user', ['email' => $email]);
					$this->db->delete('auth_user_token', ['email' => $email]);
					$this->session->set_flashdata('message', '<div class="alert alert-danger text-center" 												role="alert">
													  Account activation failed! token expired
													</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger text-center" 												role="alert">
													  Account activation failed! invalid token
													</div>');
				redirect('auth');
			}
		} else {

			$this->session->set_flashdata('message', '<div class="alert alert-danger text-center" 												role="alert">
													  Reset password failed! wrong email
													</div>');
			redirect('auth');
		};
	}


	public function changepassword()
	{

		if (!$this->session->userdata('reset_email')) {
			redirect('auth');
		}

		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]|matches[password2]', [
			'matches' 		=> 'Password not match',
			'min_length' 	=> 'Password too short'
		]);

		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['logo'] 			= $this->db->get('auth_logo_setting')->row_array();
			$data['title'] = "Change Password";
			$this->load->view('template/header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('template/changepassword', $data);

			$this->load->view('template/footer', $data);
			$this->load->view('template/script', $data);
		} else {
			$password 	= password_hash($this->input->post('password1'), PASSWORD_BCRYPT);
			$email 		= htmlspecialchars($this->session->userdata('reset_email'));



			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('auth_user');

			$this->session->unset_userdata('reset_email');

			$this->session->set_flashdata('message', '<div class="alert alert-success text-center" 												role="alert">
													  Password has been changed! Please login
													</div>');
			redirect('auth');
		}
	}
}
