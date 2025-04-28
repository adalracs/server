<?php 
include ( '../src/FunPerPriNiv/pktblsoliservestado.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editasoliservestado($iRegsoliservestado,&$flageditarsoliservestado,&$campnomb,&$codigo)
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
	// --
	define("_DEF_BEG",1);
	define("_DEF_END",4);
	// --		
	if(($iRegsoliservestado[estsolcodigo] >= _DEF_BEG) || 
	   ($iRegsoliservestado[estsolcodigo] <= _DEF_END))
	{
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("Este registro no se puede editar");';
		echo 'location ="maestablsoliservestado.php?codigo='.$codigo.';"';
		echo '//-->'."\n";
		echo '</script>';	
	}else 
	{ 
		$iRegtabla["tablnomb"] = "soliservestado";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "soliservestado")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegsoliservestado))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "estsolcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarsoliservestado = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);
			if($validar == 1) 
			{ 
				$flageditarsoliservestado = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetasoliservestado($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditarsoliservestado = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			
			if($elementos[0]=='estsolnombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombeditexs('soliservestado',$iRegsoliservestado,$elementos[0],$elementos[1],'estsolcodigo',$iRegsoliservestado[estsolcodigo],$nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flageditarsoliservestado = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else 
				{
					$flageditarsoliservestado = 1;
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
			$result = uprecordsoliservestado($iRegsoliservestado,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarsoliservestado=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablsoliservestado.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}
$iRegsoliservestado[estsolcodigo] = $estsolcodigo;
$iRegsoliservestado[estsolnombre] = $estsolnombre;
$iRegsoliservestado[estsoldescri] = $estsoldescri;
$iRegsoliservestado[estsoltipo] = $estsoltipo;
editasoliservestado($iRegsoliservestado,$flageditarsoliservestado,$campnomb,$codigo);
?> 
