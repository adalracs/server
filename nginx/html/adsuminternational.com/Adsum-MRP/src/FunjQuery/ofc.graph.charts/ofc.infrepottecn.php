<?php 
	include '../../FunPerSecNiv/fncconn.php';	
	include '../../FunPerSecNiv/fncclose.php';
	include '../../FunPerSecNiv/fncnumreg.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerSecNiv/fncfetchall.php';
	include '../../FunPerSecNiv/fncsqlrun.php';
	include '../../FunPerPriNiv/pktbltipotrab.php';
	include '../../FunGen/cargainput.php';
	include '../../FunChart/php-ofc-library/open-flash-chart.php';

	ini_set("display_errors",1);
	
	$arrParam = explode('[::]', $parameter);
	$data = array();
	$tagsname = array();
	$key_bar = array(); //
	$arrTipofind = array();
	$arrTiptra = explode(',',$arrParam[1]);
	$cont = 0;
	$total = 0;
	
	if(empty($arrParam[2])):
		$idcon = fncconn();
		
		//DB
		$sbSql = "	SELECT tareot.tiptracodigo, COUNT(ot.ordtracodigo) 
					FROM ot 
						LEFT JOIN tareot ON tareot.ordtracodigo = ot.ordtracodigo 
						LEFT JOIN usuariotareot ON usuariotareot.tareotcodigo = tareot.tareotcodigo
					WHERE ot.plantacodigo = '{$arrParam[0]}' AND ot.ordtrafecini BETWEEN '{$arrParam[3]}' AND '{$arrParam[4]}' AND tareot.tiptracodigo IN ({$arrParam[1]})
						AND tareot.tareotsecuen = '0' AND usuariotareot.usutarlider = 't'
					GROUP BY tareot.tiptracodigo";
		
		$rsOttipo = fncsqlrun($sbSql, $idcon);
		$nrOttipo = fncnumreg($rsOttipo);
		
		for($a = 0; $a < $nrOttipo; $a++):
			$rwOttipo = fncfetch($rsOttipo, $a);	
		
			if($cont < $rwOttipo[1])
				$cont = $rwOttipo[1];
			
			$arrTipofind[$rwOttipo[0]] = 1;
			
			$total += (int) $rwOttipo[1];
			$data[0][] = (int) $rwOttipo[1];
			$tagsname[] = cargatiptrabnombre($rwOttipo[0], $idcon);
		endfor;
		
		for($a = 0; $a < count($arrTiptra); $a++):
			if(!array_key_exists($arrTiptra[$a], $arrTipofind)):
				$data[0][] = 0;
				$tagsname[] = cargatiptrabnombre($arrTiptra[$a], $idcon);
			endif;
		endfor;
		
		$subnum = 20;
		for(;;):
			if($subnum <= $cont)
				$subnum += 20;
			else
				break;
		endfor;
		
		
		//Configuracion Grafico
		//Titulo
		$title = new title('Total Ordenes '.$total.' Periodo '.$arrParam[3].' hasta '.$arrParam[4]);
		$title	->set_style( "{font-size: 12px; font-family: Tahoma; font-weight: bold; color: #2E6E9E; text-align: center;}" );
	
		//Line X: Configuracion de Etiquetas linea x 
		$x_axis = new x_axis();
		$x_axis->colour = '#d0d0d0';
		$x_axis->grid_colour = '#000000';
		$x_axis->set_labels_from_array($tagsname);
		
		//Line Y: Configuracion de Etiquetas linea y
		$y_legend = new y_legend( '# Ordenes de trabajo' );
		$y_legend->set_style( '{font-size: 12px; color: #778877}' );
		
		//Line Y: Configuracion de rango linea y, tambien limite de numeracion
		$y_axis = new y_axis();
		$y_axis->set_range( 0, $subnum, ($subnum / 20));
		
		
		//Tags: Configuracion Etiquetas sobre barras
		$tags[0] = new ofc_tags();
		$tags[0] ->font("Tahoma", 9);
//		$tags[0] ->style(true, false,false);
   	 	$tags[0] ->colour("#778877");
	    $tags[0] ->text('#y#');
	    
		$x = 0;
		foreach($data[0] as $v):
		    $tags[0]->append_tag(new ofc_tag($x, $v));
		    $x++;
		endforeach;

		//Bar: Configuracion Barras
		$bar[0] = new bar_filled();	//bar_3d, bar_filled, bar_glass, bar_sketch, bar_stack, bar_cylinder
		$bar[0] ->set_values($data[0]); 
		$bar[0] ->colour = "#FF8000";
