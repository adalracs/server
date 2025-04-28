<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabatarifas
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegtarifas         Arreglo de datos.
$flagnuevotarifas    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

include ( "../src/FunPerPriNiv/pktblcampo.php");
include ( "../src/FunPerPriNiv/pktbltabla.php");
include ( "../src/FunGen/buscacaracter.php");
include ( "../src/FunGen/fncmsgerror.php");
include ( "../src/FunGen/fncnombexs.php");
include ( "../src/FunGen/fncnumact.php");
include ( "../src/FunGen/fncnumprox.php");
include ( "../def/tipocampo.php");

function grabatarifa($iRegtarifa,&$flagnuevotarifa,&$campnomb){

	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",308);
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
		$nuresult = loadrecordtarifa($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{  
			$iRegtarifa["tarifacodigo"] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 

	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegtarifa)
	{
		$iRegtabla["tablnomb"] = "tarifa";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla['tablnomb'] == "tarifa")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegtarifa_b = $iRegtarifa;

		while($elementos = each($iRegtarifa))
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
							$flagnuevotarifa = 1;
							$flagerror = 1;
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevotarifa = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetatarifa($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevotarifa = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			unset ($validresult);
		}
		

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = insrecordtarifa($iRegtarifa,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevotarifa=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestabltarifa.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}

}

$iRegtarifa["tarifacodigo"] =$tarifacodigo;
$iRegtarifa["cencoscodigo"] =$cencoscodigo;
$iRegtarifa["tipsolcodigo"] =$tipsolcodigo;
$iRegtarifa["tarifames"] =$tarifames;
$iRegtarifa["tarifaano"] =$tarifaano;
$iRegtarifa["tarifamod"] =$tarifamod;
$iRegtarifa["tarifamoi"] =$tarifamoi;
$iRegtarifa["tarifacdep"] =$tarifacdep;
$iRegtarifa["tarifasdep"] =$tarifasdep;
$iRegtarifa["tarifaene"] =$tarifaene;
$iRegtarifa["tarifaman"] =$tarifaman;
$iRegtarifa["tarifaotros"] =$tarifaotros ;

grabatarifa($iRegtarifa,$flagnuevotarifa,$campnomb);

?> 
