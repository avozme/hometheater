@extends('layouts.mainlayout')

@section('content')
   <div class="album text-muted">
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
										<img src='/imgs/star-yellow.png' height='20'>
									@else
										<img src='/imgs/star-grey.png'  height='20'>
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
									<button type="button" class="btn btn-sm btn-outline-secondary" onclick="location.href='{{$movie->link}}'">Más info</button>
									&nbsp;&nbsp;
									<button type="button" class="btn btn-danger btn-xs" onclick="deleteConfirmation({{$movie->id}})">Borrar</button>
									&nbsp;&nbsp;
								</div> <!-- btn-group -->
							</div> <!-- d-flex -->
						</div> <!-- card-body -->
					</div> <!-- card -->
				</div> <!-- col-md -->		
		  </p>
		</div> <!-- row -->
     </div> <!-- container -->
   </div> <!-- album text-muted -->
@endsection

<script>
	function deleteConfirmation(idMovie) {
		if (confirm("¿Estás seguro de que deseas borrar esta película?\n(El archivo NO se eliminará del disco duro)")) {
			location.href="/movie/delete/" + idMovie;
		}
	}
</script>
