<?php
	include ( '../src/FunGen/sesion/fncvalsesion.php');
	include ( '../src/FunPerPriNiv/pktblvistabandejaot.php');
	include ( '../src/FunPerPriNiv/pktbltarea.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktbltipomant.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktbltipocomponen.php');
	include ( '../src/FunPerPriNiv/pktblcomponen.php');
	include ( '../src/FunPerPriNiv/pktbltipotrab.php');
	include ( '../src/FunPerPriNiv/pktbltipomedi.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');
	include ( '../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunGen/cargainput.php');

	if($alldata){
		$selall= "checked";}
?>
<html>
	<head>
		<title>Detalle bandeja de ordenes programadas</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF8">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.addlistavisor.js"></script>
		<script LANGUAGE="JavaScript">
			/**
			 *
		 	 *
	 	 	 */
			function selall_reg(selall)
			{
				if(selall.checked == true)
				{
					var chkObject = document.getElementsByName('chkselstar');
					var new_arreglo = new Array;
					
					for(var m = 0; m < chkObject.length; m++)
					{
						chkObject[m].checked = true;
	
						if (new_arreglo == "")
							new_arreglo = chkObject[m].value;	
						else
							new_arreglo = chkObject[m].value + "," + new_arreglo;
					}
					window.parent.document.form1.allarr_bandejatmp.value = '1';
				}
				else
				{
					var chkObject = document.getElementsByName('chkselstar');
					var new_arreglo = new Array;
					
					for(var m = 0; m < chkObject.length; m++)
					{
						chkObject[m].checked = false;
					}
					window.parent.document.form1.allarr_bandejatmp.value = '';
				}
				document.form1.arr_detall.value = new_arreglo;
				window.parent.document.form1.arr_bandeja.value = new_arreglo;
			}
			
			/**
			 *
		 	 *
	 	 	 */			
			function verificaall()
			{
				var chkObject = document.getElementsByName('chkselstar');
				
				for(var m = 0; m < chkObject.length; m++)
				{
					if(chkObject[m].checked == false)
					{
						var out = 1;
						 break;
					}
				}
				if(out)
				{
					document.form1.chkselall.checked = false;
					window.parent.document.form1.allarr_bandejatmp.value = '';
				}
				else
				{
					document.form1.chkselall.checked = true;
					window.parent.document.form1.allarr_bandejatmp.value = '1';
				}
			}
			
			/**
			 *
		 	 *
	 	 	 */		
			function delitemdata(data, arreglo)
			{
				var enc = 0;
				var new_arreglo ="";
				
				arreglogen = arreglo.split(",");
			
				if (arreglogen != "")
				{
					for(var i=0; i < (arreglogen.length); i++)
					{
						if (arreglogen[i] == data)
							enc = 1;
						else
						{
							if( arreglogen[i] != '')
							{
								if (new_arreglo == '')
									new_arreglo = arreglogen[i];
								else
									new_arreglo = new_arreglo + "," + arreglogen[i];
							}
						}	
					}
				}
							
				if (enc == 0) 
				{
					if (new_arreglo == "")
						new_arreglo = data;	
					else
						new_arreglo = data + "," + new_arreglo;
				}
				
				document.form1.arr_detall.value = new_arreglo;
				window.parent.document.form1.arr_bandeja.value = new_arreglo;
	
				if(document.form1.chkselall != undefined )
					verificaall();
			}
		</script>
		<style type="text/css"> 
			body {
				margin-left: 0px;
				margin-top: 0px;
				margin-right: 0px;
				margin-bottom: 0px;
			}
			.ui-state-default, .cont-line { font-size:88%; }
		</style>
	</head>
	<body bgcolor="FFFFFF" text="#000000">

		<form name="form1" method="post"  enctype="multipart/form-data">
	  		<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center">
    			<tr>
					<td  class="ui-state-default" width="3%"  align="center"><b>SEM</b></td> 
					<td  class="ui-state-default" width="4%"  align="center">Sel.<input type="checkbox" name="chkselall" value="0" onclick="selall_reg(this);" ></td> 
					<td class="ui-state-default" width="4%"  align="center">Num. OT</td>
					<td class="ui-state-default" width="6%"  align="center">Fecha ejecuci&oacute;n</td>
					<td class="ui-state-default" width="5%"  align="center">Cod. Equipo</td>
					<td class="ui-state-default" width="5%"  align="center">Tarea</td>
					<td class="ui-state-default" width="18%"  align="center">Equipo/Componente</td>
					<td class="ui-state-default" width="5%"  align="center">Tipo de trabajo</td>
					<td class="ui-state-default" width="30%"  align="center">Descripcion</td>
					<td class="ui-state-default" width="4%"  align="center">Dur. OT.</td>
					<td class="ui-state-default" width="6%"  align="center">Frecuencia</td>
				</tr>
				<?php
					include_once '../src/FunPerSecNiv/fncsqlrun.php';
					$idconn = fncconn();
					$fecFiltro = date("Y-m").'-01';
					
					$sbSql = "SELECT vistabandejaot.* FROM vistabandejaot WHERE vistabandejaot.ordtrafecini >= '{$fecFiltro}'";
					
					($plantacodigo == 'all' || !$plantacodigo) ? $sbSql .= " AND vistabandejaot.plantacodigo IN ({$usuaplanta})": $sbSql .= "";
					($plantacodigo != 'all' && $plantacodigo) ? $sbSql .= " AND vistabandejaot.plantacodigo IN ({$plantacodigo})": $sbSql .= "";
					($sistemcodigo) ? $sbSql .= " AND vistabandejaot.sistemcodigo = '{$sistemcodigo}'": $sbSql .= "";
					($equipocodigo) ? $sbSql .= " AND vistabandejaot.equipocodigo = '{$equipocodigo}'": $sbSql .= "";
					($tiptracodigo) ? $sbSql .= " AND vistabandejaot.tiptracodigo = '{$tiptracodigo}'": $sbSql .= "";
					(!$tiptracodigo && $usuatipotrab) ? $sbSql .= " AND vistabandejaot.tiptracodigo IN ({$usuatipotrab})" : $sbSql .= "";
					($tareacodigo) ? $sbSql .= " AND vistabandejaot.tareacodigo = '{$tareacodigo}'": $sbSql .= "";
					$rsVistabandejaot = fncsqlrun($sbSql, $idconn);
					$nrVistabandejaot = fncnumreg($rsVistabandejaot);
					
					if($nrVistabandejaot > 0):
						if($arr_data):
							$array_tmp = explode(',', $arr_data);
							$array_key = array_flip($array_tmp);
						endif;

						$arr_week = array();
						$arr_numreg_week = array();
						$swth_sel = "";
						$cont = 0;
						
						for($a = 0; $a < $nrVistabandejaot; $a++):
							$rwVistabandejaot = fncfetch($rsVistabandejaot, $a);
							unset($swth_sel);
							
							if($alldata):
								$swth_sel = 1;
							else:
								if(is_array($array_key)):
									if(array_key_exists($rwVistabandejaot[0], $array_key))
										$swth_sel = 1;
								endif;
							endif;	
				
							$num_week = date("W",strtotime($rwVistabandejaot[12]));
							$arr_numreg_week[$num_week] ++;
				
							if($arr_numreg_week[$num_week] > 1):
								if (($a % 2) == 0)
									$arr_week[$num_week] .= '<tr class="NoiseFooterTD">'."\n";
								else
									$arr_week[$num_week] .= '<tr class="NoiseDataTD">'."\n";
							endif;
					
							$arr_week[$num_week] .= '<td>'."\n";
							$arr_week[$num_week] .= '<input type="checkbox" name="chkselstar"  value="'.$rwVistabandejaot[0].'" ';
				
							if($swth_sel):
								$arr_week[$num_week] .= 'checked ';
								$cont ++;
							
								if($arr_detall)
									$arr_detall .= ','.$rwVistabandejaot[0]; 
								else
									$arr_detall = $rwVistabandejaot[0]; 
							endif;

							$arr_week[$num_week] .= 'onclick = "delitemdata(this.value,document.form1.arr_detall.value);" >'."\n";
							$arr_week[$num_week] .= '</td>'."\n";
				
							$nombequipo = cargaequiponombre($rwVistabandejaot[3], $idconn);
							$nombcomponentemp = "/No se asign&oacute; a componente";
				
							if($rwVistabandejaot[tipcomcodigo]){
								$nombcomponentemp = cargatipocomponen($rwVistabandejaot[tipcomcodigo], $idconn);}

							$nombcomponen = $nombequipo . "/" . $nombcomponentemp;
				
							$arr_week[$num_week] .= '<td class="cont-line">&nbsp;'.$rwVistabandejaot[0].'</td>'."\n";
							$arr_week[$num_week] .= '<td class="cont-line">&nbsp;'.$rwVistabandejaot[12].'</td>'."\n";
							$arr_week[$num_week] .= '<td class="cont-line">&nbsp;'.$rwVistabandejaot[3].'</td>'."\n";
							$arr_week[$num_week] .= '<td class="cont-line">&nbsp;'.cargatareanombre1($rwVistabandejaot[1], $idconn).'</td>'."\n";
							$arr_week[$num_week] .= '<td class="cont-line">&nbsp;'.$nombcomponen.'</td>'."\n";
							$arr_week[$num_week] .= '<td class="cont-line">&nbsp;'.cargadetalleprogtiptrab($rwVistabandejaot[5], $idconn ).'</td>'."\n";
							$arr_week[$num_week] .= '<td class="cont-line">&nbsp;'.$rwVistabandejaot[2].'</td>'."\n";
							$arr_week[$num_week] .= '<td class="cont-line" align="center">&nbsp;'.$rwVistabandejaot[6].' hr(s). </td>'."\n";
							$arr_week[$num_week] .= '<td class="cont-line" align="center">&nbsp;'.$rwVistabandejaot[7].'&nbsp;&nbsp;&nbsp;'.cargatipmnombre($rwVistabandejaot[8], $idconn).'</td>'."\n";
							$arr_week[$num_week] .= '</tr>'."\n";
						endfor;
						
						$a = 0;
						foreach ($arr_week as $key => $value):
							if (($a % 2) == 0)
								echo '<tr class="NoiseFooterTD">' . "\n";
							else
								echo '<tr class="NoiseDataTD">' . "\n";
						
							echo '<td rowspan="'.$arr_numreg_week[$key].'" align="center"><b>'.$key.'</b></td>';
							echo $value;
							$a++;
						endforeach;
					endif;
					
					if ($nrVistabandejaot < 14):
						for($a = $nrVistabandejaot; $a <= 14; $a ++): 
							if (($a % 2) == 0) 
								echo '<tr class="NoiseFooterTD"><td height="20px">&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td></tr>'."\n";
							else 
								echo '<tr class="NoiseDataTD"><td height="20px">&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td></tr>'."\n";
						endfor;
					endif;
				?>
	  		</table>
	  		<script language="JavaScript">
  			<?php if($cont == $nrVistabandejaot && $nrVistabandejaot > 0): ?>						
				document.form1.chkselall.checked = true;
			<?php endif; ?>
				window.parent.document.getElementById('activite').innerHTML = '<?php echo $nrVistabandejaot.' ot(s)'; ?>';
			</script>	
	  		<input type="hidden" name="arr_detall" value="<?php echo $arr_detall ?>">
		  	<input type="hidden" name="arr_delitem" value="<?php echo $arr_delitem; ?>">
			<input type="hidden" name="allregister" value="<?php echo $alldata; ?>">
		</form> 
	</body>
</html>