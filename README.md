# Codeigniter V3 for SSLC V4

This library made based on new new SSLCommerz V4 API.
#### Prerequisite
  - PHP 5.6
  - MySQL(5.1+)
  - TLS V1.2(For Sandbox API)
#### New Features!
  - SSLCOMMERZ V4 API
  - AUTO IPN Request from script end
  - SSLCommerz EasyCheckout/Hosted UI
#### Configuration
Please follow below steps
```sh
- Your-project\application\config autoload.php | Add below libraries & helper
$autoload['libraries'] = array('session', 'sslcommerz');
$autoload['helper'] = array('sslc','url');
- Your-project\application\config config.php | Add your project base URL
$config['base_url'] = 'http://localhost:8080/project-name/';
- Your-project\application\libraries | Copy Sslcommerz.php library here
- Your-project\application\helpers | Copy sslc_helper.php helper here and change the API credentials & API mode
define("SSLCZ_STORE_ID", "testbox"); Your Test/Live Store Id
define("SSLCZ_STORE_PASSWD", "qwerty"); Your Test/Live Store Password
define("SSLCZ_IS_SANDBOX", true); 'true' for Sandbox/ 'false' for Securepay
```
#### Libraries Methods
Below Sslcommerz Library method you need to call from your controller 
```sh
- For Hosted Checkout
$this->sslcommerz->RequestToSSLC($post_data, SSLCZ_STORE_ID, SSLCZ_STORE_PASSWD);
- For Easy Checkout
$this->sslcommerz->EasyCheckout($post_data, SSLCZ_STORE_ID, SSLCZ_STORE_PASSWD);
- Order Validation
$this->sslcommerz->ValidateResponse($_POST['currency_amount'], $sesdata['currency'], $_POST);
- IPN Request
$this->sslcommerz->ipn_request($store_passwd, $_POST);
```
#### View Page Config for EasyCheckout
You need to add below js script for form data & easycheckout pop up.
```sh
- For EasyCheckout Pop Up
<?php 
    $api = SSLCZ_IS_SANDBOX ? 'https://sandbox.sslcommerz.com/embed.min.js?' : 'https://seamless-epay.sslcommerz.com/embed.min.js?';
?>
<script type="text/javascript">
    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            script.src = "<?php echo $api; ?>" + Math.random().toString(36).substring(7);
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>
<button type="submit" id="sslczPayBtn" class="btn btn-primary btn-lg btn-block" token="" postdata="" order="<?php echo "SSLC".uniqid(); ?>" endpoint="<?php echo base_url(); ?>easyendpoint">Place Order</button>
- Get form data by below script
<script type="text/javascript">
    function changeObj() {
        var obj = {};
        cus_name='';
        if($('.firstName').val() && $('.lastName').val() ) {
            fname = $('.firstName').val();
            lname = $('.lastName').val();
            obj.cus_name = fname + " " + lname;
        }
        if($('.amount').val()) {
            obj.amount = $('.amount').val();
        }
        if($('.email').val()) {
            obj.email = $('.email').val();
        }
        if($('.phone').val()) {
            obj.phone = $('.phone').val();
        }
        if($('.address').val()) {
            obj.address = $('.address').val();
        }
        if($('.country').val()) {
            obj.country = $('.country').val();
        }
        if($('.state').val()) {
            obj.state = $('.state').val();
        }
        if($('.zip').val()) {
            obj.zip = $('.zip').val();
        }

        if($('.amount').val() && cus_name !='' && $('.email').val() && $('.phone').val() && $('.address').val()&& $('.country').val()&& $('.state').val() && $('.zip').val()) 
        {
            var obj = {  "amount": amount, "cus_name": cus_name, "cus_email": email, "cus_phone": phone, "address": address, "country": country, "state": state, "zip": zip  };
        }

        $('#sslczPayBtn').prop('postdata', obj);
    }
    changeObj();

    $(".firstName").on('change', function () {
       changeObj();
    });
    $(".lastName").on('change', function () {
       changeObj();
    });
    $(".email").on('change', function () {
       changeObj();
    });
    $(".phone").on('change', function () {
       changeObj();
    });
    $(".address").on('change', function () {
       changeObj();
    });
    $(".country").on('change', function () {
       changeObj();
    });
    $(".state").on('change', function () {
       changeObj();
    });
    $(".zip").on('change', function () {
       changeObj();
    });
</script>

```
#### Required Parameter 
Pass below parameter through API to connect Payment Gateway
```sh
    $post_data = array();
    $post_data['total_amount'] = $this->input->post('amount');
    $post_data['currency'] = "USD"; # or any other currency
    $post_data['tran_id'] = "SSLC".uniqid();
    $post_data['success_url'] = base_url()."success";
    $post_data['fail_url'] = base_url()."fail";
    $post_data['cancel_url'] = base_url()."cancel";
    $post_data['ipn_url'] = base_url()."ipn";
    # $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE
    
    # EMI INFO
    # $post_data['emi_option'] = "1";
    # $post_data['emi_max_inst_option'] = "9";
    # $post_data['emi_selected_inst'] = "9";
    # $post_data['emi_allow_only'] = '1'
    
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
```
To know more about all Mandatory Parameter visit [SSLCOMMERZ Developer Page](https://developer.sslcommerz.com/doc/v4/#init-readyparams)
#### Route Example 
```sh
$route['default_controller'] = 'Main';
# HOSTED SSLC
$route['requestapih'] = 'Main/request_api_hosted';
$route['hosted'] = 'Main/hosted_view';
# EASY CHECKOUT SSLC
$route['easycheckout'] = 'Main/easycheckout_view';
$route['easyendpoint'] = 'Main/easycheckout_endpoint';
# COMMON ROUTE SSLC
$route['success'] = 'Main/success_payment';
$route['fail'] = 'Main/fail_payment';
$route['cancel'] = 'Main/cancel_payment';
$route['ipn'] = 'Main/ipn_listener';
```
---------------------------------------------------------------------------------

- Author : SSLCOMMERZ
- Contributor: Prabal Mallick
- Team Email: integration@sslcommerz.com (For any query)
- More info: https://www.sslcommerz.com

© 2018-2019 SSLCOMMERZ ALL RIGHTS RESERVED
