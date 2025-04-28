<div class="ui-buttonset">
<?php
	if($reccomact[nuevo] && !$flagcheck)
  		echo '<button id="nuevo">Nuevo</button>&nbsp;&nbsp;';
  	
  	if($reccomact[consultar] && !$flagcheck)
  		echo '<button id="consultar">Consulta</button>&nbsp;&nbsp;';
  	
	if($reccomact[detallar] && !$flagcheck)
   		echo '<button id="detallar">Ver detalle</button>&nbsp;&nbsp;';
   	
   	if($reccomact[imprimir] && !$flagcheck)
   		echo '<button id="imprimir">Imprimir</button>&nbsp;&nbsp;';
?>
</div>