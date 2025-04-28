<?php 
//include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerSecNiv/fncconn.php');	
include ( '../src/FunPerSecNiv/fncclose.php');	
include ( '../src/FunPerSecNiv/fncnumreg.php');	
include ( '../src/FunPerPriNiv/pktblestado.php');	
include ( '../src/FunPerPriNiv/pktblsistema.php');	
include ( '../src/FunPerPriNiv/pktblcentcost.php');	
include ( '../src/FunPerPriNiv/pktblusuaequipo.php');	
include ( '../src/FunPerPriNiv/pktblusuario.php');	
if(!$flagdetallarequipo)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga("equipo",$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	$anno = strtok($sbreg[equipofeccom],"-");
	$mes = strtok("-");
	$dia = strtok("-");
	$anno1 = strtok($sbreg[equipofecins],"-");
	$mes1 = strtok("-");
	$dia1 = strtok("-");
	$anno2 = strtok($sbreg[equipovengar],"-");
	$mes2 = strtok("-");
	$dia2 = strtok("-");
	
	$idcon = fncconn();
	$sbregsistema = loadrecordsistema($sbreg[sistemcodigo],$idcon);
	$sistemnombre = $sbregsistema[sistemnombre];
	
	$sbregusuaequi = loadrecordusuaequipo1($sbreg[equipocodigo],$idcon);
	if($sbregusuaequi[usuacodi])
	{
		$sbregusua = loadrecordusuario($sbregusuaequi[usuacodi],$idcon);
		$usuanombre = $sbregusua[usuanomb]." ".$sbregusua[usuapriape]." ".$sbregusua[usuasegape];
		$usuacodig = $sbregusua[usuacodi];
	}
	fncclose($idcon);
}
?> 
<html> 
<head> 
<title>Detalle de registro de equipo</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<SCRIPT LANGUAGE="JavaScript"> 
<!-- Begin
agree = 0;
//  End -->
</script> 
<script language="JavaScript" src="motofech.js"></script> 
</head> 
<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Equipos</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Detallar registro</font></span></td></tr> 
<tr> 
  <td> 
        <table width="85%" border="0" cellspacing="0" cellpadding="0" 
align="center">
<tr> 
            <td width="21%">C&oacute;digo</td>
            <td width="30%"> 
              <input name="equipocodigo" type="text"	value="<?php if(!$flagdetallarequipo){ 
echo $sbreg[equipocodigo];} else {echo $equipocodigo;}?>" size="14" onFocus="if (!agree)this.blur();">
            </td>
            <td width="21%">&nbsp;</td>
            <td width="28%">&nbsp;</td>
          </tr>
          <tr> 
            <td width="21%">Nombre</td>
            <td width="30%"> 
              <input name="equiponombre" type="text"	value="<?php if(!$flagdetallarequipo){ 
echo $sbreg[equiponombre];} else {echo $equiponombre;}?>" size="14" onFocus="if (!agree)this.blur();">
            </td>
            <td width="21%">Estado</td>
            <td width="28%">
             <input type="text" name="estadocodigo" value="<?php 
   if(!$flagdetallarequipo)
   {
   		$idcon = fncconn();
   		$sbregestado = loadrecordestado($sbreg[estadocodigo],$idcon);
   		echo $sbregestado[estadonombre];
   }
   else
   {
   		echo $estadocodigo;} ?>" size="17" onFocus="if (!agree)this.blur();" > 
            </td>
          </tr>
<tr>
<td colspan="4"><hr></td>              
</tr>
<tr> 
 <td width="41%">Responsable</td>
 <td>Cod.&nbsp;<input name="usuacodig" type="text"	value="<?php if(!$flagnuevoequipo){ 
echo $usuacodig;} else {echo $usuacodig;} ?>" size="8" onFocus="if (!agree)this.blur();"></td>
 <td>Nombre</td>
 <td><input name="usuanombre" type="text"	value="<?php if(!$flagnuevoequipo){ 
echo $usuanombre;} else {echo $usuanombre;} ?>" size="17" onFocus="if (!agree)this.blur();"> </td>
 </tr>          
 <tr>
