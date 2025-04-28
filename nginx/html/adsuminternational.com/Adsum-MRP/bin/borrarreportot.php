<?php
//
include ( '../src/FunPerPriNiv/pktblot.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktblcomponen.php');
include ( '../src/FunPerPriNiv/pktblitem.php');
include ( '../src/FunPerPriNiv/pktbloperacio.php');
include ( '../src/FunPerPriNiv/pktbltransacitem.php');
include ( '../src/FunPerPriNiv/pktbltareot.php');
include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktblitemtareot.php');
//
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktbltipomant.php');
include ( '../src/FunPerPriNiv/pktblpriorida.php');
include ( '../src/FunPerPriNiv/pktbltipotrab.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');
include ( '../src/FunPerPriNiv/pktblreportotitem.php');
if(!$flagborrarreportot) 
{ 
	include ( '../src/FunGen/sesion/fnccarga.php'); 
	$sbreg = fnccarga($nombtabl,$radiobutton); 
	$idcon = fncconn();
	if($sbreg[tipmancodigo])
   		$sbregtipomant = loadrecordtipomant($sbreg[tipmancodigo],$idcon);
	if($sbreg[prioricodigo])
   		$sbregpriorida = loadrecordpriorida($sbreg[prioricodigo],$idcon);
	if($sbreg[tiptracodigo])
   		$sbregtipotrab = loadrecordtipotrab($sbreg[tiptracodigo],$idcon);
	if($sbreg[tareacodigo])
   		$sbregtarea = loadrecordtarea($sbreg[tareacodigo],$idcon);

	if (!$sbreg) 
	{ 
		include( '../src/FunGen/fnccontfron.php'); 
	}

	$temp = $sbreg;
	if($sbreg[ordtracodigo])
	{
		$sbregot = loadrecordot($sbreg[ordtracodigo],$idcon);
		if($sbregot)
			include('detallareportot.php');
	}
   	fncclose($idcon);
	
} 
?> 
<!-- Propiedad intelectual de Adsum SA (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andr�s A. Riascos D. 
Fecha: 26052004 
GenVers: 3.1 --> 
<html> 
<head> 
<title>Borrar registro de reporte de orden de trabajo</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin 
agree = 0; 
//  End --> 
</script> 
</head> 
<?php 
    if(!$codigo) 
    { echo "<!--";} 
?> 
<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Reporte de orden de trabajo</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Borrar registro</font></span></td></tr> 
<!-- -- -->
<tr> 
  <td><table width="97%" border="0" cellspacing="0" cellpadding="0" align="center">
 <tr>
 <td colspan="6">&nbsp;</td> 
 </tr>
 <tr>
	<td><table width="97%" border="0" cellspacing="0" cellpadding="3" align="center">
	<tr>
			<td colspan="2">Orden de trabajo:&nbsp;&nbsp;
			<input name="ordtracodigo" type="text" value="<?php if(!$flagborrarreportot){ echo $sbreg[ordtracodigo];}else{ echo $ordtracodigo;} ?>" size="12" onFocus="if (!agree)this.blur();" ></td>
  			<td>Fecha :&nbsp;&nbsp;
  			<input name="ordtrafecgen" type="text"	value="<?php if(!$flagborrarreportot){echo $ordtrafecgen;}else{ echo $ordtrafecgen;}?>" size="10" maxlength="10" onFocus="if (!agree)this.blur();">
  			<td align="right">Hora :&nbsp;&nbsp;
  			<input name="ordtrahorgen" type="text"	value="<?php if(!$flagborrarreportot){echo $ordtrahorgen;}else{ echo $ordtrahorgen;}?>" size="5" maxlength="5" onFocus="if (!agree)this.blur();">
  			</td>
            
  	</tr>
	<tr>
		<td colspan="6"><hr></td>
	</tr>
 <tr>
	<td>Centro industrial</td>
  	<td>Taller</td>
  	<td>Equipo</td>
  	<td>Componente</td>
 </tr>
<tr> 
  <td><input type="text" name="plantacodigo" value="<?php if(!$flagborrarreportot){ echo $plantanombre;}else{ echo $plantanombre;} ?>" size="25" onFocus="if (!agree)this.blur();"></td> 	
  <td><input type="text" name="sistemcodigo" value="<?php if(!$flagborrarreportot){ echo $sistemnombre;}else{ echo $sistemnombre;} ?>" size="25" onFocus="if (!agree)this.blur();" ></td> 
  <td><input type="text" name="equipocodigo" value="<?php if(!$flagborrarreportot){ echo $equiponombre;}else{ echo $equiponombre;} ?>" size="25" onFocus="if (!agree)this.blur();"></td> 
  <td><input type="text" name="componnombre" value="<?php if(!$flagborrarreportot){ echo $componnombre;}else{ echo $componnombre;} ?>" size="25" onFocus="if (!agree)this.blur();"></td> 
</tr> 
<tr>
  <td colspan = "6">&nbsp;</td>
</tr>
 <tr> 
 <td width="17%">Tipo de mantenimiento</td>
 <td width="16%"><input type="text" name="tipmancodigo" value="<?php if(!$flagborrarreportot){ echo $tipmannombre;}else{ echo $tipmannombre;} ?>" onFocus="if (!agree)this.blur();" ></td>
 <td width="13%" align="right">Prioridad</td>
 <td colspan="2">&nbsp;&nbsp;&nbsp;<input name="prioricodigo" type="text" value="<?php if(!$flagborrarreportot){ echo $priorinombre;}else{ echo $priorinombre;} ?>" onFocus="if (!agree)this.blur();" ></td> 
 <td width="22%">&nbsp;</td>
 </tr> 
 <tr> 
 <td width="17%">Descripci&oacute;n</td> 
  <td colspan="5"> 
   <textarea name="ordtradescri" cols="41" rows="3" wrap="VIRTUAL" onFocus="if (!agree)this.blur();"><?php if(!$flagborrarreportot){ echo $sbregot[ordtradescri];}else{ echo $ordtradescri;} ?></textarea> 
  </td> 
  </tr>
  <tr>
			<td width="17%">Fecha de inicio</td>
            <td>
            <input name="ordtrafecini" type="text"	value="<?php if(!$flagborrarreportot){echo $ordtrafecini;}else{ echo $ordtrafecini;}?>" size="10" maxlength="10" onFocus="if (!agree)this.blur();">
			&nbsp;<span class="style1">aaaa-mm-dd</span>
			</td>
            <td>Hora inicio&nbsp;
			<input name="ordtrahorini" type="text"	value="<?php if(!$flagborrarreportot){echo $ordtrahorini;}else{ echo $ordtrahorini;}?>" size="6" maxlength="6" onFocus="if (!agree)this.blur();">
            &nbsp;
			</td>
            <!--<td colspan="1">&nbsp;<span class="style1">hh:mm</span></td>-->
            <td colspan="1">
            <input type="checkbox" name="pasadmerini" <?php if(!$flagborrarreportot){if($hora>12) echo 
            "CHECKED";}
  			?>>&nbsp;p.m
			</td>
	</tr>
  		<tr>
 			<td width="17%">Fecha de fin</td>
  			<td>
  			<input name="ordtrafecfin" type="text"	value="<?php if(!$flagborrarreportot){echo $ordtrafecfin;}else{ echo $ordtrafecfin;}?>" size="10" maxlength="10" onFocus="if (!agree)this.blur();">
  			&nbsp;<span class="style1">aaaa-mm-dd</span></td>
	        <td>Hora fin&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="ordtrahorfin" type="text"	value="<?php if(!$flagborrarreportot){echo $ordtrahorfin;}else{ echo $ordtrahorfin;}?>" size="6" maxlength="6" onFocus="if (!agree)this.blur();">
			</td>
            <!--<td colspan="1">&nbsp;<span class="style1">hh:mm</span></td>-->
            <td colspan="1">
            <input type="checkbox" name="pasadmerfin" <?php if(!$flagborrarreportot){if($hora1>12) echo 
            "CHECKED";}
  			?>>&nbsp;p.m
			</td>
		</tr>
<tr>
			<td colspan="6"><hr></td>
		</tr>
 	</table></td>
</tr>
<tr>
  <td><table width="97%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr> 
 <td colspan="3">Empleado de mantenimiento</td> 
 <td>C&oacute;digo</td>
 <td><input name="usuacodigo" type="text"	value="<?php if(!$flagborrarreportot){ echo $usuacodigo;} else {echo $usuacodigo;} ?>" size="8" onFocus="if (!agree)this.blur();"></td>
 <td colspan="3">Nombre&nbsp;&nbsp;
  <input type="text" name="sbregotusuanom" value="<?php if(!$flagborrarreportot){ echo $sbregotusuanom;}else{ echo $sbregotusuanom;} ?>" size="25" onFocus="if (!agree)this.blur();" ></td> 
</tr> 
    <tr>
      <td colspan="8">&nbsp;</td>
    </tr>
 <tr> 
 <td colspan="3">Auxiliares de mantenimiento  </td> 
 <td colspan="5">&nbsp;</td>
</tr>
    <tr>
      <td colspan="8">&nbsp;</td>
    </tr>
   <tr>
      <td colspan="3" rowspan="2"><div align="left">
       <select name="sbregusuaselec" size="3">
   <?php
     	if (!$flagborrarreportot)
       {
			include('../src/FunGen/floadusuaaux.php');
			$idcon = fncconn();
			floadusuaaux($idcon,$sbregotusuaselec); 
			fncclose($idcon);
       }
    ?>
 </select> </div></td>
   <td><div align="center"></div></td>
   <td colspan="4" rowspan="2"><div align="center"></div><div align="left"></div></td>
  </tr>
  <tr>
      <td><div align="center"></div></td>
  </tr>
  <tr>
		<td colspan="8"><hr></td>
		</tr>
 <tr> 
 <td width="13%">Tipo de trabajo</td> 
  <td colspan="2"><input name="tiptranombre" type="text" onFocus="if (!agree)this.blur();" value="<?php if(!$flagborrarreportot){ echo $tiptranombre;}else{ echo $tiptranombre;} ?>" size="20" ></td> 
  <td>&nbsp;</td>
 <td width="10%">Tarea</td> 
  <td width="10%"><input type="text" name="tareanombre" value="<?php if(!$flagborrarreportot){ echo $tareanombre;}else{ echo $tareanombre;} ?>" onFocus="if (!agree)this.blur();" size="25"></td> 
  <td colspan="2">&nbsp;</td>
 </tr> 
<tr> 
 <td width="13%">Descripci&oacute;n del trabajo a realizar</td> 
  <td height="36" colspan="7"><textarea name="tareotnota" cols="41" rows="3" wrap="VIRTUAL" onFocus="if (!agree)this.blur();"><?php if(!$flagborrarreportot){ echo $tareotnota;}else{ echo $tareotnota;} ?></textarea></td> 
</tr> 
   <tr>
	<td colspan="8">&nbsp;</td>
	</tr>
	<tr>
	<td colspan="2">Herramientas</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>Item</td>
	<td align="center">Items devueltos</td>
	</tr>
	<tr>
	    	<td width="13%" rowspan="2"></td>
	    	<td colspan="4">&nbsp;</td>
	    	<td width="16%" rowspan="2"><div align="left"><select name="sbregitemtareot" size="3">
	    	<?php
		     	if (!$flagborrarreportot)
		       {
		       		include('../src/FunGen/floadtransacitem.php');
					$idcon = fncconn();
					floadtransacitem($idcon,$itemseleccodi,$itemseleccant); 
					fncclose($idcon);
		       }
    		?></select> </div></td>
	      	<td width="18%" rowspan="3" align="left">
	      	<div align="center">
	      	<?php
				$idcon = fncconn();
				$sbregreportotitem[reportcodigo]=$sbreg[reportcodigo];
		      	$nuResult=dinamicscanreportotitem($sbregreportotitem,$idcon);
		      	$numRows = fncnumreg($nuResult);
		      	for($i=0;$i<$numRows;$i++)
		      	{
		      		$sbregreportotitem=fncfetch($nuResult,$i);
		      		if($sbregreportotitem)
		      		{
		      			$sbregtransacitem[transitecodigo]=$sbregreportotitem[transitecodigo];
				      	$nuResulttransacitem=dinamicscantransacitem($sbregtransacitem,$idcon);
				      	$numtransacitem=fncnumreg($nuResulttransacitem);
				      	if($numtransacitem>0)
				      	{
				      		$sbregtransacitem=fncfetch($nuResulttransacitem,0);
				      		if($sbregtransacitem)
				      		{
								$itemseleccodi1[] = $sbregtransacitem[itemcodigo];
								$itemseleccant1[] = $sbregtransacitem[transitecantid];
				      		}
				      	}
				      	$sbregtransacitem=null;
		      		}
		      	}
				fncclose($idcon);
	      	?>
	      	<select name="itemcodigo1" size="3">
	      	<?php
	      	if(!$flagborrarreportot)
	      	{
	      		if($itemseleccodi1 && $itemseleccant1)
	      		{
	      			$idcon = fncconn();
	      			floadtransacitem($idcon,$itemseleccodi1,$itemseleccant1);
	      			fncclose($idcon);
	      		}
	      	}
			?>
	      	</select></div></td>
	    	<td colspan="2"></td>
	</tr>
  </table></td>
</tr>
<!-- -- -->
	<tr>
		<td colspan="6"><hr></td>
	</tr>
 <tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="3" 
align="center"> 
<tr> 
<?php $sbreg= $temp; ?>
		<tr>
			<td>&nbsp;</td>
  			<td>&nbsp;</td>
  			<td align="right"colspan="2">Fecha:&nbsp;<?php echo $sbreg[reportfecha];?></td>
		</tr>
 <td width="41%">C&oacute;digo</td> 
 <td width="59%"> 
  <input type="text" name="reportcodigo" value="<?php if(!$flagborrarreportot){ 
echo $sbreg[reportcodigo];}else{ echo $reportcodigo; } ?>" onFocus="if 
(!agree)this.blur();" > 
 </td> 
 <td width="41%">Orden de trabajo</td> 
 <td width="59%"> 
  <input type="text" name="ordtracodigo" value="<?php if(!$flagborrarreportot){ 
