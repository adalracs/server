<?php 

	ini_set('display_errors',1);
	include ( '../src/FunPerPriNiv/pktblrequisicion.php');
	include ( '../src/FunPerPriNiv/pktblcampo.php');
	include ( '../src/FunPerPriNiv/pktbltabla.php');
	include ( '../src/FunGen/buscacaracter.php');
	include ( '../src/FunGen/fncmsgerror.php');
	include ( '../src/FunGen/fncnumprox.php');
	include ( '../src/FunGen/fncnumact.php');
	include ( '../src/FunGen/fncnombexs.php');
	include ( '../def/tipocampo.php');

	define("id_reqitecodigo",291);
	define("grabaEx",3);
	define("errorIng",35);


	if(validaint4($estreqcodigo) > 0 || (!$estreqcodigo) )
	{
		$flagnuevogestionrequisicion = 1;	
	 	$flagerror = 1;
	 	$campnomb["estreqcodigo"] = 1;
	}

	if( $estreqcodigo < 3){

		if($arrrequisiionitemdesa) $arrObjrequisiionitemdesa = explode(":|:",$arrrequisiionitemdesa);  else unset($arrrequisiionitemdesa);

		for($a = 0; $a < count($arrObjrequisiionitemdesa); $a++){

			$obj_reqitecantre = "reqitecantre_".$arrObjrequisiionitemdesa[$a];
		
			if(validafloat4($$obj_reqitecantre) > 0 && ($$obj_reqitecantre != "0") )
			{

				$flagnuevogestionrequisicion = 1;	
	 			$flagerror = 1;
	 			$campnomb[$obj_reqitecantre] = 1;
			}

		}

	}


	if(!$flagnuevogestionrequisicion){

		$idcon = fncconn();

		$iRegrequisicion["requiscodigo"] = $requiscodigo;
		$iRegrequisicion["estreqcodigo"] = $estreqcodigo;

		uprecordrequisicion($iRegrequisicion,$idcon);


		if($arrrequisiionitemdesa) $arrObjrequisiionitemdesa = explode(":|:",$arrrequisiionitemdesa);  else unset($arrrequisiionitemdesa);

		for($a = 0; $a < count($arrObjrequisiionitemdesa); $a++){

			$obj_reqitecantre = "reqitecantre_".$arrObjrequisiionitemdesa[$a];

			$iRegrequisicionitemdesa["requiscodigo"] = $requiscodigo;
			$iRegrequisicionitemdesa["itedescodigo"] = $arrObjrequisiionitemdesa[$a];
			$iRegrequisicionitemdesa["reqitefecfin"] = date('Y-m-d');
			$rwhora = getdate(time());
			$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
			$iRegrequisicionitemdesa["reqitehorfin"] = $hora;
			$iRegrequisicionitemdesa["reqitecantre"] = $$obj_reqitecantre;

			uprecordrequisicionitemdesa1($iRegrequisicionitemdesa,$idcon);

		}

		fncmsgerror(grabaEx);

		fncclose($idcon);


		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'location ="maestablgestionrequisicion.php?codigo='.$codigo.';"';
		echo '//-->'."\n";
		echo '</script>';


	}else{
		fncmsgerror(errorIng);
	}


?>