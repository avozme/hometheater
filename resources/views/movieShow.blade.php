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
									<a href="{{route('movie.search', $genre->name)}}">{{$genre->name}}</a>
									@if (!$loop->last) |
									@endif
								@endforeach
								<p>&nbsp;</p>
								<!-- Movie direction -->
								<h5>Dirección</h5> 
									@foreach ($directors as $director) 
										<a href="{{route('movie.search',$director->name)}}">{{ $director->name }}</a> 
										@if(!$loop->last) |
										@endif
									@endforeach
								</p>
								<div class='card-body'>
								<!-- Movie cast -->
								<h5>Reparto</h5>
									@foreach ($actors as $actor) 
										<a href="{{route('movie.search',$actor->name)}}" >{{ $actor->name }}</a>
										@if(!$loop->last) |
										@endif
									@endforeach
								</p>
							</div> <!-- card-text -->

							<!-- Buttons -->
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<!-- More info button -->
									<button type="button" class="btn btn-sm btn-outline-secondary" onclick="location.href='https://www.filmaffinity.com{{$movie->link}}'">Más info</button>
									@auth
										<!-- Edit button -->
										&nbsp;&nbsp;
										<button type="button" class="btn btn-warning btn-xs" onclick="location.href='/movie/{{$movie->id}}/edit'">Editar</button>
										<!-- Delete button -->
										&nbsp;&nbsp;
										<!--<form action="{{route('movie.destroy', $movie->id)}}">-->
										<form action="/movie/{{$movie->id}}/destroy">
											@csrf
											@method("DELETE")
											<button type="submit" class="btn btn-danger btn-xs" onclick="deleteMovieConfirmation()">Borrar</button>
										</form>
									@endauth
								</div> <!-- btn-group -->
							</div> <!-- d-flex -->
							<p>&nbsp;</p>
							
							<!-- Play Button -->
							<div class="input-group">
								<input type='text' readonly='true' name='movieFullPath' id='movieFullPath' class='form-control' value="/movies{{$movie->fileDirName}}/{{$movie->fileName}}" >
								<div class="input-group-btn">
									<button type="button" class="btn btn-primary" onclick="location.href={{route('movie.play',$movie->id)}}">Reproducir</button>
								</div>
							</div>

							<!-- Rescan Button -->
							<hr>
							<form action="{{route('movie.scanOne',$movie->id)}}" method="get" onsubmit="return scanMovieConfirmation()">
								<div class="input-group" style='padding-left: 30%; padding-right: 30%'>
									<input type='text' name='movieUrlInput' id='movieUrlInput' class='form-control' value="{{$movie->link}}" placeholder='Escribe aquí la parte final de la URL de la película (ej: /es/film358476.html)'   style='font-size: 75%' width='50%'>
									<div class="input-group-btn">
										<button type="submit" class="btn btn-secondary"   style='font-size: 75%'>Rescanear película</button>
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
