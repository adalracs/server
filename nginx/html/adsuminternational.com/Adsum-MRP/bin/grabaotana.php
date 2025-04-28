<?php
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaot
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegot         Arreglo de datos.
$flagnuevoot    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
18012005 Implementacion			jcortes
*/

include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblot.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunPerPriNiv/pktblsoliserv.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fnctimecmp.php');

function grabaot(&$iRegot,&$iRegvaltareot,&$flagnuevoot,&$campnomb,&$codigoot,&$empleacod,&$tareottiedur)
{

	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",34);
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
	define("errorTimeValot",38);

	$nuidtemp = fncnumact(id,$nuconn);
	do
	{
		$nuresult = loadrecordot($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegot[ordtracodigo] = $nuidtemp;
			$codigoot = $iRegot[ordtracodigo];
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	
	$ordtracodigo = $iRegsoliserv[ordtracodigo];
	
	//$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	if($iRegot)
	{
		$iRegtabla["tablnomb"] = "ot";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "ot")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);

		while($elementos = each($iRegot))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "ordtracodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevoot = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevoot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetaot($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevoot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}

			if($elementos[0] == "ordtrahorini" && $elementos[1] == null)
			{
				$flagnuevoot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}

			if($elementos[0] == "ordtrahorfin" && $elementos[1] == null)
			{
				$flagnuevoot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}

			if($elementos[0] == "tipmancodigo" && $elementos[1] == null)
			{
				$flagnuevoot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}

			/*if($elementos[0] == "ordtradescri" && $elementos[1] == null)
			{
				$flagnuevoot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}*/
		}

		$varfecaux = $iRegot[ordtrafecini].",".$iRegot[ordtrahorini];
		$varfecgen = $iRegot[ordtrafecgen].",".$iRegot[ordtrahorgen];

		if($varfecaux < $varfecgen)
		{
			fncmsgerror(errorTimeValot);
			$flagnuevoot = 1;
			$flagerror = 1;
			$campnomb[ordtrafecini] = 1;
		}

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}


		if($flagerror != 1)
		{
			$tareottiedur = fnctimecmp($iRegot["ordtrafecini"],$iRegot["ordtrafecfin"],$iRegot["ordtrahorini"],$iRegot["ordtrahorfin"]);

			if($tareottiedur >= 0)
			{
				if($empleacod)
				{
					while ($elementareot = each($iRegvaltareot))
					{
						$validtareot = buscacaracter($elementareot[1]);

						if($validtareot == 1)
						{
							$flagnuevoot = 1;
							$flaerrtareot = 1;
							$campnomb[$elementareot[0]] = 1;
						}
						if($elementareot[0] == "tareacodigo" && $elementareot[1] == null)
						{
							$flagnuevoot = 1;
							$flaerrtareot = 1;
							$campnomb[$elementareot[0]] = 1;
						}
						if($elementareot[0] == "tiptracodigo" && $elementareot[1] == null)
						{
							$flagnuevoot = 1;
							$flaerrtareot = 1;
							$campnomb[$elementareot[0]] = 1;
						}
						if($elementareot[0] == "tareotnota" && $elementareot[1] == null)
						{
							$flagnuevoot = 1;
							$flaerrtareot = 1;
							$campnomb[$elementareot[0]] = 1;
						}
						if($elementareot[0] == "prioricodigo" && $elementareot[1] == null)
						{
							$flagnuevoot = 1;
							$flaerrtareot = 1;
							$campnomb[$elementareot[0]] = 1;
						}
					}

					if ($flaerrtareot == 1)
					{
						fncmsgerror(errorIng);
					}

					if($flaerrtareot != 1)
					{
						$result = insrecordot($iRegot,$nuconn);
						if($result < 0 )
						{
							fncmsgerror(errorReg);
							$flagnuevoot = 1;
						}
						if($result > 0)
						{
							$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
							$flagnuevoot = null;
							fncmsgerror(grabaEx);
						}
						fncclose($nuconn);
					}
				}else
				{
					$campnomb["usuacodi"] = 1;
					fncmsgerror(errorIng);
					//					ob_end_clean();
					$flagnuevoot = 1;
				}
			}else
			{
				$flagnuevoot = 1;
				$campnomb[ordtrafecini] = 1;
				$campnomb[ordtrafecfin] = 1;
				fncmsgerror(fecvalid);
			}
		}
	}
	return $codigoot;
}
//Convierte la hora en formato de 24 horas
$foo1 = explode(":",$ordtrahorini);
$foo2 = explode(":",$ordtrahorfin);
if($pasadmerini)
{
	if($foo1[0] != 12)
	$ordtrahorini = ($foo1[0] + 12).":".$foo1[1];
}elseif($foo1[0] == 12)
$ordtrahorini = "00:".$foo1[1];
if($pasadmerfin)
{
	if($foo2[0] != 12)
	$ordtrahorfin = ($foo2[0] + 12).":".$foo2[1];
}elseif($foo2[0] == 12)
$ordtrahorfin= "00:".$foo2[1];

