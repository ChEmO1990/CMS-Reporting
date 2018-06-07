@extends('layouts.dashboard')

@section('content')
<div class="box box-primary">
    <ol class="breadcrumb">
        <li><a href="{{ route('reports.index') }}">Reports</a></li>
        <li class="active">Create Report</li>
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
            {!! Form::open(array('url' => 'reports')) !!}

            <div class="form-group has-feedback">
                <input name="report_name" type="text" class="form-control" placeholder="Report Name" value="{{ old('report_name') }}">
                <span class="glyphicon glyphicon-file form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input name="report_url" type="text" class="form-control" placeholder="Report URL" value="{{ old('report_url') }}">
                <span class="glyphicon glyphicon-globe form-control-feedback"></span>
            </div>

            <div class='form-group'>
                {!! Form::label('lbl_selected', 'Select a departament') !!}
                {{ Form::select('selected', $departaments, null, ['class'=>'form-control']) }}
            </div>

            <h5><b>Roles</b></h5>

            <div class='form-group'>
                @foreach ($roles as $role)
                {{ Form::checkbox('roles[]',$role->id) }}
                {{ Form::label($role->name, ucfirst($role->name)) }}<br>
                @endforeach
            </div>

            {!! Form::submit('Create', array('class' => 'btn btn-primary pull-right')) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection




