<?php
include ("header.php");
include ("includes/database.php");
include ("includes/functions.php");

if(isset($_REQUEST['command'])=='delete' && $_REQUEST['productID']>0){
	remove_product($_REQUEST['productID']);
}
else if(isset($_REQUEST['command'])=='clear'){
	unset($_SESSION['cart']);
}
else if(isset($_REQUEST['command'])=='update'){
	$max=count($_SESSION['cart']);
	for($i=0;$i<$max;$i++){
		$productID=$_SESSION['cart'][$i]['productid'];
		$quantity=intval($_REQUEST['product'.$productID]);
		if($quantity>0 && $quantity<=999){
			$_SESSION['cart'][$i]['qty']=$quantity;
		}
		else{
			$msg='Some proudcts not updated!, quantity must be a number between 1 and 999';
		}
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shopping Cart</title>
<script language="javascript">
	function del(productID){
		if(confirm('Do you really mean to delete this item')){
			document.form1.productID.value=productID;
			document.form1.command.value='delete';
			document.form1.submit();
		}
	}
	function clear_cart(){
		if(confirm('This will empty your shopping cart, continue?')){
			document.form1.command.value='clear';
			document.form1.submit();
		}
	}
	function update_cart(){
		document.form1.command.value='update';
		document.form1.submit();
	}


</script>
</head>

<body>
	<div id="mid-formatshopping">
		<form name="form1" method="post">
			<input type="hidden" name="productID" /> <input type="hidden"
				name="command" />
			<div style="margin: 0px auto; width: 600px;">
				<div style="padding-bottom: 10px">
					<h1 align="center"></h1>
					<input type="button" value="Continue Shopping"
						onclick="window.location='products.php'" />
				</div>
				<div style="color: #F00">
				<?php echo isset($msg); ?>
				</div>

				<table border="0" cellpadding="5px" cellspacing="1px"
					style="font-family: Verdana, Geneva, sans-serif; font-size: 11px; background-color: #E1E1E1"
					width="100%">
					<?php

					if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
						echo '<tr bgcolor="#FFFFFF" style="font-weight:bold"><td>Serial</td><td>Name</td><td>Price</td><td>Qty</td><td>Amount</td><td>Options</td></tr>';
						$max = count($_SESSION['cart']);
						for($i=0; $i<$max; $i++){
							$productID = $_SESSION['cart'][$i]['productid'];
							$quantity = $_SESSION['cart'][$i]['qty'];
							$productName = get_product_name($productID);
							if($quantity==0) continue;
							?>

					<tr bgcolor="#FFFFFF">
						<td><?php echo $i+1?></td>
						<td><?php echo $productName?></td>
						<td>$ <?php echo get_price($productID)?></td>
						<td><input type="text" name="product<?php  echo $productID?>"
							value="<?php echo $quantity?>" maxlength="3" size="2" /></td>
						<td>$ <?php echo get_price($productID) * $quantity?></td>
						<td><a href="javascript:del(<?php echo $productID?>)">Remove</a></td>
					</tr>
					<?php

						}
							
						?>
					<tr>
						<td><b>Order Total: $<?php echo get_order_total()?> </b></td>
						<td colspan="5" align="right"><input type="button"
							value="Clear Cart" onclick="clear_cart()"></input> <input
							type="button" value="Update Cart" onclick="update_cart()"></input>
							<input type="button" value="Place Order"
							onclick="window.location='billing.php'"></input></td>
					</tr>
					<?php

					}
					else{
						echo "<tr bgColor='#FFFFFF'><td>There are no items in your shopping cart!</td>";
					}

					?>
				</table>
			</div>
		</form>
	</div>

	<?php
	include ("footer.php");
	?>
</body>
</html>
