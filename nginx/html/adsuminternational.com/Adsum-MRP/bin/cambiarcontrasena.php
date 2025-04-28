<?php
ob_start();
include ( "../src/FunGen/sesion/fncvalclave.php");
include ( "../src/FunGen/sesion/fncaccionclave.php");
if($id)
{
	fncaccionclave(fncvalclave($id,$pass),$id,$pass);
}
ob_end_flush();
?>
<!-- C�digo creado por:
Andr�s A. Riascos D.
Fecha: 02022002
Ultima modificaci�n:
Fecha: 07112005
Por ariascos@parquesoft.com
para versi�n Kallpa
Todos los derechos reservados-->
<html>
<head>
<title>Cambio de Contrasena</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 

<SCRIPT type='text/javascript' name="validar">

function enviar(){

        if (document.datos.id.value=="")
                {
                        alert("Por favor, digite un Login");
                        return;
                }
        if (document.datos.pass.value=="")
                {
                        alert("Por favor, digite su nueva Contrasena");
                        return;
                }
        if (document.datos.pass1.value=="")
                {
                        alert("Por favor, confirme su nueva Contrasena");
                        return;
                }
        if (document.datos.pass.value != document.datos.pass1.value)
                {
                        alert("Contrasenas diferentes, por favor confirme sus Datos");
                        return;
                }


                document.datos.submit();
}
</SCRIPT>
</head>

<body onLoad="window.document.login.id.focus();">
<form name="datos" method="post">

<p><font class="NoiseFormHeaderFont">Cambio de Clave de Acceso</font></p> 
<table border="0" cellspacing="1" cellpadding="2" align="center" 
class="NoiseFormTABLE"> 
  <tr> 
    <td width="413" class="NoiseErrorDataTD">&nbsp;</td> 
  </tr> 
  <tr> 
          <td class="NoiseFieldCaptionTD"><span class="style5"><font 
color="FFFFFF"> 
Cambiar Contrasena de Acceso</font></span></td></tr> 
<tr> 
  <td> 
<table  align="center" cellpadding="1" cellspacing="2" border="0" width="22%">
  <tr>
    <td bgcolor="#f0f6ff">
      <div align="center"><b><font face="Tahoma" size="2">Nombre de Usuario</font></b></div>
    </td>
    <td bgcolor="#f0f6ff">
      <div align="center"><b><font face="Tahoma" size="2">Digite Nueva Clave</font></b></div>
    </td>
    <td bgcolor="#f0f6ff">
      <div align="center"><b><font face="Tahoma" size="2">Confirmar Clave</font></b></div>
    </td>
  </tr>
  <tr>
    <td width="51%" bgcolor="#f0f6ff">
      <div align="right">
        <input name="id" type="text" value="<?php echo $id;?>">
    </div></td>
    <td width="51%" bgcolor="#f0f6ff">
      <div align="left"><font face="Tahoma">
        <input name="pass" type="password">
    </font></div></td>
    <td width="51%" bgcolor="#f0f6ff">
      <div align="left"><font face="Tahoma">
        <input name="pass1" type="password">
    </font></div></td>
  </tr>
  <tr>
    <td colspan="3" align="center">
     <!-- <input type="submit" value="Aceptar" name="submit"> -->
          <input type="button" onclick="enviar();" value="  Aceptar  ">
    </td>
  </tr>
</table>
</td> 
 </tr> 
 <tr> 
  <td class="NoiseErrorDataTD">&nbsp;</td> 
 </tr> 
</table>
</form>
</body>
</html>
