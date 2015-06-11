<div class="admin-proc-roles">
	<h3>Usuarios de tipo procedimientos</h3>
	<div class="table-users">
		<div class="labels menu">
			<div class="name">
				Nombre
			</div>
			<div class="username">
				Nombre de usuario
			</div>
			<div class="rol">
				Rol
			</div>
			<div class="controls">
			</div>
		</div>
		<!-- fetch -->
		<?php $this->fetchProcedimientosUsers(); ?>
	</div>
		<!-- /fetch -->
	<div class="display-details">
		<div class="current-username">
		</div>
		<div>
			<h5>Areas permitidas</h5>
			<div class="fetch-areas">
				<ul>
					<?php foreach($this->getProcTaxonomy() as $k => $v): ?>
						<li><input type="checkbox" value="<?php echo $v["id"]; ?>"><span><?php echo $v["name"]; ?></span></li>
					<?php endforeach; ?>
				</ul>
				<button class="save-proc-rol">Guardar preferencias</button>
			</div>
		</div>

	</div>
</div>


	
