<?php 
	if(!$noAjax):
		include '../../FunPerSecNiv/fncconn.php';
		include '../../FunPerSecNiv/fncclose.php';
		include '../../FunPerSecNiv/fncnumreg.php';
		include '../../FunPerSecNiv/fncfetch.php';
		include '../../FunPerPriNiv/pktblcalendario.php';
		include '../../FunPerPriNiv/pktblcuadrilla.php';
		include '../../FunPerPriNiv/pktblcuadrillausuario.php';
		include '../../FunPerPriNiv/pktblusuario.php';
		include '../../FunPerPriNiv/pktblcargo.php';
		include '../../FunPerPriNiv/pktblusuanovedad.php';
		include '../../FunPerPriNiv/pktblestadonoveda.php';
	endif;
	
	function verificaNovedad($usuacodi, $fecha, &$novedad, &$rep)
	{
		if($fecha):
			$recUsuaNovedad = array('usuacodi' => $usuacodi, 'usunovfecini' => $fecha, 'usunovfecfin' => $fecha);
			$recopUsuaNovedad = array('usuacodi' => '=', 'usunovfecini' => '<=', 'usunovfecfin' => '>=');
			
			$idcon = fncconn();
			$rs_novedad = dinamicscanopusuanovedad($recUsuaNovedad, $recopUsuaNovedad, $idcon);
			$nr_novedad = fncnumreg($rs_novedad);
	
			if($nr_novedad > 0):
				$rw_novedad = fncfetch($rs_novedad, 0);
				$rs_estadonoveda = loadrecordestadonoveda($rw_novedad['estnovcodigo'], $idcon);
				
				if($rs_estadonoveda['estnovactusu']):
					$novedad = "Inactivo: ".utf8_encode($rs_estadonoveda['estnovnombre']); 
					$rep = '-';
				else:
					$novedad = "Activo: ".utf8_encode($rs_estadonoveda['estnovnombre']); 
					$rep = '+';
				endif;
				
				return true;
			else:
				return false;
			endif;
		else:
			return false;
		endif;
	}
	
	
	function innerHTML($fecini, $fecfin, $rs_usuario, $usualider, $index, $noAjax, $typesource, $idcon)
	{ 
		if(!verificaNovedad($rs_usuario['usuacodi'], $fecini, $novedad, $rep)):
			if(!verificaNovedad($rs_usuario['usuacodi'], $fecfin, $novedad, $rep)):
				$novedad = "Activo";
				$rep = '+';
			endif;
		endif;
		
		//===== Config HTML =====
		
		if($index % 2)
			$complement = ' class="NoiseDataTD" id="fila'.$index.'" onmouseover="setClassHover(this)" onmouseout="setClassIn(this)"';
		else
			$complement = ' class="NoiseFooterTD" id="fila'.$index.'" onmouseover="setClassHover(this)" onmouseout="setClassOut(this)"';

			
		if($typesource != 'user' && $rep == '+')	
			$complement .= ' onclick="showWindow('."'{$rs_usuario['usuacodi']}'".');"'; 
			
		if($rs_usuario['cargocodigo'])
			$rs_cargo = loadrecordcargo($rs_usuario['cargocodigo'], $idcon);	
			
		echo '<tr'.$complement.'>'."\n";
		
		if($typesource != 'user')
			echo '<td width="30" style=" border-bottom: 1px solid #fff;">&nbsp;<b>'.$rep.'</b></td>'."\n";
		else
			echo '<td width="30" style=" border-bottom: 1px solid #fff;"><input type="checkbox" name="chklsttecnicoot" id="chklsttecnicoot" onclick="setSelectionRow(this.value, '."document.getElementById('lsttecnicoot').value, ',', 'lsttecnicoot'".');" value="'.$rs_usuario['usuacodi'].'"></td>'."\n";

		if($noAjax):
			echo '<td width="299" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;" class="adm-ui-row-list">&nbsp;'.$rs_usuario['usuanombre'].' '.$rs_usuario['usuapriape'].' '.$rs_usuario['usuasegape'].'</td>'."\n";
			echo '<td width="249" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;" class="adm-ui-row-list">&nbsp;'.$rs_cargo['cargonombre'].'</td>'."\n";
		else:
			echo '<td width="299" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;" class="adm-ui-row-list">&nbsp;'.$rs_usuario['usuanombre'].' '.$rs_usuario['usuapriape'].' '.$rs_usuario['usuasegape'].'</td>'."\n";
			echo '<td width="249" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;" class="adm-ui-row-list">&nbsp;'.$rs_cargo['cargonombre'].'</td>'."\n";
		endif;
		
		echo '<td width="113" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;" class="adm-ui-row-list">&nbsp;'.$novedad.'</td>'."\n";
		
		if($typesource != 'user'):
			echo '<td width="69" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;';
			if($usualider == $rs_usuario['usuacodi'])
				echo "SI";
			echo '</td>'."\n";
		else:
			echo '<td width="69" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;<input type="radio" name = "opt" id = "opt" value="'.$rs_usuario['usuacodi'].'"';
			
			if($usualider == $rs_usuario['usuacodi'])
				echo " checked ";
			echo ' onclick="document.getElementById('."'usualider'".').value = this.value;"></td>'."\n";
		endif;
		echo '</tr>'."\n";
	}

	
	
	
	if($typesource == 'cuadrilladet' || $typesource == 'userdet'):	
		unset($arrallsttecnicoot)
