<?php 
include ( '../src/FunPerPriNiv/pktbloperacio.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnombeditexs.php');

function editaoperacio($iRegoperacio,&$flageditaroperacio,&$campnomb,&$codigo)
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
	define("errorOper",34);
	define("errorIng",35);

	if ($iRegoperacio) 
	{ 
		$iRegtabla["tablnomb"] = "operacio";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "operacio")
			{
				$tablcodi = $sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegoperacio))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "operaccodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditaroperacio = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}			
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditaroperacio = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetaoperacio($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditaroperacio = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if($elementos[0] == 'tipopecodigo')
			{
				$sbRegnom = array($elementos[0], "operacfecha");
				$sbRegval = array($elementos[1], $iRegoperacio["operacfecha"]);

				$validnombre =  fncnombeditexs('operacio',$iRegoperacio,$sbRegnom,$sbRegval,
				'operaccodigo',$iRegoperacio['operaccodigo'],$nuconn);
				
				if ($validnombre == 1)
				{
					fncmsgerror(errorOper);
					$flageditaroperacio = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validnombre);
				}
			}
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		
		if($flagerror != 1)
		{
			$result = uprecordoperacio($iRegoperacio,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditaroperacio=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestabloperacio.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}
$iRegoperacio[operaccodigo] = $operaccodigo;
$iRegoperacio[tipopecodigo] = $tipopecodigo;
$iRegoperacio[operacvalor] = $operacvalor;
$iRegoperacio[operacfecha] = $operacfecha;
editaoperacio($iRegoperacio,$flageditaroperacio,$campnomb,$codigo);
?> 
