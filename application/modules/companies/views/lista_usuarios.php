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
                    LISTA DE USUARIOS
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
                  <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Sexo</th>
                      <th>Options</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($usuarios!=0):?>
                    <?php foreach($usuarios as $usuario):?>
                    <tr>
                      <td>
                        <?php echo $usuario->usuarioNombre;?>
                       </td>
                      <td>
                        <?php echo $usuario->usuarioEmail;?>
                      </td>
                      <td>
                        <?php echo $usuario->usuarioSexo;?>
                      </td>
                      <td>

                          <?php /*echo anchor('companies/deleteNotifications/'.$usuario->categoriaId,
                                                 'delete',
                                                  array('id'=>'delete'.$categoria->categoriaId, 'class'=>'eliminar no_text_decoration btn btn-danger', 'flag'=>$categoria->categoriaId));*/ ?>

                          <?php echo anchor('companies/ver_usuario/'.$usuario->usuarioId,
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
