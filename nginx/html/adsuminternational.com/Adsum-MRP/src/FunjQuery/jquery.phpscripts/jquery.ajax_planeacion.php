<?php 
ini_set('display_errors', 1);
	if(!$noAjax):
		include '../../FunPerSecNiv/fncsqlrun.php';
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblpadreitem.php';
		include '../../FunPerPriNiv/pktblformulacion.php';
		include '../../FunPerPriNiv/pktblitemdesa.php';
	endif;
	//validacion de estructura completa tabla2
	if($arrtabla2)
	{
?>
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td width="45%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Material</td>
		<td width="5%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Cal.</td>
		<td width="5%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;A1</td>
		<td width="5%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Gra.</td>
		<td width="5%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;%</td>
		<td width="5%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Refile</td>
		<td width="10%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Ancho (mm)</td>
		<td width="7%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;(kgs)</td>
		<td width="8%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;(mts)</td>
	</tr>
<?php
		//se explosiona el array tabla 1 por el comodin {:|:}
		$array_tmp = explode(':|:',$arrtabla2);	
		//se valida el array de formulacion y se explosiona por el comodin {,}
		if($formulcodigo) $arr_formul = explode(',',$formulcodigo);	
		//conexion
		$idcon = fncconn();
		//se recorre el array explosionado de la estructura
		for($a = 0; $a < count($array_tmp); $a++)
		{
			//se vuelve y explosina el registro por el comodin {:-:} obtenes los registros necesarios.
			$rwArray_tmp = explode(':-:', $array_tmp[$a]);
			//se explosiona el registro 4 de la explosion anterior la cual contiene a informacion de los adhesivos 
			$rwArray_tmp_adh = explode(',',$rwArray_tmp[4]);
			//se consulta por el registro 1 que contiene el codigo del padreitem el cual es consultado en su respectiva tabla
			$rwItem = loadrecordpadreitem($rwArray_tmp[1],$idcon);
			//variables a utilizar en la explosion
			$obj_cant_kgs = 'cant_kgs_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];//cantidad de kilogramos necesarios del item o material
			$obj_cant_mts = 'cant_mts_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];//cantidad de metros necesarios del item o material
			$obj_ancho_ideal = 'ancho_ideal_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];//ancho ideal para impresion y/o laminacion			
			$obj_calib_a1 = 'calib_a1_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];//calibre alterno de la estructura
			$obj_refile_mm = 'refile_mm_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];//refile material de la estructura
			$obj_formul_ = 'form_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];//formulacion que tiene asignada el material en caso de ser extruido
			//----------------
			$obj_calibre = 'calibre_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];//calibre del item o material
			$obj_densid = 'densid_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];//densidad del material 
			$obj_porcen = 'porcen_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];//porcentaje de participacion en la estructura
			$obj_gramaje = 'gramaje_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];//gramaje del item o material
			$obj_kgs_pv = 'kgs_pv_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];//kilogramos necesarios para el pedido de venta
			//valor de los objetos
			$$obj_calibre = $rwArray_tmp[3];
			$$obj_calib_a1 = (!$$obj_calib_a1)? $$obj_calibre : $$obj_calib_a1;
			$$obj_densid = $rwArray_tmp[2];
			$$obj_gramaje = ($$obj_calib_a1 * $$obj_densid);
			$$obj_porcen = (($$obj_gramaje) / $totalgramaje);
			$$obj_refile_mm = (!$$obj_refile_mm)? 0 : $$obj_refile_mm ;
			//validacion de error para no peder el valor de la cantidad planeada
			$cantplanea = (!$cantplanea)? $cant_planea : $cantplanea;
			//porcentaje de participacion del item en la estructura
			//----------------------------------------------------------------------------
			//----------------------------------------------------------------------------				
			/*
			if($product_imp == $rwArray_tmp[1])
			{
				$refile = $rwItem['paditeflexo'];
			}
			else
			{
				for($h=0;$h<$valid_produc_imp;$h++){
					$obj_produclam = "product_lam_".($h +1);
					if($$obj_produclam == $rwArray_tmp[1])
						$refile = $rwItem['paditelamind'];
				}
			}
			*/
			//----------------------------------------------------------------------------
			//----------------------------------------------------------------------------				
			//evento especial para ancho ideal en productos {bolsa flow pack} 
			//echo 'ancho = '.$ancho.' traslape = '.$traslape.' fuelle ='.$fuelle;
			if($tipitecodigo == 1)
			{
				$$obj_ancho_ideal = (  ( ($ancho + $traslape + $fuelle) * 2)  * $nropistas);
				$anchoproceso = ( ($ancho + $traslape + $fuelle) * 2);
			}
			//evento especial para ancho ideal en productos {bolsa doy pack, bolsa lateral, bolsa pouch lateral}
			if($tipitecodigo == 2 || $tipitecodigo == 3 || $tipitecodigo == 4)
			{
				$$obj_ancho_ideal = ( ( ($largo + $fuelle) * 2) * $nropistas );
				$anchoproceso = ( ($largo + $fuelle) * 2);
			}
			//evento especial para ancho ideal en productos {capuchon}
			if($tipitecodigo == 5)
			{
				$$obj_ancho_ideal = ( ( ($largo + $pestania) * 2) * $nropistas);
				$anchoproceso = ( ($largo + $pestania) * 2);
			}
			//evento especial para ancho ideal en productos {lamina} 
			if($tipitecodigo == 6)
			{
				$$obj_ancho_ideal = ($ancho * $nropistas);
				$anchoproceso = $ancho;
			}
			$$obj_ancho_ideal = $$obj_ancho_ideal + $$obj_refile_mm;//suma de refile
			//se adiciono la correcion de el calculo de el peso millar de  los capuchones
			unset($estructura_n); ($arrtabla2)? $estructura_n = count(explode(':|:',$arrtabla2)) : $estructura_n = 1;
			//validacion para pedidos de venta con unidad de medida en millaras {mil}
			if($unimedi == 'MIL')
			{
				//evento de calculo de kilogramos en productos {bolsa flow pack}
				if($tipitecodigo == 1)			
					$$obj_kgs_pv = $cantplanea * ((round(((($solapa / 1000) + ($largo / 1000 * 2) + ($solapa / 1000 * 2) + ($fuelle / 1000 * 2)) * (($ancho / 1000) * $totalgramaje))*100) / 100) / 2);
				//evento de calculo de kilogramos en productos {bolsa lateral, bolsa pouch lateral, bolsa pouch doy pack, lamina}
				if($tipitecodigo== 2 || $tipitecodigo== 3 || $tipitecodigo== 4 || $tipitecodigo== 6)
					$$obj_kgs_pv = $cantplanea * (round(((($solapa / 1000) + ($largo / 1000 * 2) + ($solapa / 1000 * 2) + ($fuelle / 1000 * 2)) * (($ancho / 1000) * $totalgramaje))*100) / 100);
				//evento de calculo de kilogramos en productos {capuchon}
				if($tipitecodigo == 5)
					$$obj_kgs_pv = $cantplanea * (((((($bmayor / 1000) + ($bmenor / 1000)) / 2) * ((($largo / 1000 ) * 2) + ($pestania / 1000 ) * 2)) *  ($totalgramaje / $estructura_n)));
				//evento de calculo de cantidad del item en kilogramos
				$$obj_cant_kgs = $$obj_kgs_pv * $$obj_porcen;
				if($$obj_ancho_ideal > 0)
					$$obj_cant_kgs = $$obj_cant_kgs + ( ($$obj_refile_mm / $$obj_ancho_ideal) * $$obj_cant_kgs);
			}
			//validacion para pedidos de venta con unidad de medida en unidades {und}
			if($unimedi == 'UND')
			{
				//evento de calculo de kilogramos en productos {bolsa flow pack}
				if($tipitecodigo == 1)			
					$$obj_kgs_pv = ($cantplanea / 1000) * ((round(((($solapa / 1000) + ($largo / 1000 * 2) + ($solapa / 1000 * 2) + ($fuelle / 1000 * 2)) * (($ancho / 1000) * $totalgramaje))*100) / 100) / 2);
				//evento de calculo de kilogramos en productos {bolsa lateral, bolsa pouch lateral, bolsa pouch doy pack}
				if($tipitecodigo== 2 || $tipitecodigo== 3 || $tipitecodigo== 4)
					$$obj_kgs_pv = ($cantplanea / 1000) * (round(((($solapa / 1000) + ($largo / 1000 * 2) + ($solapa / 1000 * 2) + ($fuelle / 1000 * 2)) * (($ancho / 1000) * $totalgramaje))*100) / 100);
				//evento de calculo de kilogramos en productos {capuchon}
				if($tipitecodigo == 5)
					$$obj_kgs_pv = ($cantplanea / 1000) * (((((($bmayor / 1000) + ($bmenor / 1000)) / 2) * ((($largo / 1000 ) * 2) + ($pestania / 1000 ) * 2)) *  $totalgramaje));
				//evento de calculo de kilogramos en productos {lamina}
				if($tipitecodigo == 6)
					$$obj_kgs_pv = ( ( ( ($ancho / 1000) * ($largo / 1000) ) * $totalgramaje ) * $cantplanea) / 1000;
				//evento de calculo de cantidad del item en kilogramos
				$$obj_cant_kgs = $$obj_kgs_pv * $$obj_porcen;
				if($$obj_ancho_ideal > 0)
					$$obj_cant_kgs = $$obj_cant_kgs + ( ($$obj_refile_mm / $$obj_ancho_ideal) * $$obj_cant_kgs);
			}
			//validacion para pedidos de venta con unidad de medida en kilogramos {kgs}
			if($unimedi == 'KGS')
			{
				//evento de calculo de cantidad del item en kilogramos
				$$obj_cant_kgs = $cantplanea * $$obj_porcen;
				if($$obj_ancho_ideal > 0)
					$$obj_cant_kgs = $$obj_cant_kgs + ( ($$obj_refile_mm / $$obj_ancho_ideal) * $$obj_cant_kgs);
			}
			//se valida que el ancho ideal sea mayor a zero para no generar error de division por zero
			//evento de calculo de cantidad del item en metros
			if($$obj_ancho_ideal > 0)
				$$obj_cant_mts = $$obj_cant_kgs /  ($$obj_ancho_ideal * $$obj_gramaje) * 1000000;
			//filtro de division para marteriales extruidos para mostrar su respectiva formulacion.
			if($rwItem['paditeextrui'] == 't')
			{
?>
	<tr>
		<td width="45%" class="NoiseFooterTD">&nbsp;<?php echo $rwItem['paditenombre'] ?>&nbsp;(EXTRUIDO) </td>
		<td width="5%" class="NoiseFooterTD">&nbsp;<?php echo $$obj_calibre ?></td>
		<td width="5%" class="NoiseFooterTD">&nbsp;<input type="text" name="<?php echo $obj_calib_a1 ?>" id="<?php echo $obj_calib_a1 ?>" value="<?php echo $$obj_calib_a1 ?>" size="3" onchange="accionReloadAjax_planeacion();" /></td>
		<td width="5%" class="NoiseFooterTD">&nbsp;<?php echo $$obj_gramaje ?></td>
		<td width="5%" class="NoiseFooterTD">&nbsp;<?php echo round(($$obj_porcen * 100) * 100)/ 100 ?></td>
		<td width="5%" class="NoiseFooterTD">&nbsp;<input type="text" name="<?php echo $obj_refile_mm ?>" id="<?php echo $obj_refile_mm ?>" value="<?php echo $$obj_refile_mm ?>" size="3" onchange="accionReloadAjax_planeacion();" /></td>
		<td width="10%" class="NoiseFooterTD">&nbsp;<input type="hidden" name="<?php echo $obj_ancho_ideal ?>" id="<?php echo $obj_ancho_ideal ?>" value="<?php echo $$obj_ancho_ideal ?>" /><?php echo $$obj_ancho_ideal ?></td>
		<td width="7%" class="NoiseFooterTD">&nbsp;<input type="hidden" name="<?php echo $obj_cant_kgs ?>" id="<?php echo $obj_cant_kgs ?>" value="<?php echo $$obj_cant_kgs ?>"/><?php echo round($$obj_cant_kgs * 100) / 100 ?> </td>
		<td width="8%" class="NoiseFooterTD">&nbsp;<input type="hidden" name="<?php echo $obj_cant_mts ?>" id="<?php echo $obj_cant_mts ?>" value="<?php echo $$obj_cant_mts?>" /><?php echo round($$obj_cant_mts * 100) / 100 ?></td>
	</tr>
<?php 
				//se valida que el array de formulacion contega formula para el material
				if($arr_formul[$a] != '---' && $arr_formul[$a]!= '')
				{
					//se carga la formuolacion
					$rwItem = loadrecordformulacion($arr_formul[$a], $idcon);
					//variables a usar para la formulacion
					$$obj_formul_ = $rwItem['formulcodigo'];//codigo de la formulacion a explosionar
?>
	<tr>
		<td colspan="9">
			<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" >
				<tr>
					<td width="70%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Resina [ Formula <?php echo '{'.$rwItem['formulnumero'].'} - '.$rwItem['formulfecha'] ?>] <?php echo $arr_formul[$a] ?><input type="hidden" name="<?php echo $obj_formul_ ?>" id="<?php echo $obj_formul_ ?>" value="<?php echo $$obj_formul_ ?>" /></td>
					<td width="10%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;%</td>
					<td width="15%" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Cant. (kgs)</td>
				</tr>
<?php 		
					//se crea sql para organizar la formulacion por capas y el porcetaje de participacion de cada capa		
					$sql = 
						"SELECT DISTINCT(iteforcapa),itedescodigo,SUM(iteforporcen) 
							AS iteforporcen 
							FROM itemformul 
							WHERE formulcodigo = '$arr_formul[$a]' 
							GROUP BY iteforcapa,itedescodigo ORDER BY iteforcapa";
					//se ejecuta el sql
					$rsItemformul = fncsqlrun($sql,$idcon);
					//se consulta el numero de resgistros de la consulta
					$nrItemformul = fncnumreg($rsItemformul);
					//se recorre la respuesta de la consulta
					for($i = 0;$i<$nrItemformul;$i++)
					{
						//se extrae uno de la consulta con su respectivo indice
						$rwItemformul = fncfetch($rsItemformul,$i);
						//consultamos el item o resina del listado de items
						$rwItemdesa = loadrecorditemdesa($rwItemformul['itedescodigo'],$idcon);
						//objetos a utilizar
						$objPorcen = 'iteforporcen_'.$rwItemformul['itedescodigo'];//porcentaje del item en la capa
						$objCapa = 'formulcapa'.strtolower($rwItemformul['iteforcapa']);//capa del item
						$$objPorcen = $$objPorcen + (($rwItemformul['iteforporcen'] / 100) * ($rwItem[$objCapa] / 100));
					}
					//se crea sql para traer los items que se involicran en la formulacion
					$sql = "SELECT DISTINCT(itedescodigo) FROM itemformul WHERE formulcodigo ='$arr_formul[$a]'";
					//se ejecuta la consulta
					$rsItemformul = fncsqlrun($sql,$idcon);
					//se consulta el numero de resgistro de la consulta
					$nrItemformul = fncnumreg($rsItemformul);
					//se recorre la respuesta de la consulta
					for($i = 0;$i<$nrItemformul;$i++)
					{
						($i % 2) ? $complement = ' class="NoiseDataTD" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"' : $complement = ' class="NoiseFooterTD" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';
						//se extrae uno de la consulta con su respectivo indice
						$rwItemformul = fncfetch($rsItemformul,$i);
						//consultamos el item o resina del listado de items
						$rwItemdesa = loadrecorditemdesa($rwItemformul['itedescodigo'],$idcon);
						//variables a utilizar
						$objPorcen = 'iteforporcen_'.$rwItemformul['itedescodigo'];//porcentaje del item en la capa
?>
				<tr>
					<td width="70%" class="NoiseFooterTD">&nbsp;<?php echo $rwItemdesa['itedesnombre'] ?> </td>
					<td width="10%" class="NoiseFooterTD">&nbsp;<?php echo $$objPorcen * 100 ?></td>
					<td width="15%" class="NoiseFooterTD">&nbsp;<?php echo number_format(round(($$objPorcen * $$obj_cant_kgs) * 100 ) / 100 ,  2, ',', '.')?></td>
				</tr>
<?php 
					}
?>
			</table>
		</td>
	</tr>
<?php 				
				}
			
			}
			//validacion cuando el material no es extruido y diferente de tintas ya que no son necesarias
			if($rwItem['paditeextrui'] == 'f' && $rwItem['paditecodigo'] != 25)
			{
?>
	<tr>
		<td width="45%" class="NoiseFooterTD">&nbsp;<?php echo $rwItem['paditenombre'] ?><?php if($rwArray_tmp_adh[1]){ echo ($rwArray_tmp_adh[1])? '|&nbsp;DESEMPE&Ntilde;O ('.strtoupper($rwArray_tmp_adh[1]).')' : '-------' ;}?>&nbsp;<?php if($rwArray_tmp_adh[2]){echo ($rwArray_tmp_adh[2])? '|&nbsp;TIPO ('.strtoupper($rwArray_tmp_adh[2]).')' : '-------' ;}?></td>
		<td width="5%" class="NoiseFooterTD">&nbsp;<?php echo $$obj_calibre ?></td>
		<td width="5%" class="NoiseFooterTD">&nbsp;<input type="text" name="<?php echo $obj_calib_a1 ?>" id="<?php echo $obj_calib_a1 ?>" value="<?php echo $$obj_calib_a1 ?>" size="3" onchange="accionReloadAjax_planeacion();" /></td>
		<td width="5%" class="NoiseFooterTD">&nbsp;<?php echo $$obj_gramaje ?></td>
		<td width="5%" class="NoiseFooterTD">&nbsp;<?php echo round(($$obj_porcen * 100) * 100)/ 100 ?></td>
		<td width="5%" class="NoiseFooterTD">&nbsp;<input type="text" name="<?php echo $obj_refile_mm ?>" id="<?php echo $obj_refile_mm ?>" value="<?php echo $$obj_refile_mm ?>" size="3" onchange="accionReloadAjax_planeacion();" /></td>
		<td width="10%" class="NoiseFooterTD">&nbsp;<input type="hidden" name="<?php echo $obj_ancho_ideal ?>" id="<?php echo $obj_ancho_ideal ?>" value="<?php echo $$obj_ancho_ideal ?>" /><?php echo $$obj_ancho_ideal ?></td>
		<td width="7%" class="NoiseFooterTD">&nbsp;<input type="hidden" name="<?php echo $obj_cant_kgs ?>" id="<?php echo $obj_cant_kgs ?>" value="<?php echo $$obj_cant_kgs ?>"/><?php echo round($$obj_cant_kgs * 100) / 100 ?> </td>
		<td width="8%" class="NoiseFooterTD">&nbsp;<input type="hidden" name="<?php echo $obj_cant_mts ?>" id="<?php echo $obj_cant_mts ?>" value="<?php echo $$obj_cant_mts ?>" /><?php echo round($$obj_cant_mts * 100) / 100 ?> </td>
	</tr>
<?php	
			}
		} 
?>
</table>
<?php 
	}
	else
	{
		//lo estrucutura no tiene materiales
?>
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td width="100%" class="NoiseFooterTD">&nbsp;Sin Sustrato</td>
	</tr>
</table>	
<?php 
	}
?>
<input type="hidden" name="anchoproceso" id="anchoproceso" value="<?php echo $anchoproceso ?>" />