/*if($equipotexto == "si")
{
	echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("selecciono equipo")';
		echo '//-->'."\n";
		echo '</script>';
}
if($componentetexto == "si")
{
	echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("selecciono componente")';
		echo '//-->'."\n";
		echo '</script>';
}
*/

//validar el nombre del equipo cuando se ingresa en texto
//se busca el codigo del equipo, sistema y planta
$valor = 0;
if ($equipotexto == "si" && $equipocodigo_auto != "")
{
	$nuconn = fncconn();
	$nuresult = loadequipocodigo($equipocodigo_auto,$nuconn);
	if($nuresult != e_empty)
	{	
		$equipocodigo = $nuresult[equipocodigo];
		$sistemcodigo = $nuresult[sistemcodigo];
		$plantacodigo = $nuresult[plantacodigo];
	
		//se busca el codigo del componente
		if ($componentetexto == "si" && $componcodigo_auto != "")
		{		
			$nuconn = fncconn();
			$nuresult = loadcomponentecodigo($equipocodigo,$componcodigo_auto,$nuconn);
			if($nuresult != e_empty)
			{	
				$componcodigo = $nuresult[componcodigo];
				
			}
		}
	}	

}	


	
//fin validar

$iRegot[ordtracodigo] = $ordtracodigo;
$iRegot[ordtrafecgen] = $ordtrafecgen;
$iRegot[ordtrahorgen] = $ordtrahorgen;
$iRegot[tipmancodigo] = $tipmancodigo;
$iRegot[equipocodigo] = $equipocodigo;
$iRegot[tipmedcodigo] = $tipmedcodigo;
$iRegot[sistemcodigo] = $sistemcodigo;
$iRegot[plantacodigo] = $plantacodigo;
$iRegot[partecodigo] =  $partecodigo;
$iRegot[componcodigo] = $componcodigo;
$iRegot[solsercodigo] = $solsercodigo;
$iRegot[ordtradescri] = $ordtradescri;
$iRegot[ordtrafecini] = $ordtrafecini;
$iRegot[ordtrahorini] = $ordtrahorini;
$iRegot[ordtrafecfin] = $ordtrafecfin;
$iRegot[ordtrahorfin] = $ordtrahorfin;
$iRegot[ordtranota] = $ordtranota;
$iRegot[otcantid] = $otcantid;
$iRegot[ordtratipo] = $ordtratipo;
$iRegot[ordtraorigen] = $ordtraorigen;
$iRegot[ordtraacti] = 1;
$iRegot[usuacodi] = $usuacodi;
// ------ Datos de tareot
$iRegvaltareot[tareacodigo] = $tareacodigo;
$iRegvaltareot[tiptracodigo] = $tiptracodigo;
$iRegvaltareot[tareotnota] = $tareotnota;
$iRegvaltareot[prioricodigo] = $prioricodigo;


if($plantacodigo == "Seleccione" || $sistemcodigo == "Seleccione" || $equipocodigo == "Seleccione" || $equipocodigo == "")
{
	echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("Los datos principales no están llenos")';
		echo '//-->'."\n";
		echo '</script>';
	
}

else 
{
$idcodigo= grabaot($iRegot,$iRegvaltareot,$flagnuevoot,$campnomb,$codigoot,$empleacod,$tareottiedur);

if(!$flagnuevoot)
{
	$flagotinicial = true;

	

	include ('grabatareot.php');
	
	if(!$flagnuevotareot)
	{

		if($empleacod)
		{
			include ( 'grabausuariotareot.php');
		}
		include('grabatransaction.php');
		// 		Bandera usuada en grabahistoriaot,
		//		la cual indica que el llamado proviene de 'grabaOt.php'
		//		$flagotinicial = true;
		//		include('grabahistoriaot.php');
	}
	//	Actualiza el estado de una solicitud de servicio
	if($flagsoliservot)
	{
		$idcon = fncconn();
		$arr_soliserv = loadrecordsoliserv($solsercodigo, $idcon);

		if(!empty($arr_soliserv["estsolcodigo"]))
		{
			// Estado predefinido: 'ACEPTADA'
			$arr_soliserv["estsolcodigo"] = 3;
			// -- Actualizacion del registro
			$res_upd_soliserv = uprecordsoliserv($arr_soliserv, $idcon);
		}
		fncclose($idcon);
	}
	//  Impresion de OT --
	echo "<script language='JavaScript'>";
	  // 	echo " if (confirm('Desea imprimir la OT creada?'))";
	   echo "	window.open('detallanuevotprint.php','text','status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=520');";

	echo "</script>";
}
}
?>
