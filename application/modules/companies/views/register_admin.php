<?php echo form_open('companies/saveInformation'); ?>
    <div>
        <?php echo form_label('Username: ', 'username'); ?>
        <?php echo form_input(array('id'=>'',
                                    'class'=>'',
                                    'name'=>'Registrar[adminsUsername]')); ?>
    </div>
    <div>
        <?php echo form_label('Password: ', 'password'); ?>
        <?php echo form_password(array('id'=>'',
                                       'class'=>'',
                                       'name'=>'Registrar[adminsPassword]')); ?>
    </div>
    <div>
        <?php echo form_label('Email: ', 'email'); ?>
        <?php echo form_input(array('id'=>'',
                                    'class'=>'',
                                    'name'=>'Registrar[adminsEmail]')); ?>
    </div>
    <div>
        <?php echo form_submit(array('id'=>'',
                                     'class'=>'',
                                     'value'=>'Guardar')); ?>
    </div>
<?php echo form_close(); ?>