<?php
	if($tipo != 1){
		//INSTALACION - CANCELACION VOLUNTARIA HC - TRASLADO - DECOADICIONAL
		$Campos = '<td width="30%" align="center" class="txtFormularioOrdenTrabajo">,</td>,
				<td width="25%" align="center" class="txtFormularioOrdenTrabajo">,</td>,
				<td width="20%" align="center" class="txtFormularioOrdenTrabajo" colspan="2">,</td>,
				<td width="30%" align="center" class="txtFormularioOrdenTrabajo">,</td>,
				<td width="30%" align="center" class="txtFormularioOrdenTrabajo" colspan="3">,</td>,
				<td width="20%" align="center" class="txtFormularioOrdenTrabajo">,</td>,
				<td width="20%" align="center" class="txtFormularioOrdenTrabajo">,</td>,
				<td width="20%" align="center" class="txtFormularioOrdenTrabajo" colspan="2">,</td>,
				<td width="30%" align="center" class="txtFormularioOrdenTrabajo">,</td>,
				<td width="30%" align="center" class="txtFormularioOrdenTrabajo" colspan="3">,</td>,
				<td width="15%" align="center" class="txtFormularioOrdenTrabajo">,</td>,
				<td width="15%" align="center" class="txtFormularioOrdenTrabajo">,</td>,
				<td width="15%" align="center" class="txtFormularioOrdenTrabajo" colspan="2">,</td>,
				<td width="20%" align="center" class="txtFormularioOrdenTrabajo">,</td>,
				<td width="20%" align="center" class="txtFormularioOrdenTrabajo">,</td>,
				<td width="20%" align="center" class="txtFormularioOrdenTrabajo">,</td>,
				<td width="20%" align="center" class="txtFormularioOrdenTrabajo">,</td>';		
					
		
		if($tipo == 0){
			$Campos = $Campos.',<td width="40%" align="center" class="txtFormularioOrdenTrabajo">,</td>,
						<td width="40%" align="center" class="txtFormularioOrdenTrabajo">,</td>,
						<td width="40%" align="center" class="txtFormularioOrdenTrabajo" colspan="3">,</td>,
						<td width="20%" align="left" class="txtFormularioOrdenTrabajo" colspan="4">,</td>';
		}
		
		$Campos = $Campos.',<td width="20%" align="center" class="txtFormularioOrdenTrabajo">,</td>,
					<td width="20%" align="center" class="txtFormularioOrdenTrabajo">,</td>,
					<td width="20%" align="center" class="txtFormularioOrdenTrabajo" colspan="2">,</td>,
					<td width="20%" align="center" class="txtFormularioOrdenTrabajo">,</td>,
					<td width="20%" align="center" class="txtFormularioOrdenTrabajo">,</td>,
					<td width="20%" align="center" class="txtFormularioOrdenTrabajo">,</td>,
					<td width="20%" align="center" class="txtFormularioOrdenTrabajo">,</td>';
		
		if($tipo == 5){
			$Campos = $Campos.',<td width="20%" align="center" class="txtFormularioOrdenTrabajo">,</td>,
						<td width="20%" colspan="2" align="center" class="txtFormularioOrdenTrabajo">,</td>,
						<td width="20%" align="center" class="txtFormularioOrdenTrabajo">,</td>';
		}elseif($tipo == 2){
			$Campos = $Campos.',<td width="30%" align="center" colspan="3" class="txtFormularioOrdenTrabajo">,</td>';
		}
		
		$Campos = $Campos.',<td width="50%" align="center" class="txtFormularioOrdenTrabajo" colspan="4">,</td>';
		
		if($tipo != 4){
			$Campos = $Campos.',<td width="1%" align="center">,</td>,
						<td width="25%" align="center">,</td>,
						<td width="20%" align="center">,</td>,
						<td width="25%" align="center">,</td>,
						<td width="20%" align="center">,</td>,
						<td width="9%" align="center">,</td>,
						<td width="9%" align="center">,</td>,
						<td width="1%" align="center">,</td>,
						<td width="25%" align="center">,</td>,
						<td width="20%" align="center">,</td>,
						<td width="25%" align="center">,</td>,
						<td width="20%" align="center">,</td>,
						<td width="9%" align="center">,</td>,
						<td width="9%" align="center">,</td>,
						<td width="1%" align="center">,</td>,
						<td width="25%" align="center">,</td>,
						<td width="20%" align="center">,</td>,
						<td width="25%" align="center">,</td>,
						<td width="20%" align="center">,</td>,
						<td width="9%" align="center">,</td>,
						<td width="9%" align="center">,</td>,
						<td width="1%" align="center">,</td>,
						<td width="25%" align="center">,</td>,
						<td width="20%" align="center">,</td>,
						<td width="25%" align="center">,</td>,
						<td width="20%" align="center">,</td>,
						<td width="9%" align="center">,</td>,
						<td width="9%" align="center">,</td>';
		}else{
			$Campos = $Campos.',<td width="10%" align="center" class="txtFormularioOrdenTrabajo">,</td>,
						<td width="10%" align="center" class="txtFormularioOrdenTrabajo">,</td>,
						<td width="10%" align="center" class="txtFormularioOrdenTrabajo">,</td>';
		}
	}else{
		$Campos = '<td width="25%" class="txtFormularioOrdenTrabajo">,</td>,
				<td width="25%" class="txtFormularioOrdenTrabajo">,</td>,
				<TD width="12%" class="tituloFormularioOrdenTrabajo">,</TD>,
				<td width="15%" class="txtFormularioOrdenTrabajo">,</td>,
				<td width="20%" class="txtFormularioOrdenTrabajo">,</td>,
				<td class="txtFormularioOrdenTrabajo" colspan="2">,</td>,
				<td class="txtFormularioOrdenTrabajo">,</td>,
				<td class="txtFormularioOrdenTrabajo">,</td>,
				<td class="txtFormularioOrdenTrabajo">,</td>,
				<td class="txtFormularioOrdenTrabajo" colspan="2">,</td>,
				<td class="txtFormularioOrdenTrabajo">,</td>,
				<td class="txtFormularioOrdenTrabajo">,</td>,
				<td class="txtFormularioOrdenTrabajo">,</td>,
				<td class="txtFormularioOrdenTrabajo" colspan="2">,</td>,
				<td class="txtFormularioOrdenTrabajo">,</td>,
				<td class="txtFormularioOrdenTrabajo">,</td>,
				<td class="txtFormularioOrdenTrabajo">,</td>,
				<td colspan="2" align="center" class="txtFormularioOrdenTrabajo">,</td>,
				<td colspan="3" align="center" class="txtFormularioOrdenTrabajo" colspan="3">,</td>,
				<td class="txtFormularioOrdenTrabajo" colspan="3">,</td>,
				<td class="txtFormularioOrdenTrabajo">,</td>,
				<td class="txtFormularioOrdenTrabajo">,</td>,
				<td class="txtFormularioOrdenTrabajo" colspan="4" height="30px">,</td>,
				<td colspan="2" class="txtFormularioOrdenTrabajo">,</td>,
				<td class="txtFormularioOrdenTrabajo">,</td>,
				<td class="txtFormularioOrdenTrabajo">,</td>,
				<td width="25%" class="txtFormularioOrdenTrabajo">,</td>,
				<td width="25%" class="txtFormularioOrdenTrabajo">,</td>,
				<td width="10%"  class="txtFormularioOrdenTrabajo">,</td>,
				<td width="30%" class="txtFormularioOrdenTrabajo">,</td>,
				<td width="10%" class="txtFormularioOrdenTrabajo">,</td>,
				<td width="10%" class="txtFormularioOrdenTrabajo">,</td>,
				<td width="25%" class="txtFormularioOrdenTrabajo">,</td>,
				<td width="25%" class="txtFormularioOrdenTrabajo">,</td>,
				<td class="txtFormularioOrdenTrabajo">,</td>,
				<td class="txtFormularioOrdenTrabajo">,</td>,
				<td class="txtFormularioOrdenTrabajo">,</td>,
				<td class="txtFormularioOrdenTrabajo">,</td>,
				<td width="25%" class="txtFormularioOrdenTrabajo">,</td>,
				<td width="25%" class="txtFormularioOrdenTrabajo">,</td>,
				<td class="txtFormularioOrdenTrabajo">,</td>,
				<td class="txtFormularioOrdenTrabajo">,</td>,
				<td class="txtFormularioOrdenTrabajo">,</td>,
				<td class="txtFormularioOrdenTrabajo">,</td>';
	}
	
	$finData=0;
	$cont=0;
	$filepath = "../doc/ot_cargados/tmp".$numtemp.".html";
	
	$FileServ = fopen($filepath,"r");
	$buffer =fread($FileServ, filesize($filepath));
	
	$arr_Campos = explode(",",$Campos); 
	
	for($i=0;$i++,$i<count($arr_Campos);$i++){
		if (strpos($buffer,trim($arr_Campos[$i-1]),$finData) != false){
			$iniData =strpos($buffer,trim($arr_Campos[$i-1]),$finData)+strlen(trim($arr_Campos[$i-1]));
			$finData = strpos($buffer,trim($arr_Campos[$i]),$iniData);
			
			$arr_dataorden[$cont]=substr($buffer,$iniData,$finData-$iniData);
			
			if($cont == 0){
				$idcnx = fncconn();
				
				$result = loadrecordclienteot(trim(str_replace("&nbsp;","",$arr_dataorden[0])),$idcnx);
				if ($result > 0){
					$flagexistreg = 1;
					break;
				}
			}
			$cont++;
		}
	}
	
	fclose($FileServ);
	unlink("../doc/ot_cargados/tmp".$numtemp.".html");
	
	$iregClienteot[clientsolici] = trim($arr_dataorden[0]);
	
	if ($tipo != 1) {
		$iregClienteot[clientfecsol] = trim($arr_dataorden[2]);
		
		if($tipo != 0)
			$iregClienteot[clientfecco] = trim($arr_dataorden[23]);
		else 
			$iregClienteot[clientfecco] = trim($arr_dataorden[27]);
			
		$iregClienteot[clientnombre] = trim($arr_dataorden[3]);
		$iregClienteot[clientdirecc] = trim($arr_dataorden[5]);
		$iregClienteot[clienttelefo] = trim($arr_dataorden[8]);
		$iregClienteot[clientcontac] = trim($arr_dataorden[10]);
		$iregClienteot[clienttelcon] = trim($arr_dataorden[11]);
		$iregClienteot[clientcelcon] = trim($arr_dataorden[12]);
		$iregClienteot[clientimplan] = trim($arr_dataorden[14]);

	}else{
		$fecha1 = explode("-",trim($arr_dataorden[25]));
		
		$iregClienteot[clientfecsol] = trim($arr_dataorden[4]);
		$iregClienteot[clientfecco] = trim($fecha1[0])."-". trim($fecha1[1])."-". trim($fecha1[2]);
		$iregClienteot[clientnombre] = trim($arr_dataorden[5]);
		$iregClienteot[clientdirecc] = trim($arr_dataorden[13]);
		$iregClienteot[clienttelefo] = trim($arr_dataorden[17]);
		$iregClienteot[clientcontac] = trim($arr_dataorden[19]);
		$iregClienteot[clienttelcon] = trim($arr_dataorden[20]);
		$iregClienteot[clientcelcon] = trim($arr_dataorden[21]);
		$iregClienteot[clientdatcon] = trim($arr_dataorden[22]);
	}
	$iregClienteot[deptocodigo] = $departamento;
	$iregClienteot[ciudadcodigo] = $ciudad;
	$mincFilePlan = "HC.adsumdat";

?>