<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaitemdesa
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegitemdesa         Arreglo de datos.
$flagnuevoitemdesa    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblitemdesa.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabaitemdesa($iRegitemdesa,&$flagnuevoitemdesa,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",123);
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


	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegitemdesa)
	{
		$iRegtabla["tablnomb"] = "itemdesa";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "itemdesa")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegitemdesa_b = $iRegitemdesa;

		while($elementos = each($iRegitemdesa))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
//				if($elementos[0] != "itemdesacodigo")
//				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevoitemdesa = 1;
								$flagerror = 1;
							}
						}
					}
//				}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevoitemdesa = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetaitemdesa($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevoitemdesa = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			if($elementos[0]=='itedescodigo' && $elementos[1] && $validresult == 0)
			{
				$valcodi = loadrecorditemdesa($iRegitemdesa[itedescodigo], $nuconn);
		
				if($valcodi > -3)
				{
					$flagnuevoitemdesa = 1;
					$flagerror = 1;
					$campnomb[itedescodigo] = 1;
					$campnomb[err] = 'Codigo existente o invalido';
					unset ($valcodi);
				}
			}
			unset ($validresult);

			if($elementos[0]=='itedesnombre' && $elementos[1])
			{

				$validnombre =  fncnombexs('itemdesa',$iRegitemdesa_b,$elementos[0],$elementos[1],$nuconn);
				if ($validnombre == 1)
				{
					fncmsgerror(errorNombExs);
					$flagnuevoitemdesa = 1;
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
			$result = insrecorditemdesa($iRegitemdesa,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevoitemdesa=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablitemdesa.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}

}

$iRegitemdesa[itedescodigo] = $itedescodigo;
$iRegitemdesa[itedesnombre] = $itedesnombre;
$iRegitemdesa[itedesrefere] = $itedesrefere;
$iRegitemdesa[itedesdescri] = $itedesdescri;
$iRegitemdesa[tipidscodigo] = $tipidscodigo;




grabaitemdesa($iRegitemdesa,$flagnuevoitemdesa,$campnomb);
?> 
