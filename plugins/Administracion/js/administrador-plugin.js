jQuery(document).ready(function($) {

	$.post(ajaxurl, {action:"administradorP", id: id, trueAction: "setLimits"}, function(data) {
		if (data.trim() != "notValue") {
			user_can = JSON.parse(data.trim());
			$('#procedimientos-categorias-all li').hide();
			$('#procedimientos-categoriaschecklist-pop li').hide();
			$.each(user_can, function(index, val) {
				$('#procedimientos-categorias-all #procedimientos-categorias-'+val).show();
				$('#procedimientos-categoriaschecklist-pop #popular-procedimientos-categorias-'+val).show();
			});
		};
	});

	$('.btn-details').click(function(event) {

		var name = $(this).parent().parent().children('.username').text();
		var id = $(this).parent().children('input[type=hidden]').val();
		window.parent.currentViewUser = id;
		$.post(ajaxurl, {action:"administradorP", id: id, trueAction: "getPreferences"} , function(data) {
			$('.display-details input[type=checkbox]').prop("checked",false);
			if (data.trim() != "notValue") {
				selected = JSON.parse(data.trim());
				$.each(selected, function(index, val) {
					$('.display-details input[value='+val+']').prop('checked', true);
				});
			}
			$('.display-details .current-username').text(name);
			$('.display-details').show();

		});
	});


	$('.save-proc-rol').click(function(event) {
		var collection = $('.display-details input[type=checkbox]:checked');
		console.log(collection);
		if (collection.length == 0) {
			alert("Debe seleccionar al menos una area/categoria");
		}else{
			var values = [];
			for (var i = 0; i < collection.length; i++) {
				values.push(parseInt(collection[i].value));
			};
			$.post(ajaxurl, {action:"administradorP", id: window.currentViewUser, trueAction: "setPreferences", values: JSON.stringify(values)} , function(data) {
				alert("Preferencias guardadas correctamente");
			});
		}
	});

	if (window.location.search.search(/taxonomy/ig) > -1) {
		$('#submit').click(function(event) {
			window.location.reload();
		});
	};
	if (window.location.search.search(/procedimientos/ig) > -1) {
		var html = $('#postdivrich').clone(true, true);
		$('#postdivrich').remove();
		$('#postbox-container-2').append(html);

	};

	// postdivrich
	// console.log($('input[type="submit" name="submit" id="submit"]'));
});



function TemplateHtml(){
	this.beneficio = '<div class="item-beneficio">
						<div class="b-mask-bg" style="background:url(#b-mask-bg)"></div>
						<div class="b-mask">
							<div class="b-image" style="background:url(#b-image)"></div>
							<div class="b-logo" style="background:url(#b-logo)"></div>
							<div class="b-title">#b-title</div>
							<div class="b-description">#b-description</div>
							<input type="hidden" class="b-id" name="b-id" value="#b-id">
							<input type="hidden" name="b-l_description" class="b-l_description" value="#b-l_description">
							<input type="hidden" name="b-map" class="b-map" value="#b-map">
							<button class="btn-beneficio">VER BENEFICIO</button>
						</div>
					</div>';
}