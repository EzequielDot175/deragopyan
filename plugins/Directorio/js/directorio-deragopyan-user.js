$(document).ready(function() {
		
		
		$(document).on('click', '.reset-query', function(event) {
			event.preventDefault();
			/* Act on the event */
			$.post('/wp-admin/admin-ajax.php', {action: "directorio_search", reset: true}, function(data, textStatus, xhr) {
					if (data.trim().length == 0) {
						alert("No se obtuvieron resultados");
					}else{
						$('#search_directorio select').val("");
						$('#search_directorio input[type="text"]').val("");
						$('.directorio-main-container').empty();
						$('.directorio-main-container').html(data);
					}
				});
		});

		$(document).on('click', '.directorio-profile-user', function(event) {
			event.preventDefault();
			var id  = $(this).children('.dir-get').val();
				console.log(id);
				$('.directorio-main-container').empty();
				$.post('/wp-admin/admin-ajax.php', {action: "directorio_search", detail_user: true,id_user: id}, function(data) {
					$('.directorio-main-container').html(data);
				});
		});
		$(document).on('click', '#button-dir-contacto', function(event) {
			event.preventDefault();
			var boxForm = $("#button-dir-contacto").parent().parent().parent().children(".directorio-contacto-form");
			boxForm.css("display","block");
			boxForm.animate({opacity:1},1000);
		});	
		$(document).on('click', '.closeFormDirectorio', function(event) {
			event.preventDefault();
			$(".closeFormDirectorio").parent().parent().animate({opacity: 0}, 1000,function(){$(this).css('display', 'none')});
		});	


		$('#search_directorio').submit(function(event) {
			event.preventDefault();
			var count = 0;
			var form = $(this).serializeArray();
			var keywords = [];
			var keywordInput = $('#keywords').val();
			var subkeys = keywordInput.split(",");
			for (var i = 0; i < subkeys.length; i++) {
				keywords.push(subkeys[i].trim());
			};
			for (var i = 0; i < form.length; i++) {
				if (form[i].value != "") {count++};
			};
			if (count != 0 || keywordInput != "") {
				$.ajax({
					url: '/wp-admin/admin-ajax.php',
					type: 'POST',
					data: {datos: form,action: "directorio_search", keys: keywords},
					success: function(data){
						if (data.trim().length == 0) {
							alert("No se obtuvieron resultados");
						}else{
							$('.directorio-main-container').empty();
							$('.directorio-main-container').html(data);
						}
					}
				});
				
			}else{
				alert("Debe seleccionar al menos una opcion para realizar búsqueda avanzada");
			}

		});
		

		

	});