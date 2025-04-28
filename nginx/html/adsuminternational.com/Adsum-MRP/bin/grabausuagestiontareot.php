<?php


function grabausualidergest($nuidtempo, $campnombr, $ordtracod){
	
	$nucnn = fncconn();
	
	$iRegresult = pg_exec( $nucnn,"SELECT * FROM tareot WHERE tareotcodigo =  "."'".$nuidtempo."'" );
	
	if ($iRegresult){		
		
		$nuCantRow = pg_numrows($iRegresult);

		if ($nuCantRow > 0){

			include_once('grabausuariotareot2.php');
			$nuResult = pg_exec($nucnn,"SELECT usuacodi FROM vistaot WHERE ordtracodigo = "."'".$ordtracod."'");
			
		   
			
	    	$sbRow = pg_fetch_row ($nuResult,0);
	
			$iRegusuariotareot[usutarcodigo] = "";
		    $iRegusuariotareot[usuacodi] = $sbRow[0];
		    $iRegusuariotareot[tareotcodigo] = $nuidtempo;
		    $iRegusuariotareot[usutarlider] = 1;
		    
		    grabausuariotareot($iRegusuariotareot,$flagnuevousuariotareot,$campnombr);
		}
     }	
     //fncclose($nucnn);
}

?>