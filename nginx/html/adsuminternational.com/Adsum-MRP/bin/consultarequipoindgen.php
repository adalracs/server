<?php
include ( '../src/FunPerPriNiv/pktblsistema.php');
include ( '../src/FunPerPriNiv/pktblestado.php');
include ( '../src/FunPerPriNiv/pktblcentcost.php');
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncclose.php');
include ( '../src/FunPerSecNiv/fncfetch.php');
include ( '../src/FunPerSecNiv/fncnumreg.php');
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
</head>
<?php
    if(!$codigo)
    { echo "<!--";}
?>
<body bgcolor="FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data">
<p><font class="NoiseFormHeaderFont">Equipo</font></p>
<table border="0" cellspacing="1" cellpadding="2" align="center"
class="NoiseFormTABLE">
  <tr>
    <td class="NoiseErrorDataTD">&nbsp;</td>
  </tr>
  <tr>
          <td class="NoiseFieldCaptionTD"><span class="style5"><font
color="FFFFFF">
Consultar registro</font></span></td></tr>
<tr>
  <td>
        <table width="85%" border="0" cellspacing="0" cellpadding="0"
align="center">
<tr>
            <td width="21%">C&oacute;digo</td>
            <td width="30%">
              <input name="equipocodigo" type="text"	value="<?php if(!$flagconsultarequipo){
echo $sbreg[equipocodigo];} else {echo $equipocodigo;}?>" size="14">
            </td>
            <td width="21%">&nbsp;</td>
            <td width="28%">&nbsp;</td>
          </tr>
          <tr>
            <td width="21%">Nombre</td>
            <td width="30%">
              <input name="equiponombre" type="text"	value="<?php if(!$flagconsultarequipo){
echo $sbreg[equiponombre];} else {echo $equiponombre;}?>" size="14">
            </td>
            <td width="21%">Estado</td>
            <td width="28%">
             <select name="estadocodigo">
                      <option value ="">Seleccione</option>
                      <?php
	include ('../src/FunGen/floadestado.php');
	$idcon = fncconn();
	floadestado($estadocodigo,$idcon);
	fncclose($idcon);
?>
                    </select>
            </td>
          </tr>

          <tr>
            <td width="21%">C&oacute;digo financiero</td>
            <td width="28%">
                        <select name="cencoscodigo">
                        <option value ="">Seleccione</option>
            <?php
				include ('../src/FunGen/floadcentcost.php');
				$idcon = fncconn();
				floadcentcost($cencoscodigo,$idcon);
				fncclose($idcon);
			?></select>
            </td>
            
          </tr>
          <tr>
            <td width="21%">Fabricante</td>
            <td width="28%">
              <input name="equipofabric" type="text"	value="<?php if(!$flagconsultarequipo){
echo $sbreg[equipofabric];} else {echo $equipofabric;}?>" size="14">
            </td>
<td colspan="2"></td>
          </tr>
          <tr>
            <td width="21%">Marca</td>
            <td width="30%">
              <input name="equipomarca" type="text"	value="<?php if(!$flagconsultarequipo){
echo $sbreg[equipomarca];} else {echo $equipomarca;}?>" size="14">
            </td>
            <td width="21%">Modelo</td>
            <td width="28%">
              <input name="equipomodelo" type="text"	value="<?php if(!$flagconsultarequipo){
echo $sbreg[equipomodelo];} else {echo $equipomodelo;}?>" size="17">
            </td>
          </tr>
          <tr>
            <td width="21%">No. serie</td>
            <td width="30%">
              <input name="equiposerie" type="text"	value="<?php if(!$flagconsultarequipo){
echo $sbreg[equiposerie];} else {echo $equiposerie;}?>" size="14">
            </td>
            <td width="21%">Vida &uacute;til </td>
            <td width="28%"><input name="equipoviduti" type="text"	value="<?php if(!$flagconsultarequipo){
echo $sbreg[equipoviduti];} else {echo $equipoviduti;}?>" size="17">
            </td>
          </tr>
          <tr>
            <td width="21%">Ubicaci&oacute;n</td>
            <td width="30%"><input name="equipoubicac" type="text"	value="<?php if(!$flagconsultarequipo){
echo $sbreg[equipoubicac];} else {echo $equipoubicac;}?>" size="14">
            </td>
            <td width="21%">Costo de inversi&oacute;n</td>
            <td width="28%"><input name="equipocinv" type="text"	value="<?php if(!$flagconsultarequipo){
