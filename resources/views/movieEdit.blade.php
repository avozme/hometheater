@extends('layouts.mainlayout')

@section('content')
   <div class="album text-muted content-section">
     <div class="container">
       <div class="row">
          <div class="col-md-12">
          <h3>
			 @if(isset($infoText)) {{ $infoText }}
			 @else Modificarpelícula
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
								<form method="POST" action="{{ route('movie.update',$movie->id) }}"  role="form">
									{{ csrf_field() }}
									<input name="_method" type="hidden" value="PATCH">
									<div class="row">
										<div class="col-xs-6 col-sm-6 col-md-6">
											<div class="form-group">
												<input type="text" name="title" id="title" class="form-control input-sm" value="{{$movie->title}}">
											</div>
										</div>
										<div class="col-xs-6 col-sm-6 col-md-6">
											<div class="form-group">
												<input type="text" name="rating" id="rating" class="form-control input-sm" value="{{$movie->rating}}">
											</div>
										</div>
										<div class="col-xs-6 col-sm-6 col-md-6">
											<div class="form-group">
												<input type="text" name="year" id="year" class="form-control input-sm" value="{{$movie->year}}">
											</div>
										</div>
										<div class="col-xs-6 col-sm-6 col-md-6">
											<div class="form-group">
												<input type="text" name="duration" id="duration" class="form-control input-sm" value="{{$movie->duration}}">
											</div>
										</div>
									</div>
<!--		 
									<div class="row">
										<div class="col-xs-6 col-sm-6 col-md-6">
											<div class="form-group">
												<input type="text" name="edicion" id="edicion" class="form-control input-sm" value="{{$libro->edicion}}">
											</div>
										</div>
										<div class="col-xs-6 col-sm-6 col-md-6">
											<div class="form-group">
												<input type="text" name="precio" id="precio" class="form-control input-sm" value="{{$libro->precio}}">
											</div>
										</div>
									</div>
									<div class="form-group">
										<textarea name="autor" class="form-control input-sm" placeholder="Autor">{{$libro->autor}}</textarea>
									</div>
									<div class="row">
-->		 
										<div class="col-xs-12 col-sm-12 col-md-12">
											<input type="submit"  value="Actualizar" class="btn btn-success btn-block">
											<a href="{{ route('movie.index') }}" class="btn btn-info btn-block" >Atrás</a>
										</div>	
		 
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
