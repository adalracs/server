<?php
/*
-Todos los derechos reservados-
Propiedad intelectual de Adsum (c).
Funcion         : grabaitem
Decripcion      : Valida la data a grabar y la lleva al paquete.
Parametros      : Descripicion
$iRegitem         Arreglo de datos.
$flageditaritem    Bandera de validaci�n
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
include ( '../src/FunPerPriNiv/pktblitemtemp.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include( '../src/FunGen/fncnombexs.php');

function grabaitem($iRegitem,&$flageditaritem,&$campnomb, &$itemcodigo)
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

	$itemcodigo = $iRegitem['itemcodigo'];

	if($iRegitem)
	{
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

			if($validresult == 1)
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
					$validnombre =  fncnombexs('item',$iRegitem,$elementos[0],$elementos[1],$nuconn);
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
			$result = insrecorditem($iRegitem,$nuconn);
			$result_del = delrecorditemtemp($iRegitem['itetemcodigo'], $nuconn);

			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditaritem=1;
			}
			if($result > 0)
			{
				$nuresult1 = fncnumprox(id,$nuidtemp,$nuconn); 	//	No utilice esta parte si va a utilizar la llave primaria como serial //

				if($flagitempedido)
				{
					fncreturn($iRegitem);
				}
			}
			fncclose($nuconn);
		}
	}
}
if(!empty($arreglo_aux))
{
	$iRegitem[itetemcodigo] = $itetemcodigo;
	$iRegitem[itemcodigo] 	= $itemcodigo;
	$iRegitem[unidadcodigo] = $unidadcodigo;
	$iRegitem[cencoscodigo] = $cencoscodigo;
	$iRegitem[itemnombre] 	= $itemnombre;
	$iRegitem[itemcanmin] 	= $itemcanmin;
	$iRegitem[itemcanmax] 	= $itemcanmax;
	$iRegitem[itemvalor] 	= $itemvalor;
	$iRegitem[itemnota] 	= $itemnota;
	$iRegitem[itemdispon] 	= $itemdispon;
	grabaitem($iRegitem,$flageditaritem, $campnomb, $itemcodigo);

	if(!$flageditaritem)
	{
		include('grabaitemproveedo.php');
		unset($arreglo_aux);
		echo '<script language="javascript">'."\n";
		echo '<!--//'."\n";
		echo "location='maestablitemtemp.php?codigo=".$codigo."'";
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

	$flageditaritem = 1;
	$campnomb["proveeselec"] = 1;
}
?>