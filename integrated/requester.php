<html>
<head>
 <title>json + jquery</title>
 <script type='text/javascript' src='jquery-1.4.2.min.js'></script>
 <script type='text/javascript'>
   $(document).ready(function(){
	 $("#loading").hide();
   });
   
   $(function(){
     $("#form_json").submit(function(){
		
		/*$("#loading").show();
		$("#loading").fadeIn(500).html("<img src='loading.gif' /> Loading data...");*/
		
		$.ajax({
			url:"proses.php",
			dataType:"json",
			success:function(data){
				user_sirs = "<ol>";
				$.each(data, function(i,n){
				user_sirs = user_sirs + n["msg"];
				});
				user_sirs = user_sirs + "</ol>";
				$(".result_json").append(user_sirs);
				
				$("#loading").hide();
			}
		});
		
		return false;
	 });
   });
 </script>
</head>
<body>
 Untuk menampilkan data json dari database, klik tombol disamping...
 <form id='form_json'>
  <input type='submit' class='tbl_ok' value='Lihat' />
 </form>
 
 <div id='loading'></div>
 <div class='result_json'>
 </div>
</body>
</html>