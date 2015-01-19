<?php
/**
 * View for see the message to sent to the
 * users of the mobile app and can give
 * a news about some topic
 **/
?>
<div id="files_bodys">
    <div id="container">
        <div class="color_font_two margin_top_one margin_left_one">
            <div class="border_bottom_title">
                <span class="font_size_title_section">
                    INFORMACION DE NOTIFICACION
                </span>
            </div>
        </div>
    </div>
    <div id="content_admin">
        <div class="background_color_div">
            <div>
                <?php echo form_label('Crear Notificacion: ', 'createNotification'); ?>
            </div>
            <div>
                <?php echo form_textarea(array('id'=>'notification_text',
                                               'class'=>'',
                                               'name'=>'Notificacion[notificacionesText]',
                                               'value'=>$notificacion->notificacionTexto,
                                               'style'=>'width: 755px; height: 100px',
                                               'readonly'=>'readonly')); ?>
            </div>
        </div>
    </div>
</div>
