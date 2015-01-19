<?php
/**
 * View where can create notifications and the
 * user will see the information about the data
 * and how can send specific information to the 
 * users of the app
 **/
?>
<div id="files_bodys">
    <div id="container">
        <div class="color_font_two margin_top_one margin_left_one">
            <div class="border_bottom_title">
                <span class="font_size_title_section">
                    CREAR NOTIFICACION
                </span>
            </div>
        </div>
    </div>
    <div id="content_admin">
        <div class="ocultar font_message_error font_color_two" id="errorMessage"></div>
        <div class="ocultar font_message_success font_color_three" id="successMessage">
            Tus datos han sido guardados exitosamente.
        </div>
        <?php echo form_open_multipart('companies/save_notificacion', array('id'=>'new_notification')); ?>
            <div class="background_color_div">
                <div>
                    <?php echo form_label('Crear Notificacion: ', 'createNotification'); ?>
                </div>
                <div>
                    <?php echo form_textarea(array('id'=>'notification_text',
                                                   'class'=>'',
                                                   'name'=>'notificacion[notificacionTexto]',
                                                   'value'=>'',
                                                   'style'=>'width: 755px; height: 100px')); ?>
                </div>
            </div>
            <div class="margin_top_two margin_left_two">
                <?php echo form_submit(array('id'=>'button_save_section',
                                             'class'=>'',
                                             'name'=>'',
                                             'value'=>'')); ?>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
