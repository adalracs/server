<?php 
include ( '../src/FunPerPriNiv/pktblclasifallelec.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editaclasifallelec($iRegclasifallelec,&$flageditarclasifallelec,&$campnomb,&$codigo)
{ 
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
	
	if ($iRegclasifallelec)
	{ 
		$iRegtabla["tablnomb"] = "clasifallelec";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i = 0; $i < $num; $i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "clasifallelec")
			{
				$tablcodi = $sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegclasifallelec_b = $iRegclasifallelec;
			
		while($elementos = each($iRegclasifallelec))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			
			if($num > 0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				
				if($elementos[0] != "cfalelcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarclasifallelec = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}			
			
			$validar = buscacaracter($elementos[1]); 
			if($validar == 1)
			{ 
				$flageditarclasifallelec = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
			} 
			$validresult = consulmetaclasifallelec($elementos[0],$elementos[1],$nuconn); 
			
			if ($validresult == 1)
			{ 
				$flageditarclasifallelec = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
				unset ($validresult); 
			} 

			/*if($elementos[0] == 'cfalelnombre')
			{
				if($elementos[1] != null){
					$validnombre =  fncnombeditexs('clasifallelec',$iRegclasifallelec_b,$elementos[0],$elementos[1],'cfalelcodigo',$iRegclasifallelec[cfalelcodigo],$nuconn);
					
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flageditarclasifallelec = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else
				{
					$flageditarclasifallelec = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;					
				}
			}*/
		} 
		
		if($flagerror == 1)
			fncmsgerror(errorIng);
		
		if($flagerror != 1)
		{ 
			$result = uprecordclasifallelec($iRegclasifallelec,$nuconn); 
			
			if($result < 0 )
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarclasifallelec=1; 
			} 
			if($result > 0)
				fncmsgerror(editaEx); 
			fncclose($nuconn); 
		} 
	} 
} 

$iRegclasifallelec[cfalelcodigo] = $cfalelcodigo; 
$iRegclasifallelec[cfalelnombre] = $cfalelnombre; 
$iRegclasifallelec[cfaleldescri] = $cfaleldescri; 
$iRegclasifallelec[cfalelhcolor] = $cfalelhcolor;  

editaclasifallelec($iRegclasifallelec,$flageditarclasifallelec,$campnomb,$codigo);

if(!$flageditarclasifallelec)
{
	$idcon = fncconn();
	delrecordrangofallelec($cfalelcodigo, $idcon);
	
	$irecRangofallelec['cfalelcodigo'] = $cfalelcodigo;
	$irecRangofallelec['ranfeltipo'] = 1;
	$irecRangofallelec['ranfelvalini'] = unfmtCurrency($ranfelvalini1);
	$irecRangofallelec['ranfelvalfin'] = unfmtCurrency($ranfelvalfin1);
	
	insrecordrangofallelec($irecRangofallelec, $idcon);

	$irecRangofallelec['cfalelcodigo'] = $cfalelcodigo;
	$irecRangofallelec['ranfeltipo'] = 2;
	$irecRangofallelec['ranfelvalini'] = unfmtCurrency($ranfelvalini2);
	$irecRangofallelec['ranfelvalfin'] = unfmtCurrency($ranfelvalfin2);
	
	insrecordrangofallelec($irecRangofallelec, $idcon);
	
	echo '<script language="javascript">';
	echo '<!--//'."\n"; 
	echo 'location ="maestablclasifallelec.php?codigo='.$codigo.';"'; 
	echo '//-->'."\n"; 
	echo '</script>'; 
}
