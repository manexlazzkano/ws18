<?php
	$data = "";
	$baimena = true;
	$IDGaldera = $_POST['IDGaldera'];
	$jokalariErantzuna = $_POST['erantzundakoa'];
	$goitizena = $_POST['goitizena'];
	
	include("dbConfig.php");
	
	$linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);
	$galderaData = $linki->query("SELECT * FROM questions WHERE ID = $IDGaldera");
		
	if ($_POST['option'] == "onePlay") {
		
		if ($galderaData == null) {
			
			$players = simplexml_load_file("../xml/players.xml");
			$playersNum = count($players->player);
			
			for ($i=0; $i < $playersNum; $i++){		
				if ($players->player[$i]->name == $goitizena){		
					$jokalariPuntuazioa = $players->player[$i]->points;
					$data = "Jokoa amaitu duzu, zure puntuazioa ".$jokalariPuntuazioa." da
					<br><br><input type='button' id='irten' value='   IRTEN   ' style='background-color:rgb(255,200,200);
					font-size:16px; font-weight:bold;'/>";
					break;
				}
			}	
			
		}
		else {
			$galdera = $galderaData->fetch_assoc();
			
			//EP -> Erantzun posibleak
			$V = range(0,3);	shuffle($V);
			
			$EP = array(0,1,2,3);
			$EP[$V[0]] = $galdera['erantzunZuzena'];	$EP[$V[1]] = $galdera['erantzunOkerra1'];
			$EP[$V[2]] = $galdera['erantzunOkerra2'];	$EP[$V[3]] = $galdera['erantzunOkerra3'];
			//xxxxxxxxxxxxxxxxxxxxxxxxxxxx
			
			if($galdera['irudia'] != "")
				$data = "<img width='150' border=1 height='150' src='data:image/*;base64,".base64_encode($galdera['irudia'])."'><br><br>";
			else
				$data = "<img width='150' border=1 height='150' src='../images/x.png'><br><br>";
			
			$data = $data.
			"<table>
				<tr class='t'><td>
					<strong>Arloa</strong>: ".$galdera['arloa']."
				</td></tr>
				<tr class='t'><td>
					<strong>Zailtasuna (0-5): </strong>".$galdera['zailtasuna']."
				</td></tr>
				<tr class='t'><td>
					<strong>".$galdera['galderaTestua']."</strong>
				</td></tr>
				<tr class='t'><td>
					&nbsp&nbsp&nbsp&nbsp&nbsp<input type='radio' class='rbtn' name='G1' value='$EP[0]'> ".$EP[0]."<br>   
					&nbsp&nbsp&nbsp&nbsp&nbsp<input type='radio' class='rbtn' name='G1' value='$EP[1]'> ".$EP[1]."<br>    
					&nbsp&nbsp&nbsp&nbsp&nbsp<input type='radio' class='rbtn' name='G1' value='$EP[2]'> ".$EP[2]."<br>    
					&nbsp&nbsp&nbsp&nbsp&nbsp<input type='radio' class='rbtn' name='G1' value='$EP[3]'> ".$EP[3]."
				</td></tr>
				<tr class='t'><td id='feedback'>
				</td></tr>
				<tr><td>
					<br>
					<input type='radio' name='like' value='like'><strong style='background-color:rgb(160,255,160)'>Galdera hau gustoko dut</strong> &nbsp&nbsp
					<input type='radio' name='like' value='dislike'><strong style='background-color:rgb(255,160,160)'>Galdera hau ez dut gustoko</strong>
				</td></tr>
				<tr><td>
					<br>
					<input type='button' id='hurrengoG' name='hurrengoG' value='   Hurrengo galdera   '/>
					<input type='button' id='konprobatuG' name='KonprobatuG' value='   Konprobatu   '/>
				</td></tr>
			</table>
			<input type='button' id='jokoaAmaitu' value='   JOKOA AMAITU   ' style='margin-left:80%; margin-top:-30px; float:left;
			background-color:rgb(255,200,200); font-size:16px; font-weight:bold;'/>";
		}
	}
	else if ($_POST['option'] == "playingBySubject") {
		$arloenTaula = $linki->query("SELECT DISTINCT arloa FROM questions");
		$arloak = array();
		
		$data = 
		"<table>";
		while ($arloa = $arloenTaula->fetch_assoc()['arloa']){
			$data = $data.
			"<tr><td>
				<input type='radio' name='SBJ1' value='".$arloa."'> <strong>".$arloa."</strong>
			</td></tr>";
		}
		$data = $data.
		"<tr><td>
			<br>
			<input type='button' id='chooseSubject' name='chooseSubject' value='   Gaia aukeratu   '/>
		</td></tr>
		</table>";
	}
	else if ($_POST['option'] == "konprobatu") {
		
		$galdera = $galderaData->fetch_assoc();

		$players = simplexml_load_file("../xml/players.xml");
		$playersNum = count($players->player);
		
		if ($jokalariErantzuna == $galdera['erantzunZuzena']){
			
			$data = "ZUZEN!!";
			for ($i=0; $i < $playersNum; $i++){		
				if ($players->player[$i]->name == $goitizena){		
					$jokalariPuntuazioa = $players->player[$i]->points + 1;
					$players->player[$i]->points = $jokalariPuntuazioa;
					break;
				}
			}
			$players->asXML("../xml/players.xml");
		}
		else {
			$data = "OKER!!";
		}
	}
	echo $data;
?>