function balioztatu() {
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
		var epostaExp = /[a-zA-Z][a-zA-Z]+[0-9][0-9][0-9]@ikasle.ehu.eus/;
		if(epostaExp.test(eposta)) erroreak += "* Eposta zuzena\n";
		else erroreak += "* Eposta okerra\n";
	}
	
	if(galdera == "") erroreak += "* Galderaren testua zehaztu gabe dago\n";
	else if(galdera.length < 10) erroreak += "* Galderaren testua motzegia da, 10 ko luzera ez du gainditzen\n";
	if(erantzunZuzena == "") erroreak += "* Erantzun zuzena zehaztu gabe dago\n";
	if(erantzunOkerra1 == "") erroreak += "* Erantzun okerra1 zehaztu gabe dago\n";
	if(erantzunOkerra2 == "") erroreak += "* Erantzun okerra2 zehaztu gabe dago\n";
	if(erantzunOkerra3 == "") erroreak += "* Erantzun okerra3 zehaztu gabe dago\n";
	if(arloa == "") erroreak += "* Gai-arloa zehaztu gabe dago\n";
	
	
	if(erroreak === "") return true
	else {
		alert(erroreak);
		return false;
	}
}