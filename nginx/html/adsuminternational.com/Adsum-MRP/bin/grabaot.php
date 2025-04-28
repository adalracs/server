<?php
/*
-Todos los derechos reservados- Propiedad intelectual de Adsum (c).
Funcion	:	grabaot
Decripcion	:	Valida la data a grabar y la lleva al paquete.
Parametros	:				Descripicion
			$iRegot		Arreglo de datos.
			$flagnuevoot		Bandera de validaciï¿½n
Retorno	:
			true	=	1
			false	=	0
Autor		:	ariascos
Escrito con	:	WAG Adsum versiï¿½n 3.1.1
Fecha		:	18082004
Historial de modificaciones
|	Fecha			|	Motivo							|	Autor					|
 	18012005 			Implementacion						jcortes
 	05-may-2008		Restructuracion de la validacion				cbedoya
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

function grabaot(&$iRegot,&$iRegvaltareot,&$flagnuevoot,&$campnomb,&$codigoot,&$lider,&$tareottiedur, $validafalla)
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

	$nuidtemp = fncnumact(	id,$nuconn);
	do{
		$nuresult = loadrecordot($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegot[ordtracodigo] = $nuidtemp;
			$codigoot = $iRegot[ordtracodigo];
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
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
					if($sbregcampo["campnomb"] == $elementos[0]){
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
			$validresult = consulmetaot($elementos[0],$elementos[1],$nuconn);
             
			if($validresult == 1)
			{
				$flagnuevoot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}

			if($elementos[0] == "equipocodigo" && $elementos[1] == null)
			{
				$flagnuevoot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
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
			
			if($validafalla)
			{
				if($elementos[0] == "tipfalcodigo" && $elementos[1] == null)
				{
					$flagnuevoot = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
				
				if($elementos[0] == "ordtradescri" && $elementos[1] == null)
				{
					$flagnuevoot = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
		}
		
// Si quiere ingresar OT viejas comoente este codigo
/*
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
			fncmsgerror(errorIng);
		*/
// Hasta aqui		

		if($iRegot["ordtrafecfin"])
		{
			$tareottiedur = fnctimecmp($iRegot["ordtrafecini"],$iRegot["ordtrafecfin"],$iRegot["ordtrahorini"],$iRegot["ordtrahorfin"]);
	
			if($tareottiedur < 0)
			{
				$flagnuevoot = 1;
				$flagerror = 1;
				$campnomb[ordtrafecini] = 1;
				$campnomb[ordtrafecfin] = 1;
				fncmsgerror(fecvalid);
			}
		}
		else
		{
			$flagnuevoot = 1;
			$flagerror = 1;
			$campnomb[ordtrafecfin] = 1;
		}
		
		while ($elementareot = each($iRegvaltareot))
		{
			$validtareot = buscacaracter($elementareot[1]);

			if($validtareot == 1)
			{
				$flagnuevoot = 1;
				$flagerror = 1;
				$campnomb[$elementareot[0]] = 1;
			}
			
			if($elementareot[0] == "otestacodigo" && $elementareot[1] == null)
			{
				$flagnuevoot = 1;
				$flagerror = 1;
				$campnomb[$elementareot[0]] = 1;
			}
			
			if($elementareot[0] == "tareacodigo" && $elementareot[1] == null)
			{
				$flagnuevoot = 1;
				$flagerror = 1;
				$campnomb[$elementareot[0]] = 1;
			}
			
			if($elementareot[0] == "tiptracodigo" && $elementareot[1] == null)
			{
				$flagnuevoot = 1;
				$flagerror = 1;
				$campnomb[$elementareot[0]] = 1;
			}
			
			if($elementareot[0] == "tareotnota" && $elementareot[1] == null)
			{
				$flagnuevoot = 1;
				$flagerror = 1;
				$campnomb[$elementareot[0]] = 1;
			}
			
			if($elementareot[0] == "prioricodigo" && $elementareot[1] == null)
			{
				$flagnuevoot = 1;
				$flagerror = 1;
				$campnomb[$elementareot[0]] = 1;
			}
		}
		
		if(!$lider)
		{
			$campnomb["usualider"] = 1;
			echo "<script language='JavaScript'>";
			echo "alert('Error: Debe asignar un encargado a la orden');";
			echo "</script>";
			
			$flagerror = 1;
			$flagnuevoot = 1;
		}

		if($flagerror != 1)
		{
			$result = insrecordot($iRegot,$nuconn); //Guarda la Orden de trabajo Primero en la tabla OT
			
			if($result < 0 )
			{
				fncmsgerror(errorReg);
				$flagnuevoot = 1;
			}
			
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				$flagnuevoot = null;
				$arr_soliserv = loadrecordsoliserv($iRegot["solsercodigo"], $nuconn);

				if(!empty($arr_soliserv["estsolcodigo"]))
				{
					// Estado predefinido: 'ACEPTADA'
					$arr_soliserv["estsolcodigo"] = 2;
					// -- Actualizacion del registro
					$res_upd_soliserv = uprecordsoliserv($arr_soliserv, $nuconn);
					
					
					
					
					fncmsgerror(grabaEx);
				}
			}
			fncclose($nuconn);
		}
		else
		{
			fncmsgerror(errorIng);
			$flagnuevoot = 1;
		}
	}
}

