
<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaanalisismp
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegproveedo         Arreglo de datos.
$flagnuevoanalisismp    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblmpvaranalisis.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabaanalisismp(&$iReganalisismp,&$flagnuevoanalisismp,&$campnomb,$flagerror)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",282);
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
		$nuresult = loadrecordanalisismp($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iReganalisismp[analiscodigo] = $nuidtemp;
			$analiscodi=$nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	//$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	
		
	if($iReganalisismp)
	{
		$iRegtabla["tablnomb"] = "analisismp";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "analisismp")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;

		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		while($elementos = each($iReganalisismp))
		{

			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);

			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != 'analiscodigo')
				{

					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{

								$campnomb[$elementos[0]] = 1;
								$flagnuevoanalisismp = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{

				$flagnuevoanalisismp = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetaanalisismp($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				
				$flagnuevoanalisismp = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}

			if($elementos[0] == 'itedescodigo' && $elementos[1] == null)
			{
				$flagnuevoanalisismp = 1;
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

			$result = insrecordanalisismp($iReganalisismp,$nuconn);
			if($result < 0 )
			{
				fncmsgerror(errorReg);
				$flagnuevoanalisismp=1;
			}

			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablanalisismp.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);

		}
		
	}
}

$idcon = fncconn();

if($estanacodigo > 0){

	$rwAnalisisMp = loadrecordestadoanalisis($estanacodigo,$idcon);
	$tipestcodigo = $rwAnalisisMp["tipestcodigo"];

	if( $tipestcodigo == 1){

		$analiscantap = 0;
		$analiscantre = 0;

	}else{

		if( ( validafloat4($analiscantap) > 0 || !$analiscantap ) && $analiscantap != "0" ){
			$campnomb["analiscantap"] = 1;
			$flagnuevoanalisismp = 1;
			$flagerror = 1;
		}

		if( ( validafloat4($analiscantre) > 0 || !$analiscantre ) && $analiscantre != "0" ){
			$campnomb["analiscantre"] = 1;
			$flagnuevoanalisismp = 1;
			$flagerror = 1;
		}

	}


}

if($itedescodigo)
{		
	$rwItemDesa = loadrecorditemdesa($itedescodigo,$idcon);

	if($rwItemDesa["tipitemcodigo"] > 0){
		$iReganalisismp["tipitemcodigo"] = $rwItemDesa["tipitemcodigo"];
		$rsVarAnalisis = dinamicscanopvaranalisis(array("tipitemcodigo" => $rwItemDesa["tipitemcodigo"]),array("tipitemcodigo" => "="),$idcon);
	}

	if($rsVarAnalisis){
		$nrVarAnalisis = fncnumreg($rsVarAnalisis);
	}

}

if($nrVarAnalisis > 0){	

	for($a = 0; $a < $nrVarAnalisis; $a++){

		$rwVarAnalisis = fncfetch($rsVarAnalisis, $a);
		$varValor = 'txtvalor'.$rwVarAnalisis['varanacodigo'];
		
		if( validafloat4($$varValor) > 0 || !$$varValor){

			$campnomb[$varValor] = 1;
			$flagnuevoanalisismp = 1;
			$flagerror = 1;
		}

		if($rwVarAnalisis["varanatipespe"] == 1){

			//ingresar codigo para validar con porcentaje

		}else if($rwVarAnalisis["varanatipespe"] == 2){//mayor igual

			if( $$varValor < $rwVarAnalisis["varanadetesp"] ){

				$campnombre[$varValor] = 1;
			}
			
		}else if($rwVarAnalisis["varanatipespe"] == 3){//menor igual

			if( $$varValor > $rwVarAnalisis["varanadetesp"] ){

				$campnombre[$varValor] = 1;
			}

		}else if($rwVarAnalisis["varanatipespe"] == 4){//binaria 1/0

			if( $$varValor != 1){
				$campnombre[$varValor] = 1;
			}

			if( $$varValor != 0 || $$varValor != 1){

				$campnomb[$varValor] = 1;
				$flagnuevoanalisismp = 1;
				$flagerror = 1;
			}

		}

	}

}else{
	$flagnuevoanalisismp = 1;
	$flagerror = 1;
}

fncclose($idcon);

$iReganalisismp["analiscodigo"] = $analiscodigo;
$iReganalisismp["lotecodigo"] = $lotecodigo;
$iReganalisismp["itedescodigo"] = $itedescodigo;
$iReganalisismp["usuacodi"] = $usuacodi;
$iReganalisismp["analisfecha"] = date("Y-m-d");
$iReganalisismp["estanacodigo"] = $estanacodigo;
$iReganalisismp["analisdescri"] = $analisdescri;
$iReganalisismp["analisestado"] = 1;//analisis abierto
$iReganalisismp["analistipo"] = ($analistipo == 1)? 1 : 0 ;
$iReganalisismp["analiscantap"] = $analiscantap;
$iReganalisismp["analiscantre"] = $analiscantre;

grabaanalisismp($iReganalisismp,$flagnuevoanalisismp,$campnomb,$flagerror);

if(!$flagnuevoanalisismp)
{
	$idcon = fncconn();

	if($nrVarAnalisis){
		delrecordmpvaranalisispp($iReganalisismp["analiscodigo"],$idcon);
	}

	for($a = 0; $a < $nrVarAnalisis;$a++){

		$rwVarAnalisis = fncfetch($rsVarAnalisis, $a);
		$varValor = 'txtvalor'.$rwVarAnalisis['varanacodigo'];

		$nuidtemp = fncnumact(283,$idcon);
		do
		{
			$nuresult = loadrecordmpvaranalisis($nuidtemp,$idcon);
			if($nuresult == e_empty){
				$iRegmpvaranalisis["mpvaracodigo"] = $nuidtemp;
			}
			$nuidtemp ++;
		}while ($nuresult != e_empty);

		$iRegmpvaranalisis["analiscodigo"] = $iReganalisismp["analiscodigo"];
		$iRegmpvaranalisis["varanacodigo"] = $rwVarAnalisis["varanacodigo"];
		$iRegmpvaranalisis["usuacodi"] = $usuacodi;
		$iRegmpvaranalisis["mpvaravalor"] =  $$varValor;
		$iRegmpvaranalisis["mpvarafecha"] = date("Y-m-d");

		if( insrecordmpvaranalisis($iRegmpvaranalisis,$idcon) > 0  ){
			fncnumprox(283,$nuidtemp,$idcon);
		}

	}

	fncclose($idcon);

}

		
?> 
