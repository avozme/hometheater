
<footer class="text-muted footer-section">

	<div class="container">

		<form action="/movies/scan" method="get" onsubmit="return scanDirConfirmation()">
			<div class="input-group">
				<input type='text' name='baseDir' id='baseDir' class='form-control' value='/app/public/movies/Películas/' placeholder='Indica aquí un directorio válido para escanear'>
				<div class="input-group-btn">
					<button type="submit" class="btn btn-secondary">Escanear esta ubicación</button>
				</div>
			</div>
			<small id="baseDirHelp" class="text-danger"></small>      
		</form>

		<p>&nbsp;</p>
		<p class="float-right">
			<a href="#">Volver arriba</a>
		</p>

	</div>

</footer>


