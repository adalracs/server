<?php
/*
 -Todos los derechos reservados-
 Propiedad intelectual de Adsum (c).
 Funcion         : grabapatronestruc
 Decripcion      : Valida la data a grabar y la lleva al paquete.
 Parametros      : Descripicion
 $iRegpatronestruc         Arreglo de datos.
 $flagnuevopatronestruc    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblpatronestruc.php');
include ( '../src/FunPerPriNiv/pktblpatronestrucpadreitem.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabapatronestruc(&$iRegpatronestruc,&$flagnuevopatronestruc,&$campnomb,$arrpatronestruc)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",247);
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
		$nuresult = loadrecordpatronestruc($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegpatronestruc[patestcodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegpatronestruc)
	{
		$iRegtabla["tablnomb"] = "patronestruc";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "patronestruc")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegpatronestruc_b = $iRegpatronestruc;

		while($elementos = each($iRegpatronestruc))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				//				if($elementos[0] != "patronestruccodigo")
				//				{
				if($sbregcampo["campnomb"] == $elementos[0])
				{
					$respuesta = strcmp($sbregcampo["campnotnull"],"t");
					if($respuesta == 0)
					{
						if($elementos[1] == "")
						{
							$campnomb[$elementos[0]] = 1;
							$flagnuevopatronestruc = 1;
							$flagerror = 1;
						}
					}
				}
				//				}
			}
				
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevopatronestruc = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}

				
			$validresult = consulmetapatronestruc($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevopatronestruc = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
				
			unset ($validresult);

			if($elementos[0]=='patestnombre' && $elementos[1])
			{

				$validnombre =  fncnombexs('patronestruc',$iRegpatronestruc_b,$elementos[0],$elementos[1],$nuconn);
				if ($validnombre == 1)
				{
					fncmsgerror(errorNombExs);
					$flagnuevopatronestruc = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validnombre);
				}
			}
				
		}

		if(!$arrpatronestruc)
		{
			$flagnuevopatronestruc = 1;
			$flagerror = 1;
			$campnomb['arrpatronestruc'] = 1;
		}

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = insrecordpatronestruc($iRegpatronestruc,$nuconn);
				
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevopatronestruc=1;
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

$iRegpatronestruc[patestnombre] = $patestnombre;
$iRegpatronestruc[patestanchoi] = $patestanchoi;
$iRegpatronestruc[patestanchof] = $patestanchof;
$iRegpatronestruc[patestcalibi] = $patestcalibi;
$iRegpatronestruc[patestcalibf] = $patestcalibf;
$iRegpatronestruc[patestdescri] = $patestdescri;

grabapatronestruc($iRegpatronestruc,$flagnuevopatronestruc,$campnomb,$arrpatronestruc);

if(!$flagnuevopatronestruc)
{
	$idcon = fncconn();
	if($arrpatronestruc) $arrObjpatronestruc = explode(':|:',$arrpatronestruc);
	for( $a = 0; $a < count($arrObjpatronestruc); $a++)
	{
		$rowObjpatronestruc = explode(':-:',$arrObjpatronestruc[$a]);
		$iRegpatronestrucpadreitem[patestcodigo] = $iRegpatronestruc[patestcodigo];
		$iRegpatronestrucpadreitem[paditecodigo] = $rowObjpatronestruc[1];
		$iRegpatronestrucpadreitem[paetpaindice] = ($a+1);
		insrecordpatronestrucpadreitem($iRegpatronestrucpadreitem,$idcon);
	}	
 	fncclose($idcon);
 	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablpatronestruc.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
}
?>
