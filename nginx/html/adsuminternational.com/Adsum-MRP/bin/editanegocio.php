<?php 
include ( '../src/FunPerPriNiv/pktblnegocio.php'); 
include ( '../src/FunPerPriNiv/pktblcampo.php'); 
include ( '../src/FunPerPriNiv/pktbltabla.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
include ( '../src/FunGen/fncnombeditexs.php');
 
function editanegocio($iRegnegocio,&$flageditarnegocio,&$campnomb,&$codigo) 
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

	if ($iRegnegocio) 
	{ 
		$iRegtabla["tablnomb"] = "negocio";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "negocio")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegnegocio))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "negocicodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarnegocio = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{  
				$flageditarnegocio = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1; 
			}
			$validresult = consulmetanegocio($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditarnegocio = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if($elementos[0] == 'negocinombre')
			{
				$validnombre =  fncnombeditexs('negocio',$iRegnegocio,$elementos[0],$elementos[1],
				'negocicodigo',$iRegnegocio["negocicodigo"],$nuconn);
				if ($validnombre == 1)
				{
					fncmsgerror(errorNombExs);
					$flageditarnegocio = 1;
					$flagerror = 1;
					$flagnomberr = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validnombre);
				}
			}
		}
		
		if(($flagerror == 1) && !($flagnomberr))
		{
			fncmsgerror(errorIng);
		}
		 
		if($flagerror != 1) 
		{ 
			$result = uprecordnegocio($iRegnegocio,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarnegocio=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(editaEx); 
				echo '<script language="javascript">'; 
				echo '<!--//'."\n"; 
				echo 'location ="maestablnegocio.php?codigo='.$codigo.';"'; 
				echo '//-->'."\n"; 
				echo '</script>'; 
			} 
			fncclose($nuconn); 
		} 
	} 
}

$iRegnegocio[negocicodigo] = $negocicodigo1; 
$iRegnegocio[negocinombre] = $negocinombre; 
$iRegnegocio[negocidescri] = $negocidescri;
$iRegnegocio[negocicacint] = $negocicacint; 
editanegocio($iRegnegocio,$flageditarnegocio,$campnomb,$codigo);