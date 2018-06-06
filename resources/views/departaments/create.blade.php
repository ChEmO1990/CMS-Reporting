@extends('layouts.dashboard')

@section('content')
<div class="box box-primary">
    <ol class="breadcrumb">
        <li><a href="{{ route('departaments.index') }}">Departaments</a></li>
        <li class="active">Create Department</li>
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
            {!! Form::open(array('url' => 'departaments')) !!}

            <div class="form-group has-feedback">
              <input name="name" type="text" class="form-control" placeholder="Departament Name" value="{{ old('name') }}">
              <span class="glyphicon glyphicon-departament form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
              <input name="description" type="text" class="form-control" placeholder="Description" value="{{ old('description') }}">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
           </div>
           
          {!! Form::submit('Create', array('class' => 'btn btn-primary pull-right')) !!}
          {!! Form::close() !!}
      </div>
  </div>
</div>
@endsection




