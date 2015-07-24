@extends('layouts.default')

@section('title')
	TEST
@endsection

@section('content')
	<script type="text/javascript" src="/js/test.js"></script>
@endsection

<form>
{!! csrf_field() !!}
</form>