var $ = jQuery.noConflict();

$(function(){

	/**
	 * gb Slider plugin
	 * version 1.0
	 */

	$.fn.Slider = function(options)
	{
		var opt = {};

		this.each(function(){

			if (options) {
				$.extend(opt, options);
			}

			var container = $(this);

			var Slider = function()
			{
				this.articles = container.find('article');
				this.articleList = (this.articles.length) - 1;
				this.prevLink = container.find('.slider-navbar').find('a.prev');
				this.nextLink = container.find('.slider-navbar').find('a.next');
				this.thumbs = container.find('.slider-thumbs').find('.thumb-link');

				this.getCurrentIndex = function()
				{
					return this.articles.filter('.active-article').index();
				};

				this.go = function(index)
				{
					this.articles
						.removeClass('active-article')
						.fadeOut(300)
						.eq(index)
						.fadeIn(300)
						.addClass('active-article');
					this.thumbs
						.removeClass('active-thumb')
						.eq(index)
						.addClass('active-thumb');
				};

				this.next = function()
				{
					var index = this.getCurrentIndex();
					if (index < this.articleList) {
						this.go(index + 1);
					} else {
						this.go(0);
					}
				};

				this.prev = function()
				{
					var index = this.getCurrentIndex();
					if (index > 0) {
						this.go(index - 1);
					} else {
						this.go(this.articleList);
					}
				};

				this.init = function()
				{
					this.articles.first().addClass('active-article');
					this.thumbs.first().addClass('active-thumb');
				};
			};

			var slider = new Slider();
			slider.init();

			slider.nextLink.on('click', function(e){
				e.preventDefault();
				slider.next();
			});

			slider.prevLink.on('click', function(e){
				e.preventDefault();
				slider.prev();
			});

			slider.thumbs.find('img').on('click', function(e){
				e.preventDefault();
				slider.go($(this).parent().index());
			});
		}); 
	}

	$(".slider").Slider();

	var mailchimpForm = $('#subscribe')

	mailchimpForm.on('click', function(e) {

		$(this).attr("disabled", true);
		$(".subscribe-msg").html('<div class="alert alert-info">Procesando... Espera por favor.</div>');

		var params = {
			'action': 'gb_subscribe',
			'email': $("#email").val()
		};

		$.ajax({
			url: 'http://localhost/ganemosbits.trade/wp-admin/admin-ajax.php', 
			data: params,
			type: 'POST',
			dataType: 'json',
			success: function(response) {
				response = $.parseJSON(response);
				console.log(response);
				if (response.id) {
					$("#email").val('');
					$('#subscribe').attr("disabled", false);
					$(".subscribe-msg").html('<div class="alert alert-success">¡Felicidades! Te has suscrito con éxito a nuestra lista de correos. Verifica tu correo electrónico para terminar el proceso..</div>');
				} else {
					$('#subscribe').attr("disabled", false);
					$(".subscribe-msg").html('<div class="alert alert-warning">¡Oops! Algo ha salido mal, intenta de nuevo más tarde.<br>Error: ' + response.status + ' ' + response.title + '<br>Detalles: ' + response.detail + '</div>');
				}
			}
		});

		e.preventDefault();
	});

	function valid_email_address(email)
	{
		var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
		return pattern.test(email);
	}
});