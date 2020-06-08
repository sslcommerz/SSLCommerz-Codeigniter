<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function requestssl()
	{
		if($this->input->get_post('submit'))
		{
			$full_name = $this->input->post('fname');
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');
			$amount = $this->input->post('amount');
			$country = $this->input->post('country');
			$address = $this->input->post('address');
			$street = $this->input->post('street');
			$state = $this->input->post('state');
			$city = $this->input->post('city');
			$postcode =	$this->input->post('postcode');

			$post_data = array();
			# $post_data['api'] = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";
			# $post_data['SSL_VERIFY'] = TRUE; # ENABLE WHEN USING IN LIVE SERVER
			$post_data['store_id'] = "testbox";
			$post_data['store_passwd'] = "qwerty";
			$post_data['total_amount'] = $amount;
			$post_data['currency'] = "BDT";
			$post_data['tran_id'] = "SSLCZ_TEST_";
			$post_data['success_url'] = "http://localhost/SSL/success.php";
			$post_data['fail_url'] = "http://localhost/SSL/fail.php";
			$post_data['cancel_url'] = "http://localhost/SSL/cancel.php";
			# $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE

			# EMI INFO
			# $post_data['emi_option'] = "0"; 	if "1" then remove comment emi_max_inst_option and emi_selected_inst
			# $post_data['emi_max_inst_option'] = "9";
			# $post_data['emi_selected_inst'] = "9";

			# CUSTOMER INFORMATION
			$post_data['cus_name'] = $full_name;
			$post_data['cus_email'] = $email;
			$post_data['cus_add1'] = $address;
			$post_data['cus_add2'] = "";
			$post_data['cus_city'] = $city;
			$post_data['cus_state'] = $state;
			$post_data['cus_postcode'] = "1000";
			$post_data['cus_country'] = $country;
			$post_data['cus_phone'] = $phone;
			$post_data['cus_fax'] = "";

			# SHIPMENT INFORMATION
			$post_data['ship_name'] = "Store Test";
			$post_data['ship_add1 '] = "Dhaka";
			$post_data['ship_add2'] = "Dhaka";
			$post_data['ship_city'] = "Dhaka";
			$post_data['ship_state'] = "Dhaka";
			$post_data['ship_postcode'] = "1000";
			$post_data['ship_country'] = "Bangladesh";

			# OPTIONAL PARAMETERS
			$post_data['value_a'] = "ref001";
			$post_data['value_b '] = "ref002";
			$post_data['value_c'] = "ref003";
			$post_data['value_d'] = "ref004";

			# CART PARAMETERS
			$post_data['cart'] = json_encode(array(
			    array("product"=>"DHK TO BRS AC A1","amount"=>"200.00"),
			    array("product"=>"DHK TO BRS AC A2","amount"=>"200.00"),
			    array("product"=>"DHK TO BRS AC A3","amount"=>"200.00"),
			    array("product"=>"DHK TO BRS AC A4","amount"=>"200.00")    
			));
			$post_data['product_amount'] = "100";
			$post_data['vat'] = "5";
			$post_data['discount_amount'] = "5";
			$post_data['convenience_fee'] = "3";

			$_SESSION['payment_values'] = array();

			$_SESSION['payment_values']['tran_id'] = $post_data['tran_id'];
			$_SESSION['payment_values']['amount'] = $post_data['total_amount'];
			$_SESSION['payment_values']['currency'] = $post_data['currency'];

			// $sslc = new SSLCommerz();
			// $sslc->RequestToSSLC($post_data, false);
		}
	}
}
