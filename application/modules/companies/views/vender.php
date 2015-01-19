
<link href="<?php echo base_url();?>statics/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 <script type="text/javascript" src="<?php echo base_url().'statics/css/bootstrap/js/bootstrap.js'; ?>"></script>

<div id="files_bodys">
   
    <div id="content_admin">
        <div class="ocultar font_message_error font_color_two" id="errorMessage"></div>
        <div class="ocultar font_message_success font_color_three" id="successMessage">
            Tus datos han sido guardados exitosamente.
        </div>


        

        
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
              <h3 class="panel-title">Vender</h3>
            </div>
            <div class="panel-body">
             
			
            	
                
             <?php echo form_open_multipart('companies/vender/'.$id_usuario, array('id'=>'','role'=>'')); ?>
                <div class="form-group">
                
                   <label for="ejemplo_email_3" class="col-lg-2 control-label">Evento:</label>
                    <div class="col-lg-4">
                    
                         <select class="form-control" name="eventoId">
                          <?php if($eventos!=0):?>
							  <?php foreach($eventos as $evento):?>
                                <option value="<?php echo $evento->eventoId?>"><?php echo $evento->eventoNombre;?></option>
                              <?php endforeach;?>
                          <?php endif;?>
                        </select>
                    
                    </div>
                    <div class="col-lg-4">
                      
                      
                      <select name="sexo" id="sexo">
                      	<option value="1">Hombre</option>
                        <option value="0">Mujer</option>
                      </select>
                    </div>
                    
                    <div class="col-lg-2">
                      <button type="sumbit" class="btn btn-default">Ver</button>
                    </div>
                    
                  </div>
                  
             <?php echo form_close(); ?>
                 
             <br/>
             <br/>
             <hr/>
             <?php if(isset($eventoi)):?>
             <?php echo form_open_multipart('companies/vender_guardar/', array('id'=>'','role'=>'')); ?>
             	<div style="color:#00F">
                	<h2><small>Evento:<?php echo $eventoi->eventoNombre;?></small></h2>  
                </div>    
                <h2><small>Ciudad:
                	<?php $aux=explode('--',$eventoi->eventoCiudad);?>
                    <?php $auxCount=count($aux);?>
					<select id="change_opciones">
                    	<option value="0">Seleccione una ciudad</option>
                    	<?php for($i=0;$i<$auxCount-1;$i++):?>
                        	<option><?php echo $aux[$i];?></option>
                        <?php endfor;?>    
                    </select>
                </small></h2> 
                
                <hr/>
               <h2><small>Precio:</small></h2>  
               <div id="cambia_precio">$</div>
                <input  id="precio_e" type="hidden" />
               <hr/>
               
               <br/>
               
               <h2><small>Modificadores:</small></h2>  
               <div id="carga_modificadores"></div>
               
               <hr/>
               
               
               <br/>
               <div>
           		<button type="submit" class="btn btn-primary">VENDER</button>
           		</div>
             <?php echo form_close(); ?>   
             <?php endif;?>   
                  
           
            
            
            
            <br/>   
            <br/>   
            <hr/>
           
           

            </div>
          </div> 

		
        
        

        

        


    </div>
</div>

<?php echo anchor('companies/get_precio_evento/', '', array('id'=>'get_precio_evento', 'style'=>'display: none')); ?>
<?php echo anchor('companies/get_modificadores_evento/', '', array('id'=>'get_modificadores', 'style'=>'display: none')); ?>
<script language="javascript">

$(document).ready(function(){

    //Load the library and the functionality of news
    $("#change_opciones").change(function (event){
		event.preventDefault();
		id=$(this).val();
		valores="";
		url = $("#get_precio_evento").attr('href');
		text_response = $.ajax({
                                url : url+'/<?php echo $idEvento;?>/'+id+'/'+$('#sexo').val(),
                                type: "GET",
                                dataType: "text",
                                async: false,
								success: function(data){
											$('#precio_e').val(data);
											$("#cambia_precio").empty();
											$("#cambia_precio").html('$'+data);
										 }
                               }).responseText;
		
		urlmodificadores = $("#get_modificadores").attr('href');					   
		html_modificadores = $.ajax({
                                url : urlmodificadores+'/<?php echo $idEvento;?>/'+$('#sexo').val(),
                                type: "GET",
                                dataType: "html",
                                async: false,
								success: function(data){
											
											$("#carga_modificadores").empty();
											$("#carga_modificadores").html(data);
										 }
                               }).responseText;					   
					   
		//$("#carga_opciones").empty();
		//$("#carga_opciones").html(valores);
		
	});
	
	
	
	
	
	
});

function newEncuesta(){

    $("#successMessage").fadeIn(1500);
    $("#successMessage").fadeOut(3500);
}
</script>