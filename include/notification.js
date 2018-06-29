function check(){
   		 if (jQuery("#notification").is(":hidden")){
	   		jQuery.get("checkNotification.php?checkNum=1", function(data){
				if(data!="0"){
				 	jQuery("#notificationIn").load("checkNotification.php");
				 	jQuery("#notification").slideDown("slow");
				}
			});
		}
		 window.setTimeout(function() {check();}, 10000);
	}
	
jQuery(document).ready(function(){

	jQuery("#notification").hide();
	
	
	jQuery("#notificationClose").click(function () {
    	jQuery("#notification").hide();
    });
    
    window.setTimeout(function() {
		check();
	}, 1000);
   
    
});
