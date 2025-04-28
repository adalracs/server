<div class="ui-buttonset">
  
<?php

	if( $reccomact['reporte'] && !$flagcheck ){
  		echo '<button id="reporte">Reportar OTP</button>&nbsp;&nbsp;';
  }
  		
	if( ($reccomact['nuevo'] && $optgestion > 0) && !$flagcheck ){
  		echo '<button id="gestionar">Gestionar</button>&nbsp;&nbsp;';
  }else if( ($reccomact['nuevo']&& $optanalisis > 0) && !$flagcheck ) {
    echo '<button id="analizar">Analizar Orden</button>&nbsp;&nbsp;';
  }else if($reccomact['nuevo'] && !$flagcheck ) {
      echo '<button id="nuevo">Nuevo</button>&nbsp;&nbsp;';
  }
  	
  if( $reccomact['consultar'] && !$flagcheck ){
  		echo '<button id="consultar">Consulta</button>&nbsp;&nbsp;';
  }
  	
	if($reccomact['detallar'] && !$flagcheck){
   		echo '<button id="detallar">Ver detalle</button>&nbsp;&nbsp;';
  }
   	
  if($reccomact['borrar'] && !$flagcheck){
    echo '<button id="borrar">Borrar</button>&nbsp;&nbsp;';
  }
   	
  if($reccomact['borrar'] && $flagcheck){
   		echo '<button id="borrarselect">Borrar selecci&oacute;n</button>&nbsp;&nbsp;';
  }

  if($reccomact["reportegopp"] && !$flagcheck){
    echo '<button id="reporte">Reportar OPP</button>&nbsp;&nbsp;';
  }
   	
  if($reccomact['modificar'] && !$flagcheck){
    echo '<button id="editar">Modificar</button>&nbsp;&nbsp;';
  }
                
  if($reccomact["modificargopp"] && !$flagcheck){
    echo '<button id="editar">Recepcion OPP</button>&nbsp;&nbsp;';
  }

  if($reccomact["modificarropp"] && !$flagcheck){
    echo '<button id="editar">Recepcion OPP</button>&nbsp;&nbsp;';
  }
   		
  if(($reccomact['imprimir'])&& !$flagcheck){
   		echo '<button id="imprimir">Imprimir</button>&nbsp;&nbsp;';
  }
   		
  if($reccomact['calificar'] && !$flagcheck){
    echo '<button id="calificar">Calificar</button>&nbsp;&nbsp;';
  }
   		
  if($reccomact['omologar'] && !$flagcheck){
    echo '<button id="omologar">Homologar</button>&nbsp;&nbsp;';
  }

  if($reccomact["cierre"] && !$flagcheck){
    echo '<button id="cierre">Cerrar</button>&nbsp;&nbsp; ';
  }

  if($reccomact["devolver"] && !$flagcheck){
    echo '<button id="devolver">Devolver</button>&nbsp;&nbsp;';
  }

  if($reccomact["exportar1"] && !$flagcheck){

    echo '<button id="exportarexcel1">Exportar fichas t&eacute;cnicas</button>&nbsp;&nbsp;';
  }

  if($reccomact["exportar2"] && !$flagcheck){

    echo '<button id="exportarexcel2">Exportar estructuras</button>&nbsp;&nbsp;';
  }

  if($reccomact["exportar3"] && !$flagcheck){

    echo '<button id="exportarexcel3">Exportar tintas</button>&nbsp;&nbsp;';
  }

  if($reccomact["cerraranalisis"] && !$flagcheck){
      echo '<button id="cerraranalisis">cerrar</button>&nbsp;&nbsp;';
  }

  if($reccomact["cierreamp"] && !$flagcheck){
    echo '<button id="cierreamp">Cerrar analisis</button>&nbsp;&nbsp;';
  }
          
  if($reccomact["cierreappr"] && !$flagcheck){
    echo '<button id="cierreappr">Cerrar analisis</button>&nbsp;&nbsp;';
  }

  if($reccomact["gnoconformemp"] && !$flagcheck){
      echo '<button id="gnoconformemp">Generar no conforme</button>&nbsp;&nbsp;';
  } 

  if($reccomact["gnoconformepr"] && !$flagcheck){
      echo '<button id="gnoconformepr">Generar no conforme</button>&nbsp;&nbsp;';
  }

  if($reccomact["cierregppr"] && !$flagcheck){
    echo '<button id="cierregppr">Cerrar no conforme</button>&nbsp;&nbsp;';
  } 


?>

</div>