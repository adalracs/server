<?php 

  include ('../src/FunPerPriNiv/pktbltipooper.php'); 
  include ('../src/FunPerPriNiv/pktblusuario.php');
  include ('../src/FunGen/sesion/fnccantrow1.php'); 
  include ('../src/FunGen/sesion/fnccantrow.php');
  include ('../src/FunGen/sesion/fncalmdat.php'); 
  include ('../src/FunGen/sesion/fncvalses.php'); 
  include ('../src/FunPerPriNiv/limitscan.php'); 
  include ('../src/FunGen/sesion/fnccaf.php'); 

  $reccomact = fnccaf ( $GLOBALS ['usuacodi'], $_SERVER ["SCRIPT_FILENAME"] ); 
 
  if ($accionborrartipooper) { 
    include ("borratipooper.php"); 
  } else { 
    if ($accionconsultartipooper) { 
      $nusw = 0; 
      $nombcamp = strtok ( $columnas, "," ); 
      while ( $nombcamp ) { 
        $nombcamp = trim ( $nombcamp ); 
        $recarreglo [$nombcamp] = $$nombcamp; 
        if ($recarreglo [$nombcamp]) { 
          $nusw = 1; 
        } 
        $nombcamp = strtok ( "," ); 
      } 
      if (! $nusw) { 
        $accionconsultartipooper = 0; 
      } 
    } 
  } 
  include ("../src/FunGen/sesion/fncaumdec.php"); 
  include ("../src/FunGen/fncpageposition.php"); 
 
  $intervalo = fncaumdec ( "tipooper", $inicio, $fin, $mov, $accionconsultartipooper, $recarreglo ); 
  $cantrow = $intervalo ["total"]; 
  if ($intervalo ["idtrans"]) { 
    $idtrans = $intervalo ["idtrans"]; 
  } 

?> 
<!doctype html> 
<html> 
<head> 
<title>Listado de tipo de operaciones</title> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
<meta http-equiv="expires" content="0"> 
<meta http-equiv="X-UA-Compatible" content="IE=9"> 
<script language=JavaScript src="../src/FunGen/starPage_position.js" type="text/javascript"></script> 
<script language="JavaScript" type="text/javascript" src="../src/FunGen/fncsetcheck.js"></script> 
<script language="javascript" type="text/javascript" src="../src/FunGen/fncremembercheck.js"></script> 
<script language=JavaScript src="../src/FunGen/colorfooter.js" type="text/javascript"></script> 
<?php include ('../def/jquery.library_maestro.php'); ?> 
</head> 
<?php if (! $codigo) { echo "<!--"; } ?> 
<body bgcolor="FFFFFF" class="NoisePageBODY"> 
<form name="form1" method="post" enctype="multipart/form-data"> 
<p><font class="NoiseFormHeaderFont">Listado de tipo de opeaciones</font></p> 
<table border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content" width="600"> 
  <tr> <td class="NoiseErrorDataTD" align="right"> <?php page_position ( $intervalo, 'maestabltipooper.php', $flagcheck ); ?></td> </tr> 
  <tr> <td>&nbsp;</td> </tr> 
  <tr> <td align="left" class="NoiseErrorDataTD"><div class="ui-buttonset"><?php include('../def/jquery.maestablbuttons.php');?></div></td></tr> 
  <tr> <td>&nbsp;</td> </tr> 
  <tr> <td><?php include ('../def/jquery.button_navup.php'); ?></td></tr> 
  <tr> <td></td> </tr> 
  <tr> <td></td> </tr> 
  <tr> 
    <td> 
    <table width="100%" border="0" align="center" cellspacing="1" 
      cellpadding="1" class="ui-widget-content"> 
      <tr> 
        <td width="5%"class="ui-state-default tbl-head-font">Sel.</td>
        <td width="15%" class="ui-state-default tbl-head-font">Codigo</td>
        <td width="80%" class="ui-state-default tbl-head-font">Nombre</td>        
      </tr>
        <?php 
        include ('../src/FunGen/sesion/fncvisregtipooper.php'); 
        $reg [0] = 'tipopecodigo'; 
        $reg1 [0] = 'n'; 
        $nureturn = fncvisregtipooper ( 'tipooper', $reg, $reg1, $idtrans, $arr_borrar, $flagcheck); 
        ?> 
    </table> 
    </td> 
  </tr> 
  <tr> <td></td> </tr> 
  <tr> <td></td> </tr> 
  <tr> <td><?php include ('../def/jquery.button_navdown.php'); ?></td> </tr> 
  <tr> <td>&nbsp;</td> </tr> 
  <tr> <td class="NoiseErrorDataTD" align="right"> <?php page_position ( $intervalo, 'maestabltipooper.php', $flagcheck ); ?></td> 
  </tr> 
</table> 
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
<input type="hidden" name="inicio" value="<?php echo $intervalo ["inicio"]; ?>"> 
<input type="hidden" name="fin" value="<?php echo $intervalo ["fin"]; ?>"> 
<input type="hidden" name="sourcetable" value="tipooper"> 
<input type="hidden" name="selstar" id="selstar" value="0"> 
<input type="hidden" name="nombtabl" value="tipooper"> 
<input type="hidden" name="columnas" value="tipopecodigo, tipopenombre, tipopedescri"> 
<input type="hidden" name="tipopecodigo" value="<?php if ($accionconsultartipooper) { echo $tipopecodigo; } ?>">  
<input type="hidden" name="tipopenombre" value="<?php if ($accionconsultartipooper) { echo $tipopenombre; } ?>">  
<input type="hidden" name="tipopedescri" value="<?php if ($accionconsultartipooper) { echo $tipopedescri; } ?>">  
<input type="hidden" name="accionconsultartipooper" value="<?php echo $accionconsultartipooper; ?>"> 
<input type="hidden" name="mov"><!-- Permite el cambio de checkbox/radiobuttion --> 
<input type="hidden" name="flagcheck" value="<?php echo $flagcheck; ?>"><!-- Campos a visualizar en maestablborrgen --> 
<input type="hidden" name="selcampos" value="ordoppcodigo"><!--         --> 
<input type="hidden" name="arr_borrar" value="<?php echo $arr_borrar; ?>"> 
<input type="hidden" name="arreglo_b"> <!--           --></form> 
<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div> 
</body> 
<?php if (! $codigo) { echo " -->"; } ?> 
</html> 
