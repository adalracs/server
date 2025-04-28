<?php
   include ( '../src/FunGen/sesion/fncvalses.php');
   include ( '../src/FunPerPriNiv/pktblgrupo.php');
   include ( '../src/FunPerPriNiv/fnclock.php');
   include ( '../src/FunPerPriNiv/fnccommit.php');
   include('../src/FunPerPriNiv/scanmenucomp.php');
   include ( 'grabagrupotemp.php');
    if($switche)
    {
        $reggrupo[grupcodi] = $grupcodi;
        $reggrupo[grupnomb] = "temp";
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
        var valores = 0;
     	var cont = 0;
     	var aux = 0;

        for (var i=0;i < document.form1.elements.length;i++)
        {
            if(document.form1.elements[i].type == "radio" && document.form1.elements[i].checked == true)
            {
            	valores = document.form1.elements[i].value;
            	aux = 1;
            }
        }
   
        if(aux == 0)
        {
            alert("selecione alguna casilla");
            return;
        }else
        {
        	document.form1.action='ingrnuevparamhijos.php?valores='+valores;
	    	document.form1.submit();
        }
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
  <p><font class="NoiseFormHeaderFont">Ingresar nuevo par&aacute;metro</font></p>
  <table border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">
    <tr>
      <td class="NoiseErrorDataTD" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" class="NoiseFieldCaptionTD"><span class="style5"><font color="#FFFFFF">Par&aacute;metros</font></span></td>
    </tr>
        <tr>
    <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
      <td colspan="2">
        <table width="71%" border="0" cellspacing="0" cellpadding="0"
align="center">
        <tr>
    <td>&nbsp;</td>
    <td><b>Seleccionar Modulo<b></td>
    </tr>
          <tr>
            <td colspan="2" bgcolor="#f0f6ff">
              <?php
                        include ('../src/FunGen/fncradioparamet.php');
					    $idcon = fncconn();
					    fncradioparamet(1,$idcon,1,0);
					    fncclose($idcon);
                    ?>
            </td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <div align="right"> <font color="#ffffff">Espacio vacio</font>
          <input type="image" name="siguiente" onClick="sig();" alt="Aceptar" border=0 width="86" height="18" src="../img/aceptar.gif">
          <input type="image" name="cancelar" onClick="form1.action='main.html';submit();" alt="Cancelar" border=0 width="86" height="18" src="../img/cancelar.gif">
          <font color="#FFFFFF">Espacio vacio</font></div>
      </td>
    </tr>
    <tr>
      <td class="NoiseErrorDataTD" colspan="2">&nbsp;</td>
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
