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
       {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}

       <div class="form-group has-feedback">
        <input name="name" type="text" class="form-control" placeholder="Name" value="{{ $user->name }}">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
        <input name="email" type="email" class="form-control" placeholder="Email" value="{{ $user->email }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>

    <h5><b>Give Role</b></h5>

    <div class='form-group'>
        @foreach ($roles as $role)
        {{ Form::checkbox('roles[]',$role->id, $user->roles ) }}
        {{ Form::label($role->name, ucfirst($role->name)) }}<br>
        @endforeach
    </div>

    <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
        <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>

    {{ Form::submit('Edit', array('class' => 'btn btn-primary pull-right')) }}
    {{ Form::close() }}
</div>
</div>
</div>
@endsection




