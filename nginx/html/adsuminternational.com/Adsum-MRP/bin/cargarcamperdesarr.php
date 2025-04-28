<?php 
//by ralvear ramiro-ok@hotmail.com
	//variable globales de guia
	//producto es el producto del item sea nuevo repeticion modificacion muestra viene de donde se incluya.
	//validamos que estemos pasando el codigo del producto
	$arrtabla2 = $arrtabla1;
	$producto_ = $producto;

	//validamos que estemos pasando el codigo del producto
	if($producto)
	{
		//validamos si es una repetecion 
		if($tipevecodigo == 3)
		{
			//carga el registro de producpedido para asi traer el producto al cual fue hecha la repeticion.
			$rwProductopedido = loadrecordproducpedidoPER('produccodigo',$producto,$idcon);			
			//se la asigna el codigo a la variable producto.
			$producto = $rwProductopedido['propedproduc'];
			if(!$producto)
			{
				//se envia mensaje de error inesperado y se redirecciona a el maestro.
				echo '<script language= "javascript">';
				echo '<!--//'."\n";
				echo 'alert("ocurrio un error inesperado.")';
				echo '//-->'."\n";
				echo '</script>';
				echo '<script language="javascript">';
				echo '<!--//'."\n";
				echo 'location ="maestablproducto.php?codigo='.$codigo.';"';
				echo '//-->'."\n";
				echo '</script>';
			}
		}
	
		//consulta dinamica ala tabla detalle de operacion de cpdesadetope
		//y asi traer los campos personalizados de los productos
		$rsCpdesadetope = dinamicscancpdesadetope(array('produccodigo' =>$producto),$idcon);
		//consultamos el numero de registros que devuleve la consulta
		if($rsCpdesadetope > 0) $nrCpdesadetope = fncnumreg($rsCpdesadetope);
		
		if($nrCpdesadetope <= 0){
			$rwProd = loadrecordproducpedido($producto,$idcon);
			$producto = $rwProd["propedproduc"];
			if($producto > 0){
				$rsCpdesadetope = dinamicscancpdesadetope(array('produccodigo' =>$producto),$idcon);
				$nrCpdesadetope = fncnumreg($rsCpdesadetope);
			}
		}
		//escaniamos de acuerdo a la contidad de registro y asignamos los valores a los campos personalizados
		for($i = 0;$i<$nrCpdesadetope;$i++)
		{
			$rwCpdesadetope = fncfetch($rsCpdesadetope,$i);
			$rwCamperdesarr = loadrecordcamperdesarr($rwCpdesadetope['cpdesacodigo'],$idcon);
			//se valida el proceso existe la validacion en proceso 3 por un cambio inesperado en la funcionalidad
			if($rwCamperdesarr['procescodigo'] != '3')
			{
				//se crea el campo personalizado
				$objCampo = $rwCamperdesarr['cpdesanombre'];
				//se le asigna el valor correspondiente en la base de datos.
				$$objCampo = $rwCpdesadetope['cpdsdovalor'];
				//almacenamos en un array por efectos adicionales de consulta y historia.
				//este campo no es indispensable
				$arrCamperdesarr[$objCampo] = $$objCampo;
			}
			//se valida el proceso existe la validacion en proceso 3 por un cambio inesperado en la funcionalidad
			//nota importante tener en cuanta esta parte.
			else
			{
				//validacion especial para cargar los campos de los materiales extruidos 
				//se crean un array en cada campo personalizado separado por comas
				//es por eso que se usa el explode y se continua ingresando creando las variables y asignado su valor
				$objCampo = $rwCamperdesarr['cpdesanombre'];
				$$objCampo = $rwCpdesadetope['cpdsdovalor'];
				$array_tmp = explode(',',$rwCpdesadetope['cpdsdovalor']);
				//ciclo de las variables
				for($a = 0; $a < count($array_tmp); $a++)
				{
					//se le asigna un nombre con una cadena denomida por el nombre +  en numero de resgitro.
					$objCampo = $rwCamperdesarr['cpdesanombre'].'_'.($a+1);
					//se le asigna el valor correspondiente en la base de datos.
					$$objCampo = $array_tmp[$a];
					//si tiene valor el objeto se procede a cargar el numero de la formulacion de extrusion en tabla formulacion
					if($$objCampo > 0 && $objCampo == 'formulcodigo_'.($a+1))
					{
						//se consulta el registro
						$rwFomulacion = loadrecordformulacion($$objCampo,$idcon);
						//variable adicional de la formulacion de los materiales extruidos
						$objCampo = 'formulnumero_'.($a+1);
						//se le asigna el valor
						$$objCampo = $rwFomulacion['formulnumero'];
					}
				}
			}
		}
	}
	//adicionales
	//tintas resistentas a
	unset($tintasa);
	if($tnt_calor) $tintasa = ($tintasa)? $tintasa.',CALOR' : 'CALOR' ;
	if($tnt_luz) $tintasa = ($tintasa)? $tintasa.',LUZ' : 'LUZ' ;
	if($tnt_acidos) $tintasa = ($tintasa)? $tintasa.',ACIDOS' : 'ACIDOS' ;
	if($tnt_alcalis) $tintasa = ($tintasa)? $tintasa.',ALCALIS' : 'ALCALIS' ;
	if($tnt_agua) $tintasa = ($tintasa)? $tintasa.',AGUA' : 'AGUA' ;
	if($tnt_grasas) $tintasa = ($tintasa)? $tintasa.',GRASAS' : 'GRASAS' ;
	if($tnt_brillo) $tintasa = ($tintasa)? $tintasa.',BRILLO' : 'BRILLO' ;
	if($tnt_rayado) $tintasa = ($tintasa)? $tintasa.',RAYADO' : 'RAYADO' ;
	$tintasa = ($tintasa)? $tintasa : '---' ;
	//tintas especiales para
	unset($tinta_espe);
	if($tntesp_laminacion) $tinta_espe = ($tinta_espe)? $tinta_espe.',LAMINACION' : 'LAMINACION' ;
	if($tntesp_superficie) $tinta_espe = ($tinta_espe)? $tinta_espe.',SUPERFICIE' : 'SUPERFICIE' ;
	if($tntesp_uretelasto) $tinta_espe = ($tinta_espe)? $tinta_espe.',URETANO ELASTOMERICO' : 'URETANO ELASTOMERICO' ;
	if($tntesp_nitropolia) $tinta_espe = ($tinta_espe)? $tinta_espe.',NITROPOLIAMIDA' : 'NITROPOLIAMIDA' ;
	if($tntesp_vinilica) $tinta_espe = ($tinta_espe)? $tinta_espe.',VINILICA' : 'VINILICA' ;
	if($tntesp_nitrocelu) $tinta_espe = ($tinta_espe)? $tinta_espe.',NITROCELULOSA' : 'NITROCELULOSA' ;
	if($tntesp_nitroure) $tinta_espe = ($tinta_espe)? $tinta_espe.',NITRO-URETANO' : 'NITRO-URETANO' ;
	if($tntesp_poliamo) $tinta_espe = ($tinta_espe)? $tinta_espe.',POLIAMODA' : 'POLIAMODA' ;
	$tinta_espe = ($tinta_espe)? $tinta_espe : '---' ;
	//otros materiales 
	unset($other);
	if($other_pmetali) $other = ($other)? $other.',PRIMER METALIZADO' : 'PRIMER METALIZADO' ;
	if($other_lacacaliz) $other = ($other)? $other.',LACA ANTI-ALCALIZ' : 'LACA ANTI-ALCALIZ' ;
	if($other_bamiz1) $other = ($other)? $other.',BAMIZ PIGMENTOS ME1' : 'BAMIZ PIGMENTOS ME1' ;
	if($other_lacatermo) $other = ($other)? $other.',LACA TERMOSELLABLE' : 'LACA TERMOSELLABLE' ;
	if($other_hotmelt) $other = ($other)? $other.',HOT-MELT' : 'HOT-MELT' ;
	if($other_parafina) $other = ($other)? $other.',PARAFINAS' : 'PARAFINAS' ;
	if($other_lacaantiperoxido) $other = ($other)? $other.',LACA ANTI-PEROXIDO' : 'LACA ANTI-PEROXIDO' ;
	$other = ($other)? $other : '---' ;
	//otros
	$ncaras_sellable = ($ncaras_sellable)? $ncaras_sellable : '---' ;
	$ncaras_trata = ($ncaras_trata)? $ncaras_trata : '---' ;
	$plano_tratado = ($plano_tratado)? $plano_tratado : '---' ;
	$trata_min = ($trata_min)? $trata_min : '---' ;
	$trata_max = ($trata_max)? $trata_max : '---' ;
	$cofmax_nt = ($cofmax_nt)? $cofmax_nt : '---' ;
	$cofmax_tt = ($cofmax_tt)? $cofmax_tt : '---' ;
	//validacion para tipo de material variable necesaria para validar estructura la cantidad de adhesivos
	if($tipo_estruc == 'monocapa')
		($arrTabs)? $arrTabs = $arrTabs.',4' : $arrTabs = '4';
	
	if($tipo_estruc == 'monocapa' || $tipo_estruc == 'bilaminado')
		$valid_produc_imp = 1;
		
	if($tipo_estruc == 'trilaminado')
		$valid_produc_imp = 2;
		
	if($tipo_estruc == 'tetralaminado')
		$valid_produc_imp = 3;
		
	if($tipo_estruc == 'multilaminado')
		$valid_produc_imp = 4;
	//product a imprimir
	if($product_imp) 
	{
		$rwPad = loadrecordpadreitem($product_imp,$idcon);
		$product_imp_nomb = $rwPad['paditenombre'];
	}
?>