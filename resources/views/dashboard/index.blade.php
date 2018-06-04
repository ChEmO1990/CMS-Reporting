@extends('layouts.dashboard')
@section('content')
<div class="box box-primary">
    <div class="box-body">
        <div class="box-body">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                    <div class="inner">
                        @if( $count_roles > 0 && $count_roles <= 1 )
                            <h3> {{ $count_roles }} </h3>
                            <p>Assigned Role</p>
                        @elseif($count_roles > 1 ) 
                            <h3> {{ $count_roles }} </h3>
                            <p>Assigned Roles</p>
                        @else
                            <h3>Empty</h3>
                            <p>No roles assigned yet</p>
                        @endif
                    </div>
                    <div class="icon">
                        <i class="ion-lock-combination"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3> {{ $reports_count }} </h3>
                        <p>Reports Available</p>
                    </div>
                    <div class="icon">
                        <i class="icon ion-document"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection