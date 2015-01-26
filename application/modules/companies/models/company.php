<?php
/**

 **/
class Company extends CI_Model{

    /**

     **/
    public function __construct()
    {
        parent::__construct();
    }
	
	public function save_register($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
	
	/*
	* metodo para crear un codigo de barras para un usuario.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function createNewCodigo(){
		$patron;
        $query="SELECT codigo FROM codigo WHERE id = 1";
        $res= $this->db->query($query);
        foreach ($res->result() as $row) {
         	$patron = $row->codigo;
               
         }

        $left= rand(100,999); 
        $right= rand(100,999);
        $codigo = "".$left.$patron.$right;
        
         $data = array('codigo'=>$patron+1);
         $this->db->where('id',1);
         $res =  $this->db->update('codigo',$data);


        return $codigo;
	}

	
	/*
	* metodo para obtener el nombre de las ciudades.
	* autor: jalom <jalomo@hotmail.es>
	*/
	public function get_name_ciudad($id_ciudad){
		$this->db->where('ciudadId',$id_ciudad);
		$query=$this->db->get('ciudades');
		if($query->num_rows()>0){
			$res=$query->row();
			return $res->ciudadNombre;
		}else{
			return 'sin nombre';
		}	
	}
		
	/*
	* metodo para obtener el precio de un evento segun su ciodad y 
	* el sexo del usuario.
	* sexo 1= hombre, sexo 0= mujer
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_precio_evento($id_evento,$id_ciudad,$sexo){
		$evento=$this->get_specific_eventos($id_evento);
		$aux=explode('--',$evento->eventoCiudad);
		$auxCount=count($aux)-1;
		$row=0;
		$precio=0;
		for($i=0;$i<$auxCount;$i++):
			if($aux[$i]==$id_ciudad):
				$row=$i;
				break;
			endif;	
		endfor;
		
		
		if($sexo==1){
			$auxH=explode('--',$evento->eventoPrecioBase);
			$precio=$auxH[$row];
		
		}else{
			$auxM=explode('--',$evento->eventoPrecioBaseM);	
			$precio=$auxM[$row];
		}
		return $precio;
		
	}
	
	/*
	* metodo para obtener los modificadores de un evento.
	* autor: jalomo <jalomo@hotmail.es>
	* sexo 1= hombre, sexo 0= mujer
	*/
	public function get_modificadores_evento($id_evento,$sexo){
		$this->db->where('modificadorIdEvento',$id_evento);
		if($sexo==1){
			$this->db->select('modificadorId, modificadorNombre, modificadorPrecio,modificadorStatus,modificadorPuntos,modificadorTipo');
		}else{
			$this->db->select('modificadorId, modificadorNombre, modificadorPrecioM as modificadorPrecio,modificadorStatus,modificadorPuntos,modificadorTipo');
		}
		$query=$this->db->get('modificadores');
		
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return 0;	
		}
	}
	
	/*
	* metodo para obtener volcado de todos lo eventos.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_eventos(){
		$query=$this->db->get('eventos');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return 0;	
		}	
	}
	
	/*
	* metodo para obtener los modificadores de un evento.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_modificadores_evnto($id_evento){
		$this->db->where('modificadorIdEvento',$id_evento);
		$query=$this->db->get('modificadores');
		if($query->num_rows()>0){
			return $query->result();	
		}else{
			return 0;
		}	
	}
	
	/*
	* metodo para editar na fila de la tabla eventosusuarios.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function edita_eventosusuarios($id,$data){
		$this->db->update('eventosusuarios', $data, array('euId'=>$id));
	}
	
    /*
	* metodo para obtener los paises.
	* autor: jalomo@hotmail.es
	*/
	public function get_paises(){
		$query=$this->db->get('pais');
		return $query->result();	
	}

	public function get_paises_array(){
		$query=$this->db->get('pais');
		$res =$query->result();	
		foreach($res as $pais):
			$data[$pais->id]=$pais->nombre;
		endforeach;
		return $data;
	}
	
