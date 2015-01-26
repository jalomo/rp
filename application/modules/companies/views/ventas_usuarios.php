<link href="<?php echo base_url();?>statics/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<script>
$(document).ready(function(){
 
         $("#options_producto").show();
});         
      
</script>      


<div id="files_bodys">
    <div id="container">
        <div class="color_font_two margin_top_one margin_left_one">
            <div class="border_bottom_title">
                <span class="font_size_title_section">
                    LISTA DE USUARIOS - VENTAS
                </span>
            </div>
        </div>
    </div>
    <div id="content_admin">
        <div class="ocultar font_message_error font_color_two" id="errorMessage"></div>
        <div class="ocultar font_message_success font_color_three" id="successMessage">
            Tus datos han sido guardados exitosamente.
        </div>

                <div class="container" style="padding-top: 1em;">
                
                <?php echo form_open_multipart('companies/ventas_usuarios/', array('id'=>'','role'=>'')); ?>
                <div class="form-group">
                
                   <label for="ejemplo_email_3" class="col-lg-2 control-label">Evento:</label>
                    <div class="col-lg-8">
                    <?php if(isset($id_evento)):?>
                    	 <?php if($id_evento==0):?>
                             <select class="form-control" name="evento">
                              <option value="0">Todos</option>
                              <?php if($eventos!=0):?>
								  <?php foreach($eventos as $evento):?>
                                    <option value="<?php echo $evento->eventoId?>"><?php echo $evento->eventoNombre;?></option>
                                  <?php endforeach;?>
                              <?php endif;?>
                            </select>
                        <?php else:?>
                        	<select class="form-control" name="evento">
                              <?php if($eventos!=0):?>
								  <?php foreach($eventos as $evento):?>
                                    <?php if($id_evento==$evento->eventoId):?>
                                        <option value="<?php echo $evento->eventoId?>" selected="selected"><?php echo $evento->eventoNombre;?></option>
                                    <?php else:?>
                                        <option value="<?php echo $evento->eventoId?>" ><?php echo $evento->eventoNombre;?></option>
                                    <?php endif;?>
                                  <?php endforeach;?>
                              <?php endif;?>
                              <option value="0">Todos</option>
                            </select>
                        <?php endif;?>
                    <?php else:?>
                         <select class="form-control" name="evento">
                          <option value="0">Todos</option>
                          <?php if($eventos!=0):?>
							  <?php foreach($eventos as $evento):?>
                                <option value="<?php echo $evento->eventoId?>"><?php echo $evento->eventoNombre;?></option>
                              <?php endforeach;?>
                          <?php endif;?>
                        </select>
                    <?php endif;?>
                    </div>
                    <div class="col-lg-2">
                      <button type="submit" class="btn btn-default">Aceptar</button>
                    </div>
                    
                  </div>
                  
                 <?php echo form_close(); ?>
                <br/>
                <br/>
                <hr/>
                  <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Estatus</th>
                      <th>Options</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($usuarios!=0):?>
                    <?php foreach($usuarios as $usuario):?>
                    <tr>
                      <td>
                        <?php echo $this->Company->name_user($usuario->euIdUsuario);?>
                       </td>
                      <td>
                        <?php echo $this->Company->get_email_user($usuario->euIdUsuario);?>
                      </td>
                      <td>
                       
                         <?php if($usuario->euStatus==1):?>
                          <span class="text-success">CONFIRMADO</span>
                        <?php endif;?>

                        <?php if($usuario->euStatus==3):?>
                          <span class="text-danger ">RESERVADO</span>
                        <?php endif;?>

                        <?php if($usuario->euStatus==4):?>
                          <span class="text-warning">PAGADO</span>
                        <?php endif;?>
                      </td>
                      <td>

                          <?php /*echo anchor('companies/deleteNotifications/'.$usuario->categoriaId,
                                                 'delete',
                                                  array('id'=>'delete'.$categoria->categoriaId, 'class'=>'eliminar no_text_decoration btn btn-danger', 'flag'=>$categoria->categoriaId));*/ ?>

                          <?php echo anchor('companies/ver_usuario/'.$usuario->euIdUsuario,
                                                 'ver',
                                                  array('id'=>'', 'class'=>'eliminar no_text_decoration btn btn-primary', 'flag'=>'')); ?>                        

                        
                    </tr>
                  <?php endforeach;?>
                <?php endif;?>
                    
                  </tbody>
                  </table>
                </div>



    </div>
</div>
