<?php
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');//New 24-feb-2009 asanchez
	include ( '../src/FunPerPriNiv/pktblsistema.php');//New 24-feb-2009 asanchez
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblcomponen.php');

	if (session_is_registered("htmlreport"))
		$_SESSION['htmlreport'] = null;
?>
<html>
	<head>
		<title>Hoja de vida</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_ot.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.cascadebox.js"></script>		
				
		<script type="text/javascript">
			$(function(){
				$("#fecini").datepicker({changeMonth: true,changeYear: true});
				$("#fecini").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#fecini").datepicker($.datepicker.regional['es']);
				
				$("#fecfin").datepicker({changeMonth: true,changeYear: true});
				$("#fecfin").datepicker('option', {dateFormat: 'yy-mm-dd'});
				$("#fecfin").datepicker($.datepicker.regional['es']);
			});


		
			function cascadeCLSBox(objExec)
			{
				switch (objExec){
					case 'plantacodigo':
						accionLoadSelectOff('equipocodigo');
					case 'sistemcodigo':
						accionLoadSelectOff('tipcomcodigo');
					case 'equipocodigo':
						accionLoadSelectOff('componcodigo');
				}

			}
		</script>
		
		<SCRIPT LANGUAGE="JavaScript">
			function carga()
			{
				var flagerror = false;
		
				if (window.document.form1.plantacodigo.value == "")
				{
					alert("Debe Seleccionar una Planta...");
					flagerror = true;
					return false;
				}
		
				if (window.document.form1.sistemcodigo.value == "")
				{
					alert("Debe Seleccionar un Proceso...");
					return false;
				}
	
				if (window.document.form1.fecini.value == "")
				{
					alert("Debe Seleccionar la Fecha de Inicio...");
					return false;
				}
	
				if (window.document.form1.fecfin.value == "")
				{
					alert("Debe Seleccionar la Fecha de Fin...");
					return false;
				}
				else
				{
					document.form1.action = 'detallarhojavidasim.php';
					document.form1.submit();
				}
			}
		</script>
		<script language="JavaScript" src="motofech.js"></script>
		<script language="JavaScript" src="../src/FunGen/jsrsClient.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarSistema.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarEquipos.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarComponen.js" type="text/javascript"></script>
	</head>
<?php if(!$codigo){ echo "<!--";} ?>
	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post"  enctype="multipart/form-data">
			<p><font class="NoiseFormHeaderFont">Hoja de vida</font></p>
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="ui-widget-content" width="70%">
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
				<tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Hoja de Vida</font></span></td></tr>
				<tr>
 					<td>
  						<table width="98%" border="0" cellspacing="1" cellpadding="1" align="center">
   							<tr>
    							<td colspan="2">
    								<p align="center" class="NoiseColumnTD">A continuaci&oacute;n podr&aacute; generar un reporte detallado por equipo.<br>
        							Seleccione un equipo, el periodo y el tipo de reporte a observar</p>
        						</td>
   							</tr>
   							<tr>
          						<td class="NoiseFooterTD" width="20%">&nbsp;Ubicaci&oacute;n</td>
          						<td class="NoiseDataTD" width="80%"><select name="plantacodigo" id="plantacodigo" onChange="accionLoadSelect(this.value, 'sistema', 'sistemcodigo'); cascadeCLSBox('plantacodigo'); setEquCompleteSource();">
          							<option value = "">-- Seleccione --</option>
									<?php
										$idcon = fncconn();
										include ('../src/FunGen/floadplanta.php');
										floadplanta($plantacodigo,$idcon);
									?>
            					</select></td>
          					</tr>
							<tr>          						
          						<td class="NoiseFooterTD">&nbsp;Proceso</td>
            					<td class="NoiseDataTD"><select name="sistemcodigo" id="sistemcodigo" onChange="accionLoadSelect(this.value, 'equipo', 'equipocodigo'); cascadeCLSBox('sistemcodigo'); setEquCompleteSource();">
									<option value = "">-- Seleccione --</option>
            					</select></td>
							</tr>
							<tr>
            					<td class="NoiseFooterTD">&nbsp;Equipo&nbsp;<img onclick = "viewFilter();" src="../img/icon_filter.png" border=0></td>
            					<td class="NoiseDataTD">
            						<div id="selectlist" style="display: block;">
            							<select name="equipocodigo" id="equipocodigo" onChange="accionLoadSelect(this.value, 'componen_', 'tipcomcodigo'); cascadeCLSBox('equipocodigo');">
											<option value = "">-- Seleccione --</option>
										</select>
            						</div>
            						<div id="filtrolist" style="display: none;">
            							<input type="text" size="122" name="equiponombre" id="equiponombre" value="">
            							<input type="hidden" name="equipocodigocmbx" id="equipocodigocmbx" value="">
            							<input type="hidden" name="idusua" id="idusua" value="<?php echo $usuacodi ?>">
            							<input type="hidden" name="filterindex" id="filterindex" value="">
            						</div>
            						<script type="text/javascript">
	            						$("#equiponombre").autocomplete({
	            							source: "../src/FunjQuery/jquery.phpcombobox/jquery.cmbx_equipo.php?id=" + document.getElementById('idusua').value + "&plantacodigo=" + document.getElementById('plantacodigo').value + "&sistemcodigo="  + document.getElementById('sistemcodigo').value,
	            							minLength: 1,
	            							select: function(event, ui) {
	            								ui.item ? document.getElementById('equipocodigocmbx').value = ui.item.id : document.getElementById('equipocodigocmbx').value = "";

	            								cascadeCLSBox('equipocodigo');
	            								accionLoadSelect(ui.item.id, 'componen_', 'tipcomcodigo'); 
	            							}
	            						});
            						</script>
<!--      								<SCRIPT type=text/javascript>Event.observe($('equipocodigo'),'keyup', function(f){ if (f.keyCode==113)filtradorselect('equipocodigo')} );</SCRIPT>	-->
		  						</td>
		  					</tr>
		  					<tr>
		  						<td class="NoiseFooterTD">&nbsp;Sistema</td>
		  						<td class="NoiseDataTD"><select name="tipcomcodigo" id="tipcomcodigo" onchange="accionLoadSelect(this.value, 'componen', 'componcodigo');" >
									<option value = "">-- Seleccione --</option>
          						</select></td>
							</tr>
		  					<tr>
		  						<td class="NoiseFooterTD">&nbsp;Componente</td>
		  						<td class="NoiseDataTD"><select name="componcodigo" id="componcodigo" >
									<option value = "">-- Seleccione --</option>
          						</select></td>
							</tr>
	  						<tr><td colspan="2"><hr></td></tr>
	   						<tr><td colspan="2" class="ui-state-default">&nbsp;Periodo a Observar</td></tr>
	   						<tr>
	    						<td class="NoiseErrorDataTD" colspan="2">
	    							&nbsp;Fecha Inicial&nbsp;<input type="text" name="fecini" id="fecini" size="8">
	    							&nbsp;Fecha Final&nbsp;<input type="text" name="fecfin" id="fecfin" size="8">
	    						</td>
	   						</tr>
	   						<tr><td colspan="2"><hr></td></tr>
	   						<tr>
	    						<td colspan="3">
	     							<CENTER><INPUT type="button" value="   Aceptar   " onClick="return carga();"></CENTER>
	    						</td>
	   						</tr>
	  					</table>
	 				</td>
				</tr>
				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
			</table>
			<input name="codigo" type="hidden" class="NoiseColumnTD" value="<?php echo  $codigo; ?>">
		</form>
	</body>
<?php if(!$codigo){ echo " -->"; } ?>
</html>
