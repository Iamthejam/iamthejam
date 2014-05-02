<?php
include_once 'header.php';
include 'includes/database.php';
include 'includes/functions.php';

if(isset($_REQUEST['command'])=='add' && $_REQUEST['productid']>0){
	$productID=$_REQUEST['productid'];
	addtocart($productID,1);
	header("location:shoppingcart.php");
	exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Products</title>
<script language="javascript">
	function addtocart(productID){
		document.form1.productid.value=productID;
		document.form1.command.value='add';
		document.form1.submit();
	}
</script>
</head>


<body>
	<form name="form1">
		<input type="hidden" name="productid" /> <input type="hidden"
			name="command" />
	</form>
	<div align="center">
		<div id="main-wraper">
			<h1 align="center"></h1>
			<table border="0" cellpadding="2px" width="600px">
			<?php
			$result=mysql_query("SELECT * FROM products") or die("SELECT * FROM products"."<br/><br/>".mysql_error());
			while($row=mysql_fetch_array($result)){
				?>
				<tr>

					<td><img src="<?=$row['picture']?>" height="215" width="215" /></td>
					<td><b><?=$row['name']?> </b><br /> <?=$row['description']?><br />
						Price:<big style="color: blue"> $<?=$row['price']?> </big><br />
						<br /> <input type="button" value="Add to Cart"
						onclick="addtocart(<?=$row['serial']?>)" />
					</td>
				</tr>
				<tr>
					<td colspan="2"><hr size="1" /></td></tr>
					<?php } ?>
			</table>
		</div>
	</div>
</body>
</html>
					<?php
					include_once 'footer.php';
					?>
