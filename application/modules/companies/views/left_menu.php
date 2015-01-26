<?php
/**
 * View where can contain all the values of the menu
 * where the user will select the data ti need to for
 * access to the different sections in the platform
 **/
?>
<div id="data_menu" class="">
    <div style="padding-left: 50px; padding-top: 50px;">
        <?php echo anchor('companies/mainView',
                          img(array('src'=>'statics/img/inicio-icono.png',
                                    'width'=>'128px')),
                           array('id'=>'', 'class'=>'')); ?>
    </div>
    <div id="data_menu_inside" style="background-color: #000000; ">
        <!--div id="notifications">
            <div class="barra_lateral">
                <span class="padding_left_one">
                    <?php echo anchor('#',
                                      'NOTIFICACIONES',
                                      array('id'=>'link_notificaciones', 'class'=>'no_text_decoration font_color_menu')); ?>
                </span>
            </div>
            <div id="options_notifications">
                <div class="margin_top_three">
                    <span class="padding_left_two">
                        <?php echo anchor('companies/crear_nota',
                                          'CREAR NOTIFICACION',
                                           array('id'=>'', 'class'=>'no_text_decoration font_color_menu')); ?>
                    </span>
                </div>
                <div class="separador_menu">&nbsp;</div>
                <div class="margin_bottom_one margin_top_minus_one">
                    <span class="padding_left_two">
                        <?php echo anchor('companies/lista_notas',
                                          'LISTA NOTIFICACION',
                                          array('id'=>'', 'class'=>'no_text_decoration font_color_menu')); ?>
                    </span>
                </div>
            </div>
        </div-->
        
        
         <div id="producto">
            <div class="barra_lateral">
                <span class="padding_left_one">
                 
                    <?php echo anchor('#',
                                      'USUARIOS',
                                      array('id'=>'link_producto', 'class'=>'no_text_decoration font_color_menu')); ?>
                                   
                </span>
            </div>
            <div id="options_producto">
                <div class="margin_top_three">
                    <span class="padding_left_two">
                        <?php echo anchor('companies/crear_usuario',
                                          'CREAR USUARIOS',
                                          array('id'=>'', 'class'=>'no_text_decoration font_color_menu')); ?>
                    </span>
                </div>
                <div class="separador_menu">&nbsp;</div>
                <div class="margin_bottom_one margin_top_minus_one">
                    <span class="padding_left_two">
                        <?php echo anchor('companies/lista_usuarios',
                                          'LISTA USUARIOS',
                                          array('id'=>'', 'class'=>'no_text_decoration font_color_menu')); ?>
                    </span>
                </div>

                <div class="separador_menu">&nbsp;</div>
                <div class="margin_bottom_one margin_top_minus_one">
                    <span class="padding_left_two">
                        <?php echo anchor('companies/ventas_usuarios',
                                          'VENTAS',
                                          array('id'=>'', 'class'=>'no_text_decoration font_color_menu')); ?>
                    </span>
                </div>

            </div>
        </div>
        
      
        
        <!--div id="agenda">
            <div class="barra_lateral">
                <span class="padding_left_one">
                    <?php echo anchor('#',
                                      'EVENTOS',
                                      array('id'=>'link_agenda', 'class'=>'no_text_decoration font_color_menu')); ?>
                </span>
            </div>
            <div id="options_agenda">
                <div class="margin_top_three">
                    <span class="padding_left_two">
                        <?php echo anchor('companies/crearAlbum',
                                          'LISTA DE EVENTOS',
                                          array('id'=>'', 'class'=>'no_text_decoration font_color_menu')); ?>
                    </span>
                </div>
               
            </div>
        </div-->
		
		 <div id="albums">
            <div class="barra_lateral">
                <span class="padding_left_one">
                    <?php echo anchor('#',
                                      'REPORTES',
                                      array('id'=>'link_albums', 'class'=>'no_text_decoration font_color_menu')); ?>
                </span>
            </div>
            <div id="options_albums">
                <div class="margin_top_three">
                    <span class="padding_left_two">
                        <?php echo anchor('companies/crearAlbum',
                                          'CREAR REPORTES',
                                          array('id'=>'', 'class'=>'no_text_decoration font_color_menu')); ?>
                    </span>
                </div>
                
               
            </div>
        </div>
        
       
        
        
       
        <div id="logout">
            <div class="barra_lateral">
                <span class="padding_left_one">
                    <?php echo anchor('companies/logout',
                                      'CERRAR SESION',
                                      array('id'=>'',
                                            'class'=>'no_text_decoration font_color_menu')); ?>
                </span>
            </div>
        </div>
    </div>
</div>
