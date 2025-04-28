<?php 
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncclose.php');
include ( '../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerSecNiv/fncfetch.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktblcomponen.php');
include ( '../src/FunPerPriNiv/pktblitem.php');
include ( '../src/FunPerPriNiv/pktbloperacio.php');
include ( '../src/FunPerPriNiv/pktbltipomant.php');
include ( '../src/FunPerPriNiv/pktblpriorida.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');
include ( '../src/FunPerPriNiv/pktbltipotrab.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
?> 
<html> 
<head> 
<title>Consultar en ot</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
<script language="JavaScript" src="motofech.js"></script> 
<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js" type="text/javascript" ></SCRIPT>
<script language=JavaScript src="../src/FunGen/cargarSistema.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarEquipos.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarComponen.js" type="text/javascript" ></script>
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body onload="focus();" bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Orden de trabajo</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE"> 
<tr>
	<td width="708" class="NoiseErrorDataTD">&nbsp;</td>
</tr>
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF"> 
Consultar registro</font></span></td></tr> 
<tr> 
  <td> 
     <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
     <tr>
     <td>
     <TABLE width="97%" border="0" cellspacing="0" cellpadding="0" align="center">             
     <tr>
	 <td colspan="6">&nbsp;</td>
	</tr>
	 <tr>
	 <td>C&oacute;digo</td> 
	 <td><input type="text" name="ordtracodigo" size="10"></td>
     <td align="left">Fecha:&nbsp;<input type="text" name="ordtrafecgen" onfocus="if(!agree)this.blur();" size="10">&nbsp;
     <img src="../img/cal.gif" alt="Calendario" border="0" onclick="window.open('formcalendario.php?calencodigo=ordtrafecgen','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
	</tr>
		<tr>
			<td colspan="6"><hr></td>
		</tr>
	 </TABLE> 
	 </td>
	 </tr>
  <tr>
	<td colspan="8">
	 <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
		  <td>Planta</td>
		  <td colspan="2">Sistema</td>
		  <td colspan="2">Equipo</td>
		  <td>Componente</td>
		</tr>
<tr>
  <td>
    <select name="plantacodigo" onchange="cargarSistemas(this.value);">
     <option value="">Seleccione</option>
	    <?php
			include ('../src/FunGen/floadplanta.php');
			$idcon = fncconn();
			floadplanta($sbreg['plantacodigo'],$idcon);
			fncclose($idcon);
		?>
	</select>
 </td>
 <td colspan="2">
    <select name="sistemcodigo" onchange="cargarEquipos(this.value);">
     <option value="">Seleccione</option>
	</select>
</td>
  <td colspan="2">
            <select name="equipocodigo"  onchange="cargarComponen(this.value);">
             <option value="">Seleccione</option>
           </select>
</td>
  <td>
            <select name="componcodigo">
             <option value="">Seleccione</option>
            </select>
</td>
 </tr>
		<tr>
  			<td colspan = "6">&nbsp;</td>
		</tr>
		<tr>
			<td>Tipo de mantenimiento</td>
			<td>
			<select name="tipmancodigo">
             <option value="">Seleccione</option>
				<?php
					include ('../src/FunGen/floadtipomant.php');

					$idcon = fncconn();
					floadtipomant($sbreg['tipmancodigo'],$idcon);
					fncclose($idcon);
				?>
			</select>
			</td>
			<td>&nbsp;</td>
			<td align="right">Prioridad&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td colspan="">
			<select name="prioricodigo">
             <option value="">Seleccione</option>
			<?php
				include ('../src/FunGen/floadpriorida.php');
				
				$idcon = fncconn();
				floadpriorida($sbreg['prioricodigo'],$idcon);
				fncclose($idcon);
			?>
			</select></td>
 			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Descripci&oacute;n del da&ntilde;o del equipo</td>
 			<td colspan="5"><textarea name="ordtradescri" cols="41" rows="3" wrap="VIRTUAL"></textarea></td>
		</tr>
		<tr>
			<td>Fecha de inicio</td>
            <td colspan="2"><input name="ordtrafecini" onfocus="if(!agree)this.blur();" type="text"	size="10" maxlength="10">&nbsp;
            <img src="../img/cal.gif" alt="Calendario" border="0" onclick="window.open('formcalendario.php?calencodigo=ordtrafecini','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
			</td>
            <td><div align="right">Hora inicio&nbsp;</div></td>
			<td colspan="3"><input name="hora" type="text"	size="5" maxlength="5">&nbsp;HH:MM</td>
		</tr>
  		<tr>
 			<td>Fecha de fin</td>
  			<td colspan="2"><input name="ordtrafecfin" type="text" onfocus="if(!agree)this.blur();" size="10" maxlength="10">&nbsp;
  			<img src="../img/cal.gif" alt="Calendario" border="0" onclick="window.open('formcalendario.php?calencodigo=ordtrafecfin','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
			</td>
	        <td><div align="right">Hora fin&nbsp;</div></td>
            <td colspan="3"><input name="ordtrahorfin" type="text" size="5" maxlength="5">&nbsp;HH:MM</td>
		</tr>
		<tr>
			<td colspan="6"><hr></td>
		</tr>
		<tr>
      <td colspan="2">Colaborador de mantenimiento&nbsp;&nbsp;&nbsp;
        <input name="radio1" type="radio" onclick="window.open('consultarusuarioot.php?codigo=<?php echo $codigo?>','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent">
        </td>
        <td align="right">C&oacute;digo&nbsp;&nbsp;</td>
        <td>
        <input name="empleacod" type="text" onfocus="this.blur();" size="8">
        </td>
      <td colspan="2">Nombre 
      <input  name="empleanomb" type="text" size="25" onFocus="this.blur();"></td>
      <td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="6"><hr></td>
		</tr>
		<tr>
   		<td>Tipo de trabajo</td>
    		<td colspan="2">
    		<select name="tiptracodigo">
             <option value="">Seleccione</option>
				<?php
					include ('../src/FunGen/floadtipotrab.php');
					
					$idcon = fncconn();
					floadtipotrab($sbreg['tiptracodigo'],$idcon);
					fncclose($idcon);
				?>
        	</select>
		</td>
		<td>Tarea</td>
          	<td>
          	<select name="tareacodigo">
             <option value="">Seleccione</option>
				<?php
					include ('../src/FunGen/floadtarea.php');

					$idcon = fncconn();
					floadtarea($sbreg['tareacodigo'],$idcon);
					fncclose($idcon);
				?>
     		</select>
		</td>
        	<td colspan="3">&nbsp;</td>
    	</tr>
	</table></td>
</tr>
</table> 
  </td> 
 </tr> 
 <tr> 
  <td >&nbsp;</td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionconsultarvistaot.value =  1; form1.action='maestablvistaotregla.php';"  
width="86" height="18" alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="window.close();"  width="86" height="18" alt="Cancelar" 
border=0>
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
<input type="hidden" name="flagconsultarvistaot" value="1"> 
<input type="hidden" name="accionconsultarvistaot"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="columnas" value="ordtracodigo, 
ordtrafecgen, 
plantacodigo,
sistemcodigo,
equipocodigo,
componcodigo,
tipmancodigo, 
prioricodigo,
ordtradescri, 
ordtrafecini, 
ordtrahorini, 
ordtrafecfin, 
ordtrahorfin, 
usuacodi, 
tiptracodigo,
tareacodigo,
usutarcodigo
">
<input type="hidden" name="nombtabl" value="vistaot">
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html>