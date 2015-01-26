<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**

 **/
class Companies extends MX_Controller {

    /**
     
     **/
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Company', '', TRUE);
        $this->load->library(array('session'));
        $this->load->helper(array('form', 'html', 'companies', 'url'));
    }
	
	public function index(){

        $content = $this->load->view('companies/index', '', TRUE);
        $this->load->view('main/template', array('aside'=>'',
                                                       'content'=>$content,
                                                       'included_js'=>array('statics/js/modules/login.js')));
		
	}
	
	/*
	*metodo para crear usuarios 
	*administradores
	*autor: jalomo <jalomo@hotmail.es>
	*/
	public function crear_admin(){
	
        $this->load->view('companies/registro_admin');
  
	}
	
	/**
     *metodo para guardar el registro del
	 *administrador
     * 
     **/
    public function guarda_admin()
    {
        $post = $this->input->post('Registro');
        if($post)
        {
            $pass = encrypt_password($post['adminUsername'],
                                     $this->config->item('encryption_key'),
                                     $post['adminPassword']);
            $post['adminPassword'] = $pass;
            $post['adminStatus'] = 1;
			$post['adminFecha']=date('Y-m-d');
            $id = $this->Company->save_admin($post);
            echo $id;
        }
        else{
        }
    }
	
	/*
	*metodo para checar el login y la contraseña
	*/
	public function checkDataLogin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if(isset($username) && isset($password) && !empty($password) && !empty($username))
        {
            $pass = encrypt_password($username,
                                     $this->config->item('encryption_key'),
                                     $password);
            $total = $this->Company->count_results_users($username, $pass);
            if($total == 1)
            {
                echo "1";
            }
            else{
                echo "0";
            }
        }
        else{
            redirect('companies');
        }
    }
	
	/*
	*metodo para inicio de session
	*/
	public function mainView()
    {
        $post = $this->input->post('Login');
        if(isset($post) && !empty($post))
        {
            $pass = encrypt_password($post['adminUsername'],
                                     $this->config->item('encryption_key'),
                                     $post['adminPassword']);
            $dataUser = $this->Company->get_all_data_users_specific($post['adminUsername'], $pass);

            $array_session = array('id'=>$dataUser->adminId);
            $this->session->set_userdata($array_session);

            if($this->session->userdata('id'))
            {
				redirect('companies/crear_usuario');
                /*$aside = $this->load->view('companies/left_menu', '', TRUE);
                $content = $this->load->view('companies/main_view', '', TRUE);
                $this->load->view('main/template', array('aside'=>$aside,
                                                         'content'=>'',
														 'included_js'=>array('statics/js/modules/menu.js')));*/
            }
            else{
            }
        }
        else{
        }
    }
	
	/*
	*metodo donde el usuario crea las 
	*notificaciones.
	*/
	public function crear_nota(){
	 if($this->session->userdata('id'))
        {	
		$aside = $this->load->view('companies/left_menu', '', TRUE);
        $content = $this->load->view('companies/crear_notificacion', '', TRUE);
        $this->load->view('main/template', array('aside'=>$aside,
                                                       'content'=>$content,
                                                       'included_js'=>array('statics/js/libraries/form.js','statics/js/modules/notificaciones.js')));
		}
        else{
            redirect('companies');
        }											   
		
	}
	
	/*
	*Metodo para guardar la notificacion
	*/
	public function save_notificacion(){
		
		if($this->session->userdata('id'))
        {
            $post = $this->input->post('notificacion');
            if(isset($post) && !empty($post)){
                $post['notificacionFecha'] = date('Y-m-d');
                $id = $this->Company->save_notificacion($post);
				echo $id;
            }
        }
        else{
            redirect('companies');
        }
	
	}
	
	/**
     * Method used for can see the list of all the information about
     * the notifications will sent by the user admin and can delete or
     * just see the information about the message was sent
     **/
    public function lista_notas(){
        if($this->session->userdata('id')){
            $data['notificaciones'] = $this->Company->get_all_list_notifications();
            $aside = $this->load->view('companies/left_menu', '', TRUE);
            $content = $this->load->view('companies/lista_notas', $data, TRUE);
            $this->load->view('main/template', array('aside'=>$aside,
                                                     'content'=>$content,
                                                     'included_js'=>array('statics/js/libraries/form.js','statics/js/modules/notificaciones.js')));
        }
        else{
            redirect('companies');
        }
    }
	
	
	
	

	
	
	
	
	
	
	/**
     * Method for show all the information typed by the user for
     * notify to another users some news that want to
     * give the users of the mobile app
     *
     * @params int idNotification
     * @return void
	 *
     **/
    public function viewNotification($id){
        if($this->session->userdata('id')){
            $data['notificacion'] = $this->Company->get_specific_notification($id);
            $aside = $this->load->view('companies/left_menu', '', TRUE);
            $content = $this->load->view('companies/ver_notificaciones', $data, TRUE);
            $this->load->view('main/template', array('aside'=>$aside,
                                                     'content'=>$content,
                                                     'included_js'=>array('statics/js/libraries/form.js','statics/js/modules/notificaciones.js')));
        }
        else{
            redirect('companies');
        }
    }
	
	/**
     * Method for know what is the value required for
     * delete a specific notification to need delete for
     * the system don't content the notification
     *
     * @params int idNotification
     * @erturn void
     **/
    public function deleteNotification($id)
    {
        if($this->session->userdata('id')){
            $this->Company->delete_specific_notification($id);
        }
        else{
            redirect('companies');
        }
    }
	
	


