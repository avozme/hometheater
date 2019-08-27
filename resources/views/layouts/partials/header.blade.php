    <script>
		function launchSearch() {
			searchString = $('#search').val();
			if (searchString != "") {
				location.href='/movies/search/' + searchString;
			}
		}
    </script>
    <section class="text-left">
         <div class="container">
           <h1 class="jumbotron-heading"><a href='/'>HOME TEATHER</a></h1>
           <!--<p class="lead text-muted">Selecciona una película de la lista o pulsa "Buscar de nuevo" para escanear el disco.</p>-->
           <p>
				 <input type='text' id='search' name='search'>
				 <a href='#' class='btn btn-primary' onclick="launchSearch()">Buscar</a><br>
           </p>
         </div>
    </section>
