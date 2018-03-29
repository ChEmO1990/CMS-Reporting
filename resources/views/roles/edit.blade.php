@extends('layouts.dashboard')

@section('content')
@include('layouts.modal')

<div class="box box-primary">
  <ol class="breadcrumb">
    <li><a href="{{ route('roles.index') }}">Roles</a></li>
    <li class="active">Edit Role</li>
  </ol> 
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
      {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}

      <div class="form-group has-feedback">
        <input name="name" type="text" class="form-control" placeholder="Permission Name" value="{{ $role->name }}">
        <span class="glyphicon glyphicon-cog form-control-feedback"></span>
      </div>

      <h4>Assign Permissions</h4>
      @foreach ($permissions as $permission)

      {{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
      {{Form::label($permission->name, ucfirst($permission->name)) }}<br>

      @endforeach
      <br>
      {{ Form::submit('Edit', array('class' => 'btn btn-primary pull-right')) }}

      {{ Form::close() }}
    </div>
  </div>
</div>
@endsection