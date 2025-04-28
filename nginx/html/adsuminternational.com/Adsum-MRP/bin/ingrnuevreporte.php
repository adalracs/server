<?php
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');

if($accionnuevoreporte)
{
	include ( 'grabareporte.php');
}
ob_end_flush();
?>
<!-- Propiedad intelectual de Adsum SA (c)
-Todos los derechos reservados-
Creado con WAG Adsum
Autor: Andr�s A. Riascos D.
Fecha: 26052004
GenVers: 3.1 -->
<html>
<head>
<title>Nuevo registro de reporte</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
agree = 0;
//  End -->
</script>
<script language=JavaScript src="../src/FunGen/jsrsClient.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/fncbotton.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarReporteform.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarReportConsulta.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/cargarReporte.js" type="text/javascript" ></script>
<script language=JavaScript src="../src/FunGen/ajxCargarCampo.js" type="text/javascript" ></script>
<script language=JavaScript type="text/javascript">
function cambiaCondic(link)
{
	var n = link.id;
	var text = window.document.getElementById('spanText_' + n);
	var select = window.document.getElementById('spanSelect_' + n);

	if (text.style.display == "none")
	{
		text.style.display = "inline";
		select.style.display = "none";
		link.innerHTML = "Opciones";
	}
	else
	{
		text.style.display = "none";
		select.style.display = "inline";
		link.innerHTML = "Valor";
	}
}

function carga()
{
	/**
	* Validacion realizada en el cliente debido
	* a la cmplejidad del formulario
	*/
	var errorString = "";
	var errorFlag = false;
	var intPosNumber = 1;

	if (window.document.form1.reportnombre.value == "")
	{
	(errorString == "") ? errorString = "Debe especificar un nombre para el reporte" : errorString = errorString + "Debe especificar un nombre para el reporte";
	errorFlag = true;
	}

	if (window.document.form1.seltable.options.length == 0)
	{
	(errorString == "") ? errorString = "Seleccione como minimo una entidad para realizar la consulta" : errorString = errorString + '\n' + "Seleccione como minimo una entidad para realizar la consulta";
	errorFlag = true;
	}

	if (window.document.form1.selfield.options.length == 0)
	{
	(errorString == "") ? errorString = "Indicar como minimo un campo que aparecera en el reporte" : errorString = errorString + '\n' + "Indicar como minimo un campo que aparecera en el reporte";
	errorFlag = true;
	}

	var init = 1;

	while (window.document.getElementById("spanText_" + init) != undefined)
	{
		if (!(window.document.form1.elements["pre_" + init].options[0].selected))
		{
			if (window.document.getElementById("spanText_" + init).style.display == "inline")
			{
				if (window.document.form1.elements["postt_" + init].value == ""){
					errorFlag = true;
			
				}
			}
			else
			{
				if (window.document.form1.elements["post_" + init].options[0].selected == true)
				errorFlag = true;
			}
		}
		else {
			if (window.document.getElementById("spanText_" + init).style.display == "inline")
			{
				if (window.document.form1.elements["postt_" + init].value != "")
				errorFlag = true;
			}
			else
			{
				if (!(window.document.form1.elements["post_" + init].options[0].selected))
				errorFlag = true;
			}
		}
		init++;
	}

	if (errorFlag)
	{
		alert("Ocurrio algun error al ingresar los datos:" + '\n' + errorString + '\n'
		+ "Especifique el(los) parametros(s) y/o condicion(es)");

		return false;
	}
	else
	{
		window.document.form1.accionnuevoreporte.value = 1;
		cargarReportConsulta();

		return true;
	}
}
</script>
</head>
<?php
if(!$codigo)
{ echo "<!--";}
?>
<body bgcolor="FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data">
<p><font class="NoiseFormHeaderFont">Reportes</font></p>
<table border="0" cellspacing="0" cellpadding="2" align="center" class="NoiseFormTABLE" width="50%">
  <tr>
    <td class="NoiseErrorDataTD">&nbsp;</td>
  </tr>
  <tr>
          <td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Ingresar nuevo registro</font></span></td></tr>
