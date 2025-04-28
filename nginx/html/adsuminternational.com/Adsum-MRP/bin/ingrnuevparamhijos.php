<?php
    include ( '../src/FunPerPriNiv/pktblmenucomp.php');
    include ( '../src/FunPerSecNiv/fncnumreg.php');
    include ( '../src/FunPerSecNiv/fncfetch.php');
    include ( '../src/FunPerPriNiv/pktblgrupcomp.php');
    include ( '../src/FunPerSecNiv/fncclose.php');
    include ( '../src/FunPerSecNiv/fncconn.php');
    include('../src/FunPerPriNiv/scanmenucomp.php');
    
    if($flagret)
    {
    	include ('../src/FunGen/fncradioparamet1.php');
		$idcon = fncconn();
		$result = fncradioparamet1($valores,$idcon,&$mecoscri,&$flag);
		fncclose($idcon);
		if($flag == 0)
		{
			$flag = 1;
		   	print '<script language="JavaScript">
        	<!-- Begin
        	location="'.$mecoscri.'?idgrupotemp='.$idgrupotemp.'&codigo='.$codigo.'&accionnuevogrupo=1&grupnomb='.$grupnomb.'";
        	//  End -->
        	</script>';
		   	
		}
		
	}
?>
<html>
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
        	document.form1.flagret.value = 1;
        	document.form1.action='ingrnuevparamhijos.php?valores='+valores;
	    	document.form1.submit();
        }
    }
//  End -->
</script>
<head>
<title>Asignacion de permisos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
</head>
<body bgcolor="#FFFFFF" text="#000000">
<div align="center">
<form name="form1" method="post" enctype="multipart/form-data">
    <table width="48%" border="0" cellspacing="1" cellpadding="2" class="NoiseFormTABLE">
      <tr>
        <td class="NoiseErrorDataTD">&nbsp;</td>
      </tr>
      <tr>
        <td class="NoiseFieldCaptionTD"><span class="style5">
		<font color="FFFFFF">Selecionar submodulos o maestros</font></span></td>
      </tr>
      <tr>
        <td colspan="2">
          <table width="100%">
            <tr>
              <td bgcolor="#E8F0F6">
                <table cellspacing=0 cellpadding=5 width=100% bgcolor=#f7f7f7 border=0 align="center">
                  <tbody>
                    <?php
                        include ('../src/FunGen/fncradioparamet.php');
					    $idcon = fncconn();
					    fncradioparamet($valores,$idcon,0,$flag);
					    fncclose($idcon);
              
                          ?>
                  </tbody>
              </table></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2">
          <div align="center">
            <input type="image" name="aceptar" onclick="sig();" alt="Aceptar" border=0 width="86" height="18" src="../img/aceptar.gif">
            <input type="image" name="cancelar" onclick="form1.action='ingrnuevparamet.php';submit();"
alt="Cancelar" border=0 src="../img/cancelar.gif" width="86" height="18">
            </div></td>
      </tr>
      <tr>
        <td class="NoiseErrorDataTD">&nbsp;</td>
      </tr>
    </table>
    <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
    <input type="hidden" name="arrpad" value="<?php echo $valores; ?>">
    <input type="hidden" name="idgrupotemp" value="<?php echo $idgrupotemp;; ?>">
    <input type="hidden" name="grupnomb" value="<?php echo $grupnomb; ?>">
    <input type="hidden" name="grupcodi" value="<?php echo $grupcodi; ?>">
    <input type="hidden" name="flagret">
    <input type="hidden" name="flag" value="<?php echo $flag; ?>">
    <input type="hidden" name="ed" value="<?php echo $ed; ?>">
  </form>
</div>
</body>
</html>

