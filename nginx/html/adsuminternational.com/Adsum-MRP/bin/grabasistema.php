<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabasistema
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegsistema         Arreglo de datos.
$flagnuevosistema    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabasistema($iRegsistema,&$flagnuevosistema,&$campnomb,&$sistemacamprr,&$iRegequicamper)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",8);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);
	define("errorNombExs",18);
	define("errorIng",35);
	$nuidtemp = fncnumact(	id,$nuconn);
	do
	{
		$nuresult = loadrecordsistema($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegsistema[sistemcodigo] = $nuidtemp;
			$sistemacamprr=$iRegsistema[sistemcodigo];
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	//$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);

	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegsistema)
	{
		$iRegtabla["tablnomb"] = "sistema";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "sistema")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		while($elementos = each($iRegsistema))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "sistemcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevosistema = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevosistema = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetasistema($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevosistema = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
						
			if(($elementos[0] == 'sistemnombre') && ($elementos[1] != ""))
			{
				$keyArray = array($elementos[0], "plantacodigo");
				$valueArray = array($elementos[1], $iRegsistema["plantacodigo"]);
				$validnombre =  fncnombexs('sistema',$iRegsistema,$keyArray,$valueArray,$nuconn);
				
				if ($validnombre == 1)
				{
					fncmsgerror(errorNombExs);
					$flagnuevosistema = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validnombre);
				}
			}
			//cbedoya -- Revisa si alguno de los campos esta vacio

			if($elementos[0] == "tipsiscodigo")
			{

				if($elementos[1] == "")
				{
					$flagnuevosistema = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
		}
		
		while ($element_cam = each($iRegequicamper)) {
			$validar_cam = buscacaracter($element_cam[1]);

			if($validar_cam == 1)
			{
				$flagnuevoequipo = 1;
				$flagerror = 1;
				$campnomb[$element_cam[0]] = 1;
			}
		}
		

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		
		if($flagerror != 1)
		{
			$result = insrecordsistema($iRegsistema,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$campnomb = $elementos[0];
				$flagnuevosistema=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx);
			}
			fncclose($nuconn);
		}
	}
}
$iRegsistema[sistemcodigo] = $sistemcodigo;
$iRegsistema[plantacodigo] = $plantacodigo;
$iRegsistema[sistemnombre] = $sistemnombre;
$iRegsistema[sistemdescri] = $sistemdescri;
$iRegsistema[tipsiscodigo] = $tipsiscodigo;

$arr_campers = explode(";",$arreglo_cam);

foreach ($arr_campers as $x)
{
	$arr_text = explode(":",$x);
	$iRegequicamper[$arr_text[0]] = $arr_text[1];
}

grabasistema($iRegsistema,$flagnuevosistema,$campnomb,$sistemacamprr,$iRegequicamper);

if(!$flagnuevosistema){
	if($iRegequicamper)
	  {include('grabasistemacamperequipo.php');}
}
?> 
