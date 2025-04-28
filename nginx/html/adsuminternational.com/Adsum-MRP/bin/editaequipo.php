<?php 
include ( '../src/FunPerPriNiv/pktblequipo.php');
include ( '../src/FunPerPriNiv/pktblcampo.php');
include ( '../src/FunPerPriNiv/pktbltabla.php');
include ( '../src/FunGen/datecmp.php');
include ( '../def/tipocampo.php');
include ( '../src/FunGen/buscacaracter.php');
include ( '../src/FunGen/fncmsgerror.php');
include ( '../src/FunGen/fncnombeditexs.php');

function editaequipo($iRegequipo,&$flageditarequipo,&$campnomb,&$codigo,&$fecactual,&$iRegequicamper, $equipocodigonv)
{
	$nuconn = fncconn();
	define("errorReg",1);
	define("errorCar",2);
	define("grabaEx",3);
	define("compinst",4);
	define("venccomp",5);
	define("compactu",6);
	define("fecvalid",7);
	define("errormail",8);
	define("editaEx",9);
	define("errorNombExs",18);
	define("errorIng",35);
	
	if ($iRegequipo) 
	{
		/** Se asigna FALSE, ya que desde el formulario
		 *  siempre venda $flageditarequipo como TRUE 
		 */ 
		$flageditarequipo = 0;
//		**					**
		$iRegtabla["tablnomb"] = "equipo";
		$resulttabla = dinamicscantabla($iRegtabla,$nuconn);
		$num = fncnumreg($resulttabla);
		
		for($i=0;$i<$num;$i++)
		{
			$sbregtabla = fncfetch($resulttabla,$i);
			
			if($sbregtabla[tablnomb] == "equipo")
			{
				$tablcodi=$sbregtabla['tablcodi'];
				break;
			}
		}
		$iRegCampo["tablcodi"] = $tablcodi;
		$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
		$num = fncnumreg($resultcampo);
				
		while($elementos = each($iRegequipo))
		{ 
			$iRegCampo["campnomb"] = $elementos[0];
			$resultcampo = dinamicscancampo($iRegCampo,$nuconn);
			$num = fncnumreg($resultcampo);
			if($num>0)
			{
				$sbregcampo = fncfetch($resultcampo,0);
				if($elementos[0] != "equipocodigo")
				{
					if($sbregcampo["campnomb"] == $elementos[0])
					{
						$respuesta = strcmp($sbregcampo["campnotnull"],"t");
						if($respuesta == 0)
						{
							if($elementos[1] == "")
							{
								$campnomb[$elementos[0]] = 1;
								$flageditarequipo = 1;
								$flagerror = 1;
							}
						}
					}
				}
			}
			
			$validar = buscacaracter($elementos[1]);
			if($validar == 1) 
			{  
				$flageditarequipo = 1; 
				$flagerror = 1; 
				$campnomb[$elementos[0]] = 1;
				var_dump($elementos[0]); 
			}
			
			if($elementos[0] != 'equipofeccom' && $elementos[0] != 'equipovengar' && $elementos[0] != 'equipofecins'){			
//				$validresult = consulmetaequipo($elementos[0],$elementos[1],$nuconn);
				if ($validresult == 1)
				{
					$flageditarequipo = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
					unset ($validresult);
				}
			}
// comente esta parte si no quiere verificar el nombre
		/*	if($elementos[0]=='equiponombre')
			{
				if($elementos[1] != null)
				{
					$validnombre =  fncnombeditexs('equipo',$iRegequipo,$elementos[0],$elementos[1],'equipocodigo',$iRegequipo[equipocodigo],$nuconn);
					if ($validnombre == 1)
					{
						fncmsgerror(errorNombExs);
						$flageditarequipo = 1;
						$flagerror = 1;
						$campnomb[$elementos[0]] = 1;
						unset ($validnombre);
					}
				}
				else 
				{
					$flageditarequipo = 1;
					$flagerror = 1;
					$campnomb[$elementos[0]] = 1;
				}
			}
			*/
// Se debe comentar hasta aquí			
			
			if(($elementos[0] == 'tipequcodigo') && ($elementos[1] == ""))
			{
				$flageditarequipo = 1;
				$flagerror = 1;
				$campnomb[$elementos[0]] = 1;
			}
		}
		
		while ($element_cam = each($iRegequicamper)) {
			$validar_cam = buscacaracter($element_cam[1]);

			if($validar_cam == 1)
			{
				$flageditarequipo = 1;
				$flagerror = 1;
				$campnomb[$element_cam[0]] = 1;
			}
		}
		
		
		if($flagerror == 1)
		{
			fncmsgerror(errorIng);
		}

		if($flagerror != 1)
		{
			/*if (($iRegequipo[equipofeccom]) and ($fecactual))
			{
				$comparar = datecmp($iRegequipo[equipofeccom], $fecactual);
				
				if($comparar < 1)
				{
					if (($iRegequipo[equipofeccom]) and ($iRegequipo[equipofecins]))
					{
						$comparar = datecmp($iRegequipo[equipofeccom],$iRegequipo[equipofecins]);
						if($comparar < 1)
						{
							if(($iRegequipo[equipofeccom]) and ($iRegequipo[equipovengar]))
							{
								$comparar = datecmp($iRegequipo[equipofeccom],$iRegequipo[equipovengar]);

								if ($comparar < 1 )
								{*/
									$iRegequipo['equipocodigonv'] = $equipocodigonv;
									$result = uprecordequipo($iRegequipo,$nuconn);
									if($result < 0 )
									{
										ob_end_clean();
										fncmsgerror(errorReg);
										$flageditarequipo=1;
									}
									fncclose($nuconn);
									if($result > 0)
									{
										/*fncmsgerror(editaEx);
										echo '<script language="javascript">';
										echo '<!--//'."\n";
										echo 'location ="maestablequipo.php?codigo='.$codigo.';"';
										echo '//-->'."\n";
										echo '</script>';*/
									}
							/*	}
								else
								{
									if($comparar == 2)
									{
										ob_end_clean();
										fncmsgerror(fecvalid);
										$flageditarequipo = 1;
										unset($comparar);
									}
									else
									{
										ob_end_clean();
										fncmsgerror(venccomp);
										$flageditarequipo=1;
										$campnomb = "equipovengar";
										unset($comparar);
									}
								}
							}
							else
							{
								$result = uprecordequipo($iRegequipo,$nuconn);
								if($result < 0 )
								{
									ob_end_clean();
									fncmsgerror(errorReg);
									$flageditarequipo=1;
								}
								fncclose($nuconn);
								if($result > 0)
								{
									/*fncmsgerror(editaEx);

									echo '<script language="javascript">';
									echo '<!--//'."\n";
									echo 'location ="maestablequipo.php?codigo='.$codigo.';"';
									echo '//-->'."\n";
									echo '</script>';*/
					/*			}
							}
						}
						else
						{
							if($comparar == 2)
							{
								ob_end_clean();
								fncmsgerror(fecvalid);
								$flageditarequipo = 1;
								unset($comparar);
							}
							else
							{
								ob_end_clean();
								fncmsgerror(compinst);
								$flageditarequipo = 1;
								$campnomb = "equipofecins";
								unset($comparar);
							}
						}
					}
				}
				else
				{
					if($comparar == 2)
					{
						ob_end_clean();
						fncmsgerror(fecvalid);
						$flageditarequipo = 1;
						unset($comparar);
					}
					else
					{
						ob_end_clean();
						fncmsgerror(compactu);
						$flageditarequipo = 1;
						$campnomb = "equipofeccom";
						unset($comparar);
					}
				}
			}*/
		}
	}
}

