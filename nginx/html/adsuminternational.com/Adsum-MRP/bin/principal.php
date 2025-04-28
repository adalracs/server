<?php
include ( "../extras/varextract.php");
include ( "../src/FunGen/sesion/fncvallogin.php");
include ( "../src/FunGen/sesion/fncaccion.php");

if(isset($id) && isset($pass))
{
	fncaccion(fncvallogin($id,$pass),$id,$pass);
}
?>
<!-- Código creado por:
Andrés A. Riascos D.
Fecha: 02022002
Ultima modificación:
Fecha: 07112005
Por ariascos@parquesoft.com
para versión Kallpa
Todos los derechos reservados-->
<html>
<head>
<title>Adsum Kallpa :::::::Sistema de gesti&oacute;n de mantenimiento</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link rel="shortcut icon" href="../img/favicon.ico" />
<link rel="icon" type="image/png" href="../img/favicon.png" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<script language="javascript">
function resolutions()
{
	window.resizeTo(screen.availWidth, screen.availHeight); 
	window.moveTo(0,0);
}
</script>
</head>

<body onLoad="resolutions();window.document.login.id.focus();">
<form name="login" method="post">
<p align="center">
  <input name="imageField" type="image" src="../img/1.jpg" align="middle" width="788" height="30" border="0">
<br>
<br>
<br>
  <input name="imageField2" type="image" src="../img/2.jpg" width="442" height="232" border="0" align="middle"> 
</p>
<div align="center">
  <script language="javascript">
  var mydate=new Date()
    var year=mydate.getYear()
    if (year < 1000)
    year+=1900
    var day=mydate.getDay()
    var month=mydate.getMonth()
    var daym=mydate.getDate()
    if (daym<10)
    daym="0"+daym
    var dayarray=new
    Array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado")
    var montharray=new
    Array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre")
    document.write("<small><b><font color='000000'face='Tahoma' size='2'>&nbsp;"+dayarray[day]+" "+daym+" de "+montharray[month]+" de "+year+", Bienvenido a Adsum Kallpa</font></b></small>")
</script>
</div>
<br>
<table width="300" height="19" border="0" align="center" background="../img/mango.gif">
  <tr>
    <td width="22%"><b><font face="Tahoma" size="1" color="#000000">Empresa</font></b></td>
    <td width="21%"><font face="Tahoma" size="2"><font size="1">Adsum</font></font></td>
    <td width="22%"><b><font face="Tahoma" size="1" color="#000000">Id producto</font></b></td>
    <td width="35%"><font face="Tahoma" size="2"><font size="1">720040311</font></font></td>
  </tr>
  <tr>
    <td width="22%"><b><font face="Tahoma" size="2"><font size="1"><b>Licencia</b></font></font></b></td>
    <td colspan="3"><font face="Tahoma" size="2"><font size="1">PTSC-AARD-LJMA-52005</font></font></td>
  </tr>
</table>
<table  align="center" cellpadding="0" cellspacing="0" border="0" width="22%">
  <tr>
    <td>
      <div align="center"><b><font face="Tahoma" size="2">Nombre de usuario</font></b></div></td>
    <td>
      <div align="center"><b><font face="Tahoma" size="2">Clave</font></b></div></td>
  </tr>
  <tr>
    <td width="49%">
      <div align="right">
        <input name="id" type="text" value="<?php echo $id;?>">
    </div></td>
    <td width="51%">
      <div align="left"><font face="Tahoma">
        <input name="pass" type="password">
    </font></div></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <input type="submit" value="Aceptar" name="submit">
    </td>
  </tr>
</table>
<p>&nbsp;</p>
<p align="center">&nbsp; </p>
</form>
</body>
</html>
