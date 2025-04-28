<?php
	ini_set('display_errors', 0);
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';

	include '../../FunPerPriNiv/pktblequipo.php';
	
	$idcon = fncconn();
	
	$record = array('tipequcodigo' => $tipequcodigo, 'equipomarca' => $equipomarca, 'equipomodelo' => $equipomodelo,'codigosrf' => $codigosrf,'equipocinv' => $equipocinv, 'equiponombre' => $equiponombre);
	$recordop = array('tipequcodigo' => '=', 'equipomarca' => '=', 'equipomodelo' => '=', 'codigosrf' => '=', 'equipocinv' => '=', 'equiponombre' => '=');
	
	$rs_equipo = dinamicscanopequipo($record, $recordop, $idcon);
	$numRow = fncnumreg($rs_equipo);

	if($numRow > 0):
		for($i = 0; $i < $numRow; $i++):
			$sbRow = fncfetch($rs_equipo, $i);
		
			if($sbRow[$campo])
				$list[strtoupper($sbRow[$campo])] = '<option value = "'.strtoupper($sbRow[$campo]).'">'.strtoupper($sbRow[$campo]).'</option>';
		endfor;
	endif;
?>
<select name="<?php echo $campo ?>" id="<?php echo $campo ?>" onchange="select_multibox('<?php echo $campo ?>');">
	<option value = "">-- Seleccione --</option>
	<option value = "">-- No Aplica --</option>
	<?php 
		foreach ($list as $key => $value): 
			echo $value; 
	 	endforeach; 
	 ?>
</select>