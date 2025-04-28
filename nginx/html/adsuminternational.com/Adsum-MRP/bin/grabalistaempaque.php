<?php 
include ( '../src/FunPerPriNiv/pktbllistaempreporteoppreportepn.php');
include ( '../src/FunPerPriNiv/pktblreporteopp.php');
include ( '../src/FunPerPriNiv/pktbllistaempaque.php');
include ( '../src/FunGen/fncnumprox.php');
include ( '../src/FunGen/fncnumact.php');
include ( '../def/tipocampo.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabalistaempaque(&$iReglistaempaque,&$flagnuevolistaempaque,&$campnomb)
{
	$nuconn = fncconn();
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",267);
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
	define("e_empty",-3); 

	$nuidtemp = fncnumact(id,$nuconn); 
	do 
	{ 
		$nuresult = loadrecordlistaempaque($nuidtemp,$nuconn); 
		if($nuresult == e_empty) 
		{  
			$iReglistaempaque[lisempcodigo] = $nuidtemp; 
		} 
		$nuidtemp ++; 
	}while ($nuresult != e_empty);

	//	No utilice esta parte si va a utilizar la llave primaria como serial
	if($iReglistaempaque)
	{
		$iRegtabla["tablnomb"] = "listaempaque";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "listaempaque")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iReglistaempaque_b = $iReglistaempaque;
		
		while($elementos = each($iReglistaempaque))
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
								$flagnuevolistaempaque = 1;
								$flagerror = 1;
							}
						}
					}
			}
			
			$validar = buscacaracter($elementos[1]);
			if($validar == 1)
			{
				$flagnuevolistaempaque = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
						
			$validresult = consulmetalistaempaque($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevolistaempaque = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			//echo $elementos[0]."<br>";
			//echo $elementos[1]."<br>";	
			//echo "error".$flagerror."<br>";
		}
		//die;
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = insrecordlistaempaque($iReglistaempaque,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevolistaempaque=1;
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

$iReglistaempaque[lisempestacodigo] = $lisempestacodigo;
$iReglistaempaque[lisempfecgen] = date('Y-m-d');
$rwhora = getdate(time());
$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
$iReglistaempaque[lisemphorgen] = $hora;
$iReglistaempaque[plantacodigo] = $plantacodigo;
$iReglistaempaque[ordoppcodigo] = $ordoppcodigo;
$iReglistaempaque[usuacodi] = $usuacodi;
$iReglistaempaque[usuacodigo] = $usuacodi;
$iReglistaempaque[lisempnumept] = $lisempnumept;
$iReglistaempaque[lisempdireccion] = $lisempdireccion;
$iReglistaempaque[lisempdescri] = $lisempdescri;



grabalistaempaque($iReglistaempaque,$flagnuevolistaempaque,$campnomb);

if(!$flagnuevolistaempaque)
{
	$idcon = fncconn();
	
	//----------------------------------REPORTE DE ENTREGA------------------------------------------
	if($arrlistaempaque) $arrObjslistaempaque = explode(',',$arrlistaempaque);
	
	for( $a = 0; $a < count($arrObjslistaempaque); $a++)
	{
		$iReglistaempaquereporteoppreportepn['lisempcodigo'] = $iReglistaempaque[lisempcodigo];
		$iReglistaempaquereporteoppreportepn['reoppncodigo'] = $arrObjslistaempaque[$a];
		insrecordlistaempreporteoppreportepn($iReglistaempaquereporteoppreportepn,$idcon);
		$rwReporteoppreportepn = loadrecordreporteoppreportepn($arrObjslistaempaque[$a],$idcon);
		uprecordreporteopp1(array('repoppcodigo' => $rwReporteoppreportepn['repoppcodigo'], 'roestacodigo' => 6/*estado "En Lista de Empaque"*/),$idcon);
	}
	
	fncclose($idcon);
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'location ="maestabllistaempaque.php?codigo='.$codigo.';"';
	echo '//-->'."\n";
	echo '</script>';
}
?> 
