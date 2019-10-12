@extends('layouts.mainlayout')

@section('content')
   <div class="album text-muted">
     <div class="container">
       <div class="row">
          <div class="col-md-12">
			  <div class="infotext">
				 @if(isset($infoText)) <h3>{{ $infoText }}</h3>
				 @endif
			  </div>
			  @if (isset($genres))
				@foreach ($genres as $genre)
					<a href='{{route("movie.search",$genre->name)}}'>{{$genre->name}}</a>
					@if(!$loop->last) |
					@endif
				@endforeach
			  @endif
			  <br>
			  <div class="headtext">
				 <br>&nbsp;<br>
				 @if(!isset($infoText))
					<h3>Todas las películas</h3>
				 @endif
				 @auth
					<div class="btn btn-warning pull-right"><a href=''>Añadir nueva</a></div>
				 @endauth
			  </div>
 		  </div> <!-- col-md-12 -->
		  <p>
				@foreach ($movies as $movie)
				<div class='col-md-3'>
					<div class='card mb-3 box-shadow'>
						<a href='{{route("movie.show",$movie->id)}}'>
						<img class="card-img-top" src='{{url("/movies/covers/$movie->cover")}}' width='200'/><br/>
						</a>
						<div class="card-body">
							<div class="card-text">
								<a href='{{route("movie.show",$movie->id)}}'>
								{{$movie->title}}
								</a>
								<br>{{$movie->year}} | {{$movie->rating}} <i class="fa fa-star" style='color: orange'></i>
								@auth
									<br>
									<button type="button" class="btn btn-warning btn-xs" onclick="location.href=''">Editar</button>
									&nbsp;&nbsp;
									<button type="button" class="btn btn-danger btn-xs" onclick="deleteMovieConfirmation({{$movie->id}})">Borrar</button>
								@endauth
							</div> <!-- card-text -->
							<div class="d-flex justify-content-between align-items-center">
							</div> <!-- d-flex -->
						</div> <!-- card-body -->
					</div> <!-- card -->
				</div> <!-- col-md -->		
				@endforeach
		  </p>
		</div> <!-- row -->
     </div> <!-- container -->
   </div> <!-- album text-muted -->
@endsection
