<div class="hora">
	<select id="desdeHora">
		<option value="00">00</option>
		<option value="01">01</option>
		<option value="02">02</option>
		<option value="03">03</option>
		<option value="04">04</option>
		<option value="05">05</option>
		<option value="06">06</option>
		<option value="07">07</option>
		<option value="08">08</option>
		<option value="09">09</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
	</select>
	:
	<select id="desdeMinutos">
		<option value="00">00</option>
		<option value="30">30</option>
	</select>

	A

	<select id="hastaHora">
		<option value="00">00</option>
		<option value="01">01</option>
		<option value="02">02</option>
		<option value="03">03</option>
		<option value="04">04</option>
		<option value="05">05</option>
		<option value="06">06</option>
		<option value="07">07</option>
		<option value="08">08</option>
		<option value="09">09</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
	</select>

	<select id="hastaMinutos">
		<option value="00">00</option>
		<option value="30">30</option>
	</select>
	<span>Hs</span>
	<button id="agregarHorario"><i class="fa fa-plus"></i> Agregar horario/s</button>
	<button id="clearHorario">Limpiar horarios</button>
</div>
<div class="dias">
	<h4>Dias</h4>
	<div class="column1">
		<ul>
			<li>Domingo</li>
			<li>Lunes</li>
			<li>Martes</li>
			<li>Miercoles</li>
			<li>Jueves</li>
			<li>Viernes</li>
			<li>Sabado</li>
		</ul>
	</div>
	<div class="column2">
		<ul>
			<li>Domingo</li>
			<li>Lunes</li>
			<li>Martes</li>
			<li>Miercoles</li>
			<li>Jueves</li>
			<li>Viernes</li>
			<li>Sabado</li>
		</ul>
	</div>
	<button id="agregarDias">Cargar dias</button>
	<button id="clearDias">Limpiar dias cargados</button>

	<div class="perRange">
		<h4>Rango dias</h4>
		De
		<select id="rangeDayStart">
			<option value="domingo">Domingo</option>
			<option value="lunes">Lunes</option>
			<option value="martes">Martes</option>
			<option value="miercoles">Miercoles</option>
			<option value="jueves">Jueves</option>
			<option value="viernes">Viernes</option>
			<option value="sabado">Sabado</option>
		</select>
		A
		<select id="rangeDayEnd">
			<option value="domingo">Domingo</option>
			<option value="lunes">Lunes</option>
			<option value="martes">Martes</option>
			<option value="miercoles">Miercoles</option>
			<option value="jueves">Jueves</option>
			<option value="viernes">Viernes</option>
			<option value="sabado">Sabado</option>
		</select>
		<br>
		<button id="rangeDays">Cargar rango de dias</button>
		<button id="clearRangeDays">Limpiar rango de dias</button>
	</div>
</div>

<button id="cargarHorarioTotal">Cargar Horario</button>
<button id="borrarHorarios">BorrarHorarios</button>