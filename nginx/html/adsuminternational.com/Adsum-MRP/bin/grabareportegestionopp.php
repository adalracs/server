<?php 
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabagestionopp
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iReggestionopp         Arreglo de datos.
$flagnuevoreportegestionopp    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

include ( '../src/FunPerPriNiv/pktblestadosaldo.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnumprox.php');
include( '../src/FunGen/fncnombexs.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');

function grabareportegestionopp(&$iReggestionopp,&$flagnuevoreportegestionopp,&$campnomb,$arrbobina,$flagerror)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",214);
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

	if($iReggestionopp)
	{
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

		while($elementos = each($iReggestionopp))
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
							$flagnuevoreportegestionopp = 1;
							$flagerror = 1;
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevoreportegestionopp = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;

			}
		
			
			$validresult = consulmetagestionopp($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevoreportegestionopp = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			
			if($elementos[0]=='opestacodigo' && $elementos[1])
			{
				if(!$arrbobina)
				{
					$flagnuevoreportegestionopp = 1;
					$flagerror = 1;
					$campnomb[err] = 'Favor Ingresar Materiales a Asignar.';
					echo '<script language= "javascript">';
					echo '<!--//'."\n";
					echo 'alert("Favor Ingresar Materiales a Asignar.")';
					echo '//-->'."\n";
					echo '</script>';
				}
			}
			unset ($validresult);
			
		}
		

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = insrecordgestionopp($iReggestionopp,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevoreportegestionopp=1;
			}
			if($result > 0)
			{
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
$iReggestionopp["opestacodigo"] = $opestacodigo1;
$iReggestionopp["gesoppfecha"] = date('Y-m-d');
$rwhora = getdate(time());
$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
$iReggestionopp["gesopphora"] = $hora;
$iReggestionopp["usuacodi"] = $usuacodi;
$iReggestionopp["gesoppdescri"] = $gesoppdescri;
$iReggestionopp["gesopptipo"] = 2;//gestion de reporte

$idcon = fncconn();

if($arrbobina) $arrObject = explode(":|:",$arrbobina); else unset($arrObject);

for($a = 0;$a< count($arrObject);$a++){
	$rowObject = explode(":-:",$arrObject[$a]);
	$obj_consumo = "consumokg_".$arrObject[$a];
	$obj_lote = "nolote_".$arrObject[$a];
	$rwItemdesa = loadrecorditemdesa($rowObject[0],$idcon);
	$rwPadreitem = loadrecordpadreitemxkeylinea($rwItemdesa['keylinea'],$idcon);

	if($rowObject[1] == "f"){

		if($rwPadreitem['paditedensid'] > 0 && $$obj_consumo > 0){
			$gesoppcantmt = ( $$obj_consumo / ($rwItemdesa['itedesancho'] * $rwItemdesa['itedescalib'] * $rwPadreitem['paditedensid']) ) * 1000000 ;
		}else{
			$gesoppcantmt = 'undefined-';
		}				

		if(validafloat4($$obj_consumo) > 0 || (!$$obj_consumo) )
		{
		 	$flagnuevoreportegestionopp = 1;	
	 		$flagerror = 1;
	 		$campnomb[$obj_consumo] = 1;
		}

		if(validafloat4($gesoppcantmt) > 0 || (!$gesoppcantmt) )
		{
		 	$flagnuevoreportegestionopp = 1;	
	 		$flagerror = 1;
	 		$campnomb[$obj_consumo] = 1;
		}

		if(validaint4($$obj_lote) > 0 || (!$$obj_lote) )
		{
		 	$flagnuevoreportegestionopp = 1;	
	 		$flagerror = 1;
	 		$campnomb[$obj_lote] = 1;
		}
		
	}


}

fncclose($idcon);

grabareportegestionopp($iReggestionopp,$flagnuevoreportegestionopp,$campnomb,$arrbobina,$flagerror);

if(!$flagnuevoreportegestionopp)
{
	$idcon = fncconn();
	
	if($arrbobina) $arrObject = explode(":|:",$arrbobina); else unset($arrObject);

	$gesoppnorollo = 0;

	for( $a = 0; $a < count($arrObject); $a++)
	{
		$rowObject = explode(':-:',$arrObject[$a]);
		$obj_consumo = 'consumokg_'.$arrObject[$a];
		$obj_lote = "nolote_".$arrObject[$a];

		if($rowObject[1] == "t"){

			$nuidtemp = fncnumact(298,$idcon);	
			do
			{
				$nuresult = loadrecordgestionoppreporte($nuidtemp,$idcon);
				if($nuresult == e_empty)
					$iReggestionoppreportesaldo["geoprecodigo"] = $nuidtemp;
				$nuidtemp ++;
			}while ($nuresult != e_empty);
			unset($nuidtemp);

			$iReggestionoppreportesaldo["gesoppcodigo"] = $iReggestionopp["gesoppcodigo"];
			$iReggestionoppreportesaldo["saldocodigo"] = $rowObject[2];
			$iReggestionoppreportesaldo["geopreestado"] = 0;//estado inicial

			if( insrecordgestionoppreportesaldo($iReggestionoppreportesaldo,$idcon) ){
				$nuresult1 = fncnumprox(298,$iReggestionoppreportesaldo["geoprecodigo"] + 1,$idcon);

				$rwEstadoSaldo = loadrecordestadosaldoxtipoestado(4,$idcon);//Entregado
				$iRegsaldo["saldocodigo"] = $rowObject[2];
				$iRegsaldo["estsalcodigo"] = $rwEstadoSaldo["estsalcodigo"];
				uprecordsaldo($iRegsaldo,$idcon);
			}

		}

		if($rowObject[1] == "f" && $$obj_consumo > 0){		

			$gesoppnorollo++;
			$nuidtemp = fncnumact(238,$idcon);	
			do
			{
				$nuresult = loadrecordgestionoppreporte($nuidtemp,$idcon);
				if($nuresult == e_empty)
					$iReggestionoppreporte["geoprecodigo"] = $nuidtemp;
				$nuidtemp ++;
			}while ($nuresult != e_empty);
			unset($nuidtemp);

			$rwItemdesa = loadrecorditemdesa($rowObject[0],$idcon);
			$rwPadreitem = loadrecordpadreitemxkeylinea($rwItemdesa["keylinea"],$idcon);
			$gesoppcantmt = ( $$obj_consumo / ($rwItemdesa["itedesancho"] * $rwItemdesa["itedescalib"] * $rwPadreitem["paditedensid"]) ) * 1000000 ;

			$iReggestionoppreporte["gesoppcodigo"] = $iReggestionopp["gesoppcodigo"];
			$iReggestionoppreporte["itedescodigo"] = $rwItemdesa["itedescodigo"];
			$iReggestionoppreporte["gesoppcantkg"] = $$obj_consumo;
			$iReggestionoppreporte["gesoppcantmt"] = $gesoppcantmt;
			$iReggestionoppreporte["gesoppnorollo"] = $gesoppnorollo;
			$iReggestionoppreporte["lotecodigo"] = $$obj_lote;
			$iReggestionoppreporte["geopreestado"] = 0;//estado inicial

			if( insrecordgestionoppreporte($iReggestionoppreporte,$idcon) ){
				$nuresult1 = fncnumprox(238,$iReggestionoppreporte["geoprecodigo"] + 1,$idcon);
			}
		}

	}

 	fncclose($idcon);
 	
 	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestablgestionopp.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';

}

?> 

