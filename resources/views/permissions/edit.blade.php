@extends('layouts.dashboard')

@section('content')
@include('layouts.modal')

<div class="box box-primary">
	<div class="box-body">
		@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		<div class="box-body">
			{{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}

			<div class="form-group has-feedback">
				<input name="name" type="text" class="form-control" placeholder="Permission Name" value="{{ $permission->name }}">
				<span class="glyphicon glyphicon-cog form-control-feedback"></span>
			</div>
			<br>
			{{ Form::submit('Edit', array('class' => 'btn btn-primary pull-right')) }}
			{{ Form::close() }}
		</div>
	</div>
</div>
@endsection