@extends('layouts.dashboard')

@section('content')
@include('layouts.modal')
<div class="box box-primary">
    <table class="table category-table" data-toggle="dataTable" data-form="deleteForm">
        <thead>
            <tr>
                <th>Report Name</th>
                <th>Report URL</th>
                <th>Departament</th>
                <th>Operations</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($reports as $report)
            <tr>
                <td>{{ $report->report_name }}</td>
                <td>{{ $report->report_url }}</td>
                <td>{{ $report->departament }}</td>

                <td>
                    {!! Form::model($report, ['method' => 'DELETE', 'route' => ['reports.destroy', $report->report_id], 'class' =>'pull-left form-delete']) !!}
                    {!! Form::hidden('report_id', $report->report_id) !!}
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs'] )  !!}
                    {!! Form::close() !!}

                    &nbsp;
                    <a href="{{ route('reports.edit',['report_id' => $report->report_id]) }}">
                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection