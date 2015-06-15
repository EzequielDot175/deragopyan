jQuery(document).ready(function($) {
	//formularios general
	// Programado de forma en que funcione en todos los formularios de directorio sin tener que especificar un nombre especifico
	



	$('#optionList li button.edit ').on('click', function(event) {
		event.preventDefault();
		$(this).hide();
		$(this).parent().children('.valueOption').removeAttr('disabled');
		$(this).parent().children('.save').show();
	});
	$('#optionList li button.save ').on('click', function(event) {
		event.preventDefault();
		var valueID = $(this).parent().children('input[name="optionID"]').val();
		var optionInput = $(this).parent().children('.valueOption');
		var postName = $(this).parent().children('input[name="postName"]').val();
		if (optionInput.val() != "") {
			$(this).hide();
			optionInput.attr('disabled','');
			$(this).parent().children('.edit').show();
			params = {id : valueID, value: optionInput.val(), action: postName, actionOption: "edit"}
			$.post(ajaxurl, params);
		}else{
			alert("El campo que desea guardar esta vacio, necesita completarlo");
		}
	});
	$('#optionList li button.delete ').on('click', function(event) {
		event.preventDefault();
		var valueID = $(this).parent().children('input[name="optionID"]').val();
		var spanText = $(this).parent().children('span').text();
		var check = confirm("¿Esta seguro que desea eliminar este "+spanText+"?");
		var postName = $(this).parent().children('input[name="postName"]').val();
		if (check) {
			$(this).parent().remove();
			params = {id : valueID, action: postName, actionOption: "delete"};
			$.post(ajaxurl,params,function(data){console.log(data)});
		};
	});	


	// $('.data-form').on('submit', function(event) {
	// 	var span = $('.data-form span').text();
	// 	if ($('.data-form .data-value').val() == "") {
	// 		event.preventDefault();
	// 		alert(span+" no puede estar vacio");
	// 	};
	// });
	// function ajax_post_directorio_deragopyan(params){
	// 	console.log(params);
	// 	$.post(ajaxurl, params, function(data) {
	// 		console.log(data);
	// 	});
	// }




	// $('.selectOptions').on('change',function(event) {
	// 	event.preventDefault();
	// 	switch($(this).val()){
	// 		case 'eliminar':
	// 			$('input.edit').toggle();
	// 			break;
	// 		default:
	// 		$('input.edit').toggle();
	// 		$('.modificar');
	// 			break;
	// 	}
	// });
	// $('.modificar').click(function(event) {
	// 	var form = $('#form-ajax').val();
	// 	var editNameInput = $('input.edit');
	// 	var editName = editNameInput.val();
	// 	var actionOptions = $('.selectOptions').val();
	// 	var selectValue = $('#selectValues').val();
	// 	var activeValue = $('#selectValues option:selected');
	// 	var textValue = activeValue.text();

	// 	params = {
	// 		action: form,
	// 		id: selectValue
	// 	}
	// 	switch(actionOptions){
	// 		case "editar":
	// 			if (editName != "") {
	// 				params.edit = editName;
	// 				ajax_post_directorio_deragopyan(params);
	// 				activeValue.text(editName);
	// 				editNameInput.val("");
	// 			}else{alert("El valor del campo seleccionado no puede estar vacio");};

	// 			break;
	// 		case "eliminar":
	// 			if (confirm("¿Esta seguro de eliminar "+textValue+" ?")) {
	// 				params.unset = selectValue;
	// 				activeValue.remove();
	// 				ajax_post_directorio_deragopyan(params);
	// 			};
	// 			break;
	// 	}
		
	// });

});