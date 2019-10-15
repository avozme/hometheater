@extends('layouts.mainlayout')

@section('content')
   <div class="album text-muted content-section">
     <div class="container">
       <div class="row">
          <div class="col-md-12">
          <h3>
			 @if(isset($infoText)) {{ $infoText }}
			 @elseif($action == 'edit') Modificar película
			 @else Película nueva
			 @endif
 		  </h3>
 		  </div> <!-- col-md-12 -->
		  <p>
			<section class="content">
				<div class="col-md-8 col-md-offset-2">
					@if (count($errors) > 0)
					<div class="alert alert-danger">
						<strong>Error:</strong> Por favor, revisa los campos obligatorios.<br><br>
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif
		 
					<div class="panel panel-default">
						<div class="panel-body">					
							<div class="table-container">
								@if($action == 'edit')
									<form method="POST" action="{{ route('movie.update', $movie->id) }}"  role="form">
								@else
									<form method="POST" action="{{ route('movie.store') }}"  role="form">
								@endif
									@csrf
									@if($action == 'edit')
										@method("PATCH")
									@endif
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="rating">Título</label>
												<input type="text" name="title" id="title" class="form-control input-sm" value="{{$movie->title}}">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="rating">Rating (1-10)</label>
												<input type="text" name="rating" id="rating" min="1" max="10" class="form-control input-sm" value="{{$movie->rating}}">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="rating">Año de producción</label>
												<input type="text" name="year" id="year" class="form-control input-sm" value="{{$movie->year}}">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="rating">Duración (minutos)</label>
												<input type="text" name="duration" id="duration" class="form-control input-sm" value="{{$movie->duration}}">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="rating">Link externo</label>
												<input type="text" name="link" id="link" class="form-control input-sm" value="{{$movie->link}}">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="rating">Cartel</label>
												<input type="text" name="cover" id="cover" readonly disabled class="form-control" value="{{$movie->cover}}">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="rating">Archivo de vídeo</label>
												<input type="text" name="fileName" id="fileName" readonly disabled class="form-control" value="{{$movie->fileDirName}}/{{$movie->fileName}}">
											</div>
										</div>
										
									</div>
									<div class="col-md-12">
										@if ($action == 'edit')
											<input type="submit"  value="Actualizar" class="btn btn-success">
										@else
											<input type="submit"  value="Insertar" class="btn btn-success">
										@endif
										<a href="{{ route('movie.index') }}" class="btn btn-secondary" >Atrás</a>
										<p>&nbsp;</p>
									</div>	
								</form>
							</div>
						</div>
		 
					</div>
				</div>
			</section>
		  </p>
		</div> <!-- row -->
     </div> <!-- container -->
   </div> <!-- album text-muted -->
@endsection