	/*
	* metodo para obtener los estados.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_estados(){
		$this->db->where('id_pais',42);
		$query=$this->db->get('estado');	
		return $query->result();
	}

	public function get_estados_array(){
		$this->db->where('id_pais',42);
		$query=$this->db->get('estado');	
		$res =$query->result();
		foreach($res as $estado):
			$data[$estado->id]=$estado->nombre;
		endforeach;
		return $data;
	}

	/*
	* metodo para obtener volcado de usuarios de un vendedor.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_usuarios_rp($id_rp){
		$this->db->where('usuarioIdAdmin',$id_rp);
		$query=$this->db->get('usuarios');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return 0;
		}
	}

	
	/*
	* metodo para obtener los estados de un país 
	+ autor:jalomo <jalomo@hotmail.es>
	*/
	public function get_estados_id($id){
		$this->db->where('id_pais',$id);
		$query=$this->db->get('estado');	
		return $query->result();
	}
	
	/*
	* metodo para obtener el nombre del estado
	*/
	public function get_name_pais($id){
		$this->db->where('id',$id);
		$query=$this->db->get('pais');
		$resultado=$query->row();
		return $resultado->nombre;
			
	}
	
	public function get_name_estado($id){
		$this->db->where('id',$id);
		$query=$this->db->get('estado');
		$resultado=$query->row();
		return $resultado->nombre;
			
	}
	
	/*
	*metodo para obtener las ciudades.
	* autor: jalomo <jalomo@hotmail.rd>
	*/
	public function get_ciudades(){
		$this->db->where('ciudadStatus',0);
		$query=$this->db->get('ciudades');
		return $query->result();
	}

	public function get_ciudades_array(){
		$this->db->where('ciudadStatus',0);
		$query=$this->db->get('ciudades');
		$res= $query->result();
		foreach($res as $estado):
			$data[$estado->ciudadId]=$estado->ciudadNombre;
		endforeach;
		return $data;
	}




	/*
	* metodo para validar el email del usuario.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function valida_email($email){
		$this->db->where('usuarioEmail',trim($email));
		$query=$this->db->get('usuarios');
		if($query->num_rows()>0){
			return 1;
		}else{
			return 0;	
		}	
	}

	/*
	* metodo para obtener el nombre de un usuario.
	* aurtor: jalomo <jalomo@hotmail.es>
	*/
	public function name_user($id){
		$this->db->where('usuarioId',$id);
		$query=$this->db->get('usuarios');
		if($query->num_rows()>0){
			$res=$query->row();
			return $res->usuarioNombre;
		}else{
			return 0;	
		}	
	}

