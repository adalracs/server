<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblplanta.php');
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktblitem.php');
include ( '../src/FunPerPriNiv/pktbloperacio.php');
include ( '../src/FunPerPriNiv/pktbltipomant.php');
include ( '../src/FunPerPriNiv/pktbltipofall.php');
include ( '../src/FunPerPriNiv/pktblpriorida.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');
include ( '../src/FunPerPriNiv/pktblherramie.php');
include ( '../src/FunPerPriNiv/pktbltransacherramie.php');
include ( '../src/FunPerPriNiv/pktbltransacitem.php');
include ( '../src/FunPerPriNiv/pktbltipotrab.php');
include ( '../src/FunPerPriNiv/pktbltareot.php');
include ( '../src/FunPerPriNiv/pktblcomponen.php');
include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktbltareotherramie.php');
include ( '../src/FunPerPriNiv/pktblitemtareot.php');
if(!$flagborrarot)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	include('detallaot.php');
}
?> 
<html> 
<head> 
<title>Borrar registro de ot</title> 
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
<?php 
if(!$codigo)
{ echo "<!--";}
?> 
<body bgcolor="FFFFFF" text="#000000"> 
<form name="form1" method="post"  enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Orden de trabajo</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE"> 
<tr>
	<td width="708" class="NoiseErrorDataTD">&nbsp;</td>
</tr> 
  <tr> 
      <td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Borrar registro</font></span></td></tr> 
<tr> 
  <td><table width="97%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
  <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
	<td><table width="97%" border="0" cellspacing="1" cellpadding="0" align="center">
      <tr>
        <td class="NoiseFieldCaptionTD"><strong>N&uacute;mero de OT </strong></td>
        <td class="NoiseFieldCaptionTD"><strong>&nbsp;
              <?php if(!$flagdetallarot){ echo $sbreg[ordtracodigo];}else{ echo $ordtracodigo;} ?>
        </strong></td>
        <td colspan="4"><div align="right">Fecha de geraci&oacute;n:&nbsp;&nbsp;
              <?php if(!$flagdetallarot){echo $anno1."-".$mesgen."-".$diagen;}else{ echo $annogen;}?>
          &nbsp;<span class="style1" onFocus="if (!agree)this.blur();"></span>-
          <?php if(!$flagdetallarot){echo $horagen.":".$minutogen;}else{ echo $horagen.":".$minutogen;}?>
        </div></td>
      </tr>
      <tr class="NoiseFooterTD">
        <td>Planta</td>
        <td>&nbsp;</td>
        <td>Sistema</td>
        <td>&nbsp;</td>
        <td>Equipo</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><?php if(!$flagdetallarot){ echo $sbregplannom;}else{ echo $sbregplannom;} ?></td>
        <td colspan="2"><?php if(!$flagdetallarot){ echo $sbregsistnom;}else{ echo $sbregsistnom;} ?></td>
        <td colspan="2"><?php if(!$flagdetallarot){ echo $sbregequinom;}else{ echo $sbregequinom;} ?></td>
      </tr>
      <tr>
        <td width="17%" class="NoiseFooterTD">Tipo de mantenimiento</td>
        <td width="16%"><?php if(!$flagdetallarot){ echo $sbregtipmanom;}else{ echo $sbregtipmanom;} ?></td>
        <td width="13%" class="NoiseFooterTD">Tipo de falla </td>
        <td>&nbsp;&nbsp;&nbsp;
            <?php if(!$flagdetallarot){ echo $sbregtipfalnombre;}else{ echo $sbregtipfalnombre;} ?></td>
        <td class="NoiseFooterTD">Prioridad</td>
        <td width="22%"><?php if(!$flagdetallarot){ echo $sbregpriornom;}else{ echo $sbregpriornom;} ?></td>
      </tr>
      <tr>
        <td width="17%" class="NoiseFooterTD">Descripci&oacute;n</td>
        <td colspan="5" rowspan="2"><?php if(!$flagdetallarot){ echo $sbreg[ordtradescri];}else{ echo $ordtradescri;} ?></td>
      </tr>
      <tr class="NoiseFooterTD">
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="17%" class="NoiseFooterTD">Fecha de inicio</td>
        <td colspan="2"><?php if(!$flagdetallarot){echo $anno."-".$mes."-".$dia."-".$hora.":".$minuto;}else{ echo $anno;}?></td>
        <td><div align="right">Fecha de fin</div></td>
        <td colspan="2">:                &nbsp;
            <?php if(!$flagdetallarot){echo $anno1."-".$mes1."-".$dia1."-".$hora1.":".$minuto1;}else{ echo $anno1;}?>
          &nbsp;&nbsp;<span class="style1">aaaa-mm-dd-hh:mm</span></td>
      </tr>
      <tr>
        <td colspan="6"><hr noshade></td>
      </tr>
    </table></td>
  </tr>
