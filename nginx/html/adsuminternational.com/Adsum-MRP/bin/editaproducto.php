<?php 

/* 
<!-- Propiedad intelectual de Adsum SAS (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 20120110 
GenVers: 4.8 --> 
Funcion         : editaproducto 
Decripcion      : Valida la data a editar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegproducto         Arreglo de datos. 
    $flageditarproducto    Bandera de validación 
Retorno         : 
		true	= 1 
		false	= 0 
Autor           : ariascos 
Escrito con     : WAG 
Historial de modificaciones 
| Fecha | Motivo				| Autor 	| 
*/ 
//ini_set('display_errors',1);

include ( '../def/tipocampo.php'); 
include_once ( '../src/FunPerPriNiv/pktblproductoseguimiento.php'); 
include_once ( '../src/FunPerPriNiv/pktblcptpdetope.php');
include_once ('../src/FunPerPriNiv/pktblcampertippro.php');
include_once ( '../src/FunPerPriNiv/pktblproducto.php'); 
include_once ( '../src/FunPerSecNiv/fncsqlrun.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncvaliddate.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
 
function editaproducto($iRegpedidoventa,$iRegproducpedido,&$flageditarproducto,&$campnomb,$tipevecodigo)
{
	$nuconn = fncconn();
	
	//	No utilice esta parte si va a utilizar la llave primaria como serial
	define("id",184);
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);
	define("errorIng",35);
	
	if($iRegpedidoventa && $iRegproducpedido)
	{
		
		if($tipevecodigo != 4)
		{
			$validfecent = fncvaliddate ($iRegpedidoventa[pedvenfecent]);
			$validfecrec = fncvaliddate ($iRegpedidoventa[pedvenfecrec]);
			$validdiapac = validaint4($iRegpedidoventa[pedvendiapac]);
		}
		
		if($validfecent  < 0)
		{
			$flageditarproducto = 1;
			$flagerror = 1;
			$campnomb[pedvenfecent] = 1;
			unset ($validfecent);
		}
		
		if($validfecrec  < 0)
		{
			$flageditarproducto = 1;
			$flagerror = 1;
			$campnomb[pedvenfecrec] = 1;
			unset ($validfecrec);
		}
		
		if($validdiapac  == 1)
		{
			$flageditarproducto = 1;
			$flagerror = 1;
			$campnomb[pedvendiapac] = 1;
			unset ($validdiapac);
		}
	

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			
			$resPV = uprecordpedidoventa($iRegpedidoventa,$nuconn);
//			$resPP = uprecordproducpedido($iRegproducpedido,$nuconn);
			
			fncclose($nuconn);
			
			if($resPV < 0 || $resPP < 0)
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flageditarproducto=1;
			}else
			{
				fncmsgerror(grabaEx);
			}
			
		}
	}

}
//validacion de campos personalizados
include 'validacampertippro.php';
//se asigna las bandera de nuevo pedido venta con la bandera de producto que retorna la validacion
$flageditarpedidoventa = $flageditarproducto;
//si no existe error en los campos personalizados
if(!$flageditarproducto)
{
	define("id1",269);//consecutivo para seguimiento de modificaciones
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
	$iRegproductoseguimiento['prosegnombre']= "Editado {OK}";
	$iRegproductoseguimiento['usuacodi']=$usuacodi;
	$iRegproductoseguimiento['produccodigo']=$produccodigo;
	$iRegproductoseguimiento['prosegfecha']=date("Y-m-d");
	$iRegproductoseguimiento['proseghora']=date("h:i,a");
	$iRegproductoseguimiento['modulocodigoorg']= 1;//var conf modulo de ventas
	$iRegproductoseguimiento['modulocodigodes']= 1;//var conf modulo de ventas
	if( insrecordproductoseguimiento($iRegproductoseguimiento,$idcon) > 0){
		fncnumprox(id1,$iRegproductoseguimiento['prosegcodigo'] + 1,$idcon); 
	}
	fncclose($idcon);

	//se crear el ireg correspondiente a pedido de venta
	$iRegpedidoventa[pedvencodven] = $pedvencodven;
	$iRegpedidoventa[pedvenvendedor] = $pedvenvendedor;
	$iRegpedidoventa[pedvencodigo] = $pedvencodigo;
	$iRegpedidoventa[tipevecodigo] = $tipevecodigo;
	$iRegpedidoventa[ordcomcodigo] = $ordcomcodigo;
	$iRegpedidoventa[usuacodi] = $usuacodi;
	$iRegpedidoventa[pedvennumero] = $pedvennumero;
	$iRegpedidoventa[pedvenfecent] = $pedvenfecent; 
	//si es muestra la fecha de rececpcion es la actual
	$iRegpedidoventa[pedvenfecrec] = ($tipevecodigo == 4)? date('Y-m-d') : $pedvenfecrec;
	//si es muestra dias pactados es 1 por defecto
	$iRegpedidoventa[pedvendiapac] = ($tipevecodigo == 4)? 1 : $pedvendiapac; 
	$iRegpedidoventa[pedvenobserv] = $pedvenobserv; 
	$iRegpedidoventa[pedvenconsec] = $pedvenconsec; 
	$iRegpedidoventa[pedvennompro] = $pedvennompro; 
	$iRegpedidoventa[pedvenmotmue] = $pedvenmotmue; 
	$iRegpedidoventa[pedvenfecelb] = $pedvenfecelb; 
	
	//se crea el ireg correspondiente a produc pedido
	$iRegproducpedido[propedcodigo] = $propedcodigo;
	$iRegproducpedido[produccodigo] = $produccodigo;
	$iRegproducpedido[pedvencodigo] = $pedvencodigo;
	$iRegproducpedido[propedcansol] = $cant;
	$iRegproducpedido[unidadcodigo] = $unimedi;
	$iRegproducpedido[propedcaninv] = $propedcaninv;
	$iRegproducpedido[propedcanpro] = $propedcanpro;
	$iRegproducpedido[propedproduc] = $propedproduc;
	
	//se crea el ireg correspondiente a producto
	$iRegproducto[produccodigo] = $produccodigo; 
	$iRegproducto[tipprocodigo] = $tipitecodigo; 
	$iRegproducto[proestcodigo] = 1; //ESTADO DEL PRODUCTO = 'BUENO'
	//si es muestra nombre de producto es muestra 
	$iRegproducto[producnombre] = ($tipevecodigo == 4)? $pedvennompro: $producnombre;
	$iRegproducto[produccoduno] = $produccoduno; 
	$iRegproducto[producrefcli] = date('Y-m-d'); 
	$iRegproducto[producfecha] = ($producfecha)? $producfecha : date('Y-m-d'); 
	$iRegproducto[producdelrec] = 1; 
	$iRegproducto[producproces] = 1;
	$iRegproducto[producpadre] = $propedproduc;
	//funcion editar producto
	editaproducto($iRegpedidoventa,$iRegproducpedido,$flageditarproducto,$campnomb,$tipevecodigo); 
	//se unifica la bandera en caso de error de los registros 
	$flageditarpedidoventa = $flageditarproducto;
	
	//se valida si hay banderas de erro y que no sea repeticion para no duplicar campos en la base da datos
	if(!$flageditarproducto && $tipevecodigo != 3)
	{
		$con = fncconn();
		//consecutivo para producto - padreitem
		$nuidtemp = fncnumact(129,$con);	
		do
		{
			$nuresult = loadrecordproducpadreitem($nuidtemp,$con);
			if($nuresult == e_empty)
				$iRegProducpadreitem[propadcodigo] = $nuidtemp - 1;
			$nuidtemp ++;
		}while ($nuresult != e_empty);
		unset($nuidtemp);
		//almancena la estructura del pedido en la tabla producto padre item
		//se explosiona el array de tabla1
		if($arrtabla1) $arrObject = explode(':|:', $arrtabla1);
		//se borra los registros actuales si existen en la tabla produc padre item
		$resulta = delrecordproducpadreitem($iRegproducto[produccodigo],$con);
		//se recorre el array
		for($i = 0; $i < count($arrObject); $i++)
		{
			//se explosiona por comodin ':-:'
			$arr = explode(':-:',$arrObject[$i]);
			//se crea objeto de color de material si es pigmentado o no
			$objColor = 'color_'.$arr[0].'_'.$arr[1];
			//se crea el ireg correspondiente a produc padre item
			$iRegProducpadreitem[propadcodigo] = $iRegProducpadreitem[propadcodigo] + 1;
			$iRegProducpadreitem[produccodigo] = $iRegproducto[produccodigo];
			$iRegProducpadreitem[paditecodigo] = $arr[1];//campo que contiene codigo padre item 
			$iRegProducpadreitem[propadcalib] = $arr[3];//campo que contiene almacenar calibre del item
			$iRegProducpadreitem[propadcolor] = $$objColor;//obeto del color
			$iRegProducpadreitem[propadindex] = ($i + 1);//indice de la estructura
			$resultado = insrecordproducpadreitem($iRegProducpadreitem,$con);
			if($resultado == -2)
			{
				//consecutivo para producto - padreitem
				$nuidtemp = fncnumact(129,$con);	
				do
				{
					$nuresult = loadrecordproducpadreitem($nuidtemp,$con);
					if($nuresult == e_empty)
						$iRegProducpadreitem[propadcodigo] = $nuidtemp - 1;
					$nuidtemp ++;
				}while ($nuresult != e_empty);
				unset($nuidtemp);
				//se reasinar consecutivo
				$iRegProducpadreitem[propadcodigo] = $iRegProducpadreitem[propadcodigo] + 1;
				//se ingresa el registro
				$resultado = insrecordproducpadreitem($iRegProducpadreitem,$con);
			}
		}
		//se actualiza el consecutico de produc padre item
		if($resultado)
			fncnumprox(129,$iRegProducpadreitem[propadcodigo] + 1,$con); 
		//se borra los campos personalizados para ingresar los nuevos
		$resulta = delrecordcptpdetope($iRegproducto[produccodigo],$con);
		//se llama el graba de campos personalizados
		include 'grabacampertippro.php';
		//codigo a la medida desarrollado por por hgonzales
		//proceso para actulizar el estado del pedido en espera de revision
		// codigo de calificacion en campertippto
		$rsvarCal = dinamicscancptpdetope(array("produccodigo" => $iRegproducto[produccodigo],"cptprocodigo" => 1000),$con);
		//validacion si tiene datos la consulta
		if($rsvarCal > 0)
		{		
			//codigo desarrollado por hgonzales
			$rwvarCal = fncfetch($rsvarCal,0);			
			$arrTp = explode(',',$rwvarCal['cptprovalor'], 2);
			$arrTp[0] = 'ESP';						
			$iRegCptpdetope2[cptodocodigo] = $rwvarCal[cptodocodigo];
			$iRegCptpdetope2[cptprocodigo] = 1000;
			$iRegCptpdetope2[usuacodi] = $rwvarCal[usuacodi];
			$iRegCptpdetope2[cptprovalor] = (!empty($rwvarCal['cptprovalor']))? $arrTp[0].','.$arrTp[1] : 0 ;
			$iRegCptpdetope2[cptprofecha] = date('Y-m-d');
			$iRegCptpdetope2[cptpronota] = 'Calificacion del producto ';
			$iRegCptpdetope2[produccodigo] = $rwvarCal[produccodigo];;
			$resulta = uprecordcptpdetope($iRegCptpdetope2,$con);
		}
		fncclose($con);
		$flageditarproducto = 1;
		//se direcciona al maestro
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'location ="maestablproducto.php?codigo='.$codigo.';"';
		echo '//-->'."\n";
		echo '</script>';
	}
	//se valida si hay banderas de error y que sea repeticion para no duplicar campos en la base da datos
	if(!$flageditarproducto && $tipevecodigo == 3)
	{
		$con = fncconn();
		//se borra los campos personalizados para ingresar los nuevos
		$resulta = delrecordcptpdetope($iRegproducto[produccodigo],$con);
		//se llama el graba de campos personalizados
		//nota archivo solo para grabar campos personalizados en repeticion
		include 'grabacampertippro_rep.php';
		//codigo a la medida desarrollado por por hgonzales
		//proceso para actulizar el estado del pedido en espera de revision
		// codigo de calificaion en campertippto
		$rsvarCal = dinamicscancptpdetope(array("produccodigo" => $iRegproducto[produccodigo],"cptprocodigo" => 1000),$con);
		//validacion si tiene datos la consulta
		if($rsvarCal > 0)
		{		
			//codigo desarrollado por hgonzales
			$rwvarCal = fncfetch($rsvarCal,0);			
			$arrTp = explode(',',$rwvarCal['cptprovalor'], 2);
			$arrTp[0] = 'ESP';						
			$iRegCptpdetope2[cptodocodigo] = $rwvarCal[cptodocodigo];
			$iRegCptpdetope2[cptprocodigo] = 1000;
			$iRegCptpdetope2[usuacodi] = $rwvarCal[usuacodi];
			$iRegCptpdetope2[cptprovalor] = (!empty($rwvarCal['cptprovalor']))? $arrTp[0].','.$arrTp[1] : 0 ;
			$iRegCptpdetope2[cptprofecha] = date('Y-m-d');
			$iRegCptpdetope2[cptpronota] = 'Calificacion del producto ';
			$iRegCptpdetope2[produccodigo] = $rwvarCal[produccodigo];;
			$resulta = uprecordcptpdetope($iRegCptpdetope2,$con);
		}
		fncclose($con);
		//se direcciona al maestro
		$flageditarproducto = 1;
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'location ="maestablproducto.php?codigo='.$codigo.';"';
		echo '//-->'."\n";
		echo '</script>';
	}
}


?> 
