<?php
	if ($tipo == 1){
  		$Campos = '<font color=#FFFFFF><b>,<input type=hidden,CASO NUMERO :,</td>,<span class="texarea">,<input type="hidden" id="x_ORG_ID" name="x_ORG_ID",
<td bgcolor="#F5F5F5"><span class="texarea">,<input type="hidden" id="x_SED_ID",<span class="texarea">,
<input type="hidden" id="x_SED_ID",<span class="texarea">,<input type=hidden name=x_TC_ESTADO,<span class="texarea">,
<input type="hidden" id="x_CAS_FECHA_CREACION",<span class="texarea">,</span></td>,<span class="texarea">,
<input type="hidden" id="x_SED_ID",id_tota_visita_datos value=0>,</span></td>,<span class="texarea">,
</span></td>,<span class="texarea">,</span></td>';

	}else{	
		$Campos = 'SOLICITUD NUMERO :,</td>,<span class="phpmaker">,<input type="hidden" ,
	 <span class="phpmaker">,<input type="hidden" ,<span class="phpmaker">,</span>,
	 <span class="phpmaker">,</span>,<span class="phpmaker">,<input type=hidden,
	 <span class="phpmaker">,<input type=hidden,<span class="phpmaker">,<input type=hidden,
	 <span class="phpmaker">,<input type=hidden,<span class="phpmaker">,<input type=hidden,
	 <span class="phpmaker">,<input type=hidden,<span class="phpmaker">,<input type=hidden,
	 <span class="phpmaker">,<input type=hidden,<span class="phpmaker">,<input type=hidden,
	 <span class="phpmaker">,<input type=hidden,<td class=phpmaker bgcolor=#F5F5F5>,</td>,
	 <span class="phpmaker">,<input type=hidden,<span class="phpmaker">,<input type=hidden,
	 <span class="phpmaker">,</span>,<span class="phpmaker">,</span>,<span class="phpmaker">,</span>,
	 <span class="phpmaker">,<input type=hidden,<span class="phpmaker">,</span>,
	 <span class="phpmaker">,<input type=hidden,<span class="phpmaker">,<input type="hidden",
	 <span class="phpmaker">,</span>,<span class="phpmaker">,</span>,
	 <td class=phpmaker bgcolor=#F5F5F5>,</td>,<span class="phpmaker">,</span>,
	 <span class="phpmaker">,</span>,<span class="phpmaker">,</span>,
	 <span class="phpmaker">,<input type=hidden ';
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
			
			if($tipo == $cont){
				$Solicitud = explode(" ",trim($arr_dataorden[$cont]));
				$idcnx = fncconn();
				
				$result = loadrecordclienteot(trim(str_replace("&nbsp;","",$Solicitud[0])),$idcnx);
				$arr_dataorden[$cont] = trim(str_replace("&nbsp;","",$Solicitud[0]));
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
	
	$iregClienteot[clientsolici] = trim(str_replace("&nbsp;","",$Solicitud[0]));
	
	if($tipo == 1){		
		$iregClienteot[clientfecsol] = trim($arr_dataorden[6]);
		$iregClienteot[clientnombre] = trim($arr_dataorden[2]);
		$iregClienteot[clientdirecc] = trim($arr_dataorden[4]);
		$iregClienteot[clientcontac] = trim($arr_dataorden[7]);
		$iregClienteot[clientimplan] = trim($arr_dataorden[10]);
		$iregClienteot[clientdatcon] = trim($arr_dataorden[8]);
	}else{
		$iregClienteot[clientfecsol] = trim($arr_dataorden[2]);
		$iregClienteot[clientfecco] = trim($arr_dataorden[15]);
		$iregClienteot[clientnombre] = trim($arr_dataorden[1]);
		$iregClienteot[clientdirecc] = trim($arr_dataorden[13]);
		$iregClienteot[clientcontac] = trim($arr_dataorden[19]);
		$iregClienteot[clientimplan] = trim($arr_dataorden[3]);
	}
	$iregClienteot[deptocodigo] = $departamento;
	$iregClienteot[ciudadcodigo] = $ciudad;
	$mincFilePlan = "sisgot.adsumdat";

?>