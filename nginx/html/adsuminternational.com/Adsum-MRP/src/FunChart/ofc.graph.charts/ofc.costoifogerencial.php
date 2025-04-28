<?php 
	include '../../FunPerSecNiv/fncconn.php';	
	include '../../FunGen/cargainput.php';
	include '../php-ofc-library/open-flash-chart.php';
	ini_set("display_errors", 1);
	$arr_param = explode('[::]', $parameter);
	//Configuracion Grafico
	//Titulo
	$title = new title('INFORME DE GERELCIAL Periodo desde '.$arr_param[0].' hasta '.$arr_param[1]);
	$title	->set_style( "{font-size: 14px; font-family: Tahoma; font-weight: bold; color: #2E6E9E; text-align: center;}" );
	
	//Datos para el Grafico
	$data = array();
	$tagsname = array();
	$cont = 0;
	$d=0;
	$arrY=array(
	"Cantidad total Producida",
	"Costo Total",
	"Gastos Fabrica",
	"Precio de  Venta",
	"Cantidad Entregados",
	"Cantidad pendientes",
	"Margen Bruto sin Depreciacion",
	"Margen Bruto con Depreciacion"
	);

	
	for ($a=2; $a < count($arr_param); $a++) {
		$data[$d] = (int)$arr_param[$a];
		$tagsname[$d] =	$arrY[$d];
		$d++;
		if($cont < (int) $arr_param[$a])
			$cont = (int) $arr_param[$a];
	}

	//Configuracion del Objeto [Barras 3D]
	$bar = new bar_3d('#2E9AFE');
	$bar->set_values( $data );
	//Line X: Configuracion de Etiquetas linea x 
	$x_axis = new x_axis();
	$x_axis->set_3d( 12 );
	$x_axis->labels = $data;
	$x_axis->colour = '#909090';
//	$x_axis->set_labels_from_array($tagsname);
	$x_axis->set_steps( 2 );
	
	$x_labels = new x_axis_labels();
	$x_labels->set_size(12);
	$x_labels->set_labels($tagsname);
	$x_axis->set_labels( $x_labels );
	
	//Line Y: Configuracion de Etiquetas linea y
	$y_legend = new y_legend( '# COSTOS' );
	$y_legend->set_style( '{font-size: 14px; color: #778877}' );
	
	$subnum = 20;
	for(;;):
		if($subnum < $cont)
			$subnum += 20;
		else
			break;
	endfor;
	
	$y_axis = new y_axis();
	$y_axis->set_range( 0, $cont+100000, round((($cont+100000) / 20)));
    		
	$chart = new open_flash_chart();
	$chart->set_title($title);
	$chart->add_element($bar);
//	$chart->add_element($tags);
	$chart->set_x_axis($x_axis);
	$chart->set_y_legend($y_legend);
	$chart->set_y_axis($y_axis);
	$chart->set_bg_colour('#ffffff');
	
	echo $chart->toPrettyString();
?>