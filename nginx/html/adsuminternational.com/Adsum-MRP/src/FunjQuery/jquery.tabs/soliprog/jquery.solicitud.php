<?php $idcon = fncconn(); ?>
<!-- 	DATOS SOLICITUD -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;Datos de la solicitud </td>
		<td class="cont-title">&nbsp;Ruta : <?php echo ($rutaitempv)? strtoupper($rutaitempv) : '---' ; ?></td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Ubicaci&oacute;n</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo cargaplantanombre($plantacodigo, $idcon); ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Solicitante</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($usuacodigo)? cargausuanombre($usuacodigo, $idcon) : '---' ; ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;PV</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($pedvennumero)? $pedvennumero : '---' ;  ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Item</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($produccoduno)? $produccoduno : '---' ; ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Ref.</td>
		<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo  ($producnombre)? $producnombre : '---' ; ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;NIT</td>
		<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo  ($ordcomcodcli)? $ordcomcodcli : '---' ; ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Cantidad Solicitada</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($propedcansol)? $propedcansol : '---' ;  ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Unidad</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($unidadcodigo)? $unidadcodigo : '---' ; ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Razon Social</td>
		<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo  ($ordcomrazsoc)? $ordcomrazsoc : '---' ; ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Fecha de recepcion oc</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($pedvenfecrec)? $pedvenfecrec : '---' ; ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Fecha de elaboracion</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($pedvenfecelb)? $pedvenfecelb : '---' ; ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Fecha de entrega</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($pedvenfecent)? $pedvenfecent : '---' ; ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['solprofecest']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Fecha estimada</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<input type="text" name="solprofecest" id="solprofecest" value="" size="12" />&nbsp;<span id="diff_solprofecest"></span></td>
	</tr>
</table>
<!-- 	FIN DATOS SOLICITUD -->
<!--  DATOS PLANEACION -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;Datos de producto</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" class="ui-widget-content">
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['tipo_impresion']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Tipo impresion</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($tipo_impresion)? strtoupper($tipo_impresion) : '---' ;  ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['ancho']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Ancho producto</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($ancho)? strtoupper($ancho) : '---' ;  ?>&nbsp;<b>mm</b>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['continuo']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Continuo</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($continuo)? strtoupper($continuo) : '---' ;  ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['largo']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Largo</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($largo)? $largo : '---' ; ?>&nbsp;<b>mm</b>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['rodillo']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Rodillo</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($rodillo)? strtoupper($rodillo) : '---' ;  ?>&nbsp;<b>mm</b>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['nropistas']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;No pistas</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($nropistas)? strtoupper($nropistas) : '---' ;  ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['nrorepet']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;No repeticiones</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($nrorepet)? strtoupper($nrorepet) : '---' ;  ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['tam_core']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Tama&ntilde;o del core</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($tam_core)? strtoupper($tam_core) : '---' ; ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['version_arte']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Version del arte / fecha</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($version_arte)? $version_arte : '---' ; ?>&nbsp;</td>
<!--		<td width="20%" class="NoiseFooterTD"><?php //if($campnomb['anchoproceso']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Ancho proceso</td>-->
<!--		<td width="30%" class="NoiseDataTD">&nbsp;<?php //echo  ($anchoproceso)? $anchoproceso * $nropistas : '---' ; ?>&nbsp;<b>mm</b>&nbsp;</td>-->
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['fuelle']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Fuelle</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($fuelle)? $fuelle : '---' ; ?>&nbsp;<b>mm</b>&nbsp;</td>
	</tr><input type="hidden" name="tipo_microper" value="<?php echo $tipo_microper; ?>">
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['tipo_estruc']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Tipo estructura</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($tipo_estruc)? strtoupper($tipo_estruc) : '---' ; ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD"><?php if($campnomb['tipo_microper']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Microperforaciones</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($tipo_microper)? $tipo_microper : '---' ; ?>&nbsp;</td>
	</tr>
