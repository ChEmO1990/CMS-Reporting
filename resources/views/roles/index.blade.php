@extends('layouts.dashboard')

@section('content')

@include('layouts.modal')

<div class="box box-primary">
    <div class="box-body">
        <div class="box-body">
            <div div class="col-xs-12>
                <a href="url">{{ link_to_route('roles.create', 'Add Role', null, ['class'=>'btn btn-primary btn-sm pull-right']) }}</a>
            </div>
        </div>
    </div>

    <table class="table category-table" data-toggle="dataTable" data-form="deleteForm">
        <thead>
            <tr>
                <th>Role</th>
                <th>Permissions</th>
                <th>Operations</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($roles as $role)
            <tr>

                <td>{{ $role->name }}</td>

                <td>{{  '[ ' . $role->permissions()->pluck('name')->implode(' , ') . ' ]' }}</td>
                <td>
                    {!! Form::model($role, ['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'class' =>'pull-left form-delete']) !!}
                    {!! Form::hidden('id', $role->id) !!}
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs'] )  !!}
                    {!! Form::close() !!}

                    &nbsp;
                    <a href="{{ route('roles.edit',['id' => $role->id]) }}">
                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                    </a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection