@extends('layouts.dashboard')

@section('content')
@include('layouts.modal')

<div class="box box-primary">
  <ol class="breadcrumb">
    <li><a href="{{ route('reports.index') }}">Reports</a></li>
    <li class="active">Edit Report</li>
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
     {{ Form::model($report, array('route' => array('reports.update', $report->report_id), 'method' => 'PUT')) }}

     <div class="form-group has-feedback">
      <input name="report_name" type="text" class="form-control" placeholder="Report Name" value="{{ $report->report_name }}">
      <span class="glyphicon glyphicon-report form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
      <input name="report_url" type="text" class="form-control" placeholder="Report URL" value="{{ $report->report_url }}">
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
      <input name="departament" type="text" class="form-control" placeholder="Departament" value="{{ $report->departament }}">
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>

    <h5><b>Roles</b></h5>

    <div class='form-group'>
      @foreach ($roles as $role)
        {{ Form::checkbox('roles[]', $role->id) }}
        {{ Form::label($role->name, ucfirst($role->name)) }} <br>
      @endforeach
    </div>

    {{ Form::submit('Edit', array('class' => 'btn btn-primary pull-right')) }}
    {{ Form::close() }}
  </div>
</div>
</div>
@endsection




