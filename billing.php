
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Billing Info</title>
<script language="javascript">

	function validate(){
		var msg = "";
		var f=document.form1;
		if(f.name.value ==''){
			msg += ("Your Name is required\n");
		
		}
		if (f.address.value =='') {
			msg += ("Your Address is required\n");
			
			}
		if (f.email.value =='') {
			msg += ("Your Email is required\n");
			
			}

		if (f.phone.value =='') {
			msg += ("Your Phone Number is required\n");
			
			}
		
		if (msg != '') {
			alert(msg);
			return false;
			}

		f.command.value='update';
		f.submit();
	}
</script>
</head>
<body>
	<div id="mid-format">
	<?php
	include_once 'header.php';
	include("includes/database.php");
	include("includes/functions.php");

	if(isset($_REQUEST['command'])=='update'){
		$name=$_REQUEST['name'];
		$email=$_REQUEST['email'];
		$address=$_REQUEST['address'];
		$phone=$_REQUEST['phone'];

		$result=mysql_query("insert into customers values('','$name','$email','$address','$phone')");
		$customerid=mysql_insert_id();
		$date=date('Y-m-d');
		$result=mysql_query("insert into orders values('','$date','$customerid')");
		$orderid=mysql_insert_id();

		$max=count($_SESSION['cart']);

		for($i=0;$i<$max;$i++){
			$productID=$_SESSION['cart'][$i]['productid'];
			$quantity=$_SESSION['cart'][$i]['qty'];
			$price=get_price($productID);
			mysql_query("insert into orderdetail values ($orderid,$productID,$quantity,$price)");
		}
		die('Thank You! your order has been placed!');
	}
	?>
		<form name="form1" onsubmit="return validate()">
			<input type="hidden" name="command"></input>
			<div align="center">
				<h1 align="center"></h1>
				<table border="0" cellpadding="2px">
					<tr>
						<td><span class="formattributes">Order Total:</span></td>
						<td><span class="formattributes">$<?php echo get_order_total()?> </span>
						</td>
					</tr>
					<tr>
						<td><span class="formattributes">Your Name:</span></td>
						<td><input type="text" name="name"></input></td>
					</tr>
					<tr>
						<td><span class="formattributes">Address:</span></td>
						<td><input type="text" name="address"></input></td>
					</tr>
					<tr>
						<td><span class="formattributes">Email:</span></td>
						<td><input type="text" name="email"></input></td>
					</tr>
					<tr>
						<td><span class="formattributes">Phone:</span></td>
						<td><input type="text" name="phone"></input></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" value="Place Order"></input></td>
					</tr>
				</table>
			</div>

		</form>
	</div>
	<?php
	include_once 'footer.php';
	?>
</body>
</html>
