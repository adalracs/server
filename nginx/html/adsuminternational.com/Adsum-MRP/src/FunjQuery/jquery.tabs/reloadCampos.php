<?php 
//by ralvear ramiro-ok@hotmail.com
	//variable globales de guia
	//produccoduno es el codigo de sistema a uno a realizar la repeticion
	ini_set('display_errors',1);
	//si no tiene padre asignado para realizar asignacion
	if(!$propedproduc){

		//se exige el codigo de sistema uno para sacar el ultimo producto vigente
		if($produccoduno){

			$idcon = fncconn();
			//funcion creada para obtener la ultima version de un producto
			$rsProducto = dinamicscanultimopadreproducto($produccoduno, $idcon);
			//se valida el resultado
			if($rsProducto > 0){

				//que se consulta el registro del producto a hacer la repeticon
				$rwProducto = fncfetch($rsProducto,0);
				//se asigna el padre de producto
				$propedproduc = $rwProducto['produccodigo'];

				if($rwProducto["tipprocodigo"] != $tipitecodigo){

					echo '<script language= "javascript">';
					echo '<!--//'."\n";
					echo 'alert("Error al repetir item debe seleccionar tipo de producto adecuado.")';
					echo '//-->'."\n";
					echo '</script>';
					//se envia al maestro 
					echo '<script language="javascript">';
					echo '<!--//'."\n";
					echo 'location ="maestablproducto.php?codigo='.$codigo.';"';
					echo '//-->'."\n";
					echo '</script>';

				}

			}else{
				//se muestra mensaje de producto no encontrado en el sistema
				echo '<script language= "javascript">';
				echo '<!--//'."\n";
				echo 'alert("No se encontro item en el sistema, Favor ingresar pedido nuevo.")';
				echo '//-->'."\n";
				echo '</script>';
				//se envia al maestro 
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablproducto.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
			$rwProducpedido = loadrecordproducpedidoPER('produccodigo',$rwProducto['produccodigo'],$idcon);
			$rwPedidoventa = loadrecordpedidoventa($rwProducpedido['pedvencodigo'],$idcon);
			if($rwPedidoventa['tipevecodigo'] !=4)
				$rwOrdencompra = loadrecordordencompra($rwPedidoventa['ordcomcodigo'],$idcon);
			$ordcomfecrec = $rwOrdencompra['ordcomfecrec'];
			//carga de campos de personalizados de ventas 
			//nota hay que asignar la varible producto con el codigo del producto actual. 
			$producto = $rwProducto['produccodigo'];
			//proceso alterno : se guardar valor del tipevecodigo para evitar error
			$tipevecodigo_ = $tipevecodigo;
			//se borra para evitar interfereccia por la redundacion
			unset($tipevecodigo); 
			include 'cargarcampertippro.php';
			//re re asiga el valor
			$tipevecodigo = $tipevecodigo_;
			//asigana la bandera de modificacion si es modificacion
			if($tipevecodigo == 2)
				$flagmodificacion = 1;
			$cant = $cant_rep;
			$unimedi = $unimedi_rep;
			$arrCampertippro['cant'] = $cant;
			$arrCampertippro['unimedi'] = $unimedi;
			//cierra conexion
			fncclose($idcon);
		}

	}else{

		$idcon = fncconn();
		//carga de campos de personalizados de ventas 
		//nota hay que asignar la varible producto con el codigo del producto actual. 
		$producto = $propedproduc;
		//proceso alterno : se guardar valor del tipevecodigo para evitar error
		$tipevecodigo_ = $tipevecodigo;
		//se borra para evitar interfereccia por la redundacion
		unset($tipevecodigo); 
		include 'cargarcampertippro.php';
		//re re asiga el valor
		$tipevecodigo = $tipevecodigo_;
		//asigana la bandera de modificacion si es modificacion
		if($tipevecodigo == 2)
			$flagmodificacion = 1;
		$cant = $cant_rep;
		$unimedi = $unimedi_rep;
		$arrCampertippro['cant'] = $cant;
		$arrCampertippro['unimedi'] = $unimedi;
		//cierra conexion
		fncclose($idcon);
	}
	
	$arrTabs = '';
	//Tabs Enabled - Disabled
	if($esp_pro == '0') ($arrTabs) ? $arrTabs .= ',1' : $arrTabs .= '1'; 
	if($emb == '0') ($arrTabs) ? $arrTabs .= ',2' : $arrTabs .= '2'; 
	if($ext == '0') ($arrTabs) ? $arrTabs .= ',3' : $arrTabs .= '3'; 
	if($lmn == '0') ($arrTabs) ? $arrTabs .= ',4' : $arrTabs .= '4'; 
	if($con_pro == '0') ($arrTabs) ? $arrTabs .= ',5' : $arrTabs .= '5'; 
?>