<!--	
	<tr>
		<td width="20%" class="NoiseFooterTD"><?php //if($campnomb['pmillar']){echo "<b style='color:red;'>*</b>"; }?>&nbsp;Peso Millar</td>
		<td colspan="30%" class="NoiseDataTD">&nbsp;<?php //echo ($pmillar)? round($pmillar * 100) / 100 : '---' ; ?>&nbsp;</td>
	</tr>
-->
</table>
<!--  FIN DATOS PLANEACION -->
<!-- 	DOCUMENTOS ADJUNTOS -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;Documentos Adjuntos PV</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td>
			<div style="height: 2px;"></div>
			<div class="ui-widget-content content">
				<div id="reportot_file_load" class="file-upname">
					<?php 
						unset($arrUpload,$arrUploadSize);
						if($uploadocumen)
						{
							$arrUpload = explode('::', $uploadocumen);
							$arrUploadSize = explode('::', $uploadocumensize);
							for($a = 0; $a < count($arrUpload); $a++)
							{
					?>
					<div class="uploadifyQueueItem completed">
						<div class="cancel">
							<a href="javascript: void(0);" onclick="window.open('http://75.98.171.118/plasticel/doc/upload/documentos/<?php echo $arrUpload[$a] ?>','impresion','status=no,menubar=no,scrollbars=yes,resizable=yes,width=880,height=650');">Detallar
							</a>
						</div>
						<span class="fileName"><?php echo $arrUpload[$a].' ('.$arrUploadSize[$a].')' ?></span>
					</div>
					<?php
							}
						}
					?>
				</div>
				<input type="hidden" name="uploadocumen" id="uploadocumen" value="<?php echo $uploadocumen?>">
				<input type="hidden" name="uploadocumensize" id="uploadocumensize" value="<?php echo $uploadocumensize ?>">
			</div>
		</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr>				
		<td colspan="4">
			<div id="filuploadfile">
				<div class="ui-widget">
					<div class="ui-state-Highlight ui-corner-all" style="padding: 0 .7em;"> 
						<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span> Selecciona los archivos que deseas importar</p>
					</div>
				</div>
			</div>
		</td>
	</tr>
</table>
<table border="0" cellspacing="1" cellpadding="1" align="center" width="100%">
	<tr><td class="ui-state-default">&nbsp;Archivos a importar  </td></tr>					
	<tr>
		<td>
			<div style="float:left;">
				<div id="reportot_file_upload_soliprog">Ocurrio un problema con el sistema!</div>
				<div id="reportot_custom-queue" class="uploadifyQueue"></div>
			</div>
			<div style="height:2px;"></div>
			<div class="ui-widget-content content">
				<div id="reportot_file_load_soliprog" class="file-upname">
					<?php 
						unset($arrUpload,$arrUploadSize);
						if($solprodocume)
						{
							$arrUpload = explode('::', $solprodocume);
							$arrUploadSize = explode('::', $solprodosize);
							
							for($a = 0; $a < count($arrUpload); $a++)
							{
					?>
					<div class="uploadifyQueueItem completed"><div class="cancel"><a href="javascript: void(0);" onclick="deleteFileUpload('<?php echo $a ?>');"><img border="0" src="temas/upload/cancel.png"></a></div><span class="fileName"><?php echo $arrUpload[$a].' ('.$arrUploadSize[$a].')' ?></span></div>
					<?php												
							}
						}
					?>
				</div>
				<input type="hidden" name="solprodocume" id="solprodocmen" value="<?php echo $solprodocmen?>"/>
				<input type="hidden" name="solprodosize" id="solprodosize" value="<?php echo $solprodosize ?>"> 
			</div>
		</td>
	</tr>
</table>
<!-- 	FIN DOCUMENTOS ADJUNTOS -->
<!-- OBSERVACIONES -->
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td colspan="3" class="ui-state-default">&nbsp;Observaciones</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td>
			<textarea name="solprodescri" cols="115" rows="3"><?php echo $solprodescri; ?></textarea>
		</td>
	</tr>
</table>
<!-- FIN OBSERVACIONES -->
<?php fncclose($idcon); ?>