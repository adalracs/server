<?php
ob_start();

	include ( '../src/FunPerPriNiv/pktblvistaotservicioest.php');
	include ( '../src/FunPerPriNiv/pktblservicio.php');
	include ( '../src/FunPerPriNiv/pktbltarea.php');
	include ( '../src/FunPerPriNiv/pktblpriorida.php');
	include ( '../src/FunPerPriNiv/pktbldepartamento.php');
	include ( '../src/FunPerPriNiv/pktblciudad.php');
	include ( '../src/FunPerPriNiv/pktblotestado.php');
	include ( '../src/FunPerSecNiv/fncconn.php');
	//$campo=0;
ob_end_flush();
?>

<html>
<head>
<title>Detalle Programacion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="expires" content="0">
<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
function xtrem_cods(index_sel){
	code_m = index_sel.split(",")
	form2.ordtracodigo.value = code_m[0];
	form2.otestacodigo.value = code_m[1];
}

</script>
<style type="text/css">
.estilo1 {font-size: 85%; font-family : Arial } 
</style>
</head>
<body bgcolor="FFFFFF" text="#000000">
<form name="form2" method="post"  enctype="multipart/form-data">

  <table width="100%" border="0" cellspacing="1" cellpadding="1"  align="center" cols="8">
    <tr>
	  <td class="NoiseFieldCaptionTD" width="4%"><font color="#FFFFFF">Sel.</font></td>
	  
	  <td class="NoiseFieldCaptionTD" width="10%"><font color="#FFFFFF">&nbsp;No. Orden</font></td>
	  <td class="NoiseFieldCaptionTD" width="18%"><font color="#FFFFFF">&nbsp;ODS</font></td>
	  <td class="NoiseFieldCaptionTD" width="18%"><font color="#FFFFFF">&nbsp;Departamento</font></td>
	  <td class="NoiseFieldCaptionTD" width="18%"><font color="#FFFFFF">&nbsp;Ciudad</font></td>
	  <td class="NoiseFieldCaptionTD" width="15%"><font color="#FFFFFF">&nbsp;Servicio</font></td>
	  <td class="NoiseFieldCaptionTD" width="10%"><font color="#FFFFFF">&nbsp;Tipo orden</font></td>
	  <!--<td class="NoiseFieldCaptionTD" width="16%"><a href="detallarotcargado.php?campo='priorida.priorinombre'"><font color="#FFFFFF">&nbsp;Prioridad</font></td>-->
	  <td class="NoiseFieldCaptionTD" width="8%"><font color="#FFFFFF">&nbsp;Estado</font></td>
	</tr>
	<?php
		include ( '../src/FunGen/fncdetallaotcargado.php');
		fncdetallaotcargado($campo,$estado,$depto,$ciudad,$servicicodigo);
	?>	
  </table>
 
  <input type="hidden" name="ordtracodigo" value="<?php echo $ordtracodigo ?>">
  <input type="hidden" name="otestacodigo" value="<?php echo $otestacodigo?>">
</form>
</body>
</html>
