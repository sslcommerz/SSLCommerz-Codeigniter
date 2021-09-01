<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SSLCOMMERZ V4 | CI3</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/coming-soon.min.css" rel="stylesheet">

</head>

<body>

    <div class="overlay"></div>
    <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
        <source src="<?php echo base_url(); ?>assets/mp4/bg.mp4" type="video/mp4">
    </video>

    <div class="masthead">
        <div class="masthead-bg"></div>
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-12 my-auto">
                    <div class="masthead-content text-white py-5 py-md-0">
                        <h1 class="mb-3">SSLCOMMERZ</h1>
                        <p class="mb-5">SSLCommerz V4 Library For Codeigniter V3<br>
                            Last Update <strong>22 April, 2021</strong></p>
                        <div class="input-group input-group-newsletter">
                            <div class="btn-group btn-group-lg">
							  	<button type="button" class="btn btn-success" onclick="window.location.href = '<?php echo base_url(); ?>easycheckout';">Easy Checkout</button>
							  	<button type="button" class="btn btn-secondary" onclick="window.location.href = '<?php echo base_url(); ?>hosted';">Hosted Checkout</button>
							</div>
                        </div>
                        <br><br><br><br>
          				<img src="<?php echo base_url(); ?>assets/img/sslcommerz.png" alt="SSLCOMMERZ" width="200" height="50">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="social-icons">
        <ul class="list-unstyled text-center mb-0">
        	<li class="list-unstyled-item">
                <a href="https://www.facebook.com/SSLCOMMERZ/" target="_blank">
                    <i class="fab fa-facebook-f"></i>
                </a>
            </li>
            <li class="list-unstyled-item">
                <a href="https://twitter.com/sslcommerzbd" target="_blank">
                    <i class="fab fa-twitter"></i>
                </a>
            </li>
        </ul>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="<?php echo base_url(); ?>assets/js/coming-soon.min.js"></script>

</body>

</html>