echo $sbreg[equipocinv];} else {echo $equipocinv;}?>" size="17">
            </td>
          </tr>
          <tr>
            <td>Alto</td>
            <td><input name="equipoalto" type="text"	value="<?php if(!$flagconsultarequipo){
echo $sbreg[equipoalto];} else {echo $equipoalto;}?>" size="14"></td>
            <td>Ancho</td>
            <td><input name="equipoancho" type="text"	value="<?php if(!$flagconsultarequipo){
echo $sbreg[equipoancho];} else {echo $equipoancho;}?>" size="17"></td>
          </tr>
          <tr>
            <td>Largo</td>
            <td><input name="equipolargo" type="text"	value="<?php if(!$flagconsultarequipo){
echo $sbreg[equipolargo];} else {echo $equipolargo;}?>" size="14"></td>
            <td>Peso</td>
            <td><input name="equipopeso" type="text"	value="<?php if(!$flagconsultarequipo){
echo $sbreg[equipopeso];} else {echo $equipopeso;}?>" size="17"></td>
          </tr>
          <tr>
            <td>Voltaje (V)</td>
            <td><input name="equipovolta" type="text"	value="<?php if(!$flagconsultarequipo){
echo $sbreg[equipovolta];} else {echo $equipovolta;}?>" size="14"></td>
            <td>Corriente (A)</td>
            <td><input name="equipocorrie" type="text"	value="<?php if(!$flagconsultarequipo){
echo $sbreg[equipocorrie];} else {echo $equipocorrie;}?>" size="17"></td>
          </tr>
          <tr>
           <td>Potencia (KW)</td>
            <td><input type="text" name="equipopoten"	value="<?php if(!$flagconsultarequipo){
echo $sbreg[equipopoten];} else {echo $equipopoten;}?>" size="14"></td>
            <td>Valor hora </td>
            <td colspan="3"><input type="text" name="equipovalhor"	value="<?php if(!$flagconsultarequipo){
echo $sbreg[equipovalhor];} else {echo $equipovalhor;}?>" size="17"></td>
          </tr>
          <tr>
            <td width="21%">Fecha compra</td>
            <td width="50%"><input type="text" name="equipofeccom"	value="<?php if(!$flagconsultarequipo){
echo $sbreg[equipofeccom];} else {echo $equipofeccom;}?>" size="10">&nbsp;aaaa-mm-dd</td>
<td>&nbsp;</td>
          </tr>
          <tr>
            <td width="21%">Fec. instalaci&oacute;n</td>
            <td><input type="text" name="equipofecins"	value="<?php if(!$flagconsultarequipo){
echo $sbreg[equipofecins];} else {echo $equipofecins;}?>" size="10">&nbsp;aaaa-mm-dd</td>
<td>&nbsp;</td>
          </tr>
          <tr>
            <td width="21%">Venc. garant&iacute;a</td>
            <td><input type="text" name="equipovengar"	value="<?php if(!$flagconsultarequipo){
echo $sbreg[equipovengar];} else {echo $equipovengar;}?>" size="10">&nbsp;aaaa-mm-dd</td>
<td>&nbsp;</td>
          </tr>
          <tr>
            <td width="21%">Descripci&oacute;n</td>
            <td colspan="3" rowspan="2">
              <textarea name="equipodescri" rows="3" wrap="VIRTUAL" cols="40"><?php if(!$flagconsultarequipo){ echo $sbreg[equipodescri];} else {echo $equipodescri;}?></textarea>
            </td>
          </tr>
          <tr>
            <td width="21%">&nbsp;</td>
          </tr>
          <tr>
            <td width="21%">Normas de higiene y seguridad </td>
            <td colspan="3" rowspan="2">
              <textarea name="equiponohs" rows="3" wrap="VIRTUAL" cols="40"><?php if(!$flagconsultarequipo){
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
onclick="form1.accionconsultarequipo.value =  1;
form1.action='maestablequipoindgen.php';"  width="86" height="18" alt="Aceptar"
border=0>
  <input type="image" name="cancelar" src="../img/cancelar.gif"
onclick="window.close();"  width="86" height="18"
alt="Cancelar" border=0>
</div>
</td>
 </tr>
 <tr>
  <td class="NoiseErrorDataTD">&nbsp;</td>
 </tr>
</table>
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
</form>
</body>
<?php
    if(!$codigo)
    { echo " -->"; }
?>
</html>