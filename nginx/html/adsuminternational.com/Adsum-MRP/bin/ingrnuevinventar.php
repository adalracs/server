<?php 
ob_start();
include ( '../src/FunGen/sesion/fncvalses.php'); 
include ( '../src/FunPerPriNiv/pktbltipomovi.php'); 
if($accionnuevoinventar)
{
	include ( 'grabainventar.php');
}
ob_end_flush();
?> 
<html> 
<head> 
<title>Nuevo registro de inventar</title> 
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
<p><font class="NoiseFormHeaderFont">Inventario</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Ingresar nuevo registro</font></span></td></tr> 
<tr> 
  <td> 
            <table width="85%" border="0" cellspacing="0" cellpadding="0" 
align="center"> 
<tr> 
 <td width="41%">Item</td> 
  <td width="25%"><input name="itemcodigo" type="text"	value="<?php if(!$flagnuevoinventar){ 
echo $sbreg[itemcodigo];} else {echo $itemcodigo;}?>" size="14"> 
  </td> 
 <td width="25%">Bodega</td> 
  <td width="25%"><input type="text" name="bodegacodigo"	value="<?php if(!$flagnuevoinventar){ 
echo $sbreg[bodegacodigo];} else {echo $bodegacodigo;}?>"> 
  </td> 
 </tr> 
<tr>
  <td colspan="2">Tipo de movimiento</td>
  <td colspan="2"><select name="tipmovcodigo">
    <option value ="">Seleccione</option>
    <?php
	include ('../src/FunGen/floadtipomovi.php');
	$idcon = fncconn();
	floadtipomovi($idcon);
	fncclose($idcon);
?>
  </select></td>
  </tr>
<tr> 
 <td width="41%">Proveedor</td> 
  <td width="25%"><input name="proveecodigo" type="text"	value="<?php if(!$flagnuevoinventar){ 
echo $sbreg[proveecodigo];} else {echo $proveecodigo;}?>" size="14"></td> 
 <td width="25%">&nbsp;</td> 
  <td width="25%">&nbsp;  </td> 
 </tr> 
