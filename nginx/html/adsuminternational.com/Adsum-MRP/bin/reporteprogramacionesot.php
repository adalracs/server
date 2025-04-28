<?php
 include('../src/FunPerSecNiv/fncconn.php');
/**
* Propiedad intelectual de Adsum (c).
*  Todos los derechos reservados
*
* Nombre: 		  reportprogramacionesotprint.php
* Descripcion:    Convierte una cadena de HTML en PDF
*
* Fecha: 20-AUG-2007
* Autor: cbedoya
*
* Historial de modificaciones
* ---------------------------
*/
 require_once('../src/FunPrint/html2fpdf.php');
 include('../src/FunGen/fnccargapresentac.php');
 
 if (strtotime($fecini)>=strtotime($fecfin)){
 	
	echo '<html>';
	echo '<head>';
	echo '<title>Nueva Impresion</title>';
	echo '<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> ';
	echo '</head>';
	echo '<body>';
	echo '<form name="form1" method="post"  enctype="multipart/form-data">';
	echo '<p><font class="NoiseFormHeaderFont">La fecha final debe ser mayor a la fecha inicial</font></p>';
	echo '<input type="image" name="inicio" src="../img/aceptar.gif"
			onclick="form1.action='."'".'consultarprogramacionesot.php'."'".';"  width="86" height="18"
			alt="Imprimir" border=0></div></td>
	</tr>';
	echo '<input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> ';
	echo '</form>';
	echo '</body>';
	echo '<html>';
	die();
 }
 
 
 
 
 
 $nuConn=fncconn();
 
 if ( $nuConn ){
   $sbSql = "SELECT vistaot.ordtracodigo, equipo.equiponombre, vistaot.ordtrafecini FROM vistaot, equipo WHERE vistaot.ordtrafecini between 
            '".$fecini."' AND '".$fecfin."' AND vistaot.plantacodigo IN (".trim($GLOBALS[usuaplanta]).") AND equipo.equipocodigo = vistaot.equipocodigo ORDER BY vistaot.ordtrafecini;";
   // - Consulta dentro de la vista ot para filtrar las OT's activas que esten dentro el rango de consulta
   $nuResult = pg_exec( $nuConn, $sbSql );
   unset( $sbSql );
		
   if ( $nuResult ){
     $nuCantRow = pg_numrows( $nuResult );
	 
     if ($nuCantRow > 0){
	   for( $i=1; $i <= $nuCantRow; $i++ ){
	     $nuCantFields = pg_numfields( $nuResult );
		 $sbRow = pg_fetch_row ( $nuResult, ($i-1) );
		 $arregloiregot[$i] = array(
				  'ordtracodigo'=>$sbRow[0],
				  'equiponombre'=>$sbRow[1],
				  'ordtrafecini'=>$sbRow[2]
		          );
       }
     }
   }
   else{ echo "No se puede ejecutar consulta"; }
 }
 else{ echo "No se puede conectar a la base de datos"; }
	
 $Day = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
 $Month = array('Diciembre','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre');

 // - Proceso para sacar sacar la cantidad de dias que existen entre el rango de fechas
	$date_parts1 = explode( '-', date( 'm-d-Y', strtotime( $fecini )));
	$date_parts2 = explode( '-', date( 'm-d-Y', strtotime( $fecfin )));
	
	$start_date = gregoriantojd ( $date_parts1[0], $date_parts1[1], $date_parts1[2] );
	$end_date = gregoriantojd ( $date_parts2[0], $date_parts2[1], $date_parts2[2] );
	 
// - Fin del proceso

// Armamos el pdf
//$date = date('Y-m-d');
// Cadena que contiene los datos de el indicador "DISPONIBILIDAD" (HTML)
//$html = $_SESSION['htmlreport'];
//$pdf = new HTML2FPDF('L', 'mm', 'letter');
//$pdf->AddPage('L');
//$pdf->Image(fnccargapresentac(3), 10, 10, 57, 15);

