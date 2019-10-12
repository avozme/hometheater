    <section class="text-left head-section">
         <div class="container">
           <div class="jumbotron-heading">
			   <h1><a href='/'>CINE EN CASA</a></h1>
  		   </div>
           <p>
				<div class="input-group navbar">
					<input type='text' id='search' name='search' class='form-control'>
					<div class="input-group-btn">
						<button class="btn btn-secondary" onclick="launchSearch()">Buscar</button>
					</div>
					<div class="clearfix"></div>
					<div class="input-group-btn">
						@auth
							&nbsp;&nbsp;<a href="{{route('movie.index')}}" class="btn btn-primary">Admin</a>
							&nbsp;&nbsp;<a href="{{route('logout')}}" class="btn btn-warning">Logout</a>
						@endauth
						@guest
							&nbsp;&nbsp;<a href="{{route('login')}}" class="btn btn-warning">Login</a>
						@endguest
					</div>
					
				</div>				 
				<small id="searchHelp" class="text-danger"></small>      
           </p>
         </div>
    </section>
