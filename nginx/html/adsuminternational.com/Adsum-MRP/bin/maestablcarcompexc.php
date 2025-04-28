<?php
ob_start();
if($accioncargacompexcel)
{
	include('../src/Funexcel/CompExcel.php');
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
<form name="frmCargaComponentes" method='post' enctype="multipart/form-data">
<p><font class="NoiseFormHeaderFont">Cargar archivo excel</font></p>
  <table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
    <tr>
      <td width="534" class="NoiseErrorDataTD">&nbsp;</td>
    </tr>
    <tr>
      <td class="NoiseFieldCaptionTD"><font color="FFFFFF">Cargar Archivo Excel</font></td>
    </tr>
    <tr>
      <td colspan="2"><strong>Este es un ejemplo de como debe usted tener el formato de su archivo excel para el ingreso de componentes:</strong></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">
      <table cellspacing="1">        
        <tr class="NoiseColumnTD">
          <td width="77"><h6>C&oacute;digo (Obligatorio)</h6></td>
          <td width="77"><h6>C&oacute;digo equipo (Obligatorio)</h6></td>
          <td width="146"><h6>Nombre del componente (Obligatorio)</h6></td>
          <td width="146"><h6>Descripci&oacute;n</h6></td>
          <td width="221"><h6>Fabricante</h6></td>
          <td width="226"><h6>Marca</h6></td>
          <td width="203"><h6>Modelo</h6></td>
          <td width="62"><h6>NO. Serie</h6></td>
          <td width="66"><h6>Fecha compra (Comilla)AAAA-MM-DD</h6></td>
          <td width="86"><h6>Fecha instalaci&oacute;n (Comilla)AAAA-MM-DD</h6></td>
          <td width="49"><h6>C&oacute;digo de inventario</h6></td>
          <td width="52"><h6>Fecha vencimiento garant&iacute;a (Comilla)AAAA-MM-DD</h6></td>
          <td width="36"><h6>Vida &uacute;til</h6></td>
          <td width="44"><h6>Ubicaci&oacute;n</h6></td>
          <td width="56"><h6>Alto</h6></td>
          <td width="75"><h6>Largo</h6></td>
          <td width="67"><h6>Ancho</h6></td>
          <td width="149"><h6>Peso</h6></td>          
          <td width="188"><h6>C&oacute;digo tipo componente</h6></td>          
        </tr>
        <tr>
          <td align="right">XXX-0000</td>
          <td align="right">BHINT-1003</td>
          <td>Motor compresor</td>
          <td>Motor compresor</td>
          <td>WEG</td>
          <td>WEG</td>
          <td>56J</td>
          <td>112M0594</td>
          <td>1998-06-30</td>
          <td>1998-06-30</td>
          <td></td>
          <td>1999-06-30</td>
          <td></td>
          <td>CAPTACION</td>
          <td>0</td>
          <td>0</td>
          <td>0</td>
          <td>0</td>
          <td>3</td>          
        </tr>
        <tr>
          <td align="right">LLL-0000</td>
          <td align="right">CMED-90PD1</td>
          <td>MOTOBOMBA TURBIDIMETRO</td>
          <td>MOTOBOMBA TURBIDIMETRO</td>
          <td>BARNES</td>
          <td>BARNES</td>
          <td>2CCE-1 S</td>
          <td>2CCE1S-4D16C006</td>
          <td>1998-06-30</td>
          <td>1998-06-30</td>
          <td></td>
          <td>2000-06-30</td>
          <td></td>
          <td>CAPTACION</td>
          <td>0</td>
          <td>0</td>
          <td>0</td>
          <td>0</td>          
          <td>4</td>
        </tr>
      </table>
     </td>               
    </tr>
    <tr>
    <td colspan="2">   	    
        <p class="NoiseSeparatorTD">
          Ingrese aqu&iacute; la ruta de su archivo excel para el ingreso de componente por lotes
          <input type="file" name="presenbarra" />
		</p>	
	 </td>   
	 </tr>	
	 <tr>
	 	<td>&nbsp;</td>
	 </tr> 
    <tr>
      <td>
        <div align="center">
        	<input type="image" name="aceptar" src="../img/aceptar.gif" 
	        onclick="frmCargaComponentes.accioncargacompexcel.value=1;"
	        width="86" height="18" /> 
            <input type="image" name="cancelar" src="../img/cancelar.gif" onclick="form1.action='main.php';" width="86" height="18" /> 
         </div> 
      </td>
    </tr>
    <tr>
      <td class="NoiseErrorDataTD">&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="accioncargacompexcel">
</form>
</body>
</html>


