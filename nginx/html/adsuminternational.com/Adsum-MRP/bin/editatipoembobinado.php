<?php 
include ( '../src/FunPerPriNiv/pktbltipoembobinado.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombeditexs.php');

function editatipoembobinado($iRegtipoembobinado,&$flageditartipoembobinado,&$campnomb,&$codigo,$rutafoto)
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

	if ($iRegtipoembobinado) 
	{ 
		$iRegtabla["tablnomb"] = "tipoembobinado";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "tipoembobinado")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegtipoembobinado_b = $iRegtipoembobinado;
				
		while($elementos = each($iRegtipoembobinado))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "tipembcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditartipoembobinado = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}		
				
			$validar = buscacaracter($elementos[1]);
			
			if($validar == 1) 
			{ 
				$flageditartipoembobinado = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
			}			
			$validresult = consulmetatipoembobinado($elementos[0],$elementos[1],$nuconn);
			
			if ($validresult == 1)
			{
				$flageditartipoembobinado = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
		}
		
	 	//almancena imagen a mueble
		if(!$rutafoto)
		{	
			$flagnuevotipoembobinado = 1;
			$campnomb['rutafoto'] = 1;
			$flagerror = 1;
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		
		
		if($flagerror != 1)
		{
			$result = uprecordtipoembobinado($iRegtipoembobinado,$nuconn);
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditartipoembobinado=1;
			}
			if($result > 0)
			{
				fncmsgerror(editaEx);
				if($rutafoto){	
					$arr_img = explode('.', $rutafoto);
					rename('../img/pics_embobinados/'.$rutafoto, '../img/pics_embobinados/embobinado_'.$iRegtipoembobinado[tipembcodigo].'.'.$arr_img[count($arr_img) - 1]);
				}
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestabltipoembobinado.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			fncclose($nuconn);
		}
	}
}

$iRegtipoembobinado[tipembcodigo] = $tipembcodigo;
$iRegtipoembobinado[tipembnombre] = $tipembnombre;
$iRegtipoembobinado[tipembdescri] = $tipembdescri;

editatipoembobinado($iRegtipoembobinado,$flageditartipoembobinado,$campnomb,$codigo,$rutafoto);
?> 
