<?php 
	ini_set('display_erros',1);
	include ( '../src/FunPerSecNiv/fncconn.php');
	include ( '../src/FunPerSecNiv/fncclose.php');
	include ( '../src/FunPerSecNiv/fncsqlrun.php');
	include ( '../src/FunPerSecNiv/fncnumreg.php');
	include ( '../src/FunPerSecNiv/fncfetch.php');	
	include ('../src/FunPerPriNiv/pktblitemdesa.php');
	include ('../src/FunPerPriNiv/pktblusuario.php');
	include ('../src/FunPerPriNiv/pktblformula.php');
	include ('../src/FunPerPriNiv/pktblpadreitem.php');
	include ('../src/FunPerPriNiv/pktblproducpadreitem.php');
	include ('../src/FunPerPriNiv/pktblproducpadreitem_ft.php');
	include ('../src/FunPerPriNiv/pktblcampertippro.php');
	include ('../src/FunPerPriNiv/pktblcamperdesarr.php');
	include ('../src/FunPerPriNiv/pktblcamperdispen.php');
	include ('../src/FunPerPriNiv/pktblcamperplanea.php');
	include ('../src/FunPerPriNiv/pktblcamperfichat.php');
	include ('../src/FunPerPriNiv/pktblcpdesadetope.php');
	include ('../src/FunPerPriNiv/pktblcptpdetope.php');
	include ('../src/FunPerPriNiv/pktblcpdispdetope.php');
	include ('../src/FunPerPriNiv/pktblcpplandetope.php');
	include ('../src/FunPerPriNiv/pktblcpfichdetope.php');
	include ('../src/FunPerPriNiv/pktblproducpedido.php');
	include ('../src/FunPerPriNiv/pktblproducformula.php');
	include ('../src/FunPerPriNiv/pktblproducformula_ft.php');
	include ('../src/FunPerPriNiv/pktblformulacion.php');
	include ('../src/FunPerPriNiv/pktblpedidoventa.php');
	include ('../src/FunPerPriNiv/pktblordencompra.php');
	include ( '../src/FunPerPriNiv/pktblproducto.php');
	include ('../src/FunPerPriNiv/pktblequipo.php');
	include ('../src/FunPerPriNiv/pktblplaneaitemdesa.php');
	include ('../src/FunGen/cargainput.php');
	$idcon = fncconn();
	$rwProducto = loadrecordproducto($codigo,$idcon);	
	//variables globales
	$tipitecodigo = $rwProducto['tipprocodigo']; 
	$produccodigo = $rwProducto['produccodigo'];
	//registro de producpedido
	$rwProducpedido = loadrecordproducpedidoPER('produccodigo',$rwProducto['produccodigo'],$idcon);	
	//registro de pedido venta
	$rwPedidoventa = loadrecordpedidoventa($rwProducpedido['pedvencodigo'],$idcon);
	//campos para formulario
	$pedvenfecent = $rwPedidoventa['pedvenfecent'];
	$pedvenfecent = $rwPedidoventa['pedvenfecelb'];
	$pedvennumero = $rwPedidoventa['pedvennumero'];
	$produccoduno = $rwProducto['produccoduno'];
	$producnombre = $rwProducto['producnombre'];
	$pedvenfecrec =  $rwPedidoventa['pedvenfecrec'];
	$tipevecodigo = $rwPedidoventa['tipevecodigo'];
	$nombre = cargausuanombre($rwPedidoventa['usuacodi'], $idcon);
	//registro de orden de compra si no es pedido de repeticion
	if($rwPedidoventa['tipevecodigo'] !=4)
		$rwOrdencompra = loadrecordordencompra($rwPedidoventa['ordcomcodigo'],$idcon);
	$clientnombre = $rwOrdencompra['ordcomrazsoc'];
	//carga de campos de personalizados de ventas 		
	//nota hay que asignar la varible producto con el codigo del producto actual. 
	$producto = $produccodigo;
	include 'cargarcampertippro.php';
	$producto = $produccodigo;		
	include 'cargarcamperfichat.php';
	$nombre = cargausuanombre($usuacodi, $idcon);
	$respon = $nombre;
	//para  la imagen de los tipos de embobinados
	$arr_ext = array('.gif','.jpg','.jpeg','.png','.bmp','.GIF','.JPG','.JPEG','.PNG','.BMP');
	for($i = 0; $i < count($arr_ext); $i++)
	{
		if(file_exists('../img/pics_embobinados/embobinado_'.$tipembcodigo.$arr_ext[$i]))
		{
			$embobinado_icon = 'embobinado_'.$tipembcodigo.$arr_ext[$i];
			break;
		}
	}
	if($arrdispensing) $arrNro = explode(',',$arrdispensing);
