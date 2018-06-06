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
                <th>Created At</th>
                <th>Updated At</th>
                <th>Operation</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($reports as $report)
            <tr>
                <td>{{ $report->report_name }}</td>
                <td>{{ $report->report_url }}</td>
                <td>{{ $report->departament }}</td>
                <td>{{ $report->created_at }}</td>
                <td>{{ $report->updated_at }}</td>
                <td>
                    <a href="/">Open</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection