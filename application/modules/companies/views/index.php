<?php
/**
 * View login for show to the user the
 * login admin and can login to admin panel
 **/
?>
<style type="text/css">
body, html {
    background-color: #ffffff;
}
</style>
<?php echo anchor('companies/checkDataLogin', '', array('id'=>'checkValues', 'style'=>'display: none')); ?>
<div id="container">
    <div id="container_login">
        <div>
            <?php echo img(array('src'=>'statics/img/zapps.png',
                                 'width'=>'400px',
                                 'height'=>'182px')); ?>
        </div>
        <div id="border_complete" style="margin-top: 50px">
            <div id="errorMessageLogin" style="color: #FF0000; display: none"></div>
            <div id="errorLoginData" style="color: #FF0000; display: none"></div>
            <?php echo form_open('companies/mainView', array('onsubmit'=>'return login();')); ?>
                <div>
                    <span class=" font_login_view ">
                        <?php echo form_label('Usuario: ', 'usernameLogin'); ?>
                    </span>
                    <span class="padding_left_three">
                        <?php echo form_input(array('id'=>'loginApplebees',
                                                    'class'=>'inputs_login',
                                                    'name'=>'Login[adminUsername]',
                                                    'value'=>'',
                                                    'style'=>'width: 300px')); ?>
                    </span>
                </div>
                <div style="margin-top: 10px">
                    <span class="font_login_view">
                        <?php echo form_label('Password: ', 'passwordLogin'); ?>
                    </span>
                    <span style="padding-left: 5px">
                        <?php echo form_password(array('id'=>'passApplebees',
                                                    'class'=>'inputs_login',
                                                    'name'=>'Login[adminPassword]',
                                                    'value'=>'',
                                                    'style'=>'width: 300px')); ?>
                    </span>
                </div>
                <div id="combined_one">
                    <?php echo form_submit(array('id'=>'boton_login',
                                                 'class'=>'',
                                                 'name'=>'',
                                                 'value'=>'')); ?>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
