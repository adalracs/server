<?php
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editasaldo($iRegreportesaldo,&$flageditarreportesaldo,&$campnomb,&$codigo, $flagerror){

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
	define("errorNombExs",18);
	define("errorIng",35);

	if(!$iRegreportesaldo["kyreportesaldo"]){

		$campnomb["kyreportesaldo"] = 1;
		$flageditarreportesaldo = 1;
		$flagerror = 1;
	}

	if(!$iRegreportesaldo["esreportesaldo"]){

		$campnomb["esreportesaldo"] = 1;
		$flageditarreportesaldo = 1;
		$flagerror = 1;
	}

	if($flagerror == 1){
			fncmsgerror(errorIng);
	}
		
	if($flagerror != 1){

		$iRegreportedev["reopmtcodigo"] = $iRegreportesaldo["kyreportesaldo"];
		$iRegreportedev["reopmtestado"] = $iRegreportesaldo["esreportesaldo"];

		switch ($iRegreportesaldo["id"]) {
			case 1:
				$result = uprecordreporteoppsaldodev1($iRegreportedev, $nuconn);
				break;
			case 2:
				$result = uprecordreporteoppmaterialpndev1($iRegreportedev, $nuconn);
				break;
			case 3:
				$result = uprecordreporteoppmaterialdev1($iRegreportedev, $nuconn);
				break;
		}

		if($result < 0 ){

			ob_end_clean();
			fncmsgerror(errorReg);
			$flageditarsaldo=1;

		}else if($result > 0){

			fncmsgerror(editaEx);

			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'location ="maestablreportesaldo.php?codigo='.$codigo.';"';
			echo '//-->'."\n";
			echo '</script>';

		}
	}

	fncclose($nuconn);

}

$iRegreportesaldo["kyreportesaldo"] = $kyreportesaldo;
$iRegreportesaldo["esreportesaldo"] = $esreportesaldo;
$iRegreportesaldo["id"] = $id;

editasaldo($iRegreportesaldo,$flageditarreportesaldo,$campnomb,$codigo, $flagerror);

?>