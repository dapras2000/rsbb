<?php
function writeShoppingCart() {
	$cart = $_SESSION['cart'];
	if (!$cart) {
		return '<p>Anda Belum Memilih List Data Pembayaran</p>';
	} else {
		// Parse the cart session variable
		$items = explode(',',$cart);
		$s = (count($items) > 1) ? 's':'';
		return '<p style="border:1px solid #CCC; color:green; padding:10px;">Anda Telah Memilih <a href="index.php">'.count($items).' item'.$s.'</a></p>';
	}
}

function showCart() {
	global $db;
	$cart = $_SESSION['cart'];
	if ($cart) {
		$items = explode(',',$cart);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
		$output[] = '<form action="index.php?action=update" method="post" id="cart">';
		$output[] = '<table >';
		foreach ($contents as $id=>$qty) {
			$sql = 'SELECT * FROM m_tarif WHERE kode = '.$id;
			$result = $db->query($sql);
			$row = $result->fetch();
			extract($row);
			$output[] = '<tr>';
			$output[] = '<td>
							<div style="padding:2px; background:#FFC; border:1px solid #CCC;">
							<a href="index.php?action=delete&id='.$id.'">Remove</a>
							</div>
						</td>';
			$output[] = '<td>'.$row['nama_jasa'].'</td>';
			$output[] = '<td>Rp. '.number_format($row['tarif'],0).'</td>';
			$output[] = '<td><input type="text" class="text" name="qty'.$id.'" value="'.$qty.'" size="2" maxlength="3" />
			<input type="hidden" class="text" name="tarif'.$id.'" value="'.$row['tarif'].'" size="2" maxlength="3" />
			<input type="hidden" class="text" name="kode'.$id.'" value="'.$row['kode'].'" size="2" maxlength="3" />
			<input type="hidden" class="text" name="nama'.$id.'" value="'.$row['nama_jasa'].'" size="2" maxlength="3" />';
			$output[] = '<td>Rp. '.$row['tarif'] * $qty.'</td>';
			$total += $row['tarif'] * $qty;
			$_SESSION['total'] = $total;
			$output[] = '</tr>';
		}
		$output[] = '</table>';
		$output[] = '<p>Grand total: <strong>Rp '.number_format($total, 0).'</strong></p>';
		$output[] = '<div><button type="submit" name="refresh" class="text">save cart</button></div>';
		$output[] = '</form>';
	} else {
		$output[] = '<p>Anda Belum Memilih List Data Pembayaran.</p>';
	}
	return join('',$output);
}
?>
