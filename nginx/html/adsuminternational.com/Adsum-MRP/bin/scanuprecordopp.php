<?php 

	$idcon = fncconn();
		
	$rsGestionopp = fullscanvistagestionopp($idcon);
	$nrGestionopp = fncnumreg($rsGestionopp);
	
	for($a = 0; $a < $nrGestionopp; $a++)
	{
			
		$rwGestionopp = fncfetch($rsGestionopp,$a);
		$rwProcedimiento = loadrecordprocedimiento($rwGestionopp['procedcodigo'],$idcon);
		if($rwGestionopp['tipsolcodigo'] > 1)
		{
			$rsPlanearutaitempv = dinamicscanplanearutaitempv(array('produccodigo' => $rwGestionopp['produccodigo'] ),$idcon);
			$nrPlanearutaitempv = fncnumreg($rsPlanearutaitempv);
			$procedcodigo1 = 0;
			
			for( $b = 0; $b < $nrPlanearutaitempv; $b++)
			{
				$rwPlanearutaitempv = fncfetch($rsPlanearutaitempv,$b);
				if($rwPlanearutaitempv['procedcodigo'] == $rwProcedimiento['procedcodigo'] && $b > 0)
				{
					$rwPlanearutaitempv1 = fncfetch($rsPlanearutaitempv,$b-1);
					$procedcodigo1 = $rwPlanearutaitempv1['procedcodigo'];
				}
				if($procedcodigo1 > 0)
				{
					break;
				}
			}
			
			
			$rsOppitemdesa = dinamicscanopoppitemdesa(array('ordoppcodigo' => $rwGestionopp['ordoppcodigo']),array('ordoppcodigo' => '='),$idcon);
			$nrOppitemdesa = fncnumreg($rsOppitemdesa);
			
			if($nrOppitemdesa < 1)
			{	
				$sbsqlMtproceso = "
					SELECT 
	  					DISTINCT op.ordoppcodigo,reporteoppestado.roestanombre AS nest, op.solprocodigo,reporteopp.repoppcodigo,reporteoppreportepn.reoppncodigo AS idtran,
	  					reporteoppreportepn.reoppncantkg AS cantkg, reporteoppreportepn.reoppncantmt AS cantmt, reporteoppreportepn.reoppncantun AS cantun,
	  					reporteoppreportepn.reoppnbobina AS nrobobina, procedimiento.procednombre AS aproced ,reporteoppreportepn.reoppndescri AS desc FROM op 
	  				LEFT JOIN reporteopp ON op.ordoppcodigo = reporteopp.ordoppcodigo
					LEFT JOIN reporteoppreportepn ON reporteopp.repoppcodigo= reporteoppreportepn.repoppcodigo
					LEFT JOIN procedimiento ON op.procedcodigo= procedimiento.procedcodigo
					LEFT JOIN reporteoppestado ON reporteopp.roestacodigo = reporteoppestado.roestacodigo
					WHERE op.procedcodigo = '".$procedcodigo1."' AND op.solprocodigo = '".$rwGestionopp['solprocodigo']."' AND reporteopp.repoppcodigo is not null ";
			
				$rsMtproceso = fncsqlrun($sbsqlMtproceso,$idcon);	
				$nrMtproceso = fncnumreg($rsMtproceso);	
				
				if($nrMtproceso > 0)
				{
					$rwOpestado = loadrecordopestado1(6,$idcon);//cargar estados de la bandeja de reporte tipo 4
					$iRegop_opp[opestacodigo] = $rwOpestado['opestacodigo'];
	    			$iRegop_opp[ordoppcodigo] = $rwGestionopp['ordoppcodigo'];
	    			uprecordop_estado($iRegop_opp,$idcon);
				}	
				
			}
			
		}
		
	}
	
	fncclose($idcon);

?>