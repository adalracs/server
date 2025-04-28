<?php 
ob_start();
?>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="1" align="center" >
	
		<tr>
			<tr>
				<td class="ui-state-default" colspan="4">&nbsp;
	      			<a  href="javascript:animatedcollapse.toggle('detallevistaalarmagestion');"><img id="row0" align="middle" align="top"  src="temas/Noise/<?php if($uploadfile){ echo 'AscOn'; }else{ echo 'DescOn'; } ?>.gif" border="0">&nbsp;Historial Alarma</a>
      				<input name="uploadfile" id="uploadfile" type="hidden" value="<?php echo $uploadfile; ?>">
				</td>
			</tr>
			<td colspan="4">
				<div id="detallevistaalarmagestion">
				<?php 
					if($nrAlarmagestion==0):
				?>
					<table width="100%" >
						<tr>
							<td>No hay Gestiones..</td>
						</tr>
					</table>
				<?php
					elseif($nrAlarmagestion>0):
						echo '<table border="0" cellspacing="0" align="center" width="100%">';
						$fila = 0;
						for($a = 0; $a < $nrAlarmagestion; $a++){
							$rwAlarmagestion = fncfetch($rsAlarmagestion, $a);
							echo '<tr>';
							echo '<td width="5%" align="center" class="ui-state-default">'.($a + 1).'</td>'."\n"; 
							echo '<td width="20%" align="center" class="ui-state-default">'.cargausuanombre($rwAlarmagestion['usuacodi'],$idcon).'</td>'."\n";
							echo '<td width="12%" align="center" class="ui-state-default">'.$rwAlarmagestion["alagesfecha"].'</td>'."\n";
							echo '<td width="12%" align="center" class="ui-state-default">'.$rwAlarmagestion["alageshora"].'</td>'."\n";
							echo '<td width="45%" align="center" class="ui-state-default">'.$rwAlarmagestion["alagesdescri"].'</td>'."\n";
							echo '<td width="12%" align="center" class="ui-state-default">'.cargaestadoalarmanombre($rwAlarmagestion["estalacodigo"],$idcon).'</td>'."\n";

							echo '</tr>';
						}
						echo '</table>';
					endif;
				?>	
				</div>
			</td>
		</tr>
                          
	</table>