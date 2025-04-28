<div id="opt-tab1">
	<div id="item_sessiona">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<?php if($tipevecodigo != 4){  //Caso Seleccion de Muestra ?>
			<tr>
  				<td class="NoiseFooterTD">&nbsp;Codigo vendedor</td>
				<td class="NoiseDataTD">&nbsp;<?php echo ($rwPedidoventa['pedvencodven'])? $rwPedidoventa['pedvencodven'] : '---' ; ?></td>		
				<td class="NoiseFooterTD">&nbsp;Vendedor</td>
				<td class="NoiseDataTD">&nbsp;<?php echo ($rwPedidoventa['pedvenvendedor'])? $rwPedidoventa['pedvenvendedor'] : '---' ; ?></td>
  			</tr>
			<tr>
  				<td width="20%" class="NoiseFooterTD">&nbsp;Elaborado por</td>
  				<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $nombre ?></td>
  				<td width="20%" class="NoiseFooterTD">&nbsp;Fecha de entrega</td> 
				<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $rwPedidoventa['pedvenfecent'];?></td>
  			</tr>
			<tr>
  				<td width="20%" class="NoiseFooterTD">&nbsp;No. Pedido de venta</td>
  				<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $rwPedidoventa['pedvennumero'] ?></td>
  				<td width="20%" class="NoiseFooterTD">&nbsp;Codigo Cliente</td> 
				<td width="30%" class="NoiseDataTD">&nbsp;<?php echo ($codigosap) ? $codigosap : '---' ; ?></td>
			</tr>
			<tr> 
				<td class="NoiseFooterTD">&nbsp;Item</td>
				<td class="NoiseDataTD">&nbsp;<?php echo $sbreg['produccoduno'] ?></td> 
  				<td class="NoiseFooterTD">&nbsp;D&iacute;as pactados</td>
  				<td class="NoiseDataTD">&nbsp;<?php echo $rwPedidoventa['pedvendiapac'] ?></td>
  			</tr>
			<tr> 
				<td class="NoiseFooterTD">&nbsp;Nombre de cliente</td>
				<td class="NoiseDataTD" colspan="3">&nbsp;<?php echo $rwOrdencompra['ordcomcodcli'].' - '.$clientnombre ?></td> 
			</tr>
			<tr>
				<td class="NoiseFooterTD">&nbsp;Nombre/Item</td> 
				<td class="NoiseDataTD" colspan="3">&nbsp;<?php echo $sbreg['producnombre'] ?></td>
			</tr>
			<tr><td colspan="4" class="NoiseErrorDataTD"></td></tr>
			<tr><td colspan="4" class="NoiseFooterTD">&nbsp;Nota</td></tr>
			<tr><td colspan="4" rowspan="2" class="NoiseDataTD">&nbsp;<?php echo $rwPedidoventa['pedvenobserv'] ?></td></tr>
			<?php }else{ ?>
			<tr>
  				<td width="20%" class="NoiseFooterTD">&nbsp;Elaborado por</td>
  				<td width="80%" class="NoiseDataTD">&nbsp;<?php echo $nombre ?></td>
  			</tr>
			<?php }?>
		</table>
					
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
			<?php if($tipevecodigo != 4):  //Caso Seleccion de Muestra ?>
			<tr> 
				<td width="20%" class="NoiseFooterTD">&nbsp;No. Orden de compra</td> 
				<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $rwOrdencompra['ordcomnumero'] ?></td>
				<td width="20%" class="NoiseFooterTD">&nbsp;Fecha de elaboracion</td>
				<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $rwPedidoventa['pedvenfecelb'] ?></td> 
			</tr>
			<tr>
		  		<td class="NoiseFooterTD">&nbsp;Precio</td>
		  		<td class="NoiseDataTD">&nbsp;<?php echo ($precio)? $precio : '---' ; ?></td>
		  		<td class="NoiseFooterTD">&nbsp;Moneda</td>
		  		<td class="NoiseDataTD">&nbsp;<?php echo ($moneda)? strtoupper($moneda) : '---' ; ?></td>
		  	</tr>
		  	<tr>
		  		<td class="NoiseFooterTD">&nbsp;Exportaci&oacute;n</td>
		  		<td class="NoiseDataTD">&nbsp;<?php echo ($exportacion)? strtoupper($exportacion) : '---' ;?></td>
		  		<td class="NoiseFooterTD">&nbsp;Cartera Cumple</td>
		  		<td class="NoiseDataTD">&nbsp;<?php echo ($cartera)? strtoupper($cartera) : '---' ;?></td>
		  	</tr> 	
		  	<tr>
		  		<td class="NoiseFooterTD">&nbsp;Cobro de fotopolimeros</td>
		  		<td class="NoiseDataTD">&nbsp;<?php echo ($cobro_fotopo)? strtoupper($cobro_fotopo) : '---' ; ?></td>
		  		<td class="NoiseFooterTD">&nbsp;Fecha de recepci&oacute;n (OC)</td>
				<td class="NoiseDataTD">&nbsp;<?php echo $rwPedidoventa['pedvenfecrec'] ?></td> 
		  	</tr>
		  	<tr>
		  		<td class="NoiseFooterTD">&nbsp;Version del arte / fecha</td>
		  		<td colspan="3" class="NoiseDataTD">&nbsp;<?php echo ($version_arte)? $version_arte : '---' ; ?></td>
		  	</tr>
      		<tr><td class="ui-state-default" colspan="4"></td></tr>
			<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Otros</td></tr>
			<tr>
				<td class="NoiseDataTD" colspan="4">&nbsp;<?php echo ($otros)? $otros : '---'; ?></td>
			</tr>
			<tr><td colspan="4" class="ui-state-default"></td></tr>
       	</table>
       	<?php endif; ?>
	</div>
				       	
    <?php 
    if($tipevecodigo == 4): 
    ?>
	<div id="item_sessionb">
		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content"> 	
			<tr>
  				<td class="NoiseFooterTD">&nbsp;Consecutivo</td>
  				<td class="NoiseDataTD">&nbsp;M-O<?php echo $rwPedidoventa['pedvenconsec'];?></td>
  				<td class="NoiseFooterTD">&nbsp;Fecha de Entrega</td>
  				<td class="NoiseDataTD"><?php echo $rwPedidoventa['pedvenfecent'] ?></td>
  			</tr>
			<tr>
  				<td width="20%" class="NoiseFooterTD">&nbsp;Nombre del proyecto</td>
  				<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $rwPedidoventa['pedvennompro'] ?></td>
  				<td width="20%" class="NoiseFooterTD">&nbsp;Motivo de la muestra</td>
  				<td width="30%" class="NoiseDataTD">&nbsp;<?php echo $rwPedidoventa['pedvenmotmue'] ?></td>
  			</tr>
  			<tr>
		  		<td class="NoiseFooterTD">&nbsp;Precio</td>
		  		<td class="NoiseDataTD">&nbsp;<?php echo ($precio)? $precio : '' ; ?></td>
		  		<td class="NoiseFooterTD">&nbsp;Moneda</td>
		  		<td class="NoiseDataTD">&nbsp;<?php echo ($moneda)? strtoupper($moneda) : '---' ; ?></td>
		  	</tr>
		  	<tr>
		  		<td class="NoiseFooterTD">&nbsp;Cobro de fotopolimeros</td>
		  		<td class="NoiseDataTD" colspan="3">&nbsp;<?php echo ($cobro_fotopo)? strtoupper($cobro_fotopo) : '---' ; ?></td>
		  	</tr>
		  	<tr><td class="ui-state-default" colspan="4"></td></tr>
			<tr><td class="NoiseFooterTD" colspan="4">&nbsp;Otros</td></tr>
			<tr>
				<td class="NoiseDataTD" colspan="4">&nbsp;<?php echo ($otros)? $otros : '---'; ?></td>
			</tr>
			<tr><td colspan="4" class="ui-state-default"></td></tr>
  		</table>
  	</div>
  	
  	<?php endif ?>
  	
  	<div id="item_sessiondoc">
  		<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
  			<tr><td class="ui-state-default" colspan="4">&nbsp;
      			<a onClick="return verocultar('uploadfile',1);" href="javascript:animatedcollapse.toggle('filuploadfile');"><img id="row0" align="middle" align="top"  src="temas/Noise/DescOn.gif" border="0">&nbsp;Adjuntar documentos</a>
      			<input name="uploadfile" id="uploadfile" type="hidden" value="<?php echo $uploadfile; ?>">
      		</td></tr>
      		<tr>
      			<td>
      			<div id="filuploadfile">
					<table border="0" cellspacing="1" cellpadding="1" align="center" width="100%">
						<tr><td class="ui-state-default">&nbsp;Documentos </td></tr>					
						<tr>
							<td>
								<div style="height:2px;"></div>
								<div class="ui-widget-content content">
									<div id="reportot_file_load" class="file-upname">
										<?php 
											if($uploadocumen):
												$arrUpload = explode('::', $uploadocumen);
												$arrUploadSize = explode('::', $uploadocumensize);
												
												for($a = 0; $a < count($arrUpload); $a++):
										?>
										<div class="uploadifyQueueItem completed"><div class="cancel"><a href="javascript: void(0);" onclick="window.open('http://192.168.60.55/plasticel/doc/upload/documentos/<?php echo $arrUpload[$a] ?>','impresion','status=no,menubar=no,scrollbars=yes,resizable=yes,width=880,height=650');">Detallar</a></div><span class="fileName"><?php echo $arrUpload[$a].' ('.$arrUploadSize[$a].')' ?></span></div>
										<?php												
												endfor;
											endif;
										?>
									</div>
									<input type="hidden" name="uploadocumen" id="uploadocumen" value="<?php echo $uploadocumen?>">
									<input type="hidden" name="uploadocumensize" id="uploadocumensize" value="<?php echo $uploadocumensize ?>">
								</div>
							</td>
						</tr>
					</table>
					</div>
				</td>
			</tr>
  		</table>  	
  	</div>
 </div>