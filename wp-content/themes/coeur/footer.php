<!-- <button class="mobileCart">
	<i class="fa fa-shopping-cart"></i>
</button> -->

<footer>
	<?php if(is_active_sidebar('footer-1') or is_active_sidebar('footer-2') or is_active_sidebar('footer-3')): ?>
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<?php dynamic_sidebar( 'footer-1' ); ?>
				</div>
				<div class="col-sm-4 md-footer-cl">
					<?php dynamic_sidebar( 'footer-2' ); ?>
				</div>
				<div class="col-sm-4">
					<?php dynamic_sidebar( 'footer-3' ); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="blog-footer blog-footer-widgets">
		<div class="container">
			<p class="site-credits">&copy; <?php echo date('Y'); ?> - <?php echo get_theme_mod('footer_copy', '<a href="'.esc_url('http://frenchtastic.eu').'">Design by Frenchtastic.eu</a>'); ?></p>
			<p class="back-to-top"><a href="#"><i class="fa fa-angle-up"></i> <?php echo __('Back to top', 'coeur'); ?><a></p>
		</div>
	</div>
	<?php else: ?>
	<div class="blog-footer">
		<div class="container">
			<p class="site-credits">&copy; <?php echo date('Y'); ?> - <?php echo get_theme_mod('footer_copy', '<a href="'.esc_url('http://frenchtastic.eu').'">Design by Frenchtastic.eu</a>'); ?></p>
			<p class="back-to-top"><a href="#"><i class="fa fa-angle-up"></i> <?php echo __('Back to top', 'coeur'); ?><a></p>
		</div>
	</div>
	<?php endif; ?>

                <div class="col-full">


<div style="color:#444;">
<div style="float:left;width:50%;">
<a href="/">Inicio</a> | <a href="/sobre-nosotros">Sobre Nosotros</a> | <a href="/terminos-y-condiciones">Términos y Condiciones</a> | <a href="/mi-cuenta">Mi Cuenta</a>
<br/><br/>
<img src="https://mx.naturalandhoney.com/wp-content/uploads/2017/01/conektaCards_c.png" alt="Aceptamos tarjetas de crédito y débito"/>
<img src="https://mx.naturalandhoney.com/wp-content/uploads/2017/01/conektaCash_oxxo_c.png" alt="Aceptamos pagos en OXXO"/>
<br/><br/>
<a href="https://sslanalyzer.comodoca.com/?url=mx.naturalandhoney.com" target="_blank"><img src="https://mx.naturalandhoney.com/wp-content/uploads/2017/01/le-logo-lockonly.png" style="max-width:40px;"/></a>
</div>
<div style="float:right;width:48%;text-align:right;">
<b>Natural &amp; Honey Coffee Roasters</b><br>
Ramon Lopez Velarde 5812-5. CP 22195. Tijuana, Mexico.<br/>
<div></div>
</div>
</div>
<div style="clear:both;"></div>
</div>

                </div><!-- .col-full -->
 
</footer>

</div> <!-- end of wrap -->

<?php wp_footer(); ?>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/589d5a60da22730aacbd31e7/1b8sian0i';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '101599750364311');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=101599750364311&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->
</body>
</html>