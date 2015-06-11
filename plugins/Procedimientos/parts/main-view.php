<div class="procedimientos-main">
	<div class="conteiner front">
		<div class="search">
			<p>Ingrese las palabras claves separadas por coma</p>
			<form action="" id="search"><input type="text" name="keywords" placeholder=""><input type="submit" value="Buscar en procesos"></form>
		</div>
		<div class="left">
			<div class="submenu">
				<ul id="menu-procesos">
					<?php wp_list_categories(array("taxonomy" => "procedimientos-categorias") ); ?>
				</ul>

			</div>
		</div>
		<div class="right" id="posts-views">
			<h1>VIEW CONTENT</h1>
		</div>
	</div>
</div>

<script>
	jQuery(document).ready(function($) {
		$('#menu-procesos a').click(function(event) {
			event.preventDefault();
			var id = parseInt($(this).parent()[0].classList[1].replace(/cat-item-/g, ''));
			$.post('/wp-admin/admin-ajax.php', {action: 'getpostsbycategory', id : id}, function(data) {
				$('#posts-views').empty();
				$('#posts-views').append(data);
			});
		});

		$('#search').submit(function(event) {
			event.preventDefault();
			var keywords = $(this).serializeArray()[0].value.split(",");
				refineKeywords = [];
			console.log(keywords);
			$.each(keywords, function(index, val) {
				refineKeywords.push(val.trim());
			});
			$.post('/wp-admin/admin-ajax.php', {action: 'getpostsbykey', keywords : refineKeywords}, function(data) {
				$('#posts-views').empty();
				$('#posts-views').append(data);
			});
		});
	});
</script>