<td colspan="4"><hr></td>               
</tr>   
          <tr> 
            <td width="21%">C&oacute;digo financiero</td>
            <td width="28%"> 
           <input type="text" name="cencoscodigo" value="<?php 
   if(!$flagdetallarequipo)
   		echo $sbreg[cencoscodigo];?>" onFocus="if (!agree)this.blur();" size="14" ></td>          
            <td width="21%">Proceso/td>
            <td width="30%">
            <input type="text" name="sistemcodigo" value="<?php 
   if(!$flagdetallarequipo)
   		echo $sistemnombre;?>" onFocus="if (!agree)this.blur();" size="17" >
            </td>
          </tr>       
          <tr> 
            <td width="21%">Fabricante</td>
            <td width="28%"> 
              <input name="equipofabric" type="text"	value="<?php if(!$flagdetallarequipo){ 
echo $sbreg[equipofabric];} else {echo $equipofabric;}?>" size="14">
            </td>
<td colspan="2"></td>            
          </tr>          
          <tr> 
            <td width="21%">Marca</td>
            <td width="30%"> 
              <input name="equipomarca" type="text"	value="<?php if(!$flagdetallarequipo){ 
echo $sbreg[equipomarca];} else {echo $equipomarca;}?>" size="14" onFocus="if (!agree)this.blur();">
            </td>
            <td width="21%">Modelo</td>
            <td width="28%"> 
              <input name="equipomodelo" type="text"	value="<?php if(!$flagdetallarequipo){ 
echo $sbreg[equipomodelo];} else {echo $equipomodelo;}?>" size="17" onFocus="if (!agree)this.blur();">
            </td>
          </tr>
          <tr> 
            <td width="21%">No. serie</td>
            <td width="30%"> 
              <input name="equiposerie" type="text"	value="<?php if(!$flagdetallarequipo){ 
echo $sbreg[equiposerie];} else {echo $equiposerie;}?>" size="14" onFocus="if (!agree)this.blur();">
            </td>
            <td width="21%">Vida &uacute;til </td>
            <td width="28%"><input name="equipoviduti" type="text"	value="<?php if(!$flagdetallarequipo){ 
echo $sbreg[equipoviduti];} else {echo $equipoviduti;}?>" size="17" onFocus="if (!agree)this.blur();"> 
            </td>
          </tr>
          <tr> 
            <td width="21%">Ubicaci&oacute;n</td>
            <td width="30%"><input name="equipoubicac" type="text"	value="<?php if(!$flagdetallarequipo){ 
echo $sbreg[equipoubicac];} else {echo $equipoubicac;}?>" size="14" onFocus="if (!agree)this.blur();"> 
            </td>
            <td width="21%">Costo de inversi&oacute;n</td>
            <td width="28%"><input name="equipocinv" type="text"	value="<?php if(!$flagdetallarequipo){ 
echo $sbreg[equipocinv];} else {echo $equipocinv;}?>" size="17" onFocus="if (!agree)this.blur();"> 
            </td>
          </tr>
          <tr>
            <td>Alto</td>
            <td><input name="equipoalto" type="text"	value="<?php if(!$flagdetallarequipo){ 
echo $sbreg[equipoalto];} else {echo $equipoalto;}?>" size="14" onFocus="if (!agree)this.blur();"></td>
            <td>Ancho</td>
            <td><input name="equipoancho" type="text"	value="<?php if(!$flagdetallarequipo){ 
echo $sbreg[equipoancho];} else {echo $equipoancho;}?>" size="17" onFocus="if (!agree)this.blur();"></td>
          </tr>
          <tr>
            <td>Largo</td>
            <td><input name="equipolargo" type="text"	value="<?php if(!$flagdetallarequipo){ 
echo $sbreg[equipolargo];} else {echo $equipolargo;}?>" size="14" onFocus="if (!agree)this.blur();"></td>
            <td>Peso</td>
            <td><input name="equipopeso" type="text"	value="<?php if(!$flagdetallarequipo){ 
echo $sbreg[equipopeso];} else {echo $equipopeso;}?>" size="17" onFocus="if (!agree)this.blur();"></td>
          </tr>
          <tr>
            <td>Voltaje (V)</td>
            <td><input name="equipovolta" type="text"	value="<?php if(!$flagdetallarequipo){ 
echo $sbreg[equipovolta];} else {echo $equipovolta;}?>" size="14" onFocus="if (!agree)this.blur();"></td>
            <td>Corriente (A)</td>
            <td><input name="equipocorrie" type="text"	value="<?php if(!$flagdetallarequipo){ 
echo $sbreg[equipocorrie];} else {echo $equipocorrie;}?>" size="17" onFocus="if (!agree)this.blur();"></td>
          </tr>          
          <tr>
           <td>Potencia (KW)</td>
            <td><input type="text" name="equipopoten"	value="<?php if(!$flagdetallarequipo){ 
