<?php
ob_start();

	include ( '../src/FunPerPriNiv/pktblvistaotservicio.php');
	include ( '../src/FunPerPriNiv/pktblvistaotservicioest.php');
	include ( '../src/FunPerPriNiv/pktblsemaforoestado.php');
	
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
<link href="temas/Noise/semaforo.css" rel="stylesheet" type="text/css" />
<SCRIPT language=JavaScript src="../src/FunGen/jsrsClient.js"		type="text/javascript" ></SCRIPT>
<SCRIPT LANGUAGE="JavaScript">
function open_window(index_sel){
	
		
		form2.campo.value= 0;
	//alert(form2.campo.value);
}

</script>
<style type="text/css">
.estilo1 {font-size: 85%; font-family : Arial } 
</style>
</head>
<body bgcolor="FFFFFF" text="#000000">
<form name="form2" method="post"  enctype="multipart/form-data">

  <table width="100%" border="0" cellspacing="1" cellpadding="1"  align="center" cols="8">
  <?php 
	switch ($estado):
		case 1 : 
			echo '<tr><td class="NoiseFieldCaptionTD" colspan = "8" id="verde" align="center"><font color="#FFFFFF">Estado</font></td></tr>';
			break;
		case 2 :
			echo '<tr><td class="NoiseFieldCaptionTD" colspan = "8" id="naranja" align="center"><font color="#FFFFFF">Estado</font></td></tr>';
			break;
		case 3 :
			echo '<tr><td class="NoiseFieldCaptionTD" colspan = "8" id="rojo" align="center"><font color="#FFFFFF">Estado</font></td></tr>';
			break;
		case 4:
			echo '<tr><td class="NoiseFieldCaptionTD" colspan = "8" id="negro" align="center"><font color="#FFFFFF">Estado</font></td></tr>';
			break;
	endswitch;
		
			
  ?>
    <tr>
	  <td class="NoiseFieldCaptionTD" width="4%" ><font color="#FFFFFF">Sel.</font></td>
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
		include ( '../src/FunGen/fncdetallagencontrolotservicio.php');
		fncdetallarfullqueritiempoest($estado,$deptocodigo,$servicicodigo);
	?>	
  </table>
 
  <input type="hidden" name="ordtracodigo" value="<?php echo $ordtracodigo; ?>">
</form>
</body>
</html>