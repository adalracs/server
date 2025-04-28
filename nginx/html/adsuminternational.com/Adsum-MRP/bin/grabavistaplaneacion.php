<?php 
	//ini_set('display_errors',1);
	include_once ( '../src/FunGen/fncnumprox.php'); 
	include_once ( '../src/FunGen/fncnumact.php'); 
	include_once ( '../src/FunGen/fncmsgerror.php'); 
	include_once ( '../src/FunPerPriNiv/pktblproducto.php'); 
	include_once ( '../src/FunPerPriNiv/pktblcpplandetope.php'); 
	include_once ( '../src/FunPerPriNiv/pktblcamperplanea.php');	
	include_once ( '../src/FunPerPriNiv/pktblsoliprog.php');  
	include_once ( '../src/FunPerPriNiv/pktblproductoseguimiento.php'); 

	define("grabaEx",3);
	define("errorIng",35);
	define("e_empty",-3);
	define("id1",269);
	//validacion de campos personalizados de planeacion
	include_once ('validacamperplanea.php');
	if($gensolicitud < 0 || !$gensolicitud){
		$campnomb['gensolicitud'] = 1;
		$flagnuevovistaplaneacion = 1;
	}
	//si no existe error en los campos personalizados
	if(!$flagnuevovistaplaneacion)
	{

		$idcon = fncconn();
		//consecutivo para codigo producto seguimiento
		$nuidtemp = fncnumact(id1,$idcon);	
		do
		{
			$nuresult = loadrecordproductoseguimiento($nuidtemp,$idcon);
			if($nuresult == e_empty){
				$iRegproductoseguimiento['prosegcodigo'] = $nuidtemp;
			}
			$nuidtemp ++;
		}while ($nuresult != e_empty);
		unset($nuidtemp);
		//seguimiento del producto
		$iRegproductoseguimiento['prosegnombre']= "Gestionado {OK}";
		$iRegproductoseguimiento['usuacodi']=$usuacodi;
		$iRegproductoseguimiento['produccodigo']=$produccodigo;
		$iRegproductoseguimiento['prosegfecha']=date("Y-m-d");
		$iRegproductoseguimiento['proseghora']=date("h:i,a");
		$iRegproductoseguimiento['modulocodigoorg']= 5;//var conf modulo de planeacion
		$iRegproductoseguimiento['modulocodigodes']= 6;//var conf modulo de programacion
		if( insrecordproductoseguimiento($iRegproductoseguimiento,$idcon) > 0){
			fncnumprox(id1,$iRegproductoseguimiento['prosegcodigo'] + 1,$idcon); 
		}
		fncclose($idcon);

		//-------------------------------------------------------------------------------------
		//PLANEA PADRE ITEM : tabla que almacena la explosion de los materiales planiados.
		//-------------------------------------------------------------------------------------
		unset($idcon_plpadreitem,$nuidtemp_plpadreitem,$nuresult_plpadreitem,$array_tmp,$resultado,$res);
		$idcon_plpadreitem = fncconn();
		//consecutivo para planea padre item
		$nuidtemp_plpadreitem = fncnumact(137,$idcon_plpadreitem);	
		do
		{
			$nuresult_plpadreitem = loadrecordplaneapadreitem($nuidtemp_plpadreitem,$idcon_plpadreitem);
			if($nuresult_plpadreitem == e_empty)
				$iRegPlaneapadreitem['plapadcodigo'] = $nuidtemp_plpadreitem - 1;
			$nuidtemp_plpadreitem ++;
		}while ($nuresult_plpadreitem != e_empty);
		//almancena la estructura del pedido con la asignacion de material en kgs y metros en la tabla planeapadreitem
		//se explosiona el array de tabla2
		$array_tmp = explode(':|:',$arrtabla2);	
		//se borra los registros actuales si existen en la tabla planeapadreitem
		$resultado = delrecordplaneapadreitem($produccodigo,$idcon_plpadreitem);
		//se recorre el array
		for($a = 0; $a < count($array_tmp); $a++)
		{
			//se explosiona por comodin ':-:'
			$rwArray_tmp = explode(':-:', $array_tmp[$a]);
			//se explosiona por comodin ',' para consultar adhesivos 
			$rwArray_tmp_adh = explode(',',$rwArray_tmp[4]);
			//se consulta registro de padre item
			$rwItem = loadrecordpadreitem($rwArray_tmp[1],$idcon_plpadreitem);
			//objetos utilizados
			$obj_cant_kgs = 'cant_kgs_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];//cantidad de kilogramos necesarios del item o material
			$obj_cant_mts = 'cant_mts_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];//cantidad de metros necesarios del item o material
			$obj_ancho_ideal = 'ancho_ideal_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];//ancho ideal para impresion y/o laminacion
			$obj_calib_a1 = 'calib_a1_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];//calibre alterno de la estructura
			$obj_formul_ = 'form_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];
			$obj_calib_a1 = 'calib_a1_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];
			$obj_refile_mm = 'refile_mm_'.$rwArray_tmp[0].'_'.$rwArray_tmp[1];
			//se crea el ireg correspondiente a planea padreitem
			$iRegPlaneapadreitem['plapadcodigo'] = $iRegPlaneapadreitem['plapadcodigo'] + 1;
			$iRegPlaneapadreitem['produccodigo'] = $produccodigo;
			$iRegPlaneapadreitem['paditecodigo'] = $rwArray_tmp[1];
			$iRegPlaneapadreitem['plapadanchoi'] = $$obj_ancho_ideal;
			$iRegPlaneapadreitem['plapadcantkg'] = $$obj_cant_kgs;
			$iRegPlaneapadreitem['plapadcantmt'] = $$obj_cant_mts;
			$iRegPlaneapadreitem['plapadcalib'] = $rwArray_tmp[3];
			$iRegPlaneapadreitem['formulcodigo'] = $$obj_formul_;
			$iRegPlaneapadreitem['plapadcaliba1'] = $$obj_calib_a1;
			$iRegPlaneapadreitem['plapaddesem'] = $rwArray_tmp_adh[1];
			$iRegPlaneapadreitem['plapadtipo'] = $rwArray_tmp_adh[2];
			$iRegPlaneapadreitem['plapadrefile'] = $$obj_refile_mm;
			//se ingresa el registrto
			$res = insrecordplaneapadreitem($iRegPlaneapadreitem,$idcon_plpadreitem);
			//validacion adicional de error de consecutivo
			if($res <= 0)
			{	
				unset($nuidtemp_plpadreitem,$nuresult_plpadreitem,$res);
				//consecutivo para planea padre item
				$nuidtemp_plpadreitem = fncnumact(137,$idcon_plpadreitem);	
				do
				{
					$nuresult_plpadreitem = loadrecordplaneapadreitem($nuidtemp_plpadreitem,$idcon_plpadreitem);
					if($nuresult_plpadreitem == e_empty)
						$iRegPlaneapadreitem['plapadcodigo'] = $nuidtemp_plpadreitem - 1;
					$nuidtemp_plpadreitem ++;
				}while ($nuresult_plpadreitem != e_empty);
				//se re asinga el nuevo indice de codigo
				$iRegPlaneapadreitem['plapadcodigo'] = $iRegPlaneapadreitem['plapadcodigo'] + 1;
				//se ingresa el registro
				$res = insrecordplaneapadreitem($iRegPlaneapadreitem,$idcon_plpadreitem);
			}
		}
		//se actualiza el consecutico de produc padre item
		fncnumprox(137,$iRegPlaneapadreitem['plapadcodigo'] + 1,$idcon_plpadreitem); 
		fncclose($idcon_plpadreitem);
		unset($idcon_plpadreitem,$nuidtemp_plpadreitem,$nuresult_plpadreitem,$array_tmp,$resultado,$res);
		
		
		
		
		
		//-------------------------------------------------------------------------------------
		//PLANEA ITEM DESA : tabla de los materiales asignados por el planeador
		//-------------------------------------------------------------------------------------
		unset($idcon_plitemdesa,$nuidtemp_plitemdesa,$nuresult_plitemdesa,$resultado,$arrObject,$rowsArrObject,$res);
		$idcon_plitemdesa = fncconn();
		//consecutivo para planea item desa almacena cada materia prima con su consumo planeado
		$nuidtemp_plitemdesa = fncnumact(138,$idcon_plitemdesa);	
		do
		{
			$nuresult_plitemdesa = loadrecordplaneaitemdesa($nuidtemp_plitemdesa,$idcon_plitemdesa);
			if($nuresult_plitemdesa == e_empty)
				$iRegPlaneaitemdesa['plaitecodigo'] = $nuidtemp_plitemdesa - 1;
			$nuidtemp_plitemdesa ++;
		}while ($nuresult_plitemdesa != e_empty);		
		//se explosiona el array de arrmatplan que contiene los codigo de los materiales elegidos para forma la estructura 
		if($arrmatplan) $arrObject = explode(':|:',$arrmatplan);
		//se borra los registros actuales si existen en la tabla planeaitemdesa
		$resultado = delrecordplaneaitemdesa1($produccodigo,$idcon_plitemdesa);
		//se recorre el array
		for($a = 0;$a< count($arrObject);$a++)
		{
			//se consulta el registro de item desa .
			$rowsArrObject = explode(':-:',$arrObject[$a]);
			// item desa es una tabla que se retroalimenta de un web services
			$rwItemdesa = loadrecorditemdesa($rowsArrObject[0],$idcon_plitemdesa);
			//procedimiento
			$rwPadreItem = loadrecordpadreitem($rowsArrObject[2], $idcon_plitemdesa);
			unset($plaitetipo);
			if($rwPadreItem["paditeextrui"] == "t"){

				$plaitetipo = 2;
			}else{

				$plaitetipo = 1;
			}
			//se crea objeto para el consumo a cada material
			$obj_consumo = 'consumo_'.$arrObject[$a];
			//se crea el ireg correspondiente a planeaitem desa
			$iRegPlaneaitemdesa['plaitecodigo'] = $iRegPlaneaitemdesa['plaitecodigo'] + 1;
			$iRegPlaneaitemdesa['produccodigo'] = $produccodigo;
			$iRegPlaneaitemdesa['itedescodigo'] = $rowsArrObject[0];
			$iRegPlaneaitemdesa['plaitecantid'] = $$obj_consumo;
			$iRegPlaneaitemdesa['procedcodigo'] = $rowsArrObject[1];
			$iRegPlaneaitemdesa['plaitetipo'] = $plaitetipo;
			$res = insrecordplaneaitemdesa($iRegPlaneaitemdesa,$idcon_plitemdesa);
			//validacion adicional de error de consecutivo
			if($res <= 0)
			{
				//consecutivo para planea item desa
				unset($nuidtemp_plitemdesa,$nuresult_plitemdesa,$res);
				$nuidtemp_plitemdesa = fncnumact(138,$idcon_plitemdesa);	
				do
				{
					$nuresult_plitemdesa = loadrecordplaneaitemdesa($nuidtemp_plitemdesa,$idcon_plitemdesa);
					if($nuresult_plitemdesa == e_empty)
						$iRegPlaneaitemdesa['plaitecodigo'] = $nuidtemp_plitemdesa - 1;
					$nuidtemp_plitemdesa ++;
				}while ($nuresult_plitemdesa != e_empty);
				//se re asinga el nuevo indice de codigo
				$iRegPlaneaitemdesa['plaitecodigo'] = $iRegPlaneaitemdesa['plaitecodigo'] + 1;
				//se ingresa el registro
				$res = insrecordplaneaitemdesa($iRegPlaneaitemdesa,$idcon_plitemdesa);
			}
		}
		//se actualiza el consecutico de produc padre item
		fncnumprox(138,$iRegPlaneaitemdesa['plaitecodigo'] + 1,$idcon_plitemdesa); 
		fncclose($idcon_plitemdesa);
		unset($idcon_plitemdesa,$nuidtemp_plitemdesa,$nuresult_plitemdesa,$resultado,$arrObject,$res);
		
		
		
	
		
		//-------------------------------------------------------------------------------------
		//PLANEA RUTA ITEM EST  : tabla que almacena la ruta estandar del pedido de venta
		//-------------------------------------------------------------------------------------
		//consecutivo para planea rutaitemestadar almacena la ruta ideal o estandar de pv
		unset($idcon_plrutaest,$nuidtemp_plrutaest,$nuresult_plrutaest,$arrObject,$resultado,$res);
		$idcon_plrutaest = fncconn();
		$nuidtemp_plrutaest = fncnumact(144,$idcon_plrutaest);	
		do
		{
			$nuresult_plrutaest = loadrecordplanearutaitemest($nuidtemp_plrutaest,$idcon_plrutaest);
			if($nuresult_plrutaest == e_empty)
				$iRegPlanearutaitemest['plarutcodigo'] = $nuidtemp_plrutaest - 1;
			$nuidtemp_plrutaest ++;
		}while ($nuresult_plrutaest != e_empty);
		//se explocina el array de las rutas por pv para los materiales
		if($rutaitem_est) $arrObject = explode(',',$rutaitem_est);
		//se borra los registros actuales si existen en la tabla planearutaitempv
		$resultado = delrecordplanearutaitemest($produccodigo,$idcon_plrutaest);
		//se recorre el array
		for($a = 0;$a< count($arrObject);$a++)
		{
			//se crea el ireg correspondiente a planearutaitemest
			$iRegPlanearutaitemest['plarutcodigo'] = $iRegPlanearutaitemest['plarutcodigo'] + 1;
			$iRegPlanearutaitemest['produccodigo'] = $produccodigo;
			$iRegPlanearutaitemest['procedcodigo'] = $arrObject[$a];
			$iRegPlanearutaitemest['plarutorden'] = ($a + 1);
			$res = insrecordplanearutaitemest($iRegPlanearutaitemest,$idcon_plrutaest);
			//validacion adicional de error de consecutivo
			if($res <= 0)
			{
				unset($nuidtemp_plrutaest,$nuresult_plrutaest,$res);
				//consecutivo para planea ruta item est
				$nuidtemp_plrutaest = fncnumact(144,$idcon_plrutaest);	
				do
				{
					$nuresult_plrutaest = loadrecordplanearutaitemest($nuidtemp_plrutaest,$idcon_plrutaest);
					if($nuresult_plrutaest == e_empty)
						$iRegPlanearutaitemest['plarutcodigo'] = $nuidtemp_plrutaest - 1;
					$nuidtemp_plrutaest ++;
				}while ($nuresult_plrutaest != e_empty);
				//se re asinga el nuevo indice de codigo
				$iRegPlanearutaitemest['plarutcodigo'] = $iRegPlanearutaitemest['plarutcodigo'] + 1;
				//se ingresa el resigtro
				$res = insrecordplanearutaitemest($iRegPlanearutaitemest,$idcon_plrutaest);
			}
		}
		//se actualiza el consecutico de produc padre item
		fncnumprox(144,$iRegPlanearutaitemest['plarutcodigo'] + 1,$idcon_plrutaest); 
		fncclose($idcon_plrutaest);
		unset($idcon_plrutaest,$nuidtemp_plrutaest,$nuresult_plrutaest,$arrObject,$resultado,$res);
		
		
		
		
		//-------------------------------------------------------------------------------------
		//PLANEA RUTA ITEM PV  : tabla que almacena la ruta  del pedido de venta
		//-------------------------------------------------------------------------------------
		unset($idcon_plrutapv,$nuidtemp_plrutapv,$nuresult_plrutapv,$arrObject,$resultado,$res);
		$idcon_plrutapv = fncconn();
		//consecutivo para planea rutaitempv almacena la ruta del pv
		$nuidtemp_plrutapv = fncnumact(139,$idcon_plrutapv);	
		do
		{
			$nuresult_plrutapv = loadrecordplanearutaitempv($nuidtemp_plrutapv,$idcon_plrutapv);
			if($nuresult_plrutapv == e_empty)
				$iRegPlanearutaitempv['plarutcodigo'] = $nuidtemp_plrutapv - 1;
			$nuidtemp_plrutapv ++;
		}while ($nuresult_plrutapv != e_empty);
		//se explocina el array de las rutas por pv para los materiales
		if($arrrutaitem) $arrObject = explode(':|:',$arrrutaitem);
		//se borra los registros actuales si existen en la tabla planearutaitempv
		$resultado = delrecordplanearutaitempv($produccodigo,$idcon_plrutapv);
		//se recorre el array
		for($a = 0;$a< count($arrObject);$a++)
		{
			//se explociona por el comodin :-:
			$rwObject = explode(':-:',$arrObject[$a]);
			$obj_consumo = 'consumo_'.$rwObject[1].':-:'.$rwObject[2];
			//se crea el ireg correspondiente a planearutaitempv
			$iRegPlanearutaitempv['plarutcodigo'] = $iRegPlanearutaitempv['plarutcodigo'] + 1;
			$iRegPlanearutaitempv['produccodigo'] = $produccodigo;
			$iRegPlanearutaitempv['procedcodigo'] = $rwObject[0];
			$iRegPlanearutaitempv['plarutcorter'] = ($rwObject[3] && $$obj_consumo)? $rwObject[3].','.$rwObject[1].','.$$obj_consumo : '' ;
			$iRegPlanearutaitempv['plarutorden'] = ($a + 1);
			$iRegPlanearutaitempv['estsolcodigo'] = 1;//estado generada
			$res = insrecordplanearutaitempv($iRegPlanearutaitempv,$idcon_plrutapv);
			//validacion adicional de error de consecutivo
			if($res <= 0)
			{
				unset($nuidtemp_plrutapv,$nuresult_plrutapv,$res);
				//consecutivo para planea rutaitempv almacena la ruta del pv
				$nuidtemp_plrutapv = fncnumact(139,$idcon_plrutapv);	
				do
				{
					$nuresult_plrutapv = loadrecordplanearutaitempv($nuidtemp_plrutapv,$idcon_plrutapv);
					if($nuresult_plrutapv == e_empty)
						$iRegPlanearutaitempv['plarutcodigo'] = $nuidtemp_plrutapv - 1;
					$nuidtemp_plrutapv ++;
				}while ($nuresult_plrutapv != e_empty);
				//se re asinga el nuevo indice de codigo
				$iRegPlanearutaitempv['plarutcodigo'] = $iRegPlanearutaitempv['plarutcodigo'] + 1;
				//se ingresa el registro
				$res = insrecordplanearutaitempv($iRegPlanearutaitempv,$idcon_plrutapv);
			}
		}
		//se actualiza el consecutico de produc padre item
		fncnumprox(139,$iRegPlanearutaitempv['plarutcodigo'] + 1,$idcon_plrutapv); 
		fncclose($idcon_plrutapv);
		unset($idcon_plrutapv,$nuidtemp_plrutapv,$nuresult_plrutapv,$arrObject,$resultado,$res);
		
		
		//ADICIONALES DE PRODUCTO Y SOLICITUDES
		$idcon = fncconn();
		//actualiza producto para saltar proceso planeacion
		updateproducto(array('produccodigo' => $produccodigo, 'producproces' => 6),$idcon);
		//termina la conexion a la base de datos
		fncclose($idcon);
		//incluye capa que almacenar los campos en la base datos
		include_once 'grabacamperplanea.php';
		if($gensolicitud > 1){
			//se graban las solicutudes de programacion
			include_once 'grabasolicitud.php';
		}
		//muestra mensaje de grabado exitoso
		fncmsgerror(grabaEx);
		//redirecciona a el maestro correspondiente
		$flagnuevovistaplaneacion = 1;
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'location ="maestablvistaplaneacion.php?codigo='.$codigo.';"';
		echo '//-->'."\n";
		echo '</script>';
		
	}

?>