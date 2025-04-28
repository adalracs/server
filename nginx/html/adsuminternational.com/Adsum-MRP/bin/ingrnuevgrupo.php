<?php
   include ( '../src/FunGen/sesion/fncvalses.php');
   include ( '../src/FunPerPriNiv/pktblgrupo.php');
   include ( '../src/FunPerPriNiv/fnclock.php');
   include ( '../src/FunPerPriNiv/fnccommit.php');
   include ( 'grabagrupotemp.php');
    if($switche)
    {
        $reggrupo[grupcodi] = $grupcodi;
        $reggrupo[grupnomb] = "temp";
        $reggrupo[grupedit] = 0;
        $idgrupotemp = grabagrupotemp($reggrupo);
    } 

?>
<html>
<head>
<title>Nuevo registro de Grupo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
agree = 0;
//  End -->
</script>
<script language="JavaScript" src="motofech.js"></script>
<script language="JavaScript">
    <!-- Begin
    function sig()
    {

	var cont = 0;
        var valores="";
        var nombres="";
	var nomb = document.form1.grupnomb.value;
	var cont = 0;

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

	while(cont < nomb.length)
	{
	    if(nomb.charAt(cont) == " ")
    	    {
		if(nomb.charAt(cont -1) == "" && nomb.charAt(cont +1) == "")
		{
	    	    alert("Espacio no es un caracter v�lido");
       	            return;
		}
		else
		{
		    if(nomb.charAt(cont -1) == " " && nomb.charAt(cont +1) == "")
		    {
			alert("No puede terminar con espacios");
			return;
		    }
		    else
		    {
		        if(nomb.charAt(cont -1) == " ")
			{
			    alert("Por favor digite s�lo un espacio entre las palabras");
       	    		    return;
			}
			else
			{
			    if(nomb.charAt(cont +1) == "")
			    {
				alert("No puede terminar con espacios");
       	    			return;
			    }
			    else
			    {
				if(nomb.charAt(cont +1) == " " && nomb.charAt(cont -1) == "")
				{
	    		    	    alert("No puede iniciar con espacios");
       	    		    	    return;
				}
				else
				{
				    if(nomb.charAt(cont -1) == "")
				    {
	    				alert("No puede inciar con espacios");
       	    				return;
				    }
				}
			    }
			}
		    }
		}
	    }
    	    cont++;
	}
	var checkOK = "'�/\|!�*+[]{}?$&";
//	var checkOK = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	var i = 0;
	var j = 0;
	var allValid = true;

	for (i = 0; i < nomb.length; i++)
	{
		var ch = nomb.charAt(i);
 		for (j = 0; j < checkOK.length; j++)
 		{
			if(ch == checkOK.charAt(j))
			{
				alert("Caracteres no validos en el campo Nombre");
		  		return;
      		}
		}
 	}

        if(valores == "")
        {
            alert("selecione alguna casilla");
            return;
        }
        document.form1.action='ingrnuevpermisos.php?valores='+valores+'&nombres='+nombres;
        document.form1.submit();
    }
//  End -->
</script>
</head>
<?php
    if(!$codigo)
    { echo "<!--";}
?>
<body bgcolor="#FFFFFF" text="#000000">
<form name="form1" method="post"  enctype="multipart/form-data">
  <p><font class="NoiseFormHeaderFont">Ingresar nuevo grupo</font></p>
  <table width="65%" border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
    <tr>
      <td class="NoiseFieldCaptionTD" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td width="56" bgcolor="#f0f6ff"><font size="2" face="Arial, Helvetica,sans-serif">Nombre</font></td>
      <td width="302" bgcolor="#f0f6ff">
        <input type="text" name="grupnomb"	value="<?php echo $grupnomb; ?>" size="20" >
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
                        include ('../src/FunGen/fnccheckbox.php');
					    $idcon = fncconn();
					    fnccheckbox(1,'',$idcon);
					    fncclose($idcon);
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
            <option value="1">Si</option>
            <option value="0">No</option>
            </select></td>
      </tr>
      <tr>
           <td colspan="3">&nbsp;</td>
         </tr>
    <tr>
      <td colspan="3">
        <div align="center"> <font color="#FFFFFF">Espacio vacio</font>
          <input type="image" name="siguiente" onClick="sig();" alt="Aceptar" border=0 width="86" height="18" src="../img/aceptar.gif">
          <input type="image" name="cancelar" onClick="form1.action='maestablgrupo.php';submit();" alt="Cancelar" border=0 width="86" height="18" src="../img/cancelar.gif">
          <font color="#FFFFFF">Espacio vacio</font></div>
      </td>
    </tr>
    <tr>
      <td class="NoiseFieldCaptionTD" colspan="3">&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="flagnuevogrupo" value="1">
<input type="hidden" name="accionborragrupotemp" value="">
<input type="hidden" name="accionnuevogrupo">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<input type="hidden" name="idgrupotemp" value="<?php echo $idgrupotemp; ?>">
<input type="hidden" name="accionborragrupotemp" value="1">
</form>
</body>
<?php
    if(!$codigo)
    { echo " -->"; }
?>
</html>
