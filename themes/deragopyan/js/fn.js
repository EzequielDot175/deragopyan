(function($){
	$.fn.plug = function(plug,params,callback){
		var url = "/wp-admin/admin-ajax.php";
		var options = $.extend(true, params, {action:plug});
		$.post(url, options,callback);
	}
})(jQuery);