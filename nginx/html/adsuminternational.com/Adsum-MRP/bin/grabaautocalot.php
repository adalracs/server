<?php 

	ini_set( "display_errors", 1);
	ini_set( "memory_limit", "512M");

	include ( "../src/FunPerPriNiv/pktblot.php");
	include ( "../src/FunPerSecNiv/fncconn.php");
	include ( "../src/FunPerSecNiv/fncclose.php");
	include ( "../src/FunPerSecNiv/fncfetch.php");
	include ( "../src/FunPerSecNiv/fncnumreg.php");
	include ( "../src/FunPerPriNiv/pktblusuario.php");
	include ( "../src/FunPerPriNiv/pktblsoliserv.php");
	include ( "../src/FunPerPriNiv/pktblcierreot.php"); 
	include ( "../src/FunPerPriNiv/pktblautocalot.php");
	include ( "../src/FunPerPriNiv/pktblparametro.php");
	include ( "../src/FunPerPriNiv/pktblvistarepcierre.php");

	include_once ( "../src/FunGen/fncnumprox.php");
	include_once ( "../src/FunGen/fncnumact.php");

	include ( "../src/FunPHPMailer/mail.send.php");

	$idcon = fncconn();
	
	$rsAutocalot = dinamicscanopautocalot(array( "autocafecini" => date("Y-m-d"), "autocaresult" => 1), array("autocafecini" => "=", "autocaresult" => "="), $idcon);
	$nrAutocalot = fncnumreg($rsAutocalot);
	
	$rsAutocalot1 = dinamicscanopautocalot(array( "autocafecini" => date("Y-m-d"), "autocaresult" => 5), array("autocafecini" => "=", "autocaresult" => "="), $idcon);
	$nrAutocalot1 = fncnumreg($rsAutocalot1);

	if( $usuacodi > 0 && ($nrAutocalot <= 0 && $nrAutocalot1 <= 0) ){

		$nuidtemp = fncnumact(306,$idcon);	

		do{

			$nuresult = loadrecordautocalot($nuidtemp,$idcon);

			if($nuresult == e_empty){
				$iRegAutocalot["autocacodigo"] = $nuidtemp;
			}
			$nuidtemp ++;
		}while ($nuresult != e_empty);
			
		$autocacodigo1 = $iRegAutocalot["autocacodigo"];

		$iRegAutocalot["autocafecini"] = date("Y-m-d");
		$rwhora = getdate(time());
		$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
		$iRegAutocalot["autocahorini"] = $hora;
		$iRegAutocalot["usuacodi"] = $usuacodi;
		$iRegAutocalot["autocaresult"] = 5;//en ejecucion

		if(insrecordautocalot($iRegAutocalot, $idcon) > 0){

			fncnumprox(306, $nuidtemp, $idcon); 
		}
			
		unset($iRegAutocalot, $nuidtemp, $nuresult);

		$rsVistarepcierre = fullscanvistarepcierre1($idcon);
		$nrVistarepcierre = fncnumreg($rsVistarepcierre);

		$rwPargen1 = loadrecordparametro(1, $idcon);//parametro => valor_tipo_cump	
		$rwPargen2 = loadrecordparametro(2, $idcon);//parametro => valor_calificacion_auto	

		for($a = 0; $a < $nrVistarepcierre; $a++){

			$rwVistarepcierre = fncfetch($rsVistarepcierre, $a);

			$rwOt = loadrecordot($rwVistarepcierre["ordtracodigo"], $idcon);

			if($rwOt["solsercodigo"] > 0){

				$rwSoliserv = loadrecordsoliserv($rwOt["solsercodigo"], $idcon);

				$usuacodigo = $rwSoliserv["usuacodi"];
				$usuacodigo2 = $rwOt["usuacodi"];
			}else{

				$usuacodigo = $rwOt["usuacodi"];
			}			

			if( date("Y-m-d") >= date("Y-m-d", strtotime($rwVistarepcierre["reportfecha"]." + {$rwPargen2['paramevalor']} Days") ) ){

				$nuidtemp = fncnumact(58, $idcon);	

				do{

					$nuresult = loadrecordcierreot($nuidtemp, $idcon);

					if($nuresult == e_empty){
						$iRegcierreot["cierotcodigo"] = $nuidtemp;
					}
					$nuidtemp ++;
				}while ($nuresult != e_empty);

				$iRegcierreot["usuacodi"] = $usuacodigo; 
				$iRegcierreot["tipcumcodigo"] = $rwPargen1["paramevalor"]; 
				$iRegcierreot["reportcodigo"] = $rwVistarepcierre["reportcodigo"]; 
				$iRegcierreot["cierotfecfin"] = date("Y-m-d"); 

				$rwhora = getdate(time());
				$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];

				$iRegcierreot["cierothorfin"] = $hora;
				$iRegcierreot["cierotdescri"] = "Cierre de orden automatico";

				if(insrecordcierreot($iRegcierreot, $idcon) > 0){

					fncnumprox(306, $nuidtemp, $idcon); 

					$mails = array();

					if($usuacodigo > 0){

						$rwUsuario = loadrecordusuario($usuacodigo, $idcon);
						if($rwUsuario["usuaemail"]) $mails[] = $rwUsuario["usuaemail"];
						unset($rwUsuario);
					}

					if($usuacodigo2 > 0){

						$rwUsuario = loadrecordusuario($usuacodigo2, $idcon);
						if($rwUsuario["usuaemail"]) $mails[] = $rwUsuario["usuaemail"];
						unset($rwUsuario);
					}

					send_mail("cierreot", array("cierotcodigo" => $iRegcierreot["cierotcodigo"]), $mails);
				}

				unset($iRegcierreot, $nuidtemp, $nuresult);

			}

		}

		$iRegAutocalot["autocacodigo"] = $autocacodigo1;
		$iRegAutocalot["autocafecfin"] = date("Y-m-d");

		$rwhora = getdate(time());
		$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];

		$iRegAutocalot["autocahorfin"] = $hora;
		$iRegAutocalot["autocaresult"] = 1;//successful
		$iRegAutocalot["autocamensaj"] = "successful";

		uprecordautocalot($iRegAutocalot, $idcon);

		echo "Calificacion Automatica Realizada";

	}else{

		echo "Calificacion Automatica Realizada";
	}

	fncclose($idcon);

?>