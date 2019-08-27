    <footer class="text-muted">
         <div class="container">
		
				 <input type='text' name='baseDir' id='baseDir' value=''>
				 <a href="#" class="btn btn-secondary" onclick="confirmation()">Escanear ubicación</a>
           <p class="float-right">
             <a href="#">Volver arriba</a>
           </p>
           <p>&copy; 2019 A. M. Vozmediano</p>
           <p>New to Bootstrap? <a href="../../">Visit the homepage</a> or read our <a href="../../getting-started/">getting started guide</a>.</p>
         </div>
       </footer>



	<script>

		function confirmation() {
			if (confirm("Esta acción lanzará una búsqueda de nuevas películas en su ubicación actual. Este proceso puede tardar varios minutos. ¿Está seguro?")) {
				location.href = '/movies/scan';
			}

	</script>
