<?php 

  include ( '../src/FunGen/sesion/fncvalses.php');
  include ('../src/FunGen/cargainput.php');
  
  if(!$flagdetallartipooper) 
  {     
    include ( '../src/FunGen/sesion/fnccarga.php'); 
    $sbreg = fnccarga($nombtabl,$radiobutton);
    
    if (!$sbreg){ 
      include( '../src/FunGen/fnccontfron.php');
    }

    $tipopecodigo = $sbreg["tipopecodigo"];
    $tipopenombre = $sbreg["tipopenombre"];
    $tipopedescri = $sbreg["tipopedescri"];

  } 

?>
<html> 
  <head> 
    <title>Detalle de registro de tipo de operacion</title> 
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
    <meta http-equiv="expires" content="0"> 
    <?php include('../def/jquery.library_maestro.php');?>
  </head> 
<?php if(!$codigo){ echo "<!--";} ?> 
  <body bgcolor="FFFFFF" text="#000000"> 
    <form name="form1" method="post"  enctype="multipart/form-data"> 
      <p><font class="NoiseFormHeaderFont">Tipo de operacion</font></p> 
      <table border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content" width="650">
          <tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
          <tr><td class="ui-widget-header"><span class="style5"><font color="FFFFFF"> Detallar registro</font></span></td></tr> 
        <tr> 
            <td> 
                  <table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
              <tr> 
                <td width="20%" class="NoiseFooterTD">&nbsp;Codigo&nbsp;</td> 
                  <td width="80%" class="NoiseDataTD"><?php echo ($tipopecodigo)? $tipopecodigo : "---" ; ?></td> 
              </tr> 
              <tr> 
                <td class="NoiseFooterTD">&nbsp;Nombre&nbsp;</td> 
                  <td class="NoiseDataTD"><?php echo ($tipopenombre)? $tipopenombre : "---" ;?></td> 
              </tr> 
              <tr><td colspan="2" class="NoiseErrorDataTD"></td></tr>
              <tr><td colspan="2" class="NoiseFooterTD">&nbsp;Nota</td></tr>
              <tr><td colspan="2" rowspan="2" class="NoiseDataTD"><?php echo $tipopedescri; ?></td></tr>
            </table> 
          </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
          <td class="NoiseErrorDataTD" align="center"><?php include '../def/jquery.button_formdetall.php'; ?></td>
        </tr>
        <tr><td>&nbsp;</td></tr> 
        <tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
      </table> 
      <input type="hidden" name="flagdetallartipooper" value="1"> 
      <input type="hidden" name="acciondetallartipooper">
      <input type="hidden" name="sourcetable" value="<?php echo $sourcetable; ?>">
      <input type="hidden" name="sourceaction" value="detallar">      
      <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
      <input type="hidden" name="columnas" value="tipopecodigo, tipopenombre, tipopedescri">
      <input type="hidden" name="tipopecodigo" value="<?php if($accionconsultartipooper) echo $tipopecodigo; ?>"> 
      <input type="hidden" name="tipopenombre" value="<?php if($accionconsultartipooper) echo $tipopenombre; ?>"> 
      <input type="hidden" name="tipopedescri" value="<?php if($accionconsultartipooper) echo $tipopedescri; ?>"> 
    </form> 
  </body> 
<?php if(!$codigo){ echo " -->"; } ?> 
</html>