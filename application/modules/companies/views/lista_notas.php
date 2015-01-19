<?php
/**
 * View for show all the information about the data
 * was saved before in the creation of notifications
 * that was sent to the notifications
 **/
?>
<div id="files_bodys">
    <div id="container">
        <div class="color_font_two margin_top_one margin_left_one">
            <div class="border_bottom_title">
                <span class="font_size_title_section">
                    LISTA DE NOTIFICACIONES
                </span>
            </div>
        </div>
    </div>
    <div id="content_admin">
        <div class="background_header"><!-- Menu noticias -->
            <div class="color_font_menu">
                <div class="flotantes_izquierda" style="width: 50px">
                    &nbsp;
                </div>
                <div class="flotantes_izquierda" style="width: 400px">
                    Descripcion
                </div>
                <div class="flotantes_izquierda" style="width: 200px">
                    Fecha Creacion
                </div>
                <div class="flotantes_izquierda" style="width: 100px">
                    Opciones
                </div>
            </div>
            <div class="no_mas_flotantes"></div>
        </div><!-- Menu noticias -->
        <div class="background_color_div margin_top_two" >
            <?php $i = 1; ?>
            <?php foreach($notificaciones as $notificacion): ?>
                <?php if($i%2 != 0): ?>
                    <div class="margin_top_three" id="eliminar<?php echo $notificacion->notificacionId; ?>" style="margin-left: -20px; margin-right: -20px">
                        <div class="flotantes_izquierda" style="width: 50px">
                            &nbsp;
                        </div>
                        <div class="flotantes_izquierda" style="width: 400px">
                            <?php echo substr($notificacion->notificacionTexto, 0, 40).'...'; ?>
                        </div>
                        <div class="flotantes_izquierda" style="width: 200px">
                            <?php echo $notificacion->notificacionFecha; ?>
                        </div>
                        <div class="flotantes_izquierda" style="width: 100px">
                            <span>
                                <?php echo anchor('companies/viewNotification/'.$notificacion->notificacionId,
                                                  img(array('src'=>'statics/img/bt_editar.png',
                                                            'width'=>'16px',
                                                            'height'=>'16px')),
                                                  array('id'=>'', 'class'=>'no_text_decoration')); ?>
                            </span>
                            <span>
                                <?php echo anchor('companies/deleteNotification/'.$notificacion->notificacionId,
                                                  img(array('src'=>'statics/img/bt_eliminar.png',
                                                            'width'=>'16px',
                                                            'height'=>'16px')),
                                                  array('id'=>'delete'.$notificacion->notificacionId, 'class'=>'eliminar no_text_decoration', 'flag'=>$notificacion->notificacionId)); ?>
                            </span>
                        </div>
                    </div>
                    <div class="no_mas_flotantes"></div>
                <?php else: ?>
                    <div class="margin_top_three" id="eliminar<?php echo $notificacion->notificacionId; ?>" style="background-color: #BBB5B5; margin-left: -20px; margin-right: -20px">
                        <div style="padding-top: 5px; margin-left: 20px">
                            <div class="flotantes_izquierda" style="width: 30px">
                                &nbsp;
                            </div>
                            <div class="flotantes_izquierda" style="width: 400px">
                                <?php echo substr($notificacion->notificacionTexto, 0, 40).'...'; ?>
                            </div>
                            <div class="flotantes_izquierda" style="width: 200px">
                                <?php echo $notificacion->notificacionFecha; ?>
                            </div>
                            <div class="flotantes_izquierda" style="width: 100px">
                                <span>
                                    <?php echo anchor('companies/viewNotification/'.$notificacion->notificacionId,
                                                      img(array('src'=>'statics/img/bt_editar.png',
                                                                'width'=>'16px',
                                                                'height'=>'16px')),
                                                      array('id'=>'', 'class'=>'no_text_decoration')); ?>
                                </span>
                                <span>
                                    <?php echo anchor('companies/deleteNotification/'.$notificacion->notificacionId,
                                                      img(array('src'=>'statics/img/bt_eliminar.png',
                                                                'width'=>'16px',
                                                                'height'=>'16px')),
                                                      array('id'=>'delete'.$notificacion->notificacionId, 'class'=>'eliminar no_text_decoration', 'flag'=>$notificacion->notificacionId)); ?>
                                </span>
                            </div>
                        </div>
                        <div class="no_mas_flotantes"></div>
                    </div>
                <?php endif; ?>
                <?php $i++; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
