


jQuery(document).ready(function($) {
	function TemplateHtml(){
		this.uploadDir = 'http://'+window.location.host+"/wp-content/uploads/";
		this.beneficio = '<div class="item-beneficio">\
							<div class="b-mask-bg" style="background:url(#b-mask-bg)"></div>\
							<div class="b-mask">\
								<div class="b-image" style="background:url(#b-image)"></div>\
								<div class="b-logo" style="background:url(#b-logo)"></div>\
								<div class="b-title">#b-title</div>\
								<div class="b-description">#b-description</div>\
								<input type="hidden" class="b-id" name="b-id" value="#b-id">\
								<input type="hidden" name="b-l_description" class="b-l_description" value="#b-l_description">\
								<input type="hidden" name="b-map" class="b-map" value="#b-map">\
								<button class="btn-beneficio">VER BENEFICIO</button>\
							</div>\
						</div>';
		this.boxOrgani = '<div><img src="/wp-content/plugins/Organigrama/img/user.png" alt="" title=""/></div>';

		this.onTemplate = function(expr,param){
			var html = this[expr];
			$.each(param, function(index, val) {
				var re = new RegExp(val.before,"ig");
				html = html.replace(re, val.after);
			});
			return html;
		}

	}
	window.parent.TemplateHTML = new TemplateHtml();





	$('.button.category-add-submit').click(function(event) {
		window.location.reload();
	});

});