//		$bar[0] ->key($key_bar, 12);

		$chart = new open_flash_chart();
		$chart ->set_title($title);		
		$chart ->add_element($bar[0]);		//Grafica :: Barras
		$chart ->add_element($tags[0]);		//Tags :: NumberTop
		$chart ->set_x_axis($x_axis);
		$chart ->set_y_legend($y_legend);
		$chart ->set_y_axis($y_axis);
		$chart ->set_bg_colour('#ffffff');
	
	else:
		$idcon = fncconn();

		foreach($arrTiptra as $key => $value)
			$arrKey[$value] = 0;
		
		$sbSql = "SELECT * FROM usuario WHERE usuario.usuacodi IN (".$arrParam[2].")";
		$rsUsuario = fncsqlrun($sbSql, $idcon);
		$nrUsuario = fncnumreg($rsUsuario);
		
		if($nrUsuario)
			$rwUsuarios = fncfetchall($rsUsuario);
		
		$data = array();
		$cont = 0;
		
		
		
		for( $a = 0; $a < $nrUsuario; $a++ ):
			$tagsname[$a] = $rwUsuarios[$a][usuanombre].'<br>'.$rwUsuarios[$a][usuapriape];	
			$fdata = $arrKey;
			
			//DB
			$sbSql = "	SELECT tareot.tiptracodigo, COUNT(ot.ordtracodigo) 
						FROM ot 
							LEFT JOIN tareot ON tareot.ordtracodigo = ot.ordtracodigo 
							LEFT JOIN usuariotareot ON usuariotareot.tareotcodigo = tareot.tareotcodigo
						WHERE ot.plantacodigo = '{$arrParam[0]}' AND ot.ordtrafecini BETWEEN '{$arrParam[3]}' AND '{$arrParam[4]}' AND tareot.tiptracodigo IN ({$arrParam[1]})
							AND tareot.tareotsecuen = (SELECT max(tareot.tareotsecuen) FROM tareot WHERE tareot.ordtracodigo = ot.ordtracodigo)
							AND usuariotareot.usuacodi = '{$rwUsuarios[$a]['usuacodi']}'
						GROUP BY tareot.tiptracodigo";
			
			$rsOttipo = fncsqlrun($sbSql, $idcon);
			$nrOttipo = fncnumreg($rsOttipo);
			
			for($b = 0; $b < $nrOttipo; $b++):
				$rwOttipo = fncfetch($rsOttipo, $b);	
			
				if($cont < $rwOttipo[1])
					$cont = $rwOttipo[1];
				
				$fdata[$rwOttipo[0]] = (int) $rwOttipo[1];
			endfor;
			
			$c = 0;
			foreach($fdata as $key => $value):
				$data[$c][] = (int) $value;
				$total += (int) $value;
				$c++;
			endforeach;
		endfor;
		
		$colors = array(
			"#000000", //Rojo Oscuro
			"#8A0808", //Zapote Claro
			"#868A08", //Amarillo Claro
			"#0B610B", //Verde Claro
			"#3B0B24", //Rojo Claro
			"#0B0B61", //Azul Claro
			"#AC58FA", //Magenta Claro
			"#F781F3", //Magenta Claro 2
			"#B45F04", //Azul Oscuro
			"#0B0B0B", //Negro 1
			"#A4A4A4", //Gris
			"#0B6138", //Verde Oscuro
			"#F2F2F2", //Gris Claro
		);
		
		foreach($arrTiptra as $key => $value)
			$key_bar[] = cargatiptrabnombre($value, $idcon);
		
		$subnum = 20;
		for(;;):
			if($subnum <= $cont)
				$subnum += 20;
			else
				break;
		endfor;	
		
		//Configuracion Grafico
		//Titulo
		$title = new title('Total Ordenes '.$total.' Periodo '.$arrParam[3].' hasta '.$arrParam[4]);
		$title	->set_style( "{font-size: 11px; font-family: Tahoma; font-weight: bold; color: #2E6E9E; text-align: center;}" );
	
		//Line X: Configuracion de Etiquetas linea x 
		$x_axis = new x_axis();
		$x_axis->set_3d( 5 );
		$x_axis->colour = '#d0d0d0';
		$x_axis->grid_colour = '#000000';
		$x_axis->set_labels_from_array($tagsname);
		
		//Line Y: Configuracion de Etiquetas linea y
		$y_legend = new y_legend( '# Ordenes de trabajo' );
		$y_legend->set_style( '{font-size: 10px; color: #778877}' );
		
		//Line Y: Configuracion de rango linea y, tambien limite de numeracion
		$y_axis = new y_axis();
		$y_axis->set_range( 0, $subnum, ($subnum / 20));
		
		
		//Tags: Configuracion Etiquetas sobre barras
//		$tags[0] = new ofc_tags();
//		$tags[0] ->font("Tahoma", 9);
//		$tags[0] ->style(true, false,false);
//   	 	$tags[0] ->colour("#778877");
//	    $tags[0] ->text('#y#');
//	    
//		$x = 0;
//		foreach($data[0] as $v):
//		    $tags[0]->append_tag(new ofc_tag($x, $v));
//		    $x++;
//		endforeach;

		
		$chart = new open_flash_chart();
		$chart ->set_title($title);	
		
		for($z = 0; $z < count($data); $z++):
			$goto = 0;
			for($m = 0; $m < count($data[$z]); $m++):
				if($data[$z][$m] > 0)
					$goto++;
				
			endfor;
			
			if($goto > 0):
				//Bar: Configuracion Barras
				$bar[$z] = new bar_3d();	//bar_3d, bar_filled, bar_glass, bar_sketch, bar_stack, bar_cylinder
				$bar[$z] ->set_values($data[$z]);
	//			$bar[$z] ->set_tooltip($key_bar[$z]);
				$bar[$z] ->colour = $colors[$z];
				$bar[$z] ->key($key_bar[$z], 8);
				$chart ->add_element($bar[$z]);		//Grafica :: Barras
				
				//Tags: Configuracion Etiquetas sobre barras
	//			$tags[$z] = new ofc_tags();
	//			$tags[$z] ->font("Tahoma", 9);
	//			$tags[$z] ->style(true, false,false);
	//	   	 	$tags[$z] ->colour("#778877");
	//		    $tags[$z] ->text('#y#');
	//		    
	//			$x = 0;
	//			foreach($data[$z] as $v):
	//			    $tags[$z]->append_tag(new ofc_tag($x, $v));
	//			    $x++;
	//			endforeach;
	//			
	//			
	//			$chart ->add_element($tags[$z]);		//Tags :: NumberTop
			endif;
		endfor;
		
		$chart ->set_x_axis($x_axis);
		$chart ->set_y_legend($y_legend);
		$chart ->set_y_axis($y_axis);
		$chart ->set_bg_colour('#ffffff');	
	endif;
	
	echo $chart->toPrettyString();