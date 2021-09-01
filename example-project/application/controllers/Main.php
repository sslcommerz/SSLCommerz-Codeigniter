<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->load->view('home');
	}

	public function hosted_view()
	{
		$this->load->view('hostedcheckout');
	}
	public function easycheckout_view()
	{
		$this->load->view('easycheckout');
	}

	public function request_api_hosted()
	{
		if($this->input->get_post('placeorder'))
		{
			$post_data = array();
			$post_data['total_amount'] = $this->input->post('amount');
			$post_data['currency'] = "USD";
			$post_data['tran_id'] = "SSLC".uniqid();
			$post_data['success_url'] = base_url()."success";
			$post_data['fail_url'] = base_url()."fail";
			$post_data['cancel_url'] = base_url()."cancel";
			$post_data['ipn_url'] = base_url()."ipn";
			# $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE

			# EMI INFO
			// $post_data['emi_option'] = "1";
			// $post_data['emi_max_inst_option'] = "9";
			// $post_data['emi_selected_inst'] = "9";

			# CUSTOMER INFORMATION
			$post_data['cus_name'] = $this->input->post('fname')." ".$this->input->post('fname');
			$post_data['cus_email'] = $this->input->post('cus_email');
			$post_data['cus_add1'] = $this->input->post('add1');
			$post_data['cus_city'] = $this->input->post('state');
			$post_data['cus_state'] = $this->input->post('state');
			$post_data['cus_postcode'] = $this->input->post('postcode');
			$post_data['cus_country'] = $this->input->post('country');
			$post_data['cus_phone'] = $this->input->post('cus_phone');

			# SHIPMENT INFORMATION
			$post_data['ship_name'] = $this->input->post('fname')." ".$this->input->post('fname');
			$post_data['ship_add1'] = $this->input->post('add1');
			$post_data['ship_city'] = $this->input->post('state');
			$post_data['ship_state'] = $this->input->post('state');
			$post_data['ship_postcode'] = $this->input->post('postcode');
			$post_data['ship_country'] = $this->input->post('country');

			# OPTIONAL PARAMETERS
			$post_data['value_a'] = "ref001";
			$post_data['value_b'] = "ref002";
			$post_data['value_c'] = "ref003";
			$post_data['value_d'] = "ref004";

			$post_data['product_profile'] = "physical-goods";
			$post_data['shipping_method'] = "YES";
			$post_data['num_of_item'] = "3";
			$post_data['product_name'] = "Computer,Speaker";
			$post_data['product_category'] = "Ecommerce";

			$this->load->library('session');

			$session = array(
				'tran_id' => $post_data['tran_id'],
				'amount' => $post_data['total_amount'],
				'currency' => $post_data['currency']
			);
			$this->session->set_userdata('tarndata', $session);

			echo "<pre>";
			print_r($post_data);
			if($this->sslcommerz->RequestToSSLC($post_data, SSLCZ_STORE_ID, SSLCZ_STORE_PASSWD))
			{
				echo "Pending";
				/***************************************
				# Change your database status to Pending.
				****************************************/
			}
		}
	}

	public function easycheckout_endpoint()
	{
		$tran_id = $_REQUEST['order'];
		$jsondata = json_decode($_REQUEST['cart_json'], true);

		$post_data = array();
		$post_data['total_amount'] = $jsondata['amount'];
		$post_data['currency'] = "USD";
		$post_data['tran_id'] = $tran_id;
		$post_data['success_url'] = base_url()."success";
		$post_data['fail_url'] = base_url()."fail";
		$post_data['cancel_url'] = base_url()."cancel";
		$post_data['ipn_url'] = base_url()."ipn";
		# $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE

		# EMI INFO
		// $post_data['emi_option'] = "1";
		// $post_data['emi_max_inst_option'] = "9";
		// $post_data['emi_selected_inst'] = "9";

		# CUSTOMER INFORMATION
		$post_data['cus_name'] = $jsondata['cus_name'];
		$post_data['cus_email'] = $jsondata['email'];
		$post_data['cus_add1'] = $jsondata['address'];
		$post_data['cus_city'] = $jsondata['state'];
		$post_data['cus_state'] = $jsondata['state'];
		$post_data['cus_postcode'] = $jsondata['amount'];
		$post_data['cus_country'] = $jsondata['zip'];
		$post_data['cus_phone'] = $jsondata['phone'];

		# SHIPMENT INFORMATION
		$post_data['ship_name'] = $jsondata['cus_name'];
		$post_data['ship_add1'] = $jsondata['address'];
		$post_data['ship_city'] = $jsondata['state'];
		$post_data['ship_state'] = $jsondata['state'];
		$post_data['ship_postcode'] = $jsondata['zip'];
		$post_data['ship_country'] = $jsondata['country'];

		# OPTIONAL PARAMETERS
		$post_data['value_a'] = "ref001";
		$post_data['value_b'] = "ref002";
		$post_data['value_c'] = "ref003";
		$post_data['value_d'] = "ref004";

		$post_data['product_profile'] = "physical-goods";
		$post_data['shipping_method'] = "YES";
		$post_data['num_of_item'] = "3";
		$post_data['product_name'] = "Computer,Speaker";
		$post_data['product_category'] = "Ecommerce";

		$this->load->library('session');

		$session = array(
			'tran_id' => $post_data['tran_id'],
			'amount' => $post_data['total_amount'],
			'currency' => $post_data['currency']
		);
		$this->session->set_userdata('tarndata', $session);

		// echo "<pre>";
		// print_r($post_data);
		if($this->sslcommerz->EasyCheckout($post_data, SSLCZ_STORE_ID, SSLCZ_STORE_PASSWD))
		{
			echo "Pending";
			/***************************************
			# Change your database status to Pending.
			****************************************/
		}
	}

	public function success_payment()
	{
		$database_order_status = 'Pending'; // Check this from your database here Pending is dummy data,
		$sesdata = $this->session->userdata('tarndata');

		if(($sesdata['tran_id'] == $_POST['tran_id']) && ($sesdata['amount'] == $_POST['currency_amount']) && ($sesdata['currency'] == 'USD'))
		{
			if($this->sslcommerz->ValidateResponse($_POST, $_POST['currency_amount'], $sesdata['currency']))
			{
				if($database_order_status == 'Pending')
				{
					/*****************************************************************************
					# Change your database status to Processing & You can redirect to success page from here
					******************************************************************************/
					echo "Transaction Successful<br>";
					echo "Processing";
					echo "<pre>";
					print_r($_POST);exit;
				}
				else
				{
					/******************************************************************
					# Just redirect to your success page status already changed by IPN.
					******************************************************************/
					echo "Just redirect to your success page";
				}
			}
		}
	}
	public function fail_payment()
	{
		$database_order_status = 'Pending'; // Check this from your database here Pending is dummy data,
		if($database_order_status == 'Pending')
		{
			/*****************************************************************************
			# Change your database status to FAILED & You can redirect to failed page from here
			******************************************************************************/
			echo "<pre>";
			print_r($_POST);
			echo "Transaction Faild";
		}
		else
		{
			/******************************************************************
			# Just redirect to your success page status already changed by IPN.
			******************************************************************/
			echo "Just redirect to your failed page";
		}	
	}
	public function cancel_payment()
	{
		$database_order_status = 'Pending'; // Check this from your database here Pending is dummy data,
		if($database_order_status == 'Pending')
		{
			/*****************************************************************************
			# Change your database status to CANCELLED & You can redirect to cancelled page from here
			******************************************************************************/
			echo "<pre>";
			print_r($_POST);
			echo "Transaction Canceled";
		}
		else
		{
			/******************************************************************
			# Just redirect to your cancelled page status already changed by IPN.
			******************************************************************/
			echo "Just redirect to your failed page";
		}
	}
	public function ipn_listener()
	{
		$database_order_status = 'Pending'; // Check this from your database here Pending is dummy data,
		$store_passwd = SSLCZ_STORE_PASSWD;
		if($ipn = $this->sslcommerz->ipn_request($store_passwd, $_POST))
		{
			if(($ipn['gateway_return']['status'] == 'VALIDATED' || $ipn['gateway_return']['status'] == 'VALID') && $ipn['ipn_result']['hash_validation_status'] == 'SUCCESS')
			{
				if($database_order_status == 'Pending')
				{
					echo $ipn['gateway_return']['status']."<br>";
					echo $ipn['ipn_result']['hash_validation_status']."<br>";
					/*****************************************************************************
					# Check your database order status, if status = 'Pending' then chang status to 'Processing'.
					******************************************************************************/
				}
			}
			elseif($ipn['gateway_return']['status'] == 'FAILED' && $ipn['ipn_result']['hash_validation_status'] == 'SUCCESS')
			{
				if($database_order_status == 'Pending')
				{
					echo $ipn['gateway_return']['status']."<br>";
					echo $ipn['ipn_result']['hash_validation_status']."<br>";
					/*****************************************************************************
					# Check your database order status, if status = 'Pending' then chang status to 'FAILED'.
					******************************************************************************/
				}
			}
			elseif ($ipn['gateway_return']['status'] == 'CANCELLED' && $ipn['ipn_result']['hash_validation_status'] == 'SUCCESS') 
			{
				if($database_order_status == 'Pending')
				{
					echo $ipn['gateway_return']['status']."<br>";
					echo $ipn['ipn_result']['hash_validation_status']."<br>";
					/*****************************************************************************
					# Check your database order status, if status = 'Pending' then chang status to 'CANCELLED'.
					******************************************************************************/
				}
			}
			else
			{
				if($database_order_status == 'Pending')
				{
					echo "Order status not ".$ipn['gateway_return']['status'];
					/*****************************************************************************
					# Check your database order status, if status = 'Pending' then chang status to 'FAILED'.
					******************************************************************************/
				}
			}
			echo "<pre>";
			print_r($ipn);
		}
	}
}
	