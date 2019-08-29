@extends('layouts.mainlayout')

@section('content')
   <div class="album text-muted">
     <div class="container">
       <div class="row">
          <div class="col-md-12">
          <h3>
			 @if(isset($infoText)) {{ $infoText }}
			 @endif
 		  </h3>
		  @if (isset($genres))
			@foreach ($genres as $genre)
				<a href='/movies/search/{{$genre->name}}'>{{$genre->name}}</a>
				@if(!$loop->last) |
				@endif
			@endforeach
		  @endif
		  <br>
          <h3>
			 <br>&nbsp;<br>@if(!isset($infoText)) Todas las películas
			 @endif
 		  </h3>
 		  </div> <!-- col-md-12 -->
		  <p>
				@foreach ($movies as $movie)
				<div class='col-md-3'>
					<div class='card mb-3 box-shadow'>
						<a href='/movie/{{$movie->id}}'>
						<img class="card-img-top" src='/movies/covers/{{$movie->cover}}' width='200'/><br/>
						</a>
						<div class="card-body">
							<div class="card-text">
								<a href='/movie/{{$movie->id}}'>
								{{$movie->title}}
								</a>
								<br>{{$movie->year}} | {{$movie->rating}} <i class="fa fa-star" style='color: orange'></i>
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
