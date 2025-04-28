<?php
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaitem
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegitem         Arreglo de datos.
$flagnuevoitem    Bandera de validaci�n
Retorno         :
true	= 1
false	= 0
Autor           : ariascos
Escrito con     : WAG Adsum versi�n 3.1.1
Fecha           : 18082004
Historial de modificaciones
| Fecha | Motivo				| Autor 	|
*/

	include ( '../src/FunGen/fncnumprox.php');
	include ( '../src/FunGen/fncnumact.php');
	include ( '../def/tipocampo.php');
	include ( '../src/FunPerPriNiv/pktblitem.php');
	include ( '../src/FunPerPriNiv/pktblcampo.php');
	include ( '../src/FunPerPriNiv/pktbltabla.php');
	include ( '../src/FunGen/buscacaracter.php');
	include ( '../src/FunGen/fncmsgerror.php');
	include( '../src/FunGen/fncnombexs.php');
	
	function grabaitem($iRegitem,&$flagnuevoitem,&$campnomb, $flagitempedido, &$itemcodigo)
	{
		$nuconn = fncconn();
		//	No utilice esta parte si va a utilizar la llave primaria como serial
		
		define("id",9);
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
	/*
		$nuidtemp = fncnumact(id,$nuconn);
		do
		{
		$nuresult = loadrecorditem($nuidtemp,$nuconn);
		if($nuresult == e_empty)
		{
		$iRegitem[itemcodigo] = $nuidtemp;
		}
		$nuidtemp ++;
		}while ($nuresult != e_empty);
	
		if($iRegitem)
		{
		$itemcodigo = $iRegitem["itemcodigo"];
		*/
		
		$iRegtabla["tablnomb"] = "item";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "item")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
	
		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
	
		while($elementos = each($iRegitem))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
//				if($elementos[0] != "itemcodigo")
//				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevoitem = 1;
								$flagerror = 1;
							}
						}
					}
//				}
			}
			$validar = buscacaracter($elementos[1]);
	
			if($validar == 1)
			{
				$flagnuevoitem = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
			$validresult = consulmetaitem($elementos[0],$elementos[1],$nuconn);
	
			if($validresult == 1)
			{
				$flagnuevoitem = 1;
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
					$validnombre =  fncnombexs('item',$iRegitem,$elementos[0],$elementos[1],$nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flagnuevoitem = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}else
				{
					$flagnuevoitem = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
	
			if($elementos[0]=='cencoscodigo' && $elementos[1] == "")
			{
				$flagnuevoitem = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
	
			if($elementos[0]=='unidadcodigo' && $elementos[1]== null)
			{
				$flagnuevoitem = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
	
			if($elementos[0]=='itemvalor' && $elementos[1] < 0)
			{
				fncmsgerror(errorValneg);
				$flagnuevoitem = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
	
			if ($cantidad == 1)
			{
				if ($elementos[0] == 'itemcanmin')
				{
					fncmsgerror(errorCntItem);
					$flagnuevoitem = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset($cantidad);
				}
			}
		}
	
		if($flagerror == 1)
			fncmsgerror(errorIng);
	
		if($flagerror != 1)
		{
			$result = insrecorditem($iRegitem,$nuconn);
			
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevoitem=1;
			}
//			if($result > 0)
//			{
//				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //
//				fncmsgerror(grabaEx);
//				if($flagitempedido)
//					fncreturn($iRegitem);
//			}
			fncclose($nuconn);
		}
	}
	
	if (!empty($proveedor))
	{
		$iRegitem[itemcodigo] 	= $itemcodigo;
		$iRegitem[unidadcodigo] = $unidadcodigo;
		$iRegitem[cencoscodigo] = $cencoscodigo;
		$iRegitem[itemnombre] 	= $itemnombre;
		$iRegitem[itemcanmin] 	= $itemcanmin;
		$iRegitem[itemcanmax] 	= $itemcanmax;
		$iRegitem[itemvalor] 	= $itemvalor;
		$iRegitem[itemnota] 	= $itemnota;
		$iRegitem[itemdispon] 	= $itemdispon;
		$iRegitem[itemdensid] 	= $itemdensid;
		$iRegitem[itemextru] 	= $itemextru;
		$iRegitem[itempigme] 	= $itempigme;
		
		$flagitempedido = $flag;
	
		grabaitem($iRegitem,$flagnuevoitem,$campnomb, $flagitempedido, $itemcodigo);
	
		if(!$flagnuevoitem)
		{
			include('grabaitemproveedo.php');
			unset($proveedor);
	
	//		if (!empty($equipocodigo))
	//			include('grabaitemequipo.php');
	
			echo '<script language="javascript">'."\n";
			echo '<!--//'."\n";
			echo "alert('Grabado exitoso');"."\n";
			echo '//-->'."\n";
			echo '</script>';
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'location ="maestablitem.php?codigo='.$codigo.';"';
			echo '//-->'."\n";
			echo '</script>';
		}
	}
	else
	{
		echo '<script language="javascript">'."\n";
		echo '<!--//'."\n";
		echo "alert('Debe seleccionar al menos un proveedor');"."\n";
		echo '//-->'."\n";
		echo '</script>';
	
		$flagnuevoitem = 1;
		$campnomb["proveeselec"] = 1;
	}
	
//	function fncreturn($array)
//	{
//		$min = $array["itemcanmin"];
//		$max = $array["itemcanmax"];
//		$dis = $array["itemdispon"];
//		$val = $array["itemvalor"];
//		$cod = $array["itemcodigo"];
//		$nom = $array["itemnombre"];
//	
//		echo '<script language="JavaScript">'."\n";
//		echo 'window.opener.document.form1.itemcanmin.value="'.$min.'";'."\n";
//		echo 'window.opener.document.form1.itemcanmax.value="'.$max.'";'."\n";
//		echo 'window.opener.document.form1.itemdispon.value="'.$dis.'";'."\n";
//		echo 'window.opener.document.form1.itemvalor.value="'.$val.'";'."\n";
//		echo 'window.opener.document.form1.itemcodigo.value="'.$cod.'";'."\n";
//		echo 'window.opener.document.form1.itemnomb.value="'.$nom.'";'."\n";
//		echo 'window.close();'."\n";
//		echo '</script>'."\n";
//	}