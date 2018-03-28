@extends('layouts.dashboard')

@section('content')
<div class="box box-primary">
    <ol class="breadcrumb">
        <li><a href="{{ route('roles.index') }}">Roles</a></li>
        <li class="active">Create Role</li>
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
            {{ Form::open(array('url' => 'roles')) }}

            <div class="form-group has-feedback">
                <input name="name" type="text" class="form-control" placeholder="Name" value="{{ old('name') }}">
                <span class="glyphicon glyphicon-cog form-control-feedback"></span>
            </div>

            <h4>Assign Permissions</h4>

            <div class='form-group'>
                @foreach ($permissions as $permission)
                {{ Form::checkbox('permissions[]',  $permission->id ) }}
                {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>

                @endforeach
            </div>

            {{ Form::submit('Create', array('class' => 'btn btn-primary pull-right')) }}

            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection




