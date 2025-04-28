<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaopp
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegopp         Arreglo de datos.
$flagnuevoopp    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/
ini_set('display_errors',1);
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblopp.php');
include ( '../src/FunPerPriNiv/pktblopextrusion.php');
include ( '../src/FunPerPriNiv/pktblopflexo.php');
include ( '../src/FunPerPriNiv/pktbloplaminado.php');
include ( '../src/FunPerPriNiv/pktblopcorte.php');
include ( '../src/FunPerPriNiv/pktblopsellado.php');
include ( '../src/FunPerPriNiv/pktbloppauchado.php');
include ( '../src/FunPerPriNiv/pktblopdoblado.php');
include ( '../src/FunPerPriNiv/pktblopmicroperforado.php');
include ( '../src/FunPerPriNiv/pktbloptroquelado.php');
include ( '../src/FunPerPriNiv/pktblopvalvulado.php');
include ( '../src/FunPerPriNiv/pktbloppitemdesa.php');
include ( '../src/FunPerPriNiv/pktblprogramaextrusion.php');
include ( '../src/FunPerPriNiv/pktblprogramaflexo.php');
include ( '../src/FunPerPriNiv/pktblprogramalaminado.php');
include ( '../src/FunPerPriNiv/pktblprogramacorte.php');
include ( '../src/FunPerPriNiv/pktblprogramasellado.php');
include ( '../src/FunPerPriNiv/pktblprogramapauchado.php');
include ( '../src/FunPerPriNiv/pktblprogramadoblado.php');
include ( '../src/FunPerPriNiv/pktblprogramamicroperforado.php');
include ( '../src/FunPerPriNiv/pktblprogramatroquelado.php');
include ( '../src/FunPerPriNiv/pktblprogramavalvulado.php');
include ( '../src/FunPerPriNiv/pktblplaneaitemdesa.php');
include ( '../src/FunPerPriNiv/pktbloppvelocidadpn.php');
include ( '../src/FunPerPriNiv/pktbloppajustepn.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunPerSecNiv/fncsqlrun.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnombexs.php');

function grabaopp(&$iRegopp,&$flagnuevoopp,&$campnomb,$arrmatplan,$proceddestin)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",147);
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

	$nuidtemp = fncnumact(id,$nuconn);
	do
	{
		$nuresult = loadrecordopp($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegopp["ordoppcodigo"] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegopp)
	{
		$iRegtabla["tablnomb"] = "opp";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla["tablnomb"] == "opp")
			{
				$tablcodi=$sbregtabla["tablcodi"];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegopp_b = $iRegopp;

		while($elementos = each($iRegopp))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevoopp = 1;
								$flagerror = 1;
							}
						}
					}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevoopp = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			$validresult = consulmetaopp($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevoopp = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
		}
		
		if($flagnuevoopp)
			$flagerror = 1;

		
		if(!$arrmatplan)
		{
			$flagnuevoopp = 1;
			$flagerror = 1;
			$campnomb["arrmatplan"] = 1;
		}	
		
		if(!$proceddestin)
		{
			$flagnuevoopp = 1;
			$flagerror = 1;
			$campnomb["proceddestin"] = 1;
		}	
		
		if($flagnuevoopp == 1)
		{
			$flagerror = 1;
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = insrecordopp($iRegopp,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevoopp=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				insrecordprogramaflexo(array("ordoppcodigo" => $iRegopp["ordoppcodigo"], "prograindice" => 999),$nuconn);			
			}
			fncclose($nuconn);
		}
	}

}

$iRegopp["ordoppcodigo"] = $ordoppcodigo;
$iRegopp["usuacodi"] = $usuacodi;
$iRegopp["ordoppcantkg"] = $ordoppcantkg;
$iRegopp["ordoppanchot"] = $ordoppanchot;
$iRegopp["equipocodigo"] = $equipocodigo;
$iRegopp["plantacodigo"] = $plantacodigo;
$iRegopp["ordoppcorte"] = '0';
$iRegopp["ordoppcantmt"] = $ordoppcantmt;
$iRegopp["ordoppancref"] = $ordoppancref;
$iRegopp["ordoppcomfir"] = 0;

$idcon = fncconn();

if(!$arrvelocidadpn)
{
	$campnomb["arrvelocidadpn"] = 1;
	$flagnuevoopp = 1;
}

if(!$arrajustepn)
{
	$campnomb["arrajustepn"] = 1;
	$flagnuevoopp = 1;
}

if($arrmatlaminar) $objsarrmatlaminar = explode(":|:", $arrmatlaminar); else unset($objsarrmatlaminar);

if($arrmatplan) $objsarrmatplan = explode(":|:", $arrmatplan); else unset($objsarrmatplan);

/*
if($matimprimir) $arrMaterialAsignado[$matimprimir] = 1;

$arrMaterialAsignado = array();

for($a = 0; $a < count($objsarrmatlaminar); $a++){

	$arrMaterialAsignado[$objsarrmatlaminar[$a]] = 1;

	for($b = 0; $b < count($objsarrmatplan); $b++){

		$rowarrmatplan = explode(":-:", $objsarrmatplan[$b]);
		$rwItemdesa = loadrecorditemdesa($rowarrmatplan[0], $idcon);
		$rwPadreitem = loadrecordpadreitemxkeylinea($rwItemdesa["keylinea"],$idcon);

		var_dump($rwPadreitem);echo "<br><br>";

		if($objsarrmatlaminar[$a] == $rwPadreitem["paditecodigo"]){//para laminado

			$arrMaterialAsignado[$objsarrmatlaminar[$a]] = 0;//se ingreso material para este padre item
		}

		if($matimprimir && ($matimprimir == $rwPadreitem["paditecodigo"]) ){//para flexografia

			$arrMaterialAsignado[$matimprimir] = 0;//se ingreso material para este padre item
		}

	}

	if($arrMaterialAsignado[$objsarrmatlaminar[$a]] > 0){

		$flagerrorasignacion = 1;
		$flagnuevoopp = 1;
	}

}

if($matimprimir && $arrMaterialAsignado[$matimprimir] > 0){

	$flagerrorasignacion = 1;
	$flagnuevoopp = 1;
}
*/

