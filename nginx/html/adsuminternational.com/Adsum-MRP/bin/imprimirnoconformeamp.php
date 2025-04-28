<?php
	include ( '../src/FunPerPriNiv/pktbldocumentnoconformemp.php');
	include ( '../src/FunPerPriNiv/pktblrecepcionmercancia.php');	
	include ( '../src/FunPerPriNiv/pktblestadoanalisis.php');
	include ( '../src/FunPerPriNiv/pktblmpvaranalisis.php');
	include ( '../src/FunPerPriNiv/pktbltipoitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblnoconformemp.php');
	include ( '../src/FunPerPriNiv/pktblvaranalisis.php');
	include ( '../src/FunPerPriNiv/pktblanalisismp.php');
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

	$rwNoConformeMp = loadrecordnoconformemp($codigo,$idcon);

	$nocomcodigo = $rwNoConformeMp["nocomcodigo"];
	$analiscodigo = $rwNoConformeMp["analiscodigo"];
	$usuacodi1 = $rwNoConformeMp["usuacodi1"];
	$usuacodi2 = $rwNoConformeMp["usuacodi2"];
	$nocomfecha = $rwNoConformeMp["nocomfecha"];
	$nocomhora = $rwNoConformeMp["nocomhora"];
	$nocomdescri = $rwNoConformeMp["nocomdescri"];

	$rwAnalisisMp = loadrecordanalisismp($analiscodigo,$idcon);

	$tipitemcodigo = $rwAnalisisMp["tipitemcodigo"];
	$lotecodigo = $rwAnalisisMp["lotecodigo"];
	$itedescodigo = $rwAnalisisMp["itedescodigo"];
	$usuacodigo = $rwAnalisisMp["usuacodi"];
	$analisfecha = $rwAnalisisMp["analisfecha"];
	$estanacodigo = $rwAnalisisMp["estanacodigo"];
	$analisdescri = $rwAnalisisMp["analisdescri"];

	$rsMpvaranalisis = dinamicscanopmpvaranalisis(array("analiscodigo" => $analiscodigo), array("analiscodigo" => "="), $idcon);
	$nrMpvaranalisis = fncnumreg($rsMpvaranalisis);

	for( $a = 0; $a < $nrMpvaranalisis; $a++){

		$rwMpvaranalisis = fncfetch($rsMpvaranalisis,$a);

		$varValor = 'txtvalor'.$rwMpvaranalisis['varanacodigo'];
		$$varValor = $rwMpvaranalisis["mpvaravalor"];

	}

	$rwLote = loadrecordlote($lotecodigo,$idcon);

	$lotenumero = $rwLote["lotenumero"];
	$proveecodigo = $rwLote["proveecodigo"];
	$fabricodigo = $rwLote["fabricodigo"];

	$recmercantidad = 0;
	$unidadcodigo = "";

	$rsRecepcionMercancia = dinamicscanoprecepcionmercancia(array("lotecodigo" => $lotecodigo, "itedescodigo" => $itedescodigo), array("lotecodigo" => "=", "itedescodigo" => "="),$idcon);
	$nrRecepcionMercancia = fncnumreg($rsRecepcionMercancia);

	for( $a = 0; $a < $nrRecepcionMercancia; $a++){

		$rwRecepcionMercancia = fncfetch($rsRecepcionMercancia,$a);

		$recmercantidad += (int) $rwRecepcionMercancia["recmercantidad"];
		$unidadcodigo = $rwRecepcionMercancia["unidadcodigo"];

	}


	$rsdocumentnoconformemp = dinamicscanopdocumentnoconformemp(array("nocomcodigo" => $nocomcodigo),array("nocomcodigo" => "="),$idcon);
	$nrdocumentnoconformemp = fncnumreg($rsdocumentnoconformemp);

	for( $a = 0; $a < $nrdocumentnoconformemp; $a++){

		$rwdocumentnoconformemp = fncfetch($rsdocumentnoconformemp,$a);

		$uploadocumen = ($uploadocumen)? $uploadocumen."::".$rwdocumentnoconformemp["uploadocumen"] : $rwdocumentnoconformemp["uploadocumen"] ;
		$uploadocumensize = ($uploadocumensize)? $uploadocumensize."::".$rwdocumentnoconformemp["uploadocumensize"] : $rwdocumentnoconformemp["uploadocumensize"] ;
	}

	$rwLote = loadrecordlote($lotecodigo,$idcon);

	$lotenumero = $rwLote["lotenumero"];
	$lotefecha = $rwLote["lotefecha"];
	$lotehora = $rwLote["lotehora"];
	$usuacodi = $rwLote["usuacodi"];
	$proveecodigo = $rwLote["proveecodigo"];
	$fabricodigo = $rwLote["fabricodigo"];
	$lotefecfabri = $rwLote["lotefecfabri"];
	$lotefecperio = $rwLote["lotefecperio"];

		
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
				<td width="80px">&nbsp;Proveedor</td>
				<td width="230px">&nbsp;<?php echo ($proveecodigo)? strtoupper(cargaprovnombre($proveecodigo,$idcon)) : '---' ;?></font></td>
			</tr>
			<tr>
				<td width="80px">&nbsp;Lote No.</td>
				<td width="230px">&nbsp;<?php echo ($lotenumero)? strtoupper($lotenumero) : "---" ; ?></font></td>
			</tr>
			<tr>
				<td width="80px">&nbsp;Fabricante</td>
				<td width="230px">&nbsp;<?php echo ($fabricodigo)? strtoupper(carganombrefabricante($fabricodigo,$idcon)) : '---' ;?></font></td>
			</tr>
			<tr>
				<td width="80px">&nbsp;Fecha Ingreso</td>
				<td width="230px">&nbsp;<?php echo ($lotefecha)? strtoupper($lotefecha) : "---" ; ?></font></td>
			</tr>
			<tr>
				<td width="80px">&nbsp;Hora Ingreso</td>
				<td width="230px">&nbsp;<?php echo ($lotehora)? strtoupper($lotehora) : "---" ; ?></font></td>
			</tr>
		</table>
		<br>

		<table border="0" class="tabla" cellpadding="0">
			<tr>
				<td colspan="3" align="center" class="material">&nbsp;<b>Especificacion del material</b></td>
			</tr>
			<tr>
				<td width="400px">&nbsp;Material</td>
				<td width="100px">&nbsp;Cantidad</td>
				<td width="200px">&nbsp;</td>
			</tr>
			<tr>	
				<td width="400px">&nbsp;<?php echo ($itedescodigo)? strtoupper(carganombitemdesa($itedescodigo,$idcon)) : "---" ; ?></td>
				<td width="100px">&nbsp;<?php echo ($recmercantidad)? number_format($recmercantidad, 2, ",", ".") : "---" ; ?></td>
				<td width="200px">&nbsp;<?php echo ($unidadcodigo)? $unidadcodigo : "---" ; ?></td>
			</tr>
		</table>
		<br><br>

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
				<td width="233px">&nbsp;<b>Enviado Por</b></td>
			</tr>
		</table>

		<div>
			<br>
<?php 

	if($uploadocumen) $objsuploadocumen = explode("::", $uploadocumen); else unset($objsuploadocumen);
	if($uploadocumensize) $objsuploadocumensize = explode("::", $uploadocumensize); else unset($objsuploadocumensize);

	for( $a = 0; $a < count($objsuploadocumen); $a++){

		echo '<b><small>'.$uploadocumen[$a].'.'.$objsuploadocumensize[$a].'</small></b>';
		echo '<br>';
		echo '<img border="1" src="http://75.98.171.118/plasticel/doc/upload/noconforme/'.$objsuploadocumen[$a].'" />';
		echo '<br><br>';
	}




fncclose($idcon); 




?>
	</div>

</body>

</html>

