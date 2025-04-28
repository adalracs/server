<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');

if(!$flagdetallarcomponen)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
	$idcon = fncconn();
	$sbregequip = loadrecordequipo($sbreg[equipocodigo],$idcon);
	$equiponombre = $sbregequip[equiponombre];
	fncclose($idcon);
}
?> 
<html> 
<head> 
<title>Detalle de registro de componen</title> 
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
<p><font class="NoiseFormHeaderFont">Componente</font></p> 
<table width="75%" border="0" align="center" cellpadding="2" cellspacing="1" 
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
          <table width="95%" border="0" cellspacing="1" cellpadding="0" 
align="center"> 
              <tr> 
 <td width="20%" class="NoiseFooterTD">&nbsp;C&oacute;digo</td> 
  <td width="24%" class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ 
echo $sbreg[componcodigo];}else {echo $componcodigo;}?></td> 
 <td width="22%" class="NoiseFooterTD">&nbsp;</td> 
  <td colspan="2" class="NoiseDataTD">&nbsp;</td>   
 </tr> 
              <tr>
                <td class="NoiseFooterTD"><span class="NoiseFooterTD">&nbsp;</span>Nombre</td>
                <td colspan="3" class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ 
echo $sbreg[componnombre];}else {echo $componnombre;}?></td>
              </tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
	               					<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
			<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
            <tr>
              <td height="17" colspan="4" class="NoiseErrorDataTD">&nbsp;Equipo</td>
            </tr>
            <tr> 
 <td width="20%" class="NoiseFooterTD"> &nbsp;C&oacute;digo</td>
 <td class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ echo $sbreg[equipocodigo]; }else{
echo $equipocodigo;} ?></td>
 <td class="NoiseFooterTD">&nbsp;</td>
 <td class="NoiseDataTD">&nbsp;</td>
 </tr>
            <tr>
              <td class="NoiseFooterTD"><span class="NoiseFooterTD">&nbsp;</span>Nombre</td>
              <td colspan="3" class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ 
echo $equiponombre;} ?></td>
            </tr>
							<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr> 
	               					<tr><td class="NoiseFieldCaptionTD" colspan="4"></td></tr> 
			<tr><td class="NoiseErrorDataTD" colspan="4"></td></tr>
 <tr>
 <td width="20%" class="NoiseFooterTD">&nbsp;Fabricante</td>
<td width="24%" class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ 
echo $sbreg[componfabric];} else {echo $componfabric;} ?></td> 
  <td width="22%" class="NoiseFooterTD"><span class="NoiseFooterTD">&nbsp;Marca</span></td> 
  <td width="34%" class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ 
echo $sbreg[componmarca];}else {echo $componmarca;}?></td> 
 </tr> 
<tr> 
 <td width="20%" class="NoiseFooterTD">&nbsp;Modelo</td> 
  <td width="24%" class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ 
echo $sbreg[componmodelo];} else {echo $componmodelo;} ?></td> 
 <td width="22%" class="NoiseFooterTD"><span class="NoiseFooterTD">&nbsp;No. de serie </span></td> 
  <td width="34%" class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ 
echo $sbreg[componserie];} else {echo $componserie;}?></td> 
 </tr>
<tr>
  <td class="NoiseFooterTD">&nbsp;No. inventario  </td>
  <td class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ 
echo $sbreg[componcinv];} else {echo $componcinv;}?></td>
  <td class="NoiseFooterTD"> <span class="NoiseFooterTD">&nbsp;</span>Vida &uacute;til </td>
  <td class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ 
echo $sbreg[componviduti];}else {echo $componviduti;}?></td>
</tr>
<tr>
  <td class="NoiseFooterTD">&nbsp;Alto</td>
  <td class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ 
echo $sbreg[componalto];}else {echo $componalto;}?></td>
  <td class="NoiseFooterTD"><span class="NoiseFooterTD">&nbsp;</span>Largo</td>
  <td class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ 
echo $sbreg[componlargo];}else {echo $componlargo;}?></td>
</tr>
<tr>
  <td class="NoiseFooterTD">&nbsp;Ancho</td>
  <td class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ 
echo $sbreg[componancho];}else {echo $componancho;}?></td>
  <td class="NoiseFooterTD"><span class="NoiseFooterTD">&nbsp;</span>Peso</td>
  <td class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ 
echo $sbreg[componpeso];} else {echo $componpeso;}?></td>
</tr>
<tr>
  <td class="NoiseFooterTD">&nbsp;Fecha compra</td>
  <td class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ 
echo $sbreg[componfeccom];} else {echo $componfeccom;}?>
    a-m-d</td>
  <td class="NoiseFooterTD"><span class="NoiseFooterTD">&nbsp;Fec. instalaci&oacute;n</span></td>
  <td class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ 
echo $sbreg[componfecins];} else {echo $componfecins;}?>
    a-m-d</td>
</tr>
<tr>
  <td class="NoiseFooterTD">&nbsp;Venc. garantia</td>
  <td class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ 
echo $sbreg[componvengar];} else {echo $componvengar;}?>     a-m-d</td>
  <td class="NoiseFooterTD">&nbsp;</td>
  <td class="NoiseDataTD">&nbsp;</td>
</tr>
<tr>
  <td class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td>
  <td colspan="3" class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ 
echo $sbreg[componubicac];} else {echo $componubicac;}?></td>
  </tr> 
           <!-- * *Campos personalizados* * -->
          <?php 
          include('../src/FunGen/floadcomponcamperequipo.php');
          // 'true' indica que es un detallar/borrar
          $idcon = fncconn();
          floadcomponcamperequipo($sbreg['componcodigo'], null, null, $idcon);
          fncclose($idcon);
							?>
          <!-- * * * -->
 <tr>
   <td class="NoiseFooterTD">&nbsp;Descripci&oacute;n</td>
   <td colspan="3" rowspan="2" valign="top" class="NoiseDataTD"><?php if(!$flagdetallarcomponen){ 
echo $sbreg[compondescri];} else {echo $compondescri;}?></td>
   </tr>
 <tr class="NoiseFooterTD">
   <td>&nbsp;</td>
 </tr>
 <tr> 
  <td width="20%">&nbsp;</td>
 </tr> 
</table> 
  </td> 
 </tr> 
 <tr> 

 
 
 <td> 
<div align="center"> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="<?php if($codigo == 'Endadsum'){ echo 'window.close();';}else{echo "form1.action='maestablcomponen.php';";} ?>"  width="86" height="18" 
alt="Aceptar" border=0> 
</div> 
</td>
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input type="hidden" name="flagdetallarcomponen" value="1"> 
<input type="hidden" name="acciondetallarcomponen"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
