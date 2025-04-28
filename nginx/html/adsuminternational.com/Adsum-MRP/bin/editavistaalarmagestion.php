<?php
ini_set('display_errors',1); 
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../src/FunPerPriNiv/pktblformulacion.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnombeditexs.php');


function editavistaalarmagestion($iReg, $iRegalarma, &$flageditarvistaalarmagestion, &$campnomb, $codigo, $estalacodigo,$alagesdescri)
{
	$nuconn = fncconn();
	define("id2",236);
	define("id3",237);
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

	if ($iRegalarma) 
	{ 
		$iRegtabla["tablnomb"] = "alarma";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "alarma")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegformulacion_b = $iRegalarma;
				
		while($elementos = each($iRegalarma))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "alarmacodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarvistaalarmagestion = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}		
				
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1){ 
				$flageditarvistaalarmagestion = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetaalarma($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1){
				$flageditarvistaalarmagestion = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			/*echo $elementos[0]."<br>";
			echo $elementos[1]."<br>";	
			echo "error".$flagerror."<br>";*/
		}
		//die;
		if(!$estalacodigo){
			$flageditarvistaalarmagestion = 1;
			$flagerror = 1;
			$campnomb['estalacodigo'] = 1;
		}
		if(!$alagesdescri){
			$flageditarvistaalarmagestion = 1;
			$flagerror = 1;
			$campnomb['alagesdescri'] = 1;
		}
		if($flagerror == 1){
			fncmsgerror(errorIng);
		}
		if($flagerror != 1){
			$result = uprecordalarma($iRegalarma,$nuconn);
			if($result < 0 ){
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarvistaalarmagestion=1;
			}
			if($result > 0){
				$nuidtemp = fncnumact(id2,$nuconn);
				if(!empty($iReg)){
					unset($nuidtemp);
					do{
						$nuresult = loadrecordalarmagestion($nuidtemp,$nuconn);
						if($nuresult == e_empty){
							$iRegalarmagestion[alagescodigo] = $nuidtemp;
						}
						$nuidtemp ++;
					}while ($nuresult != e_empty);
						$stime=date("h").":".date("i");
						$sfecha=date('Y-m-d');
						$iRegalarmagestion[alarmacodigo] = $iRegalarma[alarmacodigo];
						$iRegalarmagestion[usuacodi] = $iReg[usuacodi];
						$iRegalarmagestion[alagesfecha] = $sfecha;
						$iRegalarmagestion[alageshora] = $stime;
						$iRegalarmagestion[alagesdescri] = $iReg[alagesdescri];
						$iRegalarmagestion[estalacodigo] = $iReg[estalacodigo];
						insrecordalarmagestion($iRegalarmagestion,$nuconn);
						$nuresult1 = fncnumprox(id3,$nuidtemp,$nuconn);	
				}
					fncmsgerror(editaEx);
					echo '<script language="javascript">';
					echo '<!--//'."\n";
					echo 'location ="maestablvistaalarmagestion.php?codigo='.$codigo.';"';
					echo '//-->'."\n";
					echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}

$iRegalarma[alarmacodigo] = $alarmacodigo;

$iReg[usuacodi] = $usuacodi;
$iReg[alagesdescri] = $alagesdescri;
$iReg[estalacodigo] = $estalacodigo;

editavistaalarmagestion($iReg,$iRegalarma,$flageditarvistaalarmagestion,$campnomb,$codigo, $estalacodigo,$alagesdescri);

?> 
