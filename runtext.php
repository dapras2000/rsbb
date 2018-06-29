<marquee>
	<?php
		$data=mysql_fetch_array(mysql_query("SELECT * FROM info"));
		echo $data['isi_info'];
	?>
</marquee>