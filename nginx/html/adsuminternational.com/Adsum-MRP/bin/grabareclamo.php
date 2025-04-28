<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabareclamo
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegreclamo         Arreglo de datos.
$flagnuevoreclamo    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblreclamo.php');
include ( '../src/FunPerPriNiv/pktblreclampedido.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabareclamo(&$iRegreclamo,&$flagnuevoreclamo,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",121);
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
		$nuresult = loadrecordreclamo($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegreclamo[reclamcodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);


	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iRegreclamo)
	{
		$iRegtabla["tablnomb"] = "reclamo";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "reclamo")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegreclamo_b = $iRegreclamo;

		while($elementos = each($iRegreclamo))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
//				if($elementos[0] != "reclamocodigo")
//				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevoreclamo = 1;
								$flagerror = 1;
							}
						}
					}
//				}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevoreclamo = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetareclamo($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevoreclamo = 1;
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
			$result = insrecordreclamo($iRegreclamo,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevoreclamo=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablreclamo.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}

}

$iRegreclamo[servicicodigo] = $servicicodigo; 
$iRegreclamo[reclamfecrec] = $reclamfecrec; 
$iRegreclamo[reclamfecrad] = $reclamfecrad; 
$iRegreclamo[reclamnit] = $reclamnit; 
$iRegreclamo[reclamclinom] = $reclamclinom; 
$iRegreclamo[usuacodi] = $usuacodi; 
$iRegreclamo[reclamnomcon] = $reclamnomcon; 
$iRegreclamo[reclamcargo] = $reclamcargo; 
$iRegreclamo[ciudadcodigo] = $ciudadcodigo; 
$iRegreclamo[reclamtelefono] = $reclamtelefono; 
$iRegreclamo[reclammail] = $reclammail; 
$iRegreclamo[reclamdescri] = $reclamdescri; 
$iRegreclamo[acuercodigo] = $acuercodigo; 
$iRegreclamo[reclamotros] = $reclamotros;


grabareclamo($iRegreclamo,$flagnuevoreclamo,$campnomb);

if(!$flagnuevoreclamo):

	$idcon = fncconn();
	
		if($arrpedven) $arrObject = explode(',', $arrpedven);
				$resulta = delrecordreclampedido($iRegreclamo['reclamcodigo'],$idcon);
				for($i = 0; $i < count($arrObject); $i++):
					$objRecPR = 'recpectiprecpr_'.$arrObject[$i];
					$objRecAS = 'recpectiprecas_'.$arrObject[$i];
					$objRecEL = 'recpectiprecel_'.$arrObject[$i];
					$objDevolucion = 'recpeddevolu_'.$arrObject[$i];
					$objCantid = 'recpedcantid_'.$arrObject[$i];
					$objDescri = 'recpeddescri_'.$arrObject[$i];
					$iRegreclampedido[reclamcodigo] = $iRegreclamo['reclamcodigo'];
					$iRegreclampedido[pedvencodigo] = $arrObject[$i];
					$iRegreclampedido[recpeddevolu] = $$objDevolucion;
					$iRegreclampedido[recpedcantid] = $$objCantid;
					$iRegreclampedido[recpeddescri] = $$objDescri;
					
					/*
					 * se crea array de codigos de tipos de reclamo 
					 */
					
					if($$objRecPR > 0){$recpedtiprec = '1';}
					if($$objRecAS > 0){ $recpedtiprec = ($recpedtiprec)? $recpedtiprec .',2' : '2';}
					if($$objRecEL > 0){ $recpedtiprec = ($recpedtiprec)? $recpedtiprec.',3' : '3';}
					
					$iRegreclampedido[recpedtiprec] = $recpedtiprec;
					$resultado = insrecordreclampedido($iRegreclampedido,$idcon);
					unset($recpectiprec);
			endfor;	
		
			unset($arrObject);
	
	fncclose($idcon);

endif;
?> 
