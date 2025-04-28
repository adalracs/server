<?php 
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion         : grabacierreot 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegcierreot         Arreglo de datos. 
    $flagnuevocierreot    Bandera de validaci�n 
Retorno         : 
		true	= 1 
		false	= 0 
Autor           : ariascos 
Escrito con     : WAG Adsum versi�n 3.1.1 
Fecha           : 18082004 
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
*/ 
  
include ( '../src/FunGen/fncnumprox.php'); 
include ( '../src/FunGen/fncnumact.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunPerPriNiv/pktblcierreot.php'); 
include ( '../src/FunPerPriNiv/pktblcampo.php'); 
include ( '../src/FunPerPriNiv/pktbltabla.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
 
function grabacierreot($iRegcierreot,&$flagnuevocierreot,&$campnomb, &$codcierre){ 
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("id",1); 
	define("errorReg",1); 
	define("errorCar",2); 
	define("grabaEx",3); 
	define("compinst",4); 
	define("venccomp",5); 
	define("compactu",6); 
	define("fecvalid",7); 
	define("errormail",8); 
	define("editaEx",9);
	define("errorIng",35);
	 
	$nuidtemp = fncnumact(	id,$nuconn); 

	do{ 
		$nuresult = loadrecordcierreot($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{ 
			$iRegcierreot[cierotcodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	$codcierre = $iRegcierreot[cierotcodigo];
	//	No utilice esta parte si va a utilizar la llave primaria como serial 

	if($iRegcierreot){


		$iRegtabla["tablnomb"] = "cierreot";
		
		//aca...
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		
		$num = fncnumreg($resulttabla);

		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "cierreot")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		while($elementos = each($iRegcierreot))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);

			
			$num = fncnumreg($resultcampo);
			
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "cierotcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevocierreot = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevocierreot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetacierreot($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevocierreot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			/*if($elementos[0] == "reportcodigo" && $elementos[1] == null)
			{
				$flagnuevocierreot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}*/
			
			if($elementos[0] == "tipcumcodigo" && $elementos[1] == null)
			{
				$flagnuevocierreot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			if($elementos[0] == "cierotdescri" && $elementos[1] == null)
			{
				$flagnuevocierreot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
		}

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
					 
		if($flagerror != 1) 
		{ 
			$result = insrecordcierreot($iRegcierreot,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevocierreot=1; 
			} 
			if($result > 0) 
			{ 
				//fncmsgerror(grabaEx); 
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$foo1 = explode(":",$horini.":".$minini);


if($pasadmerini){
	if($foo1[0] != 12)
		$ordtrahorini = ($foo1[0] + 12).":".$foo1[1];
}elseif($foo1[0] == 12){
	$ordtrahorini = "00:".$foo1[1];
}else{
	$ordtrahorini = $foo1[0].":".$foo1[1];
}

$iRegcierreot[cierotcodigo] = $cierotcodigo; 
$iRegcierreot[usuacodi] = $usuacodi; 
$iRegcierreot[tipcumcodigo] = $tipcumcodigo; 
$iRegcierreot[reportcodigo] = $reportcodigo; 
$iRegcierreot[cierotfecfin] = $clientfecsol; 
$iRegcierreot[cierothorfin] = $ordtrahorini; 
$iRegcierreot[cierotfecgen] = date('Y-m-d'); 
$iRegcierreot[cierothorgen] = date('H:i'); 
$iRegcierreot[ordtracodigo] = $ordtracodigo; 
$iRegcierreot[cierotdescri] = $nota;

grabacierreot($iRegcierreot,$flagnuevocierreot,$campnomb,$codcierre); 

	if(!$flagnuevocierreot){
		include_once( '../src/FunPerPriNiv/pktblcierreactividad.php');
		if($arreglo_act){
			$arrdetall = explode(";",$arreglo_act);
			$idcon = fncconn();
			
			for($i = 0; $i < count($arrdetall); $i++){
				$iRegcierreactividad[cierotcodigo] = $codcierre;
				$arr_data = explode(":",$arrdetall[$i]);
				
				$iRegcierreactividad[activicodigo] = $arr_data[0];
				$iRegcierreactividad[cieactcantid] = $arr_data[1];
					
				$result = insrecordcierreactividad($iRegcierreactividad,$idcon); 
			}
				
		}
		
		include_once( '../src/FunPerPriNiv/pktblcierreitem.php');
		if($arreglo_ite){
			$arrdetall1 = explode(";",$arreglo_ite);
			$idcon = fncconn();
			
			for($i = 0; $i < count($arrdetall1); $i++){
				$iRegcierreitem[cierotcodigo] = $codcierre;
				$arr_data = explode(":",$arrdetall1[$i]);

				$iRegcierreitem[itemcodigo] = $arr_data[0];
				$iRegcierreitem[cieitecantid] = $arr_data[1];
					
				$result = insrecordcierreitem($iRegcierreitem,$idcon); 
			}
				
		}
		/*
		
		$idcoon = fncconn();
		$tareotsecuen = loadrecordtareotsecuen($ordtracodigo,$idcoon); 
		
		$nuidtemp = fncnumact(38,$idcoon); 
		do{ 
			$nuresult = loadrecordtareot($nuidtemp,$idcoon); 
			if($nuresult == e_empty) 
			{ 
				$iRegtareot[tareotcodigo] = $nuidtemp; 
				$codigotareot = $iRegtareot[tareotcodigo];
			} 
			$nuidtemp ++; 
		}while ($nuresult != e_empty); 
	
		
		$iRegtareot[ordtracodigo] = $ordtracodigo; 
		$iRegtareot[tareacodigo]  =  $sbreg[tareacodigo] ;  
		$iRegtareot[tareotnota]   = $nota; 
		$iRegtareot[progracodigo] = $codigoprog; 
		$iRegtareot[tareothorini] = $ordtrahorini; 
		$iRegtareot[tareotfecini] = $fecha_agen; 
		$iRegtareot[tareothorfin] = $dateotfin[1]; 
		$iRegtareot[tareotfecfin] =$dateotfin[0]; 
		$iRegtareot[tareotsecuen] = $tareotsecuen+1; 
		$iRegtareot[tareotfin] = $tareotfin; 
		$iRegtareot[usuacodi] = $codud; 
		$iRegtareot[otestacodigo] = 2; 
		$iRegtareot[prioricodigo] = $sbreg[prioricodigo]; 
		$iRegtareot[tipcumcodigo] = $tipcumcodigo;
		$iRegtareot[tareotfecgen] = date("Y-m-d");
		$iRegtareot[tareothorgen] = date("H:i");
		if($ccuadrilla)
			$iRegtareot[tareotusuasi] = 't';
		else
			$iRegtareot[tareotusuasi] = 'f';
		
		
		
		
		$result = insrecordtareot($iRegtareot,$idcoon);
		$nuresult1 = fncnumprox(38,$codigotareot,$idcoon);
		
		*/
		

		fncmsgerror(3);
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'location ="maestablcierreotserv.php?codigo='.$codigo.';"';
		echo '//-->'."\n";
		echo '</script>';
		unset($arreglo_ite);
		unset($arreglo_act);
	}

?>
