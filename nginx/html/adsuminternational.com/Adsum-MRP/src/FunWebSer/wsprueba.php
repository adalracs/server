<?php 
    ini_set('default_socket_timeout', 160);
    require_once('lib/nusoap.php');

    $wsdl='http://epm.satrack.com/webserviceeventos/getEvents.asmx?WSDL';
    $client=new soapclient($wsdl,true);
    $client -> response_timeout = 1800;
    $err=$client->getError();

    if($err){

      echo "error 1111";

    }else{

      $vehiculo=array('InitialYear' => 2010,'InitialMonth' => 05, 'InitialDay' => 01);
      $respuesta=$client->call("GetKilometer",$vehiculo);

      if($client->fault){

        var_dump($respuesta);

      }else{
        $error=$client->getError();
      }

      if($error){

        echo "hay algun error  ".$error;
      }else{

        echo "respuesta";
        //var_dump($respuesta);

      }

   }


?>