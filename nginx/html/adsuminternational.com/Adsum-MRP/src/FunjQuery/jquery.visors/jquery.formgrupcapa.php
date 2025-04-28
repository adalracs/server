<?php 
	ini_set('display_errors',1);
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerPriNiv/pktblgrupcapa.php';
	include '../../FunGen/cargainput.php';

	$idcon = fncconn();
	$rsGrupCapa = fullscangrupcapa($idcon);
	$nrGrupcapa = fncnumreg($rsGrupCapa);
?>
<table border="0" cellspacing="1" cellpadding="0">
<?php for($i=0;$i<$nrGrupcapa;$i++):?>
<?php $rwGrupcapa = fncfetch($rsGrupCapa,$i);?>
	<tr>
		<td class="NoiseFooterTD">&nbsp;Grupo : <?php echo $rwGrupcapa['grucapnombre']?></td>
		<td class="NoiseDataTD">
		<input type="radio" id="chkitem" name="chkitem" value="<?php echo $rwGrupcapa['grucapcodigo'];?>" onclick="ajaxEmpleadoFilter(this.value);"/>
		</td>
	</tr>	
<?php endfor;?>
<tr>
		<td class="NoiseFooterTD">&nbsp;Grupo : Todos los Empleados</td>
		<td class="NoiseDataTD">
		<input type="radio" id="chkitem" name="chkitem" value="" onclick="ajaxEmpleadoFilter(this.value);"/>
		</td>
	</tr>	
	<tr>
		<td colspan="2">
			<div id="filtergrupcapa"><?php include 'jquery.listaempleado.php'; ?></div>
		</td>
	</tr>	
</table>