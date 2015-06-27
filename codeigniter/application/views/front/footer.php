		<br>
		<br>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url();?>js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
        <script src="<?php echo base_url();?>js/plugins.js"></script>
        <script src="<?php echo base_url();?>js/main.js"></script>
        
        <script>
		$(document).ready(function () {
			$( "#img_home1" ).css('visibility','visible').hide().fadeIn( 4000, function() {
				$( "#img_home2" ).css('visibility','visible').hide().fadeIn( 4000, function() {
					
				  });
			  });
		});
        </script>
			
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>
