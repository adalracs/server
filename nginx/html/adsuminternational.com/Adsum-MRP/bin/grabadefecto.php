<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabadefecto
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegdefecto         Arreglo de datos.
$flagnuevodefecto    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/


include ( '../src/FunPerPriNiv/pktbldefectocausa.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include( '../src/FunGen/fncnombexs.php');
include ( '../def/tipocampo.php');

function grabadefecto(&$iRegdefecto,&$flagnuevodefecto,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",279);
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
		$nuresult = loadrecorddefecto($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegdefecto[defectcodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);


	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegdefecto)
	{
		$iRegtabla["tablnomb"] = "defecto";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "defecto")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegdefecto_b = $iRegdefecto;

		while($elementos = each($iRegdefecto))
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
								$flagnuevodefecto = 1;
								$flagerror = 1;
							}
						}
					}
			}
			
			$validar = buscacaracter($elementos[1]);
			

			if($validar == 1)
			{
				$flagnuevodefecto = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetadefecto($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevodefecto = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			

			if($elementos[0]=='defecto' && $elementos[1])
			{

				$validnombre =  fncnombexs('defecto',$iRegdefecto_b,$elementos[0],$elementos[1],$nuconn);
				if ($validnombre == 1)
				{
					fncmsgerror(errorNombExs);
					$flagnuevodefecto = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validnombre);
				}
			}

		}

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = insrecorddefecto($iRegdefecto,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevodefecto=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestabldefecto.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}

}

$iRegdefecto["defectnombre"] = $defectnombre;
$iRegdefecto["defectdescri"] = $defectdescri;

if( !$arrcausas ){
	
	$flagerror = 1;
	$campnomb["arrcausas"] = 1;
	$flagnuevodefecto = 1;

}

grabadefecto($iRegdefecto,$flagnuevodefecto,$campnomb);

if(!$flagnuevodefecto){

	$idcon = fncconn();

	if($arrcausas) $objsarrcausas = explode(",", $arrcausas); else unset($arrcausas);

	for($a = 0; $a < count($objsarrcausas); $a++){

		$iRegdefectocausa["defectcodigo"] = $iRegdefecto["defectcodigo"];
		$iRegdefectocausa["causacodigo"] = $objsarrcausas[$a];

		insrecorddefectocausa($iRegdefectocausa, $idcon);

	}

	fncclose($idcon);

}

?> 
