<div id="opt-tab1">
	<table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
		<tr>
  			<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["codigosap"] == 1) { $codigosap = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Responsable Ficha</td>
  			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="respon" value="<?php echo $respon ?>" /><?php echo ($respon)? $respon : '---' ; ?></td>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Cliente</td>
  			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="clientnombre" value="<?php echo $clientnombre ?>" /><?php echo ($clientnombre)? $clientnombre : '---' ; ?></td>
  		</tr>
		<tr>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Item</td>
  			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="produccoduno" value="<?php echo $produccoduno ?>" /><?php echo ($produccoduno)? $produccoduno : '---' ; ?></td>
  			<td width="20%" class="NoiseFooterTD"><?php if ($campnomb["codigosap"] == 1) { $codigosap = null; echo "<b style='font-size:15px; color:red;'>*</b>";}?>&nbsp;Codigo SAP</td>
  			<td width="30%" class="NoiseDataTD">&nbsp;<input type="hidden" name="codigosap" value="<?php echo $codigosap ?>" /><?php echo ($codigosap)? $codigosap : '---' ;?></td>
  		</tr>
		<tr>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Referencia</td>
  			<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="producnombre" value="<?php echo $producnombre ?>" /><?php echo ($producnombre)? $producnombre : '---' ; ?></td>
  		</tr>
  		<tr>
  			<td width="20%" class="NoiseFooterTD">&nbsp;Tipo Producto</td>
  			<td colspan="3" class="NoiseDataTD">&nbsp;<input type="hidden" name="tipoproducto" value="<?php echo $tipoproducto ?>" /><?php echo ($tipoproducto)? $tipoproducto : '---' ; ?></td>
  		</tr>
      <tr>
        <td colspan="4">
          <div id="filuploadfile">
          <div class="ui-widget">
            <div class="ui-state-Highlight ui-corner-all" style="padding: 0 .7em;"> 
              <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span> 
              Selecciona los archivos que deseas importar</p>
            </div>
          </div>
          
          <table border="0" cellspacing="1" cellpadding="1" align="center" width="100%">
            <tr><td class="ui-state-default">&nbsp;Archivos a importar  </td></tr>          
            <tr>
              <td>
      
                    <div style="float:left;">
                  <div id="reportot_file_upload">Ocurrio un problema con el sistema!</div>
                  <div id="reportot_custom-queue" class="uploadifyQueue"></div>
                </div>

                <div style="height:2px;"></div>
                <div class="ui-widget-content content">
                  <div id="reportot_file_load" class="file-upname">
                    <?php 
                      if($uploadocumen):
                        $arrUpload = explode('::', $uploadocumen);
                        $arrUploadSize = explode('::', $uploadocumensize);
                        
                        for($a = 0; $a < count($arrUpload); $a++):
                    ?>
                    <div class="uploadifyQueueItem completed"><div class="cancel"><a href="javascript: void(0);" onclick="deleteFileUpload('<?php echo $a ?>');"><img border="0" src="temas/upload/cancel.png"></a></div><span class="fileName"><?php echo $arrUpload[$a].' ('.$arrUploadSize[$a].')' ?></span></div>
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