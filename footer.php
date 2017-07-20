	<footer class="page-footer">
		<div class="container">
			<div class="row">
				<div class="col-md-4 footer-widget">
					<h3>Publicidad</h3>
					<?php gb_get_ad('footer', 'square', 'chitika'); ?>
				</div>
				<?php get_template_part('src/widget', 'tags-cloud'); ?>
				<div class="col-md-4 footer-widget">
					<h3>Enlaces de Interés</h3>
					<div class="navbar navbar-inverse footer-navbar">
						<?php gb_navbar('footer'); ?>
					</div>
				</div>
				<div class="col-md-12 footer-info">
					<p class="text-center">
						© <a href="http://www.ganemosbits.trade">Ganemosbits</a> 2016 - <?php echo date('Y'); ?> By <a href="https://twitter.com/rincorpes" target="_blank">Rincorpes</a>
					</p>
				</div>
			</div>
		</div>
	</footer>

	<!-- Cookies -->
	<div id="cookiebar" style="display: block;">
		<div class="inner">
			Utilizamos cookies propias y de terceros para mejorar tu experiencia de navegación. Si continúa navegando consideramos que acepta el uso de cookies.
			<a href="javascript:void(0);" class="ok" onclick="showCookie();"><b>Aceptar</b></a> | 
			<a href="<?php echo get_permalink(get_page_by_title('Políticas de Cookies')) ?>" target="_blank" class="info">Más información</a>
		</div>
	</div>

	<script>
		function getCookie(c_name){
			var c_value = document.cookie;
			var c_start = c_value.indexOf(" " + c_name + "=");

			if (c_start == -1) {
				c_start = c_value.indexOf(c_name + "=");
			}

			if (c_start == -1) {
				c_value = null;
			} else {
				c_start = c_value.indexOf("=", c_start) + 1;
				var c_end = c_value.indexOf(";", c_start);

				if (c_end == -1) {
					c_end = c_value.length;
				}

				c_value = unescape(c_value.substring(c_start,c_end));
			}

			return c_value;
		}

		function setCookie(c_name, value, exdays) {
			var exdate = new Date();
			exdate.setDate(exdate.getDate() + exdays);

			var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
			document.cookie = c_name + "=" + c_value;
		}

		if(getCookie('gbnotice') != "1") {
			document.getElementById("cookiebar").style.display = "block";
		}

		function showCookie() {
			setCookie('gbnotice', '1', 365);
			document.getElementById("cookiebar").style.display = "none";
		}
	</script>

	<?php wp_footer(); ?>
</body>
</html>