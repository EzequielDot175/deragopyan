jQuery(document).ready(function($) {
	
	// $('button.insert').on('click', function(event) {
	// 	event.preventDefault();
	// 	var param = {};
	// 	param.thisVal = $(this).parent().children('.valueInsert').val();
	// 	param.thisType = $(this).parent().children('input[type="hidden"]').val();
	// 	param.action = "categorias_areas";
	// 	param.classAction = "insert";
	// 	console.log(param);
	// 	if (param.thisVal != "") {
	// 		$.post(ajaxurl, param, function(data) {
	// 			id = data.trim();
	// 			id = parseInt(id);
	// 				$('#'+param.thisType).append('<li>\
	// 						<input type="text" disabled value="'+param.thisVal+'" class="inputEdit">\
	// 				        <input type="hidden" value="'+id+'">\
	// 				        <button class="save">Guardar</button>\
	// 				        <button class="edit">Editar</button>\
	// 				        <button class="delete">Borrar</button>\
	// 				      </li>');
	// 				$('.input'+param.thisType).val("");
	// 				$('.list'+param.thisType).append('<option value="'+id+'">'+param.thisVal+'</option>');
	// 		});
	// 	}else{
	// 		alert("No se puede tener el campo de la nueva opcion vacia");
	// 	}

	// });
	
	// $(document).on('click','button.save,button.delete', function(event) {
	// 	event.preventDefault();
	// 	console.log();
	// 	var param = {};
	// 	param.classAction = $(this).attr('class');
	// 	param.action = "categorias_areas";
	// 	$(this).parent().children('.inputEdit').attr('disabled', '');
	// 	param.thisVal = $(this).parent().children('.inputEdit').val();
	// 	param.id = $(this).parent().children('input[type=hidden]').val();

	// 	if (param.classAction == "save") {
	// 		$(this).hide();
	// 		$(this).parent().children('.edit').show();
	// 		$.post(ajaxurl, param);
	// 		$('option[value="'+param.id+'"]').text(param.thisVal);
	// 	};
	// 	if (param.classAction == "delete") {
	// 		var question = confirm("¿Esta seguro que desea eliminar esta opcion?");
	// 		if (question) {
	// 			$(this).parent().remove();
	// 			$.post(ajaxurl, param, function(data) {
	// 				console.log(data);
	// 			});
	// 			console.log(param);
	// 			$('option[value="'+param.id+'"]').remove();
	// 		};
	// 	}; 
	// });

	// $(document).on('click','button.edit', function(event) {
	// 	event.preventDefault();
	// 	$(this).parent().children('.inputEdit').removeAttr('disabled');
	// 	$(this).parent().children('.save').show();
	// 	$(this).hide();
	// });	

	// $(document).on('change', 'select', function(event) {
	// 	event.preventDefault();
	// 	var param = {};
	// 	param.value = parseInt($(this).val());
	// 	param.id = parseInt($(this).parent().parent().children('.id').text());
	// 	param.option = $(this).attr('class');
	// 	param.action = "categorias_areas";
	// 	param.classAction = "update_user";

	// 	var status = $(this).parent().parent().children('.status');
	// 	$.post(ajaxurl, param, function(data) {
	// 		var response = data.trim()
	// 		status.text(response);
	// 	});

	// });
	
});