<tr>
  <td><table width="97%" border="0" cellspacing="1" cellpadding="0" align="center">
    <tr class="NoiseErrorDataTD">
      <td class="NoiseFooterTD"><strong>Encargado</strong></td>
      <td class="NoiseFooterTD">&nbsp;</td>
      <td colspan="3">&nbsp;
          <?php if(!$flagdetallarot){ echo $usuacodigo." - ";} else {echo $usuacodigo;} ?>
          <?php if(!$flagdetallarot){ echo $sbregusuanom;}else{ echo $sbregusuanom;} ?></td>
    </tr>
    <tr>
      <td colspan="2" class="NoiseFooterTD">Auxiliares de mantenimiento </td>
      <td><?php
   if (!$flagdetallarot)
   {
   	include('../src/FunGen/floadusuaaux.php');
   	$idcon = fncconn();
   	floadusuaaux($idcon,$sbregusuaselec);
   	fncclose($idcon);
   }
    ?></td>
      <td>&nbsp;</td>
      <td width="10%">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8"><hr noshade></td>
    </tr>
    <tr>
      <td colspan="2" class="NoiseFooterTD">Tipo de trabajo</td>
      <td><?php if(!$flagdetallarot){ echo $sbregtipotnom;}else{ echo $sbregtipotnom;} ?></td>
      <td class="NoiseFooterTD">Tarea</td>
      <td><?php if(!$flagdetallarot){ echo $sbregtareanom;}else{ echo $sbregtareanom;} ?></td>
    </tr>
    <tr>
      <td width="13%" class="NoiseFooterTD">Descripci&oacute;n del trabajo a realizar</td>
      <td height="36" colspan="4"><?php if(!$flagdetallarot){ echo $sbregtarnota;}else{ echo $sbregtarnota;} ?></td>
    </tr>
    <tr>
      <td class="NoiseFooterTD">Herramientas</td>
      <td>&nbsp;</td>
      <td colspan="3" class="NoiseFooterTD">Item</td>
    </tr>
    <tr>
      <td colspan="2" rowspan="2"><?php
		     	if (!$flagdetallarot)
		       {
					include('../src/FunGen/floadtransacherramie.php');
					$idcon = fncconn();
					floadtransacherramie($idcon,$herrseleccodi,$herrseleccant);
					fncclose($idcon);
		       }
    		?></td>
      <td colspan="3"><?php
		     	if (!$flagdetallarot)
		       {
		       		include('../src/FunGen/floadtransacitem.php');
					$idcon = fncconn();
					floadtransacitem($idcon,$itemseleccodi,$itemseleccant);
					fncclose($idcon);
		       }
    		?></td>
    </tr>
  </table></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
 <tr> 
<td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionborrarot.value =  1; form1.action='maestablot.php';"  
width="86" height="18" alt="Aceptar" border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablot.php';"  width="86" height="18" alt="Cancelar" 
border=0>
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagborrarot" value="1"> 
<input type="hidden" name="ordtracodigo" value="<?php if(!$flagborrarot){echo $sbreg[ordtracodigo];}else {echo $ordtracodigo;}?>">
<input type="hidden" name="accionborrarot"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html>