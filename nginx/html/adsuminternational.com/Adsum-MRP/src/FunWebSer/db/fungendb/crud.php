<?php
class crud
{
	var $conexion;
    var $sql;
    var $ircRecord;
	function inserccion($conexion,$ircRecord,$temp)
	{
		//$ircRecord['datprogra']=$ircRecord['datprogra'];
		$sql ="select * from dattemp where datcod = ".$ircRecord['datcod'] ;
	$resultado=pg_query($conexion,$sql);
	if ($resultado) {
	 				 
	 				
	 				$nuCantRow = pg_numrows($resultado);
	 				if ($nuCantRow) {
	 					$mensaje[]='no se puede insertar registro existente';
	 					return  serialize($mensaje);
	 				}
	 				else {
	 					$sql= "INSERT INTO dattemp ( 
	 		datcod,  
	 		datfechtemp,
	 		datfechrep,
	 		datfechasig,
	 		datfechdesp,
	 		datfechtrab,
	 		datbrig,
	 		datdisp,
	 		datcausa,
	 		datprogra)  
			VALUES (". 
	 			trim($ircRecord['datcod']).",'". 
	 			trim($ircRecord['datfechtemp'])."','". 
	 			trim($ircRecord['datfechrep'])."','".
	 			trim($ircRecord['datfechasig'])."','".
	 			trim($ircRecord['datfechdesp'])."','".
	 			trim($ircRecord['datfechtrab'])."','". 
	 			trim($ircRecord['datbrig'])."','".
	 			trim($ircRecord['datdisp'])."','".
	 			trim($ircRecord['datcausa'])."','".
	 			trim($temp)."')";
	 			$resultado=pg_query($conexion,$sql);
	 			
	 			if ($resultado) {
	 				
	 				$mensaje[]='Inserccion realizada';
	 					return  serialize($mensaje);
	 				
	 			}
	 			
	 				}
	}
		
	 			
	}
	function editar($conexion,$ircRecord,$temp)
	{
		$sql = "UPDATE dattemp SET 
	 		datcod =  ".$ircRecord['datcod'].", 
	 		datfechtemp =  '".$ircRecord['datfechtemp']."', 
	 		datfechrep =  '".$ircRecord['datfechrep']."', 
	 		datfechtrab =  '".$ircRecord['datfechtrab']."', 
	 		datbrig =  '".$ircRecord['datbrig']."', 
	 		datdisp =  '".$ircRecord['datdisp']."', 
	 		datcausa =  '".$ircRecord['datcausa']."',
	 		datprogra =  '".$temp."' 
		    WHERE 
	 		datcod =  "."".$ircRecord['datcod'].""; 
			$resultado=pg_query($conexion,$sql);
	 			if ($resultado) {
	 				$mensaje[]='Se actualizo el registro';
	 					return  serialize($mensaje);
	 				
	 			}
	}
	
function consulta($conexion,$tabla,$sentencia)
{
	$sql ="select * from ".$tabla ." where " .$sentencia;
	
	$resultado=pg_query($conexion,$sql);
	if ($resultado) {
	 				 
	 				
	 				$nuCantRow = pg_numrows($resultado);
	 				for ($j=0;$j<$nuCantRow;$j++)
	 				{ 
	 					$sbRow = pg_fetch_row ($resultado,$j);
	 				for ($i=0;$i<count($sbRow);$i++)
	 				{
	 					$registro[$j][$i]=$sbRow[$i];
	 					
	 				}
	 				}
	 				
	 				return array($registro);
	 			}
	
}
function listardatos($conexion,$tabla)
{
	$sql ="select * from ".$tabla ;
	
	$resultado=pg_query($conexion,$sql);
	if ($resultado) {
	 				 
	 				
	 				$nuCantRow = pg_numrows($resultado);
	 				for ($j=0;$j<$nuCantRow;$j++)
	 				{ 
	 					$sbRow = pg_fetch_row ($resultado,$j);
	 				for ($i=0;$i<count($sbRow);$i++)
	 				{
	 					$registro[$j][$i]=$sbRow[$i];
	 					
	 				}
	 				}
	 				
	 				return array($registro);
	 			}
	
}
function borrar($conexion,$tabla,$registro,$id)
{
	
	$sql ="delete from ".$tabla ." where " .$registro."=".$id;
	$resultado=pg_query($conexion,$sql);
	if ($resultado) {
		$mensaje[]='Borrado exitoso';
	 	return  serialize($mensaje);
		
		
	}
}
}
?>
