


jQuery(document).ready(function($) {
	var url = "/wp-admin/admin-ajax.php";
	var content = $('.data-categories');

	$('li[id^="list-item-"]').click(function(event) {
		var id = parseInt($(this).attr('id').replace(/list-item-/ig, ''));
		var params = {action: 'stepone', id : id}
		$.post(url,params, function(data) {

			var result = $.parseJSON(data.trim());
			var html = '<div class="item-box-category"  id="item-box-{{id}}"><span {{special}} >{{nombre}}</span></div>';
			console.log(result);
			content.empty();

			$.each(result, function(index, val) {
				var words = val.nombre.split(" ").length;
				if (words > 1) {
					var newHtml = html
								.replace(/{{id}}/, val.id)
								.replace(/{{nombre}}/, val.nombre)
								.replace(/{{special}}/ig, "style='top:17px;'");
				}
				else{
					var newHtml = html
								.replace(/{{id}}/, val.id)
								.replace(/{{nombre}}/, val.nombre)
								.replace(/{{special}}/ig, "style='top:29px;'");
				}
				
				content.append(newHtml);
			});

		});
	});



	// SUB CATEGORIAS

	$(document).on('click', 'div[id^="item-box-"]', function(event) {
		var id = parseInt($(this).attr('id').replace(/item-box-/ig, ''));
		
	});

	
	

});