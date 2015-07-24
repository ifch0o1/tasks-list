@extends('layouts.auth')

@section('title', 'Tasks list - Register')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 well">
				<form class="form-horizontal" method="POST" action="/auth/register">

				  {!! csrf_field() !!}

				  <fieldset>
				    <legend>Register</legend>
				    <div class="form-group">
				      <label for="inputName" class="col-lg-2 control-label">Name</label>
				      <div class="col-lg-10">
				        <input class="form-control" id="inputName" placeholder="Name" type="text" name="name">
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
				      <div class="col-lg-10">
				        <input class="form-control" id="inputEmail" placeholder="Email" type="email" name="email">
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="inputPassword" class="col-lg-2 control-label">Password</label>
				      <div class="col-lg-10">
				        <input class="form-control" id="inputPassword" placeholder="Password" type="password" name="password">
				      </div>
				    </div>
				    <div class="form-group">
				      <label for="inputPasswordConfirm" class="col-lg-2 control-label">Password confirm</label>
				      <div class="col-lg-10">
				        <input class="form-control" id="inputPasswordConfirm" placeholder="Password confirm" type="password" name="password_confirmation">
				        <div class="checkbox">
				          <label>
				            <input type="checkbox" name="remember" checked> Remember me
				          </label>
				        </div>
				      </div>
				    </div>
				    <div class="form-group">
				      <div class="col-lg-10 col-lg-offset-2">
				        <div class="btn-toolbar">
				        	<div class="btn-group">
				        		<button type="submit" class="btn btn-success">Register</button>
				        	</div>
					        <div class="btn-group">
					        	<a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							      More options
							      <span class="caret"></span>
							    </a>
							    <ul class="dropdown-menu">
							      <li><a href="{!! url('auth/login') !!}">Login</a></li>
							      {{-- <li><a href="#">Forgot my password</a></li> --}}
							    </ul>
						    </div>
					    </div>
				      </div>
				    </div>
				  </fieldset>
				</form>
			</div>
		</div>
	</div>

@endsection