<tr>
  <td>
            <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
 <tr>
  <td colspan="2" align="right">Fecha:&nbsp;<?php echo date('Y-m-d')?></td>
 </tr>
 			<tr>
  				<td colspan="2">
					 <?php if($campnomb['reportnombre'] == 1) echo "*"; ?>
					 Nombre&nbsp;&nbsp;
			  <input name="reportnombre" type="text" value="<?php if($flagnuevoreporte) echo $reportnombre;?>" size="30"></td>
 			</tr>
 			<tr>
 					 <td colspan="2">Seleccione las entidades sobre las cuales desea realizar la c&oacute;nsulta</td>
 			</tr>
 			<tr>
 					 <td colspan="2">
  						 <table align="center">
   							 <tr>
   							  <td width="35%">
      <select name="alltable" size="6">
   	  <?php
   	  include('../src/FunGen/floadtabla.php');

   	  $idcon = fncconn();
   	  floadtabla($tablcodi,$idcon);
   	  fncclose($idcon);
   	  ?>
      </select>     							</td>
     							<td width="10%" align="center">
	   <input type="button" value=" > " onClick="transferTo(this.form.alltable, this.form.seltable); cargarReporte();"><br /><br />
	   <input type="button" value=" < " onClick="cargarReporte('', 1); transferTo(this.form.seltable, this.form.alltable);">    							 </td>
     							<td width="55%">
	   <select name="seltable" size="7" ondblclick="cargarReporte('', 1); transferTo(this.form.seltable, this.form.alltable);">
	   </select>     							</td>
   							 </tr>
   							</table> 						 </td>
 						</tr>
 <tr>
  <td colspan="2">Seleccione la informaci&oacute;n que aparecer&aacute; en el reporte</td>
 </tr>
 <tr>
  <td colspan="2">
   <table align="center">
    <tr>
     <td width="35%">
	   <select name="allfield" size="6" ondblclick="transferTo(this.form.allfield, this.form.selfield);">
	   </select>     </td>
     <td width="10%" align="center">
	   <input type="button" value="  >  " onClick="transferTo(this.form.allfield, this.form.selfield);"><br />
	   <input type="button" value=" >> " onClick="transferWholeList(this.form.allfield, this.form.selfield);"><br />
	   <input type="button" value=" << " onClick="transferWholeList(this.form.selfield, this.form.allfield);"><br />
	   <input type="button" value="  <  " onClick="transferTo(this.form.selfield, this.form.allfield);">     </td>
     <td width="55%">
	   <select name="selfield" size="6" ondblclick="transferTo(this.form.selfield, this.form.allfield);">
	   </select>     </td>
    </tr>
   </table>  </td>
 </tr>
 <!--<tr>
  <td width="55%">Indique par&aacute;metros y condiciones</td>
  <td class="NoiseErrorDataTD" width="45%">
  Condiciones&nbsp;&nbsp;<input type="button" value="Mas" onClick="cargaReporteform('startPoint');"><input type="button" value="Menos" disabled onClick="remove();">  </td>
 </tr>-->
 <tr>
  <td colspan="2">
  <!--<table width="100%" border="0">
     <tr>
      <td width="30%">
		<table border="0" id="tbl_1">
    <tr>
     <td width="30%" align="left">
      <select name="pre_1">
       <option value="">Seleccione</option>
      </select>     </td>
     <td align="center" width="18%">
      <select name="cond_1">
       <option value="=">Igual</option>
       <option value="<">Menor</option>
       <option value=">">Mayor</option>
       <option value="<=">Menor o igual</option>
       <option value=">=">Mayor o igual</option>
       <option value="<>">Diferente</option>
       <option value="IN">En</option>
       <option value="NOT IN">No en</option>
       <option value="LIKE">Como</option>
      </select>     </td>
     <td width="30%" align="left">
     <span id="spanText_1" style="display:inline;">
      <input type="text" name="postt_1" size="18">
     </span>
     <span id="spanSelect_1" style="display:none;">
      <select name="post_1">
       <option value="">Seleccione</option>
      </select>
     </span>     </td>
     <td>
      <select name="connector_1">
       <option value="AND">Y</option>
       <option value="OR">O</option>
      </select>     </td>
     <td align="right" width="11%">
       <a href="javascript:;" id="1" onClick="cambiaCondic(this);">Opciones</a>     </td>
     </tr>
     </table>      </td>
     </tr>
     <tr>
      <td>
		<div id="startPoint">

		</div>      </td>
     </tr>
   </table>--></td>
 <tr>
  <td colspan="2">Ordenar por&nbsp;&nbsp;&nbsp;&nbsp;
    <select name="orderby">
      <option value="">Seleccione</option>
    </select></td>
 </tr>
</table>
  </td>
 </tr>
 <tr>
<td>
<div align="center">
  <input type="image" name="aceptar"  src="../img/aceptar.gif"
onclick="return carga();"  width="86" height="18"
alt="Aceptar" border=0>
  <input type="image" name="cancelar" src="../img/cancelar.gif"
onclick="form1.action='maestablreporte.php';"  width="86" height="18"
alt="Cancelar" border=0>
</div>
</td>
 </tr>
 <tr>
  <td class="NoiseErrorDataTD">&nbsp;</td>
 </tr>
</table>
<?php
if($campnomb){echo '<font face = "Verdana" >Corregir los capos marcados con
*</font>';}
?>
<input type="hidden" name="reportcodigo" value="<?php if(!$flagnuevoreporte){
echo $sbreg[reportcodigo];}else{ echo $reportcodigo; } ?>">
<input type="hidden" name="accionnuevoreporte">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<!-- Consulta -->
<input type="hidden" name="counter" value="1">
<input type="hidden" name="strSelectedTables" value="">
<input type="hidden" name="strSelectedFields" value="">
<input type="hidden" name="strSelectedPrecon" value="">
<input type="hidden" name="strSelectedCondit" value="">
<input type="hidden" name="strSelectedPoscon" value="">
<input type="hidden" name="strSelectedConnec" value="">
<!--  -->
</form>
</body>
<?php
if(!$codigo)
{ echo " -->"; }
?>
</html>