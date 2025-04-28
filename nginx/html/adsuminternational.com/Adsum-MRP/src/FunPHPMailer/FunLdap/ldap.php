<?php
/* 
    Propiedad intelectual de Adsum (c). 
    Funcion        :        direacti
    Descripcion    :	    Valida un usuario con LDAP o Directorio activo
    Parametros	   :        Descripcion 
  	$usuario				Usuario
  	$passwd					Password
    Retorno        : 		True/False
    Autor          :        ariascos 
    Fecha          :        22-oct-2008
    Historia de Modificaciones 
    Fecha	Autor	  Modificacion 
*/

function direacti($usuario, $passwd) {
$host      = "ldap.li.com.co";
$puerto   = 389;

$conex = ldap_connect($host,$puerto) or die ("No ha sido posible conectarse al servidor");

echo "<br>conexion: ".$conex;

$admin="uid=$usuario, ou=people, dc=grupo, dc=com";

if (ldap_set_option($conex, LDAP_OPT_PROTOCOL_VERSION, 3)) {
    echo "<br>Using LDAPv3";
} else {
   echo "<br>Failed to set protocol version to 3";
}

if ($conex) {
   // bind with appropriate dn to give update access
   $r=ldap_bind($conex, $admin, $passwd);
   
   if ($r)
       {echo "<br>Congratulations! $admin is authenticated.";}
   else
       {echo "<br>Nice try, kid. Better luck next time!";}

   ldap_close($conex);
} else {
   echo "<br>Unable to connect to LDAP server"; 
}


//	$server = "ldap.i.com.co";
//	$suffix = "o=li,c=co";
//	$ds = ldap_connect ( $server );
//	
//	if ($ds) {
//		$bindDN = "uid=$usuario";
//		$ldapBind = @ldap_bind ( $ds );
//		if (! $ldapBind) {
//			die ( 'No se pudo autenticar al servidor LDAP. Contacte al administrador.' );
//		}
//		
//		$sr = ldap_search ( $ds, $suffix, "uid=$usuario" );
//		if (! $sr) {
//			die ( 'Usuario no encontrado.' );
//		}
//		
//		$info = ldap_get_entries ( $ds, $sr );
//		$dn = $info [0] ["dn"];
//		
//		$ldapBind = @ldap_bind ( $ds, $dn, $passwd );
//		if (! $ldapBind) {
//			echo "<center><p class=titulo>Contrase&ntilde;a incorrecta.</p></center>";
//			exit ();
//		}
//		ldap_close ( $ds );
//	} else {
//		echo "<center><p class=titulo>No ha sido posible conectarse al servidor LDAP.</p></center>";
//		exit ();
//	}
//
//	
//	
//	
//	$ldaprdn = $usuario;
//	$ldappass = $passwd;
//	
//	$ldapconn = ldap_connect(ldap.li.com.co)
//	or die("Esto no se conecta");
//	
//	if ($ldapconn){
//		$ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);
//		if ($ldapbind){
//			echo "Se conecto.com";
//		} else { echo "Seguimos sin conectarnos";}
//	}
//
//
//
//	 $ldaprdn = $usuario."@li.co"; 
//	// $ldaprdn = $usuario;
//     $ldappass = $passwd; 
//     $ds = 'li.com.co'; 
//     $dn = 'dc=li,dc=com.co'; 
//     $puertoldap = 389; 
//     $ldapconn = ldap_connect($ds,$puertoldap) 
//     or die("ERROR: No se pudo conectar con el Servidor LDAP."); 
//     if ($ldapconn) 
//     { 
//       ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION,3); 
//       ldap_set_option($ldapconn, LDAP_OPT_REFERRALS,0); 
//       $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass); 
//       if ($ldapbind) 
//       { 
//         //echo "LDAP bind realizado correctamente...";
//         return 1;
//         /* $filter = "(cn=*)"; 
//         $fields = array("sn", "mail"); 
//         $sr = ldap_search($ldapconn, $dn, $filter, $fields); 
//         //$sr = ldap_search($ldapconn, $dn, $fields); 
//         $info = ldap_get_entries($ldapconn, $sr); 
//
//         echo("<br><br>Obtenidas ".$info["count"]."entradas. <br><br>"); 
//  
//         for ($i=0; $i<$info["count"]; $i++) 
//         {      
//           if(!empty($info[$i]["sn"][0])) echo "<br><br> Apellido: " . $info[$i]["sn"][0];      
//           if (!empty($info[$i]["mail"][0])) echo "<br> mail: " . $info[$i]["mail"][0]; 
//         } */
//       } 
//       else 
//       { 
//         return -1;
//       } 
//     } 
//     ldap_close($ldapconn);
}
?>
