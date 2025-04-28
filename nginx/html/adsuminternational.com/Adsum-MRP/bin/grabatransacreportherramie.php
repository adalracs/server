<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabatransaceportherramie
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegtransacherramie         Arreglo de datos.
$flagnuevotransacreportherramie    Bandera de validación
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versión 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha 	| Motivo																| Autor 	|
 03082005	  Usar esta funcion en la forma desde el archivo grabareportot, de tal   jcortes
			  manera que permitiera al usuario devolver las herramientas utilizadas
			  en la Orden de trabajo
*/

/*include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktbltransaction.php');
include ( '../src/FunPerPriNiv/pktbltransacherramie.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php'); */

function grabatransacreportherramie($iRegtransacherramie,$iRegvalidaherramie,&$flagnuevotransacreportherramie,
&$campnomb,&$arrtransher,&$transhercodigo)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("idtransacreportherramie",51);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);
	define("validcan",11);
	$nuidtemp = fncnumact(idtransacreportherramie,$nuconn);
	do
	{
		$nuresult = loadrecordtransacherramie($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegtransacherramie[transhercodigo] = $nuidtemp;
			$transhercodigo = $iRegtransacherramie[transhercodigo];
		}
		$nuidtemp ++;
	}
	while ($nuresult != e_empty);
	if($iRegtransacherramie)
	{
		while($elementos = each($iRegtransacherramie))
		{
			$validar = buscacaracter($elementos[1]);
			if($validar == 1)
			{
				fncmsgerror(errorCar);
				$flagnuevotransacreportherramie = 1;
				$flagerror = 1;
				$campnomb = $elementos[0];
				break;
			}
			$validresult = consulmetatransacherramie($elementos[0],$elementos[1],$nuconn);
			if ($validresult == 1)
			{
				$flagnuevotransacreportherramie = 1;
				$flagerror = 1;
				$campnomb = $elementos[0];
				unset ($validresult);
				break;
			}
			if($elementos[0] == "transhercanti" && $elementos[1] < 0)
			{
				fncmsgerror(validcan);
				$flagnuevotransacreportherramie = 1;
				$flagerror = 1;
				$campnomb = $elementos[0];
				break;
			}
		}
		if($flagerror != 1)
		{
			if($iRegtransacherramie[herramcodigo] && $iRegtransacherramie[transhercanti])
			{
				$validdispon = validadisponibilidad($iRegvalidaherramie,$iRegtransacherramie[transhercanti],
				$iRegtransacherramie[tipmovcodigo],$nuconn);
				if($validdispon > 0)
				{
					$result = insrecordtransacherramie($iRegtransacherramie,$nuconn);
					if($result < 0 )
					{
						ob_end_clean();
						fncmsgerror(errorReg);
						$flagnuevotransacreportherramie=1;
					}
					if($result > 0)
					{
						//Falta por definir su procedencia
						/*if($initransac)
						{*/
						$arrtransher[] = $iRegtransacherramie[transhercodigo];
						//}
						$nuresult1 = fncnumprox(idtransacreportherramie,$nuidtemp,$nuconn);
						//	No utilice esta parte si va a utilizar la llave primaria como serial //
						//fncmsgerror(grabaEx);
					}
				}
				else
				{
					$flagnuevotransacreportherramie = 1;
				}
			}
			else
			{
				fncmsgerror(errorReg);
				$flagnuevotransacreportherramie = 1;
			}
		}
	}
	fncclose($nuconn);
}

/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : validadisponibilidad
Decripcion      : Valida y actualiza la tabla item
Parametros      : Descripicion
$arrherramie         Arreglo de datos.
$transaccan    	 cantidad
$tipomovi		 Codigo de tipomovi

Retorno         :
true	= 1
false	= 0
Autor           : lfolaya
Fecha           : 26012005
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/
function validadisponibilidad($arrherramie,$transaccan,$tipomovi,$nuconn)
{
	$sbregtipomovi = loadrecordtipomovi($tipomovi,$nuconn);

	if($sbregtipomovi[tipmovtipo] > 0)
	{
		$sumherramie = $arrherramie[herramdispon] + $transaccan;
		if($sumherramie >= 0)
		{
			updateherramiedispon($arrherramie[herramcodigo],$sumherramie,$nuconn);
			return 1;
		}else
		{
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'alert("Cantidad no permitida")';
			echo '//-->'."\n";
			echo '</script>';
			return -1;
		}
	}
	elseif ($sbregtipomovi[tipmovtipo] < 1)
	{

		$resherramie = $arrherramie[herramdispon] - $transaccan;
		if($resherramie >= 0)
		{
			updateherramiedispon($arrherramie[herramcodigo],$resherramie,$nuconn);
			return 1;
		}else
		{
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'alert("Cantidad no permitida")';
			echo '//-->'."\n";
			echo '</script>';
			return -1;
		}
	}
}
?>