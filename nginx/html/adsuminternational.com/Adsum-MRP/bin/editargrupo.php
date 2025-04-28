<?php
include ( '../src/FunGen/sesion/fncvalses.php');
if(!$flageditargrupo)
{
	include ( '../src/FunGen/sesion/fnccarga.php');
	$sbreg = fnccarga('grupo',$radiobutton);
	if (!$sbreg)
	{
		include( '../src/FunGen/fnccontfron.php');
	}
}
?>
<html>
<head>
<title>Editar registro de Grupo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
<script language="JavaScript">
<!-- Begin
function sig()
{
	var valores="";
	var nombres="";
	
	for (var i=0;i < document.form1.elements.length;i++)
	{
		if(document.form1.elements[i].type == "checkbox" &&
		document.form1.elements[i].checked == true)
		{
			valores = valores+document.form1.elements[i].value+",";
			nombres = nombres+document.form1.elements[i].name+",";
		}
	}
	if(document.form1.grupnomb.value == "")
	{
		alert("No existe nombre");
		return;
	}
	if(valores == "")
	{
		alert("Selecione alguna casilla");
		return;
	}
	document.form1.action='ingrnuevpermisos.php?valores='+valores+'&nombres='+nombres+'&grupcodi='+document.form1.grupcodi.value;
	document.form1.submit();
}
function foo(){ form1.accioneditargrupo.value =  1; }
//  End -->
</script>
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
<body bgcolor="#FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data">
<p><font class="NoiseFormHeaderFont">Editar grupo</font></p>
<table width="65%" border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
 <tr>
      <td class="NoiseFieldCaptionTD" colspan="2">&nbsp;</td>
    </tr>
          <tr>
            <td>
              <input type="hidden" name="grupcodi" value="<?php
                    if($sbreg){ echo $sbreg[grupcodi];}else{ echo $grupcodi; } ?>"
                    onFocus="if (!agree)this.blur();" >
            </td>
          </tr>
          <tr>
      <td width="56" bgcolor="#f0f6ff"><font size="2" face="Arial, Helvetica,sans-serif">Nombre</font></td>
      <td width="302" bgcolor="#f0f6ff">
              <input type="text" name="grupnomb"	value="<?php
                    if($sbreg){ echo $sbreg[grupnomb];}else{ echo $grupnomb;} ?>" size="20">
            </td>
          </tr>
          <tr>
      <td colspan="3" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">Permiso</font></span></td>
    </tr>
    <tr>
      <td colspan="3">
        <table width="90%" border="0" cellspacing="0" cellpadding="0"
align="center">
          <tr>
            <td colspan="3" bgcolor="#f0f6ff">
                <?php
                if($radiobutton)
                {
                	include ('../src/FunGen/fnccheckboxed.php');
                	$idcon = fncconn();
                	fnccheckboxed(1,$sbreg[grupcodi],$idcon);
                	fncclose($idcon);
                }
                    ?>
            </td>
          </tr>
          <tr>
            <td colspan="3" bgcolor="#f0f6ff">&nbsp;</td>
          </tr>
      </table>
      </td>
    </tr>
     <tr>
      <td colspan="3" bgcolor="#f0f6ff"><font size="2" face="Arial, Helvetica,sans-serif">Desea que los datos de los usuarios de este grupo se puedan acceder desde el m&oacute;dulo de Personal?&nbsp;</font>
      <select name="grupedit">
      <?php if($sbreg)
      {
      	echo '<option value = "'.$sbreg[grupedit].'">';
      	if($sbreg[grupedit] == 1)
      		echo "Si";
      	elseif($sbreg[grupedit] == 0 || $sbreg[grupedit] == null ) 
      		echo "No";
      }
      elseif($accioneditargrupo)
      { echo '<option value = "'.$grupedit.'">'; 
      	if($grupedit > 0)
			echo "Si";
		elseif($grupedit == 0 || $grupedit == null) 
			echo "No"; 
	  }?></OPTION>
            <option value="1">Si</option>
            <option value="0">No</option>
            </select></td>
      </tr>
       <tr>
           <td colspan="3">&nbsp;</td>
         </tr>
    <tr>
      <td colspan="3">
        <div align="center">
          <input type="image" name="aceptar" onclick="form1.accioneditargrupo.value = 1;sig();"  width="86"
                height="18" alt="Aceptar" border=0 src="../img/aceptar.gif">
          <input type="image" name="cancelar" onclick="form1.action='maestablgrupo.php';submit();"  width="86" height="18"
                alt="Cancelar" border=0 src="../img/cancelar.gif">
          
      </div></td>
    </tr>
    <tr>
      <td class="NoiseFieldCaptionTD" colspan="3">&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="accioneditargrupo">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<input type="hidden" name="radiobutton" value="<?php echo $radiobutton;?>">
</form>
</body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
