<?php 
	include '../../FunPerSecNiv/fncconn.php';	
	include '../../FunPerSecNiv/fncclose.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunGen/cargainput.php';
	include '../../FunPerPriNiv/pktbltipomedi.php';
	include '../../FunPerPriNiv/pktblmedidoequipo.php';
	include '../../FunPerPriNiv/pktblequipo.php';
	include '../php-ofc-library/open-flash-chart.php';

	$arr_param = explode('[::]', $parameter);
	
	//DB
	$sbSql = "	SELECT * FROM medicion WHERE medequcodigo = '".$arr_param[0]."' AND  medicifecmed BETWEEN '".$arr_param[1]."' AND '".$arr_param[2]."' ORDER BY medicifecmed";

	$idcon = fncconn ();
	$rs_medici = pg_exec($idcon, $sbSql);
	$nr_medici = fncnumreg($rs_medici);
	
	//DB
	$medidoequipo = loadrecordmedidoequipo($arr_param[0], $idcon);
	$equiponombre = loadrecordequipo($medidoequipo[equipocodigo], $idcon);
	$tipmednombre = loadrecordtipomedi($medidoequipo[tipmedcodigo], $idcon);
	
	//Configuracion Grafico
	//Titulo
	$title = new title($equiponombre[equiponombre].'/'.$tipmednombre[tipmednombre].' Periodo desde '.$arr_param[1].' hasta '.$arr_param[2]);
	$title	->set_style( "{font-size: 14px; font-family: Tahoma; font-weight: bold; color: #2E6E9E; text-align: center;}" );
	
	//Datos para el Grafico
	$data = array();
	
	for( $i=0; $i < $nr_medici; $i++ )
	{
		$row = fncfetch($rs_medici, $i);
		
	  	$data[] = (int) $row[medicicantid];
	  	$tagsname[] = $row[medicifecmed];
	  	
	  	if($cont < (int) $row[medicicantid])
	  		$cont = (int) $row[medicicantid];
	} 
	
	//Configuracion del Objeto [Barras 3D]
//	$bar = new bar_3d();
//	$bar->set_values( $data );
//	$bar->colour = '#2E9AFE';

	//
	// Make our area chart:
	//
//	$d = new dot();
//	$d->colour('#9C0E57')->size(7);
	
	$area = new area();
	// set the circle line width:
	$area->set_width( 2 );
	$area->set_default_dot_style($d);
	$area->set_colour( '#C4B86A' );
	$area->set_fill_colour( '#C4B86A' );
	$area->set_fill_alpha( 0.7 );
	$area->set_values( $data );
	
	


	//Line X: Configuracion de Etiquetas linea x 
	$x_axis = new x_axis();
	$x_axis->labels = $data;
	$x_axis->colour = '#909090';
//	$x_axis->set_labels_from_array($tagsname);
	$x_axis->set_steps( 2 );
	
	$x_labels = new x_axis_labels();
	$x_labels->set_vertical();
	$x_labels->set_labels($tagsname);
	$x_axis->set_labels( $x_labels );
	
	
	//Line Y: Configuracion de Etiquetas linea y
	$y_legend = new y_legend( '# Medicion' );
	$y_legend->set_style( '{font-size: 14px; color: #778877}' );
	
	
	$subnum = 20;
	for(;;):
		if($subnum < $cont)
			$subnum += 20;
		else
			break;
	endfor;
	
	$y_axis = new y_axis();
	$y_axis->set_range( 0, $subnum, ($subnum / 20));

	//Tags: Etiquetas sobre barras
//	$tags = new ofc_tags();
//	$tags	->font("Tahoma", 12)
//   	 		->colour("#000000")
//    		->align_x_center()
//    		->text('#y#');
//	
//	$x = 0;
//	foreach($data as $v)
//	{
//	    $tags->append_tag(new ofc_tag($x, $v));
//	    $x++;
//	}
    		
	$chart = new open_flash_chart();
	$chart	->set_title($title);
	$chart->add_element($area);
//	$chart->add_element($tags);
	$chart->set_x_axis($x_axis);
	$chart->set_y_legend($y_legend);
	$chart->set_y_axis($y_axis);
	$chart->set_bg_colour('#ffffff');
	
	echo $chart->toPrettyString();