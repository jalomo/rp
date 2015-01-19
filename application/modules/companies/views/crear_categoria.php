<link href="<?php echo base_url();?>statics/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript">

$(document).ready(function(){

    $("#save_cat").submit(function(){
        var band = 0;

        if($("#categoriaNombreIngles").val() == ''){
            $("#categoriaNombreIngles").css('border', '1px solid #FF0000');
            band++;
        }
        else{
            $("#categoriaNombreIngles").css('border', '1px solid #ADA9A5');
        }

         if($("#categoriaNombreEspañol").val() == ''){
            $("#categoriaNombreEspañol").css('border', '1px solid #FF0000');
            band++;
        }
        else{
            $("#categoriaNombreEspañol").css('border', '1px solid #ADA9A5');
        }

         if($("#image").val() == ''){
            $("#image").css('border', '1px solid #FF0000');
            band++;
        }
        else{
            $("#image").css('border', '1px solid #ADA9A5');
        }

        if(band != 0)
        {
            $("#errorMessage").text("Por favor, verifique los campos marcados.").show();
            return false;
        }
        else{
            $("#errorMessage").hide();
            var opt = {
                success : exito
            }
            $(this).ajaxSubmit(opt);
            return false;
        }
    });

});    


function exito(responseText)
{
    
    $("#successMessage").fadeIn(1500);
    $("#successMessage").fadeOut(3500);

   
}
</script>

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
  		<div class="panel-heading" align="center"><h4> CREATE CATEGORY</h4></div>
  		<div class="panel-body">

        <?php echo form_open_multipart('companies/save_categoria', array('id'=>'save_cat','role'=>'form')); ?>
            
             <div class="form-group">
			    <label for="">Name in Spanish:</label>
			    <input type="text" class="form-control"  placeholder="Name in Spanish" name="save[categoriaNombreIngles]" id="categoriaNombreIngles">
			  </div>

			  <div class="form-group">
			    <label for="">Name in English:</label>
			    <input type="text" class="form-control"  placeholder="Name in English" name="save[categoriaNombreEspanol]" id="categoriaNombreEspañol">
			  </div>

			  <div class="form-group">
			    <label for="ejemplo_archivo_1">Image</label>
			    <input type="file"  name="image" id="image">
			    <p class="alert alert-warning">image size must be 50px x  50px</p>
			  </div>
			  
			  
			  <button type="submit" class="btn btn-primary">Save</button>
      
        <?php echo form_close(); ?>

        </div>
		</div>


    </div>
</div>
