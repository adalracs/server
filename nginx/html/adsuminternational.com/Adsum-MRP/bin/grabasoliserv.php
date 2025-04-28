<?php
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabasoliserv
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
    $iRegsoliserv         Arreglo de datos.
    $flagnuevosoliserv    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblsoliserv.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');

function grabasoliserv($iRegsoliserv, &$flagnuevosoliserv, &$campnomb, &$solsercodigo)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",46);
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
	define("errorSolFall",37);
	$nuidtemp = fncnumact(id,$nuconn);
	do
	{
		$nuresult = loadrecordsoliserv($nuidtemp,$nuconn);
		if($nuresult == e_empty)
			$iRegsoliserv[solsercodigo] = $nuidtemp;
		$nuidtemp ++;
		
		
	}while ($nuresult != e_empty);
	//
	$solsercodigo = $iRegsoliserv[solsercodigo];
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	if($iRegsoliserv)
	{
		$iRegtabla["tablnomb"] = "soliserv";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "soliserv")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);

		while($elementos = each($iRegsoliserv))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "solsercodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevosoliserv = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);


			$validresult = consulmetasoliserv($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevosoliserv = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}

		}

		$nuResultdb = loadrecordvalsoliserv($nuconn);
		
		$num = fncnumreg($nuResultdb);
		
		for ($i = 0; $i < $num; $i++)
		{
			$sbregtabla = fncfetch($nuResultdb ,$i);
			if(($sbregtabla[1] == $iRegsoliserv[equipocodigo])&&($sbregtabla[2]==$iRegsoliserv[tipfalcodigo])&&($sbregtabla[3]==$iRegsoliserv[solserfecha]))
			{
				fncmsgerror(errorSolFall);
				$flagnuevosoliserv = 1;
				$flagerror=1;
				break;
			}
		}
         
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = insrecordsoliserv($iRegsoliserv,$nuconn);
				if($result < 0 )
				{
					ob_end_clean();
					fncmsgerror(errorReg);
					$flagnuevosoliserv=1;
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


$idcon = fncconn();
if($filterindex  && $equipocodigocmbx)
{
	$nuresult = loadequipocodigo($equipocodigocmbx, $idcon);
	
	if($nuresult > 0)
	{	
		$equipocodigo = $nuresult[equipocodigo];
		$sistemcodigo = $nuresult[sistemcodigo];
		$plantacodigo = $nuresult[plantacodigo];
	}	
}	

$rsUsuario = loadrecordusuario($usuacodi, $idcon);


$iRegsoliserv[solsercodigo] = $solsercodigo;
$iRegsoliserv[usuacodi] 	= $usuacodi;
$iRegsoliserv[plantacodigo] = $plantacodigo;
$iRegsoliserv[sistemcodigo] = $sistemcodigo;
$iRegsoliserv[equipocodigo] = $equipocodigo;
$iRegsoliserv[tipfalcodigo] = $tipfalcodigo;
$iRegsoliserv[tiptracodigo] = $tiptracodigo;
// -- Estado por defecto: 'EN ESPERA'
$iRegsoliserv[estsolcodigo] = 1;
$iRegsoliserv[solsermotivo] = $rsUsuario['usuanombre'].' '.$rsUsuario['usuapriape'].' '.$rsUsuario['usuasegape']."--".date("Y-m-d")."--".date('H:i:s')."--".$solsermotivo."::";
$iRegsoliserv[solserfecha] = date('Y-m-d');
$iRegsoliserv[solserhora] = date('H:i:s');

if($plantacodigo == "")
{
  echo '<script language="javascript">';
  echo '<!--//'."\n";
  echo 'alert("Debe seleccionar al menos una planta")';
  echo '//-->'."\n";
  echo '</script>';
  $flagnuevosoliserv = 1;
}
else
{
  	grabasoliserv($iRegsoliserv,$flagnuevosoliserv,$campnomb,$solsercodigo);
	
  	// Realiza la impresion de la solicitud
  	if (!$flagnuevosoliserv)
  	{
  		//		 Correos
		include '../src/FunPHPMailer/mail.send.php';
		$idcon = fncconn();
		$mails = array();
		$data = array('solsercodigo' => $solsercodigo, 'usuacodi' => $usuacodi, 'solsermotivo' => $solsermotivo);
		
		send_mail('nuevasoliserv', $data, $mails);
		//Correos
  		
  		
		echo "<script language='JavaScript'>";
		echo " if (confirm('Desea imprimir la solicitud de servicio creada?'))";
		echo "		window.open('imprimir.php?codigo=".$solsercodigo."','secundaria','status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=600');";
		echo "</script>";
	}
}