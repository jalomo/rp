<?php


class msgios {

    var $conexion;

    function Conectar_Mysql()
    {
         if(!($con = @mysql_connect("localhost", "zavord5_pato", "patologia123"))){
            echo "Error en la conexion a la base de datos";
            exit();
        }
        else{
            //echo "Conexion exitosa";
        }

        if(!mysql_select_db("zavord5_patologia", $con)){
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
        $message =$this->getSpecificMessage($id);
        if($users != false || !empty($users))
        {//start if
            while($dispositivos = mysql_fetch_array($users)){//start while 
                //echo $dispositivos["usuariosToken"];
                if(strcmp($dispositivos["usuario_token"], "(null)")){
                    $passphrase = 'zavordigital';
                    $deviceToken = $dispositivos["usuario_token"];
                	$ctx = stream_context_create();
	            	stream_context_set_option($ctx, 'ssl', 'local_cert', 'ckpatologia.pem');
                    stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
                    $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err,
                        $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
                        
    	            if(!$fp)
                        exit("Failed to connect: $err $errstr" . PHP_EOL);
                    
                    $body['aps'] = array(
            		    'alert' => $message,
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
                }
            }//end while
			
        }//end if
    }

    function getAllUsersDevices()
    {
        $sql = "select distinct usuario_token from usuarios where usuario_device='IOS'";
        $resultado = mysql_query($sql, $this->conexion);
        return $resultado;
    }

    function getSpecificMessage($id)
    {
        $sql = "select * from notificaciones where notificacionId = ".$id;
        $resultado = mysql_query($sql, $this->conexion);
        $datos = mysql_fetch_array($resultado);
		
		
		$datos['notificacionTexto'] = str_replace("�", "a", $datos['notificacionTexto']);
            $datos['notificacionTexto'] = str_replace("�", "e", $datos['notificacionTexto']);
            $datos['notificacionTexto']= str_replace("�", "i", $datos['notificacionTexto']);
            $datos['notificacionTexto']= str_replace("�", "o", $datos['notificacionTexto']);
            $datos['notificacionTexto']= str_replace("�", "u", $datos['notificacionTexto']);
            $datos['notificacionTexto'] = str_replace("�", "A", $datos['notificacionTexto']);
           $datos['notificacionTexto'] = str_replace("�", "E", $datos['notificacionTexto']);
            $datos['notificacionTexto']= str_replace("�", "I", $datos['notificacionTexto']);
            $datos['notificacionTexto'] = str_replace("�", "O", $datos['notificacionTexto']);
            $datos['notificacionTexto'] = str_replace("�", "U",$datos['notificacionTexto']);
           $datos['notificacionTexto']= str_replace("�", "n", $datos['notificacionTexto']);
           $datos['notificacionTexto'] = str_replace("�", "N", $datos['notificacionTexto']);
            $datos['notificacionTexto'] = str_replace("...", "...", $datos['notificacionTexto']);
           $datos['notificacionTexto']= str_replace("&quot;", '"', $datos['notificacionTexto']);
            $datos['notificacionTexto'] = str_replace("�", " ", $datos['notificacionTexto']);
            $datos['notificacionTexto'] = str_replace(" ", " ", $datos['notificacionTexto']);
           $datos['notificacionTexto'] = str_replace(" ", ' ', $datos['notificacionTexto']);
            $datos['notificacionTexto'] = str_replace(" ", ' ', $datos['notificacionTexto']);
            $datos['notificacionTexto'] = str_replace("�", " ", $datos['notificacionTexto']);
           $datos['notificacionTexto'] = str_replace("�", " ", $datos['notificacionTexto']);
		
		
        return $datos['notificacionTexto'];
		
    }
}

$idMessage = $_GET['id'];
$msg = new msgios();
$msg->sendDataMessage($idMessage);



