<?php
/**
 
 **/
class Mobile extends CI_Model {

    /**
     
     **/
    public function __construct(){
        parent::__construct();
    }
	
	public function get_consejos(){
		$data = $this->db->get('consejos');
		if ($data->num_rows()>0){
			return $data->result();
		} else {
			return 0;
		}	
	}
	
	/*
	* metodo para el logueo de un usuario.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function login_user($username, $password){
		
		$this->db->where('medicoEmail',$username);
		$this->db->where('medicoPass',$password);
		$query= $this->db->get('medico');
		if($query->num_rows()>0){
			$resultado=$query->row();
			return $resultado->medicoId;
		}else{
			return 0;	
		}
		
	}
	
	/*
	* metodo para guardar un medico.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function save_register($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
	
}
