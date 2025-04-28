<?php 

	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunPerSecNiv/fncclose.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncsqlrun.php';
	include '../../FunPerPriNiv/pktblitemdesa.php';
	include '../../FunPerPriNiv/pktblprocedimiento.php';
	include '../../FunPerPriNiv/pktblpadreitem.php';
	include '../../FunGen/cargainput.php';
	
	echo '<option value="">--Seleccione--</option>';
		
	$idcon = fncconn();
	
	if($voption)
	{
		if($arrmatplan) $arrObject = explode(':|:',$arrmatplan);
		for($a = 0;$a< count($arrObject);$a++){
			$rowArrObject = explode(':-:',$arrObject[$a]);
			$rwItemdesa = loadrecorditemdesa($rowArrObject[0],$idcon);
			$rwProcedimiento = loadrecordprocedimiento($rowArrObject[1],$idcon);
			echo "<option value='".$arrObject[$a]."' > ".$rwItemdesa['itedesnombre']." - ".$rwProcedimiento['procednombre']."</option>";
		}
	}
	else
	{
		if($arrmatplan) $arrObject = explode(',',$arrmatplan);
		for($a = 0;$a< count($arrObject);$a++){
			$rwItemdesa = loadrecorditemdesa($arrObject[$a],$idcon);
			echo "<option value='".$rwItemdesa['itedescodigo']."' >".$rwItemdesa['itedesnombre']."</option> ";
		}
	}
?>