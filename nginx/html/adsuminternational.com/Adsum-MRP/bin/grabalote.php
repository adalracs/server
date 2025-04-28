<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaproveedo
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iReglote         Arreglo de datos.
$flagnuevolote    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

include ( '../src/FunPerPriNiv/pktblitemdesa.php');
include ( '../src/FunPerPriNiv/pktbllote.php');
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnombexs.php');

function grabalote(&$iReglote,&$flagnuevolote,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",287);
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

	$nuidtemp = fncnumact(id,$nuconn);
	do
	{
		$nuresult = loadrecordlote($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iReglote[lotecodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	//$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iReglote)
	{
		$iRegtabla["tablnomb"] = "lote";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "lote")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);

		while($elementos = each($iReglote))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "recmercodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevolote = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevolote = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetalote($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevolote = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}

		}

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = insrecordlote($iReglote,$nuconn);
			if($result < 0 )
			{
				fncmsgerror(errorReg);
				$flagnuevolote=1;
				return false;
			}

			if($result > 0)
			{
				$nuresult1 = fncnumprox(idproveedo,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'alert("Grabacion del lote exitosa")';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}

$iReglote["lotecodigo"] = $lotecodigo;
$iReglote["lotenumero"] = $lotenumero;
$iReglote["lotefecha"] = date("Y-m-d");
$iReglote["lotehora"] = date("H:i:s");
$iReglote["usucodi"] = $usuacodi;
$iReglote["proveecodigo"] = $proveecodigo;
$iReglote["fabricodigo"] = $fabricodigo;
$iReglote["lotefecfabri"] = $lotefecfabri;
$iReglote["lotefecperio"] = $lotefecperio;

grabalote($iReglote,$flagnuevolote,$campnomb);

?> 
