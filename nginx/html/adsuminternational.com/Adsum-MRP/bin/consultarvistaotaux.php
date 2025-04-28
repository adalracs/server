<?php 
//include ( '../src/FunGen/sesion/fncvalses.php');
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
$idcon = fncconn();
$sbregusuario = loadrecordusuario($_SESSION['usuacodi'],$idcon);
fncclose($idcon);
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
	 <td><input type="text" name="ordtracodigo" value="<?php if(!$flagconsultarvistaot){ echo $sbreg[ordtracodigo];}else{ echo $ordtracodigo;} ?>" size="10"></td>
     <td align="left">Fecha:&nbsp;<input type="text" name="ordtrafecgen" onfocus="if(!agree)this.blur();" value="<?php if(!$flagconsultarvistaot){ echo $sbreg[ordtrafecgen];}else{ echo $ordtrafecgen;} ?>" size="10">&nbsp;
     <img src="../img/cal.gif" alt="Calendario" border="0" onclick="window.open('formcalendario.php?calencodigo=ordtrafecgen','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');"></td>
	</tr>
		<tr>
			<td colspan="6"><hr></td>
		</tr>
	 </TABLE> 
	 </td>
	 </tr>
  <tr>
	<td colspan="8"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
		  <td>Centro industrial</td>
		  <td>Taller</td>
		  <td colspan="2">Equipo</td>
		  <td colspan="2">Componente</td>
		</tr>
<tr>
  <td>
            <select name="plantacodigo" onchange="cargarSistemas(this.value);">
            <?php
				if($plantacodigo)
				{
					echo '<option value = "'.$plantacodigo.'">'; 
					$idcon	= fncconn();
					$arrplanta = loadrecordplanta($plantacodigo,$idcon);
					echo $arrplanta[plantanombre];
					fncclose($idcon);
	            	echo '<option value = "">Seleccione'; 
				}
				else
				{
					echo '<option value = "">Seleccione'; 
				}
            ?></OPTION>
            <?php
				include ('../src/FunGen/floadplanta.php');
				$idcon = fncconn();
				floadplanta($idcon);
				fncclose($idcon);
			?></select>
			</td>
  <td>
            <select name="sistemcodigo" onchange="cargarEquipos(this.value);">
            <?php
				if($sistemcodigo)
				{
					echo '<option value = "'.$sistemcodigo.'">'; 
					$idcon	= fncconn();
					$arrsistema = loadrecordsistema($sistemcodigo,$idcon);
					echo $arrsistema[sistemnombre]."</OPTION>";
					include ('../src/FunGen/floadsistema1.php');
					floadsistema1($plantacodigo,$idcon);
					fncclose($idcon);
				}
            ?>
            <option value="">Seleccione</option>
			</select>
</td>
  <td colspan="2">
            <select name="equipocodigo"  onchange="cargarComponen(this.value);">
            <?php
				if($equipocodigo)
				{
					echo '<option value = "'.$equipocodigo.'">'; 
					$idcon	= fncconn();
					$arrequipo = loadrecordequipo($equipocodigo,$idcon);
					echo $arrequipo[equiponombre]."</OPTION>";
					include ('../src/FunGen/floadequipo1.php');
					floadequipo1($sistemcodigo,$idcon);
					fncclose($idcon);
				}
            ?>
            	<option value="">Seleccione</option>
           </select>
</td>
  <td colspan="2">
            <select name="componcodigo">
            <?php
				if($componcodigo)
				{
					echo '<option value = "'.$componcodigo.'">'; 
					$idcon	= fncconn();
					$arrcomponen = loadrecordcomponen($componcodigo,$idcon);
					echo $arrcomponen[componnombre]."</OPTION>";
					include ('../src/FunGen/floadcomponen1.php');
					floadcomponen1($equipocodigo,$idcon);
					fncclose($idcon);
				}
            ?>
            	<option value="">Seleccione</option>
            </select>
