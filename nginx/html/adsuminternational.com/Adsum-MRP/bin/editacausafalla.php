<?php 
include ( '../src/FunPerPriNiv/pktblcausafalla.php'); 
include ( '../src/FunPerPriNiv/pktblcampo.php'); 
include ( '../src/FunPerPriNiv/pktbltabla.php'); 
include ( '../def/tipocampo.php'); 
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editacausafalla($iRegcausafalla,&$flageditarcausafalla,&$campnomb,&$codigo) 
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
	 
	if ($iRegcausafalla) 
	{ 
		$iRegtabla["tablnomb"] = "causafalla";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "causafalla")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegcausafalla))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "caufallcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarcausafalla = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}			
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditarcausafalla = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetacausafalla($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditarcausafalla = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if($elementos[0]=='caufallnombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombeditexs('causafalla',$iRegcausafalla,$elementos[0],$elementos[1],'causacodigo',$iRegcausafalla[causacodigo],$nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flageditarcausafalla = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else 
				{
					$flageditarcausafalla = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		 
		if($flagerror != 1) 
		{ 
			$result = uprecordcausafalla($iRegcausafalla,$nuconn); 
			if($result < 0 ) 
			{ 
				ob_end_clean(); 
				fncmsgerror(errorReg); 
				$flageditarcausafalla=1; 
			} 
			if($result > 0) 
			{ 
				fncmsgerror(editaEx); 
				 
			} 
			fncclose($nuconn); 
		} 
	} 
} 
$iRegcausafalla[caufallcodigo] = $caufallcodigo; 
$iRegcausafalla[caufallnombre] = $caufallnombre; 
$iRegcausafalla[caufalldescri] = $caufalldescri; 

editacausafalla($iRegcausafalla,$flageditarcausafalla,$campnomb,$codigo); 
if(!$flageditarcausafalla){
		echo '<script language="javascript">'; 
		echo '<!--//'."\n"; 
		echo 'location ="maestablcausafalla.php?codigo='.$codigo.';"'; 
		echo '//-->'."\n"; 
		echo '</script>';
}
?> 
