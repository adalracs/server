<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabapadreitem
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegpadreitem         Arreglo de datos.
$flagnuevopadreitem    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblpadreitem.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');
$paditekeylin = $arrkeylinea;
function grabapadreitem($iRegpadreitem,&$flagnuevopadreitem,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",127);
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
		$nuresult = loadrecordpadreitem($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegpadreitem[paditecodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegpadreitem)
	{
		$iRegtabla["tablnomb"] = "padreitem";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "padreitem")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegpadreitem_b = $iRegpadreitem;

		while($elementos = each($iRegpadreitem))
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
								$flagnuevopadreitem = 1;
								$flagerror = 1;
							}
						}
					}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevopadreitem = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			$validresult = consulmetapadreitem($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevopadreitem = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}

			if($elementos[0]=='paditenombre' && $elementos[1])
			{

				$validnombre =  fncnombexs('padreitem',$iRegpadreitem_b,$elementos[0],$elementos[1],$nuconn);
				if ($validnombre == 1)
				{
					fncmsgerror(errorNombExs);
					$flagnuevopadreitem = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validnombre);
				}
			}	
			
			
			if($elementos[0]=='procedcodigo' && $iRegpadreitem[paditeextrui] == 't' && !$elementos[1])
			{
				$flagnuevopadreitem = 1;
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
			$result = insrecordpadreitem($iRegpadreitem,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevopadreitem=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablpadreitem.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}

}

$iRegpadreitem[paditecodigo] = $paditecodigo;
$iRegpadreitem[paditenombre] = $paditenombre;
$iRegpadreitem[paditeextrui] = $paditeextrui;
$iRegpadreitem[paditepigmen] = $paditepigmen;
$iRegpadreitem[paditedensid] = $paditedensid;
$iRegpadreitem[paditedescri] = $paditedescri;
$iRegpadreitem[paditeconfig] = 0;
$iRegpadreitem[paditekeylin] = $paditekeylin;
$iRegpadreitem[paditelamind] = $paditelamind;
$iRegpadreitem[paditeflexo] = $paditeflexo;
$iRegpadreitem[procedcodigo] = $procedcodigo;

if($paditeextrui == 'f')
	$iRegpadreitem[procedcodigo] = "";

grabapadreitem($iRegpadreitem,$flagnuevopadreitem,$campnomb);
?> 