	/*
	* metodo para obtener el email de un usuario por medio de su id.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_email_user($id){
		$this->db->where('usuarioId',$id);
		$query=$this->db->get('usuarios');
		if($query->num_rows()>0){
			$res=$query->row();
			return $res->usuarioEmail;
		}else{
			return 0;	
		}	
	}

	/*
	* metodo para obtener los datos de un usuario.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_usuario_id($id_usuario){
		$this->db->where('usuarioId',$id_usuario);
		$query=$this->db->get('usuarios');
		if($query->num_rows()>0){
			$res=$query->row();
			return $res;
		}else{
			return 0;	
		}	
	}


	/*
	* metodo para obtener los eventos  de un usuario.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_eventos_user_id($id_usuario){
		$this->db->where('euIdUsuario',$id_usuario);
		$query=$this->db->get('eventosusuarios');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return 0;	
		}	
	}

	/*
	* metodo para obtener volcado de eventos que el rp tiene de 
	* sus clientes.
	*/
	public function eventos_user_ventas($id_usuario){
		$this->db->where('euIdVendedor',$id_usuario);
		$query=$this->db->get('eventosusuarios');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return 0;	
		}	
	}
	
	/*
	* volcado de los clinetes por eventos y por RP.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function eventos_user_ventas_id($id_usuario,$evento){
		
		if($evento==0):
			$this->db->where('euIdVendedor',$id_usuario);
		else:	
			$this->db->where('euIdVendedor',$id_usuario);
			$this->db->where('euIdEvento',$evento);
		endif;
		$query=$this->db->get('eventosusuarios');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return 0;	
		}	
	}


	/*
	* metodo para obtener informacion de una fila de la tabla eventosusuarios.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function eventosusuarios_id($id){
		$this->db->where('euId',$id);
		$query=$this->db->get('eventosusuarios');
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return 0;	
		}	
	}

	/*
	* metodo para obtener los modificadores de un evento de la tabala moduser.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_moduser($id_eventosusuarios){
		$this->db->where('rowEventosUsuarios',$id_eventosusuarios);
		$query=$this->db->get('moduser');
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return 0;
		}
	}


	/*
	* metodo para obtener el nombre de un evento.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_name_evento($id){
        $this->db->where('eventoId', $id);
        $data = $this->db->get('eventos');
        $res= $data->row();
        return $res->eventoNombre;
    }

	
	/*
	*Metodo para obtener la informacion
	*de las notificaciones
	*autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_notificaciones(){
		$data = $this->db->get('notificaciones');
		if ($data->num_rows() > 0){
        	return $data->result();
		} else {
			return 0;
		}	
	}
	
	
	/*
	*Metodo para guardar la informacion
	*de las notificaciones
	*autor jalomo <jalomo@hotmail.es>
	*/
	public function save_notificacion($data){
		$this->db->insert('notificaciones', $data);
        return $this->db->insert_id();
	}
	
	/*
	*Metodo para obtener la informacion
	* de las noticias
	autor: jalomo <jalmo@hotmail.es>
	*/
	public function get_noticias(){
		$data = $this->db->get('noticias');
		if ($data->num_rows()>0){
			return $data->result();
		} else {
			return 0;
		}		
	}
	
	/*
	*Metodo para guardar la informacion
	* del registro del administrador
	*autor jalomo <jalomo@hotmail.es>
	*/
	public function save_admin($data){
		$this->db->insert('admin', $data);
        return $this->db->insert_id();
	}
	
	
	
	/**
     * Method for take all the notifications and the user can
     * see the information that was sent before ago.
	 *
     **/
    public function get_all_list_notifications()
    {
        $data = $this->db->get('notificaciones');
        return $data->result();
    }
	
	
	 /**
     * Method for get the specific data of the notifications
     * and can show all the information for the user 
     * and know what is the message to sent
     *
     * @params int idNotification
     * @return array mixedData
     *
     **/
    public function get_specific_notification($id)
    {
        $this->db->where('notificacionId', $id);
        $data = $this->db->get('notificaciones');
        return $data->row();
    }
	
	/**
     * Method for load all the information about the news and can
     * show then in the mobile app, this for can show in the list
     * to the user admin as well.
     **/
    public function save_news($data){
        $this->db->insert('noticias', $data);
        return $this->db->insert_id();
    }
	
	
	/*
	* funcion para obtener los datos de 
	* un reguistro de la tabla eventos
	*/
	public function get_specific_eventos($id){
        $this->db->where('eventoId', $id);
        $data = $this->db->get('eventos');
        return $data->row();
    }
	
	/**
     * Method for load all the information for can see the data
     * will be update by the user admin and then can show the
     * updates in the mobile app
     *
     * @params array mixedData
     * @params int idNews
     *
     * @return void
     **/
    public function update_news($data, $id){
        $this->db->update('noticias', $data, array('noticiasId'=>$id));
    }
	
	
	/*
	* funcion para editar un registro de la tabla eventos
	*/
	public function update_eventos($data, $id){
        $this->db->update('eventos', $data, array('eventosId'=>$id));
    }
	
	 /**
     * Method for delete the specific notification and the user can
     * see how drop or how to hide the information wants to delete
     * once confirm the dialog box
     *
     * @params int idNotification
     * @return void
     **/
    public function delete_specific_notification($id)
    {
        $this->db->delete('notificaciones', array('notificacionId'=>$id));
    }
	
	
	/*
	* 
	*/
	public function count_results_users($user, $pass)
    {
        $this->db->where('adminUsername', $user);
        $this->db->where('adminPassword', $pass);
        $total = $this->db->count_all_results('admin');
        return $total;
    }
	
	/*
	*
	*/
	public function get_all_data_users_specific($username, $pass)
    {
        $this->db->where('adminUsername', $username);
        $this->db->where('adminPassword', $pass);
        $data = $this->db->get('admin');
        return $data->row();
    }
	

}
