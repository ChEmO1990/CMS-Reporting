@extends('layouts.dashboard')

@section('content')
<div class="box box-primary">
    <ol class="breadcrumb">
        <li><a href="{{ route('permissions.index') }}">Permissions</a></li>
        <li class="active">Create Permission</li>
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
            {!! Form::open(array('url' => 'permissions')) !!}

            <div class="form-group has-feedback">
                <input name="name" type="text" class="form-control" placeholder="Permission Name" value="{{ old('name') }}">
                <span class="glyphicon glyphicon-cog form-control-feedback"></span>
            </div>

            @if(!$roles->isEmpty())

            <h4>Assign Permission to Roles</h4>

            @foreach ($roles as $role) 
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>
            @endforeach
            @endif

            {!! Form::submit('Create', array('class' => 'btn btn-primary pull-right')) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection