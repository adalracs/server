<div class="console-buttons-float-topright">
	<div class="ui-widget">
		<div class="ui-state-highlight ui-corner-all" style="padding: .5em .5em;"> 
			<div class="ui-buttonset">
			<?php
				$arrButtons = array('reporte' => 'Reportar OTP', 'nuevo' => 'Nuevo', 'asignar' => 'Asignar', 'consultar' => 'Consulta', 'detallar' => 'Ver detalle', 'borrar' => 'Borrar',
					 'modificar' => 'Modificar', 'imprimir' => 'Imprimir', 'calificar' => 'Calificar', 'omologar' => 'Homologar');

				if(!$flagcheck)
				{
					foreach ($arrButtons as $kButton => $vlButton) 
					{
						if(array_key_exists($kButton, $reccomact))
						{
							if($reccomact[$kButton])
								echo ($kButton == 'modificar') ? '&nbsp;<button id="editar">'.$vlButton.'</button>&nbsp;' : '&nbsp;<button id="'.$kButton.'">'.$vlButton.'</button>&nbsp;';
						}
					}
				}
				else
				{
					if(array_key_exists('borrar', $reccomact))
					{
						if($reccomact['borrar'])
							echo '&nbsp;<button id="borrar">Borrar selecci&oacute;n</button>&nbsp;';
					}
				}
			?>
				&nbsp;<button id="reperror">Reportar error</button>&nbsp;
			</div>
		</div>
	</div>
</div>
