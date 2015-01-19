<link href="<?php echo base_url();?>statics/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script>
$(document).ready(function(){
 
         $("#options_producto").show();
      
       $("#save_user").submit(function(){
           
          
           
           
           
           
        var band = 0;
        var mai=0;
        
        
        
        if($("#usuarioNombre").val() == '' ){
            $("#usuarioNombre").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#usuarioNombre").css("border", "1px solid #ADA9A5");
        }
        
        if($("#usuariodomicilio").val() == '' ){
            $("#usuariodomicilio").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#usuariodomicilio").css("border", "1px solid #ADA9A5");
        }
        

        if($("#usuarioTelefonno").val() == '' ){
            $("#usuarioTelefonno").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#usuarioTelefonno").css("border", "1px solid #ADA9A5");
        }

        
        
        if($("#usuarioPassword").val() == '' ){
            $("#usuarioPassword").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            $("#usuarioPassword").css("border", "1px solid #ADA9A5");
        }
        
        if($("#usuarioEmail").val() == '' ){
            $("#usuarioEmail").css("border", "1px solid #FF0000");
            band++;
        }
        else{
            
            value_data = $.ajax({
               type: "POST",
               url:  url = $("#val_email").attr('href'),
               data:{email:$("#usuarioEmail").val()},
               dataTypeString:'text',
               async: false,
               success: function(data){
                    
                    if(data==1){
                         $("#errorMessage1").text("Email ya existe.").show();
                        $("#usuarioEmail").css("border", "1px solid #FF0000");
                        band++; 
                    }else{
                         $("#usuarioEmail").css("border", "1px solid #ADA9A5");
                    }   
                        
                   }
               }).responseText; 
            
           
        }
        
        
        
        
      
        if(band != 0){
            $("#errorMessage").text("Por favor, verifique los campos marcados.").show();
                
            return false;
        }
        else{
            $("#errorMessage").hide();
            var opt = {
                success : newEvento1
            }
            $(this).ajaxSubmit(opt);
            return false;
        }
    });
    
    
    
    
    $("#pais_").change(function (event){
        event.preventDefault();
        id=$(this).val();
        
        
         url = $("#get_estados").attr('href');
        value_json = $.ajax({
               type: "GET",
               url:url+"/"+id,
               async: false,
               dataType: "html",
                success: function(data){
                        
                        $("#carga_estados").empty();
                        $("#carga_estados").html(data);
                    
                   }
               }).responseText;
        
        
    });
      
      
}); 

function newEvento1(opt){
    
    $("#successMessage").fadeIn(1500);
    $("#successMessage").fadeOut(3500);
    //$("#save_user").hide();
   
    //$("#datos_").html(opt).show();
    
}

</script>
<?php echo anchor('companies/get_estados_cliente/', '', array('id'=>'get_estados', 'style'=>'display: none')); ?>

<?php echo anchor('companies/validate_email_user/', '', array('id'=>'val_email', 'style'=>'display: none')); ?>

<div id="files_bodys">
    <!--div id="container">
        <div class="color_font_two margin_top_one margin_left_one">
            <div class="border_bottom_title">
                <span class="font_size_title_section">
                    CREATE CATEGORY
                </span>
            </div>
        </div>
    </div-->
    <div id="content_admin">
        <div class="ocultar font_message_error font_color_two" id="errorMessage"></div>
        <div class="ocultar font_message_success font_color_three" id="successMessage">
            Tus datos han sido guardados exitosamente.
        </div>


        <div class="panel panel-default">
  		<div class="panel-heading" align="center"><h4> INFORMACIÓN USUARIO</h4></div>
  		<div class="panel-body">

        <?php echo form_open_multipart('companies/save_usuario', array('id'=>'save_user','role'=>'form')); ?>
            <fieldset disabled>
             <div class="form-group">
			    <label for="">Nombre de usuario:</label>
			    <input type="text" class="form-control"  placeholder="Nombre usuario" name="save[usuarioNombre]" id="usuarioNombre" value="<?php echo $usuario->usuarioNombre;?>">
			  </div>

			  <div class="form-group">
			    <label for="">Teléfono:</label>
			    <input type="text" class="form-control"  placeholder="Teléfono" name="save[usuarioTelefonno]" id="usuarioTelefonno" value="<?php echo $usuario->usuarioTelefonno;?>">
			  </div>

                <hr/>

              <div class="form-group">
                <label for="">País:</label>
                <?php echo form_dropdown('', $paises,$usuario->usuarioPais,'class="form-control" id="pais_" name="save[usuarioPais]"');?>


              </div>


               <div class="form-group">
                <label for="">estado:</label>
                <div id="carga_estados">
               
                  <?php echo form_dropdown('', $estados,$usuario->usuarioEstado,'class="form-control"  name="save[usuarioEstado]"');?>

                 </div>
                
              </div>

              <div class="form-group">
                <label for="">Ciudad:</label>
                
                  <?php echo form_dropdown('', $ciudades,$usuario->usuarioIdCiudad,'class="form-control"  name="save[usuarioIdCiudad]"');?>

              </div>

              <hr/>

              <div class="form-group">
                <label for="">Sexo:</label>
               

                  <?php echo form_dropdown('', array('Hombre'=>'Hombre','Mujer'=>'Mujer'),$usuario->usuarioSexo,'class="form-control"  name="save[usuarioSexo]"');?>

              </div>


              <div class="form-group">
                <label for="">Email:</label>
                <input type="email" class="form-control"  placeholder="Email" name="save[usuarioEmail]" id="usuarioEmail" value="<?php echo $usuario->usuarioEmail;?>">
              </div>

              <hr/>

             

              <div class="form-group">
                <label for="">Password:</label>
                <input type="text" class="form-control"  placeholder="Password" name="save[usuarioPassword]" id="usuarioPassword" value="<?php echo $usuario->usuarioPassword;?>">
              </div>

              <input type="hidden" class="form-control"  placeholder="Password" name="save[usuarioIdAdmin]" id="usuarioIdAdmin" value="<?php echo $this->session->userdata('id');?>">

			     
			  
			  <!--button type="submit" class="btn btn-primary">Save</button-->
       </fieldset>
      
      <div align="right">
       <?php echo anchor('companies/usuario_ventas/'.$usuario->usuarioId,
                                                 'ventas',
                                                  array('id'=>'', 'class'=>'eliminar no_text_decoration btn btn-info', 'flag'=>'')); ?>

       <?php echo anchor('companies/vender/'.$usuario->usuarioId,
                                                 'vender',
                                                  array('id'=>'', 'class'=>'eliminar no_text_decoration btn btn-success', 'flag'=>'')); ?>
      </div>                                                                                       
        <?php echo form_close(); ?>

        </div>
		</div>


    </div>
</div>