</td>
 </tr>
		<tr>
  			<td colspan = "6">&nbsp;</td>
		</tr>
		<tr>
			<td width="16%"><?php if($campnomb == "tipmancodigo"){$tipmancodigo = null; echo "*";}?>Tipo de mantenimiento</td>
			<td width="16%"><select name="tipmancodigo">
				<?php 
     			if($tipmancodigo)
     			{
       				echo '<option value = "'.$tipmancodigo.'">'; 
	        		$idcon	= fncconn();
					$arrtipomant = loadrecordtipomant($tipmancodigo,$idcon);
					echo $arrtipomant[tipmannombre];
					fncclose($idcon);
					echo '<option value = "">Seleccione'; 
			     }else
			     	echo '<option value = "">Seleccione'; 
			     ?></OPTION>
				<?php
					include ('../src/FunGen/floadtipomant.php');
					$idcon = fncconn();
					floadtipomant($idcon);
					fncclose($idcon);
				?>
				</select></td>
			<td width="13%" align="right"><?php if($campnomb == "prioricodigo"){$prioricodigo = null; echo "*";}?>Prioridad&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td width="14%"><select name="prioricodigo">
 			<?php
     			if($prioricodigo)
     			{
       				echo '<option value = "'.$prioricodigo.'">'; 
        			$idcon	= fncconn();
					$arrprioridad = loadrecordpriorida($prioricodigo,$idcon);
					echo $arrprioridad[priorinombre];
					fncclose($idcon);
					echo '<option value = "">Seleccione'; 
     			}else
     				echo '<option value = "">Seleccione'; 
     			?></OPTION>
			<?php
				include ('../src/FunGen/floadpriorida.php');
				$idcon = fncconn();
				floadpriorida($idcon);
				fncclose($idcon);
			?></select></td>
			<td width="14%">&nbsp;</td>
 			<td width="26%">&nbsp;</td>
		</tr>
		<tr>
			<td width="16%"><?php if($campnomb == "ordtradescri"){$ordtradescri = null; echo "*";} ?>Descripci&oacute;n del da&ntilde;o del equipo</td>
 			<td colspan="5"><textarea name="ordtradescri" cols="41" rows="3" wrap="VIRTUAL"><?php if(!$flagconsultarvistaot){echo $sbreg["ordtradescri"];}else{ echo $ordtradescri;}?></textarea></td>
		</tr>
		<tr>
			<td width="16%">Fecha de inicio</td>
            <td colspan="2"><input name="ordtrafecini" onfocus="if(!agree)this.blur();" type="text"	value="<?php if(!$flagconsultarvistaot){echo $sbreg[ordtrafecini];}else{ echo $ordtrafecini;}?>" size="10" maxlength="10">&nbsp;
            <img src="../img/cal.gif" alt="Calendario" border="0" onclick="window.open('formcalendario.php?calencodigo=ordtrafecini','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
			</td>
            <td><div align="right">Hora inicio&nbsp;</div></td>
			<td><input name="hora" type="text"	value="<?php if(!$flagconsultarvistaot){echo $sbreg[ordtrahorini];}else{ echo $ordtrahorini;}?>" size="4" maxlength="4">&nbsp;</td>
            <td colspan="1">&nbsp;<span class="style1">hh:mm</span></td>
		</tr>
  		<tr>
 			<td width="16%">Fecha de fin</td>
  			<td colspan="2"><input name="ordtrafecfin" type="text" onfocus="if(!agree)this.blur();" value="<?php if(!$flagconsultarvistaot){echo $sbreg[ordtrafecfin];}else{ echo $ordtrafecfin;}?>" size="10" maxlength="10">&nbsp;
  			<img src="../img/cal.gif" alt="Calendario" border="0" onclick="window.open('formcalendario.php?calencodigo=ordtrafecfin','cal1','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=200,height=210');">
			</td>
	        <td><div align="right">Hora fin&nbsp; </div></td>
            <td><input name="ordtrahorfin" type="text" value="<?php if(!$flagconsultarvistaot){echo $sbreg[ordtrahorfin];}else{ echo $ordtrahorfin;}?>" size="4" maxlength="4">
			</td>
            <td colspan="1">&nbsp;<span class="style1">hh:mm</span></td>
		</tr>
		<tr>
			<td colspan="6"><hr></td>
		</tr>
		<tr>
      <td colspan="2"><?php if($campnomb == "usuacodi")echo "*";?>
        Colaborador de mantenimiento&nbsp;&nbsp;&nbsp;
        <input name="radio1" type="radio" onclick="window.open('consultarusuarioot.php?codigo=<?php echo $codigo?>','','status=no,menubar=no,scrollbars=yes,resizable=yes,left=300,width=800,height=600');" width="86" height="18" alt="Cancelar" border=0 href="#" target="_parent">
        </td>
        <td align="right">C&oacute;digo&nbsp;&nbsp;</td>
        <td>
        <input name="empleacod" type="text" onfocus="this.blur();"	value="<?php echo $usuacodi ?>" size="8">
<!--        <input name="empleacod" type="text"	value="<?//php/* if($sbregusuario['usuacodi']){ echo $sbregusuario['usuacodi'];} else {echo $empleacod;} */?>" size="8"
		onFocus="if (!agree)this.blur();">-->
        </td>
      <td colspan="2">Nombre 
<!--	  <input  name="empleanomb" type="text" value="<?/*php echo $sbregusuario['usuanombre']." ".$sbregusuario[usuapriape]." ".$sbregusuario['usuasegape']*/?>" size="25" onFocus="if (!agree)this.blur();">-->
      <input  name="empleanomb" type="text" value="<?php  echo $sbregusuario['usuanombre']." ".$sbregusuario[usuapriape]." ".$sbregusuario['usuasegape'];?>" size="25" onFocus="this.blur();"></td>
      <td width="1%" colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="6"><hr></td>
		</tr>
		<tr>
   		<td width="13%"><?php if($campnomb == "tiptracodigo"){$tiptracodigo = null; echo "*";}?>Tipo de trabajo</td>
    		<td colspan="2"><select name="tiptracodigo">
    		<?php
    		if($tiptracodigo)
     			{
       				echo '<option value = "'.$tiptracodigo.'">'; 
	        		$idcon	= fncconn();
					$arrtipotrab = loadrecordtipotrab($tiptracodigo,$idcon);
					echo $arrtipotrab[tiptranombre];
					fncclose($idcon);
					echo '<option value = "">Seleccione'; 
			     }else
			     		echo '<option value = "">Seleccione';
			     ?></OPTION>
				<?php
					include ('../src/FunGen/floadtipotrab.php');
					$idcon = fncconn();
					floadtipotrab($idcon);
					fncclose($idcon);
				?>
	        	</select>
		</td>
		<td width="10%"><?php if($campnomb == "tareacodigo"){ echo $tareacodigo = null; echo "*";}?>Tarea</td>
          	<td width="10%"><select name="tareacodigo">
          	<?php
          	if($tareacodigo)
     			{
       				echo '<option value = "'.$tareacodigo.'">'; 
	        		$idcon	= fncconn();
					$arrtarea = loadrecordtarea($tareacodigo,$idcon);
					echo $arrtarea[tareanombre];
					fncclose($idcon);
					echo '<option value = "">Seleccione'; 
			     }else
			     		echo '<option value = "">Seleccione';  
			     ?></OPTION>
				<?php
					include ('../src/FunGen/floadtarea.php');
					$idcon = fncconn();
					floadtarea($idcon);
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
onclick="form1.accionconsultarvistaot.value =  1; form1.action='maestablvistaotaux.php';"  
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