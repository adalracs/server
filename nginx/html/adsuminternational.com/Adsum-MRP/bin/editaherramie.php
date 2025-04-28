<?php
// $arr_herramie: Se utiliza para el borrado de OT/PROGRAMACION
if(!isset($arr_herramie))
{
	include ( '../src/FunPerPriNiv/pktblcampo.php');
	include ( '../src/FunPerPriNiv/pktbltabla.php');
	include ( '../src/FunPerPriNiv/pktblherramie.php');
	include ( '../src/FunGen/fncmsgerror.php');
}
if(!isset($arr_item))
{
	include ( '../def/tipocampo.php');
	include ( '../src/FunGen/buscacaracter.php');	
	include ( '../src/FunGen/fncnombeditexs.php');
}

function editaherramie($iRegherramie,&$flageditarherramie,&$campnomb,&$codigo)
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
	define("errorValneg",23);
	define("errorIng",35);

	if ($iRegherramie)
	{
		$iRegtabla["tablnomb"] = "herramie";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "herramie")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		
		$iRegherramie_a = $iRegherramie;
		
		while($elementos = each($iRegherramie))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "herramcodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarherramie = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			$validar = buscacaracter($elementos[1]);

			if($validar == 1)
			{
				$flageditarherramie = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetaherramie($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flageditarherramie = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
			if($elementos[0]=='herramnombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombeditexs('herramie',$iRegherramie_a,$elementos[0],$elementos[1],'herramcodigo',$iRegherramie[herramcodigo],$nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flageditarherramie = 1;
						$flagerror = 1;
						$campnomb = $elementos[0];
						unset ($validnombre);
					}
				}else
				{
					$flageditarherramie = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
			if($elementos[0]=='cencoscodigo' && $elementos[1] == "")
			{
				$flageditarherramie = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}

			if($elementos[0]=='herramvalor' && $elementos[1] < 0)
			{
				fncmsgerror(errorValneg);
				$flageditarherramie = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
		}
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			$result = uprecordherramie($iRegherramie,$nuconn);

			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarherramie=1;
			}
			
			if($result > 0)
			{
				if (!$flageditarherramie["otflag"])
				{
					fncmsgerror(editaEx);
					echo '<script language="javascript">';
					echo '<!--//'."\n";
					echo 'location ="maestablherramie.php?codigo='.$codigo.';"';
					echo '//-->'."\n";
					echo '</script>';
				}
			}
			fncclose($nuconn);
		}
	}
}

if(!isset($arr_herramie))
{
// --- $arreglo_aux: cadena con los codigos de los proveedores escogidos
	if(!empty($proveedor))
	{
		$iRegherramie[herramcodigo] = $herramcodigo;
		$iRegherramie[cencoscodigo] = $cencoscodigo;
		$iRegherramie[herramnombre] = $herramnombre;
		$iRegherramie[herramvalor] = $herramvalor;
		$iRegherramie[herramdescri] = $herramdescri;
		$iRegherramie[herramdispon] = $herramdispon;

		//$flageditarherramie['otflag'] = 1;

		editaherramie($iRegherramie,$flageditarherramie,$campnomb,$codigo);
		//----------------
		if(!$flageditarherramie)
		{
			$arreglo_aux = $proveedor;
			include('editaherramieproveedo.php');

			echo '<script language="JavaScript">'."\n";
			echo '<!--//'."\n";
			echo 'alert(\'Proceso exitoso\')'."\n";
			echo 'location ="maestablherramie.php?codigo='.$codigo.';"';
			echo '//-->'."\n";
			echo '</script>';
		}
	}
	else 
	{
		echo '<script language="javascript">'."\n";
		echo '<!--//'."\n";
		echo 'alert("Debe seleccionar al menos un proveedor");'."\n";
		echo '//-->'."\n";
		echo '</script>'."\n";

		$flageditarherramie = 1;
		$campnomb["proveeselec"] = 1;
	}
}
else
{
	$num = count($arr_herramie);

	for($i=0; $i<$num; $i++)
	{
		$iRegherramie[herramcodigo] = $arr_herramie[$i]['herramcodigo'];
		$iRegherramie[cencoscodigo] = $arr_herramie[$i]['cencoscodigo'];
		$iRegherramie[herramnombre] = $arr_herramie[$i]['herramnombre'];
		$iRegherramie[herramvalor]  = $arr_herramie[$i]['herramvalor'];
		$iRegherramie[herramdescri] = $arr_herramie[$i]['herramdescri'];
		$iRegherramie[herramdispon] = $arr_herramie[$i]['herramdispon'];

		$flageditarherramie['otflag'] = 1;

		editaherramie($iRegherramie, $flageditarherramie, $campnomb,$codigo);
	}
	return;
}
?> 
