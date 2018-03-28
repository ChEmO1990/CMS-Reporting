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
                <th>Operation</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($roles as $role)
            <tr>

                <td>{{ $role->name }}</td>

                <td>{{  $role->permissions()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                <td>
                    <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection