    <script>
		function launchSearch() {
			searchString = $('#search').val();
			if (searchString == "") {
				$('#searchHelp').empty("");
				$('#searchHelp').append("¡Nada que buscar!");
				$('#search').addClass("has-error");
			} else {
				location.href='/movies/search/' + searchString;
			}
		}
    </script>
    <section class="text-left">
         <div class="container">
           <h1 class="jumbotron-heading"><a href='/'>HOME TEATHER</a></h1>
           <p>
				<div class="input-group">
					<input type='text' id='search' name='search' class='form-control'>
					<div class="input-group-btn">
						<button class="btn btn-secondary" onclick="launchSearch()">Buscar</button>
					</div>
				</div>				 
				<small id="searchHelp" class="text-danger"></small>      
           </p>
         </div>
    </section>