//$pdf->WriteHTML("<html>");
//$pdf->WriteHTML("<head>");
//$pdf->WriteHTML("<title>Programacion</title>");
?>
<!-- Armamos la Pag. -->
<html>
<head>
<title></title>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <meta http-equiv="expires" content="0">
 <link rel="stylesheet" type="text/css" href="temas/Noise/Style.css">
 <SCRIPT LANGUAGE="JavaScript">
 <!-- Begin
 agree = 0;
 //  End -->
 </script>
 <script language="JavaScript" src="motofech.js"></script></head>
 <body bgcolor="FFFFFF" text="#000000">
 <form name="form1" method="post"  enctype="multipart/form-data">
  
 <table align="center" width="100%">
 
 <tr><td colspan="7" align="left"><IMG src="<?php echo  fnccargapresentac(3); ?>" alt="Adsum Kallpa" /></td></tr>
     <tr><td colspan="7" align="center"><B>Adsum Kallpa</B></td></tr>
     <tr><td colspan="7" align="center"><B><?php echo  fnccargapresentac(4); ?></B></td></tr>
 </table>
 
 <table align="center" width="100%">
 <tr><td width="708">&nbsp;</td></tr>
 <tr><th scope="col"><TABLE border="0" cellpadding="1" cellspacing="1" width="100%" align="center">
     <tr><td colspan="7"><FONT face="Verdana" color="Black"><b>Programaci&oacute;n</b></FONT></td></tr>
     <tr><td colspan="7"><hr noshade></td></tr>
	 
     <?php
       $incfecini = $fecini;
	   $incfecini1 = $fecini;
	   $diainisem=0;
	   $numday = $end_date - $start_date;
	   $contarr=1;
	   
	   while (strtotime($incfecini) <= strtotime($fecfin)){
	   
	     echo '<tr><td align="center" class="NoiseFieldCaptionTD" colspan="7">';
	  	 echo '<font color="FFFFFF"><B>'.$Month[date('n',strtotime($incfecini))].'<B></font></td></tr>';
	  	 
         while( $numday > 0 ){
	  	   $diainisem = date('w',strtotime($incfecini));
	  	   echo '<tr align="center">'; 	
		   unset($arrfilatab);
		   $conteofila=1;
		   
	  	   for( $i = 0; $i < 7; $i++ ){
	  	     if(( $i >= $diainisem ) and ( strtotime( $incfecini )) <= strtotime( $fecfin )){
               echo '<td class="NoiseFooterTD" width="14%"><B>'.$Day[ date( 'w', strtotime( $incfecini ))].
	  	            ', '.date( 'd', strtotime( $incfecini )).'<B></td>'; 	     	
	  	       
	  	       $conteo=0;
	  	       
		       for( $h = $contarr; $h <= count( $arregloiregot ); $h++ ){
			     if( $incfecini == $arregloiregot[$h]['ordtrafecini'] ){
				   $conteo++;
			       $arrfilatab[$i][$conteo]=$h;	
			     }else{ 
			     	if ($conteo == 0) {  $arrfilatab[$i][1]=-1; }
					$contarr=$h; break; 
			     }
		         if ($conteo > $conteofila){ $conteofila=$conteo; }
		       }	
         	   
         	   
         	   $incfecini = date("Y-m-d",strtotime("+1 day", strtotime($incfecini)));
			   if(( date( 'j', strtotime( $incfecini )) == 1 ) and ( date( 'n', strtotime( $incfecini )) >= date( 'n', strtotime( $fecini )))){ break; }
			   $numday--;		 	 			
		 	 }else{ echo '<td></td>'; }
		   }  
		   echo '</tr>';

		   for ( $i=1; $i<=$conteofila; $i++){
		   	 $incfecini = $incfecini1;
		     echo '<tr>';
             for( $j = 0; $j < 7; $j++ ){
		  	   if(( $j >= $diainisem ) and ( strtotime( $incfecini ) <= strtotime( $fecfin ))){
		  	     echo '<td bgcolor="#E8F0F6"><small>';
		  	     
		  	     if ($arrfilatab[$j][$i] !=-1 and $arrfilatab[$j][$i] != null ){	
		       	   echo '<font color="Red">Numero OT: '.$arregloiregot[($arrfilatab[$j][$i])]['ordtracodigo'].
				  		'<br></font><font color="Black">'.$arregloiregot[($arrfilatab[$j][$i])]['equiponombre'].'</font>';
		  	     }else{
		  	       if ($i==1){echo 'No hay OT';}
		  	     }	
		  	     echo '</small></td>';
		  	     $incfecini = date("Y-m-d",strtotime("+1 day", strtotime($incfecini)));
			     if(( date( 'j', strtotime( $incfecini )) == 1 ) and ( date( 'n', strtotime( $incfecini )) > date( 'n', strtotime( $fecini )))){ break; }
		  	   }else{ echo '<td></td>'; }
             }
             echo '</tr>';

	  	   }

		   $incfecini1 = $incfecini;
		   if((( date( 'j', strtotime( $incfecini )) == 1 ) and ( date( 'n', strtotime( $incfecini )) > date( 'n',strtotime( $fecini )))) or ( strtotime( $incfecini ) >= strtotime( $fecfin ))){ break; }
         }  
         if ( strtotime( $incfecini ) == strtotime( $fecfin )) {break; }
       }  
     ?>	
   </TABLE></th>
 </tr>
 </table><br>
 <CENTER>
   <INPUT type="image" name="aceptar"  src="../img/aceptar.gif" onClick="form1.action='consultarprogramacionesot.php?codigo=';"  width="86" height="18" alt="Aceptar" border=0>
   <INPUT type="image" name="imprimir" src="../img/imprimir.gif" onClick="window.open('reporteprogramacionesotprint.php','printReport','status=no,menubar=no,scrollbars=yes,resizable=yes,left=600,width=600,height=500'); return false;">
 </CENTER>
 </FORM>

 <!-- Hidden SPAN -->
 <SPAN id="printFrame1" style="display:none;">
