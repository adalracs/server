<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabacierreoe
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegcierreoe         Arreglo de datos.
$flagnuevocierreoe    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

include_once ( '../src/FunGen/fncnumprox.php');
include_once ( '../src/FunGen/fncnumact.php');
include_once ( '../def/tipocampo.php');
include_once ( '../src/FunPerPriNiv/pktblreporteopp.php');
include_once ( '../src/FunPerPriNiv/pktbllistaempaque.php');
include_once ( '../src/FunPerPriNiv/pktblcampo.php');
include_once ( '../src/FunPerPriNiv/pktbltabla.php');
include_once ( '../src/FunGen/buscacaracter.php');
include_once ( '../src/FunGen/fncmsgerror.php');
include_once( '../src/FunGen/fncnombexs.php');

function grabacierrelistaempaque(&$iRegcierrelistaempaque,&$flagnuevocierrelistaempaque,&$campnomb,$lisempestacodigo)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",268);
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
		$nuresult = loadrecordcierrelistaempaque($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegcierrelistaempaque[cielemcodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegcierrelistaempaque)
	{
		$iRegtabla["tablnomb"] = "cierrelistaempaque";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "cierrelistaempaque")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegcierrelistaempaque_b = $iRegcierrelistaempaque;

		while($elementos = each($iRegcierrelistaempaque))
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
							$flagnuevocierrelistaempaque = 1;
							$flagerror = 1;
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevocierrelistaempaque = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			$validresult = consulmetacierrelistaempaque($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevocierrelistaempaque = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			if($elementos[0]=='cielemcodigo' && $elementos[1] && $validresult == 0)
			{
				$valcodi = loadrecordcierrelistaempaque($iRegcierrelistaempaque[cielemcodigo], $nuconn);
		
				if($valcodi > -3)
				{
					$flagnuevocierrelistaempaque = 1;
					$flagerror = 1;
					$campnomb[cielemcodigo] = 1;
					$campnomb[err] = 'Codigo existente o invalido';
					unset ($valcodi);
				}
			}
			unset ($validresult);
		}
        
		if(!$lisempestacodigo)
		{
			$flagnuevocierrelistaempaque = 1;
			$flagerror = 1;
			$campnomb['lisempestacodigo'] = 1;
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		

		if($flagerror != 1)
		{
			$result = insrecordcierrelistaempaque($iRegcierrelistaempaque,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevocierrelistaempaque=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				$iReglistaempaque['lisempcodigo'] = $iRegcierrelistaempaque['lisempcodigo'];
    			$iReglistaempaque['lisempestacodigo'] = $lisempestacodigo;
    			$iReglistaempaque['usuacodigo'] = $iRegcierrelistaempaque['usuacodi'];
    			$iReglistaempaque['lisempfecfin'] = $iRegcierrelistaempaque['cielisfecha'];
    			$iReglistaempaque['lisemphorfin'] = $iRegcierrelistaempaque['cielishora'];
    			//var_dump($iReglistaempaque);die;
    			uprecordlistaempaque2($iReglistaempaque,$nuconn);
    			fncmsgerror(grabaEx);
			}
			fncclose($nuconn);
		}
	}
}

$iRegcierrelistaempaque[cielemcodigo] = $cielemcodigo;
$iRegcierrelistaempaque[lisempcodigo] = $lisempcodigo;
$iRegcierrelistaempaque[cielisfecha] = date('Y-m-d');
$rwhora = getdate(time());
$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
$iRegcierrelistaempaque[cielishora] = $hora;
$iRegcierrelistaempaque[usuacodi] = $usuacodi;
$iRegcierrelistaempaque[cielisdescri] = $cielisdescri;
$iRegcierrelistaempaque[cielistipo] = 1;//gestion

grabacierrelistaempaque($iRegcierrelistaempaque,$flagnuevocierrelistaempaque,$campnomb,$lisempestacodigo);

if(!$flagnuevocierrelistaempaque)
{
	$idcon = fncconn();
	
	if($lisempestacodigo > 2)
	{
		if($arrlistaempaque) $arrObjslistaempaque = explode(',',$arrlistaempaque);
		
		for( $a = 0; $a < count($arrObjslistaempaque); $a++)
		{
			$rwReporteoppreportepn = loadrecordreporteoppreportepn($arrObjslistaempaque[$a],$idcon);
			uprecordreporteopp1(array('repoppcodigo' => $rwReporteoppreportepn['repoppcodigo'], 'roestacodigo' => 4/*estado Entregado*/),$idcon);
		}
	}
	else
	{
		if($arrlistaempaque) $arrObjslistaempaque = explode(',',$arrlistaempaque);
		
		for( $a = 0; $a < count($arrObjslistaempaque); $a++)
		{
			$rwReporteoppreportepn = loadrecordreporteoppreportepn($arrObjslistaempaque[$a],$idcon);
			uprecordreporteopp1(array('repoppcodigo' => $rwReporteoppreportepn['repoppcodigo'], 'roestacodigo' => 7/*estado Despachado*/),$idcon);
		}
	}
	
	fncclose($idcon);
	
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablcierrelistaempaque.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
}

?>