var refreskatzekoBaimena = true;

$(document).ready(function(){
$(".botoia").click(function(){
	if (refreskatzekoBaimena) {
		refreskatzekoBaimena = false;
		refreskatu();
	}
});
});

function refreskatu() {

	setInterval(function(){
	
		var ajaxRequest;
		if (window.XMLHttpRequest) ajaxRequest = new XMLHttpRequest();
		else ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
		
		ajaxRequest.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200 && this.responseXML != null) {
			
			var xml = this.responseXML;
			var taula = "<table border='1'><tr><th align='center'>Egilea</th><th align='center'>Enuntziatua</th><th align='center'>Erantzun zuzena</th></tr>";
			var galdera = xml.getElementsByTagName("assessmentItem");
			var loggedEmail = document.getElementById("loggedEmail").innerText;
			
			var loggedUserHasQuestions = false;
			var height = 560;			
			var irudia = $("#fitxategia").val();
		
			var extraHeight = 0;
			if(irudia != "") extraHeight = 130;
			
			var galderakGuztira = galdera.length;
			var nireGalderak = 0;
			for (var i=0; i < galdera.length; i++) {
			if (galdera[i].getAttribute("author") == loggedEmail ) {
				if (!loggedUserHasQuestions) loggedUserHasQuestions = true;
				
				taula += "<tr>" +
				"<td align='center'>" +galdera[i].getAttribute("author") +"</td>" +
				"<td align='center'>" +galdera[i].getElementsByTagName("itemBody")[0].getElementsByTagName("p")[0].childNodes[0].nodeValue +"</td>" +
				"<td align='center'>" +galdera[i].getElementsByTagName("correctResponse")[0].getElementsByTagName("value")[0].childNodes[0].nodeValue +"</td>" +
				"</tr>";
				height += 23;
				nireGalderak++;
			}
			}
			taula += "</table>";
			
			var xhro = new XMLHttpRequest();
			xhro.open('GET', '../xml/counter.xml', false);
			xhro.send();
			
			if (xhro.readyState == 4 && xhro.status == 200 && xhro.responseXML != null) {
				var xmlData = xhro.responseXML;	
				var loggedUsers = xmlData.getElementsByTagName("loggedUser");
				document.getElementById("divFeedbackAjax").innerHTML = "<strong>Logeatuta dauden erabiltzaile kopurua: " +loggedUsers.length +"</strong><br><br>";
			}
			
			if (loggedUserHasQuestions) {	
				document.getElementById("n1").style.height = height +extraHeight +"px";
				document.getElementById("s1").style.height = height +extraHeight +"px";
				
				document.getElementById("divFeedbackAjax").innerHTML += "<strong>Nire galderak / Galderak guztira DB: " +nireGalderak +" / " +galderakGuztira +"</strong>";	
				document.getElementById("divTaulaAjax").innerHTML = taula;
			}
			else {
				document.getElementById("n1").style.height = 500 +extraHeight +"px";
				document.getElementById("s1").style.height = 500 +extraHeight +"px";
				document.getElementById("divFeedbackAjax").innerHTML += "<strong>Datu basean ez dago zure galderarik</strong>";
			}
			}
		}
		
		ajaxRequest.open('GET', '../xml/questions.xml?q='+new Date().getTime(), true);
		ajaxRequest.send();
	
	}, 20000);
	
}