echo $sbreg[ordtracodigo];}else{ echo $ordtracodigo; } ?>" onFocus="if 
(!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">Tipo de mantenimiento</td> 
 <td width="59%"> 
  <input type="text" name="tipmancodigo" value="<?php
   if(!$flagborrarreportot)
   {
   		echo $sbregtipomant[tipmannombre];
   }
   else
   {
   		echo $tipmannombre;
   }?>" onFocus="if (!agree)this.blur();">
 </td> 
 <td width="41%">Prioridad</td> 
 <td width="59%"> 
  <input type="text" name="prioricodigo" value="<?php
   if(!$flagborrarreportot)
   {
   		echo $sbregpriorida[priorinombre];
   }
   else
   {
   		echo $priorinombre;
   }?>
   " onFocus="if (!agree)this.blur();">
 </td> 
 </tr> 
<tr> 
 <td width="41%">Tipo de trabajo</td> 
 <td width="59%"> 
  <input type="text" name="tiptracodigo" value="<?php
   if(!$flagborrarreportot)
   {
   		echo $sbregtipotrab[tiptranombre];
   }
   else
   {
   		echo $tiptranombre;
   }?>
   " onFocus="if (!agree)this.blur();">
 </td>
 <td width="41%">Tarea</td>
 <td width="59%"> 
  <input type="text" name="tareacodigo" value="<?php
   if(!$flagborrarreportot)
   {
   		echo $sbregtarea[tareanombre];
   }
   else
   {
   		echo $tareanombre;
   }?>
   " onFocus="if (!agree)this.blur();" > 
 </td> 
 </tr> 
<tr> 
 <td width="41%">Descripci&oacute;n</td>
 <td width="59%">
  <textarea name="reportdescri" cols="41" rows="3" onFocus="if (!agree)this.blur();"><?php
  if(!$flagborrarreportot){ echo $sbreg[reportdescri];}else{ echo $reportdescri; } ?></textarea>
 </td> 
 </tr> 
 <tr> 
  <td width="41%">&nbsp;</td> 
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionborrarreportot.value =  1; 
form1.action='maestablreportot.php';"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablreportot.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
<input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" 
height="18" alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagborrarreportot" value="1"> 
<input type="hidden" name="accionborrarreportot"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<input type="hidden" name="reporttiedur" value="<?php if(!$flagborrarreportot){ echo $sbreg[reporttiedur];}else{ echo $reporttiedur; } ?>"> 
</form>
</body>
<?php
    if(!$codigo)
    { echo " -->"; }
?>
</html>