$idcon = fncconn();
if($equipocodigo != $equipocodigonv)
	$rsEquipo = loadrecordequipo($equipocodigonv, $idcon);

if($rsEquipo > 0)
{	
	echo '<script language="javascript">';
	echo '<!--//'."\n";
	echo 'alert("El codigo de equipo '.$equipocodigonv.' ya se encuetra asignado a un activo")'."\n";
	echo '//-->'."\n";
	echo '</script>';
	$flageditarequipo = 1;
}
else
{
	$iRegequipo[equipocodigo] = trim($equipocodigo);
	$iRegequipo[estadocodigo] = trim($estadocodigo);
	$iRegequipo[sistemcodigo] = trim($sistemcodigo);
	$iRegequipo[cencoscodigo] = trim($cencoscodigo);
	$iRegequipo[equiponombre] = trim($equiponombre);
	$iRegequipo[equipodescri] = trim($equipodescri);
	$iRegequipo[equipofabric] = trim($equipofabric);
	$iRegequipo[equipomarca]  = trim($equipomarca);
	$iRegequipo[equipomodelo] = trim($equipomodelo);
	$iRegequipo[equiposerie]  = trim($equiposerie);
	$iRegequipo[equipolargo]  = trim($equipolargo);
	$iRegequipo[equipoancho]  = trim($equipoancho);
	$iRegequipo[equipoalto]   = trim($equipoalto);
	$iRegequipo[equipopeso]   = trim($equipopeso);
	$iRegequipo[equipovolta]  = trim($equipovolta);
	$iRegequipo[equipocorrie] = trim($equipocorrie);
	$iRegequipo[equipopoten]  = trim($equipopoten);
	$iRegequipo[equipofeccom] = trim($equipofeccom);
	$iRegequipo[equipocinv]   = trim($equipocinv);
	$iRegequipo[equipovengar] = trim($equipovengar);
	$iRegequipo[equipoviduti] = trim($equipoviduti);
	$iRegequipo[equipofecins] = trim($equipofecins);
	$iRegequipo[equipoubicac] = trim($equipoubicac);
	$iRegequipo[equipovalhor] = trim($equipovalhor);
	$iRegequipo[equiponohs]   = trim($equiponohs);
	$iRegequipo[equipoacti]   = trim($equipoacti);
	$iRegequipo[equipotipo]   = trim($equipotipo);
	$iRegequipo[equiponpas]   = trim($equiponpas);
	$iRegequipo[contracodigo] = trim($contracodigo);
	$iRegequipo[codigosrf] = trim($codigosrf);
	$iRegequipo[tipequcodigo] = trim($tipequcodigo);
	$iRegequipo[equiponivten] = trim($equiponivten);
	
	$arr_campers = explode(":|:",$arreglo_cam);
	foreach ($arr_campers as $x)
	{
		$arr_text = explode(":-:",$x);
		$iRegequicamper[$arr_text[0]] = $arr_text[1];
	}
	
	editaequipo($iRegequipo,$flageditarequipo,$campnomb,$codigo,$fecactual,$iRegequicamper, $equipocodigonv);
}

if(!$flageditarequipo)
{
	if($oldrutafoto && $rutafoto)
		unlink('../img/pics_equipos/'.$oldrutafoto);

		
	if(!$rutafoto)
		$rutafoto = $oldrutafoto; 
	
	$arr_img = explode('.', $rutafoto);
	rename('../img/pics_equipos/'.$rutafoto, '../img/pics_equipos/equipo'.$equipocodigonv.'.'.$arr_img[count($arr_img) - 1]);
	
	$equipocodigo = $equipocodigonv;
	
	if($iRegequicamper)
		include('editaequipocamperequipo.php');
		
	if($arreglo_aux)
		include('editanormaseguriequipo.php');
	
	include ('grabaequidocu.php');
	include('editausuaequipo.php');
}