<?php
/**
 * Parametros preconfigurables de PHP
 * Evitar los errores tipo Notice y Warning
 * CONSTANTES
 */
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
defined('PS') || define('PS', PATH_SEPARATOR); 
defined('SS') || define('SS', "/"); 

defined('ROOT_PATH') || define('ROOT_PATH', realpath(dirname(__FILE__).DS.'..'.DS.'..'));	// Define path to root path
defined('LIBRARY_JQUERY') || define('LIBRARY_JQUERY',  '../src/FunjQuery/JQuery');		// Define path to library directory
defined('TEMP_PATH') || define('TEMP_PATH', ROOT_PATH.DS.'temp');				// Define path to temp directory
defined('TEMP_RESOURCE') || define('TEMP_RESOURCE', 'temas');				// Define path to temp directory


// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    get_include_path(),
     realpath(ROOT_PATH),
)));


defined('e_connection') || define("e_connection",-1);
defined('e_db') || define("e_db",-2);
defined('e_empty') || define("e_empty",-3);

defined('cero') || define("cero",0);
defined('uno') || define("uno",1);
defined('dos') || define ("dos",2);


defined('n') || define("n",0);
defined('n1') || define("n1",1);
defined('n2') || define("n2",2);
defined('n3') || define("n3",3);
defined('n4') || define("n4", -3);
 
 
date_default_timezone_set('America/Bogota');




/**
 * Variables Generales del Software
 */
if (!ini_get('register_globals'))
{
	$types_to_register = array('GET','POST','COOKIE','SESSION','SERVER');
	foreach ($types_to_register as $type)
	{
		if(isset(${'_'.$type}))
		{
			if (@count(${'_'.$type}) > 0)
				extract(${'_'.$type}, EXTR_OVERWRITE);
		} 
		elseif(isset(${'HTTP_'.$type.'_VARS'}))
		{
			if (@count(${'HTTP_' . $type . '_VARS'}) > 0)
				extract(${'HTTP_' . $type . '_VARS'}, EXTR_OVERWRITE);
		}
	}
}

//Para definir variables necesarias para la carga del listado
$arrBase = explode(SS, $_SERVER['SCRIPT_NAME']);
$scrBase = str_replace('maestabl', '', str_replace('.php', '', $arrBase[count($arrBase) - 1]));
$arrFields = array('accionconsultar'.$scrBase , 'inicio', 'fin', 'mov', 'recarreglo', 'flagcheck', 'arr_borrar', 'camporderby', 'idtrans', 'cantrow', 'intervalo');

foreach($arrFields as $value)
	if(!isset($$value)) $$value = null;
//Para definir variables necesarias para la carga del listado

//Para definir variables de orden de trabajo
$arrFields = array('solsercodigo','solsermotivo','otestacodigo','plantacodigo','sistemcodigo','equipocodigo','componcodigo','partecodigo','caufallcodigo','tipfalcodigo',
'tipmancodigo','prioricodigo','tareacodigo','tiptracodigo');

foreach($arrFields as $value)
	if(!isset($$value)) $$value = null;
//Para definir variables de orden de trabajo	
	
	