/*
* metodo para crear un usuario.
* autor: jalomo <jalomo@hotmail.es>
*/
public function crear_usuario(){
     if($this->session->userdata('id'))
        {   

        $data['paises']=$this->Company->get_paises();
        $data['estados']=$this->Company->get_estados();
        $data['ciudades']=$this->Company->get_ciudades();

        $aside = $this->load->view('companies/left_menu', '', TRUE);
        $content = $this->load->view('companies/crear_usuario', $data, TRUE);
        $this->load->view('main/template', array('aside'=>$aside,
                                                       'content'=>$content,
                                                       'included_js'=>array('statics/js/libraries/form.js')));
        }
        else{
            redirect('companies');
        }  

}

public function get_estados_cliente($idpais){
        
        $estados=$this->Company->get_estados_id($idpais);
        
        $resultado='<select  name="user[usuarioEstado]" class="form-control">';
        foreach($estados as $estado):
            $resultado.='<option values="'.$estado->id.'">'.$estado->nombre.'</opntion>';
        endforeach;
        $resultado.='<select>';
        echo $resultado;
    
    }


    /*
    * metodo para validar un email delusuario.
    * autor: jalomo <jalomo@hotmail.es>
    */
    public function  validate_email_user(){
        $email = $this->input->post("email");
        $res=$this->Company->valida_email($email); 
        echo $res;
    }

    public function save_usuario(){
        
        
        $post=$this->input->post('save');
        $reultaod=$this->Company->save_register('usuarios', $post);
        
        $message_to_send="Hola ".$post['usuarioNombre']." Bienvenido a conexion, este es tu nombre de usuario :  ".$post['usuarioEmail']."   y yu contraseña :".$post['usuarioPassword']."";
        
        $this->load->library('email');
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $this->email->initialize($config);                                             
    
                //SEND THE EMAIL
        $this->email->from('gregorio@divestis.com', 'REGISTRO CONEXION');
        $this->email->to($post['usuarioEmail']);
        $this->email->subject('usuario y contraseña conexion');
        $this->email->message($message_to_send);
        $this->email->send();
        // echo $this->email->print_debugger();
        $this->email->clear();
                
           
    }
    


    /*
    * metodo para obtener volcado de usuario de un vendedor.
    * autor: jalomo <jalomo@hotmail.es>
    */

    public function lista_usuarios(){
         if($this->session->userdata('id'))
            {   

           
            $data['usuarios']=$this->Company->get_usuarios_rp($this->session->userdata('id'));

            $aside = $this->load->view('companies/left_menu', '', TRUE);
            $content = $this->load->view('companies/lista_usuarios', $data, TRUE);
            $this->load->view('main/template', array('aside'=>$aside,
                                                           'content'=>$content,
                                                           'included_js'=>array('statics/js/libraries/form.js')));
            }
            else{
                redirect('companies');
            }  

    }
	
    /*
    * metodo para ver la informacion de un usuario y vender un boleto.
    * autor: jalomo <jalomo@hotmail.es> 
    */
    public function ver_usuario($id_usuario){
     if($this->session->userdata('id'))
        {   

        
        $data['paises']=$this->Company->get_paises_array();
        $data['estados']=$this->Company->get_estados_array();
        $data['ciudades']=$this->Company->get_ciudades_array();
        $data['usuario']=$this->Company->get_usuario_id($id_usuario);    
        $aside = $this->load->view('companies/left_menu', '', TRUE);
        $content = $this->load->view('companies/ver_usuario', $data, TRUE);
        $this->load->view('main/template', array('aside'=>$aside,
                                                       'content'=>$content,
                                                       'included_js'=>array('statics/js/libraries/form.js')));
        }
        else{
            redirect('companies');
        }  

}


    /*
    * ver ventas del usuario, aqui van a poder abonar los baucher del banco
    * autor: jalomo <jalomo@hotmail.es>
    */
    public function usuario_ventas($id_usuario){
         if($this->session->userdata('id'))
            {   

            
           
            $data['usuario']=$this->Company->get_usuario_id($id_usuario);  
            $data['eventos']=$this->Company->get_eventos_user_id($id_usuario);    
            $aside = $this->load->view('companies/left_menu', '', TRUE);
            $content = $this->load->view('companies/usuario_ventas', $data, TRUE);
            $this->load->view('main/template', array('aside'=>$aside,
                                                           'content'=>$content,
                                                           'included_js'=>array('statics/js/libraries/form.js')));
            }
            else{
                redirect('companies');
            }  

    }

    /*
    * metodo para crear una categoria.
    * autor: jalomo <jalomo@hotmail.es>
    */
    public function create_category(){
        if($this->session->userdata('id'))
        {   
        $aside = $this->load->view('companies/left_menu', '', TRUE);
        $content = $this->load->view('companies/crear_categoria', '', TRUE);
        $this->load->view('main/template', array('aside'=>$aside,
                                                       'content'=>$content,
                                                       'included_js'=>array('statics/js/libraries/form.js')));
        }
        else{
            redirect('companies');
        }   

    }


    /*
    * metodo para guardar una categoria.
    * autor: jalomo <jalomo@hotmail.es>
    */
    public function save_categoria(){

        if($this->session->userdata('id')){
            if($_FILES['image']['name'] != ''){
                $post = $this->input->post('save');
                
                $name = date('dmyHis').'_'.str_replace(" ", "", $_FILES['image']['name']);

                $path_to_save = "statics/img_categorias/";
                move_uploaded_file($_FILES['image']['tmp_name'], $path_to_save.$name);

                $post['categoriaImagen'] = $path_to_save.$name;

                $id = $this->Company->save_register('categorias', $post);
    
            }
        }
        else{
            redirect('companies');
        }

    }


    /*
    * volcado de categorias.
    * autor: jalomo <jalomo@hotmail.es> 
    */
    public function category_list(){
        if($this->session->userdata('id'))
        {   

        $data['categorias'] = $this->Company->get_categorias();
        $aside = $this->load->view('companies/left_menu', '', TRUE);
        $content = $this->load->view('companies/lista_categoria', $data, TRUE);
        $this->load->view('main/template', array('aside'=>$aside,
                                                       'content'=>$content,
                                                       'included_js'=>array('statics/js/libraries/form.js')));
        }
        else{
            redirect('companies');
        }  

    }


    /*
    * metodo para visualizar los usuarios que le an solicitado algo al rp.
    * autor: jalomo <jalomo@hotmail.es>
    */
    public function ventas_usuarios(){
     if($this->session->userdata('id'))
        {   

        if($this->input->post('evento')):
			$evento=$this->input->post('evento');
			$data['id_evento']=$evento;
			$data['eventos']=$this->Company->get_eventos();
			$data['usuarios']=$this->Company->eventos_user_ventas_id($this->session->userdata('id'),$evento);    
			$aside = $this->load->view('companies/left_menu', '', TRUE);
			$content = $this->load->view('companies/ventas_usuarios', $data, TRUE);
			$this->load->view('main/template', array('aside'=>$aside,
														   'content'=>$content,
														   'included_js'=>array('statics/js/libraries/form.js')));
		
		else:
			$data['eventos']=$this->Company->get_eventos();
			$data['usuarios']=$this->Company->eventos_user_ventas($this->session->userdata('id'));    
			$aside = $this->load->view('companies/left_menu', '', TRUE);
			$content = $this->load->view('companies/ventas_usuarios', $data, TRUE);
			$this->load->view('main/template', array('aside'=>$aside,
														   'content'=>$content,
														   'included_js'=>array('statics/js/libraries/form.js')));
		endif;												   
        }
        else{
            redirect('companies');
        }  

    }

    /*
    * metodo para ver el status de una compra del usuario, aquí el rp va a
    * poder cambiar el status de un usuario o subir fichas de deposito.
    * autor: jalomo <jalomo@hotmail.es>
    */
    public function evento_status($id_usuario,$id_evento){
		if($this->session->userdata('id'))
        {   
        $data['usuario']=$this->Company->get_usuario_id($id_usuario);  
        $data['evento']=$this->Company->eventosusuarios_id($id_evento); 
        $data['modificadores']=$this->Company->get_moduser($id_evento);
        $aside = $this->load->view('companies/left_menu', '', TRUE);
        $content = $this->load->view('companies/evento_status', $data, TRUE);
        $this->load->view('main/template', array('aside'=>$aside,
                                                       'content'=>$content,
                                                       'included_js'=>array('statics/js/libraries/form.js')));
													   
		}
        else{
            redirect('companies');
        }											   
    }
	
    /*
    * metodo para guardar los datos del status de una compra , el vendedor sube sus comprobantes de pago.
    * autor: jalomo <jalomo@hotmail.es>
    */
    public function save_estatus($id){
		if($this->session->userdata('id'))
        {  
         if(isset($_FILES['imagen']['name'])){
                $post = $this->input->post('save');
                
                $name = date('dmyHis').'_'.str_replace(" ", "", $_FILES['imagen']['name']);

                $path_to_save = "statics/img_rp/";
                move_uploaded_file($_FILES['imagen']['tmp_name'], $path_to_save.$name);

                $post['euUrlImage'] = $path_to_save.$name;

                $id =  $this->Company->edita_eventosusuarios($id,$post);
            }else{
				$post = $this->input->post('save');
				$id =  $this->Company->edita_eventosusuarios($id,$post);
			}
		}
        else{
            redirect('companies');
        }	
    }
	
	/*
	* metodo para vender un boleto a un usuario.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function vender($id_usuario){
		if($this->session->userdata('id'))
        { 
		if($this->input->post('eventoId')):
			$idEvento=$this->input->post('eventoId');
			$data['sexo']=$this->input->post('sexo');
			$data['eventoi']=$this->Company->get_specific_eventos($idEvento);
			$data['modificadores']=$this->Company->get_modificadores_evnto($idEvento);
			$data['idEvento']=$idEvento;
			
			$data['id_usuario']=$id_usuario;
			$data['eventos']=$this->Company->get_eventos();
			$data['usuario']=$this->Company->get_usuario_id($id_usuario);  
			$aside = $this->load->view('companies/left_menu', '', TRUE);
			$content = $this->load->view('companies/vender', $data, TRUE);
			$this->load->view('main/template', array('aside'=>$aside,
														   'content'=>$content,
														   'included_js'=>array('statics/js/libraries/form.js')));
			
			
		
		else:
			$data['id_usuario']=$id_usuario;
			$data['eventos']=$this->Company->get_eventos();
			$data['usuario']=$this->Company->get_usuario_id($id_usuario);  
			$aside = $this->load->view('companies/left_menu', '', TRUE);
			$content = $this->load->view('companies/vender', $data, TRUE);
			$this->load->view('main/template', array('aside'=>$aside,
														   'content'=>$content,
														   'included_js'=>array('statics/js/libraries/form.js')));
	   endif;
	   }
        else{
            redirect('companies');
        }											   
	}
	
	/*
	* metodo para obtener el precio de un evento.
	* sexo 1= hombre, sexo 0= mujer
	* autor: jalomo <jalomo@hotmil.es>
	*/
	public function get_precio_evento($id_evento,$id_ciudad,$sexo){
		echo $this->Company->get_precio_evento($id_evento,$id_ciudad,$sexo);	
	}
	
	/*
	* metodo para obtener los modificadores de un evento ya convertidos a list o chekbox.
	* autor: jalomo <jalomo@hotmail.es>
	*/
	public function get_modificadores_evento($id_evento,$sexo){
		$resultado=$this->Company->get_modificadores_evento($id_evento,$sexo);
		if($resultado!=0):
			$i=0;
			foreach($resultado as $modificador):
				if($modificador->modificadorTipo==1){//CHECKBOX
					echo '<input type="checkbox" name="modificador[]" value="'.$modificador->modificadorNombre.'---'.$modificador->modificadorPrecio.'---'.$modificador->modificadorId.'"/>'.$modificador->modificadorNombre.'  $'.$modificador->modificadorPrecio;
					
					echo '<br/>';
					echo '<br/>';
				}
				
				if($modificador->modificadorTipo==2){//LIST
					$res=explode('--',$modificador->modificadorNombre);
					$resP=explode('--',$modificador->modificadorPrecio);
					$top=count($res)-1;
					echo '<select name="modificador[]">';
							echo '<option value="0">ninguno</option>';
							for($ix=0;$ix<$top;$ix++):
								echo '<option value="'.$res[$ix].'---'.$resP[$ix].'---'.$modificador->modificadorId.'">'.$res[$ix].' $'.$resP[$ix].'</option>';
							endfor;
					echo '</select>';
					echo '<br/>';
					echo '<br/>';
					
				}
			endforeach;
		endif;
	}
	
	/*
	* metodo para guardar un usuario.
    * autor: jalom <jalomo@hotmail.es>
	*/
	public function vender_guardar(){
		if($this->session->userdata('id'))
        {
		$id_evento=$this->input->post('id_evento');
		$id_usuario=$this->input->post('id_usuario');
		$id_vendedor=$this->session->userdata('id');
		$precio_evento=$this->input->post('precio_e');
		$id_ciudad=$this->input->post('id_ciudad');
			
		$modificadores = $this->input->post('modificador');	
		
		$data['euIdUsuario']=$id_usuario;
		$data['euIdEvento']=$id_evento;
		$data['euIdVendedor']=$id_vendedor;
		$data['euTipoPago']=1;
		$data['euStatus']=3;
		$data['euUrlImage']='pendiente';
		$data['euPrecio']=$precio_evento;
		$data['euIdCiudad']=$id_ciudad;
		$data['codigoBarras']=$this->Company->createNewCodigo();
		$data['comentario']='';
		$id_eventosusuarios=$this->Company->save_register('eventosusuarios', $data);
		
		$sux=count($modificadores);
		if($this->input->post('modificador')):
			foreach($modificadores as $modificador):
				$res=explode('---',$modificador);
				$moduser['modModificadorId']=$res[2];
				$moduser['modEventoId']=$id_evento;
				$moduser['modUserId']=$id_usuario;
				$moduser['modStatus']=3;
				$moduser['modNombre']=$res[0];
				$moduser['modPrecio']=$res[1];
				$moduser['rowEventosUsuarios']=$id_eventosusuarios;
				$this->Company->save_register('moduser', $moduser);
				print_r($moduser);
			endforeach;
		endif;
		}
        else{
            redirect('companies');
        }
		
	}
		
	/**
     * Method used for close the session once logout
     * of the platform and the system can delete
     * all the values required during the session
     *
     * @return void
     **/
    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->sess_destroy();
        redirect('companies');
    }
	
	
    
	
	
	
	
	
}
