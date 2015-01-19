<?php
/**
 * View for can see the information about the data
 * was created by the user admin in notifications
 * module
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
                                               'value'=>$notificacion->notificacionesText,
                                               'style'=>'width: 755px; height: 100px',
                                               'readonly'=>'readonly')); ?>
            </div>
            <div style="margin-top: 10px">
                <span>
                    <?php echo form_label('Fecha de Notificacion: ', 'fechaNotificacion'); ?>
                </span>
                <span>
                    <?php echo form_input(array('id'=>'',
                                                'class'=>'',
                                                'name'=>'',
                                                'value'=>$notificacion->notificacionesDate,
                                                'readonly'=>'readonly')); ?>
                </span>
            </div>
        </div>
    </div>
</div>