fncclose($idcon);

grabaopp($iRegopp,$flagnuevoopp,$campnomb,$arrmatplan,$proceddestin);

//al tener grabado exitoso se procede a actualar las op contenidas en la opp
if(!$flagnuevoopp)
{
	$idcon = fncconn();unset($arrObject);
	//consecutivo para oppitemdesa almacena cada 
	//materia prima asignada a la orden de produccion
	$nuidtemp = fncnumact(233,$idcon);	
	do
	{
		$nuresult = loadrecordoppitemdesa($nuidtemp,$idcon);
		if($nuresult == e_empty)
			$iRegOppitemdesa["oppitecodigo"] = $nuidtemp - 1;
			$nuidtemp ++;
	}while ($nuresult != e_empty);
	//se valida el array de materiales para ser explosinado
	if($arrmatplan) $arrObject = explode(":|:",$arrmatplan);
	//se recorre el array de materiales asignados
	for ($a = 0; $a < count($arrObject); $a++)
	{
		//variables a usar
		$rowObject = explode(':-:',$arrObject[$a]);
		$obj_consumo = 'consumo_'.$arrObject[$a];
		$rwProcedimiento = loadrecordprocedimiento($rowObject[1],$idcon);
		//se crea el registro para ser insertado
		$iRegOppitemdesa["oppitecodigo"] = $iRegOppitemdesa["oppitecodigo"] + 1;
		$iRegOppitemdesa["ordoppcodigo"] = $iRegopp["ordoppcodigo"];
		$iRegOppitemdesa["itedescodigo"] = $rowObject[0];
		$iRegOppitemdesa["oppitecantid"] = $$obj_consumo;
		if($rwProcedimiento['tipsolcodigo'] == 3){//flexografia
			//se ingresa el resgistro en la base da datos
			$res = insrecordoppitemdesa($iRegOppitemdesa,$idcon); 
			//validacion adicional de error de consecutivo
			if($res == -2)
			{
				//consecutivo para planea item desa
				$nuidtemp = fncnumact(233,$idcon);	
				do
				{
					$nuresult = loadrecordoppitemdesa($nuidtemp,$idcon);
					if($nuresult == e_empty)
						$iRegOppitemdesa["oppitecodigo"] = $nuidtemp - 1;
						$nuidtemp ++;
				}while ($nuresult != e_empty);
				unset($nuidtemp);unset($arrObject);
				//se re asinga el nuevo indice de codigo
				$iRegOppitemdesa["oppitecodigo"] = $iRegOppitemdesa["oppitecodigo"] + 1;
				//se ingresa el registro
				$res = insrecordoppitemdesa($iRegOppitemdesa,$idcon); 
			}
		}
	}
	//se actualiza el consecutico de produc padre item
	fncnumprox(233,$iRegOppitemdesa["oppitecodigo"] + 1,$idcon); 
	//-----------------------------------------------------------
	//SE ACTUALIZAN LAS OP PERTINENTES
	//-----------------------------------------------------------
	unset($arrObject);
	if($arrop) $arrObject = explode(",",$arrop);
	for ($a = 0; $a < count($arrObject); $a++)
	{
		//variables a usar
		$obj_pistas = "pista_".$arrObject[$a];
    	//registro de a actualizar
    	$iRegop_opp["ordprocodigo"] = $arrObject[$a];
    	$iRegop_opp["opestacodigo"] = 2;//programada
    	$iRegop_opp["ordoppcodigo"] = $iRegopp["ordoppcodigo"];
    	$iRegop_opp["proceddestin"] = $proceddestin;
    	$iRegop_opp["equipocodigo"] = $equipocodigo;
    	uprecordop_opp($iRegop_opp,$idcon);
    	$iRegopflexografia_opp["ordprocodigo"] = $arrObject[$a];
    	$iRegopflexografia_opp["ordpropistap"] = $$obj_pistas;    	
    	uprecordopflexo_opp($iRegopflexografia_opp,$idcon);
	}
	
	unset($arrObject);
	if($arrvelocidadpn) $arrObject = explode(',',$arrvelocidadpn);
	for ($a = 0; $a < count($arrObject); $a++)
	{
		$iRegoppvelocidadpn["ordoppcodigo"] = $iRegopp["ordoppcodigo"];
		$iRegoppvelocidadpn["velocicodigo"] = $arrObject[$a];
		insrecordoppvelocidadpn($iRegoppvelocidadpn,$idcon);
	}
	
	unset($arrObject);
	if($arrajustepn) $arrObject = explode(",",$arrajustepn);
	for ($a = 0; $a < count($arrObject); $a++)
	{
		$iRegoppvelocidadpn["ordoppcodigo"] = $iRegopp["ordoppcodigo"];
		$iRegoppvelocidadpn["ajustecodigo"] = $arrObject[$a];
		insrecordoppajustepn($iRegoppvelocidadpn,$idcon);
	}
	//desconexion
	fncclose($idcon);
	//-----------------------------------------------------------
	//SE GENERAR LAS ORDENES DE ACUERDO CON LA RUTA
	//-----------------------------------------------------------
	include('genopp.php');
	fncmsgerror(grabaEx);	
	//se envia al maestro
	
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablbandejaflexo.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
	
}

?> 
