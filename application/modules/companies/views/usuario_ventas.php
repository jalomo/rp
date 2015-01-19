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


        

        <?php echo form_open_multipart('companies/save_usuario', array('id'=>'save_user','role'=>'form')); ?>
            <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Información del usuario</h3>
            </div>
            <div class="panel-body">
                
                <h4><small><?php echo $usuario->usuarioNombre;?></small></h4>

                <h4><small><?php echo $usuario->usuarioTelefonno;?></small></h4>

                <h4><small><?php echo $usuario->usuarioEmail;?></small></h4>




            </div>
          </div> 



          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Ventas</h3>
            </div>
            <div class="panel-body">
             

             <ul class="list-group">
              <?php if($eventos!=0):?>
              <?php foreach($eventos as $evento):?>
              <li class="list-group-item">

               
                <?php echo anchor('companies/evento_status/'.$usuario->usuarioId.'/'.$evento->euId,
                                                 'entrar',
                                                  array('id'=>'', 'class'=>'badge', 'flag'=>'')); ?>

                <?php if($evento->euStatus==1):?>
                  <span class="text-success">CONFIRMADO</span>
                <?php endif;?>

                <?php if($evento->euStatus==3):?>
                  <span class="text-danger ">RESERVADO</span>
                <?php endif;?>

                <?php if($evento->euStatus==4):?>
                  <span class="text-warning">PAGADO</span>
                <?php endif;?>

                
                <?php echo $this->Company->get_name_evento($evento->euIdEvento);?></li>
              <?php endforeach;?>
            <?php endif;?>
            </ul>



            </div>
          </div> 



        <?php echo form_close(); ?>

        


    </div>
</div>
