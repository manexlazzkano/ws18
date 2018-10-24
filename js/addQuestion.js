$(document).ready(function(){
$(function(){
	$("#fitxategia").change(function(e){
		addImage(e); 
	});

	function addImage(e){
		var file = e.target.files[0],
		imageType = /image.*/;
	
		if (!file.type.match(imageType))
			return;
  
		var reader = new FileReader();
		reader.onload = fileOnload;
		reader.readAsDataURL(file);
	}
  
	function fileOnload(e){
		var result=e.target.result;
		
		$("#divIrudi").append("<style>#n1,#s1{height:500px;}</style>");
		$("#divIrudi").append('<img id="irudia" src="" width="100" height="100"></br></br>');
		$("#irudia").attr("src",result);
	}
});
});

$(document).ready(function(){
$("#Bidali").click(function() {
	var eposta = $("#eposta").val();				
	var galdera = $("#galdera").val();
	var erantzunZuzena = $("#erantzunZuzena").val();				
	var erantzunOkerra1 = $("#erantzunOkerra1").val();
	var erantzunOkerra2 = $("#erantzunOkerra2").val();				
	var erantzunOkerra3 = $("#erantzunOkerra3").val();
	var zailtasuna = $("#zailtasuna").val();				
	var arloa = $("#arloa").val();
	
	var erroreak = "";
	if(eposta == "") erroreak += "* Egilearen eposta zehaztu gabe dago\n";
	else {
		var epostaExp = new RegExp("^[a-zA-Z]{3,}[0-9]{3}@ikasle\.ehu\.eus$");
		if(!epostaExp.test(eposta)) erroreak += "* Eposta okerra\n";
	}
	
	if(galdera == "") erroreak += "* Galderaren testua zehaztu gabe dago\n";
	else if(galdera.length < 10) erroreak += "* Galderaren testua motzegia da, 10 ko luzera ez du gainditzen\n";
	if(erantzunZuzena == "") erroreak += "* Erantzun zuzena zehaztu gabe dago\n";
	if(erantzunOkerra1 == "") erroreak += "* Erantzun okerra1 zehaztu gabe dago\n";
	if(erantzunOkerra2 == "") erroreak += "* Erantzun okerra2 zehaztu gabe dago\n";
	if(erantzunOkerra3 == "") erroreak += "* Erantzun okerra3 zehaztu gabe dago\n";
	if(arloa == "") erroreak += "* Gai-arloa zehaztu gabe dago\n";
	
	
	if(erroreak != "") {
		alert(erroreak);
		return false;
	}
	else return true;
});
});


$(document).ready(function(){
$("#Garbitu").click(function() {
	$("#divIrudi").remove();
});
});

