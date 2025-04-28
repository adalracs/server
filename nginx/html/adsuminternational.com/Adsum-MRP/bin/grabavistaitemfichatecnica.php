<?php 
	ini_set('display_errors',1);
	include_once ( '../def/tipocampo.php');
	include_once ('../src/FunGen/fncnumprox.php'); 
	include_once ('../src/FunGen/fncnumact.php'); 
	include_once ( '../src/FunGen/fncmsgerror.php'); 
	include_once ( '../src/FunPerPriNiv/pktblproducto.php'); 
	include_once ( '../src/FunPerPriNiv/pktblcpfichdetope.php'); 
	include_once ( '../src/FunPerPriNiv/pktblcamperfichat.php'); 
	include_once ( '../src/FunPerPriNiv/pktblproductoseguimiento.php'); 
	define("grabaEx",3);
	define("errorIng",35);
	define("id1",269);
	//incluye validacion de campos personalizados de ficha tecnica
	include 'validacamperfichat.php';	
	if(!$flagnuevovistaitemfichatecnica)
	{
		$flagnuevovistaitemfichatecnica = 1;

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
		$iRegproductoseguimiento['prosegnombre']= "Gestionado FT {OK}";
		$iRegproductoseguimiento['usuacodi']=$usuacodi;
		$iRegproductoseguimiento['produccodigo']=$produccodigo;
		$iRegproductoseguimiento['prosegfecha']=date("Y-m-d");
		$iRegproductoseguimiento['proseghora']=date("h:i,a");
		$iRegproductoseguimiento['modulocodigoorg']= 6;//var conf modulo de bandeja FT
		$iRegproductoseguimiento['modulocodigodes']= 7;//var conf modulo de ficha tecnica
		if( insrecordproductoseguimiento($iRegproductoseguimiento,$idcon) > 0){
			fncnumprox(id1,$iRegproductoseguimiento['prosegcodigo'] + 1,$idcon); 
		}
		fncclose($idcon);

		//establecer conexion a la base de datos
		$idcon = fncconn();
		//explosiona el array de colores separado por el comodin ':|:' '
		if($arrdispensing) $arrObject = explode(':|:',$arrdispensing);
		//elimina colores al producto
		$response = delrecordproducformula_ft($produccodigo,$idcon);
		//ciclo para explosion de los arrays
		for($a = 0; $a < count($arrObject); $a++){
			//explosiona los registros de el array separados por el comodin :-:
			$rwObject = explode(':-:',$arrObject[$a]);
			//objetos adicionales
			$obj_anilox = 'anilox_'.$rwObject[1];
			$obj_grupo = 'grupo_'.$rwObject[1];
			//prepara un array
			$iRegProducformula_ft["produccodigo"] = $produccodigo;
			$iRegProducformula_ft["formulcodigo"] = $rwObject[1];
			$iRegProducformula_ft["proforanilox"] = $$obj_anilox;
			$iRegProducformula_ft["proforindice"] = ($a + 1);
			$iRegProducformula_ft["proforgrupo"] = $$obj_grupo;
			//inserta el array en su respectiva tabla
			$response = insrecordproducformula_ft($iRegProducformula_ft,$idcon);
		}
		//consecutivo para producto - padreitem
		$nuidtemp = fncnumact(141,$idcon);	
		do
		{
			$nuresult = loadrecordproducpadreitem_ft($nuidtemp,$idcon);
			if($nuresult == e_empty)
				$iRegProducpadreitem_ft["propadcodigo"] = $nuidtemp - 1;
			$nuidtemp ++;
		}while ($nuresult != e_empty);
		unset($nuidtemp);
		//almancena la estructura del pedido en la tabla producto padre item
		//se explosiona el array de tabla1
		if($arrtabla1) $arrObject = explode(':|:', $arrtabla1);
		//se borra los registros actuales si existen en la tabla produc padre item
		$resulta = delrecordproducpadreitem_ft($produccodigo,$idcon);
		//se recorre el array
		for($i = 0; $i < count($arrObject); $i++)
		{
			//se explosiona por comodin ':-:'
			$arr = explode(':-:',$arrObject[$i]);
			//se explosiona por comodin ',' nota para el desempeño y tipo en caso de ser adhesivo
			$arr2 = explode(',',$arr[4]);
			//se crea objeto de color de material si es pigmentado o no
			$objColor = 'color_'.$arr[0].'_'.$arr[1];
			//variables para los calibres alternos
			$objCalibreA1 = 'calibre_a1_'.$arr[0].'_'.$arr[1];
			$objCalibreA2 = 'calibre_a2_'.$arr[0].'_'.$arr[1];
			//se crea el ireg correspondiente a produc padre item
			$iRegProducpadreitem_ft["propadcodigo"] = $iRegProducpadreitem_ft["propadcodigo"] + 1;
			$iRegProducpadreitem_ft["produccodigo"] = $produccodigo;
			$iRegProducpadreitem_ft["paditecodigo"] = $arr[1];//campo que contiene codigo padre item 
			$iRegProducpadreitem_ft["propadcalib"] = $arr[3];//campo que contiene almacenar calibre del item
			$iRegProducpadreitem_ft["propadcolor"] = $$objColor;//obeto del color
			$iRegProducpadreitem_ft["propaddesem"] = $arr2[1];
			$iRegProducpadreitem_ft["propadtipo"] = $arr2[2];
			$iRegProducpadreitem_ft["propadindex"] = ($i + 1);//indice de la estructura
			$iRegProducpadreitem_ft["propadcalib1"] = $$objCalibreA1;//calibre alterno 1
			$iRegProducpadreitem_ft["propadcalib2"] = $$objCalibreA2;//calibre alterno 2
			$resultado = insrecordproducpadreitem_ft($iRegProducpadreitem_ft,$idcon);
		}
		//se actualiza el consecutico de produc padre item
		if($resultado)
			fncnumprox(141,$iRegProducpadreitem_ft["propadcodigo"] + 1,$idcon); 
		//actualiza producto para saltar proceso planeacion
		updateproducto(array('produccodigo' => $produccodigo, 'producproces' => 7),$idcon);
		//	se borra los campos personalizados para ingresar los nuevos
		$resulta = delrecordcpfichdetope($produccodigo,$idcon);
		//termina la conexion a la base de datos
		fncclose($idcon);
		//incluye capa que almacenar los campos en la base datos
		include 'grabacamperfichat.php';
		//muestra mensaje de grabado exitoso
		$flagnuevovistaitemfichatecnica = 1;
		fncmsgerror(grabaEx);
		//redirecciona a el maestro correspondiente
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'location ="maestablvistaitemfichatecnica.php?codigo='.$codigo.';"';
		echo '//-->'."\n";
		echo '</script>';
	}
?>