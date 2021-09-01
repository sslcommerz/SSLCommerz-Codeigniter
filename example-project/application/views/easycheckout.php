<?php 
    $api = SSLCZ_IS_SANDBOX ? 'https://sandbox.sslcommerz.com/embed.min.js?' : 'https://seamless-epay.sslcommerz.com/embed.min.js?';
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="./css/form-validation.css" rel="stylesheet">

    <title>Easy Checkout Example</title>
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
</head>

<body class="bg-light">

    <div class="container">
        <br>
        <button type="button" class="btn btn-warning" onclick="window.location.href = '<?php echo base_url(); ?>';">Back</button>
        <div class="py-5 text-center">
            <!-- <img class="d-block mx-auto mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
            <h2>Hosted Checkout</h2>
            <p class="lead">Below is an example for SSLCOMMERZ Easy Checkout.</p><hr class="mb-4">
        </div>
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Product name</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">$12</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Second product</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">$8</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Third item</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">$5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Promo code</h6>
                            <small>SSLC-2468</small>
                        </div>
                        <span class="text-success">-$5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>$20</strong>
                    </li>
                </ul>

                <form class="card p-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Promo code">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-secondary">Redeem</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing Address</h4>
                <form class="needs-validation" novalidate id="eform">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="hidden" class="amount" name="amount" value="20" id="amount">
                            <input type="text" class="form-control firstName" id="firstName" name="fname" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control lastName" id="lastName" name="lname" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control email" id="email" name="cus_email" placeholder="you@example.com" required>
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control phone" id="phone" name="cus_phone" placeholder="017XXXXXXXXX" required> 
                        <div class="invalid-feedback">
                            Please enter a valid phone number for shipping updates.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control address" id="address" name="add1" placeholder="1234 Main St" required>
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control" id="address2" name="add2" placeholder="Apartment or suite">
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <select class="custom-select d-block w-100 country" id="country" required name="country">
                                <option value="">Choose...</option>
                                <option value="Bangladesh">Bangladesh</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">State</label>
                            <select class="custom-select d-block w-100 state" id="state" required name="state">
                                <option value="">Choose...</option>
                                <option value="Dhaka">Dhaka</option>
                                <option value="Gazipur">Gazipur</option>
                                <option value="Narayanganj">Narayanganj</option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control zip" id="zip" placeholder="" required name="postcode">
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="same-address" checked>
                        <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="save-info" checked>
                        <label class="custom-control-label" for="save-info">Save this information for next time</label>
                    </div>
                    <hr class="mb-4">

                    <h4 class="mb-3">Payment Method</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                            <label class="custom-control-label" for="credit">Local or International Debit/Credit/VISA/Master Card, bKash, DBBL etc</label>
                        </div>
                    </div>
                    <hr class="mb-4">

                    <button type="submit" id="sslczPayBtn" class="btn btn-primary btn-lg btn-block" token="" postdata="" order="<?php echo "SSLC".uniqid(); ?>" endpoint="<?php echo base_url(); ?>easyendpoint">Place Order</button>
                </form>
            </div>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">2019 &copy; SSLCOMMERZ</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.4/holder.min.js" integrity="sha256-ifihHN6L/pNU1ZQikrAb7CnyMBvisKG3SUAab0F3kVU=" crossorigin="anonymous"></script>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';

            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');

                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        $("#eform").submit(function(e){
            return false;
        });

        
    </script>

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
    
</body>

</html>