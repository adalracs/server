<?php 
include_once ( '../src/FunGen/fncnumprox.php');
include_once ( '../src/FunGen/fncnumact.php');
include_once ( '../def/tipocampo.php');
include_once ( '../src/FunPerPriNiv/pktblrequisicion.php');
include_once ( '../src/FunPerPriNiv/pktblrequisicionopp.php');
include_once ( '../src/FunPerPriNiv/pktblgestionopp.php');
include_once ( '../src/FunPerPriNiv/pktblop.php');
include_once ( '../src/FunPerPriNiv/pktblcampo.php');
include_once ( '../src/FunPerPriNiv/pktbltabla.php');
include_once ( '../src/FunGen/buscacaracter.php');
include_once ( '../src/FunGen/fncmsgerror.php');
include_once( '../src/FunGen/fncnombexs.php');

function borrarequisicion($requiscodigo,$arrrequisicionopp,$usuacodi) 
{ 
	$nuconn = fncconn(); 
	$result = delrecordrequisicion($requiscodigo,$nuconn); 
	
	if($result < 0 ) 
	{ 
		ob_end_clean(); 
		echo '<script language="javascript">'; 
		echo '<!--//'."\n"; 
		echo 'alert("El registro no se puede eliminar porque se encuentra en uso")'; 
		echo '//-->'."\n"; 
		echo '</script>'; 
	} 
	if($result > 0) 
	{ 
		
		if($arrrequisicionopp) $arrObjrequisicion = explode(',',$arrrequisicionopp);
		for( $a = 0; $a < count($arrObjrequisicion); $a++)
		{
		
			$nuidtemp = fncnumact(234,$nuconn);
			do
			{	
				$nuresult = loadrecordgestionopp($nuidtemp,$nuconn);
				if($nuresult == e_empty)
				{
					$iReggestionopp[gesoppcodigo] = $nuidtemp;
				}
				$nuidtemp ++;
			}while ($nuresult != e_empty);
			
			//se le ingresa la gestion de requisicion
			$iReggestionopp[ordoppcodigo] = $arrObjrequisicion[$a];
			$iReggestionopp[opestacodigo] = 3;//estado en pdt materiales
			$iReggestionopp[gesoppfecha] = date('Y-m-d');
			$rwhora = getdate(time());
			$hora = $rwhora["hours"] . ":" . $rwhora["minutes"] . ":" . $rwhora["seconds"];
			$iReggestionopp[gesopphora] = $hora;
			$iReggestionopp[usuacodi] = $usuacodi;
			$iReggestionopp[gesoppdescri] = 'RI [Requisicion Cancelada]';
			$iReggestionopp[gesopptipo] = 1;//gestion
			insrecordgestionopp($iReggestionopp,$nuconn);
			$iRegop_opp[opestacodigo] = 3;//estado en pdt materiales
	    	$iRegop_opp[ordoppcodigo] = $arrObjrequisicion[$a];
	    	uprecordop_estado($iRegop_opp,$nuconn);
	    	//actualiza numerado
			$nuresult1 = fncnumprox(234,$nuidtemp,$nuconn); 
		}
		
		echo '<script language="javascript">'; 
		echo '<!--//'."\n"; 
		echo 'alert("Borrado exitoso")'; 
		echo '//-->'."\n"; 
		echo '</script>'; 
	} 
	fncclose($nuconn); 
} 
borrarequisicion($requiscodigo1,$arrrequisicionopp,$usuacodi1);