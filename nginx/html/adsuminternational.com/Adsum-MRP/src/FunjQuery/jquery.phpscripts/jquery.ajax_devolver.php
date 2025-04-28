<?php	
	ini_set('display_errors', 1);

	include '../../FunPerPriNiv/pktblproductoseguimiento.php';
	include '../../FunPerPriNiv/pktblsoliprogestado.php';
	include '../../FunPerPriNiv/pktblcierresoliprog.php';
	include '../../FunPerPriNiv/pktblproducpedido.php';
	include '../../FunPerPriNiv/pktblpedidoventa.php';
	include '../../FunPerPriNiv/pktblsoliprog.php';
	include '../../FunPerPriNiv/pktblopestado.php';
	include '../../FunPerPriNiv/pktblcptpdetope.php';
	include '../../FunPerPriNiv/pktblproducto.php';
	include '../../FunPerSecNiv/fncnumreg.php';	
	include '../../FunPerSecNiv/fncclose.php';
	include '../../FunPerSecNiv/fncfetch.php';
	include '../../FunPerPriNiv/pktblop.php';
	include '../../FunPerSecNiv/fncconn.php';
	include '../../FunGen/fncnumprox.php'; 
	include '../../FunGen/fncnumact3.php'; 
	include '../../FunGen/cargainput.php';

	define("e_connection",-1);
	define("e_db",-2);
	define("e_empty",-3);
	define("e_data",-4);
	define("e_pedido",-5);
	define("cero",0);
	define("n1",1);
	define("id",112);
	define("id1",269);
	define("id2",264);

	$arrConf = array(
		'1' => 'VEN', 
		'2' => 'FIC', 
		'3' => 'DES', 
		'4' => 'DIS', 
		'5' => 'PLN',
		'6' => 'PRG',
		'7' => 'FIC');

	$idcon = fncconn();

	if ( $idcon && $modulocodigodes > 0 && $modulocodigoorg > 0 && $rdobutt > 0 && $usuacodi > 0 && $prosegdescri ){

		$nuidtemp = fncnumact(id,$idcon);	
		do{
			$nuresult = loadrecordcptpdetope($nuidtemp,$idcon);
			if($nuresult == e_empty)
				$codigo_cptodo = $nuidtemp;
			$nuidtemp ++;
		}while ($nuresult != e_empty);
		unset($nuidtemp);

		$nuidtemp = fncnumact(id1,$idcon);	
		do{
			$nuresult = loadrecordproductoseguimiento($nuidtemp,$idcon);
			if($nuresult == e_empty){
				$iRegproductoseguimiento['prosegcodigo'] = $nuidtemp;
			}
			$nuidtemp ++;
		}while ($nuresult != e_empty);
		unset($nuidtemp);

		if( $modulocodigoorg == 6 ){ 
			$rwSoliProg = loadrecordsoliprog($rdobutt, $idcon);
			$solprocodigo = $rwSoliProg['solprocodigo'];
			$produccodigo = $rwSoliProg['produccodigo'];
		}else{
			$produccodigo = $rdobutt;
		}

		$rwProducPedido = loadrecordproducpedido($produccodigo,$idcon);
		$rwPedidoVenta = loadrecordpedidoventa($rwProducPedido["pedvencodigo"],$idcon);

		if($rwPedidoVenta["tipevecodigo"] == "3" && ($modulocodigodes != "1" && $modulocodigodes != "5") ){
			//return e_pedido;
			$rwProducto = loadrecordproducto($rwProducPedido["propedproduc"],$idcon);
			$rwProducPedido1 = loadrecordproducpedido($rwProducto["produccodigo"],$idcon);
			$rwPedidoVenta1 = loadrecordpedidoventa($rwProducPedido1["pedvencodigo"],$idcon);
		 	echo "<p><font color='green'>Advertencia</font><br><p>No es posible realiar esta accion.<br>Devolver pedido No. consecutivo ".$rwProducPedido["propedproduc"]." No. PV ".$rwPedidoVenta1["pedvennumero"]."</p>";
		 	die;
		}else{

			$iRegproductoseguimiento['prosegnombre']= 0;
			$iRegproductoseguimiento['usuacodi']=$usuacodi;
			$iRegproductoseguimiento['produccodigo']=$produccodigo;
			$iRegproductoseguimiento['prosegfecha']=date("Y-m-d");
			$iRegproductoseguimiento['proseghora']=date("h:i,a");
			$iRegproductoseguimiento['modulocodigoorg']= $modulocodigoorg;
			$iRegproductoseguimiento['modulocodigodes']= $modulocodigodes;
			$iRegproductoseguimiento['prosegdescri']= $prosegdescri;

			if( $modulocodigoorg == 6 ){//modulo de programacion implica estar cerradas las ordenes de produccion.
				$flagProduccion = 0;//bandera de ordenes
				$rsOp = dinamicscanopop(array('solprocodigo' => $solprocodigo),array('solprocodigo' => '='),$idcon);
				$nrOp = fncnumreg($rsOp);

				for($a=0; $a < $nrOp; $a++)
				{

					$rwOp = fncfetch($rsOp, $a);
					$rwOpEstado = loadrecordopestado($rwOp['opestacodigo'] ,$idcon);
					if( $rwOpEstado['opestatipo'] > 1 && $rwOpEstado['opestatipo'] < 7 ){//tipo de estado cerradas , anuladas, terminadas
						$flagProduccion = 1;break; 
					}

				}

			}

			$rsvarCal = dinamicscancptpdetope(array("produccodigo" => $produccodigo ,"cptprocodigo" => 1000),$idcon);

			if($rsvarCal < 0 && $flagProduccion < 1 ){
				$iRegCptpdetope['cptodocodigo'] = $codigo_cptodo;
				$iRegCptpdetope['cptprocodigo'] = 1000;
				$iRegCptpdetope['usuacodi'] = $usuacodi;
				$iRegCptpdetope['cptprovalor'] = $arrConf[$modulocodigoorg];
				$iRegCptpdetope['cptprofecha'] = date('Y-m-d');
				$iRegCptpdetope['cptpronota'] = 'Calificacion del producto '.$sbreg['produccodigo'];
				$iRegCptpdetope['produccodigo'] = $produccodigo;


				if( insrecordcptpdetope($iRegCptpdetope,$idcon) > 0){

					fncnumprox(id,$iRegCptpdetope['cptodocodigo'] + 1,$idcon); 
					if( insrecordproductoseguimiento($iRegproductoseguimiento,$idcon) > 0){
						fncnumprox(id1,$iRegproductoseguimiento['prosegcodigo'] + 1,$idcon); 
						updateproducto(array('produccodigo' => $produccodigo, 'producproces' => $modulocodigodes),$idcon);

						if( $modulocodigoorg == 6 ){//se procede a cerrar la solicitud de programacion

							$nuidtemp = fncnumact(id2,$idcon);
							do
							{
								$nuresult = loadrecordcierresoliprog($nuidtemp,$idcon);
								if($nuresult == e_empty){
									$iRegcierresoliprog["ciesolcodigo"] = $nuidtemp;
								}
								$nuidtemp ++;
							}while ($nuresult != e_empty);
							unset($nuidtemp);

							$iRegcierresoliprog["solprocodigo"] = $solprocodigo;
							$iRegcierresoliprog["tipcumcodigo"] = 1;//excelente
							$iRegcierresoliprog["ciesolfecha"] = date('Y-m-d');
							$rwhora = getdate(time());
							$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
							$iRegcierresoliprog["ciesolhora"] = $hora;
							$iRegcierresoliprog["usuacodi"] = $usuacodi;
							$iRegcierresoliprog["ciesoldescri"] = $prosegdescri;
							$iRegcierresoliprog["ciesoltipo"] = 2;//por devolucion
							if(insrecordcierresoliprog($iRegcierresoliprog,$idcon) > 0){
								fncnumprox(id2,$iRegcierresoliprog['ciesolcodigo'] + 1,$idcon); 
								$iRegsoliprog["solprocodigo"] = $solprocodigo;
	    						$iRegsoliprog["estsolcodigo"] = 5;//anulada
								uprecordsoliprogestadosoliprog1($iRegsoliprog, $idcon);
								$iRegOp["opestacodigo"] = 11;//anulada
								$iRegOp["solprocodigo"] = $solprocodigo;
								uprecordop_estado1($iRegOp,$idcon);
							}

						}

						//return n1;
						$mensaje = ( $solprocodigo > 0 )? "<p>Sol. No. ".$solprocodigo." se devolvio satisfactoriamente</p>" : "<p>Registro No. ".$produccodigo." se devolvio satisfactoriamente</p>"  ;
		 				echo $mensaje;die;
					}else{
						//return e_db;
						echo "<p><font color='red'>Error</font><br>Ocurrio un error al momento de realizar la acci&oacute;n, por favor cierre la ventana e intentelo mas tarde</p>";
						die;
					}

				}else{
					//return e_db;
					echo "<p><font color='red'>Error</font><br>Ocurrio un error al momento de realizar la acci&oacute;n, por favor cierre la ventana e intentelo mas tarde</p>";
		 			die;
				}



			}else if($rsvarCal > 0 && $flagProduccion < 1){
				$rwvarCal = fncfetch($rsvarCal,0);
				$iRegCptpdetope['cptodocodigo'] = $rwvarCal['cptodocodigo'];
				$iRegCptpdetope['cptprocodigo'] = 1000;
				$iRegCptpdetope['usuacodi'] = $usuacodi;
				$iRegCptpdetope['cptprovalor'] = $arrConf[$modulocodigoorg];
				$iRegCptpdetope['cptprofecha'] = date('Y-m-d');
				$iRegCptpdetope['cptpronota'] = $rwvarCal['cptpronota'];
				$iRegCptpdetope['produccodigo'] = $rwvarCal['produccodigo'];

				if( uprecordcptpdetope($iRegCptpdetope,$idcon) > 0 ){

					if( insrecordproductoseguimiento($iRegproductoseguimiento,$idcon) > 0){
						fncnumprox(id1,$iRegproductoseguimiento['prosegcodigo'] + 1,$idcon); 
						updateproducto(array('produccodigo' => $produccodigo, 'producproces' => $modulocodigodes),$idcon);

						if( $modulocodigoorg == 6 ){//se procede a cerrar la solicitud de programacion
							$nuidtemp = fncnumact(id2,$idcon);
							do
							{
								$nuresult = loadrecordcierresoliprog($nuidtemp,$idcon);
								if($nuresult == e_empty){
									$iRegcierresoliprog["ciesolcodigo"] = $nuidtemp;
								}
								$nuidtemp ++;
							}while ($nuresult != e_empty);
							unset($nuidtemp);

							$iRegcierresoliprog["solprocodigo"] = $solprocodigo;
							$iRegcierresoliprog["tipcumcodigo"] = 1;//excelente
							$iRegcierresoliprog["ciesolfecha"] = date('Y-m-d');
							$rwhora = getdate(time());
							$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
							$iRegcierresoliprog["ciesolhora"] = $hora;
							$iRegcierresoliprog["usuacodi"] = $usuacodi;
							$iRegcierresoliprog["ciesoldescri"] = $prosegdescri;
							$iRegcierresoliprog["ciesoltipo"] = 2;//por devolucion
							if(insrecordcierresoliprog($iRegcierresoliprog,$idcon) > 0){
								fncnumprox(id2,$iRegcierresoliprog['ciesolcodigo'] + 1,$idcon); 
								$iRegsoliprog["solprocodigo"] = $solprocodigo;
	    						$iRegsoliprog["estsolcodigo"] = 5;//anulada
								uprecordsoliprogestadosoliprog1($iRegsoliprog, $idcon);
								$iRegOp["opestacodigo"] = 11;//anulada
								$iRegOp["solprocodigo"] = $solprocodigo;
								uprecordop_estado1($iRegOp,$idcon);
							}

						}

						//return n1;
						$mensaje = ( $solprocodigo > 0 )? "<p>Sol. No. ".$solprocodigo." se devolvio satisfactoriamente</p>" : "<p>Registro No. ".$produccodigo." se devolvio satisfactoriamente</p>"  ;
						echo $mensaje;die;
					}else{
						//return e_db;
						echo "<p><font color='red'>Error</font><br>Ocurrio un error al momento de realizar la acci&oacute;n, por favor cierre la ventana e intentelo mas tarde</p>";
						die;
					}

				}else{
					//return e_db;
					echo "<p><font color='red'>Error</font><br>Ocurrio un error al momento de realizar la acci&oacute;n, por favor cierre la ventana e intentelo mas tarde</p>";
		 			die;
				}


			}else{
				//return e_data;
				echo "<p><font color='red'>Advertencia:</font><br>Se encontraron ordenes activas al momento de realizar la acci&oacute;n, debe cerrar las ordenes de producci&oacuten implicadas en la solicitud.</p>";
		 		die;
			}
		}


	}else{
		//return e_connection;
		echo "<p><font color='red'>Error</font><br>Ocurrio un error al momento de realizar la acci&oacute;n, por favor cierre la ventana e intentelo mas tarde</p>";
		die;
	}

	fncclose($idcon);

?>
		