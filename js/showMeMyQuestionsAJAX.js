function datuakEskatu(s) {
	
	var ajaxRequest;
	if (window.XMLHttpRequest) ajaxRequest = new XMLHttpRequest();
	else ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
	
	ajaxRequest.onreadystatechange = function() {
		if (ajaxRequest.readyState == 4 && ajaxRequest.status == 200 && ajaxRequest.responseXML != null) {
			
			var xml = ajaxRequest.responseXML;
			var taula = "<table border='1'><tr><th align='center'>Egilea</th><th align='center'>Enuntziatua</th><th align='center'>Erantzun zuzena</th></tr>";
			var galdera = xml.getElementsByTagName("assessmentItem");
			var loggedEmail = document.getElementById("loggedEmail").innerText;
			
			var loggedUserHasQuestions = false;
			var height = 610;
			
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
			
			if (loggedUserHasQuestions) {				
				document.getElementById("n1").style.height = height +"px";
				document.getElementById("s1").style.height = height +"px";

				if (s === "addQuestionerako")
					document.getElementById("divFeedbackAjax").innerHTML += "<br><br><strong>Nire galderak / Galderak guztira DB: " +nireGalderak +" / " +galderakGuztira +"</strong>";
				
				else
					document.getElementById("divFeedbackAjax").innerHTML = "<strong>Nire galderak / Galderak guztira DB: " +nireGalderak +" / " +galderakGuztira +"</strong>";
				
				document.getElementById("divTaulaAjax").innerHTML = taula;
			}
			else {
				document.getElementById("n1").style.height = "460px";
				document.getElementById("s1").style.height = "460px";
				document.getElementById("divFeedbackAjax").innerHTML = "<strong>Datu basean ez dago zure galderarik</strong>";
			}
		}
	}
	
	ajaxRequest.open('GET', '../xml/questions.xml', true);
	ajaxRequest.send();
}