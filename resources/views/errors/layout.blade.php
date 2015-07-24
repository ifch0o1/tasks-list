@extends('layouts.default')

@section('title')
	Tasks list Error [@yield('status')]
@endsection

@section('content')

	<div class="container">
		<h1>Sorry :(</h1>
		<h2>[@yield('status')] Error occured</h2>

		<p class="text-danger">Our server cannot process your request</p>

		<div class="pad-top-20">
			<div class="panel panel-danger">
				<div class="panel-heading">
			    	<h3 class="panel-title">
			    		@yield('error-title')
			    	</h3>
				</div>
			  	<div class="panel-body">
		    		<p>
		    			@yield('error-description')
		    		</p>
				</div>

				@if (isset($message))
	    			<div class="alert alert-warning">
  						<h4>Error message:</h4>
  						<p>
  							{{$message}}			
  						</p>
					</div>
	    		@endif

			</div>

		</div>
	</div>

@endsection