echo $sbreg[equipopoten];} else {echo $equipopoten;}?>" size="14" onFocus="if (!agree)this.blur();"></td>
            <td>Valor hora </td>
            <td colspan="3"><input type="text" name="equipovalhor"	value="<?php if(!$flagdetallarequipo){ 
echo $sbreg[equipovalhor];} else {echo $equipovalhor;}?>" size="17" onFocus="if (!agree)this.blur();"></td>
          </tr>
          <tr> 
            <td width="21%">Fecha compra</td>
            <td><input name="anno" type="text"	value="<?php if(!$flagdetallarequipo){ 
echo $anno;} else {echo $anno;}?>" size="4" maxlength="4" onFocus="if (!agree)this.blur();">-
<input name="mes" type="text"	value="<?php if(!$flagdetallarequipo){ 
	echo $mes;} else {echo $mes;}?>" size="2" maxlength="2" onFocus="if (!agree)this.blur();">-
<input name="dia" type="text"	value="<?php if(!$flagdetallarequipo){ 
	echo $dia;} else {echo $dia;}?>" size="2" maxlength="2" onFocus="if (!agree)this.blur();"></td>
<td>&nbsp;aaaa-mm-dd</td>
          </tr>
          <tr> 
            <td width="21%">Fec. instalaci&oacute;n</td>
            <td><input name="anno1" type="text"	value="<?php if(!$flagdetallarequipo){ 
echo $anno1;} else {echo $anno1;}?>" size="4" maxlength="4" onFocus="if (!agree)this.blur();">-
<input name="mes1" type="text"	value="<?php if(!$flagdetallarequipo){ 
	echo $mes1;} else {echo $mes1;}?>" size="2" maxlength="2" onFocus="if (!agree)this.blur();">-
<input name="dia1" type="text"	value="<?php if(!$flagdetallarequipo){ 
	echo $dia1;} else {echo $dia1;}?>" size="2" maxlength="2" onFocus="if (!agree)this.blur();"></td>
<td>&nbsp;aaaa-mm-dd</td>
          </tr>
          <tr> 
            <td width="21%">Venc. garant&iacute;a</td>
            <td><input name="anno2" type="text"	value="<?php if(!$flagdetallarequipo){ 
echo $anno2;} else {echo $anno2;}?>" size="4" maxlength="4" onFocus="if (!agree)this.blur();">-
<input name="mes2" type="text"	value="<?php if(!$flagdetallarequipo){ 
	echo $mes2;} else {echo $mes2;}?>" size="2" maxlength="2" onFocus="if (!agree)this.blur();">-
<input name="dia2" type="text"	value="<?php if(!$flagdetallarequipo){ 
	echo $dia2;} else {echo $dia2;}?>" size="2" maxlength="2" onFocus="if (!agree)this.blur();"></td>
<td>&nbsp;aaaa-mm-dd</td>
          </tr>
          <tr> 
            <td width="21%">Descripci&oacute;n</td>
            <td colspan="3" rowspan="2"> 
              <textarea name="equipodescri" rows="3" wrap="VIRTUAL" cols="40" onFocus="if (!agree)this.blur();"><?php if(!$flagdetallarequipo){ 
echo $sbreg[equipodescri];} else {echo $equipodescri;}?></textarea>
            </td>
          </tr>
          <tr>
            <td width="21%">&nbsp;</td>
          </tr>
          <tr> 
            <td width="21%">Normas de higiene y seguridad </td>
            <td colspan="3" rowspan="2"> 
              <textarea name="equiponohs" rows="3" wrap="VIRTUAL" cols="40" onFocus="if (!agree)this.blur();"><?php if(!$flagdetallarequipo){ 
echo $sbreg[equiponohs];} else {echo $equiponohs;}?></textarea>
            </td>
          </tr>
          <tr> 
            <td width="21%">&nbsp;</td>
          </tr>
        </table>  
  </td> 
 </tr> 
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="window.close();"  width="86" height="18" 
alt="Aceptar" border=0> 
<img src="../img/ayuda.gif" border="0" alt="Ayuda">
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagdetallarequipo" value="1"> 
<input type="hidden" name="acciondetallarequipo"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="equipoacti" value="<?php echo $equipoacti; ?>"> 
<input type="hidden" name="equipotipo" value="<?php echo $equipotipo; ?>"> 
<input type="hidden" name="equiponpas" value="<?php echo $equiponpas; ?>"> 
</form> 
</body> 
</html> 
