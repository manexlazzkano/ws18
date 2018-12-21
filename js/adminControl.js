$(document).ready(function(){
	
	$("#firstCheckbox").click(function(){		
		if ($(this).prop("checked")) $(".checkbox").prop("checked", true);
		else if (!$(this).prop("checked")) $(".checkbox").prop("checked", false);		
	});
	
	$(".blokeatu").click(function(){
		var row = $(this).closest("tr");
		eragiketaGauzatu("blokeatu", row);
	});
	$(".aktibatu").click(function(){
		var row = $(this).closest("tr");
		eragiketaGauzatu("aktibatu", row);
	});
	$(".ezabatu").click(function(){
		var row = $(this).closest("tr");
		eragiketaGauzatu("ezabatu", row);
	});
	
	$("#aktibatuAukeratuak").click(function(){
		var selectedRows = [];
		$("table").find("input:checked").each(function(){ 
			selectedRows.push($(this).closest("tr"));
		});
		eragiketaGauzatu("aktibatuAukeratuak", selectedRows);
	});
	$("#blokeatuAukeratuak").click(function(){
		var selectedRows = [];
		$("table").find("input:checked").each(function(){ 
			selectedRows.push($(this).closest("tr"));
		});
		eragiketaGauzatu("blokeatuAukeratuak", selectedRows);
	});
	$("#ezabatuAukeratuak").click(function(){
		var selectedRows = [];
		$("table").find("input:checked").each(function(){ 
			selectedRows.push($(this).closest("tr"));
		});
		eragiketaGauzatu("ezabatuAukeratuak", selectedRows);
	});
	
});

function eragiketaGauzatu(eragiketa, row) {
	
	var rowNumber;
	var rowIdCell;
	var userId;
	var datuak;
	
	if (eragiketa == "aktibatu" || eragiketa == "blokeatu" || eragiketa == "ezabatu"){
		
		rowNumber = row.index();
		rowIdCell = $("#"+rowNumber);
		userId = parseInt(rowIdCell.text());
		
		datuak = {
			"eragiketa" : eragiketa,
			"userId" : userId
		};
	}
	else if(eragiketa == "aktibatuAukeratuak" || eragiketa == "blokeatuAukeratuak" || eragiketa == "ezabatuAukeratuak"){
		
		userId = [];
		for (var i=0; i < row.length; i++) {
			rowNumber = row[i].index();
			rowIdCell = $("#"+rowNumber);
			userId[i] = parseInt(rowIdCell.text());
		}
		datuak = {
			"eragiketa" : eragiketa,
			"userId" : userId
		};
	}
	
	$.ajax({
		async:true,
		type:"POST",
		url:"adminControl.php",
		data:datuak,
		cache:false,
		success:function(){
			window.location.reload();
		},
		error:function(){
			alert("Error");
		}
	});
}

// function refreshAdminTable() {

	// var xhro = new XMLHttpRequest();
	// xhro.open('GET', 'handlingAccounts.php', false); //xhro.open('GET', 'handlingAccounts.php?q='+new Date().getTime(), false);
	// xhro.send();
	
	// if (xhro.readyState == 4 && xhro.status == 200 && xhro.responseText != null) {
		// alert(xhro.response);
		// var docData = xhro.responseText;	
		// var sectionS1 = docData.getElementById("s1");
		
		// document.getElementById("s1").innerHTML = sectionS1;
	// }
// }