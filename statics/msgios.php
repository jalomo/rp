<?php

class msgios {

    var $conexion;

    function Conectar_Mysql()
    {
        if(!($con = @mysql_connect("localhost", "zavord5_sirloinS", "sirloinZavor777"))){
            echo "Error en la conexion a la base de datos";
            exit();
        }
        else{
            //echo "Conexion exitosa";
        }

        if(!mysql_select_db("zavord5_sirloinStockade", $con)){
            echo "Error en la seleccion de la base de datos";
            exit();
        }
        else{
            //echo "Seleccion exitosa";
        }
 
        return $con;
    }
    
    function sendDataMessage($id)
    {
        $this->conexion = $this->Conectar_Mysql();
        $users = $this->getAllUsersDevices();
        $mensaje = $this->getSpecificMessage($id);
        if($users != false || !empty($users))
        {//start if
            while($dispositivos = mysql_fetch_array($users)){//start while
                $passphrase = 'zavordigital';//'zavorD5'
                $deviceToken = $dispositivos["usuariosDeviceId"];
        		$ctx = stream_context_create();
	        	stream_context_set_option($ctx, 'ssl', 'local_cert', 'ckSirloin.pem');//'sirloin.pem'
                stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
                $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err,//'ssl://gateway.sandbox.push.apple.com:2195'
                                    	   $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
    	    	if(!$fp)
                    exit("Failed to connect: $err $errstr" . PHP_EOL);

                $body['aps'] = array(
	    		    'alert' => $mensaje,
    	    		'sound' => 'default'
                );
                
                $payload = json_encode($body);
                
                $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

                $result = fwrite($fp, $msg, strlen($msg));
                
                if(!$result)
                	echo '0';
                else
                    echo '1';

                fclose($fp);
           }//end while
		   echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
        }//end if
    }

    function sendDataPromotion($id){
        $this->conexion = $this->Conectar_Mysql();
        $users = $this->getAllUsersDevices();
        $mensaje = $this->getSpecificPromotion($id);
        if($users != false || !empty($users))
        {//start if
            while($dispositivos = mysql_fetch_array($users)){//start while
                $passphrase = 'zavordigital';
                $deviceToken = $dispositivos["usuariosDeviceId"];
        		$ctx = stream_context_create();
	        	stream_context_set_option($ctx, 'ssl', 'local_cert', 'ckSirloin.pem');
                stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
                $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err,
                                    	   $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
    	    	if(!$fp)
                    exit("Failed to connect: $err $errstr" . PHP_EOL);

                $body['aps'] = array(
	    		    'alert' => $mensaje,
    	    		'sound' => 'default'
                );
                
                $payload = json_encode($body);
                
                $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

                $result = fwrite($fp, $msg, strlen($msg));
                
                if(!$result)
                	echo '0';
                else
                    echo '1';

                fclose($fp);
            }//end while
			echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
        }//end if
    }

    function getAllUsersDevices()
    {
        $sql = "select * from usuarios where usuariosSO='IOS'";
        $resultado = mysql_query($sql, $this->conexion);
        return $resultado;
    }

    function getSpecificMessage($id)
    {
        $sql = "select * from notificaciones where notificacionesId = ".$id;
        $resultado = mysql_query($sql, $this->conexion);
        $datos = mysql_fetch_array($resultado);
        return $datos['notificacionesText'];
    }

    function getSpecificPromotion($id){
        $sql = "select * from promociones where promocionesId = " . $id;
        $resultado = mysql_query($sql);
        $datos = mysql_fetch_array($resultado);
        return $datos['promocionesMensaje'];
    }
}

$idMessage = $_GET['id'];
$seccion = $_GET['seccion'];
$msg = new msgios();
if($seccion == 1 || $seccion == '1'){
    $msg->sendDataMessage($idMessage);
}
else{
    $msg->sendDataPromotion($idMessage);
}
