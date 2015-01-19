<?php if(! defined('BASEPATH')) exit('No script access allowed');

class Mobiles extends MX_Controller {

    /**
     * Construct where can declare all the files will
     * be used in all the class
     **/
    public function __construct(){
        parent::__construct();
        $this->load->model('Mobile', '', TRUE);
        $this->load->helper(array('mobiles'));
    }

  
	
	/*
	* 
	* autor:jalomo<jalomo@hotmail.es>
	*/
	public function get_consejos()
    {	
		$data = $this->Mobile->get_consejos();
        echo json_encode($data);
		
    }
	
	
	/*
	* login para el usuario .retorna 0 cuando el usuari ono existe.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function login_user(){
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		if(isset($username) && isset($password)){
			$reult=$this->Mobile->login_user($username, $password);
			echo $reult;
			
		}else{
			echo 0;	
		}
	}
	
	/*
	* metodo para guardar un medico .
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function save_doctor(){
		$medicoNombre=$this->input->post('medicoNombre');
		$medicoCedula=$this->input->post('medicoCedula');
		$medicoTelefono=$this->input->post('medicoTelefono');
		$medicoCelular=$this->input->post('medicoCelular');
		$medicoEmail=$this->input->post('medicoEmail');
		$medicoPass=$this->input->post('medicoPass');
		$medicoDomicilio=$this->input->post('medicoDomicilio');
		
		
		$data['medicoNombre']=$medicoNombre;
		$data['medicoCedula']=$medicoCedula;
		$data['medicoTelefono']=$medicoTelefono;
		$data['medicoCelular']=$medicoCelular;
		$data['medicoEmail']=$medicoEmail;
		$data['medicoPass']=$medicoPass;
		$data['medicoDomicilio']=$medicoDomicilio;
		
		
		$id=$this->Mobile->save_register('medico', $data);
		echo $id;
	}
	
	/*
	* metodo para registrar un dispositivo. 
	* autor: jalomo <jalomo@hotmail.es>
	*/
	 public function RegisterUser_V1(){
       
        $dispositivo = $this->input->post('device');
        $token = $this->input->post('token');
        if( isset($dispositivo) && isset($token)){
            $array = array('usuario_fecha'=>date('d-m-Y hh:mm:ss'),
                           'usuario_device'=>$dispositivo,
                           'usuario_token'=>$token);

            $id=$this->Mobile->save_register('usuarios', $array);
            echo $id;
        }
        else{
            echo "-1";
        }
    }
	
}
