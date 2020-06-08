<?php
	/**
	* 
	*/
	function RequestToSSL($POSTDATA)
	{
		$post_data = array();
		$post_data['store_id'] = (empty($POSTDATA['store_id'])) ? 'Need Store ID' : $POSTDATA['store_id'];
		$post_data['store_passwd'] = (empty($POSTDATA['store_id'])) ? 'Need Store Pass' : $POSTDATA['store_passwd'];
		$post_data['total_amount'] = (empty($POSTDATA['total_amount'])) ? 'Need Amount' : $POSTDATA['total_amount'];
		$post_data['currency'] = (empty($POSTDATA['currency'])) ? 'BDT' : $POSTDATA['currency'];
		$post_data['tran_id'] = (empty($POSTDATA['tran_id'])) ? '' : $POSTDATA['tran_id'].uniqid();
		$post_data['success_url'] = (empty($POSTDATA['success_url'])) ? 'Response URL PLZ' : $POSTDATA['success_url'];
		$post_data['fail_url'] = (empty($POSTDATA['fail_url'])) ? 'Fail URL PLZ' : $POSTDATA['fail_url'];
		$post_data['cancel_url'] = (empty($POSTDATA['cancel_url'])) ? 'Cancel URL PLZ' : $POSTDATA['cancel_url'];
		$post_data['multi_card_name'] = (empty($POSTDATA['multi_card_name'])) ? '' : $POSTDATA['multi_card_name'];  # DISABLE TO DISPLAY ALL AVAILABLE

		# EMI INFO
		if(empty($POSTDATA['emi_option']))
		{
			
		}
		else if($POSTDATA['emi_option'] == "1")
		{
			$post_data['emi_option'] = $POSTDATA['emi_option'];
			$post_data['emi_max_inst_option'] = $POSTDATA['emi_max_inst_option'];
			$post_data['emi_selected_inst'] = $POSTDATA['emi_selected_inst'];
		}

		# CUSTOMER INFORMATION
		$post_data['cus_name'] = (empty($POSTDATA['cus_name'])) ? die("Full name needed") : $POSTDATA['cus_name'];
		$post_data['cus_email'] = (empty($POSTDATA['cus_email'])) ? die("Email needed") : $POSTDATA['cus_email'];
		$post_data['cus_add1'] = (empty($POSTDATA['cus_add1'])) ? '' : $POSTDATA['cus_add1'];
		$post_data['cus_add2'] = (empty($POSTDATA['cus_add2'])) ? '' : $POSTDATA['cus_add2'];
		$post_data['cus_city'] = (empty($POSTDATA['cus_city'])) ? '' : $POSTDATA['cus_city'];
		$post_data['cus_state'] = (empty($POSTDATA['cus_state'])) ? '' : $POSTDATA['cus_state'];
		$post_data['cus_postcode'] = (empty($POSTDATA['cus_postcode'])) ? '' : $POSTDATA['cus_postcode'];
		$post_data['cus_country'] = (empty($POSTDATA['cus_country'])) ? '' : $POSTDATA['cus_country'];
		$post_data['cus_phone'] = (empty($POSTDATA['cus_phone'])) ? 'die("Phone number needed")' : $POSTDATA['cus_phone'];
		$post_data['cus_fax'] = (empty($POSTDATA['cus_fax'])) ? '' : $POSTDATA['cus_fax'];

		# SHIPMENT INFORMATION
		$post_data['ship_name'] = (empty($POSTDATA['ship_name'])) ? '' : $POSTDATA['ship_name'];
		$post_data['ship_add1 '] = (empty($POSTDATA['ship_add1'])) ? '' : $POSTDATA['ship_add1'];
		$post_data['ship_add2'] = (empty($POSTDATA['ship_add2'])) ? '' : $POSTDATA['ship_add2'];
		$post_data['ship_city'] = (empty($POSTDATA['ship_city'])) ? '' : $POSTDATA['ship_city'];
		$post_data['ship_state'] = (empty($POSTDATA['ship_state'])) ? '' : $POSTDATA['ship_state'];
		$post_data['ship_postcode'] = (empty($POSTDATA['ship_postcode'])) ? '' : $POSTDATA['ship_postcode'];
		$post_data['ship_country'] =  (empty($POSTDATA['ship_country'])) ? '' : $POSTDATA['ship_country'];

		# OPTIONAL PARAMETERS
		$post_data['value_a'] = (empty($POSTDATA['value_a'])) ? '' : $POSTDATA['value_a'];
		$post_data['value_b '] = (empty($POSTDATA['value_b'])) ? '' : $POSTDATA['value_b'];
		$post_data['value_c'] = (empty($POSTDATA['value_c'])) ? '' : $POSTDATA['value_c'];
		$post_data['value_d'] = (empty($POSTDATA['value_d'])) ? '' : $POSTDATA['value_d'];

		# CART PARAMETERS
		$post_data['cart'] = (empty($POSTDATA['cart'])) ? '' : $POSTDATA['cart'];
		$post_data['product_amount'] = (empty($POSTDATA['product_amount'])) ? '' : $POSTDATA['product_amount'];
		$post_data['vat'] = (empty($POSTDATA['vat'])) ? '' : $POSTDATA['vat'];
		$post_data['discount_amount'] = (empty($POSTDATA['discount_amount'])) ? '' : $POSTDATA['discount_amount'];
		$post_data['convenience_fee'] = (empty($POSTDATA['convenience_fee'])) ? '' : $POSTDATA['convenience_fee'];

		$direct_api_url = (empty($POSTDATA['api'])) ? die("API Needed!") : $POSTDATA['api'];

		$handle = curl_init();
		curl_setopt($handle, CURLOPT_URL, $direct_api_url );
		curl_setopt($handle, CURLOPT_TIMEOUT, 30);
		curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($handle, CURLOPT_POST, 1 );
		curl_setopt($handle, CURLOPT_POSTFIELDS, $POSTDATA);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, empty($POSTDATA['SSL_VERIFY']) ? FALSE : $POSTDATA['SSL_VERIFY']); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC

		// echo "";
		// exit();

		$content = curl_exec($handle);

		$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

		if($code == 200 && !( curl_errno($handle))) 
		{
			curl_close( $handle);
			$sslcommerzResponse = $content;
		} 
		else 
		{
			curl_close( $handle);
			echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
			exit;
		}

		# PARSE THE JSON RESPONSE
		$sslcz = json_decode($sslcommerzResponse, true );

		if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) 
		{
			# THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
		    # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
			echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";
			# header("Location: ". $sslcz['GatewayPageURL']);
			exit;
		}
		else 
		{
			echo "JSON Data parsing error!";
		}
	}
?>