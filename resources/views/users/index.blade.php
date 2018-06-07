@extends('layouts.dashboard')

@section('content')
@include('layouts.modal')
<div class="box box-primary">
    <div class="box-body">
        <div class="box-body">
            <div div class="col-xs-12>
                <a href="url">{{ link_to_route('users.create', 'Add User', null, ['class'=>'btn btn-primary btn-sm pull-right']) }}</a>
            </div>
        </div>
    </div>

    <table class="table category-table" data-toggle="dataTable" data-form="deleteForm">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Date/Time Added</th>
                <th>User Roles</th>
                <th>Operations</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                <td>{{ '[ ' . $user->roles()->pluck('name')->implode(' , ') . ' ]' }}</td>

                <td>
                    {!! Form::model($user, ['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'class' =>'pull-left form-delete']) !!}
                    {!! Form::hidden('id', $user->id) !!}
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs'] )  !!}
                    {!! Form::close() !!}

                    &nbsp;
                    <a href="{{ route('users.edit',['id' => $user->id]) }}">
                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection