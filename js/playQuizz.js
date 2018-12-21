$(document).ready(function(){
	
	var datuak = "";
	var aukera = "";
	var goitizena = "";
	
	var lehenengoAldizOnePlay = true;
	var lehenengoAldizPlayingBySubject = true;
	
	var erantzunaKonprobatuDa = false;
	var erantzundakoa = "";
	var jokoaAmaitu = false;
	
	$("#onePlayDiv").on("click", "#irten", function(){	
		window.location.href = "layout.php";
	});
	
	$("#onePlay").click(function(){
		if (lehenengoAldizOnePlay){
			aukera = "onePlay";
			lehenengoAldizOnePlay = false;
			ajaxErabili();
			
			$("input").prop("disabled", true);
			$('a').bind('click', false);
			$('a').attr("style", "color:grey");
		}
	});
	
	$("#onePlayDiv").on("click", "#jokoaAmaitu", function(){	
		$("input").prop("disabled", false);
		$('a').unbind('click', false);
		$('a').attr("style", "");
		
		jokoaAmaitu = true;
		ajaxErabili();
	});
	
	$("#playingBySubject").click(function(){
		if (lehenengoAldizPlayingBySubject){
			aukera = "playingBySubject";
			lehenengoAldizPlayingBySubject = false;			
			ajaxErabili();
		}
	});
	
	$("#onePlayDiv").on("click", "#hurrengoG", function(){
		if (erantzunaKonprobatuDa) {
			$("#jokoaAmaitu").remove()
			
			$("#onePlayDiv").find("img").remove();
			$("#onePlayDiv").find("br").remove();
			$("#onePlayDiv").find("table").remove();
			
			aukera = "onePlay";
			erantzunaKonprobatuDa = false;
			ajaxErabili();		
		}
		else {
			alert("ZURE ERANTZUNA KONPROBATU LEHENBIZI!");
		}
	});
	
	$("#onePlayDiv").on("click", "#konprobatuG", function(){
		
		erantzundakoa = $("input[name=G1]").filter(":checked").val();
		if (erantzundakoa == null) alert("ERANTZUN BAT AUKERATU");
		else {
			$("#konprobatuG").prop("disabled", true);
			
			aukera = "konprobatu";
			erantzunaKonprobatuDa = true;
			ajaxErabili();
			
			
		}
	});
	
	
	function ajaxErabili() {
			
		var galderenOrdena = $("#galderenOrdenaTaGoitizena").val().toString().split(" ")[0];
		var goitizena = $("#galderenOrdenaTaGoitizena").val().toString().split(" ")[1];
		var IDGaldera = galderenOrdena.substring(0,1);
		
		if (jokoaAmaitu) {
			IDGaldera = "";
			
			$("#jokoaAmaitu").remove()
			
			$("#onePlayDiv").find("img").remove();
			$("#onePlayDiv").find("br").remove();
			$("#onePlayDiv").find("table").remove();
		}
		
		datuak = {"option" : aukera, "IDGaldera" : IDGaldera, "erantzundakoa" : erantzundakoa, "goitizena" : goitizena,};	
		$.ajax({
			async:true,
			type:"POST",
			url:"playQuizzAJAX.php",
			data:datuak,
			cache:false,
			success:function(data){
				if (aukera == 'onePlay') $("#onePlayDiv").append(data);
				else if (aukera == 'playingBySubject') $("#playingBySubjectDiv").append(data);
				else if (aukera == 'konprobatu') {
					$(".rbtn").prop("disabled", true);
					$("#feedback").append("<br><h1>"+data+"</h1><br>");
					$("#galderenOrdenaTaGoitizena").val(galderenOrdena.substring(1)+" "+goitizena);
					
					if (data == 'ZUZEN!!') {
						$(".t").attr("style", "background-color:rgb(128,255,128)");
					}
					else if (data == 'OKER!!') {
						$(".t").attr("style", "background-color:rgb(255,128,128)");
					}
					
					return true;
				}
			},
			error : function(request, status, error) {},
		});
		
	}
	
});