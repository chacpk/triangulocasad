<?php require 'header.php';?>
        <div class="content contact">
        	<div class="container">
        		<h3><img src="<?php echo base_url(); ?>img/title-contactanos.jpg" alt="" /></h3>
        		<?php if($this->session->flashdata('msg')){ ?>
        		<p>
        			<?php echo $this->session->flashdata('msg'); ?>
        		</p>
        		<?php } ?>
        		<form action="" method="post">
        		<div class="cont-form">
        			<input style="outline: none;" class="left" type="text" name="name" placeholder="Nombre" /><!--
    				--><input style="outline: none;" class="right" type="text" name="email" placeholder="Mail" />
    				<textarea name="message" style="outline: none;" placeholder="Mensaje"></textarea>
    				<input class="btn-square" type="submit" name="" value="Enviar mail" />
        		</div>
        		</form>
        		
        		<hr class="line3" />
        		
        		<div class="icons">
        			<a class="left" href="tel:555-437-2894"><img src="<?php echo base_url(); ?>img/icon-phone.jpg" alt="" /></a>
        			<!--a class="center" href="mailto:info@triangulocasad.com"><img src="img/icon-mail.jpg" alt="" /></a-->
        			<a class="center" href="https://www.facebook.com/triangulocasad?ref=bookmarks" target="_blank"><img src="<?php echo base_url(); ?>img/icon-fb.jpg" alt="" /></a>
        			<a class="right" href="https://instagram.com/triangulocasad/" target="_blank"><img src="<?php echo base_url(); ?>img/icon-insta.jpg" alt="" /></a>
        		</div>
        	</div>
        </div>
        
        <div class="content">
        	<hr class="line-hor bottom" />
        </div>

<?php require 'footer.php';?>
