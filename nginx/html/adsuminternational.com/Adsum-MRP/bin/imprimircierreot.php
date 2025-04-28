<?php
include ( '../src/FunPerSecNiv/fncnumreg.php');
include ( '../src/FunPerSecNiv/fncfetch.php'); 
include ( '../src/FunPerPriNiv/pktblusuario.php'); 
include ( '../src/FunPerPriNiv/pktbltipomant.php'); 
include ( '../src/FunPerPriNiv/pktblreportot.php'); 
include ( '../src/FunPerPriNiv/pktblpriorida.php'); 
include ( '../src/FunPerPriNiv/pktbltarea.php'); 
include ( '../src/FunPerPriNiv/pktblot.php'); 
include ( '../src/FunPerPriNiv/pktblplanta.php'); 
include ( '../src/FunPerPriNiv/pktbltipotrab.php'); 
include ( '../src/FunPerPriNiv/pktbltipocump.php'); 
include ( '../src/FunPerPriNiv/pktblusuariotareot.php');
include ( '../src/FunPerPriNiv/pktbltareot.php');
include ( '../src/FunPerPriNiv/pktblcierreot.php');
include ( '../src/FunPerSecNiv/fncconn.php');
include ( '../src/FunPerSecNiv/fncclose.php');

$idcon = fncconn();
	
	$cierre = loadrecordcierreot($codigo,$idcon);
	$arrreport = loadrecordreportot($cierre[reportcodigo],$idcon);
	$ot = loadrecordot($arrreport[ordtracodigo],$idcon);
	$tareot = buscartareotordtracodigo($ot[ordtracodigo],$idcon);
	$planta = loadrecordplanta($ot[plantacodigo],$idcon);
	$reportfecha = $arrreport[reportfecha];
	$reportdescri = $arrreport[reportdescri];
	$arrtipomant = loadrecordtipomant($arrreport[tipmancodigo],$idcon);
	$tipmannombre = $arrtipomant[tipmannombre];
	$arrpriorida = loadrecordpriorida($arrreport[prioricodigo],$idcon);
	$priorinombre = $arrpriorida[priorinombre];
	$arrtipotrab = loadrecordtipotrab($arrreport[tiptracodigo],$idcon);
	$tiptranombre = $arrtipotrab[tiptranombre];
	$arrtarea = loadrecordtarea($arrreport[tareacodigo],$idcon);
	$tareanombre = $arrtarea[tareanombre];
	
	$arrtipocump = loadrecordtipocump($cierre[tipcumcodigo],$idcon);
	$tipcumnombre = $arrtipocump[tipcumnombre];
	
	$arrusr = loadrecordusuario($cierre[usuacodi],$idcon);
	$usrname = $arrusr[usuanombre]." ".$arrusr[usuapriape]." ".$arrusr[usuasegape];
	
	//Hallamos el codigo de tareot
$sbregtareot1 = loadrecordtareot2($ot[ordtracodigo],$idcon);
$sbregtareot = loadrecordtareot($sbregtareot1[tareotcodigo],$idcon);

//Hallamos el codigo de usuariotareot
$sbregustareottmp = loadrecordusuariotareot1($sbregtareot1[tareotcodigo], $idcon);
$codusuariotareot = $sbregustareottmp[usutarcodigo];
//Armamos el arreglo para buscar en usuariotareot por el codigo de tareot
$sbregusuariotareot[usutarcodigo] = "";
$sbregusuariotareot[usuacodi] = "";
$sbregusuariotareot[tareotcodigo] = $sbregtareot1[tareotcodigo];
$sbregusuariotareot[usutarlider] = "";
$idusutareot = dinamicscanusuariotareot($sbregusuariotareot,$idcon);

$t = 0;

if($idusutareot){
	$nuCantrow = fncnumreg($idusutareot );
	//recorremos el arreglo para determinar los usuarios de la ot
	
	for($i = 0;$i < $nuCantrow; $i++){
		$sbregusua = fncfetch($idusutareot,$i);
		
	
		if($sbregusua[usutarlider] == "t"){
			$lider = $sbregusua[usuacodi];
			$sbregusuario = loadrecordusuario($sbregusua[usuacodi],$idcon);
			
			$usuacodigo = $sbregusua[usuacodi];
			
			$sbregusuanom = $sbregusuario[usuanombre]." ".$sbregusuario[usuapriape]." ".$sbregusuario[usuasegape];
			
		}else{
			$sbregusuaselec[] = $sbregusua[usuacodi];
			
			$sbregustarcoditmp = ($t == 0) ? $sbregusua[usutarcodigo] : $sbregustarcoditmp.",".$sbregusua[usutarcodigo];
			$t++;
		}
		if(!$arreglo_tecnic)
			$arreglo_tecnic = $sbregusua[usuacodi];
		else
			$arreglo_tecnic = $arreglo_tecnic.",".$sbregusua[usuacodi];
		
	}
}
 
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cierre de Ot</title>
<style type="text/css">
<!--
.Estilo6 Estilo10 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo6 {font-size: 10px; }
.Estilo7 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
.Estilo6 Estilo10 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.Estilo10 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
</head>

