<?php 
session_start();
	include('../src/FunPerSecNiv/fncconn.php');
	include('../src/FunPerSecNiv/fncclose.php');
	include('../src/FunPerSecNiv/fncfetch.php');
	include('../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunPerPriNiv/pktblplanta.php');
	include ( '../src/FunPerPriNiv/pktblsistema.php');
	include ( '../src/FunPerPriNiv/pktblestado.php');
	include ( '../src/FunPerPriNiv/pktblcentcost.php');
	//if(!$flagconsultarequipo)
		//$usuacodigo = null;
$GLOBALS[usuaplanta] = $usuplantas;
?> 
<html> 
	<head> 
		<title>Consultar en equipo</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<SCRIPT LANGUAGE="JavaScript"> 
			<!-- Begin 
			agree = 0; 
			//  End --> 
		</script> 
		<script language="JavaScript" src="motofech.js"></script> 
		<script language=JavaScript src="../src/FunGen/prototype162.js" type="text/javascript" ></script>
		<SCRIPT src="../src/FunGen/aches.js" type="text/javascript"></SCRIPT>
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
	<body bgcolor="FFFFFF" text="#000000"> 
		<form name="form1" method="post"  enctype="multipart/form-data"> 
			<p><font class="NoiseFormHeaderFont">Equipo</font></p> 
			<table border="0" cellspacing="1" cellpadding="1" align="center" class="NoiseFormTABLE" width="80%"> 
  				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  				<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Consultar registro</font></span></td></tr> 
				<tr> 
  					<td> 
        						<table width="95%" border="0" cellspacing="1" cellpadding="0" align="center">
          						<!--DWLayoutTable-->
							<tr>
								<td width="20%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td>
								<td width="30%" class="NoiseFooterTD"><input name="equipocodigo" type="text"	value="<?php echo $equipocodigo; ?>" size="14"> </td>
								<td width="20%" class="NoiseFooterTD">&nbsp;Codigo SRF</td>
								<td width="30%" class="NoiseFooterTD"><input name="codigosrf" type="text"	value="<?php echo $codigosrf; ?>" size="20"></td>
							</tr>
							<tr>
					            		<td width="20%" class="NoiseFooterTD">&nbsp;Nombre</td>
					            		<td colspan="3" class="NoiseFooterTD"><input name="equiponombre" type="text"	value="<?php echo $equiponombre; ?>" size="50"></td>
          							</tr>
							<tr> 
								<td class="NoiseFooterTD"><input name="radio1"  type="button" onClick="window.open('consultarusuariequipo.php?codigo=<?php echo $codigo?>','usuariequipo','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" value="Mantenedor" alt="Cancelar" width="86" height="18" border=0 href="#" target="_parent"></td>
								<td class="NoiseFooterTD" colspan="3"><input name="usuanombre" type="text"	value="<?php echo $usuanombre; ?>" size="50" onFocus="if (!agree)this.blur();"></td>
							</tr>
          							<tr> 	
            							<td class="NoiseFooterTD">&nbsp;Estado</td>
            							<td class="NoiseFooterTD" colspan="3"><select name="estadocodigo">
              								<option value ="">Seleccione</option>
              								<?php
										include ('../src/FunGen/floadestado.php');
										$idcon = fncconn();
										floadestado($estadocodigo,$idcon);
										fncclose($idcon);
									?>
            							</select></td>
          							</tr>
							<tr> 
            							<td class="NoiseFooterTD">&nbsp;Planta / Sistema</td>
            							<td colspan="3" class="NoiseFooterTD"><select name="sistemcodigo" id="sistema">
              								<option value ="">Seleccione</option>
              								<?php
										include ('../src/FunGen/floadsistema.php');
										$idcon = fncconn();
										floadsistema($sistemcodigo,$idcon);
										fncclose($idcon);
									?>
            							</select>
            							 <IMG 
      onclick="filtradorselect('sistema') ; " 
      src="filter.png" border=0>
      <SCRIPT type=text/javascript>
				Event.observe($('sistema'),'keyup', function(f){ if (f.keyCode==113)filtradorselect('sistema')} );
				
				</SCRIPT>
            							</td>
          							</tr>
          							<tr> 
            							<td class="NoiseFooterTD">&nbsp;Centro de costo</td>
            							<td class="NoiseFooterTD" colspan="3"> <select name="cencoscodigo" id="censo">
                								<option value ="">Seleccione</option>
                								<?php
										include ('../src/FunGen/floadcentcost.php');
										$idcon = fncconn();
										floadcentcost($cencoscodigo,$idcon);
										fncclose($idcon);
									?>
              							</select>
              							 <IMG 
      onclick="filtradorselect('censo') ; " 
      src="filter.png" border=0>
      <SCRIPT type=text/javascript>
				Event.observe($('censo'),'keyup', function(f){ if (f.keyCode==113)filtradorselect('censo')} );
				
				</SCRIPT>
              							 </td>
          							</tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
							<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
          							<tr> 
          								<td class="NoiseFooterTD">&nbsp;Fabricante</td>
            							<td class="NoiseFooterTD"><input name="equipofabric" type="text"	value="<?php echo $equipofabric; ?>" size="20"></td>
            							<td class="NoiseFooterTD">&nbsp;Marca</td>
            							<td class="NoiseFooterTD"><input name="equipomarca" type="text"	value="<?php echo $equipomarca; ?>" size="20"> </td>
          							</tr>
          							<tr> 
          								<td class="NoiseFooterTD">&nbsp;Modelo</td>
            							<td class="NoiseFooterTD">  <input name="equipomodelo" type="text"	value="<?php echo $equipomodelo; ?>" size="20"> </td>
            							<td class="NoiseFooterTD">&nbsp;No. serie</td>
            							<td class="NoiseFooterTD"><input name="equiposerie" type="text"	value="<?php echo $equiposerie; ?>" size="20"> </td>
          							</tr>
          							<tr> 
            							<td class="NoiseFooterTD">&nbsp;No. inventario</td>
            							<td class="NoiseFooterTD"><input name="equipocinv" type="text"	value="<?php echo $equipocinv; ?>" size="20"> </td>          							
            							<td class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td>
            							<td class="NoiseFooterTD"><input name="equipoubicac" type="text"	value="<?php echo $equipoubicac; ?>" size="20"> </td>

          							</tr>
          							<tr> 
            							<td class="NoiseFooterTD">&nbsp;Vida &uacute;til</td>
            							<td class="NoiseFooterTD"><input name="equipoviduti" type="text"	value="<?php echo $equipoviduti; ?>" size="17"> </td>
            							<td class="NoiseFooterTD">&nbsp;Fecha compra</td>
            							<td class="NoiseFooterTD"><input type="text" name="equipofeccom"	value="<?php echo $equipofeccom; ?>" size="14" onFocus="if(!agree) this.blur();">&nbsp;<img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=equipofeccom','calendar','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
          							</tr>
          							<tr> 
          								<td class="NoiseFooterTD">Fec. instalaci&oacute;n</td>
            							<td class="NoiseFooterTD"><input type="text" name="equipofecins"	value="<?php echo $equipofecins; ?>" size="14" onFocus="if(!agree) this.blur();">&nbsp;<img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=equipofecins','calendar','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
            							<td class="NoiseFooterTD">&nbsp;Venc. garant&iacute;a</td>
            							<td class="NoiseFooterTD"><input type="text" name="equipovengar"	value="<?php echo $equipovengar; ?>" size="14" onFocus="if(!agree) this.blur();">&nbsp;<img src="../img/cal.gif" border="0" onClick="window.open('formcalendario.php?calencodigo=equipovengar','calendar','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
          							</tr>
          							<tr>
								<td class="NoiseFooterTD">&nbsp;NPAS </td>
								<td class="NoiseFooterTD"><input name="equiponpas" type="text"	value="<?php echo $equiponpas; ?>" size="20"></td>
								<td class="NoiseFooterTD"><!--DWLayoutEmptyCell-->&nbsp;</td>
								<td class="NoiseFooterTD"><!--DWLayoutEmptyCell-->&nbsp;</td>
          							</tr>
          							<tr> 
            							<td class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td>
            							<td colspan="3" rowspan="2"> <textarea name="equipodescri" rows="3" wrap="VIRTUAL" cols="40"><?php echo $equipodescri; ?></textarea></td>
          							</tr>
          							<tr><td class="NoiseFooterTD"  >&nbsp;</td></tr>
        						</table>  
  					</td> 
 				</tr> 
 				<tr> 
					<td> 
						<div align="center"> 
  							<input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.accionconsultarequipo.value =  1; form1.action='maestablequipogen.php';"  width="86" height="18" alt="Aceptar" border=0> 
  							<input type="image" name="cancelar" src="../img/cancelar.gif" onclick=" window.close();"  width="86" height="18" alt="Cancelar" border=0> 
						</div> 
					</td> 
 				</tr> 
 				<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
			</table> 
	 		<input name="usuacodigo" type="hidden"	value="<?php if(!$flagconsultarequipo){ echo $usuacodigo;} else {echo $usuacodigo;} ?>" size="8">
	 		<input type="hidden" name="flagconsultarequipo" value="1"> 
			<input type="hidden" name="accionconsultarequipo"> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">  
			<input type="hidden" name="columnas" value="equipocodigo, 
estadocodigo, 
sistemcodigo, 
cencoscodigo, 
equiponombre, 
equipodescri, 
equipofabric, 
equipomarca, 
equipomodelo, 
equiposerie, 
equipolargo, 
equipoancho, 
equipoalto, 
equipopeso, 
equipovolta, 
equipocorrie, 
equipopoten, 
equipofeccom, 
equipocinv, 
equipovengar, 
equipoviduti, 
equipofecins, 
equipoubicac, 
equipovalhor, 
equiponohs, 
equipoacti, 
equipotipo, 
equiponpas 
"> 
			<input type="hidden" name="nombtabl" value="equipo"> 
			<input type="hidden" name="usuequcodigo" value="<?php echo $usuequcodigo; ?>"> 
		</form> 
	</body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html> 
