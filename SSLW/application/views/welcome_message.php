<!DOCTYPE html>
<html>
<head>
	<title>SSL Wireless</title>
	<style>
		body{
			background-image: url("img/back.jpg");
		}
		table {
		    font-family: arial, sans-serif;
		    border-collapse: collapse;
		    width: 100%;
		    font-size: 14px;
		    margin: 0 auto;
		}

		td, th {
		    border: 1px solid green;
		    text-align: left;
		    padding: 5px;
		}
		.cont{
			width: 35%;
			margin: 4% auto;
			box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);
			padding: 20px;
			background-color: white;
		}
		.btn{
			height: 45px;
			width: 130px;
			font-size: 18px;
			background: #000099;
			border:0px;
			color: white;
			border-radius: 3px;
		}
		.tbox{
			height: 23px;
			width: 260px;
			border-radius: 3px;
			border:0px;
			font-size: 14px;
		}
		.img {
		    display: block;
		    margin: 0 auto;
		    height:70px; 
		    width:250px;
		}
	</style>
</head>
<body>
	<div class="cont">
		<img src="img/ssl.png" class="img">
		<h4 align="center">Pay With SSLCommerz - Nexus / Debit / Credit / Mobile / Internet Banking</h4>
		<form method="post" action="index.php/requestssl">
			<table>
				<tr>
					<td>Name</td>
					<td><input type="text" name="fname" required class="tbox" autofocus placeholder="Name" value="Prabal Mallick"></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input type="email" name="email" required class="tbox" placeholder="Email" value="prabalsslw@gmail.com"></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td><input type="text" name="phone" required class="tbox" placeholder="Phone" value="01680032580"></td>
				</tr>
				<tr>
					<td>Amount</td>
					<td><input type="text" name="amount" required value="200" class="tbox" placeholder="Amount"></td>
				</tr>
				<tr>
					<td>Country</td>
					<td><input type="text" name="country" required class="tbox" placeholder="Country" value="Bangladesh"></td>
				</tr>
				<tr>
					<td>Address</td>
					<td><input type="text" name="address" required class="tbox" placeholder="Address" value="Gazipur"></td>
				</tr>
				<tr>
					<td>Street Address</td>
					<td><input type="text" name="street" required class="tbox" placeholder="Street Address" value="Joydebpur"></td>
				</tr>
				<tr>
					<td>State</td>
					<td><input type="text" name="state" required class="tbox" placeholder="State" value="Gazipur"></td>
				</tr>
				<tr>
					<td>City</td>
					<td><input type="text" name="city" required class="tbox" placeholder="City" value="Gazipur"></td>
				</tr>
				<tr>
					<td>Post Code</td>
					<td><input type="text" name="postcode" required class="tbox" placeholder="Post Code" value="1700"></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" name="submit" value="Place Order" class="btn"></td>
				</tr>
			</table>
		</form>
		
	</div>
	<img src="img/ssl2.png" style="display: block; margin: 0 auto; height:120px; width:600px;">
	<span>2017 &copy; SSL Wireless</span>
</body>
</html>