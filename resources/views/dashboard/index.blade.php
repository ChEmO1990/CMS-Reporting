@extends('layouts.dashboard')

@section('content')
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
        	Your roles: {{ Auth::user()->roles()->pluck('name')->implode(' , ') }}
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->
@endsection