?>
<div style="width:611px; height: 18px; margin:0 auto;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">	
			<tr>
				<td width="25" class="ui-state-default estilo2">Sel</td>
				<td width="400" class="ui-state-default estilo2">Nombre</td>
				<td width="50" class="ui-state-default estilo2">Enc.</td>
				<td width="11" class="ui-state-default estilo2">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

<div style="width:511px; height: 150px; margin:0 auto; overflow:auto;" class="ui-widget-content">
	<div style="width:494px; height: auto;" id="listatecnicos">
		<table width="100%" border="0" cellspacing="1" cellpadding="1"  align="center">
<?php 
		if($iRegArray):
			$idcon = fncconn();
			$rs_cuadrillausuario = loadrecordcuadrillausuariousuario($iRegArray, $idcon);
		
			if($arrlsttecnicoot)
			{
				$array_tmp = explode(',',$arrlsttecnicoot);
				$array_key = array_flip($array_tmp);
			}
			
			for($a = 0; $a < count($rs_cuadrillausuario); $a++):
				$rs_usuario = loadrecordusuario($rs_cuadrillausuario[$a]['usuacodi'], $idcon);
				
				if(is_array($array_key))
				{
					unset($swth_sel);
					
					if(array_key_exists($rs_usuario['usuacodi'], $array_key))
						$swth_sel = ' checked';
				}
				
				
				if($arrallsttecnicoot)
					$arrallsttecnicoot .= ','.$rs_usuario['usuacodi'];
				else
					$arrallsttecnicoot = $rs_usuario['usuacodi'];
				
				//===== Config HTML =====
				if($a % 2)
					$complement = ' class="NoiseDataTD"';
				else
					$complement = ' class="NoiseFooterTD"';
			
			
				echo '<tr'.$complement.'>'."\n";
				echo '<td width="25"><input type="checkbox" name="chklsttecnicoot" id="chklsttecnicoot"'.$swth_sel.' onclick="setSelectionRow(this.value, '."document.getElementById('arrlsttecnicoot').value, ',', 'lsttecnicoot'".');" value="'.$rs_usuario['usuacodi'].'"></td>'."\n";
				echo '<td width="402" class="adm-ui-row-list">&nbsp;'.$rs_usuario['usuanombre'].' '.$rs_usuario['usuapriape'].' '.$rs_usuario['usuasegape'].'</td>'."\n";
				echo '<td width="48">&nbsp;';
				if($rs_cuadrillausuario[$a]['cuausulider'] == 't')
					echo "SI";
				'</td></tr>'."\n";
			endfor;			
		endif;

		if($a < 9):
			for($b = $a; $b < 9; $b++):
			
				if($b % 2)
					$class = "NoiseDataTD";
				else
					$class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="25">&nbsp;</td>
				<td width="402">&nbsp;</td>
				<td width="48">&nbsp;</td>
			</tr>
<?php
			endfor;
		endif;	
?>
		</table>
		<input type="hidden" name="arrallsttecnicoot" id="arrallsttecnicoot" value="<?php echo $arrallsttecnicoot; ?>">
	</div>
</div>
<?php 
 	else:
