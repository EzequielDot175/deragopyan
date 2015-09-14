
(function($){
	$.fn.OrganiManager = function(id){
		var id = $('#'+id)[0];
		var organigrama;
		var chart;
		var img = $('input[name="plug"]').val()+"/img/";
		var template = '<div class="organibox addEmployer">\
							<img src="'+img+'user.png" alt="" />\
							<h4>Nombre</h4>\
						</div>';
		var functions = {
			initData : function(){
				var data = new google.visualization.DataTable();
			    data.addColumn('string', 'Name');
			    data.addColumn('string', 'Manager');
			    data.addRows(this.initCollection());
			    console.log(data.setRowProperty);
			    return data;
			},
			setClassFilters: function(className){
				var close = this.closeWindow;
				$('.'+className).click(function(event){
					$('#organi-selector').animate({opacity: 1}, 500);
					$('#organi-selector').css('zIndex', '1');
				});
				$('#close-organi-filter').click(function(event) {
					event.preventDefault();
					close.apply();
				});
			},
			toggleSelectorFilter : function(){
				$('.results .block-result').click(function(event) {
					event.preventDefault();
					$('.results .block-result').removeClass('selected');
					$(this).addClass('selected');
				});
			},
			closeWindow: function(){
				$('#organi-selector').animate({opacity: 0}, 500);
				setTimeout(function(){
					$('#organi-selector').css('zIndex', '-1');
				}, 500);
			},
			actionSearch: function(id,plug,callback){
				$('#'+id).submit(function(event) {
					event.preventDefault();
					var options = {};
						options.action = plug.action;
						options.get = plug.get;
						options.data = $(this).serializeArray();
						$.post(ajaxurl, options,callback);
				});
			},
			initDraw : function(){
				this.chart()
				chart.draw(this.initData(), {allowHtml:true});
			},
			initArray: [{v: '0', f:template}, ''],
			initCollection: function(){
				return [this.initArray];
			},
			chart: function(){
				chart = new google.visualization.OrgChart(id)
			},
			init: function(){
				google.setOnLoadCallback(this.initDraw());
			},
			add: function(){

			},
			draw : function(){
				// var data = new google.visualization.DataTable();
			 //    data.addColumn('string', 'Name');
			 //    data.addColumn('string', 'Manager');
			 //    data.addRows(this.initCollection());
			}
		}
		console.log(functions);
		return functions;
	};
	$.fn.clickToggle = function(func1, func2) {
        var funcs = [func1, func2];
        this.data('toggleclicked', 0);
        this.click(function() {
            var data = $(this).data();
            var tc = data.toggleclicked;
            $.proxy(funcs[tc], this)();
            data.toggleclicked = (tc + 1) % 2;
        });
        return this;
    };


})(jQuery);
