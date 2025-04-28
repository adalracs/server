<?php
ob_start();
if($accioncargaexcel)
{
	include('../src/Funexcel/cexcel.php');
}
ob_end_flush();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">

</head>
<body bgcolor="#FFFFFF" text="#000000">
<form name="form1" method='post' enctype="multipart/form-data">
<p><font class="NoiseFormHeaderFont">Cargar archivo excel</font></p>
  <table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
    <tr>
      <td width="534" class="NoiseErrorDataTD">&nbsp;</td>
    </tr>
    <tr>
      <td class="NoiseFieldCaptionTD"><font color="FFFFFF">Cargar Archivo Excel</font></td>
    </tr>
    <tr>
      <td colspan="2"><strong>Este es un ejemplo de como debe usted tener el formato de su archivo excel para el ingreso de equipo:</strong></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><table cellspacing="1">
        <col width="77" span="2">
        <col width="146" span="2">
        <col width="221">
        <col width="226">
        <col width="203">
        <col width="62">
        <col width="66">
        <col width="86">
        <col width="49">
        <col width="52">
        <col width="36">
        <col width="44">
        <col width="56">
        <col width="75">
        <col width="67">
        <col width="149">
        <col width="114">
        <col width="188">
        <col width="64">
        <col width="182">
        <col width="74">
        <col width="134" span="2">
        <col width="51">
        <col width="39">
        <col width="45">
        <col width="69">
        <col width="180">
        <col width="134" span="3">
        <tr class="NoiseColumnTD">
          <td width="77"><h6>C&oacute;digo</h6></td>
          <td width="77"><h6>Estado(obligatorio)</h6></td>
          <td width="146"><h6>Sistema (Obligatorio)</h6></td>
          <td width="146"><h6>C&oacute;digo del    centro de costo</h6></td>
          <td width="221"><h6>Nombre del equipo (Obligatorio)</h6></td>
          <td width="226"><h6>Descripci&oacute;n</h6></td>
          <td width="203"><h6>Proveedor</h6></td>
          <td width="62"><h6>Marca</h6></td>
          <td width="66"><h6>Modelo</h6></td>
          <td width="86"><h6>NO. Serie</h6></td>
          <td width="49"><h6>Largo</h6></td>
          <td width="52"><h6>Ancho</h6></td>
          <td width="36"><h6>Alto</h6></td>
          <td width="44"><h6>Peso</h6></td>
          <td width="56"><h6>Voltaje</h6></td>
          <td width="75"><h6>Corriente</h6></td>
          <td width="67"><h6>Potencia</h6></td>
          <td width="149"><h6>Fecha de compra    (Comilla)AAAA-MM-DD</h6></td>
          <td width="114"><h6>Valor de compra</h6></td>
          <td width="188"><h6>Fecha de vencimiento de garant&iacute;a (Comilla)AAAA-MM-DD</h6></td>
          <td width="64"><h6>Vida util</h6></td>
          <td width="182"><h6>Fecha de instalaci&oacute;n (Comilla)AAAA-MM-DD</h6></td>
          <td width="74"><h6>Ubicaci&oacute;n</h6></td>
          <td width="134"><h6>Valor hora</h6></td>
          <td width="134"><h6>Normas    seguridad</h6></td>
          <td width="51"><h6>Activo</h6></td>
          <td width="39"><h6>Tipo</h6></td>
          <td width="45"><h6>NPAS</h6></td>
          <td width="69"><h6>Contrato</h6></td>
          <td width="180"><h6>Tipo de equipo</h6></td>
          <td width="134"><h6>C&oacute;digo SRF</h6></td>
          <td width="134"><h6>Acronimo</h6></td>
          <td width="134"><h6>Imagen</h6></td>
        </tr>
        <tr>
          <td align="right">102</td>
          <td align="right">1</td>
          <td>249</td>
          <td>39</td>
          <td>Refrigerador-bar</td>
          <td></td>
          <td>Taylor</td>
          <td>True</td>
          <td>TWT-72</td>
          <td>1-4535594</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>2008-04-30</td>
          <td></td>
          <td>2009-04-30</td>
          <td></td>
          <td>2008-04-30</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td width="39"></td>
          <td></td>
          <td></td>
          <td align="right">27</td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td align="right">103</td>
          <td align="right">1</td>
          <td>249</td>
          <td>39</td>
          <td>Congelador-CG4</td>
          <td width="226">1/2-115V/60Hz-R404a-7,9A-221lb</td>
          <td>Pallomaro</td>
          <td>Turbo air</td>
          <td>TUF48SD</td>
          <td>UC4F302013</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>2008-04-30</td>
          <td></td>
          <td>2009-04-30</td>
          <td></td>
          <td>2008-04-30</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td width="39"></td>
          <td></td>
          <td></td>
          <td align="right">27</td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </table></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">
        <p class="NoiseSeparatorTD">
          Ingrese aqu&iacute; la ruta de su archivo excel para el ingreso de equipo por lotes
          <input type="file" name="presenbarra" />
		</p>
	 </td>           
    </tr> 
    <tr>
    	<td>&nbsp;</td>
    </tr>   
    <tr>
      <td colspan="2">
        <div align="center"><input type="image" name="aceptar" src="../img/aceptar.gif" 
        onclick="form1.accioncargaexcel.value=1;"
        width="86" height="18" /> 
               <input type="image" name="cancelar" src="../img/cancelar.gif"        onclick="form1.action='main.php';" width="86" height="18" /> </div> </td>
    </tr>
    <tr>
      <td class="NoiseErrorDataTD">&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="accioncargaexcel">
</form>
</head>
</body>
</html>


