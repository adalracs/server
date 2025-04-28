<?php
// $arr_item: Se utiliza para el borrado de OT/PROGRAMACION
	if(!isset($arr_item))
	{
		include ( '../def/tipocampo.php');
		include ( '../src/FunGen/buscacaracter.php');
		include ( '../src/FunGen/fncmsgerror.php');
		include ( '../src/FunPerPriNiv/pktblitem.php');
		include ( '../src/FunPerPriNiv/pktblcampo.php');
		include ( '../src/FunPerPriNiv/pktbltabla.php');
	}
	include( '../src/FunGen/fncnombeditexs.php');

	function editaitem($iRegitem,&$flageditaritem,&$campnomb,&$codigo)
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
		define("errorCntItem",22);
		define("errorValneg",23);
		define("errorIng",35);
	
		if ($iRegitem)
		{
			$iRegtabla["tablnomb"] = "item";
			$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
			$num = fncnumreg($resulttabla);
	
			for($i=0;$i<$num;$i++)
			{
				$sbregtabla = fncfetch($resulttabla,$i);
	
				if($sbregtabla[tablnomb] == "item")
				{
					$tablcodi = $sbregtabla['tablcodi'];
					break;
				}
			}
			$iRegCampo["tablcodi"] = $tablcodi;
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			$iRegitem_b = $iRegitem;
			
			
			while($elementos = each($iRegitem))
			{
				$iRegCampo["campnomb"] = $elementos[0];
				$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
				$num = fncnumreg($resultcampo);
				if($num>0)
				{
					$sbregcampo = fncfetch($resultcampo,0);
					if($elementos[0] != "itemcodigo")
					{
						if($sbregcampo["campnomb"] == $elementos[0])
						{
							$respuesta = strcmp($sbregcampo["campnotnull"],"t");
							if($respuesta == 0)
							{
								if($elementos[1] == "")
								{
									$campnomb[$elementos[0]] = 1;
									$flageditaritem = 1;
									$flagerror = 1;
								}
							}
						}
					}
				}
	
				$validar = buscacaracter($elementos[1]);
				if($validar == 1)
				{
					$flageditaritem = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
	
				$validresult = consulmetaitem($elementos[0],$elementos[1],$nuconn);
				if ($validresult == 1)
				{
					$flageditaritem = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validresult);
				}
	
				if ($iRegitem[itemcanmin] > $iRegitem[itemcanmax])
				$cantidad = 1;
	
				if($elementos[0]=='itemnombre')
				{
					if($elementos[1] != null)
					{
						$validnombre =  fncnombeditexs('item',$iRegitem_b,$elementos[0],$elementos[1],'itemcodigo',$iRegitem[itemcodigo],$nuconn);
						if ($validnombre == 1)
						{
							fncmsgerror(errorNombExs);
							$flageditaritem = 1;
							$flagerror = 1;
							$campnomb[$elementos[0]] = 1;
							unset ($validnombre);
						}
					}else
					{
						$flageditaritem = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
					}
				}
	
				if($elementos[0]=='cencoscodigo' && $elementos[1] == "")
				{
					$flageditaritem = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
	
				if($elementos[0]=='unidadcodigo' && $elementos[1]== null)
				{
					$flageditaritem = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
	
				if($elementos[0]=='itemvalor' && $elementos[1] < 0)
				{
					fncmsgerror(errorValneg);
					$flageditaritem = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
	
				if ($cantidad == 1)
				{
					if ($elementos[0] == 'itemcanmin')
					{
						fncmsgerror(errorCntItem);
						$flageditaritem = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset($cantidad);
					}
				}
			}
			if($flagerror == 1)
			{
				fncmsgerror(errorIng);
			}
			if($flagerror != 1)
			{
				$result = uprecorditem($iRegitem,$nuconn);
				if($result < 0 )
				{
					ob_end_clean();
					fncmsgerror(errorReg);
					$flageditaritem=1;
				}
				fncclose($nuconn);
			}
		}
	}

	if(!isset($arr_item))
	{
		// --- $arreglo_aux: cadena con los codigos de los proveedores escogidos
		if(!empty($proveedor))
		{
			$iRegitem[itemcodigo]   = $itemcodigo;
			$iRegitem[unidadcodigo] = $unidadcodigo;
			$iRegitem[cencoscodigo] = $cencoscodigo;
			$iRegitem[itemnombre]   = $itemnombre;
			$iRegitem[itemcanmin]   = $itemcanmin;
			$iRegitem[itemcanmax]   = $itemcanmax;
			$iRegitem[itemvalor]    = $itemvalor;
			$iRegitem[itemnota]     = $itemnota;
			$iRegitem[itemdispon]   = $itemdispon;
			$iRegitem[itemdensid]   = $itemdensid;
			$iRegitem[itemextru]   = $itemextru;
			$iRegitem[itempigme]   = $itempigme;
	
			editaitem($iRegitem,$flageditaritem,$campnomb,$codigo);
	
			//----------------
			if(!$flageditaritem)
			{
				$arreglo_aux = $proveedor;
				include('editaitemproveedo.php');
	
//				if (!empty($equipocodigo)) {
//	
////					if (empty($iteequcodigo))
////						include('grabaitemequipo.php');
////					else
////						include('editaitemequipo.php');
//				}
	
				echo '<script language="JavaScript">'."\n";
				echo '<!--//'."\n";
				echo 'alert(\'Proceso exitoso\')'."\n";
				echo 'location ="maestablitem.php?codigo='.$codigo.';"';
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
	
			$flageditaritem = 1;
			$campnomb["proveeselec"] = 1;
		}
	}
	else
	{
		$num = count($arr_item);
	
		for($i=0; $i<$num; $i++)
		{
			$iRegitem[itemcodigo]   = $arr_item[$i]['itemcodigo'];
			$iRegitem[unidadcodigo] = $arr_item[$i]['unidadcodigo'];
			$iRegitem[cencoscodigo] = $arr_item[$i]['cencoscodigo'];
			$iRegitem[itemnombre]   = $arr_item[$i]['itemnombre'];
			$iRegitem[itemcanmin]   = $arr_item[$i]['itemcanmin'];
			$iRegitem[itemcanmax]   = $arr_item[$i]['itemcanmax'];
			$iRegitem[itemvalor]    = $arr_item[$i]['itemvalor'];
			$iRegitem[itemnota]     = $arr_item[$i]['itemnota'];
			$iRegitem[itemdispon]   = $arr_item[$i]['itemdispon'];
	
			$flageditaritem['otflag'] = 1;
	
			editaitem($iRegitem,$flageditaritem,$campnomb,$codigo);
		}
		return ;
	}
?>