<?php 
/* 
<!-- Propiedad intelectual de Adsum SAS (c) 
-Todos los derechos reservados- 
Creado con WAG Adsum 
Autor: Andrés A. Riascos D. 
Fecha: 20120110 
GenVers: 4.8 --> 
Funcion         : grabaproducto 
Decripcion      : Valida la data a grabar y la lleva al paquete. 
Parametros      : Descripicion 
    $iRegproducto         Arreglo de datos. 
    $flagnuevoproducto    Bandera de validación 
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
include_once ( '../src/FunPerPriNiv/pktblcptpdetope.php');
include_once ('../src/FunPerPriNiv/pktblcampertippro.php');
include_once ( '../src/FunPerPriNiv/pktblproducto.php'); 
include_once ('../src/FunPerPriNiv/pktblproducpadreitem.php');
include_once ('../src/FunPerPriNiv/pktblproducpedido.php');
include_once ('../src/FunPerPriNiv/pktblpedidoventa.php');
include_once ('../src/FunPerPriNiv/pktblordencompra.php');
include_once ( '../src/FunPerSecNiv/fncsqlrun.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/buscacaracter.php'); 
include ( '../src/FunGen/fncmsgerror.php'); 
include( '../src/FunGen/fncnombexs.php');
include_once ( '../src/FunPerPriNiv/pktblproductoseguimiento.php'); 
 
function grabaproducto(&$iRegproducto,$iRegordencompra,$iRegpedidoventa,$iRegproducpedido,&$flagnuevoproducto,&$campnomb,$tipevecodigo)
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
	 
	//consecutivo para codigo  pedido de venta
	$nuidtemp = fncnumact(115,$nuconn);	
	do
	{
		$nuresult = loadrecordpedidoventa($nuidtemp,$nuconn);
		if($nuresult == e_empty)
			$iRegpedidoventa[pedvencodigo] = $nuidtemp;
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	unset($nuidtemp);
	
	//consecutivo para pedido de venta
	$nuidtemp = fncnumact(114,$nuconn);	
	do
	{
		$nuresult = loadrecordpedidoventaPER('pedvenconsec',$nuidtemp,$nuconn);
		if($nuresult == e_empty)
			$iRegpedidoventa[pedvenconsec] = $nuidtemp;
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	unset($nuidtemp);
	
	 //consecutivo para producto
	$nuidtemp = fncnumact(113,$nuconn);
	do
	{
		$nuresult = loadrecordproducto($nuidtemp,$nuconn);
		if($nuresult == e_empty)
			$iRegproducto[produccodigo] = $nuidtemp;
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	unset($nuidtemp);
	
	 //consecutivo para producto pedido
	$nuidtemp = fncnumact(116,$nuconn);
	do
	{
		$nuresult = loadrecordproducpedido($nuidtemp,$nuconn);
		if($nuresult == e_empty)
			$iRegproducpedido[propedcodigo] = $nuidtemp;
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	unset($nuidtemp);
	
	 //consecutivo para orden de compra
	$nuidtemp = fncnumact(117,$nuconn);
	do
	{
		$nuresult = loadrecordordencompra($nuidtemp,$nuconn);
		if($nuresult == e_empty)
			$iRegordencompra[ordcomcodigo] = $nuidtemp;
		$nuidtemp ++;
	}while ($nuresult != e_empty);
	unset($nuidtemp);
	
	if($iRegproducto)
	{
		$iRegtabla["tablnomb"] = "producto";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			if($sbregtabla[tablnomb] == "producto")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}

		$iRegCampo["tablcodi"]=$tablcodi;
		$resultcampo=dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
		$iRegproducto_b = $iRegproducto;

		while($elementos = each($iRegproducto))
		{
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flagnuevoproducto = 1;
								$flagerror = 1;
							}
						}
					}
			}
			
			$validresult = consulmetaproducto($elementos[0],$elementos[1],$nuconn);

			if($validresult == 1)
			{
				$flagnuevoproducto = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
				unset ($validresult);
			}
		}

		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}
		
		if($flagerror != 1)
		{
			//si el pedido es diferente a muestra para la creacion de la orden de compra
			//nota : las muestras no tiene orden de compra
			if($tipevecodigo != 4)
			{ 
				//se inserta el registro
				$result = insrecordordencompra($iRegordencompra,$nuconn);
				//se adiciona a el registro de pedido venta la orden de compra insertada
				$iRegpedidoventa[ordcomcodigo] = $iRegordencompra[ordcomcodigo];
				//se borra consecutivo ya que no lleva consecutivo de muestra
				$iRegpedidoventa[pedvenconsec] = '';
			}
			else
			{
				$iRegpedidoventa['pedvenumero'];
				$iRegpedidoventa['pedvefecelb'];
			}
			//se actualiza el consecutivo de orden de compra
			if($result > 0){
				fncnumprox(117,$iRegordencompra[ordcomcodigo] +1 ,$nuconn);
			}
			//se inserta el pedido de venta al pedido
			$result = insrecordpedidoventa($iRegpedidoventa,$nuconn);
			//se actualiza el consecutivo de pedido de venta 
			if($result > 0)
			{
				if($tipevecodigo != 4){
					//consecutivo para las muestras se actualiza
					fncnumprox(114,$iRegpedidoventa[pedvenconsec] +1 ,$nuconn);
				}
				//consecutivo de pedido venta
				fncnumprox(115,$iRegpedidoventa[pedvencodigo] +1 ,$nuconn);
			} 
			//se inserta producto				
			$result = insrecordproducto($iRegproducto,$nuconn);
			//validacion de errores
			if($result < 0 )
			{
				ob_end_clean();
				fncmsgerror(errorReg);
				$flagnuevoproducto=1;
			}
			if($result > 0)
			{
				//actualizacion de consecutivos para producto
				fncnumprox(113,$iRegproducto[produccodigo] + 1,$nuconn); 
				//consecutivo para codigo producto seguimiento
				define("id1",269);
				$nuidtemp = fncnumact(id1,$nuconn);	
				do
				{
					$nuresult = loadrecordproductoseguimiento($nuidtemp,$nuconn);
					if($nuresult == e_empty){
						$iRegproductoseguimiento['prosegcodigo'] = $nuidtemp;
					}
					$nuidtemp ++;
				}while ($nuresult != e_empty);
				unset($nuidtemp);
				//seguimiento del producto
				$iRegproductoseguimiento['prosegnombre']= "Generado {OK}";
				$iRegproductoseguimiento['usuacodi']=$iRegproducto["usuacodi"];
				$iRegproductoseguimiento['produccodigo']=$iRegproducto["produccodigo"];
				$iRegproductoseguimiento['prosegfecha']=date("Y-m-d");
				$iRegproductoseguimiento['proseghora']=date("h:i,a");
				$iRegproductoseguimiento['modulocodigoorg']= 1;//var conf modulo de ventas
				$iRegproductoseguimiento['modulocodigodes']= 1;//var conf modulo de ventas
				if( insrecordproductoseguimiento($iRegproductoseguimiento,$nuconn) > 0){
					fncnumprox(id1,$iRegproductoseguimiento['prosegcodigo'] + 1,$nuconn); 
				}
				//se crea registro de produc pedido para la relacion entre pedido venta y producto.
				$iRegproducpedido[produccodigo] = $iRegproducto[produccodigo];
				$iRegproducpedido[pedvencodigo] = $iRegpedidoventa[pedvencodigo];
				//se inserta registro de produc pedido para la relacion entre pedido venta y producto.
				$result = insrecordproducpedido($iRegproducpedido,$nuconn);
				//se actualiza consecutivo para producpedido
				fncnumprox(116,$iRegproducpedido[propedcodigo] +1 ,$nuconn);
				//mensaje de grabado exitoso
				fncmsgerror(grabaEx);
			}
			fncclose($nuconn);
		}
	}

}
//validacion de campos personalizados
$acciongraba = 1;
include 'validacampertippro.php';
//se asigna las bandera de nuevo pedido venta con la bandera de producto que retorna la validacion
$flagnuevopedidoventa = $flagnuevoproducto;
//si no existe error en los campos personalizados
if(!$flagnuevoproducto){
	//se crear el ireg correspondiente a orden de compra 
	$iRegordencompra[ordcomcodigo] = 1;
	$iRegordencompra[usuacodi] = $usuacodi;
	$iRegordencompra[ciudadcodigo] = $ciudadcodigo;
	$iRegordencompra[ordcomcodcli] = trim($clientcodigo); 
	$iRegordencompra[ordcomfecrec] = $pedvenfecrec; 
	$iRegordencompra[ordcomdescri] = $ordcomdescri; 
	$iRegordencompra[ordcomruta] = $ordcomruta; 
	$iRegordencompra[ordcomnumero] = trim($ordcomnumero);
	$iRegordencompra[ordcomrazsoc] = trim($clientnombre);
	//si es diferente de muestra se valida la orden de compra
	if($tipevecodigo != 4) include 'validaordencompra.php';
	
	 //se crear el ireg correspondiente a pedido de venta
	$iRegpedidoventa[pedvencodven] = $pedvencodven;
	$iRegpedidoventa[pedvenvendedor] = $pedvenvendedor;
	$iRegpedidoventa[pedvencodigo] = $pedvencodigo;
	$iRegpedidoventa[tipevecodigo] = $tipevecodigo;
	$iRegpedidoventa[ordcomcodigo] = 1;
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
	//se valida el pedido de venta
	include_once 'validapedidoventa.php';
	
	 //se crea el ireg correspondiente a producto
	$iRegproducto[produccodigo] = $produccodigo; 
	$iRegproducto[tipprocodigo] = $tipitecodigo; 
	$iRegproducto[proestcodigo] = 1; //ESTADO DEL PRODUCTO = 'BUENO'
	//si es muestra nombre de producto es muestra
	$iRegproducto[producnombre] = ($tipevecodigo == 4)? $pedvennompro: $producnombre; 
	$iRegproducto[produccoduno] = $produccoduno; 
	$iRegproducto[producrefcli] = date('Y-m-d'); 
	$iRegproducto[producfecha] = date('Y-m-d'); 
	$iRegproducto[producdelrec] = 1; 
	$iRegproducto[producproces] = 1;
	$iRegproducto[producpadre] = $propedproduc;  
	
	//se crea el ireg correspondiente a produc pedido
	$iRegproducpedido[propedcodigo] = $propedcodigo;
	$iRegproducpedido[produccodigo] = $produccodigo;
	$iRegproducpedido[pedvencodigo] = $pedvencodigo;
	$iRegproducpedido[propedcansol] = $cant;
	$iRegproducpedido[unidadcodigo] = $unimedi;
	$iRegproducpedido[propedcaninv] = $propedcaninv;
	$iRegproducpedido[propedcanpro] = $propedcanpro;
	$iRegproducpedido[propedproduc] = $propedproduc;
	//se valida produc pedido
	include_once 'validaproducpedido.php';
	//se verifican cada una de las banderas arrojadas por las diferentes validaciones
	//a una bandera unficada
	if($flagnuevoordencompra || $flagnuevopedidoventa || $flagnuevoproducpedido)
	{
		$flagnuevoproducto = 1;
		$flagnuevopedidoventa = $flagnuevoproducto;
	}
	//si no encuntra error de campos personalizados ni de banderas prosigue a insertar los registros
	if(!$flagnuevoproducto)
	{
		grabaproducto($iRegproducto,$iRegordencompra,$iRegpedidoventa,$iRegproducpedido,$flagnuevoproducto,$campnomb,$tipevecodigo);
		//	se unifica la bandera en caso de error de los registros 
		$flagnuevopedidoventa = $flagnuevoproducto;
	}
	//se valida si hay banderas de erro y que no sea repeticion para no duplicar campos en la base da datos
	if(!$flagnuevoproducto && $tipevecodigo != 3)
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
		//se llama el graba de campos personalizados
		include 'grabacampertippro.php';
		fncclose($con);
		$flagnuevoproducto = 1;
		//se direcciona al maestro
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'location ="maestablproducto.php?codigo='.$codigo.';"';
		echo '//-->'."\n";
		echo '</script>';
	}
	//se valida si hay banderas de erro y que sea repeticion para no duplicar campos en la base da datos
	if(!$flagnuevoproducto && $tipevecodigo == 3)
	{
		//se llama el graba de campos personalizados
		//nota archivo solo para grabar campos personalizados en repeticion
		include 'grabacampertippro_rep.php';
		$flagnuevoproducto = 1;
		//se direcciona al maestro
		echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'location ="maestablproducto.php?codigo='.$codigo.';"';
		echo '//-->'."\n";
		echo '</script>';
	}
}


?> 
