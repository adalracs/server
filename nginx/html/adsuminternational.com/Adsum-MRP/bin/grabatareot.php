<?php 
//OT NO 7050
/* 
-Todos los derechos reservados- 
Propiedad intelectual de Adsum (c). 
Funcion	:	grabatareot 
Decripcion	:	Valida la data a grabar y la lleva al paquete. 
Parametros	:				Descripicion 
    			$iRegtareot		Arreglo de datos. 
    			$flagnuevotareot	Bandera de validaci�n 
Retorno	: 
			true	=	1 
			false	=	0 
Autor		:	ariascos 
Escrito con	:	WAG Adsum versi�n 3.1.1 
Fecha		:	18082004 
Historial de modificaciones 
|	Fecha			|	Motivo					|	Autor			| 
	19012005 			Implementacion				jcortes
*/  

// $flagotinicial: Indica que el archivo ha sido incluido en grabaot.php
	include_once('grabatareot2.php');
	
	if($flagotinicial)
	{
		$iRegtareot[tareotcodigo] = $tareotcodigo; 
		$iRegtareot[ordtracodigo] = $codigoot; 
		$iRegtareot[tareacodigo]  = $tareacodigo; 
		$iRegtareot[tiptracodigo] = $tiptracodigo; 
		$iRegtareot[operaccodigo] = $operaccodigo; 
		$iRegtareot[tareottiedur] = $tareottiedur; 
		$iRegtareot[tareotnota]   = $tareotnota; 
		$iRegtareot[progracodigo] = $codigoprog; 
		$iRegtareot[tareothorini] = $ordtrahorini; //
		$iRegtareot[tareotfecini] = $ordtrafecini; //
		$iRegtareot[tareothorfin] = $ordtrahorfin; //
		$iRegtareot[tareotfecfin] = $ordtrafecfin; //
		$iRegtareot[tareotsecuen] = 0; 
		$iRegtareot[tareotfin] = $tareotfin; 
		$iRegtareot[usuacodi] = $_COOKIE[usuacodi]; 
		$iRegtareot[otestacodigo] = $otestacodigo; 
		$iRegtareot[prioricodigo] = $prioricodigo;  
		$iRegtareot[tipcumcodigo] = $tipcumcodigo; 
		$iRegtareot[tareotfecgen] = date('Y-m-d'); 
		$iRegtareot[tareothorgen] = date('H:i'); 
		//$iRegtareot[parotcodigo] = $tarparotcodigo; 
		$ordtracodigo = grabatareot($iRegtareot,$flagnuevotareot,$flagnuevoot,$campnomb,$codigotareot,$flagotinicial); 
	}
	else
	{
		include_once ('../src/FunPerPriNiv/pktbltareot.php');
		$idcon = fncconn();
		
		if(!$ordtracodigo)
			$ordtracodigo = $sbregot [ordtracodigo];
			
		$iRegtareot = loadrecordallmaxtareot ( $ordtracodigo, $idcon );

		if($flagreportot)
		{
			include_once ('../src/FunPerPriNiv/pktblusuariotareot.php');
			$declare = true;
			
			$iRecordusertareot ['tareotcodigo'] = $iRegtareot['tareotcodigo'];
			$nuResult = dinamicscanusuariotareot ( $iRecordusertareot, $idcon );
			
			if ($nuResult > 0) 
			{
				$nuCantRow = pg_numrows ( $nuResult );
					
				if ($nuCantRow > 0) 
				{
					for($i = 0; $i < $nuCantRow; $i ++) 
					{
						$sbRow = fncfetch ( $nuResult, $i );
						$cuadricodigo = $sbRow['cuadricodigo'];
						
						if ($sbRow [3] == 't')
							$lider = $sbRow[1];
						else 
						{
							if(!$arreglo_tecnic)
								$arreglo_tecnic = $sbRow[1];
							else
								$arreglo_tecnic .= ','.$sbRow[1];
						}
					}
				}
			}
		}
		
		$iRegtareot['tareotcodigo'] = $tareotcodigo; 
		$iRegtareot['ordtracodigo'] = $ordtracodigo; 
		$iRegtareot['tareotnota']   = $tareotnota; 
		$iRegtareot['tareothorini'] = date('H:i'); 
		$iRegtareot['tareotfecini'] = date('Y-m-d');
		$iRegtareot['tareothorfin'] = $tareothorfin; 
		$iRegtareot['tareotfecfin'] = $tareotfecfin; 
		$iRegtareot['tareotfin'] = $tareotfin; 
		$iRegtareot['usuacodi'] = $_COOKIE[usuacodi];
		$iRegtareot['otestacodigo'] = $otestacodigo;
		$iRegtareot['tareotfecgen'] = date('Y-m-d'); 
		$iRegtareot['tareothorgen'] = date('H:i'); 
		
		if($tareacodigo)
	   		$iRegtareot['tareacodigo'] = $tareacodigo;
		if($tiptracodigo)
	   		$iRegtareot['tiptracodigo'] = $tiptracodigo;
		if($prioricodigo)
	   		$iRegtareot['prioricodigo'] = $prioricodigo;
	   		
		grabatareot($iRegtareot, $flagnuevotareot, $flagnuevoot, $campnomb, $codigotareot, $flagotinicial);
		



		include ('grabausuariotareot.php');
		
		if(!$flagnuevotareot){

			$idcon = fncconn();

			if($uploadocumen) $arrUploadocumen = explode("::", $uploadocumen); else unset($arrUploadocumen);
			if($uploadocumensize) $arrUploadocumensize = explode("::", $uploadocumensize); else unset($arrUploadocumensize);

			for($a = 0; $a < count($arrUploadocumen); $a++){

				$iRegDocumenot["ordtracodigo"] = $ordtracodigo;
				$iRegDocumenot["docuotnombre"] = $arrUploadocumen[$a];
				$iRegDocumenot["docuottamano"] = $uploadocumensize[$a];

				insrecorddocumenot($iRegDocumenot, $idcon);
			}	

			echo "<script language='JavaScript'>";
			echo "alert('Grabado Exitoso');";
			echo 'location ="maestabltareot.php?codigo='.$codigo.';"'; 
			echo "</script>";
			unset($ordtracodigo);
		}

		
	}