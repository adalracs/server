<?php
include('../src/FunPerPriNiv/pktbltabla.php');
include('../src/FunPerPriNiv/pktblcampo.php');
include('../src/FunGen/verificacampo.php');
include ( '../src/FunGen/fncmsgerror.php');
		
$idcon = fncconn();

$sbregtablas = fullscantablaordenada($idcon); // fullscantablaordenada me retorna todas las tablas de la base de datos, organizadas por codigo de tabla.
$nuCantRow2 = fncnumreg($sbregtablas);
// Encabezado del XML
$sum.=trim('<?xml version="1.0" encoding="UTF-8" standalone="yes"?>');
$sum.="\n";
$sum.='<tabla xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">';

// El for se encarga de iterar las tablas 

for($l = 0; $l < $nuCantRow2; $l++){
	$sbRows = fncfetch ($sbregtablas,$l);
       	 
	     
	$sbregtabla = fullscantablaordenada($idcon);
	 
	if($sbregtabla > 0){
		$nuCantRow = fncnumreg($sbregtabla);
		$sum.= "\n <fila>\n "; // Etiqueta que arma cada fila de la matriz XML
		
		    $campor=fullscancampos($sbRows['tablcodi'],$idcon); // Me trae todos los campos de la tabla campo donde sean PRIMARY KEYS para realizar el comparativo de coincidencias en otras tablas...
		   
		    $trues = fncnumreg($campor); // Numero de Registros donde los campos PRIMARY KEY fueron TRUE
		    unset($tempo);
		    for ($t=0;$t<$trues;$t++)
		    {
		    	$sbcamp = fncfetch ($campor,$t);
		    	$tempo[$t]=$sbcamp['campnomb'];
		    	
		    }
		   
		   // Esta parte del codigo lo que hace es listarme de nuevo todas las tablas de la BD y toma cada campo
		   // PRIMARY KEY para encontrar coincidencias con cada una de las tablas... retornando 1 si ay coincidencia
		   // o 1000 si no ay relacion entre tablas.
		    
			$sbregtablar = fullscantablaordenada($idcon); 
			$nuCantRow3 = fncnumreg($sbregtablar);
			
			for($y = 0; $y < $nuCantRow3; $y++){
	        $sbRowss = @fncfetch ($sbregtablar,$y);
	       
	        $campos=fullscancampocodigo2($sbRowss['tablcodi'],$idcon);
	        $nuCantRow4=fncnumreg($campos);
	      
	            
	       if ($tempo!=null) {
	       	
	         	
	     	if (verificacampo($nuCantRow4,$campos,$tempo,$sbRows)==1) {
	     		
	       		$sum.='<'.$sbRowss['tablnomb'].'>1</'.$sbRowss['tablnomb'].'>'; 
				$sum.= "\n";
				// 1 en caso de encontrar coincidencia
			
	       	}
	       	else {
	       		
	       		$sum.='<'.$sbRowss['tablnomb'].'>1000</'.$sbRowss['tablnomb'].'>'; 
				$sum.= "\n";
				// 1000 en caso de no encontrar coincidencia
	       	}
	        }
	        else {
	        	    $sum.='<'.$sbRowss['tablnomb'].'>1000</'.$sbRowss['tablnomb'].'>'; 
				$sum.= "\n";
	        	 // En caso de que la consulta arroje vacio	 	
	        	 	 }	 	 
	       	 
			}
			
			$sum.="</fila>";
						
			} 
			
			
			
}
 
		  
$sum.="\n</tabla> ";
$fin=ltrim($sum); // Contiene la estructura XML antes de ser guardada en el archivo XML
// El XML se guarda en este archivo.
$file = fopen('../etc/data.xml',"w");
$contenido = $fin;

// Asegurarse primero de que el archivo existe y puede escribirse sobre él.

    // En nuestro ejemplo estamos abriendo $nombre_archivo en modo de adición.
    // El apuntador de archivo se encuentra al final del archivo, así que
    // allí es donde irá $contenido cuando llamemos fwrite().
    if (!$file) {
         //echo "No se puede abrir el archivo ($nombre_archivo)";
         //exit;
    }

    // Escribir $contenido a nuestro arcivo abierto.
    if (fwrite($file, $contenido) === FALSE) {
        //echo "No se puede escribir al archivo ($nombre_archivo)";
        //exit;
    }

    echo '<script language="javascript">';
		echo '<!--//'."\n";
		echo 'alert("Archivo XML Cargado con Exito...")';
		echo '//-->'."\n";
		echo '</script>';
		unset($file);

    fclose($file);

fncclose($idcon);
?>


	
		
	
	