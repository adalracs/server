<?php
	include ('../src/FunGen/sesion/fncvalsesion.php');
?>
<html>
	<head>
		<title>Parametros de Informe - Servicios Solicitados por Areas</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="expires" content="0">
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
		<script type="text/javascript" src="../src/FunChart/js/json/json2.js"></script>
		<script type="text/javascript" src="../src/FunChart/js/swfobject.js"></script>
		<script type="text/javascript">
			swfobject.embedSWF("../src/FunChart/open-flash-chart.swf", "graph_data", "1000", "450", "9.0.0", "expressInstall.swf", {"data-file":"../src/FunChart/ofc.graph.charts/ofc.infgmediequi.php?parameter=<?php echo $medequcodigo ?>[::]<?php echo $consulfecini ?>[::]<?php echo $consulfecfin ?>","loading":"Escribiendo la grafica..."},false);
		</script>
		<script type="text/javascript">
			OFC = {};
 
			OFC.jquery = {
    			name: "jQuery",
    			version: function(src) { return $('#'+ src)[0].get_version() },
    			rasterize: function (src, dst) { $('#'+ dst).replaceWith(OFC.jquery.image(src)) },
    			image: function(src) { return "<img src='data:image/png;base64," + $('#'+src)[0].get_img_binary() + "' />"},
    			popup: function(src) {
        			var img_win = window.open('', 'Charts: Export as Image')
        			with(img_win.document) { write('<html><head><title>Adsum: Exporta como Imagen<\/title><\/head><body>' + OFC.jquery.image(src) + '<br><b>Para descargar la imagen solo presione click derecho sobre la imagen y seleccione {Guardar imagen como...}</b><\/body><\/html>') }
					// stop the 'loading...' message
					img_win.document.close();
     			}
			}
 
			// Using an object as namespaces is JS Best Practice. I like the Control.XXX style.
			//if (!Control) {var Control = {}}
			//if (typeof(Control == "undefined")) {var Control = {}}
			if (typeof(Control == "undefined")) {var Control = {OFC: OFC.jquery}}
 
			// By default, right-clicking on OFC and choosing "save image locally" calls this function.
			// You are free to change the code in OFC and call my wrapper (Control.OFC.your_favorite_save_method)
			// function save_image() { alert(1); Control.OFC.popup('my_chart') }
			function save_image() { OFC.jquery.popup('graph_data') }

			$(function(){
				$('#expimage').button({ icons: { primary: "ui-icon-image" } }).click(function() {
					OFC.jquery.popup('graph_data');
					
					return false;
				});
			});
		</script>
	</head>
	<body bgcolor="FFFFFF" text="#000000">
		<p><font class="NoiseFormHeaderFont">Grafica Medici&oacute;n/Equipo</font></p>
		<table border="0" cellspacing="1" cellpadding="1" align="center" class="NoiseFormTABLE" width="800">
			<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>	
  			<tr>
    			<td>
    				<table  border="0" cellspacing="1" cellpadding="0" align="center" class="ui-widget-content">
						<tr> 
 							<td><div id="graph_data"></div></td>  
						</tr>
					</table>
				</td>
			</tr>
			<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr>
		</table> 
	</body>
</html>