<?php 
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktblcomponen.php');
	include ( '../src/FunPerPriNiv/pktblparte.php');
	include ( '../src/FunPerPriNiv/pktblcausafalla.php');
	include ( '../src/FunPerPriNiv/pktbltipofall.php');
	
	$idcon = fncconn();
?> 
<html> 
	<head> 
		<title>Consultar en Planta</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<script language="JavaScript" src="motofech.js"></script> 
		<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
		<script language=JavaScript src="../src/FunGen/cargarSistema.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarEquipos.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarComponen.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarParte.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/cargarFallaPlanta.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunGen/fncbparaprodton.js" type="text/javascript" ></script>
		<script language=JavaScript src="../src/FunSpec/fncshowspanparaprod.js" type="text/javascript" ></script>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Paradas de produccci&oacute;n</font></p> 
			<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE" width="850"> 
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
                        <table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
							<tr> 
 								<td width="25%" class="NoiseFooterTD">&nbsp;N&uacute;mero parada</td> 
  								<td colspan="3" class="NoiseDataTD"><input type="text" name="parprocodigo"	value="<?php echo $parprocodigo; ?>"></td> 
 							</tr> 
 							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Planta</td>
							  	<td colspan="3" class="NoiseDataTD">
							    	<select name="plantacodigo" onChange="cargarSistemas(this.value);">
							    		<option value = "">Seleccione</option>
                                  		<?php
											include ('../src/FunGen/floadplanta.php');
											floadplanta($plantacodigo,$idcon);
										?>
                                	</select>
								</td>
							</tr>
							<tr>
								<td width="25%" class="NoiseFooterTD">&nbsp;Sistema</td>
								<td colspan="3" class="NoiseDataTD">
									<select name="sistemcodigo" onChange="cargarEquipos(this.value);">
										<option value = "">Seleccione</option>
          								<?php
											include ('../src/FunGen/floadsistemaot.php');
											floadsistemaot($sistemcodigo,$plantacodigo,$idcon);
            							?>
									</select>
								</td>
							</tr>
          					<tr>
          						<td class="NoiseFooterTD">&nbsp;Equipo&nbsp;</td>
								<td class="NoiseDataTD" colspan="3">
									<select name="equipocodigo"  onChange=" LoadDetalleequipo(this.value,'<?php echo $GLOBALS['usuaplanta']; ?>'); cargarComponen(this.value); ">
										<option value = "">Seleccione</option>
            							<?php
											include ('../src/FunGen/floadequipoot.php');
											floadequipoot($equipocodigo, $sistemcodigo,$idcon);
		    							?>
									</select>
								</td>
							</tr>
          					<tr>
								<td class="NoiseFooterTD">&nbsp;Componente&nbsp;</td>
								<td class="NoiseDataTD" colspan="3">
									<select name="componcodigo" onChange="LoadDetallecomponen(this.value,'<?php echo $GLOBALS['usuaplanta']; ?>');">
            							<option value = "">Seleccione</option>
		    							<?php
											include ('../src/FunGen/floadcomponenequi.php');
											floadcomponenequi($componcodigo,$equipocodigo,$idcon);
										?>
       								</select>
								</td>
							</tr>
							<tr>
								<td class="NoiseFooterTD">&nbsp;Causa de Falla</td>
								<td class="NoiseDataTD" width="30%">
									<select name="caufallcodigo">
                                  		<option value = "">Seleccione</option>
										<?php
											include ('../src/FunGen/floadcausafalla.php');
											floadcausafalla($caufallcodigo,$idcon);
										?>
                                	</select>
                                </td>
								<td colspan="2"  class="NoiseFooterTD">&nbsp;Fecha de inicio
									<input type="text" name="parprofecini" size="8" value="<?php echo $parprofecini; ?>" onFocus="if (!agree)this.blur();">&nbsp;
	              					<img src="../img/cal.gif" align="absmiddle" border="0" onClick="window.open('formcalendario.php?calencodigo=parprofecini','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
								</td>
        					</tr>
						</table> 
  					</td> 
 				</tr> 
 				<tr> 
					<td><div align="center"> 
  						<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accionconsultarparaprod.value =  1; form1.action='maestablparaprod.php';"  width="86" height="18" alt="Aceptar" border=0> 
  						<input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='maestablparaprod.php';"  width="86" height="18" alt="Cancelar" border=0> 
					</div></td> 
 				</tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
 			<input type="hidden" name="flagconsultarparaprod" value="1"> 
			<input type="hidden" name="accionconsultarparaprod"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
			<input type="hidden" name="columnas" value="parprocodigo,
parprofecgen,
parprohorgen,
equipocodigo,
sistemcodigo,
plantacodigo,
partecodigo,
componcodigo,
parprodescri,
parprofecini,
parprohorini,
parprofecfin,
parprohorfin,
usuacodi,
servicicodigo,
tipfalcodigo,
caufallcodigo,
tiptracodigo
"> 
			<input type="hidden" name="nombtabl" value="paraprod"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
