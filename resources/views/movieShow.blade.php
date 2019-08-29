@extends('layouts.mainlayout')

@section('content')
   <div class="album text-muted content-section">
     <div class="container">
       <div class="row">
          <div class="col-md-12">
          <h3>
			 @if(isset($infoText)) {{ $infoText }}
			 @else Ficha de película
			 @endif
 		  </h3>
 		  </div> <!-- col-md-12 -->
		  <p>
				<div class='col-md-12'>
					<div class='card mb-12 box-shadow'>
						<div class="card-body">
							<div class="card-text">
								<img src="/movies/covers/{{$movie->cover}}" style="float: left; padding-right: 30px"/>
								<!-- Movie title -->
								<h3>{{$movie->title}}</h3>
								<!-- Movie rating (1 to 10 stars) -->
								@for ($i = 1; $i <= 10; $i++)
									@if ($i <= $movie->rating) 
										<i class="fa fa-star" style='color: orange'></i>
									@else
										<i class="fa fa-star" style='color: dark-grey'></i>
									@endif
								@endfor
								<p>&nbsp;</p>
								<!-- Movie generic data: year, duration...-->
								<h5>
									{{$movie->year}} | {{$movie->duration}} minutos<br>
								</h5>
								<!-- Movie genres -->
								@foreach ($movie->genres as $genre)
									<a href='/movies/search/{{$genre->name}}'>{{$genre->name}}</a>
									@if (!$loop->last) |
									@endif
								@endforeach
								<p>&nbsp;</p>
								<!-- Movie direction -->
								<h5>Dirección</h5> 
									@foreach ($directors as $director) 
										<a href='/movies/search/{{ $director->name }}'>{{ $director->name }}</a> 
										@if(!$loop->last) |
										@endif
									@endforeach
								</p>
								<div class='card-body'>
								<!-- Movie cast -->
								<h5>Reparto</h5>
									@foreach ($actors as $actor) 
										<a href='/movies/search/{{ $actor->name }}' >{{ $actor->name }}</a>
										@if(!$loop->last) |
										@endif
									@endforeach
								</p>
							</div> <!-- card-text -->
							<!-- Movie "play" and "external link" buttons -->
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<button type="button" class="btn btn-sm btn-primary" onclick="location.href='/movies/{{$movie->fileDirName}}/{{$movie->fileName}}'">Reproducir</button>
									&nbsp;&nbsp;
									<button type="button" class="btn btn-sm btn-outline-secondary" onclick="location.href='/movie/edit/{{$movie->id}}'">Editar</button>
									&nbsp;&nbsp;
									<button type="button" class="btn btn-sm btn-outline-secondary" onclick="location.href='https://www.filmaffinity.com{{$movie->link}}'">Más info</button>
									&nbsp;&nbsp;
									<button type="button" class="btn btn-danger btn-xs" onclick="deleteMovieConfirmation({{$movie->id}})">Borrar</button>
								</div> <!-- btn-group -->
							</div> <!-- d-flex -->
								<p>&nbsp;</p>
								<form action="/movie/scan/{{$movie->id}}" method="get" onsubmit="return scanMovieConfirmation()">
									<div class="input-group">
										<input type='text' name='movieUrlInput' id='movieUrlInput' class='form-control' value="{{$movie->link}}" placeholder='Escribe aquí la parte final de la URL de la película (ej: /es/film358476.html)'>
										<div class="input-group-btn">
											<button type="submit" class="btn btn-secondary">Re-escanear película</button>
										</div>
									</div>
									<small id="movieUrlHelp" class="text-danger"></small>      
								</form>
						</div> <!-- card-body -->
					</div> <!-- card -->
				</div> <!-- col-md -->		
		  </p>
		</div> <!-- row -->
     </div> <!-- container -->
   </div> <!-- album text-muted -->
@endsection
