
<link href="<?php echo base_url();?>statics/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 <script type="text/javascript" src="<?php echo base_url().'statics/css/bootstrap/js/bootstrap.js'; ?>"></script>

<div id="files_bodys">
   
    <div id="content_admin">
        <div class="ocultar font_message_error font_color_two" id="errorMessage"></div>
        <div class="ocultar font_message_success font_color_three" id="successMessage">
            Tus datos han sido guardados exitosamente.
        </div>


        

        <?php echo form_open_multipart('companies/save_estatus/'.$evento->euId, array('id'=>'save_user','role'=>'form')); ?>
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
              <h3 class="panel-title">Evento: <?php echo $this->Company->get_name_evento($evento->euIdEvento);?></h3>
            </div>
            <div class="panel-body">
             
			<!--h4><small><?php echo $this->Company->get_name_evento($evento->euIdEvento);?></small></h4-->

			<h4><small>Precio:$<?php echo $evento->euPrecio;?></small></h4>

			<h2><small>Modificadores:</small></h2>
			<?php $total_modificacores=0;?>
			<?php if($modificadores!=0):?>
			<?php foreach($modificadores as $modificador):?>
            	<?php $total_modificacores+=$modificador->modPrecio;?>
				<h4><small><?php echo $modificador->modNombre;?> Precio:$<?php echo $modificador->modPrecio;?></small></h4>
			<?php endforeach;?>
            
            <?php endif;?>

            <br/>
            <hr/>
			<h2><small>Total:$<?php echo  number_format( $evento->euPrecio+$total_modificacores);?></small></h2>
            <br/>
            <hr/>
             

             <?php if($evento->euStatus==3):?>
                  <label class="checkbox-inline">
			       <input type="radio" id="checkboxEnLinea1" value="3" checked="checked" name="save[euStatus]" > <span class="text-danger">RESERVADO</span>
			     </label>
             <?php else:?>
             	   <label class="checkbox-inline">
			       <input type="radio" id="checkboxEnLinea1" value="3" name="save[euStatus]"> <span class="text-danger">RESERVADO</span>
			     </label>
             <?php endif;?>

              <?php if($evento->euStatus==4):?>
                  <label class="checkbox-inline">
			       <input type="radio" id="checkboxEnLinea1" value="4" checked="checked" name="save[euStatus]"> <span class="text-warning">PAGADO</span>
			     </label>
             <?php else:?>
             	   <label class="checkbox-inline">
			       <input type="radio" id="checkboxEnLinea1" value="4" name="save[euStatus]"> <span class="text-warning">PAGADO</span>
			     </label>
             <?php endif;?>


             <?php if($evento->euStatus==1):?>
                  <label class="checkbox-inline">
			       <input type="radio" id="checkboxEnLinea1" value="1" checked="checked" name="save[euStatus]" disabled="disabled"> <span class="text-success">CONFIRMADO</span>
			     </label>
             <?php else:?>
             	   <label class="checkbox-inline">
			       <input type="radio" id="checkboxEnLinea1" value="1" name="save[euStatus]" disabled="disabled"> <span class="text-success" >CONFIRMADO</span>
			     </label>
             <?php endif;?>


			

           <br/>
           <hr/>
           
           <?php if(trim($evento->euUrlImage)=='pendiente'):?>
           <h2><small>subir comprobante:</small></h2>
           <input type="file" name="imagen"> 
		   <?php else:?>
           
            <h2><small>Comprobante de pago:</small></h2>
           	<img src="http://localhost:8080/sistema/<?php echo  $evento->euUrlImage;?>" alt="..." class="img-rounded" width="300" data-toggle="modal" data-target=".bs-example-modal-lg" style="cursor:pointer;">
           	
           <?php endif;?>
           <br/>
           <br/>
           <hr/>
           <h2><small>Comentarios:</small></h2>
           
           <textarea class="form-control" rows="3" name="save[comentario]"><?php echo $evento->comentario;?></textarea>
           
           
           <br/>
           <br/>
           
           <div>
           		<button type="submit" class="btn btn-primary">GUARDAR</button>
           </div>

            </div>
          </div> 

		
        
        
        
        <!-- inicio modal para la imagen -->
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <img src="http://localhost:8080/sistema/<?php echo  $evento->euUrlImage;?>" alt="..." class="img-rounded">
            </div>
          </div>
        </div>
        <!-- fin modal para la imagen-->

        <?php echo form_close(); ?>

        


    </div>
</div>