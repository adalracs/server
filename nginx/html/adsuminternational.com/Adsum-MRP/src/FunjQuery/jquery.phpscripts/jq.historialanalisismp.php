<?php 
	ini_set("display_errors", 1);
	include_once '../../FunPerPriNiv/pktblmpvaranalisis.php';
	include_once '../../FunPerPriNiv/pktblvaranalisis.php';
	include_once '../../FunPerPriNiv/pktblanalisismp.php';
	include_once '../../FunPerPriNiv/pktblitemdesa.php';
	include_once '../../FunPerSecNiv/fncnumreg.php';
	include_once '../../FunPerSecNiv/fncsqlrun.php';
	include_once '../../FunPerSecNiv/fncclose.php';
	include_once '../../FunPerSecNiv/fncfetch.php';
	include_once '../../FunPerSecNiv/fncconn.php';

	$idcon = fncconn();

	if($itedescodigo && $lotecodigo){


		$ircrecord["lotecodigo"] = $lotecodigo;
		$ircrecord["itedescodigo"] = $itedescodigo;
		$ircrecord["analisestado"] = 2;//analisis cerrados

		$ircrecordop["lotecodigo"] = "=";
		$ircrecordop["itedescodigo"] = "=";
		$ircrecordop["analisestado"] = "=";

		$rsAnalisismp = dinamicscanopanalisismp($ircrecord,$ircrecordop,$idcon);
		$nrAnalisismp = fncnumreg($rsAnalisismp);



	}

	if($nrAnalisismp > 0){

		for($c = 0; $c < $nrAnalisismp; $c++){
			$rwAnalisismp = fncfetch($rsAnalisismp,$c);

			$rsMpvaranalisis = dinamicscanopmpvaranalisis(array("analiscodigo" => $rwAnalisismp["analiscodigo"]), array("analiscodigo" => "="), $idcon);
			$nrMpvaranalisis = fncnumreg($rsMpvaranalisis);

			for( $d = 0; $d < $nrMpvaranalisis; $d++){

				$rwMpvaranalisis = fncfetch($rsMpvaranalisis,$d);

				$rwVarAnalisis = loadrecordvaranalisis($rwMpvaranalisis['varanacodigo'],$idcon);
				$varValor = 'txtvalor'.$rwMpvaranalisis['varanacodigo'];
				$$varValor = $rwMpvaranalisis["mpvaravalor"];
			}

?>
	<div class="ui-buttonset ui-state-default NoiseDataTD">&nbsp;Especificaciones&nbsp;Analisis No.&nbsp;<?php echo ($rwAnalisismp["analiscodigo"])? $rwAnalisismp["analiscodigo"]: "---" ; ?></div>
 		<div id="filtrlistavaranalisis">
			<?php
				$flagDetallar=1;
				$noAjax = true;
				include('../jquery.visors/jq.vanalisismp.php');  
			?>
		</div>
	</div>
<?php
		}	

	}else{
?>
	<div class="ui-widget">
		<div style="margin-top: 1px; padding: 0 .7em;height: 100px;" class="ui-state-highlight ui-corner-all">
			<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span> <b>No se encontro historial de analisis de materias primas</b></p>
		</div>
	</div>
<?php 

	}

	fncclose($idcon);

?>
