@extends('layouts.dashboard')

@section('content')
@include('layouts.modal')
<div class="box box-primary">
    <div class="box-body">
        <div class="box-body">
            <div div class="col-xs-12">
                <a href="url">{{ link_to_route('departaments.create', 'Add Departament', null, ['class'=>'btn btn-primary btn-sm pull-right']) }}</a>
            </div>
        </div>
    </div>

    <table class="table category-table" data-toggle="dataTable" data-form="deleteForm">
        <thead>
            <tr>
                <th>Departament Name</th>
                <th>Description</th>
                <th>Operations</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($departaments as $departament)
            <tr>
                <td>{{ $departament->name }}</td>
                <td>{{ $departament->description }}</td>

                <td>
                    {!! Form::model($departament, ['method' => 'DELETE', 'route' => ['departaments.destroy', $departament->id], 'class' =>'pull-left form-delete']) !!}
                    {!! Form::hidden('id', $departament->id) !!}
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs'] )  !!}
                    {!! Form::close() !!}

                    &nbsp;
                    <a href="{{ route('departaments.edit',['id' => $departament->id]) }}">
                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection