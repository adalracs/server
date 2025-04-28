<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabanoconformemp
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegproveedo         Arreglo de datos.
$flagnuevonoconformemp    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/
include ('../src/FunPerPriNiv/pktbldocumentnoconformemp.php');
include ( '../src/FunPerPriNiv/pktblnoconformemp.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../src/FunGen/fncnombexs.php');
include ( '../def/tipocampo.php');

function grabanoconformemp(&$iRegnoconformemp,&$flagnuevonoconformemp,&$campnomb,$flagerror)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",289);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);
	define("errorNombExs",18);
	define("errorIng",35);
	
	$nuidtemp = fncnumact(id,$nuconn);
	do
	{
		$nuresult = loadrecordnoconformemp($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegnoconformemp[nocomcodigo] = $nuidtemp;
			$analiscodi=$nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	//$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	
		
	if($iRegnoconformemp)
	{
		$iRegtabla["tablnomb"] = "noconformemp";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "noconformemp")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;

		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		while($elementos = each($iRegnoconformemp))
		{

			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);

			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != 'nocomcodigo')
				{

					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{

								$campnomb[$elementos[0]] = 1;
								$flagnuevonoconformemp = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{

				$flagnuevonoconformemp = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetanoconformemp($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				
				$flagnuevonoconformemp = 1;
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

			$result = insrecordnoconformemp($iRegnoconformemp,$nuconn);
			if($result < 0 )
			{
				fncmsgerror(errorReg);
				$flagnuevonoconformemp=1;
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

$iRegnoconformemp["nocomcodigo"] = $nocomcodigo;
$iRegnoconformemp["analiscodigo"] = $analiscodigo;
$iRegnoconformemp["usuacodi1"] = $usuacodi;
$iRegnoconformemp["usuacodi2"] = $usuacodigo;
$iRegnoconformemp["nocomfecha"] = date("Y-m-d");
$iRegnoconformemp["nocomhora"] = date("H:i:s");
$iRegnoconformemp["nocomdescri"] = $nocomdescri;

grabanoconformemp($iRegnoconformemp,$flagnuevonoconformemp,$campnomb,$flagerror);

if(!$flagnuevonoconformemp){

	$idcon = fncconn();

	if($uploadocumen) $objsuploadocumen = explode("::", $uploadocumen); else unset($objsuploadocumen);
	if($uploadocumensize) $objsuploadocumensize = explode("::", $uploadocumensize); else unset($objsuploadocumensize);

	for($a = 0; $a < count($objsuploadocumen); $a++){

		$iRegdocumentnoconformemp["nocomcodigo"] = $iRegnoconformemp["nocomcodigo"];
		$iRegdocumentnoconformemp["uploadocumen"] = $objsuploadocumen[$a];
		$iRegdocumentnoconformemp["uploadocumensize"] = $objsuploadocumensize[$a];

		insrecorddocumentnoconformemp($iRegdocumentnoconformemp,$idcon);

	}

	fncconn($idcon);

	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablhistorialamp.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';


}



?> 
