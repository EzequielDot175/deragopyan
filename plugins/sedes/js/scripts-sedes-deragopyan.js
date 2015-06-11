	
// $(document).ready(function() {
	jQuery(document).ready(function($) {

	$('.form-sede-deragopyan .image button').click(function(event) {
		event.preventDefault();
		$('#sede_file_image').trigger('click');
	});

	function readURL(input) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	            $('#preview-sede-image').attr('src', e.target.result);
	        }
	        reader.readAsDataURL(input.files[0]);
	    }
	}

	$('#sede_file_image').change(function(event) {
		readURL(this);
	});

	var horario = {
		horas: [],
		dias: [],
		rangoDias: []
	}

	$('.horarios .row1 .dias .column1 ul li').click(function(event) {
		$(this).hide();
		$('.horarios .row1 .dias .column2 ul li:contains('+$(this).text()+')').show(500);
	});
	$('.horarios .row1 .dias .column2 ul li').click(function(event) {
		$(this).hide();
		$('.horarios .row1 .dias .column1 ul li:contains('+$(this).text()+')').show(500);
	});

	$('#agregarHorario').click(function(event) {
		event.preventDefault();
		var hDesde = $('#desdeHora').val();
		var mDesde = $('#desdeMinutos').val();
		var hHasta = $('#hastaHora').val();
		var mHasta = $('#hastaMinutos').val();
		var PushHorario = hDesde+":"+mDesde+" - "+hHasta+":"+mHasta+" hs";
		if (hDesde < hHasta) {
			horario.horas.push(PushHorario);
			$('.horarios .row2 .hora').empty();
			horaCantidad = horario.horas.length;
			$('.horarios .row1 .hora select option[value=00]').attr('selected', 'selected');
			$.each(horario.horas, function(index, val) {
				$('.horarios .row2 .hora').append('<span>'+val+'</span><br />');
			});
		}else if(hDesde == hHasta){
			alert("La hora inicial no puede ser igual a la final");
		}
		else{
			alert("La hora inicial no puede ser menor a la final");
		}
	});
	$('#clearHorario').click(function(event) {
		event.preventDefault();
		horario.horas = [];
		$('.horarios .row2 .hora').empty();
	});
	$('#agregarDias').click(function(event) {
		event.preventDefault();
		var dias = $('.horarios .row1 .dias .column2 ul li:visible');
		horario.dias = [];
		$.each(dias, function(index, val) {
			 horario.dias.push(val.textContent);
		});
		$('.horarios .row2 .dias').empty();
		$.each(horario.dias, function(index, val) {
			$('.horarios .row2 .dias').append('<span>'+val+'</span><br />');
		});

	});

	$('#rangeDays').click(function(event) {
		event.preventDefault();
		var start = $('#rangeDayStart').val();
		var end = $('#rangeDayEnd').val();
		var rangeDays =  "De "+start+" a "+end;
		horario.rangoDias.push(rangeDays);
		$('.horarios .row2 .rangeDays').empty();
		$.each(horario.rangoDias, function(index, val) {
			$('.horarios .row2 .rangeDays').append('<span>'+val+'</span><br />');
		});

	});

	$('#clearRangeDays').click(function(event) {
		event.preventDefault();
		$('.horarios .row2 .rangeDays').empty();
		horario.rangoDias = [];
	});

	$('#clearDias').click(function(event) {
		event.preventDefault();
		$('.horarios .row2 .dias').empty();
		horario.dias = [];
	});

	var horarioDefinido = [];


	$('#cargarHorarioTotal').click(function(event) {
		event.preventDefault();
		var lH = horario.horas.length;
		var lD = horario.dias.length;
		var lRD = horario.rangoDias.length;
		
		if (lH > 0 || lD > 0 || lRD > 0 ) {
			horarioDefinido.push(horario);

			var htmlDias = $('.horarios .row2 .dias');
			var htmlHora = $('.horarios .row2 .hora');
			var htmlRange = $('.horarios .row2 .rangeDays');
			var jsonString = JSON.stringify(horarioDefinido);
			$('#sede_deragopyan_horario').val(jsonString);


			$('.horarios .row2 .definidos').append('<div>\
				'+htmlDias[0].innerHTML+htmlHora[0].innerHTML+htmlRange[0].innerHTML+'\
				</div>');
			if (horarioDefinido.length > 0) {
				horario.dias = [];
				horario.horas = [];
				horario.rangoDias = [];
				$('.horarios .row2 .dias').empty();
				$('.horarios .row2 .hora').empty();
				$('.horarios .row2 .rangeDays').empty();
			};
		}else{
			alert("Los horarios no pueden estar vacios");
		}
	});

	$('#borrarHorarios').click(function(event) {
		event.preventDefault();
		if (confirm("¿Esta seguro que desea eliminar los horarios existentes?")) {
			$('#sede_deragopyan_horario').val("");
			$('.horarios .row2 .definidos').empty();
		};
	});

	$('#AgregarMedio').click(function(event) {
		event.preventDefault();
		var valueMedio = $('#SeleccionarMedio').val();
		var textMedio = $('#SeleccionarMedio option:selected').text();
		$('.newMedios').append('<div><input class="newInputMedio" type="text" name="'+valueMedio+'" placeholder="'+textMedio+'" /><button class="unsetInput" alt="Eliminar" ><i class="fa fa-times"></i></button></div>');
	});

	$('.unsetInput').live('click', function(event) {
		event.preventDefault();
		$(this).parent().remove();
	});

	$('.buttonDiv').click(function(event) {
		event.preventDefault();
	});
	$('.buttonDiv.ubicacion-mapa').click(function(event) {
		$('.maps.hidden').toggle();
	});
	$('.buttonDiv.horarios-sede').click(function(event) {
		$('.horarios.hidden').toggle();
	});
	$('.buttonDiv.medios-sede').click(function(event) {
		$('.medios.hidden').toggle();
	});



	if ($('#sede_deragopyan_horario').val() != "" && $('#sede_deragopyan_horario').val() != undefined) {
			horarioDefinido = JSON.parse($('#sede_deragopyan_horario').val());
			console.log(horarioDefinido);
			
			var html = "<div>";
			for (var i = 0; i < horarioDefinido.length; i++) {
				horarioDefinido[i].horas
				if (horarioDefinido[i].horas.length > 0) {
					for (var z = 0; z < horarioDefinido[i].horas.length; z++) {
						html += "<span>"+horarioDefinido[i].horas[z]+"</span><br />";
					};
				};
				if (horarioDefinido[i].dias.length > 0) {
					for (var z = 0; z < horarioDefinido[i].dias.length; z++) {
						html += "<span>"+horarioDefinido[i].dias[z]+"</span><br />";
					};
				}
				if (horarioDefinido[i].rangoDias.length > 0) {
					for (var z = 0; z < horarioDefinido[i].rangoDias.length; z++) {
						html += "<span>"+horarioDefinido[i].rangoDias[z]+"</span><br />";
					};
				}
				html += "</div>";
				$('.horarios .row2 .definidos').append(html);
				html = "";
			};
		};


});

// });		

		

