<?php require 'header.php';?>
        
        <div class="content projects">
        
	        <div class="content">
	        	<hr class="line3" />
	        </div>
        	<div class="container">
        		<div class="grid">
        			<?php 
        			$i = 0;
        			$strClass = "up";
        			?>
        			<?php foreach ($rows as $key => $row) { ?>
        			<?php 
        			
        			
        			if ($i == 0 || $i == 1 || $i == 2) {
        				
        			}
        			else
        			{
        			    $strClass = ($strClass == "down") ? "up" : "down";
        			    $i = 0;
        			}
        			$i++;
        			?>
        				<div class="th" style="float: left;">
        				<a href="<?php echo base_url(); ?>detalle/<?php echo $row['id']?>">
        					<div class="bg-hover <?php echo $strClass;?>">
        						<h3>
        							<?php echo nl2br($row["name"])?>
        							
        						</h3>
        					</div>
        					<img width="300" height="300" src="<?php echo base_url(); ?>uploads/<?php echo $row['image']?>" alt="" />
        				</a>
        			</div>
        			<?php }?>
        			
        		</div>
        	</div>
        	<div class="content">
        		<hr class="line3" />
        	</div>
        </div>
        
        <div class="content">
        	<hr class="line-hor bottom" />
        </div>

<?php require 'footer.php';?>
