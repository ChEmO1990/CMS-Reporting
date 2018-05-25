@extends('layouts.dashboard')

@section('content')

@include('layouts.modal')
<div class="box box-primary">
	<div class="box-body">
		<div class="box-body">
			Your roles: {{ Auth::user()->roles()->pluck('name')->implode(' , ') }}
		</div>
	</div>
</div>
@endsection