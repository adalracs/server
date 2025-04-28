<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : editareportot
Decripcion      : Edita un registro de reporte de orden de trabajo.
Parametros      : Descripicion
$iRegreportot         Arreglo de datos.
$flageditarreportot    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha 	| Motivo												| Autor 	|
 08082005	 Integrar funcionalidad con las tablas transacherramie,	 jcortes	
			 transacitem, reportotherramie y reportotitem.
*/

include ( '../def/tipocampo.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
include ( '../src/FunPerPriNiv/pktbltipomovi.php');
include ( '../src/FunPerPriNiv/pktblreporotherramie.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunPerPriNiv/pktblreportot.php');
include ( 'grabatransacreportherramie.php');
include ( 'grabareporotherramie.php');
include ( 'grabatransacreportitem.php');
include ( 'grabareportotitem.php');


function editareportot($iRegreportot,&$flageditarreportot,&$campnomb,&$codigo) 
{ 
	$nuconn = fncconn(); 
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
	 
	if ($iRegreportot) 
	{ 
		$iRegtabla["tablnomb"] = "reportot";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "reportot")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegreportot))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "reportcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarreportot = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}			
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditarreportot = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetareportot($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditarreportot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if (($elementos[0] == "ordtracodigo") && ($elementos[1] == ""))
			{
				$flageditarreportot = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		 
		if($flagerror != 1) 
		{ 
			$result = uprecordreportot($iRegreportot,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarreportot=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablreportot.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegreportot[reportcodigo] = $reportcodigo; 
$iRegreportot[ordtracodigo] = $ordtracodigo;
$iRegreportot[tipmancodigo] = $tipmancodigo; 
$iRegreportot[prioricodigo] = $prioricodigo; 
$iRegreportot[tiptracodigo] = $tiptracodigo; 
$iRegreportot[tareacodigo] = $tareacodigo; 
$iRegreportot[reportfecha] = /*$reportfecha1*/date("Y-m-d"); 
$iRegreportot[reporttiedur] = $reporttiedur; 
$iRegreportot[reportdescri] = $reportdescri; 
 
editareportot($iRegreportot,$flageditarreportot,$campnomb,$codigo); 

/*********************************/
//si el registro de reportot fue grabado con exito
$arreglo_item = explode(",",$loaditem1);
$num = count($arreglo_item);
//echo "<br>num: ".$num;
if(!$flageditarreportot)
{
	//graba las transacciones de las herramientas
	$arreglo_herr = explode(",",$loadherram);
	$num = count($arreglo_herr);
	unset($idcon);
	for($i=0;$i<$num;$i++)
	{
		$idcon = fncconn();
		$arreglo_herr1 = explode("-",$arreglo_herr[$i]);
		$herramcodigo = trim($arreglo_herr1[0]);
		if($herramcodigo)
		{
			unset($sbregherramie);
			$sbregherramie = loadrecordherramie($herramcodigo,$idcon);
			if($sbregherramie>0)
			{
				$transhercanti = trim($arreglo_herr1[1]);
				$tipmovcodigo = 1;
				$transherfecha = date("Y-m-d");
				$herramvalor = $sbregherramie["herramvalor"];
				$usuacodi = $GLOBALS['usuacodi'];
				$herramdispon = $sbregherramie["herramdispon"];

				$transhertotal = $transhercanti * $herramvalor;
				$iRegtransacherramie[transhercodigo] = $transhercodigo;
				$iRegtransacherramie[tipmovcodigo] = $tipmovcodigo;
				$iRegtransacherramie[herramcodigo] = $herramcodigo;
				$iRegtransacherramie[transherfecha] = $transherfecha;
				$iRegtransacherramie[transhercanti] = $transhercanti;
				$iRegtransacherramie[transhertotal] = $transhertotal;
				$iRegtransacherramie[usuacodi] = $usuacodi;

				$iRegvalidaherramie[tipmovcodigo] = $tipmovcodigo;
				$iRegvalidaherramie[transhercanti] = $transhercanti;
				$iRegvalidaherramie[herramcodigo] 	= $herramcodigo;
				$iRegvalidaherramie[herramdispon] = $herramdispon;
				grabatransacreportherramie($iRegtransacherramie,$iRegvalidaherramie,
				$flagnuevotransacherramie,$campnomb,$arrtransher,$transhercodigo);
				if($reportcodigo && $transhercodigo)
				{
					$iRegreporotherramie[reportcodigo] = $reportcodigo;
					$iRegreporotherramie[transhercodigo] = $transhercodigo;
					grabareporotherramie($iRegreporotherramie,$flagnuevoreporotherramie,$campnomb);
				}
			}
		}
		fncclose($idcon);
	}
	
	//graba las transacciones de los items	
	$arreglo_item = explode(",",$loaditem1);
	$num = count($arreglo_item);
	unset($idcon);
	for($i=0;$i<$num;$i++)
	{
		$idcon = fncconn();
		$arreglo_item1 = explode("-",$arreglo_item[$i]);
		$itemcodigo = trim($arreglo_item1[0]);
		$cantidad = trim($arreglo_item1[1]);
		if($itemcodigo!="")
		{
			unset($sbregitem);
			$sbregitem = loadrecorditem($itemcodigo,$idcon);
			if($sbregitem>0)
			{
				$transitecanti = $cantidad;
				$tipmovcodigo = 1;
				$transitefecha = date("Y-m-d");
				$usuacodi = $GLOBALS['usuacodi'];

				//
				$transitetotal = $transitecanti * $sbregitem['itemvalor'];
				$iRegtransacitem[transitecodigo] = $transitecodigo;
				$iRegtransacitem[tipmovcodigo] = $tipmovcodigo;
				$iRegtransacitem[itemcodigo] = $itemcodigo;
				$iRegtransacitem[transitefecha] = $transitefecha;
				$iRegtransacitem[transitecantid] = $transitecanti;
				$iRegtransacitem[transitetotal] = $transitetotal;
				$iRegtransacitem[usuacodi] = $usuacodi;

				$iRegvalidaitem[itemcodigo] = $itemcodigo;
				$iRegvalidaitem[itemcanmin] = $sbregitem['itemcanmin'];
				$iRegvalidaitem[itemcanmax] = $sbregitem['itemcanmax'];
				$iRegvalidaitem[itemdispon] = $sbregitem['itemdispon'];
				grabatransacreportitem($iRegtransacitem,$iRegvalidaitem,$flagnuevotransacitem,$campnomb,
				$transitecodigo);
				if(!$flagnuevotransacitem)
				{
					$iRegreporotitem[reportcodigo] = $reportcodigo;
					$iRegreporotitem[transitecodigo] = $transitecodigo;
					grabareportotitem($iRegreporotitem,$flagnuevoreporotitem,$campnomb);
				}
			}
		}
		fncclose($idcon);
	}
	
	if($flagnuevotransacherramie || $flagnuevotransacitem)
	{
		$nuconn = fncconn();
		$nuResult = delrecordreportot($reportcodigo,$nuconn);
		$sbregnumerado = loadrecordnumerado(idreportot,$nuconn);
		$numeprox = $sbregnumerado[numeprox]-1;
		$sbregnumerado[numeprox] = $numeprox;
		$nuResultupdate = uprecordnumerado($sbregnumerado,$nuconn);
		$i = $num;
		fncclose($nuconn);
	}
}
?>