<center>
 <?php 
   ob_start();
 ?>
     <?php
       $incfecini = $fecini;
	   $incfecini1 = $fecini;
	   $diainisem=0;
	   $numday = $end_date - $start_date;
	   $contarr=1;
	   
	   while (strtotime($incfecini) <= strtotime($fecfin)){
	   	 echo '<th scope="col"><table width="100%" border="0" cellspacing="1" cellpadding="2" align="center" class="NoiseFormTABLE">';
	 	 echo '<tr><td colspan="7"><FONT face="Verdana" color="Black">Programaci&oacute;n</FONT></td></tr>';
	 	 echo '<tr><td colspan="7"><hr noshade></td></tr>';
	     echo '<tr><td align="center" class="NoiseFieldCaptionTD" colspan="7">';
	  	 echo '<font color="FFFFFF"><B>'.$Month[date('n',strtotime($incfecini))].'<B></font></td></tr>';
	  	 
         while( $numday > 0 ){
	  	   $diainisem = date('w',strtotime($incfecini));
	  	   echo '<tr align="center">'; 	
		   unset($arrfilatab);
		   $conteofila=1;
		   
	  	   for( $i = 0; $i < 7; $i++ ){
	  	     if(( $i >= $diainisem ) and ( strtotime( $incfecini )) <= strtotime( $fecfin )){
               echo '<td class="NoiseFooterTD" width="14%"><B>'.$Day[ date( 'w', strtotime( $incfecini ))].
	  	            ', '.date( 'd', strtotime( $incfecini )).'<B></td>'; 	     	
	  	       
	  	       $conteo=0;
	  	       
		       for( $h = $contarr; $h <= count( $arregloiregot ); $h++ ){
			     if( $incfecini == $arregloiregot[$h]['ordtrafecini'] ){
				   $conteo++;
			       $arrfilatab[$i][$conteo]=$h;	
			     }else{ 
			     	if ($conteo == 0) {  $arrfilatab[$i][1]=-1; }
					$contarr=$h; break; 
			     }
		         if ($conteo > $conteofila){ $conteofila=$conteo; }
		       }	
         	   
         	   
         	   $incfecini = date("Y-m-d",strtotime("+1 day", strtotime($incfecini)));
			   if(( date( 'j', strtotime( $incfecini )) == 1 ) and ( date( 'n', strtotime( $incfecini )) > date( 'n', strtotime( $fecini )))){ break; }
			   $numday--;		 	 			
		 	 }else{ echo '<td></td>'; }
		   }  
		   echo '</tr>';
		   for ( $i=1; $i<=$conteofila; $i++){
		   	 $incfecini = $incfecini1;
		     echo '<tr>';
             for( $j = 0; $j < 7; $j++ ){
		  	   if(( $j >= $diainisem ) and ( strtotime( $incfecini ) <= strtotime( $fecfin ))){
		  	     echo '<td bgcolor="#E8F0F6" width="14%">';
		  	     
		  	     if ($arrfilatab[$j][$i] !=-1 and $arrfilatab[$j][$i] != null ){	
		       	   echo '<font color="Red" face="Geneva, Arial, Helvetica, sans-serif" size="2">OT '.$arregloiregot[($arrfilatab[$j][$i])]['ordtracodigo'].
				  		'<br></font><font color="Black" size=-2>'.$arregloiregot[($arrfilatab[$j][$i])]['equiponombre'].'</font>';
		  	     }else{
		  	       if ($i==1){echo '<font color="Black" size="-2">No hay OT</font>';}
		  	     }	
		  	     echo '</td>';
		  	     $incfecini = date("Y-m-d",strtotime("+1 day", strtotime($incfecini)));
			     if(( date( 'j', strtotime( $incfecini )) == 1 ) and ( date( 'n', strtotime( $incfecini )) > date( 'n', strtotime( $fecini )))){ break; }
		  	   }else{ echo '<td></td>'; }
             }
             echo '</tr>';

	  	   }

		   $incfecini1 = $incfecini;
		   if((( date( 'j', strtotime( $incfecini )) == 1 ) and ( date( 'n', strtotime( $incfecini )) > date( 'n',strtotime( $fecini )))) or ( strtotime( $incfecini ) >= strtotime( $fecfin ))){ break; }
		   
         }     
	     echo '</TABLE></th>';
	     if ( strtotime( $incfecini ) == strtotime( $fecfin )) {break; }
	   }
     ?>	
  </center>
<?php  $_SESSION['htmlreport'] = ob_get_contents(); ?>
</SPAN>
<!-- End of hidden SPAN -->
 </body>
 </html>