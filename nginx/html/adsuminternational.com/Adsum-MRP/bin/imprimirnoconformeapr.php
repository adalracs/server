<?php
	include ( '../src/FunPerPriNiv/pktblrecepcionmercancia.php');	
	include ( '../src/FunPerPriNiv/pktblestadoanalisis.php');
	include ( '../src/FunPerPriNiv/pktblmpvaranalisis.php');
	include ( '../src/FunPerPriNiv/pktbltipoitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblprocedimiento.php');
	include ( '../src/FunPerPriNiv/pktblnoconformepr.php');
	include ( '../src/FunPerPriNiv/pktblvaranalisis.php');
	include ( '../src/FunPerPriNiv/pktblanalisispr.php');
	include ( '../src/FunPerPriNiv/pktblfabricante.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblproveedo.php');	
	include ( '../src/FunPerPriNiv/pktblusuario.php');	
	include ( '../src/FunPerPriNiv/pktbllote.php');	
	include ( '../src/FunPerSecNiv/fncsqlrun.php');
	include ( '../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunGen/cargainput.php');

	$idcon = fncconn();

	$rwNoConformePr = loadrecordnoconformepr($codigo,$idcon);

	$nocomcodigo = $rwNoConformePr["nocomcodigo"];
	$analiscodigo = $rwNoConformePr["analiscodigo"];
	$usuacodi1 = $rwNoConformePr["usuacodi1"];
	$usuacodi2 = $rwNoConformePr["usuacodi2"];
	$nocomfecha = $rwNoConformePr["nocomfecha"];
	$nocomhora = $rwNoConformePr["nocomhora"];
	$nocomdescri = $rwNoConformePr["nocomdescri"];

	$rwAnalisisPr = loadrecordanalisispr($analiscodigo,$idcon);

	$ordoppcodigo = $rwAnalisisPr["ordoppcodigo"];
	$procedcodigo = $rwAnalisisPr["procedcodigo"];
	$usuacodigo = $rwAnalisisPr["usuacodi"];
	$analisfecha = $rwAnalisisPr["analisfecha"];
	$estanacodigo = $rwAnalisisPr["estanacodigo"];
	$analisdescri = $rwAnalisisPr["analisdescri"];

	$rsMpvaranalisis = dinamicscanopmpvaranalisis(array("analiscodigo" => $analiscodigo), array("analiscodigo" => "="), $idcon);
	$nrMpvaranalisis = fncnumreg($rsMpvaranalisis);

	for( $a = 0; $a < $nrMpvaranalisis; $a++){

		$rwMpvaranalisis = fncfetch($rsMpvaranalisis,$a);

		$varValor = 'txtvalor'.$rwMpvaranalisis['varanacodigo'];
		$$varValor = $rwMpvaranalisis["mpvaravalor"];

	}

	$recmercantidad = 0;		
?>
<html>
	<head>
		<style>
			.tabla{border-color: #000000;border-width:1px; border-style: solid;margin-left: 0px;margin-top: 0px;margin-right: 0px;margin-bottom: 0px;font-family: Verdana, Arial, Helvetica, sans-serif;font-size:10px;width: 800px;}
			.material{border-color: #000000; border-width:1px; border-style: solid}
			p{margin-left: 0px;margin-top: 0px;margin-right: 0px;margin-bottom: 0px;font-family: Verdana, Arial, Helvetica, sans-serif;font-size:10px;width: 800px;}
		</style>
	</head>
	<body>

		<table border="0" class="tabla" cellpadding="0">
			<tr>
				<td><img src="../img/barra.png"></img></td>
				<td align="center"></td>
				<td align="center"><b>DOCUMENTO EN PRUEBA</b></td>
			</tr>
			<tr>
				<td colspan="3"><font size=2><b>Aseguramiento de Calidad</b></font></td>
			</tr>
		</table>
		<br>

		<table border="0" class="tabla" cellpadding="0">
			<tr>
				<td colspan="4" align="center" class="material">&nbsp;<b>Especificacion del reclamo</b></td>
			</tr>
			<tr>
				<td width="80px">&nbsp;Reclamo No.</td>
				<td width="230px">&nbsp;<?php echo ($nocomcodigo)? strtoupper($nocomcodigo) : '---' ;?></font></td>
			</tr>
			<tr>
				<td width="80px">&nbsp;Fecha</td>
				<td width="230px">&nbsp;<?php echo ($nocomfecha)? strtoupper($nocomfecha) : '---' ;?></font></td>
			</tr>
			<tr>
				<td width="80px">&nbsp;No. OPP</td>
				<td width="230px">&nbsp;<?php echo ($ordoppcodigo)? strtoupper($ordoppcodigo) : '---' ;?></font></td>
			</tr>
			<tr>
				<td width="80px">&nbsp;Proceso</td>
				<td width="230px">&nbsp;<?php echo ($procedcodigo)? cargaprocedimientonombre($procedcodigo,$idcon) : '---' ;?></font></td>
			</tr>
		</table>
		<br>

		<!--<table border="0" class="tabla" cellpadding="0">
			<tr>
				<td colspan="4" align="center" class="material">&nbsp;<b>Especificacion del material</b></td>
			</tr>
			<tr>
				<td width="400px">&nbsp;Material</td>
				<td width="100px">&nbsp;Cantidad</td>
				<td width="100px">&nbsp;</td>
				<td width="100px">&nbsp;Lote No.</td>
			</tr>
			<tr>	
				<td width="400px">&nbsp;<?php //echo ($itedescodigo)? strtoupper(carganombitemdesa($itedescodigo,$idcon)) : "---" ; ?></td>
				<td width="100px">&nbsp;<?php //echo ($recmercantidad)? number_format($recmercantidad, 2, ",", ".") : "---" ; ?></td>
				<td width="100px">&nbsp;<?php //echo ($unidadcodigo)? $unidadcodigo : "---" ; ?></td>
				<td width="100px">&nbsp;<?php //echo ($lotenumero)? strtoupper($lotenumero) : "---" ; ?></td>
			</tr>
		</table>
		<br><br>
		-->

		<table border="0" class="tabla" cellpadding="0">
			<tr>
				<td align="center" class="material">&nbsp;<b>Detalle del reclamo</b></td>
			</tr>
			<tr>
				<td width="600px">&nbsp;<?php echo ($nocomdescri)? $nocomdescri : "---";  ?></td>
			</tr>
		</table>
		<br><br><br><br>
		

		<p><b>Nota:</b> La respuesta a este reclamo se debe realizar en un plazo de 15 días como máximo.</td></p>
		<br>
		<table border="0" class="tabla" cellpadding="0">
			<tr>
				<td width="233px">&nbsp;</td>
				<td width="233px">&nbsp;</td>
			</tr>
			<tr>
				<td width="233px">&nbsp;</td>
				<td width="233px">&nbsp;</td>
			</tr>
			<tr>
				<td width="233px">&nbsp;<?php echo ($usuacodi1)? strtoupper(cargausuanombre($usuacodi1,$idcon)) : '---' ; ?></td>
				<td width="233px">&nbsp;<?php echo ($usuacodi2)? strtoupper(cargausuanombre($usuacodi2,$idcon)) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="233px">&nbsp;<b>Elaborado Por</b></td>
				<td width="233px">&nbsp;<b>Generado Por</b></td>
			</tr>
		</table>

	</body>

</html>
<?php fncclose($idcon); ?>

