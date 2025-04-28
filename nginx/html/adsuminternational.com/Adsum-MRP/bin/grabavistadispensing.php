<?php 
	ini_set('display_errors',1);
	include_once ( '../def/tipocampo.php');
	include_once ('../src/FunGen/fncnumprox.php'); 
	include_once ('../src/FunGen/fncnumact.php'); 
	include_once ( '../src/FunGen/fncmsgerror.php'); 
	include_once ( '../src/FunPerPriNiv/pktblproducto.php'); 
	include_once( '../src/FunPerPriNiv/pktblcpdispdetope.php'); 
	include_once ( '../src/FunPerPriNiv/pktblcamperdispen.php'); 
	include_once ( '../src/FunPerPriNiv/pktblproductoseguimiento.php'); 

	define("grabaEx",3);
	define("errorIng",35);
	define("id1",269);
	//validaciones manuales son pocas no se utiliza de validacion genral
	if(!$equipocodigo)
	{
		//se llena la variable campnomb con los campos faltantes
		$campnomb['equipocodigo'] = 1;
		//se activan las banderas de intento de grabado
		$flagnuevovistadispensing = 1;
	}
	
	if(!$arrdispensing)
	{
		//se llena la variable campnomb con los campos faltantes
		$campnomb['arrdispensing'] = 1;
		//se activan las banderas de intento de grabado
		$flagnuevovistadispensing = 1;
	}

	if($arrdispensing) $arrObject = explode(':|:',$arrdispensing);

	for( $a = 0; $a < count($arrObject); $a++)
	{
		$rowArrObject = explode(':-:', $arrObject[$a]);
		$obj_anilox = 'anilox_'.$rowArrObject[1];
		$obj_grupo = 'grupo_'.$rowArrObject[1];

		if(validaint4($$obj_anilox) > 0 || !$$obj_anilox)
		{
			$campnomb[$obj_anilox] = 1;
			$flagnuevovistadispensing = 1;
		}

		if(validaint4($$obj_grupo) > 0 || !$$obj_grupo)
		{
			$campnomb[$obj_grupo] = 1;
			$flagnuevovistadispensing = 1;
		}

	}
	unset($arrObject);
	
	
	if(!$flagnuevovistadispensing)
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
		$iRegproductoseguimiento['modulocodigoorg']= 4;//var conf modulo de dispensing
		$iRegproductoseguimiento['modulocodigodes']= 5;//var conf modulo de planeacion
		if( insrecordproductoseguimiento($iRegproductoseguimiento,$idcon) > 0){
			fncnumprox(id1,$iRegproductoseguimiento['prosegcodigo'] + 1,$idcon); 
		}
		fncclose($idcon);

		//establecer conexion a la base de datos
		$idcon = fncconn();
		//explosiona el array de colores separado por el comodin ':|:' '
		if($arrdispensing) $arrObject = explode(':|:',$arrdispensing);
		//elimina colores al producto
		$response = delrecordproducformula($produccodigo,$idcon);
		//ciclo para explosion de los arrays
		for($a = 0; $a < count($arrObject); $a++){
			//explosiona los registros de el array separados por el comodin :-:
			$rwObject = explode(':-:',$arrObject[$a]);
			//objetos adicionales
			$obj_anilox = 'anilox_'.$rwObject[1];
			$obj_grupo = 'grupo_'.$rwObject[1];			
			//prepara un array
			$iRegProducformula["produccodigo"] = $produccodigo;
			$iRegProducformula["formulcodigo"] = $rwObject[1];
			$iRegProducformula["proforanilox"] = $$obj_anilox;
			$iRegProducformula["proforindice"] = ($a + 1);
			$iRegProducformula["proforgrupo"] = $$obj_grupo;
			//inserta el array en su respectiva tabla
			$response = insrecordproducformula($iRegProducformula,$idcon);
		}
		//actualiza producto para saltar proceso planeacion
		updateproducto(array('produccodigo' => $produccodigo, 'producproces' => 5),$idcon);
		//termina la conexion a la base de datos
		fncclose($idcon);
		//incluye capa que almacenar los campos en la base datos
		include 'grabacamperdispen.php';
		//muestra mensaje de grabado exitoso
		$flagnuevovistadispensing = 1;
		fncmsgerror(grabaEx);
		//redirecciona a el maestro correspondiente
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'location ="maestablvistadispensing.php?codigo='.$codigo.';"';
		echo '//-->'."\n";
		echo '</script>';
		
	}
		
?>