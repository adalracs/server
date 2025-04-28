<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabacausa
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegcausa         Arreglo de datos.
$flagnuevocausa    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabacausa($iRegcausa,&$flagnuevocausa,&$campnomb, $flagerror)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",280);
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
		$nuresult = loadrecordcausa($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegcausa[causacodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);


	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegcausa)
	{
		$iRegtabla["tablnomb"] = "causa";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "causa")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegcausa_b = $iRegcausa;

		while($elementos = each($iRegcausa))
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
								$flagnuevocausa = 1;
								$flagerror = 1;
							}
						}
					}
			}
			
			$validar = buscacaracter($elementos[1]);
			

			if($validar == 1)
			{
				$flagnuevocausa = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetacausa($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevocausa = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			

			if($elementos[0]=='causa' && $elementos[1])
			{

				$validnombre =  fncnombexs('causa',$iRegcausa_b,$elementos[0],$elementos[1],$nuconn);
				if ($validnombre == 1)
				{
					fncmsgerror(errorNombExs);
					$flagnuevocausa = 1;
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
			$result = insrecordcausa($iRegcausa,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevocausa=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablcausa.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}

}

$iRegcausa["causacodigo"] = $causacodigo;
$iRegcausa["causanombre"] = $causanombre;
$iRegcausa["causadescri"] = $causadescri;

grabacausa($iRegcausa,$flagnuevocausa,$campnomb, $flagerror);
?> 
