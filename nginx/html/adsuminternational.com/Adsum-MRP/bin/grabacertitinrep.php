<?php 
ini_set('display_errors',1);
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabacertitinrep
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegcertitinrep         Arreglo de datos.
$flagnuevocertitinrep    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblcertitinrep.php');
include ( '../src/FunPerPriNiv/pktblcertitinrepformul.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabacertitinrep(&$iRegcertitinrep,&$flagnuevocertitinrep,&$campnomb,&$arritemdispe)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",134);
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
		$nuresult = loadrecordcertitinrep($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegcertitinrep[certircodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	


	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegcertitinrep)
	{
		$iRegtabla["tablnomb"] = "certitinrep";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "certitinrep")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegcertitinrep_b = $iRegcertitinrep;

		while($elementos = each($iRegcertitinrep))
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
								$flagnuevocertitinrep = 1;
								$flagerror = 1;
							}
						}
					}
			}
			
			//$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevocertitinrep = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetacertitinrep($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevocertitinrep = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
		}
		
		if(!$arritemdispe)
		{
			$flagnuevocertitinrep = 1;
			$flagerror = 1;
			$campnomb['arritemdispe'] = 1;
			unset ($arritemdispe);
		}

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = insrecordcertitinrep($iRegcertitinrep,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevocertitinrep=1;
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

$iRegcertitinrep[formulcodigo] = $formulcodigo;
$iRegcertitinrep[certirlote] = $certirlote;
$iRegcertitinrep[certirpeso] = $certirpeso;
$iRegcertitinrep[usuacodi] = $usuacodi;
$iRegcertitinrep[certirfecha] = $certirfecha;
$iRegcertitinrep[certirdescri] = $certirdescri;
$iRegcertitinrep[certirdelrec] = 1;

grabacertitinrep($iRegcertitinrep,$flagnuevocertitinrep,$campnomb,$arritemdispe);

if(!$flagnuevocertitinrep)
{
	
	$idcon = fncconn();
	
	if($arritemdispe) $arrObject = explode(':|:', $arritemdispe);
		$resulta = delrecordcertitinrepformul($iRegcertitinrep[certircodigo],$idcon);
		for($i = 0; $i < count($arrObject); $i++):
			$arr = explode(':-:',$arrObject[$i]);
			$iRegCertitinrepformul[certircodigo] = $iRegcertitinrep[certircodigo];
			$iRegCertitinrepformul[itedescodigo] = $arr[0];
			$iRegCertitinrepformul[cerforcantid] = $arr[1];
			$iRegCertitinrepformul[cerforlote] = $arr[2];
			$resultado = insrecordcertitinrepformul($iRegCertitinrepformul,$idcon);
		endfor;	
		
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablcertitinrep.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';	
	
	fncclose($idcon);
}

?> 
