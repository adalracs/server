<?php
ob_start();
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');
	include ( '../src/FunPerSecNiv/fncnumreg.php');
	
ob_end_flush();
	if($alldata)
		$selall= "checked";

?>
<html>
	<head>
		<title>Detalle visor general</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<link rel="stylesheet" type="text/css" href="temas/themes/redmond/jquery.ui.all.css">
		<script type="text/javascript" src="../src/FunjQuery/jquery-1.3.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.addlistavisor.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ajax_comun.js"></script>
		<SCRIPT LANGUAGE="JavaScript">
			function deletedata(data, arreglo)
			{
				var enc = 0;
				var new_arreglo ="";
				
				arreglogen = arreglo.split(",");
				
				if (arreglogen != "")
				{
					for(var i=0; i < (arreglogen.length); i++)
					{
						if (arreglogen[i] == data)
						{
							enc = 1;
						}
						else
						{
							if (new_arreglo == "")
								new_arreglo = arreglogen[i];
							else
								new_arreglo = new_arreglo + "," + arreglogen[i];
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
				document.form1.arr_delitem.value = new_arreglo;
			}
		
			function selall_reg(selall, visors, digito)
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
					window.parent.document.form1.all<?php echo $form_data.$acro; ?>tmp.value = '1';
				}
				else
				{
					var chkObject = document.getElementsByName('chkselstar');
					var new_arreglo = new Array;
					
					for(var m = 0; m < chkObject.length; m++)
						chkObject[m].checked = false;
					
					window.parent.document.form1.all<?php echo $form_data.$acro; ?>tmp.value = '';
				}
				document.form1.arr_detall.value = new_arreglo;
				window.parent.document.form1.<?php echo $form_data.$acro; ?>.value = new_arreglo;

				if(visors != '')
				{
					var vsrObject = visors.split(",");
					
					for(var m = 0; m < vsrObject.length; m++)
						loadvisor(vsrObject[m],new_arreglo,digito);
				}
			}

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
					window.parent.document.form1.all<?php echo $form_data.$acro; ?>tmp.value = '';
				}
				else
				{
					document.form1.chkselall.checked = true;
					window.parent.document.form1.all<?php echo $form_data.$acro; ?>tmp.value = '1';
				}

			}

			
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
						{
							enc = 1;
						}
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
				window.parent.document.form1.<?php echo $form_data.$acro; ?>.value = new_arreglo;

				if(document.form1.chkselall != undefined )
					verificaall();
			}

			function loadvisor(nombvisor, arr_data, digito)
			{
				var subvsrObject = nombvisor.split(":");
				var subindexObject = subvsrObject[0].split("visor");
				var objvariable = window.parent.document.getElementsByName(subindexObject[0])[0].value;
				var objselall = window.parent.document.getElementsByName('all' + subindexObject[0] + 'tmp')[0].value;
				
				//accionLoadBufferFile('<?php echo $usuacodi ?>', window.parent.document.getElementsByName(subvsrObject[0])[1].value, nombvisor, arr_data, digito);

				if(subvsrObject[1] == undefined)
					window.parent.document.getElementById(subvsrObject[0]).src = 'detallarlistasvisor.php?form_data=' + subindexObject[0] + '&digito=' + digito + '&iReg_array=' + arr_data + '&iReg_array2=' + objvariable + '&alldata=' + objselall + '&subvisors=';
				else
					window.parent.document.getElementById(subvsrObject[0]).src = 'detallarlistasvisor.php?form_data=' + subindexObject[0] + '&digito=' + digito + '&iReg_array=' + arr_data + '&iReg_array2=' + objvariable + '&alldata=' + objselall + '&subvisors=' + subvsrObject[1];
			}

			function selencargado(usualider)
			{
				window.parent.document.getElementById('usualider').value = usualider;
			}
		</script>
		<style type="text/css">
			.estilo1 {font-size: 85%; font-family : Arial } 
			body {
				margin-left: 0px;
				margin-top: 0px;
				margin-right: 0px;
				margin-bottom: 0px;
			}	
		</style>
	</head>
	<body bgcolor="White" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<table width="100%" border="0" cellspacing="1" cellpadding="1"  align="center">
			<?php
				include ( '../src/FunGen/fncdetallalistavisor.php');
			
				switch ($form_data) 
				{
					case 'lstzona':
			?>
				<tr>
					<td width="10%" class="ui-state-default">Sel&nbsp;<input type="checkbox" name="chkselall" value="1" onclick="selall_reg(this,'<?php echo $subvisors ?>','<?php echo $digito ?>');" <?php echo $selall ?>></td>
					<td width="40%" class="ui-state-default">Zona</td>
					<td width="40%" class="ui-state-default">Ciudad</td>
				<tr>
			<?php 
						$resource = fnclstzona($iReg_array, $alldata, $digito, $subvisors);
						$new_resource = explode(':?:', $resource);
						$arr_detall = $new_resource[0];
						if($new_resource[1])
							echo '<script language="JavaScript">document.form1.chkselall.checked = true;</script>';
			
						break;
					case 'lstsubzona':
			?>
				<tr>
					<td width="10%" class="ui-state-default">Sel&nbsp;<input type="checkbox" name="chkselall" value="1" onclick="selall_reg(this,'<?php echo $subvisors ?>','<?php echo $digito ?>');" <?php echo $selall ?>></td>
					<td width="40%" class="ui-state-default">Sub Zona</td>
					<td width="40%" class="ui-state-default">Zona</td>
				<tr>
			<?php 
						$resource = fnclstsubzona($iReg_array, $iReg_array2, $alldata, $digito);
						$new_resource = explode(':?:', $resource);
						$arr_detall = $new_resource[0];
						 
						if($new_resource[1])
							echo '<script language="JavaScript">document.form1.chkselall.checked = true;</script>';
				
						break;
					case 'lsttecnico':
			?>
				<tr>
					<td width="10%" class="ui-state-default">Sel</td>
					<td width="40%" class="ui-state-default">Nombre</td>
<!--					<td width="20%" class="ui-state-default">Cargo</td>-->
					<td width="20%" class="ui-state-default">Encargado</td>
					
				<tr>
			<?php 
						fnclsttecnico($iReg_array, $usualider, $alldata);
						$arr_delitem = $iReg_array;
						
						break;
					case 'lsttipequequipo':
			?>
				<tr>
					<td width="10%" class="ui-state-default">Sel</td>
					<td width="90%" class="ui-state-default">Tipo equipo</td>
					
				<tr>
			<?php 
						fnclsttipequequipo($iReg_array, $arrPlanta);
						$arr_delitem = $iReg_array;
						
						break;
					case 'lsttecnicoot':
			?>
				<tr>
					<td width="10%" class="ui-state-default">Sel</td>
					<td width="40%" class="ui-state-default">Nombre</td>
					<td width="20%" class="ui-state-default">Cargo</td>
					<td width="20%" class="ui-state-default">Encargado</td>
					
				<tr>
			<?php 
						$iRegnew_array = fnclsttecnicoot($iReg_array, $typesource, $usualider, $alldata);
						$arr_delitem = $iRegnew_array;
						
						if($typesource == 'cuadrilla')
							echo '<script language="JavaScript">window.parent.document.getElementById("usualider").value = "'.$usualider.'";  window.parent.document.getElementById("lsttecnicoot").value = "'.$iRegnew_array.'";</script>';
						break;
					
					case 'usuaplantas':  //Delitem data
						echo '<tr>'."\n";
						echo '<td width="10%" class="ui-state-default">Sel&nbsp;<input type="checkbox" name="chkselall" value="1" onclick="selall_reg(this,'."'".$subvisors."','".$digito."'".');" '.$selall.' ></td>'."\n";
						echo '<td width="40%" class="ui-state-default">Sede</td>'."\n";
						echo '<td width="40%" class="ui-state-default">Ciudad</td>'."\n";
						echo '<tr>'."\n";
						
						$resource = fncusuaplantas($iReg_array, $alldata, $digito);
						$new_resource = explode(':?:', $resource);
						$arr_detall = $new_resource[0];
						if($new_resource[1])
							echo '<script language="JavaScript">document.form1.chkselall.checked = true;</script>';
						
						break;
					case 'camperdetall':  //Delitem data
						echo '<tr>'."\n";
						echo '<td width="10%" class="ui-state-default">Sel</td>'."\n";
						echo '<td width="90%" class="ui-state-default">Opci&oacute;n</td>'."\n";
						echo '<tr>'."\n";
						
						fnccamperdetall($filename);
						break;
					case 'det_camperdetall':  //Delitem data
						echo '<tr>'."\n";
						echo '<td width="10%" class="ui-state-default">&nbsp;</td>'."\n";
						echo '<td width="90%" class="ui-state-default">Opci&oacute;n</td>'."\n";
						echo '<tr>'."\n";
						
						fncdetcamperdetall($capeeqcodigo);
						
						break;
					case 'usuasistemas':  //Delitem data
						echo '<tr>'."\n";
						echo '<td width="10%" class="ui-state-default">Sel&nbsp;<input type="checkbox" name="chkselall" value="1" onclick="selall_reg(this,'."'".$subvisors."','".$digito."'".');" '.$selall.' ></td>'."\n";
						echo '<td width="40%" class="ui-state-default">Centro de costo</td>'."\n";
						echo '<td width="40%" class="ui-state-default">Sede</td>'."\n";
						echo '<tr>'."\n";
						
						if(ereg('buf',$iReg_array2))
							$iReg_array2 = fncreadbufilevisor($iReg_array2);
						
						$resource = fncusuasistemas($iReg_array, $iReg_array2, $alldata, $digito);
						$new_resource = explode(':?:', $resource);
						$arr_detall = $new_resource[0];
						 
						if($new_resource[1])
							echo '<script language="JavaScript">document.form1.chkselall.checked = true;</script>';
						
						break;
					case 'detalle_pl_sis': //Detalle PlantSIS
						echo '<tr>'."\n";
						echo '<td width="10%" class="ui-state-default">&nbsp;</td>'."\n";
						echo '<td width="40%" class="ui-state-default">Centro de costo</td>'."\n";
						echo '<td width="40%" class="ui-state-default">Sede</td>'."\n";
						echo '<tr>'."\n";
						
						fncdetalle_pl_sis($iReg_array);
						
						break;
				}
			?>
			</table>
		  	<input type="hidden" name="arr_detall" id="arr_detall" value="<?php echo $arr_detall; ?>">
		  	<input type="hidden" name="arr_delitem" id="arr_delitem" value="<?php echo $arr_delitem; ?>">
			<input type="hidden" name="allregister" id="allregister" value="<?php echo $alldata; ?>">
			<input type="hidden" name="fileresource" id="fileresource">
			<input type="hidden" name="usualider" id="usualider">
		</form>
	</body>
</html>