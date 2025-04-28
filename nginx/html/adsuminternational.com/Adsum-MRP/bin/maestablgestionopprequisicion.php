<?php
//by ralvear
ini_set('display_errors', 1);
ob_start();
	include ( '../src/FunGen/sesion/fncvalses.php');
	include ( '../src/FunGen/fncnumprox.php');
	include ( '../src/FunGen/cargainput.php');
	include ( '../src/FunGen/fncnumact.php');
	include ( '../src/FunGen/floadtimehours.php');
	include ( '../src/FunGen/floadtimeminut.php');
	include ( '../src/FunPerSecNiv/fncsqlrun.php');
	include ( '../src/FunPerPriNiv/pktbltiposoliprog.php');
	include ( '../src/FunPerPriNiv/pktblequipo.php');
	include ( '../src/FunPerPriNiv/pktbloppvelocidadpn.php');
	include ( '../src/FunPerPriNiv/pktbloppajustepn.php');
	include ( '../src/FunPerPriNiv/pktblajustepn.php');
	include ( '../src/FunPerPriNiv/pktblvelocidadpn.php');
	include ( '../src/FunPerPriNiv/pktblop.php');
	include ( '../src/FunPerPriNiv/pktblreporteoppreportepn.php');
	include ( '../src/FunPerPriNiv/pktblitemdesa.php');
	include ( '../src/FunPerPriNiv/pktbloppitemdesa.php');
	include ( '../src/FunPerPriNiv/pktblopextrusion.php');
	include ( '../src/FunPerPriNiv/pktblopcorteextrusion.php');
	include ( '../src/FunPerPriNiv/pktblopflexo.php');
	include ( '../src/FunPerPriNiv/pktbloplaminado.php');
	include ( '../src/FunPerPriNiv/pktblopcorte.php');
	include ( '../src/FunPerPriNiv/pktblopsellado.php');
	include ( '../src/FunPerPriNiv/pktblopdoblado.php');
	include ( '../src/FunPerPriNiv/pktbloppauchado.php');
	include ( '../src/FunPerPriNiv/pktbloptroquelado.php');
	include ( '../src/FunPerPriNiv/pktblopmicroperforado.php');
	include ( '../src/FunPerPriNiv/pktblopvalvulado.php');
	include ( '../src/FunPerPriNiv/pktblsoliprog.php');
	include ( '../src/FunPerPriNiv/pktblformula.php');
	include ('../src/FunGen/sesion/fnccaf.php');
$reccomact = fnccaf ( $GLOBALS ["usuacodi"], $_SERVER ["SCRIPT_FILENAME"] ); 

	$arrconf = array(
		'1' => 'programaextrusion',
		'2' => 'programalaminado',
		'3' => 'programaflexo',
		'4' => 'programacorte',
		'5' => 'programasellado',
		'6' => 'programatroquelado',
		'7' => 'programapauchado',
		'8' => 'programadoblado',
		'9' => 'programamicroperforado',
		'10' => 'programacorte',
		'12' => 'programavalvulado',
		'13' => 'programacorteextrusion'
		);

	$idcon = fncconn();
	
	$rsTiposoliprog = fullscantiposoliprog($idcon);
	$nrTiposoliprog = fncnumreg($rsTiposoliprog);

	for( $a = 0; $a < ($nrTiposoliprog); $a++ ){
		$rwTiposoliprog = fncfetch( $rsTiposoliprog, $a );
		$arrTiposoliprog = ($arrTiposoliprog)? $arrTiposoliprog.','.$rwTiposoliprog['tipsolcodigo'] : $rwTiposoliprog['tipsolcodigo']  ;
	}

ob_end_flush();

?>
<html>
	<head>
		<title>Gestion ordenes de produccion</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<?php include('../def/jquery.library_maestro.php');?>
		<script type="text/javascript" src="../src/FunGen/starPage_position.js"></script>		
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.function_comun.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jquery.ui.ajax_accionextras.js"></script>
		<script type="text/javascript" src="../src/FunjQuery/jquery.jsscripts/jq.fnc.requisicion.js"></script>
		<script type="text/javascript">
			$(function(){

				$( '<?php echo ($arrconf[$tipsolcodigo])?  "#".$arrconf[$tipsolcodigo]: "" ; ?>' ).tabs({
					ajaxOptions: {
						error: function(xhr, status, index, anchor) {
						$(anchor.hash).html("No se puede cargar esta pesta&ntilde;a. Vamos a tratar de solucionar este problema lo m&aacute;s pronto posible.");
						}
					}
				});

			});
		</script>
	</head>

	<body bgcolor="FFFFFF" text="#000000">
		<form name="form1" method="post" enctype="multipart/form-data">
			<div class="ui-state-default">
				<div class="ui-buttonset"><?php $optgestion=1;include ('../def/jquery.maestablbuttons.php'); ?></div>
				&nbsp;Filtrar Programa&nbsp;
				<select name="tipsolcodigo" id="tipsolcodigo">
					<option value="">--Seleccione--</option>
					<?php 
						include ('../src/FunGen/floadtiposoliprog.php');
						floadtiposoliprog1($tipsolcodigo, $idcon);
					?>
				</select>
			</div>
			<div id="detallaprograma" style="height: 500px;" class="ui-state-default">
				<?php
				
					$caminoPktl = '../src/FunPerPriNiv/pktbl'.$arrconf[$tipsolcodigo].'.php';
	
					if( is_readable($caminoPktl) ){

						require_once ( $caminoPktl );
						$variableFuncion = 'fullscan'.$arrconf[$tipsolcodigo].'disctequipo';

						if( is_callable($variableFuncion) ){
							$rsEquipo = call_user_func($variableFuncion,$idcon);
							$nrEquipo = fncnumreg($rsEquipo);
						}

						for( $a = 0; $a < $nrEquipo; $a++ ){
							$rwEquipo = fncfetch( $rsEquipo, $a );
							if($rwEquipo['equipocodigo']){
								$arrequipo = ($arrequipo)? $arrequipo = $arrequipo.','.$rwEquipo['equipocodigo'] : $arrequipo = $rwEquipo['equipocodigo'];
							}
						}

						$arrconf['arrequipo'] = $arrequipo;
					}

					$caminoPrograma = 'detalla'.$arrconf[$tipsolcodigo].'.php';


					if( is_readable($caminoPrograma) && $arrconf['arrequipo'] ){
						$arrequipo = $arrconf['arrequipo'];
						$reporteopp = 1;
						include ( $caminoPrograma ); 
					}else{

						echo '<div class="ui-widget">';
 						echo '<div style="margin-top: 20px; padding: 0 .7em;" class="ui-state-highlight ui-corner-all">'; 
  						echo '<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>';
  						echo '<b>No se encontraron OPP {Ordenes de produccion programadas} asociadas a algun equipo.</b></p>';
 						echo '</div>';
						echo '</div>';

					}

				?>
			</div>
			<div id="msgwindow" title="Adsum Kallpa"><span id="msg"></span></div> 
			<input type="hidden" name="codigo" value="<?php echo $codigo; ?>">			
			<input type="hidden" name="selstar" id="selstar" value="0"> 
			<input type="hidden" name="columnas" value="ordoppcodigo"> 
			<input type="hidden" name="nombtabl" value="vistagestionopp"> 
			<input type="hidden" name="arrrequisicionopp" id="arrrequisicionopp"> 
			<input type="hidden" name="sourcetable" id="sourcetable" value="gestionopprequisicion">
		</form>
	</body>
</html>