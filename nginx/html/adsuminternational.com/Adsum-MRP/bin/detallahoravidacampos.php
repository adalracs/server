<?php
	$idcon = fncconn();
	include_once('../src/FunPerPriNiv/pktblcampo.php');
	include_once('../src/FunPerPriNiv/pktblequipocamperequipo.php');
	include_once('../src/FunPerPriNiv/pktblcamperequipo.php');

	$iRegcompcampequipo["equipocodigo"] = $arrequipo['equipocodigo'];
	$id_equipo = dinamicscanequipocamperequipo($iRegcompcampequipo, $idcon);
		
	$numregtip = fncnumreg($id_equipo);

	$trBreak=0;

	if ($numregtip){
		echo "<tr>";
		for ($j=0; $j< $numregtip; $j++){
			$arr_tipCam = fncfetch($id_equipo, $j);
			
			$arr_camper = loadrecordcamperequipo($arr_tipCam["capeeqcodigo"], $idcon);
			echo "<td>";
			echo "<B>{$arr_camper["capeeqnombre"]}:</B>&nbsp;";
			// Si no hay datos a mostrar, imprime '----'
			(empty($arr_tipCam["capeeqvalor"])) ? print("----") : print $arr_tipCam["capeeqvalor"];
			echo "</td>";
	
			$trBreak++;
	
			if ($trBreak == 3){
				$trBreak = 0;
				if(($j % 2)==0){	
					echo '<tr bgcolor="#E8F0F6">';}
				else{
					echo '<tr bgcolor="#F8FAFB">';
				}
			}
		}
		echo "</tr>";
	}
?>