?>
<html>
	<head>
		<style>
			.tabla {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size:10px;
			width: 800px;}
		</style>
	</head>
	<body>
		<table border="1" class="tabla">
			<tr>
				<td><img src="../img/barra.png"></img></td>
				<td align="center"><b>FICHA TECNICA DEL PRODUCTO</b></td>
				<td align="center"><b>DOCUMENTO EN PRUEBA</b></td>
			</tr>
			<tr>
				<td>Item :&nbsp;<?php echo ($produccoduno)? strtoupper($produccoduno) : '---' ; ?></td>
				<td>Ref :&nbsp;<?php echo ($producnombre)? strtoupper($producnombre) : '---' ;?> </td>
				<td>Cliente :&nbsp;<?php echo ($clientnombre)? strtoupper($clientnombre) : '---' ; ?></td>
			</tr>
		</table>
		
		<!-- 	EXTRUSION-->
			<table border="0" class="tabla">
				<tr>
					<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>EXTRUIDO</b></td>
				</tr>
				<?php 
					if($arrtabla1)
					{
						$array_tmp = explode(':|:',$arrtabla1);
						for($a = 0; $a < count($array_tmp); $a++)
						{
							$rwArray_tmp = explode(':-:', $array_tmp[$a]);
							$rwItem = loadrecordpadreitem($rwArray_tmp[1],$idcon);	
		
							if($rwArray_tmp[4] == 't')
							{
								 //objetos de campos personalizado
								$objapli_mate = 'apli_mate_'.($a + 1); // aplicacion del material
								$objcolor = 'color_'.($a + 1); // color de material
								$objtratamiento = 'tratamiento_'.($a + 1); // tratamiento
								$objtrata_min = 'trata_min_'.($a + 1); // tratamiento minimo
								$objtrata_max = 'trata_max_'.($a + 1); // tratamiento maximo
								$objncaras_trata = 'ncaras_trata_'.($a + 1); // numero de caras tratadas
								$objmat_sellable = 'mat_sellable_'.($a + 1); // material sellable
								$objncaras_sellable = 'ncaras_sellable_'.($a + 1); // numero de caras sellables
								$objcofmax_nt = 'cofmax_nt_'.($a + 1); // cofmax_nt
								$objcofmax_tt = 'cofmax_tt_'.($a + 1); // cofmax_tt
								$objhaze = 'haze_'.($a + 1); // haze
								$objtole_haze_ms = 'tole_haze_ms_'.($a + 1); // tolerancia haze por mas
								$objtole_haze_mn = 'tole_haze_mn_'.($a + 1); // tolerancia haze por menos
								$objnote_extruido = 'note_extruido_'.($a + 1); // nota para material extruido
								$objcore = 'core_'.($a + 1); // core
								$objtemp_sellado= 'temp_sellado_'.($a + 1); // temperatura de sellado
								$objfuerza_sellado= 'fuerza_sellado_'.($a + 1); // fuerza de sellado
								$objr_soplado= 'r_soplado_'.($a + 1); // relacion de soplasdo
								$objbrillo= 'brillo_'.($a + 1); // brillo
								$objclaridad= 'claridad_'.($a + 1); // claridad
								$objtransmitancia = 'transmitancia_'.($a + 1); // transmitancia
								$objtipo= 'tipo_'.($a + 1); // tipo
								$objplano_tratado= 'plano_tratado_'.($a + 1); // plano_tratado
								$objdardo= 'dardo_'.($a + 1); // prueba al dardo
								$objrasgado_md= 'rasgado_md_'.($a + 1); // rasgado_md
								$objrasgado_td= 'rasgado_td_'.($a + 1); // rasgado_td
								$objelongacion_md= 'elongacion_md_'.($a + 1); // elongacion_md
								$objelongacion_td= 'elongacion_td_'.($a + 1); // elongacion_td
								$objruptura_td= 'ruptura_td_'.($a + 1); // ruptura_td
								$objruptura_md= 'ruptura_md_'.($a + 1); // ruptura_md_
			
								$objformul_cod = 'formulcodigo_'.($a + 1); // formulacion codigo
								$objformul_num = 'formulnumero_'.($a + 1); // formiulacion numero
								$objbutton = 'formulbutton_'.($a + 1); // boton de formiulacion 
				
			
								if($tipo_impresion != 'sin_impresion')
									$$objtratamiento = 'si';
							
								if($rwItem['paditepigmen'] == 'f')
									$$objcolor = 'TRANSPARENTE';
				?>
				<tr>
					<td colspan="2">&nbsp;<b>Sustrato no <?php echo ($a + 1)?> <?php echo $rwItem['paditenombre'] ?> Calibre <?php echo $rwArray_tmp[3] ?></b></td>
					<td colspan="2">&nbsp;Tolerancia al calibre&nbsp;(%)<b><b>+</b><?php echo ($tole_calib_ms)? $tole_calib_ms : '**' ;?>&nbsp;<b>-</b><?php echo ($tole_calib_mn)? $tole_calib_mn : '**' ; ?></b>
 				</tr>
 				<tr>
					<td width="200px">&nbsp;Aplicacion del material</td>
					<td width="150px">&nbsp;<?php echo ($$objapli_mate)? strtoupper($$objapli_mate) : '---' ; ?></td>
					<td width="200px">&nbsp;Color</td>
					<td width="150px">&nbsp;<?php echo ($$objcolor)? strtoupper($$objcolor) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="200px">&nbsp;Tratamiento</td>
					<td width="150px">&nbsp;<?php echo ($$objtratamiento)? strtoupper($$objtratamiento) : '---' ; ?></td>
					<td width="200px">&nbsp;Core</td>
					<td width="150px">&nbsp;<?php echo ($$objcore)? strtoupper($$objcore) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="200px">&nbsp;Formulacion</td>
					<td colspan="3">&nbsp;<?php echo ($$objformul_num)? strtoupper($$objformul_num) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="200px">&nbsp;Trata. min (dinas)</td>
					<td width="150px">&nbsp;<?php echo ($$objtrata_min)? strtoupper($$objtrata_min) : '---' ; ?></td>
					<td width="200px">&nbsp;Trata. max (dinas)</td>
					<td width="150px">&nbsp;<?php echo ($$objtrata_max)? strtoupper($$objtrata_max) : '---' ; ?></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;<b>(cof)</b> Cara no tratada max</td>
					<td colspan="3">&nbsp;<?php echo ($$objcofmax_nt)? strtoupper($$objcofmax_nt) : '---' ; ?></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;<b>(cof)</b> Cara tratada max</td>
					<td colspan="3">&nbsp;<?php echo ($$objcofmax_tt)? strtoupper($$objcofmax_tt) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="200px">&nbsp;No caras tratadas</td>
					<td width="150px">&nbsp;<?php echo ($$objncaras_trata)? strtoupper($$objncaras_trata) : '---' ; ?></td>
					<td width="200px">&nbsp;Plano tratado</td>
					<td width="150px">&nbsp;<?php echo ($$objplano_tratado)? strtoupper($$objplano_tratado) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="200px">&nbsp;Material sellable</td>
					<td width="150px">&nbsp;<?php echo ($$objmat_sellable)? strtoupper($$objmat_sellable) : '---' ; ?></td>
					<td width="200px">&nbsp;No caras sellables</td>
					<td width="150px">&nbsp;<?php echo ($$objncaras_sellable)? strtoupper($$objncaras_sellable) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="200px">&nbsp;Temperatura de sellado&nbsp;<b>(c)</b></td>
					<td width="150px">&nbsp;<?php echo ($$objtemp_sellado)? strtoupper($$objtemp_sellado) : '---' ; ?></td>
					<td width="200px">&nbsp;Fuerza de sellado&nbsp;<b>(gf/pul)</b></td>
					<td width="150px">&nbsp;<?php echo ($$objfuerza_sellado)? strtoupper($$objfuerza_sellado) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="200px">&nbsp;Brillo&nbsp;<b>(%)</b></td>
					<td width="150px">&nbsp;<?php echo ($$objbrillo)? strtoupper($$objbrillo) : '---' ; ?></td>
					<td width="200px">&nbsp;Claridad&nbsp;<b>(%)</b></td>
					<td width="150px">&nbsp;<?php echo ($$objclaridad)? strtoupper($$objclaridad) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="200px">&nbsp;Transmitancia&nbsp;<b>(%)</b></td>
					<td width="150px">&nbsp;<?php echo ($$objtransmitancia)? strtoupper($$objtransmitancia) : '---' ; ?></td>
					<td width="200px">&nbsp;Tipo&nbsp;</td>
					<td width="150px">&nbsp;<?php echo ($$objtipo)? strtoupper($$objtipo) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="200px">&nbsp;Prueba al dardo&nbsp;<b>(g)</b></td>
					<td width="150px">&nbsp;<?php echo ($$objdardo)? strtoupper($$objdardo) : '---' ; ?></td>
					<td width="200px">&nbsp;Relacion de soplado&nbsp;</td>
					<td width="150px">&nbsp;<?php echo ($$objr_soplado)? strtoupper($$objr_soplado) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="200px">&nbsp;Rasgado MD&nbsp;<b>(g)</b></td>
					<td width="150px">&nbsp;<?php echo ($$objrasgado_md)? strtoupper($$objrasgado_md) : '---' ; ?></td>
					<td width="200px">&nbsp;Rasgado TD&nbsp;</td>
					<td width="150px">&nbsp;<?php echo ($$objrasgado_td)? strtoupper($$objrasgado_td) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="200px">&nbsp;Elongacion MD&nbsp;<b>(g)</b></td>
					<td width="150px">&nbsp;<?php echo ($$objelongacion_md)? strtoupper($$objelongacion_md) : '---' ; ?></td>
					<td width="200px">&nbsp;Elongacion TD&nbsp;</td>
					<td width="150px">&nbsp;<?php echo ($$objelongacion_td)? strtoupper($$objelongacion_td) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="200px">&nbsp;Ruptura MD&nbsp;<b>(g)</b></td>
					<td width="150px">&nbsp;<?php echo ($$objruptura_md)? strtoupper($$objruptura_md) : '---' ; ?></td>
					<td width="200px">&nbsp;Ruptura TD&nbsp;</td>
					<td width="150px">&nbsp;<?php echo ($$objruptura_td)? strtoupper($$objruptura_td) : '---' ; ?></td>
				</tr>
				<tr>
					<td width="200px">&nbsp;Opacidad haze <b>%</b></td>
					<td width="150px">&nbsp;<?php echo ($$objhaze)? strtoupper($$objhaze) : '---' ; ?></td>
					<td width="200px">&nbsp;Tolerancia haze</td>
					<td width="150px">&nbsp;
						<b>+</b><?php echo ($$objtole_haze_ms)? strtoupper($$objtole_haze_ms) : 'xx' ; ?>&nbsp;
						<b>-</b><?php echo ($$objtole_haze_mn)? strtoupper($$objtole_haze_mn) : 'xx' ; ?>
				</tr>
				<tr>
					<td width="200px">&nbsp;Observaciones</td>
					<td colspan="3">&nbsp;<?php echo ($$objnote_extruido)? strtoupper($$objnote_extruido) : '---' ; ?></td>
				</tr>
				<?php 
							}
						}
					}
				?>
				
			</table>
		<!-- 	FIN EXTRUSION-->
		

		<!--	**************************************************************	-->
		<!--	FICHA TECNICA DE BOLSA FLOW PACK	-->
		<!--	**************************************************************	-->
		<?php if($tipitecodigo == 1){?>
		
		<!-- 	DATOS IMPRESION -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>IMPRESION</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Material a imprimir</td>
				<td colspan="3">&nbsp;<?php echo ($product_imp_nomb)? strtoupper($product_imp_nomb) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Rodillo</td>
				<td width="150px">&nbsp;<?php echo ($rodillo)? strtoupper($rodillo) : '---' ;?></td>
				<td width="200px">&nbsp;Repeticiones</td>
				<td width="150px">&nbsp;<?php echo ($nrorepet)? strtoupper($nrorepet) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Pistas</td>
				<td width="150px">&nbsp;<?php echo ($nropistas)? strtoupper($nropistas) : '---' ;?></td>
				<td width="200px">&nbsp;No caras</td>
				<td width="150px">&nbsp;<?php echo ($ncaras_imp)? strtoupper($ncaras_imp) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ancho<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho_impresion)? strtoupper($ancho_impresion) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia ancho</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_ancho_impresion_ms)? strtoupper($tole_ancho_impresion_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_impresion_mn)? strtoupper($tole_ancho_impresion_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Largo<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($largo)? strtoupper($largo) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia largo</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_largo_ms)? strtoupper($tole_largo_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_largo_mn)? strtoupper($tole_largo_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Otros productos</td>
				<td colspan="3">&nbsp;<?php echo ($other)? strtoupper($other) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Fotocelda al lado</td>
				<td width="150px">&nbsp;<?php echo ($fotoc_lado)? strtoupper($fotoc_lado) : '---' ;?></td>
				<td width="200px">&nbsp;Tipo de impresion</td>
				<td width="150px">&nbsp;<?php echo ($tipo_impresion)? strtoupper($tipo_impresion) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ancho Fotocelda&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho_fotoc)? strtoupper($ancho_fotoc) : '---' ;?></td>
				<td width="200px">&nbsp;Largo Fotocelda&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($largo_fotoc)? strtoupper($largo_fotoc) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Dist. Fotocelda al borde&nbsp;<b>(mm)</b></td>
				<td colspan="3">&nbsp;<?php echo ($dfotoc_borde)? strtoupper($dfotoc_borde) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Color Fotocelda&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($color_fotoc)? strtoupper($color_fotoc) : '---' ; ?></td>
				<td width="200px">&nbsp;Codigo SAP&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($codigosap)? strtoupper($codigosap) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tintas resistentes a&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tintasa)? strtoupper($tintasa) : '---' ;?></td>
			<tr>
				<td width="200px">&nbsp;Tintas especiales a&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tinta_espe)? strtoupper($tinta_espe) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Version del arte&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($version_arte)? strtoupper($version_arte) : '---' ;?></td>
			</tr>
			<tr>
				<td colspan="4" align="left">&nbsp;<b>TEXTOS LEGALES</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Codigo de barras&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($cod_barras)? strtoupper($cod_barras) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Color fondo barras&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($color_fondo_barras)? strtoupper($color_fondo_barras) : '---' ; ?></td>
				<td width="200px">&nbsp;Color barras&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($color_barras)? strtoupper($color_barras) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Observaciones&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($note_product)? strtoupper($note_product) : '---' ; ?></td>
			</tr>
			<?php if($arrdispensing) $arrObject = explode(':|:',$arrdispensing);?>
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>CUADRO DE TINTAS # <?php echo count($arrObject); ?></b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;COLOR PANTONE&nbsp;</td>
				<td width="150px">&nbsp;CODIGO PLASTICEL&nbsp;</td>
				<td width="200px">&nbsp;ANILOX&nbsp;</td>
				<td width="150px">&nbsp;GRUPO&nbsp;</td>
			</tr>
			<?php 
				if($arrdispensing)
				{
					unset($arrObject);
					$arrObject = explode(':|:',$arrdispensing);
					for($a = 0; $a < count($arrObject); $a++)
					{
						$arrRow = explode(':-:',$arrObject[$a]);
						//variables a usar
						$obj_anilox = 'anilox_'.$arrRow[1];
						$obj_grupo = 'grupo_'.$arrRow[1];
						$rwFormula = loadrecordformula($arrRow[1],$idcon)
 			?>
 			<tr>
 				<td width="200px">&nbsp;<?php echo ($rwFormula['formulnombre'])? strtoupper($rwFormula['formulnombre']) : '---' ; ?></td>
 				<td width="150px">&nbsp;<?php echo ($rwFormula['formulnumero'])? strtoupper($rwFormula['formulnumero']) : '---' ; ?></td>
 				<td width="200px">&nbsp;<?php echo ($$obj_anilox)? $$obj_anilox : '---' ; ?></td>
 				<td width="150px">&nbsp;<?php echo ($$obj_grupo)? $$obj_grupo : '---' ; ?></td>
 			</tr>
 			<?php 
					}
				}					
			?>
			<tr>
				<td width="200px">&nbsp;Papel pouch&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($papel_pouch_imp)? strtoupper($papel_pouch_imp) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($papel_pouch_imp == 'si') {echo 'block';}else{echo 'none';} ?>">Impreso por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($papel_pouch_imp == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($papel_pouch_imppor)? strtoupper($papel_pouch_imppor) : '---' ; ?></span></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Foil&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($foil_imp)? strtoupper($foil_imp) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($foil_imp == 'si') {echo 'block';}else{echo 'none';} ?>">Impreso por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($foil_imp == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($foil_imppor)? strtoupper($foil_imppor) : '---' ; ?></span></td>
			</tr>
			<tr>
				<td colspan="4" align="center">&nbsp;<b>EMBOBINADO FINAL</b></td>
			</tr>
			<tr>
				<td colspan="4" align="center"><img src="../img/pics_embobinados/<?php if(!$embobinado_icon){echo 'no_image.jpg';}else{echo $embobinado_icon;}?>"></img></td>
			</tr>		
		</table>
		<!-- 	FIN DATOS IMPRESION -->
		
		
		
		<!-- 	DATOS ESTRUCTURA PRODUCTO Y/O LAMINACION -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>ESTRUCTURA PRODUCTO Y/O LAMINACION</b></td>
			</tr>
			<tr>
				<td width="400px">&nbsp;Material</td>
				<td width="100px">&nbsp;Color</td>
				<td width="100px">&nbsp;Calibre</td>
				<td width="100px">&nbsp;Gramaje</td>
			</tr>
			<?php 
				if($arrtabla1)
				{
					$array_tmp = explode(':|:',$arrtabla1);
					for($a = 0; $a < count($array_tmp); $a++)
					{
						$rwArray_tmp = explode(':-:', $array_tmp[$a]);
						$rwArray_tmp_adh = explode(',',$rwArray_tmp[4]);
						$rwPadreitem = loadrecordpadreitem($rwArray_tmp[1],$idcon);
						if($rwPadreitem['paditeconfig'] != 1)
						{
							$tipo_material_ = ($tipo_material_)? $tipo_material_.' / '.$rwPadreitem['paditenombre'] : $rwPadreitem['paditenombre'] ;
						}
 			?>
 			<tr>
 				<td width="400px">&nbsp;<?php echo ($rwPadreitem['paditenombre'])? strtoupper($rwPadreitem['paditenombre']) : '---' ; ?>&nbsp;<?php if($rwArray_tmp_adh[1]){ echo ($rwArray_tmp_adh[1])? '|&nbsp;Desempe&ntilde;o ('.$rwArray_tmp_adh[1].')' : '-------' ;}?>&nbsp;<?php if($rwArray_tmp_adh[2]){echo ($rwArray_tmp_adh[2])? '|&nbsp;Tipo ('.$rwArray_tmp_adh[2].')' : '-------' ;}?></td>
				<td width="100px">&nbsp;<?php echo ($$objColor)? strtoupper($$objColor) : '---' ;?></td>
				<td width="100px">&nbsp;<?php echo ($rwArray_tmp[3])? $rwArray_tmp[3] : '---' ;?></td>
				<td width="100px">&nbsp;<?php echo ($rwArray_tmp[3] * $rwArray_tmp[2]) ?></td>
 			</tr>
 			<?php 
						
	 				}
 				}
 			?>
 			<tr>
 				<td width="400px">&nbsp;</td>
				<td width="100px">&nbsp;</td>
				<td width="100px">&nbsp;<?php echo ($total_calibre)? strtoupper($total_calibre) : '---' ;?></td>
				<td width="100px">&nbsp;<?php echo ($total_gramaje)? strtoupper($total_gramaje) : '---' ;?></td>
 			</tr>
 			<tr>
 				<td width="400px">&nbsp;</td>
				<td width="100px">&nbsp;</td>
				<td width="100px">&nbsp;<b>+</b><?php echo ($tole_calib_ms)? strtoupper($tole_calib_ms) : '**' ; ?>&nbsp;<b>-</b><?php echo ($tole_calib_ms)? strtoupper($tole_calib_ms) : '**' ;?>&nbsp;</td>
				<td width="100px">&nbsp;<b>+</b><?php echo ($tole_grama_mn)? strtoupper($tole_grama_mn) : '**' ; ?>&nbsp;<b>-</b><?php echo ($tole_calib_ms)? strtoupper($tole_calib_ms) : '**' ;?>&nbsp;</td>
 			</tr>
 		</table>
 		<table border="0" class="tabla">
 			<tr>
				<td width="200px">&nbsp;Papel pouch&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($papel_pouch_lam)? strtoupper($papel_pouch_lam) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($papel_pouch_lam == 'si') {echo 'block';}else{echo 'none';} ?>">Laminado por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($papel_pouch_lam == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($papel_pouch_lampor)? strtoupper($papel_pouch_lampor) : '---' ; ?></span></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Foil&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($foil_lam)? strtoupper($foil_lam) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($foil_lam == 'si') {echo 'block';}else{echo 'none';} ?>">Laminado por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($foil_lam == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($foil_lampor)? strtoupper($foil_lampor) : '---' ; ?></span></td>
			</tr>
		</table>
		<!-- 	FIN DATOS ESTRUCTURA PRODUCTO Y/O LAMINACION -->
		
		
		
		<!-- 	DATOS SELLADO -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>SELLADO</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Producto&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tipoproducto)? strtoupper($tipoproducto) : '---' ; ?></td>
			</tr>
			<tr>
				<td colspan="4" align="center">&nbsp;<b>MEDIDAS DEL PRODUCTO</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ancho&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho)? strtoupper($ancho) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia ancho&nbsp;</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_ancho_ms)? strtoupper($tole_ancho_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_mn)? strtoupper($tole_ancho_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Largo&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($largo)? strtoupper($largo) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia largo&nbsp;</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_largo_ms)? strtoupper($tole_largo_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_mn)? strtoupper($tole_ancho_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo sellado&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_sellado)? strtoupper($tipo_sellado) : '---' ; ?></td>
				<td width="200px">&nbsp;Forma sellado&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($forma_sellado)? strtoupper($forma_sellado) : '---' ; ?></td>
			</tr>	
			<tr>
				<td width="200px">&nbsp;Ancho de selle&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($aselle_bolsa)? strtoupper($aselle_bolsa) : '---' ; ?></td>
				<td width="200px">&nbsp;Impresion&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_impresion)? strtoupper($tipo_impresion) : '---' ; ?></td>
			</tr>	
			<tr>
				<td width="200px">&nbsp;Peso millar&nbsp;<b>(kg/millar)</b></td>
				<td width="150px">&nbsp;<?php echo (round(((($solapa / 1000) + ($largo / 1000 * 2) + ($solapa / 1000 * 2) + ($fuelle / 1000 * 2)) * (($ancho / 1000) * $total_gramaje))*100) / 100) / 2 ?></td>
				<td width="200px">&nbsp;Maquina&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($maquina)? strtoupper($maquina) : '---' ; ?></td>
			</tr>	
			<tr>
				<td width="200px">&nbsp;Fuelle&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($fuelle)? strtoupper($fuelle) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia fuelle&nbsp;</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_fuelle_ms)? strtoupper($tole_fuelle_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_fuelle_mn)? strtoupper($tole_fuelle_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Traslape&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($traslape)? strtoupper($traslape) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia traslape&nbsp;</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_traslape_ms)? strtoupper($tole_traslape_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_traslape_mn)? strtoupper($tole_traslape_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo traslape&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_traslape)? strtoupper($tipo_traslape) : '---' ; ?></td>
				<td width="200px">&nbsp;Dist. precalentadores&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($dist_precalentadores)? strtoupper($dist_precalentadores) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Codigo valvula&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($cod_valve)? strtoupper($cod_valve) : '---' ; ?></td>
				<td width="200px">&nbsp;Referencia valvula&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($valve_item)? strtoupper($valve_item) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Troquel&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($troquel)? strtoupper($troquel) : '---' ; ?></td>
				<td width="200px">&nbsp;Tipo de troquel&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_troquel)? strtoupper($tipo_troquel) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;LLenado&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tipo_llenado)? strtoupper($tipo_llenado) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Observaciones</td>
				<td colspan="3">&nbsp;<?php echo ($note_sellado)? strtoupper($note_sellado) : '---' ; ?></td>
			</tr>
		</table>
		<!-- 	FIN DATOS SELLADO -->
		
		
		
		<!-- 	DATOS MICRO -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>MICRO</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo material&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tipo_estruc)? strtoupper($tipo_estruc) : '---' ; ?>&nbsp;<?php echo ($tipo_material_) ? strtoupper($tipo_material_) : '' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Calibre&nbsp;<b>(&micro;m)</b></td>
				<td colspan="3">&nbsp;<?php echo ($total_calibre)? strtoupper($total_calibre) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ancho<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho_impresion)? strtoupper($ancho_impresion) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia ancho</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_ancho_impresion_ms)? strtoupper($tole_ancho_impresion_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_impresion_mn)? strtoupper($tole_ancho_impresion_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo microperforacion&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($mcr_tipo_perforacion)? strtoupper($mcr_tipo_perforacion) : '---' ; ?></td>
				<td width="200px">&nbsp;Cant. caras microperforadas&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($mrc_cant_cara_microper)? strtoupper($mrc_cant_cara_microper) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Observaciones</td>
				<td colspan="3">&nbsp;<?php echo ($note_micro)? strtoupper($note_micro) : '---' ; ?></td>
			</tr>
		</table>
		<!-- 	FIN DATOS MICRO -->
		
		
		
		
		
		<!-- 	DATOS DOBLADO -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>DOBLADO</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo material&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tipo_estruc)? strtoupper($tipo_estruc) : '---' ; ?>&nbsp;<?php echo ($tipo_material_) ? strtoupper($tipo_material_) : '' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Calibre&nbsp;<b>(&micro;m)</b></td>
				<td colspan="3">&nbsp;<?php echo ($total_calibre)? strtoupper($total_calibre) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Observaciones</td>
				<td colspan="3">&nbsp;<?php echo ($note_doblado)? strtoupper($note_doblado) : '---' ; ?></td>
			</tr>
		</table>
		<!-- 	FIN DATOS DOBLADO -->
		<?php }?>
		<!--	**************************************************************	-->
		<!--	FIN FICHA TECNICA DE BOLSA FLOW PACK	-->
		<!--	**************************************************************	-->
		
		
		
		
		
		
		
		
		
		<!--	**************************************************************	-->
		<!--	FICHA TECNICA DE BOLSA LATERAL	-->
		<!--	**************************************************************	-->
		<?php if($tipitecodigo == 2){?>
		
		<!-- 	DATOS IMPRESION -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>IMPRESION</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Material a imprimir</td>
				<td colspan="3">&nbsp;<?php echo ($product_imp_nomb)? strtoupper($product_imp_nomb) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Rodillo</td>
				<td width="150px">&nbsp;<?php echo ($rodillo)? strtoupper($rodillo) : '---' ;?></td>
				<td width="200px">&nbsp;Repeticiones</td>
				<td width="150px">&nbsp;<?php echo ($nrorepet)? strtoupper($nrorepet) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Pistas</td>
				<td width="150px">&nbsp;<?php echo ($nropistas)? strtoupper($nropistas) : '---' ;?></td>
				<td width="200px">&nbsp;No caras</td>
				<td width="150px">&nbsp;<?php echo ($ncaras_imp)? strtoupper($ncaras_imp) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ancho<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho_impresion)? strtoupper($ancho_impresion) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia ancho</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_ancho_impresion_ms)? strtoupper($tole_ancho_impresion_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_impresion_mn)? strtoupper($tole_ancho_impresion_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Largo<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($largo_impresion)? strtoupper($largo_impresion) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia largo</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_largo_impresion_ms)? strtoupper($tole_largo_impresion_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_largo_impresion_mn)? strtoupper($tole_largo_impresion_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Otros productos</td>
				<td colspan="3">&nbsp;<?php echo ($other)? strtoupper($other) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Fotocelda al lado</td>
				<td width="150px">&nbsp;<?php echo ($fotoc_lado)? strtoupper($fotoc_lado) : '---' ;?></td>
				<td width="200px">&nbsp;Tipo de impresion</td>
				<td width="150px">&nbsp;<?php echo ($tipo_impresion)? strtoupper($tipo_impresion) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ancho Fotocelda&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho_fotoc)? strtoupper($ancho_fotoc) : '---' ;?></td>
				<td width="200px">&nbsp;Largo Fotocelda&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($largo_fotoc)? strtoupper($largo_fotoc) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Dist. Fotocelda al borde&nbsp;<b>(mm)</b></td>
				<td colspan="3">&nbsp;<?php echo ($dfotoc_borde)? strtoupper($dfotoc_borde) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Color Fotocelda&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($color_fotoc)? strtoupper($color_fotoc) : '---' ; ?></td>
				<td width="200px">&nbsp;Codigo SAP&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($codigosap)? strtoupper($codigosap) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tintas resistentes a&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tintasa)? strtoupper($tintasa) : '---' ;?></td>
			<tr>
				<td width="200px">&nbsp;Tintas especiales a&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tinta_espe)? strtoupper($tinta_espe) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Version del arte&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($version_arte)? strtoupper($version_arte) : '---' ;?></td>
			</tr>
			<tr>
				<td colspan="4" align="left">&nbsp;<b>TEXTOS LEGALES</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Codigo de barras&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($cod_barras)? strtoupper($cod_barras) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Color fondo barras&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($color_fondo_barras)? strtoupper($color_fondo_barras) : '---' ; ?></td>
				<td width="200px">&nbsp;Color barras&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($color_barras)? strtoupper($color_barras) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Observaciones&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($note_product)? strtoupper($note_product) : '---' ; ?></td>
			</tr>
			<?php if($arrdispensing) $arrObject = explode(':|:',$arrdispensing);?>
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>CUADRO DE TINTAS # <?php echo count($arrObject); ?></b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;COLOR PANTONE&nbsp;</td>
				<td width="150px">&nbsp;CODIGO PLASTICEL&nbsp;</td>
				<td width="200px">&nbsp;ANILOX&nbsp;</td>
				<td width="150px">&nbsp;GRUPO&nbsp;</td>
			</tr>
			<?php 
				if($arrdispensing)
				{
					unset($arrObject);
					$arrObject = explode(':|:',$arrdispensing);
					for($a = 0; $a < count($arrObject); $a++)
					{
						$arrRow = explode(':-:',$arrObject[$a]);
						//variables a usar
						$obj_anilox = 'anilox_'.$arrRow[1];
						$obj_grupo = 'grupo_'.$arrRow[1];
						$rwFormula = loadrecordformula($arrRow[1],$idcon)
 			?>
 			<tr>
 				<td width="200px">&nbsp;<?php echo ($rwFormula['formulnombre'])? strtoupper($rwFormula['formulnombre']) : '---' ; ?></td>
 				<td width="150px">&nbsp;<?php echo ($rwFormula['formulnumero'])? strtoupper($rwFormula['formulnumero']) : '---' ; ?></td>
 				<td width="200px">&nbsp;<?php echo ($$obj_anilox)? $$obj_anilox : '---' ; ?></td>
 				<td width="150px">&nbsp;<?php echo ($$obj_grupo)? $$obj_grupo : '---' ; ?></td>
 			</tr>
 			<?php 
					}
				}					
			?>
			<tr>
				<td width="200px">&nbsp;Papel pouch&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($papel_pouch_imp)? strtoupper($papel_pouch_imp) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($papel_pouch_imp == 'si') {echo 'block';}else{echo 'none';} ?>">Impreso por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($papel_pouch_imp == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($papel_pouch_imppor)? strtoupper($papel_pouch_imppor) : '---' ; ?></span></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Foil&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($foil_imp)? strtoupper($foil_imp) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($foil_imp == 'si') {echo 'block';}else{echo 'none';} ?>">Impreso por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($foil_imp == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($foil_imppor)? strtoupper($foil_imppor) : '---' ; ?></span></td>
			</tr>
			<tr>
				<td colspan="4" align="center">&nbsp;<b>EMBOBINADO FINAL</b></td>
			</tr>
			<tr>
				<td colspan="4" align="center"><img src="../img/pics_embobinados/<?php if(!$embobinado_icon){echo 'no_image.jpg';}else{echo $embobinado_icon;}?>"></img></td>
			</tr>		
		</table>
		<!-- 	FIN DATOS IMPRESION -->
		
		
		
		<!-- 	DATOS ESTRUCTURA PRODUCTO Y/O LAMINACION -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>ESTRUCTURA PRODUCTO Y/O LAMINACION</b></td>
			</tr>
			<tr>
				<td width="400px">&nbsp;Material</td>
				<td width="100px">&nbsp;Color</td>
				<td width="100px">&nbsp;Calibre</td>
				<td width="100px">&nbsp;Gramaje</td>
			</tr>
			<?php 
				if($arrtabla1)
				{
					$array_tmp = explode(':|:',$arrtabla1);
					for($a = 0; $a < count($array_tmp); $a++)
					{
						$rwArray_tmp = explode(':-:', $array_tmp[$a]);
						$rwArray_tmp_adh = explode(',',$rwArray_tmp[4]);
						$rwPadreitem = loadrecordpadreitem($rwArray_tmp[1],$idcon);
						if($rwPadreitem['paditeconfig'] != 1)
						{
							$tipo_material_ = ($tipo_material_)? $tipo_material_.' / '.$rwPadreitem['paditenombre'] : $rwPadreitem['paditenombre'] ;
						}
 			?>
 			<tr>
 				<td width="400px">&nbsp;<?php echo ($rwPadreitem['paditenombre'])? strtoupper($rwPadreitem['paditenombre']) : '---' ; ?>&nbsp;<?php if($rwArray_tmp_adh[1]){ echo ($rwArray_tmp_adh[1])? '|&nbsp;Desempe&ntilde;o ('.$rwArray_tmp_adh[1].')' : '-------' ;}?>&nbsp;<?php if($rwArray_tmp_adh[2]){echo ($rwArray_tmp_adh[2])? '|&nbsp;Tipo ('.$rwArray_tmp_adh[2].')' : '-------' ;}?></td>
				<td width="100px">&nbsp;<?php echo ($$objColor)? strtoupper($$objColor) : '---' ;?></td>
				<td width="100px">&nbsp;<?php echo ($rwArray_tmp[3])? $rwArray_tmp[3] : '---' ;?></td>
				<td width="100px">&nbsp;<?php echo ($rwArray_tmp[3] * $rwArray_tmp[2]) ?></td>
 			</tr>
 			<?php 
						
	 				}
 				}
 			?>
 			<tr>
 				<td width="400px">&nbsp;</td>
				<td width="100px">&nbsp;</td>
				<td width="100px">&nbsp;<?php echo ($total_calibre)? strtoupper($total_calibre) : '---' ;?></td>
				<td width="100px">&nbsp;<?php echo ($total_gramaje)? strtoupper($total_gramaje) : '---' ;?></td>
 			</tr>
 			<tr>
 				<td width="400px">&nbsp;</td>
				<td width="100px">&nbsp;</td>
				<td width="100px">&nbsp;<b>+</b><?php echo ($tole_calib_ms)? strtoupper($tole_calib_ms) : '**' ; ?>&nbsp;<b>-</b><?php echo ($tole_calib_ms)? strtoupper($tole_calib_ms) : '**' ;?>&nbsp;</td>
				<td width="100px">&nbsp;<b>+</b><?php echo ($tole_grama_mn)? strtoupper($tole_grama_mn) : '**' ; ?>&nbsp;<b>-</b><?php echo ($tole_calib_ms)? strtoupper($tole_calib_ms) : '**' ;?>&nbsp;</td>
 			</tr>
 		</table>
 		<table border="0" class="tabla">
 			<tr>
				<td width="200px">&nbsp;Papel pouch&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($papel_pouch_lam)? strtoupper($papel_pouch_lam) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($papel_pouch_lam == 'si') {echo 'block';}else{echo 'none';} ?>">Laminado por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($papel_pouch_lam == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($papel_pouch_lampor)? strtoupper($papel_pouch_lampor) : '---' ; ?></span></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Foil&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($foil_lam)? strtoupper($foil_lam) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($foil_lam == 'si') {echo 'block';}else{echo 'none';} ?>">Laminado por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($foil_lam == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($foil_lampor)? strtoupper($foil_lampor) : '---' ; ?></span></td>
			</tr>
		</table>
		<!-- 	FIN DATOS ESTRUCTURA PRODUCTO Y/O LAMINACION -->
		
		
		
		
		<!-- 	DATOS SELLADO -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>SELLADO</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Producto&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tipoproducto)? strtoupper($tipoproducto) : '---' ; ?></td>
			</tr>
			<tr>
				<td colspan="4" align="center">&nbsp;<b>MEDIDAS DEL PRODUCTO</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ancho&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho)? strtoupper($ancho) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia ancho&nbsp;</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_ancho_ms)? strtoupper($tole_ancho_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_mn)? strtoupper($tole_ancho_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Largo&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($largo)? strtoupper($largo) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia largo&nbsp;</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_largo_ms)? strtoupper($tole_largo_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_mn)? strtoupper($tole_ancho_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo sellado&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_sellado)? strtoupper($tipo_sellado) : '---' ; ?></td>
				<td width="200px">&nbsp;Forma sellado&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($forma_sellado)? strtoupper($forma_sellado) : '---' ; ?></td>
			</tr>	
			<tr>
				<td width="200px">&nbsp;Ancho de selle&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($aselle_bolsa)? strtoupper($aselle_bolsa) : '---' ; ?></td>
				<td width="200px">&nbsp;Impresion&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_impresion)? strtoupper($tipo_impresion) : '---' ; ?></td>
			</tr>	
			<tr>
				<td width="200px">&nbsp;Peso millar&nbsp;<b>(kg/millar)</b></td>
				<td width="150px">&nbsp;<?php echo round((((double) $solapa / 1000) + ((double) $largo / 1000 * 2) + ((double)  $solapa / 1000 * 2) + ((double)  $fuelle / 1000 * 2)) * (((double)  $ancho / 1000) * ((double) $total_gramaje)) * 100 ) / 100 ?></td>
				<td width="200px">&nbsp;Maquina&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($maquina)? strtoupper($maquina) : '---' ; ?></td>
			</tr>	
			<tr>
				<td width="200px">&nbsp;Fuelle&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($fuelle)? strtoupper($fuelle) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia fuelle&nbsp;</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_fuelle_ms)? strtoupper($tole_fuelle_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_fuelle_mn)? strtoupper($tole_fuelle_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Solapa&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($solapa)? strtoupper($solapa) : '---' ; ?></td>
				<td width="200px">&nbsp;No caras impresas&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ncaras_imp)? strtoupper($ncaras_imp) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Dist. precalentadores&nbsp;<b>(mm)</b></td>
				<td colspan="3">&nbsp;<?php echo ($dist_precalentadores)? strtoupper($dist_precalentadores) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Codigo valvula&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($cod_valve)? strtoupper($cod_valve) : '---' ; ?></td>
				<td width="200px">&nbsp;Referencia valvula&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($valve_item)? strtoupper($valve_item) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Troquel&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($troquel)? strtoupper($troquel) : '---' ; ?></td>
				<td width="200px">&nbsp;Tipo de troquel&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_troquel)? strtoupper($tipo_troquel) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;LLenado&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_llenado)? strtoupper($tipo_llenado) : '---' ; ?></td>
				<td width="200px">&nbsp;Wicket&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($wicket)? strtoupper($wicket) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Observaciones</td>
				<td colspan="3">&nbsp;<?php echo ($note_sellado)? strtoupper($note_sellado) : '---' ; ?></td>
			</tr>
		</table>
		<!-- 	FIN DATOS SELLADO -->
		
		
		
		<!-- 	DATOS MICRO -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>MICRO</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo material&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tipo_estruc)? strtoupper($tipo_estruc) : '---' ; ?>&nbsp;<?php echo ($tipo_material_) ? strtoupper($tipo_material_) : '' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Calibre&nbsp;<b>(&micro;m)</b></td>
				<td colspan="3">&nbsp;<?php echo ($total_calibre)? strtoupper($total_calibre) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ancho<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho_impresion)? strtoupper($ancho_impresion) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia ancho</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_ancho_impresion_ms)? strtoupper($tole_ancho_impresion_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_impresion_mn)? strtoupper($tole_ancho_impresion_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo microperforacion&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($mcr_tipo_perforacion)? strtoupper($mcr_tipo_perforacion) : '---' ; ?></td>
				<td width="200px">&nbsp;Cant. caras microperforadas&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($mrc_cant_cara_microper)? strtoupper($mrc_cant_cara_microper) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Observaciones</td>
				<td colspan="3">&nbsp;<?php echo ($note_micro)? strtoupper($note_micro) : '---' ; ?></td>
			</tr>
		</table>
		<!-- 	FIN DATOS MICRO -->
		
		
		
		
		
		<!-- 	DATOS DOBLADO -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>DOBLADO</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo material&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tipo_estruc)? strtoupper($tipo_estruc) : '---' ; ?>&nbsp;<?php echo ($tipo_material_) ? strtoupper($tipo_material_) : '' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Calibre&nbsp;<b>(&micro;m)</b></td>
				<td colspan="3">&nbsp;<?php echo ($total_calibre)? strtoupper($total_calibre) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Observaciones</td>
				<td colspan="3">&nbsp;<?php echo ($note_doblado)? strtoupper($note_doblado) : '---' ; ?></td>
			</tr>
		</table>
		<!-- 	FIN DATOS DOBLADO -->
		<?php }?>
		<!--	**************************************************************	-->
		<!--	FIN FICHA TECNICA DE BOLSA LATERAL	-->
		<!--	**************************************************************	-->
		
		
		
		
		
		
		
			
		<!--	**************************************************************	-->
		<!--	FICHA TECNICA DE POUCH DOY PACK	-->
		<!--	**************************************************************	-->
		<?php if($tipitecodigo == 3){?>
		
		<!-- 	DATOS IMPRESION -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>IMPRESION</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Material a imprimir</td>
				<td colspan="3">&nbsp;<?php echo ($product_imp_nomb)? strtoupper($product_imp_nomb) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Rodillo</td>
				<td width="150px">&nbsp;<?php echo ($rodillo)? strtoupper($rodillo) : '---' ;?></td>
				<td width="200px">&nbsp;Repeticiones</td>
				<td width="150px">&nbsp;<?php echo ($nrorepet)? strtoupper($nrorepet) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Pistas</td>
				<td width="150px">&nbsp;<?php echo ($nropistas)? strtoupper($nropistas) : '---' ;?></td>
				<td width="200px">&nbsp;No caras</td>
				<td width="150px">&nbsp;<?php echo ($ncaras_imp)? strtoupper($ncaras_imp) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ancho<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho_impresion)? strtoupper($ancho_impresion) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia ancho</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_ancho_impresion_ms)? strtoupper($tole_ancho_impresion_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_impresion_mn)? strtoupper($tole_ancho_impresion_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Largo<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($largo_impresion)? strtoupper($largo_impresion) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia largo</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_largo_impresion_ms)? strtoupper($tole_largo_impresion_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_largo_impresion_mn)? strtoupper($tole_largo_impresion_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Otros productos</td>
				<td colspan="3">&nbsp;<?php echo ($other)? strtoupper($other) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Fotocelda al lado</td>
				<td width="150px">&nbsp;<?php echo ($fotoc_lado)? strtoupper($fotoc_lado) : '---' ;?></td>
				<td width="200px">&nbsp;Tipo de impresion</td>
				<td width="150px">&nbsp;<?php echo ($tipo_impresion)? strtoupper($tipo_impresion) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ancho Fotocelda&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho_fotoc)? strtoupper($ancho_fotoc) : '---' ;?></td>
				<td width="200px">&nbsp;Largo Fotocelda&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($largo_fotoc)? strtoupper($largo_fotoc) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Dist. Fotocelda al borde&nbsp;<b>(mm)</b></td>
				<td colspan="3">&nbsp;<?php echo ($dfotoc_borde)? strtoupper($dfotoc_borde) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Color Fotocelda&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($color_fotoc)? strtoupper($color_fotoc) : '---' ; ?></td>
				<td width="200px">&nbsp;Codigo SAP&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($codigosap)? strtoupper($codigosap) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tintas resistentes a&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tintasa)? strtoupper($tintasa) : '---' ;?></td>
			<tr>
				<td width="200px">&nbsp;Tintas especiales a&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tinta_espe)? strtoupper($tinta_espe) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Version del arte&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($version_arte)? strtoupper($version_arte) : '---' ;?></td>
			</tr>
			<tr>
				<td colspan="4" align="left">&nbsp;<b>TEXTOS LEGALES</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Codigo de barras&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($cod_barras)? strtoupper($cod_barras) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Color fondo barras&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($color_fondo_barras)? strtoupper($color_fondo_barras) : '---' ; ?></td>
				<td width="200px">&nbsp;Color barras&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($color_barras)? strtoupper($color_barras) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Observaciones&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($note_product)? strtoupper($note_product) : '---' ; ?></td>
			</tr>
			<?php if($arrdispensing) $arrObject = explode(':|:',$arrdispensing);?>
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>CUADRO DE TINTAS # <?php echo count($arrObject); ?></b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;COLOR PANTONE&nbsp;</td>
				<td width="150px">&nbsp;CODIGO PLASTICEL&nbsp;</td>
				<td width="200px">&nbsp;ANILOX&nbsp;</td>
				<td width="150px">&nbsp;GRUPO&nbsp;</td>
			</tr>
			<?php 
				if($arrdispensing)
				{
					unset($arrObject);
					$arrObject = explode(':|:',$arrdispensing);
					for($a = 0; $a < count($arrObject); $a++)
					{
						$arrRow = explode(':-:',$arrObject[$a]);
						//variables a usar
						$obj_anilox = 'anilox_'.$arrRow[1];
						$obj_grupo = 'grupo_'.$arrRow[1];
						$rwFormula = loadrecordformula($arrRow[1],$idcon)
 			?>
 			<tr>
 				<td width="200px">&nbsp;<?php echo ($rwFormula['formulnombre'])? strtoupper($rwFormula['formulnombre']) : '---' ; ?></td>
 				<td width="150px">&nbsp;<?php echo ($rwFormula['formulnumero'])? strtoupper($rwFormula['formulnumero']) : '---' ; ?></td>
 				<td width="200px">&nbsp;<?php echo ($$obj_anilox)? $$obj_anilox : '---' ; ?></td>
 				<td width="150px">&nbsp;<?php echo ($$obj_grupo)? $$obj_grupo : '---' ; ?></td>
 			</tr>
 			<?php 
					}
				}					
			?>
			<tr>
				<td width="200px">&nbsp;Papel pouch&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($papel_pouch_imp)? strtoupper($papel_pouch_imp) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($papel_pouch_imp == 'si') {echo 'block';}else{echo 'none';} ?>">Impreso por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($papel_pouch_imp == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($papel_pouch_imppor)? strtoupper($papel_pouch_imppor) : '---' ; ?></span></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Foil&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($foil_imp)? strtoupper($foil_imp) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($foil_imp == 'si') {echo 'block';}else{echo 'none';} ?>">Impreso por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($foil_imp == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($foil_imppor)? strtoupper($foil_imppor) : '---' ; ?></span></td>
			</tr>
			<tr>
				<td colspan="4" align="center">&nbsp;<b>EMBOBINADO FINAL</b></td>
			</tr>
			<tr>
				<td colspan="4" align="center"><img src="../img/pics_embobinados/<?php if(!$embobinado_icon){echo 'no_image.jpg';}else{echo $embobinado_icon;}?>"></img></td>
			</tr>		
		</table>
		<!-- 	FIN DATOS IMPRESION -->
		
		
		
		<!-- 	DATOS ESTRUCTURA PRODUCTO Y/O LAMINACION -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>ESTRUCTURA PRODUCTO Y/O LAMINACION</b></td>
			</tr>
			<tr>
				<td width="400px">&nbsp;Material</td>
				<td width="100px">&nbsp;Color</td>
				<td width="100px">&nbsp;Calibre</td>
				<td width="100px">&nbsp;Gramaje</td>
			</tr>
			<?php 
				if($arrtabla1)
				{
					$array_tmp = explode(':|:',$arrtabla1);
					for($a = 0; $a < count($array_tmp); $a++)
					{
						$rwArray_tmp = explode(':-:', $array_tmp[$a]);
						$rwArray_tmp_adh = explode(',',$rwArray_tmp[4]);
						$rwPadreitem = loadrecordpadreitem($rwArray_tmp[1],$idcon);
						if($rwPadreitem['paditeconfig'] != 1)
						{
							$tipo_material_ = ($tipo_material_)? $tipo_material_.' / '.$rwPadreitem['paditenombre'] : $rwPadreitem['paditenombre'] ;
						}
 			?>
 			<tr>
 				<td width="400px">&nbsp;<?php echo ($rwPadreitem['paditenombre'])? strtoupper($rwPadreitem['paditenombre']) : '---' ; ?>&nbsp;<?php if($rwArray_tmp_adh[1]){ echo ($rwArray_tmp_adh[1])? '|&nbsp;Desempe&ntilde;o ('.$rwArray_tmp_adh[1].')' : '-------' ;}?>&nbsp;<?php if($rwArray_tmp_adh[2]){echo ($rwArray_tmp_adh[2])? '|&nbsp;Tipo ('.$rwArray_tmp_adh[2].')' : '-------' ;}?></td>
				<td width="100px">&nbsp;<?php echo ($$objColor)? strtoupper($$objColor) : '---' ;?></td>
				<td width="100px">&nbsp;<?php echo ($rwArray_tmp[3])? $rwArray_tmp[3] : '---' ;?></td>
				<td width="100px">&nbsp;<?php echo ($rwArray_tmp[3] * $rwArray_tmp[2]) ?></td>
 			</tr>
 			<?php 
						
	 				}
 				}
 			?>
 			<tr>
 				<td width="400px">&nbsp;</td>
				<td width="100px">&nbsp;</td>
				<td width="100px">&nbsp;<?php echo ($total_calibre)? strtoupper($total_calibre) : '---' ;?></td>
				<td width="100px">&nbsp;<?php echo ($total_gramaje)? strtoupper($total_gramaje) : '---' ;?></td>
 			</tr>
 			<tr>
 				<td width="400px">&nbsp;</td>
				<td width="100px">&nbsp;</td>
				<td width="100px">&nbsp;<b>+</b><?php echo ($tole_calib_ms)? strtoupper($tole_calib_ms) : '**' ; ?>&nbsp;<b>-</b><?php echo ($tole_calib_ms)? strtoupper($tole_calib_ms) : '**' ;?>&nbsp;</td>
				<td width="100px">&nbsp;<b>+</b><?php echo ($tole_grama_mn)? strtoupper($tole_grama_mn) : '**' ; ?>&nbsp;<b>-</b><?php echo ($tole_calib_ms)? strtoupper($tole_calib_ms) : '**' ;?>&nbsp;</td>
 			</tr>
 		</table>
 		<table border="0" class="tabla">
 			<tr>
				<td width="200px">&nbsp;Papel pouch&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($papel_pouch_lam)? strtoupper($papel_pouch_lam) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($papel_pouch_lam == 'si') {echo 'block';}else{echo 'none';} ?>">Laminado por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($papel_pouch_lam == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($papel_pouch_lampor)? strtoupper($papel_pouch_lampor) : '---' ; ?></span></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Foil&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($foil_lam)? strtoupper($foil_lam) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($foil_lam == 'si') {echo 'block';}else{echo 'none';} ?>">Laminado por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($foil_lam == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($foil_lampor)? strtoupper($foil_lampor) : '---' ; ?></span></td>
			</tr>
		</table>
		<!-- 	FIN DATOS ESTRUCTURA PRODUCTO Y/O LAMINACION -->
		
		
		<!-- 	DATOS SELLADO -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>SELLADO</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Producto&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tipoproducto)? strtoupper($tipoproducto) : '---' ; ?></td>
			</tr>
			<tr>
				<td colspan="4" align="center">&nbsp;<b>MEDIDAS DEL PRODUCTO</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ancho&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho)? strtoupper($ancho) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia ancho&nbsp;</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_ancho_ms)? strtoupper($tole_ancho_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_mn)? strtoupper($tole_ancho_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Largo&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($largo)? strtoupper($largo) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia largo&nbsp;</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_largo_ms)? strtoupper($tole_largo_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_mn)? strtoupper($tole_ancho_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo sellado&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_sellado)? strtoupper($tipo_sellado) : '---' ; ?></td>
				<td width="200px">&nbsp;Forma sellado&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($forma_sellado)? strtoupper($forma_sellado) : '---' ; ?></td>
			</tr>	
			<tr>
				<td width="200px">&nbsp;Ancho de selle&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($aselle_bolsa)? strtoupper($aselle_bolsa) : '---' ; ?></td>
				<td width="200px">&nbsp;Impresion&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_impresion)? strtoupper($tipo_impresion) : '---' ; ?></td>
			</tr>	
			<tr>
				<td width="200px">&nbsp;Peso millar&nbsp;<b>(kg/millar)</b></td>
				<td width="150px">&nbsp;<?php echo round((((double) $solapa / 1000) + ((double) $largo / 1000 * 2) + ((double)  $solapa / 1000 * 2) + ((double)  $fuelle / 1000 * 2)) * (((double)  $ancho / 1000) * ((double) $total_gramaje)) * 100 ) / 100 ?></td>
				<td width="200px">&nbsp;Maquina&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($maquina)? strtoupper($maquina) : '---' ; ?></td>
			</tr>	
			<tr>
				<td width="200px">&nbsp;Fuelle&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($fuelle)? strtoupper($fuelle) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia fuelle&nbsp;</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_fuelle_ms)? strtoupper($tole_fuelle_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_fuelle_mn)? strtoupper($tole_fuelle_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Dist. precalentadores&nbsp;<b>(mm)</b></td>
				<td colspan="3">&nbsp;<?php echo ($dist_precalentadores)? strtoupper($dist_precalentadores) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Codigo valvula&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($cod_valve)? strtoupper($cod_valve) : '---' ; ?></td>
				<td width="200px">&nbsp;Referencia valvula&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($valve_item)? strtoupper($valve_item) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Troquel&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($troquel)? strtoupper($troquel) : '---' ; ?></td>
				<td width="200px">&nbsp;Tipo de troquel&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_troquel)? strtoupper($tipo_troquel) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Llenado&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_llenado)? strtoupper($tipo_llenado) : '---' ; ?></td>
				<td width="200px">&nbsp;Tipo de selle&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_selle)? strtoupper($tipo_selle) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;No sellos&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($sellos)? strtoupper($sellos) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo de cierre&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_cierre)? strtoupper($tipo_cierre) : '---' ; ?></td>
				<td width="200px">&nbsp;Dist. de cierre al borde&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($dist_cierre)? strtoupper($dist_cierre) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo de apertura&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_aper)? strtoupper($tipo_aper) : '---' ; ?></td>
				<td width="200px">&nbsp;Dist. de apertura al borde&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($dist_aper)? strtoupper($dist_aper) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Observaciones</td>
				<td colspan="3">&nbsp;<?php echo ($note_sellado)? strtoupper($note_sellado) : '---' ; ?></td>
			</tr>
		</table>
		<!-- 	FIN DATOS SELLADO -->
		
		
		
		<!-- 	DATOS MICRO -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>MICRO</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo material&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tipo_estruc)? strtoupper($tipo_estruc) : '---' ; ?>&nbsp;<?php echo ($tipo_material_) ? strtoupper($tipo_material_) : '' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Calibre&nbsp;<b>(&micro;m)</b></td>
				<td colspan="3">&nbsp;<?php echo ($total_calibre)? strtoupper($total_calibre) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ancho<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho_impresion)? strtoupper($ancho_impresion) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia ancho</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_ancho_impresion_ms)? strtoupper($tole_ancho_impresion_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_impresion_mn)? strtoupper($tole_ancho_impresion_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo microperforacion&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($mcr_tipo_perforacion)? strtoupper($mcr_tipo_perforacion) : '---' ; ?></td>
				<td width="200px">&nbsp;Cant. caras microperforadas&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($mrc_cant_cara_microper)? strtoupper($mrc_cant_cara_microper) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Observaciones</td>
				<td colspan="3">&nbsp;<?php echo ($note_micro)? strtoupper($note_micro) : '---' ; ?></td>
			</tr>
		</table>
		<!-- 	FIN DATOS MICRO -->
		
		
		
		
		
		<!-- 	DATOS DOBLADO -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>DOBLADO</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo material&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tipo_estruc)? strtoupper($tipo_estruc) : '---' ; ?>&nbsp;<?php echo ($tipo_material_) ? strtoupper($tipo_material_) : '' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Calibre&nbsp;<b>(&micro;m)</b></td>
				<td colspan="3">&nbsp;<?php echo ($total_calibre)? strtoupper($total_calibre) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Observaciones</td>
				<td colspan="3">&nbsp;<?php echo ($note_doblado)? strtoupper($note_doblado) : '---' ; ?></td>
			</tr>
		</table>
		<!-- 	FIN DATOS DOBLADO -->
		<?php }?>
		<!--	**************************************************************	-->
		<!--	FIN FICHA TECNICA DE POUCH DOY PACK	-->
		<!--	**************************************************************	-->
		
		
		
		
		
		
		
		
		
		
		
		<!--	**************************************************************	-->
		<!--	FICHA TECNICA DE POUCH  LATERAL	-->
		<!--	**************************************************************	-->
		<?php if($tipitecodigo == 4){?>
		
		<!-- 	DATOS IMPRESION -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>IMPRESION</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Material a imprimir</td>
				<td colspan="3">&nbsp;<?php echo ($product_imp_nomb)? strtoupper($product_imp_nomb) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Rodillo</td>
				<td width="150px">&nbsp;<?php echo ($rodillo)? strtoupper($rodillo) : '---' ;?></td>
				<td width="200px">&nbsp;Repeticiones</td>
				<td width="150px">&nbsp;<?php echo ($nrorepet)? strtoupper($nrorepet) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Pistas</td>
				<td width="150px">&nbsp;<?php echo ($nropistas)? strtoupper($nropistas) : '---' ;?></td>
				<td width="200px">&nbsp;No caras</td>
				<td width="150px">&nbsp;<?php echo ($ncaras_imp)? strtoupper($ncaras_imp) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ancho<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho_impresion)? strtoupper($ancho_impresion) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia ancho</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_ancho_impresion_ms)? strtoupper($tole_ancho_impresion_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_impresion_mn)? strtoupper($tole_ancho_impresion_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Largo<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($largo_impresion)? strtoupper($largo_impresion) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia largo</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_largo_impresion_ms)? strtoupper($tole_largo_impresion_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_largo_impresion_mn)? strtoupper($tole_largo_impresion_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Otros productos</td>
				<td colspan="3">&nbsp;<?php echo ($other)? strtoupper($other) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Fotocelda al lado</td>
				<td width="150px">&nbsp;<?php echo ($fotoc_lado)? strtoupper($fotoc_lado) : '---' ;?></td>
				<td width="200px">&nbsp;Tipo de impresion</td>
				<td width="150px">&nbsp;<?php echo ($tipo_impresion)? strtoupper($tipo_impresion) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ancho Fotocelda&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho_fotoc)? strtoupper($ancho_fotoc) : '---' ;?></td>
				<td width="200px">&nbsp;Largo Fotocelda&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($largo_fotoc)? strtoupper($largo_fotoc) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Dist. Fotocelda al borde&nbsp;<b>(mm)</b></td>
				<td colspan="3">&nbsp;<?php echo ($dfotoc_borde)? strtoupper($dfotoc_borde) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Color Fotocelda&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($color_fotoc)? strtoupper($color_fotoc) : '---' ; ?></td>
				<td width="200px">&nbsp;Codigo SAP&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($codigosap)? strtoupper($codigosap) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tintas resistentes a&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tintasa)? strtoupper($tintasa) : '---' ;?></td>
			<tr>
				<td width="200px">&nbsp;Tintas especiales a&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tinta_espe)? strtoupper($tinta_espe) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Version del arte&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($version_arte)? strtoupper($version_arte) : '---' ;?></td>
			</tr>
			<tr>
				<td colspan="4" align="left">&nbsp;<b>TEXTOS LEGALES</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Codigo de barras&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($cod_barras)? strtoupper($cod_barras) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Color fondo barras&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($color_fondo_barras)? strtoupper($color_fondo_barras) : '---' ; ?></td>
				<td width="200px">&nbsp;Color barras&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($color_barras)? strtoupper($color_barras) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Observaciones&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($note_product)? strtoupper($note_product) : '---' ; ?></td>
			</tr>
			<?php if($arrdispensing) $arrObject = explode(':|:',$arrdispensing);?>
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>CUADRO DE TINTAS # <?php echo count($arrObject); ?></b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;COLOR PANTONE&nbsp;</td>
				<td width="150px">&nbsp;CODIGO PLASTICEL&nbsp;</td>
				<td width="200px">&nbsp;ANILOX&nbsp;</td>
				<td width="150px">&nbsp;GRUPO&nbsp;</td>
			</tr>
			<?php 
				if($arrdispensing)
				{
					unset($arrObject);
					$arrObject = explode(':|:',$arrdispensing);
					for($a = 0; $a < count($arrObject); $a++)
					{
						$arrRow = explode(':-:',$arrObject[$a]);
						//variables a usar
						$obj_anilox = 'anilox_'.$arrRow[1];
						$obj_grupo = 'grupo_'.$arrRow[1];
						$rwFormula = loadrecordformula($arrRow[1],$idcon);
 			?>
 			<tr>
 				<td width="200px">&nbsp;<?php echo ($rwFormula['formulnombre'])? strtoupper($rwFormula['formulnombre']) : '---' ; ?></td>
 				<td width="150px">&nbsp;<?php echo ($rwFormula['formulnumero'])? strtoupper($rwFormula['formulnumero']) : '---' ; ?></td>
 				<td width="200px">&nbsp;<?php echo ($$obj_anilox)? $$obj_anilox : '---' ; ?></td>
 				<td width="150px">&nbsp;<?php echo ($$obj_grupo)? $$obj_grupo : '---' ; ?></td>
 			</tr>
 			<?php 
					}
				}					
			?>
			<tr>
				<td width="200px">&nbsp;Papel pouch&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($papel_pouch_imp)? strtoupper($papel_pouch_imp) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($papel_pouch_imp == 'si') {echo 'block';}else{echo 'none';} ?>">Impreso por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($papel_pouch_imp == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($papel_pouch_imppor)? strtoupper($papel_pouch_imppor) : '---' ; ?></span></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Foil&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($foil_imp)? strtoupper($foil_imp) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($foil_imp == 'si') {echo 'block';}else{echo 'none';} ?>">Impreso por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($foil_imp == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($foil_imppor)? strtoupper($foil_imppor) : '---' ; ?></span></td>
			</tr>
			<tr>
				<td colspan="4" align="center">&nbsp;<b>EMBOBINADO FINAL</b></td>
			</tr>
			<tr>
				<td colspan="4" align="center"><img src="../img/pics_embobinados/<?php if(!$embobinado_icon){echo 'no_image.jpg';}else{echo $embobinado_icon;}?>"></img></td>
			</tr>		
		</table>
		<!-- 	FIN DATOS IMPRESION -->
		
		
		
		<!-- 	DATOS ESTRUCTURA PRODUCTO Y/O LAMINACION -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>ESTRUCTURA PRODUCTO Y/O LAMINACION</b></td>
			</tr>
			<tr>
				<td width="400px">&nbsp;Material</td>
				<td width="100px">&nbsp;Color</td>
				<td width="100px">&nbsp;Calibre</td>
				<td width="100px">&nbsp;Gramaje</td>
			</tr>
			<?php 
				if($arrtabla1)
				{
					$array_tmp = explode(':|:',$arrtabla1);
					for($a = 0; $a < count($array_tmp); $a++)
					{
						$rwArray_tmp = explode(':-:', $array_tmp[$a]);
						$rwArray_tmp_adh = explode(',',$rwArray_tmp[4]);
						$rwPadreitem = loadrecordpadreitem($rwArray_tmp[1],$idcon);
						if($rwPadreitem['paditeconfig'] != 1)
						{
							$tipo_material_ = ($tipo_material_)? $tipo_material_.' / '.$rwPadreitem['paditenombre'] : $rwPadreitem['paditenombre'] ;
						}
 			?>
 			<tr>
 				<td width="400px">&nbsp;<?php echo ($rwPadreitem['paditenombre'])? strtoupper($rwPadreitem['paditenombre']) : '---' ; ?>&nbsp;<?php if($rwArray_tmp_adh[1]){ echo ($rwArray_tmp_adh[1])? '|&nbsp;Desempe&ntilde;o ('.$rwArray_tmp_adh[1].')' : '-------' ;}?>&nbsp;<?php if($rwArray_tmp_adh[2]){echo ($rwArray_tmp_adh[2])? '|&nbsp;Tipo ('.$rwArray_tmp_adh[2].')' : '-------' ;}?></td>
				<td width="100px">&nbsp;<?php echo ($$objColor)? strtoupper($$objColor) : '---' ;?></td>
				<td width="100px">&nbsp;<?php echo ($rwArray_tmp[3])? $rwArray_tmp[3] : '---' ;?></td>
				<td width="100px">&nbsp;<?php echo ($rwArray_tmp[3] * $rwArray_tmp[2]) ?></td>
 			</tr>
 			<?php 
						
	 				}
 				}
 			?>
 			<tr>
 				<td width="400px">&nbsp;</td>
				<td width="100px">&nbsp;</td>
				<td width="100px">&nbsp;<?php echo ($total_calibre)? strtoupper($total_calibre) : '---' ;?></td>
				<td width="100px">&nbsp;<?php echo ($total_gramaje)? strtoupper($total_gramaje) : '---' ;?></td>
 			</tr>
 			<tr>
 				<td width="400px">&nbsp;</td>
				<td width="100px">&nbsp;</td>
				<td width="100px">&nbsp;<b>+</b><?php echo ($tole_calib_ms)? strtoupper($tole_calib_ms) : '**' ; ?>&nbsp;<b>-</b><?php echo ($tole_calib_ms)? strtoupper($tole_calib_ms) : '**' ;?>&nbsp;</td>
				<td width="100px">&nbsp;<b>+</b><?php echo ($tole_grama_mn)? strtoupper($tole_grama_mn) : '**' ; ?>&nbsp;<b>-</b><?php echo ($tole_calib_ms)? strtoupper($tole_calib_ms) : '**' ;?>&nbsp;</td>
 			</tr>
 		</table>
 		<table border="0" class="tabla">
 			<tr>
				<td width="200px">&nbsp;Papel pouch&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($papel_pouch_lam)? strtoupper($papel_pouch_lam) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($papel_pouch_lam == 'si') {echo 'block';}else{echo 'none';} ?>">Laminado por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($papel_pouch_lam == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($papel_pouch_lampor)? strtoupper($papel_pouch_lampor) : '---' ; ?></span></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Foil&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($foil_lam)? strtoupper($foil_lam) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($foil_lam == 'si') {echo 'block';}else{echo 'none';} ?>">Laminado por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($foil_lam == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($foil_lampor)? strtoupper($foil_lampor) : '---' ; ?></span></td>
			</tr>
		</table>
		<!-- 	FIN DATOS ESTRUCTURA PRODUCTO Y/O LAMINACION -->
		
		
		<!-- 	DATOS SELLADO -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>SELLADO</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Producto&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tipoproducto)? strtoupper($tipoproducto) : '---' ; ?></td>
			</tr>
			<tr>
				<td colspan="4" align="center">&nbsp;<b>MEDIDAS DEL PRODUCTO</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ancho&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho)? strtoupper($ancho) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia ancho&nbsp;</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_ancho_ms)? strtoupper($tole_ancho_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_mn)? strtoupper($tole_ancho_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Largo&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($largo)? strtoupper($largo) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia largo&nbsp;</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_largo_ms)? strtoupper($tole_largo_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_mn)? strtoupper($tole_ancho_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo sellado&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_sellado)? strtoupper($tipo_sellado) : '---' ; ?></td>
				<td width="200px">&nbsp;Forma sellado&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($forma_sellado)? strtoupper($forma_sellado) : '---' ; ?></td>
			</tr>	
			<tr>
				<td width="200px">&nbsp;Ancho de selle&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($aselle_bolsa)? strtoupper($aselle_bolsa) : '---' ; ?></td>
				<td width="200px">&nbsp;Impresion&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_impresion)? strtoupper($tipo_impresion) : '---' ; ?></td>
			</tr>	
			<tr>
				<td width="200px">&nbsp;Peso millar&nbsp;<b>(kg/millar)</b></td>
				<td width="150px">&nbsp;<?php echo round((((double) $solapa / 1000) + ((double) $largo / 1000 * 2) + ((double)  $solapa / 1000 * 2) + ((double)  $fuelle / 1000 * 2)) * (((double)  $ancho / 1000) * ((double) $total_gramaje)) * 100 ) / 100 ?></td>
				<td width="200px">&nbsp;Maquina&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($maquina)? strtoupper($maquina) : '---' ; ?></td>
			</tr>	
			<tr>
				<td width="200px">&nbsp;Dist. precalentadores&nbsp;<b>(mm)</b></td>
				<td colspan="3">&nbsp;<?php echo ($dist_precalentadores)? strtoupper($dist_precalentadores) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Codigo valvula&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($cod_valve)? strtoupper($cod_valve) : '---' ; ?></td>
				<td width="200px">&nbsp;Referencia valvula&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($valve_item)? strtoupper($valve_item) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Troquel&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($troquel)? strtoupper($troquel) : '---' ; ?></td>
				<td width="200px">&nbsp;Tipo de troquel&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_troquel)? strtoupper($tipo_troquel) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Llenado&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_llenado)? strtoupper($tipo_llenado) : '---' ; ?></td>
				<td width="200px">&nbsp;Tipo de selle&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_selle)? strtoupper($tipo_selle) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;No sellos&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($sellos)? strtoupper($sellos) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ziper&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($ziper)? strtoupper($ziper) : '---' ; ?></td>
				<td width="200px">&nbsp;Dist. de ziper al borde&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($dist_ziper)? strtoupper($dist_ziper) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Muesca&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($muesca)? strtoupper($muesca) : '---' ; ?></td>
				<td width="200px">&nbsp;Dist. de muesca al borde&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($dist_muesca)? strtoupper($dist_muesca) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Precorte&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($precorte)? strtoupper($precorte) : '---' ; ?></td>
				<td width="200px">&nbsp;Dist. de precorte al borde&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($dist_precorte)? strtoupper($dist_precorte) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Observaciones</td>
				<td colspan="3">&nbsp;<?php echo ($note_sellado)? strtoupper($note_sellado) : '---' ; ?></td>
			</tr>
		</table>
		<!-- 	FIN DATOS SELLADO -->
		
		
		
		<!-- 	DATOS MICRO -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>MICRO</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo material&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tipo_estruc)? strtoupper($tipo_estruc) : '---' ; ?>&nbsp;<?php echo ($tipo_material_) ? strtoupper($tipo_material_) : '' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Calibre&nbsp;<b>(&micro;m)</b></td>
				<td colspan="3">&nbsp;<?php echo ($total_calibre)? strtoupper($total_calibre) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ancho<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho_impresion)? strtoupper($ancho_impresion) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia ancho</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_ancho_impresion_ms)? strtoupper($tole_ancho_impresion_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_impresion_mn)? strtoupper($tole_ancho_impresion_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo microperforacion&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($mcr_tipo_perforacion)? strtoupper($mcr_tipo_perforacion) : '---' ; ?></td>
				<td width="200px">&nbsp;Cant. caras microperforadas&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($mrc_cant_cara_microper)? strtoupper($mrc_cant_cara_microper) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Observaciones</td>
				<td colspan="3">&nbsp;<?php echo ($note_micro)? strtoupper($note_micro) : '---' ; ?></td>
			</tr>
		</table>
		<!-- 	FIN DATOS MICRO -->
		
		
		
		
		
		<!-- 	DATOS DOBLADO -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>DOBLADO</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo material&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tipo_estruc)? strtoupper($tipo_estruc) : '---' ; ?>&nbsp;<?php echo ($tipo_material_) ? strtoupper($tipo_material_) : '' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Calibre&nbsp;<b>(&micro;m)</b></td>
				<td colspan="3">&nbsp;<?php echo ($total_calibre)? strtoupper($total_calibre) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Observaciones</td>
				<td colspan="3">&nbsp;<?php echo ($note_doblado)? strtoupper($note_doblado) : '---' ; ?></td>
			</tr>
		</table>
		<!-- 	FIN DATOS DOBLADO -->
		<?php }?>
		<!--	**************************************************************	-->
		<!--	FIN FICHA TECNICA DE POUCH LATERAL	-->
		<!--	**************************************************************	-->
		
		
		
		
		
		
		
		
		
		<!--	**************************************************************	-->
		<!--	FICHA TECNICA DE CAPUCHON	-->
		<!--	**************************************************************	-->
		<?php if($tipitecodigo == 5){?>
		
		<!-- 	DATOS IMPRESION -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>IMPRESION</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Material a imprimir</td>
				<td colspan="3">&nbsp;<?php echo ($product_imp_nomb)? strtoupper($product_imp_nomb) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Rodillo</td>
				<td width="150px">&nbsp;<?php echo ($rodillo)? strtoupper($rodillo) : '---' ;?></td>
				<td width="200px">&nbsp;Repeticiones</td>
				<td width="150px">&nbsp;<?php echo ($nrorepet)? strtoupper($nrorepet) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Pistas</td>
				<td width="150px">&nbsp;<?php echo ($nropistas)? strtoupper($nropistas) : '---' ;?></td>
				<td width="200px">&nbsp;No caras</td>
				<td width="150px">&nbsp;<?php echo ($ncaras_imp)? strtoupper($ncaras_imp) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ancho<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho_impresion)? strtoupper($ancho_impresion) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia ancho</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_ancho_impresion_ms)? strtoupper($tole_ancho_impresion_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_impresion_mn)? strtoupper($tole_ancho_impresion_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Largo<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($largo_impresion)? strtoupper($largo_impresion) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia largo</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_largo_impresion_ms)? strtoupper($tole_largo_impresion_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_largo_impresion_mn)? strtoupper($tole_largo_impresion_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Otros productos</td>
				<td colspan="3">&nbsp;<?php echo ($other)? strtoupper($other) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Fotocelda al lado</td>
				<td width="150px">&nbsp;<?php echo ($fotoc_lado)? strtoupper($fotoc_lado) : '---' ;?></td>
				<td width="200px">&nbsp;Tipo de impresion</td>
				<td width="150px">&nbsp;<?php echo ($tipo_impresion)? strtoupper($tipo_impresion) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ancho Fotocelda&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho_fotoc)? strtoupper($ancho_fotoc) : '---' ;?></td>
				<td width="200px">&nbsp;Largo Fotocelda&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($largo_fotoc)? strtoupper($largo_fotoc) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Dist. Fotocelda al borde&nbsp;<b>(mm)</b></td>
				<td colspan="3">&nbsp;<?php echo ($dfotoc_borde)? strtoupper($dfotoc_borde) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Color Fotocelda&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($color_fotoc)? strtoupper($color_fotoc) : '---' ; ?></td>
				<td width="200px">&nbsp;Codigo SAP&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($codigosap)? strtoupper($codigosap) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tintas resistentes a&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tintasa)? strtoupper($tintasa) : '---' ;?></td>
			<tr>
				<td width="200px">&nbsp;Tintas especiales a&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tinta_espe)? strtoupper($tinta_espe) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Version del arte&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($version_arte)? strtoupper($version_arte) : '---' ;?></td>
			</tr>
			<tr>
				<td colspan="4" align="left">&nbsp;<b>TEXTOS LEGALES</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Codigo de barras&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($cod_barras)? strtoupper($cod_barras) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Color fondo barras&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($color_fondo_barras)? strtoupper($color_fondo_barras) : '---' ; ?></td>
				<td width="200px">&nbsp;Color barras&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($color_barras)? strtoupper($color_barras) : '---' ; ?></td>
			</tr>
			<?php if($arrdispensing) $arrObject = explode(':|:',$arrdispensing);?>
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>CUADRO DE TINTAS # <?php echo count($arrObject); ?></b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;COLOR PANTONE&nbsp;</td>
				<td width="150px">&nbsp;CODIGO PLASTICEL&nbsp;</td>
				<td width="200px">&nbsp;ANILOX&nbsp;</td>
				<td width="150px">&nbsp;GRUPO&nbsp;</td>
			</tr>
			<?php 
				if($arrdispensing)
				{
					unset($arrObject);
					$arrObject = explode(':|:',$arrdispensing);
					for($a = 0; $a < count($arrObject); $a++)
					{
						$arrRow = explode(':-:',$arrObject[$a]);
						//variables a usar
						$obj_anilox = 'anilox_'.$arrRow[1];
						$obj_grupo = 'grupo_'.$arrRow[1];
						$rwFormula = loadrecordformula($arrRow[1],$idcon)
 			?>
 			<tr>
 				<td width="200px">&nbsp;<?php echo ($rwFormula['formulnombre'])? strtoupper($rwFormula['formulnombre']) : '---' ; ?></td>
 				<td width="150px">&nbsp;<?php echo ($rwFormula['formulnumero'])? strtoupper($rwFormula['formulnumero']) : '---' ; ?></td>
 				<td width="200px">&nbsp;<?php echo ($$obj_anilox)? $$obj_anilox : '---' ; ?></td>
 				<td width="150px">&nbsp;<?php echo ($$obj_grupo)? $$obj_grupo : '---' ; ?></td>
 			</tr>
 			<?php 
					}
				}					
			?>
			<tr>
				<td width="200px">&nbsp;Papel pouch&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($papel_pouch_imp)? strtoupper($papel_pouch_imp) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($papel_pouch_imp == 'si') {echo 'block';}else{echo 'none';} ?>">Impreso por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($papel_pouch_imp == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($papel_pouch_imppor)? strtoupper($papel_pouch_imppor) : '---' ; ?></span></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Foil&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($foil_imp)? strtoupper($foil_imp) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($foil_imp == 'si') {echo 'block';}else{echo 'none';} ?>">Impreso por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($foil_imp == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($foil_imppor)? strtoupper($foil_imppor) : '---' ; ?></span></td>
			</tr>
			<tr>
				<td colspan="4" align="center">&nbsp;<b>EMBOBINADO FINAL</b></td>
			</tr>
			<tr>
				<td colspan="4" align="center"><img src="../img/pics_embobinados/<?php if(!$embobinado_icon){echo 'no_image.jpg';}else{echo $embobinado_icon;}?>"></img></td>
			</tr>		
		</table>
		<!-- 	FIN DATOS IMPRESION -->
		
		
		
		<!-- 	DATOS ESTRUCTURA PRODUCTO Y/O LAMINACION -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>ESTRUCTURA PRODUCTO Y/O LAMINACION</b></td>
			</tr>
			<tr>
				<td width="400px">&nbsp;Material</td>
				<td width="100px">&nbsp;Color</td>
				<td width="100px">&nbsp;Calibre</td>
				<td width="100px">&nbsp;Gramaje</td>
			</tr>
			<?php 
				if($arrtabla1)
				{
					$array_tmp = explode(':|:',$arrtabla1);
					for($a = 0; $a < count($array_tmp); $a++)
					{
						$rwArray_tmp = explode(':-:', $array_tmp[$a]);
						$rwArray_tmp_adh = explode(',',$rwArray_tmp[4]);
						$rwPadreitem = loadrecordpadreitem($rwArray_tmp[1],$idcon);
						if($rwPadreitem['paditeconfig'] != 1)
						{
							$tipo_material_ = ($tipo_material_)? $tipo_material_.' / '.$rwPadreitem['paditenombre'] : $rwPadreitem['paditenombre'] ;
						}
 			?>
 			<tr>
 				<td width="400px">&nbsp;<?php echo ($rwPadreitem['paditenombre'])? strtoupper($rwPadreitem['paditenombre']) : '---' ; ?>&nbsp;<?php if($rwArray_tmp_adh[1]){ echo ($rwArray_tmp_adh[1])? '|&nbsp;Desempe&ntilde;o ('.$rwArray_tmp_adh[1].')' : '-------' ;}?>&nbsp;<?php if($rwArray_tmp_adh[2]){echo ($rwArray_tmp_adh[2])? '|&nbsp;Tipo ('.$rwArray_tmp_adh[2].')' : '-------' ;}?></td>
				<td width="100px">&nbsp;<?php echo ($$objColor)? strtoupper($$objColor) : '---' ;?></td>
				<td width="100px">&nbsp;<?php echo ($rwArray_tmp[3])? $rwArray_tmp[3] : '---' ;?></td>
				<td width="100px">&nbsp;<?php echo ($rwArray_tmp[3] * $rwArray_tmp[2]) ?></td>
 			</tr>
 			<?php 
						
	 				}
 				}
 			?>
 			<tr>
 				<td width="400px">&nbsp;</td>
				<td width="100px">&nbsp;</td>
				<td width="100px">&nbsp;<?php echo ($total_calibre)? strtoupper($total_calibre) : '---' ;?></td>
				<td width="100px">&nbsp;<?php echo ($total_gramaje)? strtoupper($total_gramaje) : '---' ;?></td>
 			</tr>
 			<tr>
 				<td width="400px">&nbsp;</td>
				<td width="100px">&nbsp;</td>
				<td width="100px">&nbsp;<b>+</b><?php echo ($tole_calib_ms)? strtoupper($tole_calib_ms) : '**' ; ?>&nbsp;<b>-</b><?php echo ($tole_calib_ms)? strtoupper($tole_calib_ms) : '**' ;?>&nbsp;</td>
				<td width="100px">&nbsp;<b>+</b><?php echo ($tole_grama_mn)? strtoupper($tole_grama_mn) : '**' ; ?>&nbsp;<b>-</b><?php echo ($tole_calib_ms)? strtoupper($tole_calib_ms) : '**' ;?>&nbsp;</td>
 			</tr>
 		</table>
 		<table border="0" class="tabla">
 			<tr>
				<td width="200px">&nbsp;Papel pouch&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($papel_pouch_lam)? strtoupper($papel_pouch_lam) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($papel_pouch_lam == 'si') {echo 'block';}else{echo 'none';} ?>">Laminado por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($papel_pouch_lam == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($papel_pouch_lampor)? strtoupper($papel_pouch_lampor) : '---' ; ?></span></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Foil&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($foil_lam)? strtoupper($foil_lam) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($foil_lam == 'si') {echo 'block';}else{echo 'none';} ?>">Laminado por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($foil_lam == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($foil_lampor)? strtoupper($foil_lampor) : '---' ; ?></span></td>
			</tr>
		</table>
		<!-- 	FIN DATOS ESTRUCTURA PRODUCTO Y/O LAMINACION -->
		
		
		<!-- 	DATOS SELLADO -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>SELLADO</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Producto&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tipoproducto)? strtoupper($tipoproducto) : '---' ; ?></td>
			</tr>
			<tr>
				<td colspan="4" align="center">&nbsp;<b>MEDIDAS DEL PRODUCTO</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Base mayor&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($bmayor)? strtoupper($bmayor) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia base mayor&nbsp;</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_bmayor_ms)? strtoupper($tole_bmayor_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_bmayor_mn)? strtoupper($tole_bmayor_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Base menor&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($bmenor)? strtoupper($bmenor) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia base menor&nbsp;</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_bmenor_ms)? strtoupper($tole_bmenor_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_bmenor_mn)? strtoupper($tole_bmenor_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Pesta&ntilde;a&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($pestania)? strtoupper($pestania) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia de pesta&ntilde;a (mm)&nbsp;</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_pestania_ms)? strtoupper($tole_pestania_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_pestania_mn)? strtoupper($tole_pestania_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo sellado&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_sellado)? strtoupper($tipo_sellado) : '---' ; ?></td>
				<td width="200px">&nbsp;Forma sellado&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($forma_sellado)? strtoupper($forma_sellado) : '---' ; ?></td>
			</tr>	
			<tr>
				<td width="200px">&nbsp;Impresion&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_impresion)? strtoupper($tipo_impresion) : '---' ; ?></td>
				<td width="200px">&nbsp;Selle de fondo&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($selle_fondo)? strtoupper($selle_fondo) : '---' ; ?></td>
			</tr>	
			<tr>
				<?php
					//se adiciono la correcion de el calculo de el peso millar de  los capuchones
					//unset($estructura_n); ($arrtabla1)? $estructura_n = count(explode(':|:',$arrtabla1)) : $estructura_n = 1;
					unset($estructura_n); ($tipo_estruc == 'compuesto')? $estructura_n = 2 : $estructura_n = 1;
				?>
				<td width="200px">&nbsp;Peso millar&nbsp;<b>(kg/millar)</b></td>
