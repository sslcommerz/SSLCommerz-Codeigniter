# SSLCommerz - CodeIgniter V2-V3 

SSLCOMMERZ-Online Payment Gateway for Bangladesh. This Module Work for CodeIgniter V2.x-3.x

### Prerequisites

1. PHP 5.6-7.2 and Mysql.
2. cURL php extension.
3. [Sandbox Account](https://developer.sslcommerz.com/registration/ "SSLCommerz Sandbox Registration")
4. TLS v1.2 (For Sandbox)


### Installation Steps:

Please follow these steps to install the SSLCOMMERZ Payment Gateway module.

- Step 1: First Download the File from sslcommerz/CodeIgniter-V-2.x-3.x-IPN.
- Step 2: Unzip CodeIgniter-V-2.x-3.x-IPN.
- Step 3: Copy & Paste libraries & helpers folder to your project application folder.
- Step 4: Now go to application >> helpers >> sslc_helper.php
- Step 5: Change SSLCZ_STORE_ID, SSLCZ_STORE_PASSWD with your store id and password given by SSLCOMMERZ `define("SSLCZ_STORE_ID", "XXXXX");define("SSLCZ_STORE_PASSWD", "XXXXX");`
- Step 6: If you are using SANDBOX storied and password then `define("SSLCZ_IS_SANDBOX", true);` keep SSLCZ_IS_SANDBOX, true. If you are using Live store id and password then turn SSLCZ_IS_SANDBOX, false.
- Step 7: If you are using Localhost then `define("SSLCZ_IS_LOCAL_HOST", true);` keep SSLCZ_IS_LOCAL_HOST, true. If you are using Live server then turn SSLCZ_IS_LOCAL_HOST, false.
- Step 8: Now go to application >> config >> autoload.php and make this changes 
	`$autoload['helper'] = array('sslc');`
	`$autoload['libraries'] = array('session', 'sslcommerz');``
- Step 9: Now create a controller and copy and paste below code

	```public function requestssl()
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
			$post_data['store_id'] = SSLCZ_STORE_ID;
			$post_data['store_passwd'] = SSLCZ_STORE_PASSWD;
			$post_data['total_amount'] = $amount;
			$post_data['currency'] = "BDT";
			$post_data['tran_id'] = uniqid()."_sslc";
			$post_data['success_url'] = "http://localhost/SSLW/index.php/validate";
			$post_data['fail_url'] = "http://localhost/SSLW/index.php/fail";
			$post_data['cancel_url'] = "http://localhost/SSLW/index.php/cancel";
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

			$this->load->library('session');

			$session = array(
				'tran_id' => $post_data['tran_id'],
				'amount' => $post_data['total_amount'],
				'currency' => $post_data['currency']
			);
			$this->session->set_userdata('tarndata', $session);


			#$this->load->library('sslcommerz');
			echo "<pre>";
			print_r($post_data);
			if($this->sslcommerz->RequestToSSLC($post_data, false))
			{
				echo "Pending";
				#***************************************
				# Change your database status to Pending.
				#***************************************
			}
		}
	}

	public function validateresponse()
	{
		# $this->load->library('sslcommerz');
		$database_order_status = 'Pending'; # Check this from your database here Pending is dummy data.
		$sesdata = $this->session->userdata('tarndata');

		if(($sesdata['tran_id'] == $_POST['tran_id']) && ($sesdata['amount'] == $_POST['amount']) && ($sesdata['currency'] == $_POST['currency']))
		{
			if($this->sslcommerz->ValidateResponse($_POST['amount'], $_POST['currency'], $_POST))
			{
				if($database_order_status == 'Pending')
				{
					#****************************************************************************
					# Change your database status to Processing & You can redirect to success page from here
					#*****************************************************************************
					echo "Transaction Successful<br>";
					echo "Processing";
					echo "<pre>";
					print_r($_POST);exit;
				}
				else
				{
					#*****************************************************************
					# Just redirect to your success page status already changed by IPN.
					#*****************************************************************
					echo "Just redirect to your success page";
				}
			}
		}
	}
	public function fail()
	{
		$database_order_status = 'FAILED'; #Check this from your database here Pending is dummy data,
		if($database_order_status == 'FAILED')
		{
			#*****************************************************************************
			# Change your database status to FAILED & You can redirect to failed page from here
			#*****************************************************************************
			echo "<pre>";
			print_r($_POST);
			echo "Transaction Faild";
		}
		else
		{
			#******************************************************************
			# Just redirect to your success page status already changed by IPN.
			#******************************************************************
			echo "Just redirect to your failed page";
		}	
	}
	public function cancel()
	{
		$database_order_status = 'CANCELLED'; # Check this from your database here Pending is dummy data,
		if($database_order_status == 'CANCELLED')
		{
			#*****************************************************************************
			# Change your database status to CANCELLED & You can redirect to cancelled page from here
			#******************************************************************************
			echo "<pre>";
			print_r($_POST);
			echo "Transaction Canceled";
		}
		else
		{
			#******************************************************************
			# Just redirect to your cancelled page status already changed by IPN.
			#******************************************************************
			echo "Just redirect to your failed page";
		}
	}
	public function ipn()
	{
		#$this->load->library('sslcommerz');
		$database_order_status = 'Pending'; # Check this from your database here Pending is dummy data,
		$store_passwd = SSLCZ_STORE_PASSWD;
		if($ipn = $this->sslcommerz->ipn_request($store_passwd, $_POST))
		{
			if(($ipn['gateway_return']['status'] == 'VALIDATED' || $ipn['gateway_return']['status'] == 'VALID') && $ipn['ipn_result']['hash_validation_status'] == 'SUCCESS')
			{
				if($database_order_status == 'Pending')
				{
					echo $ipn['gateway_return']['status']."<br>";
					echo $ipn['ipn_result']['hash_validation_status']."<br>";
					#*****************************************************************************
					# Check your database order status, if status = 'Pending' then chang status to 'Processing'.
					#******************************************************************************
				}
			}
			elseif($ipn['gateway_return']['status'] == 'FAILED' && $ipn['ipn_result']['hash_validation_status'] == 'SUCCESS')
			{
				if($database_order_status == 'Pending')
				{
					echo $ipn['gateway_return']['status']."<br>";
					echo $ipn['ipn_result']['hash_validation_status']."<br>";
					#*****************************************************************************
					# Check your database order status, if status = 'Pending' then chang status to 'FAILED'.
					#******************************************************************************
				}
			}
			elseif ($ipn['gateway_return']['status'] == 'CANCELLED' && $ipn['ipn_result']['hash_validation_status'] == 'SUCCESS') 
			{
				if($database_order_status == 'Pending')
				{
					echo $ipn['gateway_return']['status']."<br>";
					echo $ipn['ipn_result']['hash_validation_status']."<br>";
					#*****************************************************************************
					# Check your database order status, if status = 'Pending' then chang status to 'CANCELLED'.
					#******************************************************************************
				}
			}
			else
			{
				if($database_order_status == 'Pending')
				{
					echo "Order status not ".$ipn['gateway_return']['status'];
					#*****************************************************************************
					# Check your database order status, if status = 'Pending' then chang status to 'FAILED'.
					#******************************************************************************
				}
			}
			echo "<pre>";
			print_r($ipn);
		}
	}```

- Step 10: Now go to application >> config >> routes.php and create 5 route (For CI >= 3)
```$route['requestssl'] = 'main/requestssl';
$route['validate'] = 'main/validateresponse';
$route['fail'] = 'main/fail';
$route['cancel'] = 'main/cancel';
$route['ipn'] = 'main/ipn';```

- Step 11: Set your IPN URL in your merchant panel
** If you face any problem, you can also check: 
•	SSLW – Full project.

---------------------------------------------------------------------------------

- Author : Prabal Mallick
- Team Email: integration@sslcommerz.com (For any query)
- More info: https://www.sslcommerz.com

© 2018 SSLCOMMERZ ALL RIGHTS RESERVED