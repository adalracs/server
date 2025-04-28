<?php
include ( '../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerSecNiv/fncfetch.php');
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncclose.php');
include ( '../src/FunPerPriNiv/pktblarticulo.php');
include ( '../src/FunPerPriNiv/pktblfactura.php');
include ( '../src/FunPerPriNiv/pktblitem.php');

if($articucodigo>0)
{
  		
  $idcon = fncconn();
  $sbregarticulo = loadrecordarticulo($articucodigo,$idcon);
  fncclose($idcon);
  $totvalart = $articanti * $sbregarticulo[articuvalor];
  $totalsub = $totalsub + $totvalart;
  $totvaliva = $articanti * $sbregarticulo[articiva];
  $totaliva = $totaliva + $totvaliva;
  $pagosaldo = $totalsub + $totaliva;	

    include ( 'grabaitem2.php');
    for ($i;$i<$articanti;$i++)
    {
    $sbregitem[articucodigo] = $articucodigo;
    $sbregitem[facturcodigo] = $numero1;
    grabaitem2($sbregitem);
    }
   	    echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("El articulo fue registrado")';
		echo '//-->'."\n";
		echo '</script>';
   
}

?>
<html>
<head>
<title>Nuevo registro de Inserte nombre</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
agree = 0;
//  End -->
</script>
<script language="JavaScript" src="motofech.js"></script>
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="50" topmargin="20"
marginwidth="0" marginheight="0">
<form name="form1" method="post"  enctype="multipart/form-data">
<table width="500" border="1" cellspacing="0" cellpadding="15"
bordercolor="#009933" align="center">
  <tr>
    <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="5"
align="center">
        <tr>
          <td colspan="2"><font face="Arial, Helvetica, sans-serif"
size="3"><b><font color="#006699">Ingresar articulos </font></b></font></td>
        </tr>
        <tr>
          <td background="../img/panel.gif" width="57%"><font
color="669999"><b><font size="3" face="Arial, Helvetica, sans-serif">
<font color="#006699">&nbsp;</font></font></b></font></td>
<td background="../img/panel4.gif" width="43%">&nbsp;</td>
</tr>
<tr>
<td colspan="2">
            <table width="85%" border="0" cellspacing="0" cellpadding="0"
align="center">
            <tr>
                <td width="24%"><font size="2" face="Arial, Helvetica, sans-serif">Cantidad</font></td>
 <td width="31%"><input name="articanti" type="text"	value="<?php if(!$flagnuevopago){ echo
$articanti;}else{ echo $articanti;} ?>" size="17">
 </td>
              </tr>
              <tr>
 <td width="51%"><font size="2" face="Arial, Helvetica, sans-serif">ESCOJA ARTICULO</font></td>
 <td width="49%"><select name="articucodigo" onChange="form1.action='ingrnuevitem3.php';submit();"  >
   <option value="">Seleccione
   <?php
					include ( '../src/FunGen/floadarticulo.php');
					$idcon = fncconn();
					floadarticulo($idcon);
					fncclose($idcon);
				?>
  </select></td>
 </tr>
              <tr>
                <td><font size="2" face="Arial, Helvetica, sans-serif">Nombre:</font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">
                  <input type="text" name="articunombre" size="17" value="<?php
		if(!$flagdetallaritem){ echo $sbregarticulo[articunombre];
		$articulo=$sbregarticulo[articunombre];}else{ echo
		$articunombre;
		$articulo=$articunombre;} ?>" >
                </font></td>
              </tr>
              <tr>
                <td><font size="2" face="Arial, Helvetica, sans-serif">Valor sin IVA $</font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">
                  <input type="text" name="articuvalor" size="17" value="<?php
		if(!$flagdetallaritem){ echo $sbregarticulo[articuvalor];}else{ echo
		$articuvalor;} ?>" onFocus="if (!agree)this.blur();" >
                </font></td>
              </tr>
              <tr>
                <td><font size="2" face="Arial, Helvetica, sans-serif">Valor IVA $</font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">
                  <input type="text" name="articiva2" size="17" value="<?php
		if(!$flagdetallaritem){ echo $sbregarticulo[articiva];}else{ echo
		$articiva;} ?>" onFocus="if (!agree)this.blur();" >
                </font></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><strong><font size="2" face="Arial, Helvetica, sans-serif">TOTALES</font></strong></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;
</font></td>
              </tr>
              <tr>
                <td><strong><font size="2" face="Arial, Helvetica, sans-serif">Valor de articulo(s) </font></strong></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">                 $
                    <input type="text" name="totvalart" size="12" value="<?php
		if(!$flagdetallaritem){ echo $totvalart;}else{ echo
		$totvalart;} ?>" onFocus="if (!agree)this.blur();" >
                </font></td>
                </tr>
              <tr>
                <td height="26"><strong><font size="2" face="Arial, Helvetica, sans-serif">IVA</font></strong></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">                $
                    <input type="text" name="totvaliva" size="12" value="<?php
		if(!$flagdetallaritem){ echo $totvaliva;}else{ echo
		$totvaliva;} ?>" onFocus="if (!agree)this.blur();" >
                </font></td>
                </tr>
</table>
  </td>
 </tr>
 <tr>
  <td colspan="2"><div align="center">
  <input type="image" name="cancelar" src="../img/aceptar.gif"
   onclick="form1.flagfacturaventa.value = 0;
   form1.action='ingrnuevventa.php';"  width="86" height="18"
   alt="Totalizar cuenta" border=0>
  </div></td>
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
<input name="facturfecha" type="hidden" onFocus="if (!agree)this.blur();" value="<?php $fecha=getdate(); $cad=$fecha[year]."-".$fecha[mon]."-".$fecha[mday]; echo $cad ?>">
<input type="hidden" name="facturprepar" value="<?php $prepar="luz mary" ; echo $prepar ?>">
<input name="facturhora" type="hidden" value="<?php $hora=getdate(); $cad=$hora[hours].":".$hora[minutes]; echo $cad ?>">
<input type="hidden" name="facturtexto" value="<?php $facturtexto="Esta factura
 se asimila en sus efectos legales a la letra de cambio";echo $facturtexto;?>">


<input type="hidden" name="numero1" value="<?php echo $numero1; ?>">
<input type="hidden" name="totalsub" value="<?php echo $totalsub; ?>">
<input type="hidden" name="pagosaldo" value="<?php echo $pagosaldo; ?>">
<input type="hidden" name="totaliva" value="<?php echo $totaliva; ?>">
<input type="hidden" name="totalven" value="<?php echo $totalven; ?>">

<input type="hidden" name="maxcodfacturnum" value="<?php echo $maxcodfacturnum; ?>">
<input type="hidden" name="flagfacturaventa">
<input type="hidden" name="maxcodfact" value="<?php echo $maxcodfact; ?>">
<input type="hidden" name="itemcodigo" value="<?php if(!$flagnuevoitem){ echo
$sbreg[itemcodigo];}else{ echo $itemcodigo; } ?>" onFocus="if
(!agree)this.blur();" >
<input type="hidden" name="flagnuevoitem" value="1">
<input type="hidden" name="accionnuevoitem">
<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
<input type="hidden" name="nuevo" value="<?php echo $nuevo; ?>">
<input type="hidden" name="borrar" value="<?php echo $borrar; ?>">
<input type="hidden" name="consultar" value="<?php echo $consultar; ?>">
<input type="hidden" name="detallar" value="<?php echo $detallar; ?>">
<input type="hidden" name="modificar" value="<?php echo $modificar; ?>">
</form>
</body>

</html>
