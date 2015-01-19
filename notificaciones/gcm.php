<?php 
class gcm {
    var $conexion;

    function Conectar_Mysql()
    {
        if(!($con = @mysql_connect("localhost", "zavord5_pato", "patologia123"))){
            echo "Error en la conexion a la base de datos";
            exit();
        }
        else
        {
            //echo "";
        }

        if(!mysql_select_db("zavord5_patologia", $con)){
            echo "Error en la seleccion de la base de datos";
            exit();
        }
        else
        {
            //echo "";
        }

        return $con;
    }

    function sendDataMessage($id)
    {
        $this->conexion = $this->Conectar_Mysql();
        $users = $this->getAllUsersDevices();
        $message = $this->getSpecificMessage($id);
        if($users != false || !empty($users)){
            while($dispositivos = mysql_fetch_array($users)){
                $apiKey = 'AIzaSyALnky3Lbz9pkm2ofmPGDvwBnrVTfjmDag';
                $userIdentificador = $dispositivos["usuario_token"];
                $headers = array('Authorization:key=' . $apiKey);
                $data = array(
                    'registration_id' => $userIdentificador,
                    'collapse_key' => $collapseKey,
                    'data.message' => $message);
  
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send");
                if($headers){
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                    $response = curl_exec($ch);
                    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    if(curl_errno($ch)){
                        echo 'fail';
                    }
                    if($httpCode != 200){
                        echo 'status code 200';
                    }
                    curl_close($ch);
                    echo "1";
                } 
                else 
                {
                   echo 'no user';
                }
            }
        }
    }

    function getAllUsersDevices()
    {
        $sql = "select distinct usuario_token from usuarios where usuario_device='ANDROID'";
        $resultado = mysql_query($sql, $this->conexion);
        return $resultado;
    }

    function getSpecificMessage($id)
    {
        $sql = "select * from notificaciones where notificacionId = " . $id;
        $resultado = mysql_query($sql, $this->conexion);
        $datos = mysql_fetch_array($resultado);
		
		
        return $datos['notificacionTexto'];
    }
}

$messageId = $_GET['id'];
$google = new gcm();
$google->sendDataMessage($messageId);