<tr> 
 <td width="41%">Fecha</td> 
  <td colspan="3"> 
    <select name="dia">
      <option value ="" selected>D&iacute;a</option>
      <option value ="1">1</option>
      <option value ="2">2</option>
      <option value ="3">3</option>
      <option value ="4">4</option>
      <option value ="5">5</option>
      <option value ="6">6</option>
      <option value ="7">7</option>
      <option value ="8">8</option>
      <option value ="9">9</option>
      <option value ="10">10</option>
      <option value ="11">11</option>
      <option value ="12">12</option>
      <option value ="13">13</option>
      <option value ="14">14</option>
      <option value ="15">15</option>
      <option value ="16">16</option>
      <option value ="17">17</option>
      <option value ="18">18</option>
      <option value ="19">19</option>
      <option value ="20">20</option>
      <option value ="21">21</option>
      <option value ="22">22</option>
      <option value ="23">23</option>
      <option value ="24">24</option>
      <option value ="25">25</option>
      <option value ="26">26</option>
      <option value ="27">27</option>
      <option value ="28">28</option>
      <option value ="29">29</option>
      <option value ="30">30</option>
      <option value ="31">31</option>
    </select>    <select name="mes">
      <option value ="" selected>Mes</option>
      <option value ="1">Enero</option>
      <option value ="2">Febrero</option>
      <option value ="3">Marzo</option>
      <option value ="4">Abril</option>
      <option value ="5">Mayo</option>
      <option value ="6">Junio</option>
      <option value ="7">Julio</option>
      <option value ="8">Agosto</option>
      <option value ="9">Septiembre</option>
      <option value ="10">Octubre</option>
      <option value ="11">Noviembre</option>
      <option value ="12">Diciembre</option>
      </select>
    <select name="anno">
      <option selected>A&ntilde;o</option>
      <option value="2004">2004</option>
      <option value="2003">2003</option>
      <option value ="2002">2002</option>
      <option value ="2001">2001</option>
      <option value ="2000">2000</option>
      <option value ="1999">1999</option>
      <option value ="1998">1998</option>
      <option value ="1997">1997</option>
      <option value ="1996">1996</option>
      <option value ="1995">1995</option>
      <option value ="1994">1994</option>
      <option value ="1993">1993</option>
      <option value ="1992">1992</option>
      <option value ="1991">1991</option>
      <option value ="1990">1990</option>
      <option value ="1989">1989</option>
      <option value ="1988">1988</option>
      <option value ="1987">1987</option>
      <option value ="1986">1986</option>
      <option value ="1985">1985</option>
      <option value ="1984">1984</option>
      <option value ="1983">1983</option>
      <option value ="1982">1982</option>
      <option value ="1981">1981</option>
      <option value ="1980">1980</option>
      <option value ="1979">1979</option>
      <option value ="1978">1978</option>
      <option value ="1977">1977</option>
      <option value ="1976">1976</option>
      <option value ="1975">1975</option>
      <option value ="1974">1974</option>
      <option value ="1973">1973</option>
      <option value ="1972">1972</option>
      <option value ="1971">1971</option>
      <option value ="1970">1970</option>
      <option value ="1969">1969</option>
      <option value ="1968">1968</option>
      <option value ="1967">1967</option>
      <option value ="1966">1966</option>
      <option value ="1965">1965</option>
      <option value ="1964">1964</option>
      <option value ="1963">1963</option>
      <option value ="1962">1962</option>
      <option value ="1961">1961</option>
      <option value ="1960">1960</option>
      <option value ="1959">1959</option>
      <option value ="1958">1958</option>
      <option value ="1957">1957</option>
      <option value ="1956">1956</option>
      <option value ="1955">1955</option>
      <option value ="1954">1954</option>
      <option value ="1953">1953</option>
      <option value ="1952">1952</option>
      <option value ="1951">1951</option>
      <option value ="1950">1950</option>
      <option value ="1949">1949</option>
      <option value ="1948">1948</option>
      <option value ="1947">1947</option>
      <option value ="1946">1946</option>
      <option value ="1945">1945</option>
      <option value ="1944">1944</option>
      <option value ="1943">1943</option>
      <option value ="1942">1942</option>
      <option value ="1941">1941</option>
      <option value ="1940">1940</option>
      <option value ="1939">1939</option>
      <option value ="1938">1938</option>
      <option value ="1937">1937</option>
      <option value ="1936">1936</option>
      <option value ="1935">1935</option>
      <option value ="1934">1934</option>
      <option value ="1933">1933</option>
      <option value ="1932">1932</option>
      <option value ="1931">1931</option>
      <option value ="1930">1930</option>
      </select></td> 
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
<input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" 
height="18" alt="Cancelar" border=0> 
  <input type="image" name="aceptar"  src="../img/aceptar.gif" 
onclick="form1.accionnuevoinventar.value =  1; 
form1.inventfecmov.value = form1.dia.value+'-'+form1.mes.value+'-'+form1.anno.value;"  width="86" height="18" alt="Aceptar" 
border=0> 
  <input type="image" name="cancelar" src="../img/cancelar.gif" 
onclick="form1.action='maestablinventar.php';"  width="86" height="18" 
alt="Cancelar" border=0> 
</div> 
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table> 
 <input name="inventfecmov" type="hidden" value="">
 <input type="hidden" name="inventcodigo"	value="<?php if(!$flagnuevoinventar){ 
echo $sbreg[inventcodigo];}else{ echo $inventcodigo;} ?>">
<input type="hidden" name="accionnuevoinventar"> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
</form> 
</body> 
<?php 
    if(!$codigo) 
    { echo " -->"; } 
?> 
</html> 
