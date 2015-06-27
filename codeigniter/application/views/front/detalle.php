<?php require 'header.php';?>
        
        <div class="content detail">
        
	        <div class="content">
	        	<hr class="line3" />
	        </div>
        	<div class="container">
        		<h3><?php echo $info['name']?></h3>
        		<h4>
        			<?php echo $info['description']?>
        		</h4>
        		<?php foreach ($rows as $key => $row) { ?>
        			<img width="935" src="<?php echo base_url(); ?>uploads/<?php echo $row['image']?>" alt="" />
        		<?php }?>
        	</div>
        	<div class="content">
        		<hr class="line3" />
        	</div>
        </div>
        
        <div class="content">
        	<a id="btnlike" class="btn-square" href="" onclick="javascript: like(<?php echo $info['id']; ?>)">Me gusta este proyecto</a>
        	<a class="btn-square" href="<?php echo base_url(); ?>proyectos">Regresar a proyectos</a>
        	<?php if (trim($info['link']) != "") { ?>
        		<a class="btn-square" target="_blank" href="<?php echo $info["link"]; ?>">Ir a Página</a>
        	<?php }?>
        	
        </div>
        
        <div class="content">
        	<hr class="line-hor bottom" />
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url();?>js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <script src="<?php echo base_url();?>js/plugins.js"></script>
        <script src="<?php echo base_url();?>js/main.js"></script>
        <script src="<?php echo base_url();?>js/jquery.cookie.js"></script>
        <script type="text/javascript">
        	$(document).ready(function () {
        		if($.cookie('remember_select<?php echo $info['id']; ?>') == '<?php echo $info['id']; ?>') {

        		    // set the option to selected that corresponds to what the cookie is set to

        		    $('#btnlike').attr('class', 'btn-square active');

        		}
            });
			function like(project_id)
			{
				var the_path = '<?php echo base_url();?>';
				var the_url = the_path + 'likeproject';
				//alert(the_url);
				$.ajax({
					  type: "POST",
					  dataType: "text",
					  async:true,
					  url: the_url, //Relative or absolute path to response.php file
					  data:  'project_id=<?php echo $info['id'];?>',
					  error: function(jqXHR, exception) {
						  alert('Uncaught Error: ' + " jjj "+ jqXHR.responseText);
				           if (jqXHR.status === 0) {
				               alert('Not connect: Verify Network.');
				           } else if (jqXHR.status == 404) {
				               alert('Requested page not found [404]');
				           } else if (jqXHR.status == 500) {
				               alert('Internal Server Error [500].');
				           } else if (exception === 'parsererror') {
				               alert('Requested JSON parse failed.');
				           } else if (exception === 'timeout') {
				               alert('Time out error.');
				           } else if (exception === 'abort') {
				               alert('Ajax request aborted.');
				           } else {
				               alert('Uncaught Error: ' + jqXHR.responseText);
				           }
				        },
					  success: function(str) {

						  if (str == "DONE")
						  {
							  alert('¡Gracias por su preferencia!');
							  $.cookie('remember_select<?php echo $info['id']; ?>', "<?php echo $info['id']; ?>", { expires: 90, path: '/'});
							  
						  }
						  else
							  alert('No se ha podido guardar su preferencia.');

					  		//alert(str);
				  			return false;
						}
				});
			}
		</script>

<?php require 'footer2.php';?>
