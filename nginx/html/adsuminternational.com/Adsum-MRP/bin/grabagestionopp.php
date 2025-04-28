<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabagestionopp
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iReggestionopp         Arreglo de datos.
$flagnuevogestionopp    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

include ( "../src/FunGen/fncnumprox.php");
include ( "../src/FunGen/fncnumact.php");
include ( "../def/tipocampo.php");
include ( "../src/FunPerPriNiv/pktblcampo.php");
include ( "../src/FunPerPriNiv/pktbltabla.php");
include ( "../src/FunGen/buscacaracter.php");
include ( "../src/FunGen/fncmsgerror.php");
include ( "../src/FunGen/fncnombexs.php");

function grabagestionopp(&$iReggestionopp,&$flagnuevogestionopp,&$campnomb,$flagerror,$arritem)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",234);
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
		$nuresult = loadrecordgestionopp($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iReggestionopp["gesoppcodigo"] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);

	//	No utilice esta parte si va a utilizar la llave primaria como serial

	if($iReggestionopp){

		$iRegtabla["tablnomb"] = "gestionopp";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla["tablnomb"] == "gestionopp")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iReggestionopp_b = $iReggestionopp;

		while($elementos = each($iReggestionopp)){

			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0){

				$sbregcampo = fncfetch($resultcampo,0);
				if($sbregcampo["campnomb"] == $elementos[0]){

					$respuesta = strcmp($sbregcampo["campnotnull"],"t");
					if($respuesta == 0){

						if($elementos[1] == ""){

							$campnomb[$elementos[0]] = 1;
							$flagnuevogestionopp = 1;
							$flagerror = 1;
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1){

				$flagnuevogestionopp = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetagestionopp($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1){

				$flagnuevogestionopp = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			if($elementos[0]=='gesoppcodigo' && $elementos[1] && $validresult == 0){

				$valcodi = loadrecordgestionopp($iReggestionopp["gesoppcodigo"], $nuconn);
		
				if($valcodi > -3){

					$flagnuevogestionopp = 1;
					$flagerror = 1;
					$campnomb["gesoppcodigo"] = 1;
					$campnomb["err"] = 'Codigo existente o invalido';
					unset ($valcodi);
				}

			}
			
			
			if($elementos[0]=='opestacodigo' && $elementos[1]){

				$rwOpestado = loadrecordopestado($elementos[1],$nuconn);
				if($rwOpestado['opestatipo'] == 3 && !$arritem){

					$flagnuevogestionopp = 1;
					$flagerror = 1;
					$campnomb["err"] = 'Favor Ingresar Materiales a Asignar.';

					echo '<script language= "javascript">';
					echo '<!--//'."\n";
					echo 'alert("Favor Ingresar Materiales a Asignar.")';
					echo '//-->'."\n";
					echo '</script>';

					unset ($rwOpestado);
				}
			}
			unset ($validresult);
			
		}
		

		if($flagerror == 1){

			fncmsgerror(errorIng);
			$flagnuevogestionopp = 1;
		}

		if($flagerror != 1){

			$result = insrecordgestionopp($iReggestionopp,$nuconn);
			
			if($result < 0 ){

				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevogestionopp=1;
			}

			if($result > 0){

				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //

    			$iRegop_opp["opestacodigo"] = $iReggestionopp["opestacodigo"];
    			$iRegop_opp["ordoppcodigo"] = $iReggestionopp["ordoppcodigo"];
    			uprecordop_estado($iRegop_opp,$nuconn);

    			fncmsgerror(grabaEx);
			}

			fncclose($nuconn);

		}

	}

}

$iReggestionopp["gesoppcodigo"] = $gesoppcodigo;
$iReggestionopp["ordoppcodigo"] = $ordoppcodigo;
$iReggestionopp["opestacodigo"] = $opestacodigo;
$iReggestionopp["gesoppfecha"] = date('Y-m-d');
$rwhora = getdate(time());
$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
$iReggestionopp["gesopphora"] = $hora;
$iReggestionopp["usuacodi"] = $usuacodi;
$iReggestionopp["gesoppdescri"] = $gesoppdescri;
$iReggestionopp["gesopptipo"] = 1;//gestion

$idcon = fncconn();

if($arritem) $arrObject = explode(":|:",$arritem);

for( $a = 0; $a < count($arrObject); $a++){

	$rowObject = explode(":-:",$arrObject[$a]);
	$rwItemdesa = loadrecorditemdesa($rowObject[0],$idcon);
	$rwPadreitem = loadrecordpadreitemxkeylinea($rwItemdesa["keylinea"],$idcon);
	$obj_consumo = "consumo_".$arrObject[$a];
	$obj_itedescodigoid = "itedescodigoid_".$arrObject[$a];


	if($rowObject[1] == "t"){

		if(validaint4($$obj_itedescodigoid) > 0 || (!$$obj_itedescodigoid) )
		{
		 	$flagnuevogestionopp = 1;	
	 		$flagerror = 1;
	 		$campnomb[$obj_itedescodigoid] = 1;
		}

	}
	
	if($rowObject[1] == "f"){

		if($rwPadreitem["paditedensid"] > 0 && $$obj_consumo > 0){
			$gesoppcantmt = ( $$obj_consumo / ($rwItemdesa["itedesancho"] * $rwItemdesa["itedescalib"] * $rwPadreitem["paditedensid"]) ) * 1000000 ;
		}else{
			$gesoppcantmt = "undefined-";
		}

		if(validafloat4($$obj_consumo) > 0 || (!$$obj_consumo) )
		{
		 	$flagnuevogestionopp = 1;	
	 		$flagerror = 1;
	 		$campnomb[$obj_consumo] = 1;
		}

		if(validafloat4($gesoppcantmt) > 0 || (!$gesoppcantmt) )
		{
		 	$flagnuevogestionopp = 1;	
	 		$flagerror = 1;
	 		$campnomb[$obj_consumo] = 1;
		}
		
	}

}

fncclose($idcon);

grabagestionopp($iReggestionopp,$flagnuevogestionopp,$campnomb,$flagerror,$arritem);

if(!$flagnuevogestionopp){

	$idcon = fncconn();

	if($arritem1) $arrObject = explode(":|:",$arritem1);

	for( $a = 0; $a < count($arrObject); $a++){

		$rowObject = explode(":-:",$arrObject[$a]);

		if($rowObject[1] == "t"){

			$rwEstadoSaldo = loadrecordestadosaldoxtipoestado(1,$idcon);//disponible
			$iRegsaldo["saldocodigo"] = $rowObject[2];
			$iRegsaldo["estsalcodigo"] = $rwEstadoSaldo["estsalcodigo"];
			uprecordsaldo($iRegsaldo,$idcon);
		}

	}
	unset($arrObject);
	

	if($arritem) $arrObject = explode(":|:",$arritem);

	for( $a = 0; $a < count($arrObject); $a++){

		$rowObject = explode(":-:",$arrObject[$a]);
		$obj_consumo = "consumo_".$arrObject[$a];
		$obj_itedescodigoid = "itedescodigoid_".$arrObject[$a];
		
		if($rowObject[1] == "t"){

			$iReggestionoppsaldo["gesoppcodigo"] = $iReggestionopp["gesoppcodigo"];
			$iReggestionoppsaldo["saldocodigo"] = $rowObject[2];
			$iReggestionoppsaldo["itedescodigoid"] = $$obj_itedescodigoid;
			insrecordgestionoppsaldo($iReggestionoppsaldo,$idcon);

			$rwEstadoSaldo = loadrecordestadosaldoxtipoestado(2,$idcon);//comprometido
			$iRegsaldo["saldocodigo"] = $rowObject[2];
			$iRegsaldo["estsalcodigo"] = $rwEstadoSaldo["estsalcodigo"];
			uprecordsaldo($iRegsaldo,$idcon);
		}
		
		if($rowObject[1] == "f" && $$obj_consumo > 0){

			$rwItemdesa = loadrecorditemdesa($rowObject[0],$idcon);
			$rwPadreitem = loadrecordpadreitemxkeylinea($rwItemdesa["keylinea"],$idcon);
			$gesoppcantmt = ( $$obj_consumo / ($rwItemdesa["itedesancho"] * $rwItemdesa["itedescalib"] * $rwPadreitem["paditedensid"]) ) * 1000000 ;
			$iReggestionoppitemdesa["gesoppcodigo"] = $iReggestionopp["gesoppcodigo"];
			$iReggestionoppitemdesa["itedescodigo"] = $rowObject[0];
			$iReggestionoppitemdesa["gesoppcantkg"] = $$obj_consumo;
			$iReggestionoppitemdesa["gesoppcantmt"] = $gesoppcantmt;

			$respuesta = insrecordgestionoppitemdesa($iReggestionoppitemdesa,$idcon);
		}

	}

 	fncclose($idcon);

 	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablgestionopp.php?codigo='.$codigo.'&tipsolcodigo='.$tipsolcodigo.'&sourcetable=gestionopp"';
	echo '//-->'."\n";
	echo '</script>';

}

?> 

