<?php
/**
 * Helper that use to check different
 * information in function will create for
 * can check or take information and easy
 * form and this functions could use it
 * in the view
 *
 * @createsAt May 20, 2013
 * @package Helpers
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/

/**
 * Helper that use for create the password token and can
 * encrypt the value. Is for do the password more secure
 *
 * @params string username
 * @params string password
 * @params string key
 *
 * @return string keyEncrypted
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function encrypt_password($username, $password, $key)
{
    $pass = sha1($password.$key.$username);
    return $pass;
}

/**
 * Helper used to take all the information of the
 * sport and can show to the users for load all
 * the information and create the tournament
 *
 * @return array mixedData
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_all_information_ligas()
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('deporte');
    $data = $CI->db->get();
    return $data->result();
}

/**
 * Helper used for can check the name of the sport
 * once pass the values of the type of sport
 * selected
 *
 * @params int idSport
 * @return string nameSport
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_tournament_name($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('deporte')
           ->where('deporteId', $id);
    $data = $CI->db->get();
    $nombre = $data->row();
    return $nombre->deporteNombre;
}

/**
 * Helper used for return the name of the sport selected
 * and can show it to the user admin once select the
 * data
 *
 * @param int idSport
 * @return string sportName
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_sports_name($id){
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('torneos')
           ->where('torneosId', $id);
    $data = $CI->db->get();
    $nombre = $data->row();
    return $nombre->torneosNombre;
}

/**
 * Helper that used for check the values of the team and then can see
 * the name of the sport which is the section of that and the
 * system can show the name of sport
 *
 * @params int idTeam
 * @return array mixedData
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_kind_sport_team($id){
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('participaciones_equipos')
           ->where('participacionesEquipoId', $id)
           ->limit(1);
    $data = $CI->db->get();
    return $data->row();
}

/**
 * Helper for count all the values of the checkbox
 * for know id really has tournament enabled and can
 * the user see what is the value and the tournament
 * that has partipation
 *
 * @params int idTeam
 * @params int idTournament
 *
 * @return void
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function count_tournaments_by_team($idTeam, $idT){
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('participaciones_equipos')
           ->where('participacionesEquipoId', $idTeam)
           ->where('participacionesTorneoId', $idT);
    $total = $CI->db->count_all_results();
    return $total;
}

/**
 * Helper returns the name and can see the in the
 * list jus passing the id of the tournament where
 * the user can see the data
 *
 * @params int idTournament
 * @return string name
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_name_tournament($id){
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('torneos')
           ->where('torneosId', $id);
    $data = $CI->db->get();
    $nombre = $data->row();
    return $nombre->torneosNombre;
}

/**
 * Method for take the data of the sport and can show the information in the
 * view for the user can select once click in edit the
 * name of the gameday
 *
 * @params int idTournament
 * @return array mixedData
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_name_sport($id){
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('torneos')
           ->join('deporte', 'deporteId = torneosIdLiga', 'left')
           ->where('torneosId', $id);
    $data = $CI->db->get();
    return $data->row();
}

/**
 * Helper used for get all the information about the data
 * of the team and can show the values and can show to the user
 * admin in the view
 *
 * @params int idTeam
 * @return array mixedData
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_data_team_specific($id){
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('equipos')
           ->where('equiposId', $id);
    $data = $CI->db->get();
    return $data->row();
}

/**
 * Helper for know the name of the journey and can return the data
 * just receive the id of journey. The helper just returns
 * an string with the name for show to the user admin
 *
 * @params int idJourney
 * @return string nombre
 * @author blackfoxgdl <ruben.alonso21@gmail.com>
 **/
function get_name_semana_jornada_specific($id){
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('semanas_jornadas')
           ->where('semanasJornadasId', $id);
    $data = $CI->db->get();
    $nombre = $data->row();
    return $nombre->semanasJornadasNombre;
}

/**
 * Helper used for get the name of the sucursal the user
 * selected in the dropdown for can put enabled the 
 * promotion or gift
 *
 * @param int idSucursal
 * @return void
 * @author blackfoxgdl <ruben.alosno21@gmail.com>
 **/
function get_sucursal_value($value){
    $name = '';
    if($value == 1){
        $name = 'Juarez';
    }
    if($value == 2){
        $name = 'Guadalajara';
    }
    if($value == 3){
        $name = 'Morelia';
    }
    if($value == 4){
        $value = 'Colima';
    }
    if($value == 5){
        $value = 'Cancun';
    }
    return $name;
}


function get_opciones($id)
{
    $CI =& get_instance();
    $CI->db->select('*')
           ->from('opciones')
           ->where('opcionIdPregunta', $id);
    $data = $CI->db->get();
    $datos = $data->result();
    return $datos;
}

function get_cliente($id){
	 $CI =& get_instance();
    $CI->db->select('clienteNombre')
           ->from('clientes')
           ->where('clienteId', $id);
    $data = $CI->db->get();
    $datos = $data->row();
	
    return $datos->clienteNombre;
	}
	
function get_cliente_info($id){
	 $CI =& get_instance();
    $CI->db->select('*')
           ->from('clientes')
           ->where('clienteId', $id);
    $data = $CI->db->get();
    $datos = $data->row();
	
    return $datos;
	}	
	
function get_nombre_agente($id){
	 $CI =& get_instance();
    $CI->db->select('agenteNombre')
           ->from('agentes')
           ->where('agenteId', $id);
    $data = $CI->db->get();
    $datos = $data->row();
	
    return $datos->agenteNombre;
	}	
	
function album_name($id){
	 $CI =& get_instance();
    $CI->db->select('albumNombre')
           ->from('album')
           ->where('albumId', $id);
    $data = $CI->db->get();
    $datos = $data->row();
	
    return $datos->albumNombre;
	}			