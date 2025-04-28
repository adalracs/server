<?php 
include ( '../src/FunGen/sesion/fncvalses.php');
include ( '../src/FunGen/cargainput.php');




include ( '../src/FunPerPriNiv/pktbltiposistema.php');
include ( '../src/FunPerPriNiv/pktbldepartamento.php');
include ( '../src/FunPerPriNiv/pktblciudad.php');
include ( '../src/FunPerPriNiv/pktblservicio.php');


include ( '../src/FunPerPriNiv/pktblcomponen.php');
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktbltipotrab.php');
include ( '../src/FunPerPriNiv/pktblusuario.php');
include ( '../src/FunPerPriNiv/pktbltarea.php');
include ( '../src/FunPerPriNiv/pktblotestado.php');
include ( '../src/FunPerPriNiv/pktblot.php');

if(!$flagdetallartareot){ 

	include ( '../src/FunGen/sesion/fnccarga.php');
	include ( '../src/FunPerPriNiv/pktbltareot2.php');
	
	
	$nuConn = fncconn();
	//$codtareot=loadcodigotareot($radiobutton,$nuConn);
	$sbreg = fnccarga($nombtabl,$radiobutton);
	if (!$sbreg){
		$nombtabl = "tareotserv";
		include( '../src/FunGen/fnccontfron.php');
	}else{
		$idConn = fncconn();
		$deptonombre = cargadeptonombre($sbreg[deptocodigo],$idConn);
		$ciudadnombre = cargaciudadnombre($sbreg[ciudadcodigo],$idConn);
		$tareanombre = cargatareanombre1($sbreg[tareacodigo],$idConn);
		$servicionombre = cargaservicionombre($sbreg[servicicodigo],$idConn);
		
		
		
		
		
		
	}
	
}

?> 
<html> 
	<head> 
		<title>Detalle de Gestion de OT</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
		<meta http-equiv="expires" content="0"> 
		<link rel="stylesheet" type="text/css" href="temas/Noise/Style.css"> 
		<SCRIPT LANGUAGE="JavaScript"> 
			<!-- Begin
			agree = 0;
			//  End -->
		</script> 
		<script language="JavaScript" src="motofech.js"></script> 
	</head> 
<?php if(!$codigo){ echo "<!--";} ?> 
  	<body bgcolor="FFFFFF" text="#000000"> 
    		<form name="form1" method="post"  enctype="multipart/form-data"> 
      			<p><font class="NoiseFormHeaderFont">Tareas por orden de trbajo</font></p> 
	  		<table border="0" cellspacing="1" cellpadding="0" align="center"class="NoiseFormTABLE" width="70%"> 
  			<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
  			<tr><td class="NoiseFieldCaptionTD"><span class="style5"><font color="FFFFFF">Detallar registro</font></span></td></tr> 
			<tr> 
		  		<td> 
            					<table width="95%" border="0" cellspacing="1" cellpadding="2" align="center"> 
              					<tr> 
 							<td width="15%" class="NoiseFooterTD">No. Orden</td> 
  							<td><?php if(!$flagdetallartareot){ echo $sbreg[ordtracodigo];}else{ echo $ordtracodigo;}?></td> 
  						</tr>
			 			<tr>
  							<td width="15%" class="NoiseFooterTD">ODS</td> 
  							<td><?php if(!$flagdetallartareot){ echo $sbreg[clientsolici];}else{ echo $ordtracodigo;}?></td> 
 			  			</tr>
 			 			<tr>
  							<td width="15%" class="NoiseFooterTD">Departamento</td> 
  							<td width="35%"><?php echo $deptonombre; ?></td> 
  							<td width="15%" class="NoiseFooterTD">Ciudad</td> 
  							<td width="35%"><?php echo $ciudadnombre; ?></td>
 			  			</tr>
 			  			 <tr>
  							<td width="15%" class="NoiseFooterTD">Tipo de orden</td> 
  							<td width="35%"><?php echo $tareanombre; ?></td> 
  							<td width="15%" class="NoiseFooterTD">Servicio</td> 
  							<td width="35%"><?php echo $servicionombre; ?></td>
 			  			</tr>
 			  <tr><td>&nbsp;</td></tr>

              	
              
			  <tr>
				<td colspan="7">
				  <table width="100%" border="1" cellspacing="1" cellpadding="0" align="center"> 
				    <tr>
              		  <td><iframe src="detallahistorialtareotserv.php?ordtracodigo=<?php echo $sbreg[ordtracodigo]; ?>" frameborder="0" name="detalleprograma" frameborder="0"  height="200" width="99%"></iframe></td>
              		</tr>
                  </table>
              	</td>
              </tr>              	
            </table> 
  		  </td> 
 		</tr> 
 		<tr> 
		  <td> 
			<div align="center"> 
			  <input type="image" name="cancelar2" src="../img/ayuda.gif" width="86" height="18" alt="Cancelar" border=0> 
  			  <input type="image" name="aceptar"  src="../img/aceptar.gif" onclick="form1.action='maestabltareotserv.php';"  width="86" height="18" alt="Aceptar" border=0> 
			</div> 
		  </td> 
 		</tr> 
 		<tr><td class="NoiseErrorDataTD">&nbsp;</td></tr> 
	  </table> 
 	  <input type="hidden" name="flagdetallartareot" value="1"> 
	  <input type="hidden" name="acciondetallartareot"> 
	  <input type="hidden" name="codigo" value="<?php echo $codigo; ?>"> 
	</form> 
  </body> 
<?php 
if(!$codigo)
{ echo " -->"; }
?> 
</html> 
