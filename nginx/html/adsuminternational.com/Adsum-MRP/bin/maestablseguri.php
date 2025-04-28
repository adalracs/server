<?php
include ( '../src/FunGen/sesion/fncvalses.php');
if($accionnuevobackup) 
		{ 
			include ( 'guardabackup.php'); 
		} 
?> 
<html> 
<head> 
<title>Nuevo registro de Inserte nombre</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<meta http-equiv="expires" content="0"> 
</head> 
<?php
if(!$codigo)
{ echo "<!--";}
?>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="50" topmargin="20" marginwidth="0" marginheight="0">
<form name="form1" method="post"  enctype="multipart/form-data">
<table width="500" border="1" cellspacing="0" cellpadding="15"
bordercolor="#009933" align="center">
  <tr>
    <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="5"
align="center">
        <tr>
          <td colspan="2"><font face="Arial, Helvetica, sans-serif"
size="3"><b><font color="#006699">Copia de sguridad</font></b></font></td>
        </tr>
        <tr>
          <td colspan="2" background="../img/panel.gif"><font
color="669999"><b><font size="3" face="Arial, Helvetica, sans-serif"><font color="#006699">&nbsp;</font></font></b></font></td>
</tr>
<tr>
<td colspan="2">
            <table width="85%" border="0" cellspacing="0" cellpadding="0"
align="center">
              <tr>
                <td><font size="2" face="Tahoma">Usted va a sacar la copia de seguridad correspondiente al d&iacute;a 
				
				</font></td>
                </tr>
              <tr>
                <td><div align="center"><font size="2" face="Tahoma" color="#000099">
                <?php print (date(j)."-".date(m)."-".date(Y));?></font></div></td>
                </tr>
              <tr>
                <td>
                  <div align="center">
                  <font size="2" face="Tahoma">La fecha va a salir con el siguiente formato
                  </font></div></td></tr>
<tr>
  <td><div align="center"><font size="2" face="Tahoma" color="#000099">
  <strong>d&iacute;amesa&ntilde;o.tar.bz2</strong></font></div></td>
  </tr>
<tr>
  <td><div align="center">
  </div></td>
</tr>
<tr>
  <td><div align="center">
    <input type="image" name="aceptar42" src="../img/aceptar.gif"
	onClick="form1.accionnuevobackup.value =  1;form1.action='guardabackup.php';"
				width="86" height="18" alt="Aceptar" border=0>
  </div></td>
</tr> 
</table>  </td> 
 </tr> 
 <tr> 
  <td colspan="2"><div align="center">    </div></td> 
 </tr> 
 <tr> 
  <td background="../img/panel2.gif" width="57%">&nbsp;</td> 
  <td background="../img/panel5.gif" width="43%"> 
   <div align="left"></div> 
  </td> 
 </tr> 
</table> 
  </td> 
 </tr> 
</table> 
<input type="hidden" name="flagnuevobackup" value="1"> 
<input type="hidden" name="accionnuevobackup"> 
</form> 
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
