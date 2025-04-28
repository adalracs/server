<!--  division contenedora del programa de valvulado-->
<?php 

	if(!$noAjax)
	{
		//primer nivel
		require_once ( '../src/FunPerPriNiv/pktblreporteoppreportepn.php');
		require_once ( "../src/FunPerPriNiv/pktblrequisicionitemdesa.php");
		require_once ( "../src/FunPerPriNiv/pktblgestionoppsaldo.php");
		require_once ( '../src/FunPerPriNiv/pktbloppvelocidadpn.php');
		require_once ( '../src/FunPerPriNiv/pktblprogramavalvulado.php');
		require_once ( '../src/FunPerPriNiv/pktblvelocidadpn.php');
		require_once ( '../src/FunPerPriNiv/pktbloppajustepn.php');
		require_once ( "../src/FunPerPriNiv/pktblrequisicionopp.php");
		require_once ( '../src/FunPerPriNiv/pktbloppitemdesa.php');
		require_once ( '../src/FunPerPriNiv/pktblajustepn.php');
		require_once ( '../src/FunPerPriNiv/pktblitemdesa.php');
		require_once ( "../src/FunPerPriNiv/pktblgestionopp.php");
		require_once ( '../src/FunPerPriNiv/pktblopvalvulado.php');
		require_once ( "../src/FunPerPriNiv/pktblopestado.php");
		require_once ( '../src/FunPerPriNiv/pktblequipo.php');
		require_once ( "../src/FunPerPriNiv/pktblsaldo.php");
		require_once ( '../src/FunPerPriNiv/pktblop.php');
		//segundo nivel
		require_once ( '../src/FunPerSecNiv/fncnumreg.php');
		require_once ( '../src/FunPerSecNiv/fncfetch.php');
		require_once ( '../src/FunPerSecNiv/fncconn.php');
		//general
		require_once ( '../src/FunGen/cargainput.php');
	}

	//se valida y explosiona el array de equipos => arrequipo
	if($arrequipo)
	{
		$arrObject = explode(',',$arrequipo);
?>
<div id="programavalvulado">
	<ul>
		<?php 
			//conexion
			$idcon = fncconn();
			//se recorre el array
			for($a = 0;$a < count($arrObject);$a++)
			{
				//variables a usar
				$obj_id_tab = '#tabs_'.$arrObject[$a];
				//variable usada para el apuntador del tabs en el html concatena la palabra tabs_{codigoequipo}
		?>
			<li>
				<a href="<?php echo $obj_id_tab ?>">&nbsp;<?php echo cargaequiponombre($arrObject[$a],$idcon); ?></a>
			</li>
		<?php 
			}
		?>
	</ul>
		<?php 
			//se recorre el array
			for($a = 0;$a < count($arrObject);$a++)
			{
				//variables a usar
				$obj_tab = 'tabs_'.$arrObject[$a];
				//variable usada para el id de la division que contendra las ordenes asignada al equipo
		?>
	<div id="<?php echo $obj_tab ?>" >
		<?php 
			//se asigna la variable equipo para que el visor a continuacion la usa para explosionar las opp
			$equipo = $arrObject[$a];

			switch ( $sourcetable ) {
    			case "gestionopp" :
        			include '../src/FunjQuery/jquery.visors/gestionopp/jquery.programavlv.php';
        			break;
    			case "reporteopp":
        			include '../src/FunjQuery/jquery.visors/produccion/jquery.programavlv.php';
        			break;
    			case "gestionopparte":
        			include '../src/FunjQuery/jquery.visors/produccion/jquery.programavlv.php';
        			break;
        		case "gestionopppreprensa":
        			include '../src/FunjQuery/jquery.visors/produccion/jquery.programavlv.php';
        			break;
        		case "gestionopprequisicion":
        			include '../src/FunjQuery/jquery.visors/gestionopprequisicion/jquery.programavlv.php';
        			break;
        		case "gestionplaneacionopp":
        			include "../src/FunjQuery/jquery.visors/gestionopp/jquery.programavlv.php";
        			break;
        		case "gestionoppanalisispr":
        			include '../src/FunjQuery/jquery.visors/produccion/jquery.programavlv.php';
        			break;
        		default:
       				include '../src/FunjQuery/jquery.visors/programacion/jquery.programavlv.php';
       				break;
			}

		?>
	</div>
		<?php 
			}
		?>
</div>
<?php 
	}
	else
	{
?>
		<div class="ui-widget">
 			<div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all"> 
  				<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
  				<b>No se encontraron OPP {Ordenes de produccion programadas} asociadas a algun equipo.</b></p>
 			</div>
		</div>
<?php 
	}
?>