?>
<div style="width:778px; height: 14px; margin:0 auto;" class="ui-state-default">
	<div style="width:100%; height: auto;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">	
			<tr>
				<td width="30" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Sel</td>
				<td width="300" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Nombre</td>
				<td width="250" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Cargo</td>
				<td width="113" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Estado</td>
				<td width="70" class="ui-state-default" style="border-top:0; border-bottom:0; border-left:0;">&nbsp;Encargado</td>
				<td width="15" class="ui-state-default" style="border:0;">&nbsp;</td>
			</tr>
		</table>
	</div>
</div>

<div style="width:778px; height: 150px; margin:0 auto; overflow:auto; border-top:0;" class="ui-widget-content">
	<div style="width:759px; height: auto;" id="listatecnicos">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"  align="center">
<?php 
		if($iRegArray):
			$idcon = fncconn();
		
			if($typesource != 'user'):	
				$rs_cuadrillausuario = loadrecordcuadrillausuariousuario($iRegArray, $idcon);
		
				for($a = 0; $a < count($rs_cuadrillausuario); $a++):
					$rs_usuario = loadrecordusuario($rs_cuadrillausuario[$a]['usuacodi'], $idcon);
					
					if($rs_cuadrillausuario[$a]['cuausulider'] == 't')
						$usualider = $rs_cuadrillausuario[$a]['usuacodi'];
					
					innerHTML($fecini, $fecfin, $rs_usuario, $usualider, $a, $noAjax, $typesource, $idcon);
				endfor;			
			else:
				$array_key_tec = explode(',', $iRegArray); 
				
				for($a = 0; $a < count($array_key_tec); $a++):
					$rs_usuario = loadrecordusuario($array_key_tec[$a], $idcon);
				
					if($rs_usuario > 0)
						innerHTML($fecini, $fecfin, $rs_usuario, $usualider, $a, $noAjax, $typesource, $idcon);
				endfor;				
			endif;
		endif;
	
		if($a < 13):
			for($b = $a; $b < 13; $b++):
			
				if($b % 2)
					$class = "NoiseDataTD";
				else
					$class = "NoiseFooterTD";
?>
			<tr class="<?php echo $class ?>">
				<td width="30" style=" border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="299" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="249" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="113" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
				<td width="69" style="border-left: 1px solid #fff; border-bottom: 1px solid #fff;">&nbsp;</td>
			</tr>
<?php
			endfor;
		endif;	
?>
		</table>
	</div>
</div>
<?php 
		if($typesource && $typesource != 'user'): 
			$idcon = fncconn();
			$rs_cuadrilla = loadrecordcuadrilla($iRegArray, $idcon);
			
			
			if(!$fecfin || $fecini == $fecfin)
				$recopCalendario = array('cuadricodigo' => '=', 'calendfecini' => '=');
			else
			{
				$fecfin = date("Y-m-d", strtotime($fecfin.' + 1 days'));
				$recopCalendario = array('cuadricodigo' => '=', 'calendfecini' => '>=', 'calendfecfin' => '<=');	
			}
			$recCalendario = array('cuadricodigo' => $rs_cuadrilla['cuadricodigo'], 'calendfecini' => $fecini, 'calendfecfin' => $fecfin);
			$rs_calendario = dinamicscanopcalendario($recCalendario, $recopCalendario, $idcon);
			
			$nr_calendario = fncnumreg($rs_calendario);
			
//			if($nr_calendario > 0)
//				$rw_calendario = fncfetch($rs_calendario, 0);
?>
<table width="778px" border="0" cellspacing="1" cellpadding="1" align="center" style="margin-top: 2px;" class="ui-widget-content">	
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Cuadrilla</td>
		<td width="80%" class="NoiseDataTD">&nbsp;<?php echo $rs_cuadrilla['cuadrinombre'] ?></td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Jornada</td>
		<td width="80%" class="NoiseDataTD">
		<?php 
			if($nr_calendario):
				for($a = 0; $a < $nr_calendario; $a++):
					$rw_calendario = fncfetch($rs_calendario, $a);
					echo '&nbsp;'.$rw_calendario['calendfecini']." De ".date("h:i a", strtotime($rw_calendario['calendhorini']))." a ".date("h:i a", strtotime($rw_calendario['calendhorfin']));

					if(($a + 1) < $nr_calendario)
						echo '<br>';
				endfor;
			else: 
				echo "&nbsp;No se encontro jornada asignada"; 
			endif; 
		?>
		</td>
	</tr>
</table>
<?php 
		endif; 
	endif; 
?>	