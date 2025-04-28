<?php 
include ( '../src/FunGen/fnctimecmp.php');
include ( '../src/FunPerPriNiv/pktblitem.php');
include ( '../src/FunPerPriNiv/pktbltransacitem.php');
include ( '../src/FunPerPriNiv/pktbltransacherramie.php');
include ( '../src/FunPerPriNiv/pktblherramie.php');
include ( '../src/FunPerPriNiv/pktblitemtareot.php');
include ( '../src/FunPerPriNiv/pktbltareotherramie.php');

function borraot($ordtracodigo)
{
	$nuconn = fncconn();
	$sbregotarot["ordtracodigo"] = $ordtracodigo;
	$sbregot = dinamicscantareot($sbregotarot,$nuconn);
	$nuCantRow = fncnumreg($sbregot);
	
	if($nuCantRow < 2)
	{
		$arr_ot = loadrecordot($ordtracodigo, $nuconn);
		$arr_ot['ordtraacti'] = 0;

		$result = uprecordot($arr_ot, $nuconn);

		if($result < 0)
		{
			ob_end_clean();
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'alert("El registro no se puede eliminar porque se encuentra en uso")';
			echo '//-->'."\n";
			echo '</script>';
		}
		if($result > 0)
		{
			/* Trae datos desde TAREOT */
			$iRegtareot['ordtracodigo'] = $arr_ot['ordtracodigo'];
			$idres_tareot = dinamicscantareot($iRegtareot, $nuconn);

			if(!is_numeric($idres_tareot))
			{
				$num_tareot = fncnumreg($idres_tareot);

				for($i=0; $i<$num_tareot; $i++)
				{
					$arr_tareot = fncfetch($idres_tareot, $i);

					if($arr_tareot['ordtracodigo'] == $iRegtareot['ordtracodigo'])
					{
						// - - Si existen items relacionados con la OT
						$iRegitemtareot['tareotcodigo'] = $arr_tareot['tareotcodigo'];
						$idres_itemtareot = dinamicscanitemtareot($iRegitemtareot, $nuconn);

						if(!is_numeric($idres_itemtareot))
						{
							$num_itemtareot = fncnumreg($idres_itemtareot);

							for($j=0; $j<$num_itemtareot; $j++)
							{
								$arr_itemtareot = fncfetch($idres_itemtareot, $j);

								if($arr_itemtareot['tareotcodigo'] == $iRegitemtareot['tareotcodigo'])
								{
									$arr_transacitem = loadrecordtransacitem($arr_itemtareot['transitecodigo'], $nuconn);
									$arr_item = loadrecorditem($arr_transacitem['itemcodigo'], $nuconn);
									$cantidad_i = $arr_item['itemdispon'] + $arr_transacitem['transitecantid'];
									$arr_item['itemdispon'] = $cantidad_i;

									$arr_i[] = $arr_item;
									$arr_ti[] = $arr_transacitem;
									$flaginsite = true;
								}
							}
						}
						// - - -

						// - - -Si existen herramientas relacionadas con la OT
						$iRegtareotherramie['tareotcodigo'] = $arr_tareot['tareotcodigo'];
						$idres_tareotherramie = dinamicscantareotherramie($iRegtareotherramie, $nuconn);

						if(!is_numeric($idres_tareotherramie))
						{
							$num_tareotherramie = fncnumreg($idres_tareotherramie);

							for($j=0; $j<$num_tareotherramie; $j++)
							{
								$arr_tareotherramie = fncfetch($idres_tareotherramie, $j);

								if($arr_tareotherramie['tareotcodigo'] == $iRegtareotherramie['tareotcodigo'])
								{
									$arr_transacherramie = loadrecordtransacherramie($arr_tareotherramie['transhercodigo'], $nuconn);
									$arr_herramie = loadrecordherramie($arr_transacherramie['herramcodigo'], $nuconn);
									$cantidad_h = $arr_herramie['herramdispon']+$arr_transacherramie['transhercanti'];
									$arr_herramie['herramdispon'] = $cantidad_h;

									$arr_h[] = $arr_herramie;
									$arr_th[] = $arr_transacherramie;
									$flaginsher = true;
								}
							}
						}
						// - - -
						if(($flaginsher) || ($flaginsite))
						{
							settransacvalue($arr_ti, $arr_th, $arr_i, $arr_h);
						}
						break;
					}
				}
			}
			echo '<script language="javascript">';
			echo '<!--//'."\n";
			echo 'alert("Borrado exitoso");';
			echo 'location ="maestablot.php?codigo='.$codigo.';"';
			echo '//-->'."\n";
			echo '</script>';
		}
	}
	else
	{
		echo '<script language="Javascript">'."\n";
		echo '<!--//'."\n";
		echo 'alert("El registro no se puede eliminar ya que la orden de trabajo ha sido ejecutada");'."\n";
		echo '//-->'."\n";
		echo '</script>';
	}
	fncclose($nuconn);
}
borraot($ordtracodigo);

function settransacvalue($arr_transacitem, $arr_transacherramie, $arr_item, $arr_herramie)
{
	if(isset($arr_transacitem))
	{
		include('grabatransacitem.php');
		include('editaitem.php');
	}
	
	if(isset($arr_transacherramie))
	{
		include('grabatransacherramie.php');
		include('editaherramie.php');
	}
}
?>