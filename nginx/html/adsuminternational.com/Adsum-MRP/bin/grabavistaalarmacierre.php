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
include( '../src/FunGen/fncnombeditexs.php');



function grabavistaalarmacierre($iRegalarma,&$flagnuevovistaalarmacierre,&$campnomb, $codigo, $alagesdescri, $estalacodigo1)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",237);
	
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
	
	$nuidtemp = fncnumact(	id,$nuconn);
	do
	{
		$nuresult = loadrecordalarmagestion($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
			$iRegalarma[alagescodigo] = $nuidtemp;
		}
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	//$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn);
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	
	if($iRegalarma)
	{
		$iRegtabla["tablnomb"] = "alarmagestion";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "alarmagestion")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		while($elementos = each($iRegalarma))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "alagescodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevovistaalarmacierre = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flagnuevovistaalarmacierre = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			
			$validresult = consulmetaalarmagestion($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevovistaalarmacierre = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			//echo $elementos[0]."<br>";
			//echo $elementos[1]."<br>";	
			//echo "error".$flagerror."<br>";
		}
		//die;

		if(!$alagesdescri){
			$flageditarvistaalarmagestion = 1;
			$flagerror = 1;
			$campnomb['alagesdescri'] = 1;
		}
		
		if(!$estalacodigo1){
			$flageditarvistaalarmagestion = 1;
			$flagerror = 1;
			$campnomb['estalacodigo'] = 1;
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		
		if($flagerror != 1)
		{
			$result = insrecordalarmagestion($iRegalarma,$nuconn);
			//$result = uprecordalarmagestion($iRegalarma,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevovistaalarmacierre=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 

				//	No utilice esta parte si va a utilizar la llave primaria como serial //
				fncmsgerror(grabaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablvistaalarmacierre.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}

$sfecha=date('Y-m-d');
$stime=date("h").":".date("i");

$iRegalarma[alarmacodigo] = $alarmacodigo;
$iRegalarma[usuacodi] = $usuacodi;
$iRegalarma[alagesfecha] = $sfecha;
$iRegalarma[alageshora] = $stime;
$iRegalarma[alagesdescri] = $alagesdescri;
$iRegalarma[estalacodigo] =$estalacodigo1;

grabavistaalarmacierre($iRegalarma,$flagnuevovistaalarmacierre,$campnomb, $codigo, $alagesdescri, $estalacodigo1);

?> 