//Convierte la hora en formato de 24 horas

if($pasadmerini)
	$ordtrahorini = date('H:i', strtotime($horini.':'.$minini.' pm'));
else
	$ordtrahorini = date('H:i', strtotime($horini.':'.$minini.' am'));
	
if($pasadmerfin)
	$ordtrahorfin = date('H:i', strtotime($horfin.':'.$minfin.' pm'));
else
	$ordtrahorfin = date('H:i', strtotime($horfin.':'.$minfin.' am'));


$valor = 0;

if($filterindex  && $equipocodigocmbx)
{
	$nuconn = fncconn();
	$nuresult = loadequipocodigo($equipocodigocmbx, $nuconn);
	
	if($nuresult > 0)
	{	
		$equipocodigo = $nuresult[equipocodigo];
		$sistemcodigo = $nuresult[sistemcodigo];
		$plantacodigo = $nuresult[plantacodigo];
	}	
}	

//fin validar
 
$iRegot[ordtracodigo] = $ordtracodigo;
$iRegot[ordtrafecgen] = date("Y-m-d");
$iRegot[ordtrahorgen] = date("H:i");
$iRegot[tipmancodigo] = $tipmancodigo;
$iRegot[tipfalcodigo] = $tipfalcodigo;
$iRegot[equipocodigo] = $equipocodigo;
$iRegot[tipmedcodigo] = $tipmedcodigo;
$iRegot[sistemcodigo] = $sistemcodigo;
$iRegot[plantacodigo] = $plantacodigo;
$iRegot[partecodigo] = $partecodigo;
$iRegot[componcodigo] = $componcodigo;
$iRegot[solsercodigo] = $solsercodigo;
$iRegot[ordtradescri] = $ordtradescri;
$iRegot[ordtrafecini] = $ordtrafecini;
$iRegot[ordtrahorini] = $ordtrahorini;
$iRegot[ordtrafecfin] = $ordtrafecfin;
$iRegot[ordtrahorfin] = $ordtrahorfin;
$iRegot[ordtranota] = $tareotnota;
$iRegot[otcantid] = $otcantid;
$iRegot[ordtratipo] = $ordtratipo;
$iRegot[ordtraorigen] = $ordtraorigen;
$iRegot[ordtraacti] = 1;
$iRegot[usuacodi] = $usuacodi;

if($ordtraparada)
	$iRegot['ordtraparada'] = 1;
else
	$iRegot['ordtraparada'] = 0;


if($tipmancodigo == '12')
	$validafalla = 1;

// ------ Datos de tareot
$iRegvaltareot[tareacodigo] = $tareacodigo;
$iRegvaltareot[tiptracodigo] = $tiptracodigo;
$iRegvaltareot[tareotnota] = $tareotnota;
$iRegvaltareot[prioricodigo] = $prioricodigo;
$iRegvaltareot[otestacodigo] = $otestacodigo;

if($typesource == 'user'):
	$arr = explode(',', $lsttecnicoot);
	$arreglo_tecnic = $lsttecnicoot;
	
	for($a = 0; $a < count($arr); $a++):
		if($usualider == $arr[$a]):
			$lider = $usualider;
			break;
		endif;
	endfor;
