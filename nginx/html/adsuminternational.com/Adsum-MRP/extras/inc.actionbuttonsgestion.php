<div class="console-buttons-float-topright">
	<div class="ui-widget">
		<div class="ui-state-highlight ui-corner-all" style="padding: .5em .5em;"> 
			<div class="ui-buttonset">
			<?php
				if(isset($reccomact['nuevo']) && !$flagcheck)
			  		echo '&nbsp;<button id="nuevo">Gestionar</button>&nbsp;';
			  	
			  	if(isset($reccomact['consultar']) && !$flagcheck)
			  		echo '&nbsp;<button id="consultar">Consulta</button>&nbsp;';
			  	
				if(isset($reccomact['detallar']) && !$flagcheck)
			   		echo '&nbsp;<button id="detallar">Ver detalle</button>&nbsp;';
			   	
			   	if(isset($reccomact['modificar']) && !$flagcheck)
			   		echo '&nbsp;<button id="editar">Reasignar funcionario</button>&nbsp;';
			?>
				&nbsp;<button id="reperror">Reportar error</button>&nbsp;
			</div>
		</div>
	</div>
</div>