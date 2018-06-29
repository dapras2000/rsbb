<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Shopping Cart</title>
		<script src="js/jquery-1.2.6.pack.js" type="text/javascript"></script>
		<script src="js/jquery.color.js" type="text/javascript"></script>
		<script src="js/thickbox.js" type="text/javascript"></script>
		<script src="js/cart.js" type="text/javascript"></script>
		<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="css/thickbox.css" rel="stylesheet" type="text/css" media="screen" />
		
		<script type="text/javascript">
			$(function() {
				$("form.cart_form").submit(function() {
					var title = "Your Shopping Cart";
					var orderCode = $("input[name=order_code]", this).val();
					var quantity = $("input[name=quantity]", this).val();
					var url = "cart_action.php?order_code=" + orderCode + "&quantity=" + quantity + "&TB_iframe=true&height=400&width=780";
					tb_show(title, url, false);
					
					return false;
				});
			});
		</script>
	</head>
	<body>
		<div id="container">
			<h1>Daftar Resep</h1>
			<a href="cart.php?KeepThis=true&TB_iframe=true&height=400&width=780" title="Your Shopping Cart" class="thickbox">Open Cart</a>
			<hr />
			<h1>Daftar Obat</h1>
			<table>
			  <tr>
			     <td>Nama Obat</td>
			     <td>Satuan</td>
			     <td>Stock</td>
			  </tr>
			</table>
			<a href="cart_action.php?order_code=KWL-JFE&quantity=3&TB_iframe=true&height=400&width=780" title="Your Shopping Cart" class="thickbox">Add three KWL-JFE to cart</a>
			
			<hr />
			<form class="cart_form" action="cart_action.php" method="get">
				<input type="hidden" name="order_code" value="KWL-JFE" />
				<label>KWL-JFE: <input class="center" type="text" name="quantity" value="1" size="3" ?></label>
				<input type="submit" name="submit" value="Add to cart" />
			</form>
		</div>
	</body>
</html>