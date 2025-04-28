<?php 
/* 
<!-- Propiedad intelectual de Adsum SAS (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 20120110 
GenVers: 4.8 --> 
Funcion         : grabadevolucion 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegdevolucion         Arreglo de datos. 
    $flagnuevodevolucion    Bandera de validación 
Retorno         : 
		true	= 1 
		false	= 0 
Autor           : ariascos 
Escrito con     : WAG 
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
*/ 
  
include ( '../src/FunGen/fncnumprox.php'); 
include ( '../src/FunGen/fncnumact.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunPerPriNiv/pktbldevolucion.php'); 
include ( '../src/FunPerPriNiv/pktbldevolupedido.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
 
function grabadevolucion(&$iRegdevolucion,&$flagnuevodevolucion,&$campnomb) 
{ 
	$nuconn = fncconn(); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	define("id",122); 
	define("errorReg",1); 
	define("errorCar",2); 
	define("grabaEx",3); 
	define("compinst",4); 
	define("venccomp",5); 
	define("compactu",6); 
	define("fecvalid",7); 
	define("errormail",8); 
	define("editaEx",9); 
	$nuidtemp = fncnumact(	id,$nuconn); 
	do 
	{ 
		$nuresult = loadrecorddevolucion($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{ 
			$iRegdevolucion[devolucodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty); 
	$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 
	//	No utilice esta parte si va a utilizar la llave primaria como serial 
	if ($iRegdevolucion) 
	{
		$iRegtabla["tablnomb"] = "devolucion";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "devolucion")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegdevolucion_b = $iRegdevolucion;

		while($elementos = each($iRegdevolucion))
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
								$flagnuevodevolucion = 1;
								$flagerror = 1;
							}
						}
					}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevodevolucion = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetadevolucion($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevodevolucion = 1;
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
			$result = insrecorddevolucion($iRegdevolucion,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flagnuevodevolucion=1; 
			} 
			if($result > 0) 
			{ 
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

$iRegdevolucion[usuacodi] = $usuacodi; 
$iRegdevolucion[reclamcodigo] = $reclamcodigo; 
$iRegdevolucion[devolufecha] = $devolufecha; 
$iRegdevolucion[devolubodega] = $devolubodega; 
$iRegdevolucion[devolucondici] = $devolucondici; 
$iRegdevolucion[devoludescri] = $devoludescri;
 
grabadevolucion($iRegdevolucion,$flagnuevodevolucion,$campnomb); 

if(!$flagnuevodevolucion):

	$idcon = fncconn();
	
		if($arrpedven) $arrObject = explode(',', $arrpedven);
				$resulta = delrecorddevolupedido($iRegdevolucion['devolucodigo'],$idcon);
				for($i = 0; $i < count($arrObject); $i++):
					$objNumfac = 'devpednumfac_'.$arrObject[$i];
					$objFecfac = 'devpedfecfac_'.$arrObject[$i];
					$objDescri = 'devpeddescri_'.$arrObject[$i];
					$objAutori = 'devpedautori_'.$arrObject[$i];
					
					$iRegdevolupedido[devolucodigo] = $iRegdevolucion['devolucodigo'];
					$iRegdevolupedido[pedvencodigo] = $arrObject[$i];
					$iRegdevolupedido[devpednumfac] = $$objNumfac;
					$iRegdevolupedido[devpedfecfac] = $$objFecfac;
					$iRegdevolupedido[devpeddescri] = $$objDescri;
					$iRegdevolupedido[devpedautori] = $$objAutori;
					$resultado = insrecorddevolupedido($iRegdevolupedido,$idcon);
			endfor;	
		
			unset($arrObject);
	
	fncclose($idcon);

endif;
?> 
