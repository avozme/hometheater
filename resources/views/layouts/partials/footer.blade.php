
<script>

		function confirmation() {
			if ($('#baseDir').val() == "") {
				$('#baseDirHelp').empty("");
				$('#baseDirHelp').append("¡Escribe un directorio válido!");
				$('#baseDir').addClass("has-error");
				return false;
			}
			return confirm("Esta acción lanzará una búsqueda de nuevas películas en la ubicación señalada y las añadirá a la base de datos.\nEste proceso puede tardar varios minutos.\n¿Estás seguro de que quieres continuar?");
			
		}

</script>



<footer class="text-muted">

	<div class="container">

		<form action="/movies/scan" method="get" onsubmit="return confirmation()">
			<div class="input-group">
				<input type='text' name='baseDir' id='baseDir' class='form-control' value='/app/public/movies/PELICULAS/' placeholder='Indica aquí un directorio válido para escanear'>
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


