@extends('errors.layout')

@section('status')
404
@endsection

@section('error-title')
	Resource not found
@endsection

@section('error-description')
	You are trying to access or modify an server resource, but it is not exsist. <br>
	If you continue experiencing this problem, please contact the administrator.
@endsection