<body onLoad="window.print()">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4"><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td width="26%" rowspan="2">
          <div align="center"><img src="../img/adsumcuasipequeno.jpg" ></div></td>
        <td width="48%"><div align="center" class="Estilo6 Estilo10"><b>GESTION DE MANTENIMIENTO</b></div></td>
      </tr>
      <tr>
        <td><div align="center" class="Estilo6 Estilo10"><b>CIERRE DE ORDEN DE TRABAJO</b></div></td>
        </tr>

    </table></td>
  </tr>

  <tr>
    <td ><span class="Estilo6 Estilo10">&nbsp;Fecha de Cierre:</span></td>
    
    <td colspan="2"><span class="Estilo6 Estilo10"><? echo $cierre["cierotfecfin"]."&nbsp;Hora:&nbsp;".$cierre["cierothorfin"]; ?></span></td>
    <td  class="Estilo6 Estilo10">Reporte de OT: <span class="Estilo6 Estilo10"><? echo $arrreport["reportcodigo"]."&nbsp;Fecha:&nbsp;".$arrreport["reportfecha"]; ?></span></td>
   
  </tr>
    
    <tr><span class="Estilo6 Estilo10">
    <td colspan="4">------------------------------------------------------------------------------------------------------------------</td></span>
   </tr>
   
  <tr>
    <td colspan="2"><span class="Estilo6 Estilo10">Planta</span></td>
    <td colspan="2"><span class="Estilo6 Estilo10"><? echo $planta[plantanombre]; ?></span></td>
  </tr>
  
  <tr>
    <td colspan="2"><span class="Estilo6 Estilo10">Tipo de Mantenimiento</span></td>
    <td colspan="2"><span class="Estilo6 Estilo10"><?php echo $tipmannombre ?></span></td>
  </tr>
  
  <tr>
    <td colspan="2"><span class="Estilo6 Estilo10">Tipo de Trabajo</span></td>
    <td colspan="2"><span class="Estilo6 Estilo10"><?php echo $tiptranombre ?></span></td>
  </tr>
  
  <tr>
    <td colspan="2"><span class="Estilo6 Estilo10">Prioridad</span></td>
    <td colspan="2"><span class="Estilo6 Estilo10"><?php echo $priorinombre ?></span></td>
  </tr>
  
  <tr>
    <td colspan="2"><span class="Estilo6 Estilo10">Tipo Cumplimiento</span></td>
    <td colspan="2"><span class="Estilo6 Estilo10"><?php echo $tipcumnombre ?></span></td>
  </tr>
    
   <tr><span class="Estilo6 Estilo10">
    <td colspan="4">------------------------------------------------------------------------------------------------------------------</td></span>
   </tr>

	
  
  <tr>
    <td><span class="Estilo6 Estilo10">Generada por:</span></td>
    <td>&nbsp;</td>
    <td colspan="3"><span class="Estilo6 Estilo10"> Nombre: </span><span class="Estilo6 Estilo10"> <?php echo $usrname; ?></span></td>
  </tr>
  
  <tr>
    <td><span class="Estilo6 Estilo10">Encargado</span></td>
    <td>&nbsp;</td>
    <td colspan="3"><span class="Estilo6 Estilo10"> Nombre: </span><span class="Estilo6 Estilo10"> <?php echo $sbregusuanom; ?></span></td>
  </tr>
  <tr>
      <td class="NoiseFooterTD" width="30%"><span class="Estilo6 Estilo10">&nbsp;Auxiliares de Mantenimiento</span></td>
      <td class="NoiseDataTD" colspan="4"><span class="Estilo6 Estilo10">&nbsp;
      <?php
	      	include('../src/FunGen/floadusuaaux.php');
	      	$idcon = fncconn();
	      	floadusuaaux($sbregusuaselec,$idcon);
	      	fncclose($idcon);
	   ?>
	  </span></td>
    </tr>
    
    <tr><span class="Estilo6 Estilo10">
    <td colspan="4">------------------------------------------------------------------------------------------------------------------</td></span>
   </tr>
  
    <tr>
    <td colspan="2"><span class="Estilo6 Estilo10">Descripci&oacute;n del Trabajo a Realizar</span></td>
    <?php $tareas = $cierre[cierotdescri];?></span></td>
    <td colspan="2"><span class="Estilo6 Estilo10">
      <?php 	
		    if($tareas)
				{ $datostarea = $tareas;
				  $datosdetarea = explode(".", $datostarea);
				    $cantdatos = count($datosdetarea);
				  for ($j=0; $j < $cantdatos; $j++)
				  {
				  	echo "&nbsp;".$datosdetarea[$j]."<br>";
				  }
				
				  }else{ echo $sbregtarnota;} 
			
	 ?>
    </span></td>
  </tr>

  <tr>
    <td><span class="Estilo6 Estilo10">Observaciones</span></td>
    <td><span class="Estilo6 Estilo10">&nbsp;</span></td>
    <td><span class="Estilo6 Estilo10">&nbsp;</span></td>
    <td><span class="Estilo6 Estilo10">&nbsp;</span></td>
  </tr>
  <tr>
    <td colspan="4">
    <table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
    <td>&nbsp</td>
    </tr>
    <tr>
    <td>&nbsp</td>
    </tr>
    </table>
    </td>
  </tr>
	
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
    <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td colspan="2"><span class="Estilo6 Estilo10">Firma:_____________________________________</span></td>
    </tr>
</table>
</body>
</html>
