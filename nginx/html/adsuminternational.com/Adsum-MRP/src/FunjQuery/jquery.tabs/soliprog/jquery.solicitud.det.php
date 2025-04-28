<?php $idcon = fncconn(); ?>
<!-- 	DATOS SOLICITUD -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="ui-widget-content">
	<tr class="ui-state-default">
		<td class="cont-title">&nbsp;Datos de la solicitud</td>
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
		<td width="20%" class="NoiseFooterTD">&nbsp;Cantidad Solicitada</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($propedcansol)? $propedcansol : '---' ;  ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Unidad</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($unidadcodigo)? $unidadcodigo : '---' ; ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;NIT</td>
		<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo  ($ordcomcodcli)? $ordcomcodcli : '---' ; ?>&nbsp;</td>
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
		<td width="20%" class="NoiseFooterTD">&nbsp;Fecha estimada</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($solprofecest)? $solprofecest : '---' ; ?>&nbsp;</td>
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
		<td width="20%" class="NoiseFooterTD">&nbsp;Tipo impresion</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($tipo_impresion)? strtoupper($tipo_impresion) : '---' ;  ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Ancho producto</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($ancho)? strtoupper($ancho) : '---' ;  ?>&nbsp;<b>mm</b>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Continuo</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($continuo)? strtoupper($continuo) : '---' ;  ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Largo</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($largo)? $largo : '---' ; ?>&nbsp;<b>mm</b>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Rodillo</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($rodillo)? strtoupper($rodillo) : '---' ;  ?>&nbsp;<b>mm</b>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;No pistas</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($nropistas)? strtoupper($nropistas) : '---' ;  ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;No repeticiones</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($nrorepet)? strtoupper($nrorepet) : '---' ;  ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Tama&ntilde; del core</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($tam_core)? strtoupper($tam_core) : '---' ; ?>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Version del arte / fecha</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($version_arte)? $version_arte : '---' ; ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Fuelle</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($fuelle)? $fuelle : '---' ; ?>&nbsp;<b>mm</b>&nbsp;</td>
	</tr>
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Tipo estructura</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($tipo_estruc)? strtoupper($tipo_estruc) : '---' ; ?>&nbsp;</td>
		<td width="20%" class="NoiseFooterTD">&nbsp;Fuelle</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php echo  ($tipo_microper)? $$tipo_microper : '---' ; ?>&nbsp;</td>
	</tr>
<!--	
	<tr>
		<td width="20%" class="NoiseFooterTD">&nbsp;Peso Millar</td>
		<td width="30%" class="NoiseDataTD">&nbsp;<?php //echo ($pmillar)? round($pmillar * 100) / 100 : '---' ; ?>&nbsp;</td>
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
<!-- 	FIN DOCUMENTOS ADJUNTOS -->
<!-- OBSERVACIONES -->
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td colspan="3" class="ui-state-default">&nbsp;Observaciones</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
	<tr>
		<td><?php echo $solprodescri; ?></td>
	</tr>
</table>
<!-- FIN OBSERVACIONES -->
<?php fncclose($idcon); ?>