elseif($typesource == 'cuadrilla'):
	include_once '../src/FunPerPriNiv/pktblcuadrillausuario.php';
	include_once '../src/FunPerPriNiv/pktblusuanovedad.php';
	include_once '../src/FunPerPriNiv/pktblestadonoveda.php';

	$cuadricodigo = $lsttecnicoot;
	
	$idcon = fncconn();
	$rs_cuadrillausuario = loadrecordcuadrillausuariousuario($lsttecnicoot, $idcon);
	
	for($a = 0; $a < count($rs_cuadrillausuario); $a++):
		$inactivo = false;
	
		$recUsuaNovedad = array('usuacodi' => $rs_cuadrillausuario[$a]['usuacodi'], 'usunovfecini' => $ordtrafecini, 'usunovfecfin' => $ordtrafecfin);
		$recopUsuaNovedad = array('usuacodi' => '=', 'usunovfecini' => '>=', 'usunovfecfin' => '<=');
		
		$rs_novedad = dinamicscanopusuanovedad($recUsuaNovedad, $recopUsuaNovedad, $idcon);
		$nr_novedad = fncnumreg($rs_novedad);

		if($nr_novedad > 0):
			$rw_novedad = fncfetch($rs_novedad, 0);
			$rs_estadonoveda = loadrecordestadonoveda($rw_novedad['estnovcodigo'], $idcon);
			
			if($rs_estadonoveda['estnovactusu'])
				$inactivo = true;
		endif;
		
		if($inactivo == false):
			if($arreglo_tecnic)
				$arreglo_tecnic .= ','.$rs_cuadrillausuario[$a]['usuacodi'];
			else
				$arreglo_tecnic = $rs_cuadrillausuario[$a]['usuacodi'];
		endif;
			
		if($rs_cuadrillausuario[$a]['cuausulider'] == 't'):
			if($inactivo == false)
				$lider = $rs_cuadrillausuario[$a]['usuacodi'];
		endif;
		
		if(!$lider && $inactivo == false)
			$lider = $rs_cuadrillausuario[$a]['usuacodi'];
	endfor;
endif;

grabaot($iRegot,$iRegvaltareot,$flagnuevoot,$campnomb,$codigoot,$lider,$tareottiedur, $validafalla);

if(!$flagnuevoot)
{
	$flagotinicial = true;
	include ('grabatareot.php');
	
	if(!$flagnuevotareot)
	{
		if($lider)
			include ( 'grabausuariotareot.php');
		include('grabatransaction.php');
		// 		Bandera usuada en grabahistoriaot,
		//		la cual indica que el llamado proviene de 'grabaOt.php'
		//		$flagotinicial = true;
		//		include('grabahistoriaot.php');
	}
	
	if($ordtraparada)
	{
		$parprodescri = 'Parada generada por orden de trabajo No. '.$codigoot;
		$parprofecgen = date('Y-m-d');
		$parprohorgen = date('H:i');
		$ordtracodigo = $codigoot;
		
		if($pasadpromerini)
			$parprohorini = date("H:i", strtotime($horproini.":".$minproini." pm"));
		else
			$parprohorini = date("H:i", strtotime($horproini.":".$minproini." am"));
		include('grabaparaprod.php');
	}
	
	
	//	Actualiza el estado de una solicitud de servicio
	if($flagsoliservot)
	{
//		$idcon = fncconn();
//		
//
//		if(!empty($arr_soliserv["estsolcodigo"]))
//		{
//			// Estado predefinido: 'ACEPTADA'
//			$arr_soliserv["estsolcodigo"] = 2;
//			// -- Actualizacion del registro
//			$res_upd_soliserv = uprecordsoliserv($arr_soliserv, $idcon);
//		}
//		fncclose($idcon);
//		
		// Correos
		include '../src/FunPHPMailer/mail.send.php';
		
		$idcon = fncconn();
		$arr_soliserv = loadrecordsoliserv($solsercodigo, $idcon);
		
		$mails = array();
		$data = array(
					'solsercodigo' => $solsercodigo, 
					'usuacodi' => $usuacodi, 
					'solicitausuacodi' => $arr_soliserv[usuacodi], 
					'ordtracodigo' => $codigoot
		);
		$rsUsuario = loadrecordusuario($arr_soliserv[usuacodi], $idcon);

		if($rsUsuario[usuaemail]):
			$mails[] = $rsUsuario[usuaemail];
			send_mail('soliservot', $data, $mails);
		endif;
		//Correos
	}
	//  Impresion de OT --
	echo "<script language='JavaScript'>";
	
	echo " if (confirm('¿Desea imprimir la OT creada?'))";
	//echo "		window.open('detallaotprint.php','secundaria','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');";
	echo "{"; 
	echo "window.open('imprimirot.php?codigo=$iRegot[ordtracodigo]','impresion','status=no,menubar=no,scrollbars=yes,resizable=yes,width=800,height=650');";
    echo 'location ="maestablot.php?codigo=95;"'; 	
	echo "}";
	echo "else";
	echo "{";
	echo 'location ="maestablot.php?codigo=95;"'; 
	echo "}";
	echo "</script>";
}
?>