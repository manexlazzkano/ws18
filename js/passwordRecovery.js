$(document).ready(function(){
	
	$("#pasahitzaAhaztu").click(function(){
		
		var url = window.location+"";
		if (url.includes("localhost")) {
			alert("Localhost -ean ezin da pasahitza berrezarri");
			return;
		}
			
		var eposta = $("#eposta").val();
		alert(eposta);
		if (eposta == "") {
			alert("Pasahitza berreskuratzeko eposta adierazi");
		}
		else {
			$("#pasahitzaAhaztu").hide();			
			$("#divForm").find("form").children().prop("disabled", "disabled");
			
			$("#divRecovery").append("<p>Pasahitza berria <strong>"+eposta+"</strong> epostara bidaltzea nahi duzu?</p>");
			$("#divRecovery").append("<br>");
			$("#divRecovery").append("<input type='button' id='Bai' value='  BAI  '/> <input type='button' id='Ez' value='  EZ  '/>");
			
			$("#Ez").click(function(){
				$("#pasahitzaAhaztu").show();
				$("#divForm").find("form").children().prop("disabled", "");
				
				$("#divRecovery").find("br").remove();
				$("#divRecovery").find("p").remove();
				$("#divRecovery").find("#Bai").remove();
				$("#divRecovery").find("#Ez").remove();
			});
			
			$("#Bai").click(function(){
				$.ajax({
					async:true,
					type:"POST",
					url:"passwordRecovery.php",
					data:eposta,
					cache:false,
					success:function(){ alert("Dena ondo"); },
					error:function(){ alert("Errorea"); }
				});
			});
		}
	});
});