<!--		no borrar peso millar pasado con error reflejado en planta		
				<td width="30%" class="NoiseDataTD">&nbsp;
					<span id="pesomillar">
						<?php //echo round( (((((double) $bmayor / 1000) + ((double) $bmenor / 1000 )) / 2 ) * ( (((double)  $largo / 1000) * 2) + (((double) $pestania / 1000) * 2)))*$totalgramaje  * 100 ) / 100 ?>
					</span>
				</td>
-->
				<!--<td width="150px">&nbsp;<?php //echo round(((((($bmayor / 1000) + ($bmenor / 1000)) / 2)  * ((($largo / 1000) * 2) + ($pestania / 1000 ) * 2)) *  (($totalgramaje / $estructura_n))) * 100) / 100; ?></td>-->
				<td width="150px">&nbsp;<?php echo round(((((($bmayor / 1000) + ($bmenor / 1000)) / 2)  * ((($largo / 1000) * 2) + ($pestania / 1000 ) * 2)) *  (($total_gramaje / $estructura_n))) * 100) / 100; ?></td>
				<td width="200px">&nbsp;Maquina&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($maquina)? strtoupper($maquina) : '---' ; ?></td>
			</tr>	
			<tr>
				<td width="200px">&nbsp;Dist. precalentadores&nbsp;<b>(mm)</b></td>
				<td colspan="3">&nbsp;<?php echo ($dist_precalentadores)? strtoupper($dist_precalentadores) : '---' ; ?></td>
			</tr>			
			<tr>
				<td width="200px">&nbsp;Troquel&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($troquel)? strtoupper($troquel) : '---' ; ?></td>
				<td width="200px">&nbsp;Tipo de troquel&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_troquel)? strtoupper($tipo_troquel) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Macroperforaciones&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($macroper)? strtoupper($macroper) : '---' ; ?></td>
				<td width="200px">&nbsp;No Macroperforaciones&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($nro_macroper)? strtoupper($nro_macroper) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Microperforaciones&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($microper)? strtoupper($microper) : '---' ; ?></td>
				<td width="200px">&nbsp;No caras Microperforaciones&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($dist_microper)? strtoupper($dist_microper) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo de microperforaciones&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipo_microper)? strtoupper($tipo_microper) : '---' ; ?></td>
				<td width="200px">&nbsp;Dist. Microperforaciones&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($dist_microper)? strtoupper($dist_microper) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Observaciones</td>
				<td colspan="3">&nbsp;<?php echo ($note_sellado)? strtoupper($note_sellado) : '---' ; ?></td>
			</tr>
		</table>
		<!-- 	FIN DATOS SELLADO -->
		
		
		
		<!-- 	DATOS MICRO -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>MICRO</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo material&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tipo_estruc)? strtoupper($tipo_estruc) : '---' ; ?>&nbsp;<?php echo ($tipo_material_) ? strtoupper($tipo_material_) : '' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Calibre&nbsp;<b>(&micro;m)</b></td>
				<td colspan="3">&nbsp;<?php echo ($total_calibre)? strtoupper($total_calibre) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ancho<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho_impresion)? strtoupper($ancho_impresion) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia ancho</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_ancho_impresion_ms)? strtoupper($tole_ancho_impresion_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_impresion_mn)? strtoupper($tole_ancho_impresion_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo microperforacion&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($mcr_tipo_perforacion)? strtoupper($mcr_tipo_perforacion) : '---' ; ?></td>
				<td width="200px">&nbsp;Cant. caras microperforadas&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($mrc_cant_cara_microper)? strtoupper($mrc_cant_cara_microper) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Observaciones</td>
				<td colspan="3">&nbsp;<?php echo ($note_micro)? strtoupper($note_micro) : '---' ; ?></td>
			</tr>
		</table>
		<!-- 	FIN DATOS MICRO -->
		
		
		
		
		
		<!-- 	DATOS DOBLADO -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>DOBLADO</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tipo material&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tipo_estruc)? strtoupper($tipo_estruc) : '---' ; ?>&nbsp;<?php echo ($tipo_material_) ? strtoupper($tipo_material_) : '' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Calibre&nbsp;<b>(&micro;m)</b></td>
				<td colspan="3">&nbsp;<?php echo ($total_calibre)? strtoupper($total_calibre) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Observaciones</td>
				<td colspan="3">&nbsp;<?php echo ($note_doblado)? strtoupper($note_doblado) : '---' ; ?></td>
			</tr>
		</table>
		<!-- 	FIN DATOS DOBLADO -->
		<?php }?>
		<!--	**************************************************************	-->
		<!--	FIN FICHA TECNICA DE CAPUCHON	-->
		<!--	**************************************************************	-->
		
		
		
		
		
		
		
		
		
		
		
		
		<!--	**************************************************************	-->
		<!--	FICHA TECNICA DE LAMINA	-->
		<!--	**************************************************************	-->
		<?php if($tipitecodigo == 6){?>
		
		<!-- 	DATOS IMPRESION -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>IMPRESION</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Material a imprimir</td>
				<td colspan="3">&nbsp;<?php echo ($product_imp_nomb)? strtoupper($product_imp_nomb) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Rodillo</td>
				<td width="150px">&nbsp;<?php echo ($rodillo)? strtoupper($rodillo) : '---' ;?></td>
				<td width="200px">&nbsp;Repeticiones</td>
				<td width="150px">&nbsp;<?php echo ($nrorepet)? strtoupper($nrorepet) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Pistas</td>
				<td width="150px">&nbsp;<?php echo ($nropistas)? strtoupper($nropistas) : '---' ;?></td>
				<td width="200px">&nbsp;No caras</td>
				<td width="150px">&nbsp;<?php echo ($ncaras_imp)? strtoupper($ncaras_imp) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ancho<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho)? strtoupper($ancho) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia ancho</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_ancho_ms)? strtoupper($tole_ancho_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_mn)? strtoupper($tole_ancho_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Largo<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($largo)? strtoupper($largo) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia largo</td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_largo_ms)? strtoupper($tole_largo_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_largo_mn)? strtoupper($tole_largo_mn) : 'xx' ; ?>
			</tr>
			<tr>
				<td width="200px">&nbsp;Otros productos</td>
				<td colspan="3">&nbsp;<?php echo ($other)? strtoupper($other) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Fotocelda al lado</td>
				<td width="150px">&nbsp;<?php echo ($fotoc_lado)? strtoupper($fotoc_lado) : '---' ;?></td>
				<td width="200px">&nbsp;Tipo de impresion</td>
				<td width="150px">&nbsp;<?php echo ($tipo_impresion)? strtoupper($tipo_impresion) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ancho Fotocelda&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho_fotoc)? strtoupper($ancho_fotoc) : '---' ;?></td>
				<td width="200px">&nbsp;Largo Fotocelda&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($largo_fotoc)? strtoupper($largo_fotoc) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Dist. Fotocelda al borde&nbsp;<b>(mm)</b></td>
				<td colspan="3">&nbsp;<?php echo ($dfotoc_borde)? strtoupper($dfotoc_borde) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Color Fotocelda&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($color_fotoc)? strtoupper($color_fotoc) : '---' ; ?></td>
				<td width="200px">&nbsp;Codigo SAP&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($codigosap)? strtoupper($codigosap) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tintas resistentes a&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tintasa)? strtoupper($tintasa) : '---' ;?></td>
			<tr>
				<td width="200px">&nbsp;Tintas especiales a&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tinta_espe)? strtoupper($tinta_espe) : '---' ;?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Version del arte&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($version_arte)? strtoupper($version_arte) : '---' ;?></td>
			</tr>
			<tr>
				<td colspan="4" align="left">&nbsp;<b>TEXTOS LEGALES</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Codigo de barras&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($cod_barras)? strtoupper($cod_barras) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Color fondo barras&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($color_fondo_barras)? strtoupper($color_fondo_barras) : '---' ; ?></td>
				<td width="200px">&nbsp;Color barras&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($color_barras)? strtoupper($color_barras) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Observaciones&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($note_product)? strtoupper($note_product) : '---' ; ?></td>
			</tr>
			<?php if($arrdispensing) $arrObject = explode(':|:',$arrdispensing);?>
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>CUADRO DE TINTAS # <?php echo count($arrObject); ?></b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;COLOR PANTONE&nbsp;</td>
				<td width="150px">&nbsp;CODIGO PLASTICEL&nbsp;</td>
				<td width="200px">&nbsp;ANILOX&nbsp;</td>
				<td width="150px">&nbsp;GRUPO&nbsp;</td>
			</tr>
			<?php 
				if($arrdispensing)
				{
					unset($arrObject);
					$arrObject = explode(':|:',$arrdispensing);
					for($a = 0; $a < count($arrObject); $a++)
					{
						$arrRow = explode(':-:',$arrObject[$a]);
						//variables a usar
						$obj_anilox = 'anilox_'.$arrRow[1];
						$obj_grupo = 'grupo_'.$arrRow[1];
						$rwFormula = loadrecordformula($arrRow[1],$idcon)
 			?>
 			<tr>
 				<td width="200px">&nbsp;<?php echo ($rwFormula['formulnombre'])? strtoupper($rwFormula['formulnombre']) : '---' ; ?></td>
 				<td width="150px">&nbsp;<?php echo ($rwFormula['formulnumero'])? strtoupper($rwFormula['formulnumero']) : '---' ; ?></td>
 				<td width="200px">&nbsp;<?php echo ($$obj_anilox)? $$obj_anilox : '---' ; ?></td>
 				<td width="150px">&nbsp;<?php echo ($$obj_grupo)? $$obj_grupo : '---' ; ?></td>
 			</tr>
 			<?php 
					}
				}					
			?>
			<tr>
				<td width="200px">&nbsp;Papel pouch&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($papel_pouch_imp)? strtoupper($papel_pouch_imp) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($papel_pouch_imp == 'si') {echo 'block';}else{echo 'none';} ?>">Impreso por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($papel_pouch_imp == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($papel_pouch_imppor)? strtoupper($papel_pouch_imppor) : '---' ; ?></span></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Foil&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($foil_imp)? strtoupper($foil_imp) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($foil_imp == 'si') {echo 'block';}else{echo 'none';} ?>">Impreso por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($foil_imp == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($foil_imppor)? strtoupper($foil_imppor) : '---' ; ?></span></td>
			</tr>
			<tr>
				<td colspan="4" align="center">&nbsp;<b>EMBOBINADO FINAL</b></td>
			</tr>
			<tr>
				<td colspan="4" align="center"><img src="../img/pics_embobinados/<?php if(!$embobinado_icon){echo 'no_image.jpg';}else{echo $embobinado_icon;}?>"></img></td>
			</tr>			
		</table>
		<!-- 	FIN DATOS IMPRESION -->
		
		
		
		
		<!-- 	DATOS ESTRUCTURA PRODUCTO Y/O LAMINACION -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>ESTRUCTURA PRODUCTO Y/O LAMINACION</b></td>
			</tr>
			<tr>
				<td width="400px">&nbsp;Material</td>
				<td width="100px">&nbsp;Color</td>
				<td width="100px">&nbsp;Calibre</td>
				<td width="100px">&nbsp;Gramaje</td>
			</tr>
			<?php 
				if($arrtabla1)
				{
					$array_tmp = explode(':|:',$arrtabla1);
					for($a = 0; $a < count($array_tmp); $a++)
					{
						$rwArray_tmp = explode(':-:', $array_tmp[$a]);
						$rwArray_tmp_adh = explode(',',$rwArray_tmp[4]);
						$rwPadreitem = loadrecordpadreitem($rwArray_tmp[1],$idcon);
						if($rwPadreitem['paditeconfig'] != 1)
						{
							$tipo_material_ = ($tipo_material_)? $tipo_material_.' / '.$rwPadreitem['paditenombre'] : $rwPadreitem['paditenombre'] ;
						}
						//$total_gramaje += ($rwArray_tmp[3] * $rwArray_tmp[2]);
						//$total_calibre += $rwArray_tmp[3];
 			?>
 			<tr>
 				<td width="400px">&nbsp;<?php echo ($rwPadreitem['paditenombre'])? strtoupper($rwPadreitem['paditenombre']) : '---' ; ?>&nbsp;<?php if($rwArray_tmp_adh[1]){ echo ($rwArray_tmp_adh[1])? '|&nbsp;Desempe&ntilde;o ('.$rwArray_tmp_adh[1].')' : '-------' ;}?>&nbsp;<?php if($rwArray_tmp_adh[2]){echo ($rwArray_tmp_adh[2])? '|&nbsp;Tipo ('.$rwArray_tmp_adh[2].')' : '-------' ;}?></td>
				<td width="100px">&nbsp;<?php echo ($$objColor)? strtoupper($$objColor) : '---' ;?></td>
				<td width="100px">&nbsp;<?php echo ($rwArray_tmp[3])? $rwArray_tmp[3] : '---' ;?></td>
				<td width="100px">&nbsp;<?php echo ($rwArray_tmp[3] * $rwArray_tmp[2]) ?></td>
 			</tr>
 			<?php 
	 				}
 				}
 			?>
 			<tr>
 				<td width="400px">&nbsp;</td>
				<td width="100px">&nbsp;</td>
				<td width="100px">&nbsp;<?php echo ($total_calibre)? strtoupper($total_calibre) : '---' ;?></td>
				<td width="100px">&nbsp;<?php echo ($total_gramaje)? strtoupper($total_gramaje) : '---' ;?></td>
 			</tr>
 			<tr>
 				<td width="400px">&nbsp;</td>
				<td width="100px">&nbsp;</td>
				<td width="100px">&nbsp;<b>+</b><?php echo ($tole_calib_ms)? strtoupper($tole_calib_ms) : '**' ; ?>&nbsp;<b>-</b><?php echo ($tole_calib_ms)? strtoupper($tole_calib_ms) : '**' ;?>&nbsp;</td>
				<td width="100px">&nbsp;<b>+</b><?php echo ($tole_grama_mn)? strtoupper($tole_grama_mn) : '**' ; ?>&nbsp;<b>-</b><?php echo ($tole_calib_ms)? strtoupper($tole_calib_ms) : '**' ;?>&nbsp;</td>
 			</tr>
 		</table>
 		<table border="0" class="tabla">
 			<tr>
				<td width="200px">&nbsp;Papel pouch&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($papel_pouch_lam)? strtoupper($papel_pouch_lam) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($papel_pouch_lam == 'si') {echo 'block';}else{echo 'none';} ?>">Laminado por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($papel_pouch_lam == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($papel_pouch_lampor)? strtoupper($papel_pouch_lampor) : '---' ; ?></span></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Foil&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($foil_lam)? strtoupper($foil_lam) : '---' ;?></td>
				<td width="200px">&nbsp;<span style="display : <?php if($foil_lam == 'si') {echo 'block';}else{echo 'none';} ?>">Laminado por el lado&nbsp;</span></td>
				<td width="150px">&nbsp;<span style="display : <?php if($foil_lam == 'si') {echo 'block';}else{echo 'none';} ?>"><?php echo ($foil_lampor)? strtoupper($foil_lampor) : '---' ; ?></span></td>
			</tr>
		</table>
		<!-- 	FIN DATOS ESTRUCTURA PRODUCTO Y/O LAMINACION -->
		
		
		
		
		
		
		<!-- 	DATOS CORTE O REFILADO -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>CORTE O REFILADO</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Tratamiento</td>
				<td width="150px" colspan="3">&nbsp;<?php echo ($trata_corte)? strtoupper($trata_corte) : '---' ; ?></td>
<!--				<td width="200px">&nbsp;Embobinado</td>-->
<!--				<td width="150px">&nbsp;<?php //echo ($tipo_emb)? strtoupper($tipo_emb) : '---' ; ?></td>-->
			</tr>
			<tr>
				<td width="200px">&nbsp;Color empalme cara&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($cempal_cara)? strtoupper($cempal_cara) : '---' ;?></td>
				<td width="200px">&nbsp;Color empalme dorso&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($cempal_dorso)? strtoupper($cempal_dorso) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Embobinado</td>
				<td width="150px">&nbsp;<?php echo ($tipo_emb)? strtoupper($tipo_emb) : '---' ; ?></td>
				<td width="200px">&nbsp;Con respecto</td>
				<td width="150px">&nbsp;<?php echo ($con_resp)? strtoupper($con_resp) : '---' ; ?></td>
			</tr>
			<tr>
				<td width=200px>&nbsp;Metros el rollo<b>(mts)</b></td>
				<td width="150px">&nbsp;<?php echo ($mrollo)? strtoupper($mrollo) : '---' ; ?></td>
				<td width="200px">&nbsp;No max empalmes&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($nmax_empal)? strtoupper($nmax_empal) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Dist. entre fotoceldas&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($largo)? strtoupper($largo) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia largo&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_largo_ms)? strtoupper($tole_largo_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_largo_mn)? strtoupper($tole_largo_mn) : 'xx' ; ?>
				</td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Ancho de bobina&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho)? strtoupper($ancho) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia ancho&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_ancho_ms)? strtoupper($tole_ancho_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_ancho_mn)? strtoupper($tole_ancho_mn) : 'xx' ; ?>
				</td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Diametro maximo de la bobina<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($drollo)? strtoupper($drollo) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia diametro&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_drollo_ms)? strtoupper($tole_drollo_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_drollo_mn)? strtoupper($tole_drollo_mn) : 'xx' ; ?>
				</td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Peso del rollo<b>(kg)</b></td>
				<td width="150px">&nbsp;<?php echo ($prollo)? strtoupper($prollo) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia peso&nbsp;<b>(kg)</b></td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_prollo_ms)? strtoupper($tole_prollo_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_prollo_mn)? strtoupper($tole_prollo_mn) : 'xx' ; ?>
				</td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Abundacia&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($abundancia)? strtoupper($abundancia) : '---' ; ?></td>
				<td width="200px">&nbsp;Tolerancia abundancia&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;
					<b>+</b><?php echo ($tole_abundancia_ms)? strtoupper($tole_abundancia_ms) : 'xx' ; ?>&nbsp;
					<b>-</b><?php echo ($tole_abundancia_mn)? strtoupper($tole_abundancia_mn) : 'xx' ; ?>
				</td>
			</tr>
			<tr>
				<td colspan="4" align="center">&nbsp;<b>EMBOBINADO FINAL</b></td>
			</tr>
			<tr>
				<td colspan="4" align="center"><img src="../img/pics_embobinados/<?php if(!$embobinado_icon){echo 'no_image.jpg';}else{echo $embobinado_icon;}?>"></img></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;No pistas</td>
				<td width="150px">&nbsp;<?php echo ($nropistas)? strtoupper($nropistas) : '---' ; ?></td>
				<td width="200px">&nbsp;Ancho de la pista&nbsp;<b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($ancho)? strtoupper($ancho) : '---' ; ?></td>
			</tr>	
			<tr>
				<td width="200px">&nbsp;Fotocelda al lado&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($fotoc_lado)? strtoupper($fotoc_lado) : '---' ; ?></td>
				<td width="200px">&nbsp;Empates con cinta&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($nmax_empal)? strtoupper($nmax_empal) : '---' ; ?></td>
			</tr>	
			<tr>
				<td width="200px">&nbsp;Tipo de material&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($tipo_estruc)? strtoupper($tipo_estruc) : '---' ; ?>&nbsp;<?php echo ($tipo_material_) ? strtoupper($tipo_material_) : '' ;?></td>
			</tr>		
		</table>
		<!-- 	FIN DATOS CORTE O REFILADO -->
		<?php }?>
		<!--	**************************************************************	-->
		<!--	FIN FICHA TECNICA DE LAMINA	-->
		<!--	**************************************************************	-->
		
		
		
		
		
		
		
		
		
		
		<!-- 	DATOS EMBALAJE -->
		<table border="0" class="tabla">
			<tr>
				<td colspan="4" align="center" style="border-color: #000000; border-width:1px; border-style: solid">&nbsp;<b>EMBALAJE</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Codigo de la caja&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($cod_caja)? strtoupper($cod_caja) : '---' ; ?></td>
				<td width="200px">&nbsp;Tama&ntilde;o core</td>
				<td width="150px">&nbsp;<?php echo ($tam_core)? strtoupper($tam_core) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Referencia de la caja&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($caja_item)? strtoupper($caja_item) : '---' ; ?></td>
			</tr>
			<?php if($form_empa == 'suspendido'){?>	
			<tr>
				<td width="200px">&nbsp;Codigo del conector&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($cod_empa)? strtoupper($cod_empa) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Referencia del conector&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($empa_item)? strtoupper($empa_item) : '---' ; ?></td>
			</tr>	
			<?php }
			if($form_empa == 'carton_extremos'){?>	
			<tr>
				<td width="200px">&nbsp;Codigo protector de carton&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($cod_empa)? strtoupper($cod_empa) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Referencia protector de carton&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($empa_item)? strtoupper($empa_item) : '---' ; ?></td>
			</tr>	
			<?php }?>
			<tr>
				<td width="200px">&nbsp;Material estibado&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($estibado)? strtoupper($estibado) : '---' ; ?></td>
			</tr>	
			<?php if($estibado == 'si'){?>
			<tr>
				<td width="200px">&nbsp;Tama&ntilde;o de estiba</td>
				<td width="150px">&nbsp;<?php echo ($tam_estiba)? strtoupper($tam_estiba) : '---' ; ?></td>
				<td width="200px">&nbsp;Tipo de estiba</td>
				<td width="150px">&nbsp;<?php echo ($tipo_estiba)? strtoupper($tipo_estiba) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Altura maxima pallet <b>(mm)</b></td>
				<td width="150px">&nbsp;<?php echo ($alt_pallet)? strtoupper($alt_pallet) : '---' ; ?></td>
				<td width="200px">&nbsp;Peso por pallet</td>
				<td width="150px">&nbsp;<?php echo ($pes_pallet)? strtoupper($pes_pallet) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Estresado</td>
				<td width="150px">&nbsp;<?php echo ($estresado)? strtoupper($estresado) : '---' ; ?></td>
				<td width="200px">&nbsp;Codigo de la estiba&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($cod_estiba)? strtoupper($cod_estiba) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Referencia de la estiba&nbsp;</td>
				<td colspan="3">&nbsp;<?php echo ($estiba_item)? strtoupper($estiba_item) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Nivel x estiba</td>
				<td width="150px">&nbsp;<?php echo ($niv_estiba)? strtoupper($niv_estiba) : '---' ; ?></td>
				<td width="200px">&nbsp;Cantidad x estiba&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($cant_estiba)? strtoupper($cant_estiba) : '---' ; ?></td>
			</tr>	
			<?php }?>
			<tr>
				<td colspan="4" align="center">&nbsp;<b>TIPO DE EMPAQUE</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Pallets o enfardado&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipoemp_palletenf)? strtoupper($tipoemp_palletenf) : '---' ; ?></td>
				<td width="200px">&nbsp;Separador de carton&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipoemp_separadorc)? strtoupper($tipoemp_separadorc) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Bolsa tub. peletizada&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipoemp_bolsatubpet)? strtoupper($tipoemp_bolsatubpet) : '---' ; ?></td>
				<td width="200px">&nbsp;Envuelto en corrugado&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipoemp_envueltoc)? strtoupper($tipoemp_envueltoc) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Cajas&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipoemp_caja)? strtoupper($tipoemp_caja) : '---' ; ?></td>
				<td width="200px">&nbsp;Suspendido&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipoemp_suspendido)? strtoupper($tipoemp_suspendido) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Protector de core&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipoemp_pcore)? strtoupper($tipoemp_pcore) : '---' ; ?></td>
				<td width="200px">&nbsp;Estibada tipo exp.&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($tipoemp_estibaexp)? strtoupper($tipoemp_estibaexp) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Observaciones</td>
				<td colspan="3">&nbsp;<?php echo ($note_formaempaque)? strtoupper($note_formaempaque) : '---' ; ?></td>
			</tr>
			<tr>
				<td colspan="4" align="center">&nbsp;<b>UNIDADES DE MEDIDA</b></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Unidades&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($unimedi_und)? strtoupper($unimedi_und) : '---' ; ?></td>
				<td width="200px">&nbsp;Kilos&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($unimedi_kgs)? strtoupper($unimedi_kgs) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Millares&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($unimedi_mill)? strtoupper($unimedi_mill) : '---' ; ?></td>
				<td width="200px">&nbsp;Metros&nbsp;</td>
				<td width="150px">&nbsp;<?php echo ($unimedi_mtr)? strtoupper($unimedi_mtr) : '---' ; ?></td>
			</tr>
			<tr>
				<td width="200px">&nbsp;Observaciones</td>
				<td colspan="3">&nbsp;<?php echo ($note_embalaje)? strtoupper($note_embalaje) : '---' ; ?></td>
			</tr>
		</table>
		<!-- 	FIN DATOS EMBALAJE -->



		<!-- 	DATOS ADJUNTOS-->
			<table border="0" class="tabla" cellpadding="0">
				<tr>
					<td width="233px">&nbsp;</td>
					<td width="233px">&nbsp;</td>
					<td width="233px">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3">&nbsp;
						<?php 
							if($uploadocumen)
							{
								$arrUpload = explode('::', $uploadocumen);
								$arrUploadSize = explode('::', $uploadocumensize);
								for($a = 0; $a < count($arrUpload); $a++)
								{
						?>
						<a href="javascript: void(0);" onclick="window.open('http://75.98.171.118/plasticel/doc/upload/documentos/<?php echo $arrUpload[$a] ?>','impresion','status=no,menubar=no,scrollbars=yes,resizable=yes,width=880,height=650');"><?php echo $arrUpload[$a].' ('.$arrUploadSize[$a].')' ?></a>
						<?php												
								}
							}
						?>
					</td>
				</tr>
		</table>
		
	</body>
</html>