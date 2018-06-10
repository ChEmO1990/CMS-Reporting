<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="/adminlte/img/avatar5.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->name }}</p>
        <!-- Status -->
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
     <li class="header">Home</li>
     <li class="{{ Request::is('/')? "active":""}}"><a href="/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

     @role('Administrator')
     <li class="header">Administrator</li>

     <li class="{{ Request::is('reports')? "active":""}}"><a href="{{ route('reports.index') }}"><i class="fa fa-file-pdf-o"></i> <span>Reports</span></a></li> 

     <li class="{{ Request::is('users')? "active":""}}"><a href="{{ route('users.index') }}"><i class="fa fa-users"></i> <span>Users</span></a></li>

     <li class="{{ Request::is('roles')? "active":""}}"><a href="{{ route('roles.index') }}"><i class="fa fa-drivers-license-o"></i> <span>Roles</span></a></li>

     <li class="{{ Request::is('permissions')? "active":""}}"><a href="{{ route('permissions.index') }}"><i class="fa fa-eye"></i> <span>Permissions</span></a></li> 

     <li class="{{ Request::is('departaments')? "active":""}}"><a href="{{ route('departaments.index') }}"><i class="fa fa-tasks"></i> <span>Departaments</span></a></li> 
     @endrole

     <?php
     use App\Models\Report;
     use App\Models\AccessReport;

     $roles = Auth::user()->roles;
     $roles_id = array();

     foreach ($roles as $key => $rol) {
      array_push($roles_id, $rol->id);
    }

    $ids = AccessReport::whereIn('role_id', $roles_id)->pluck('report_id');

    $single_titles = Report::whereIn('report_id', $ids)->get() //Get collection
    ->pluck('departament') //I only need the departament column
    ->unique() //Remove duplicate items
    ->sort() //Sort the result
    ->all();

    $results = Report::whereIn('report_id', $ids)
    ->whereIn('departament', $single_titles)
    ->get();
    ?>

    <li class="header">Access To</li>
    @foreach($single_titles as $key => $title)
      @php
      $items = $results->where('departament', $title)->all();
      @endphp

      <li class="treeview">
        <a href="#"><i class="fa fa-folder-open-o"></i> <span>{{ $title }}</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>

        <ul class="treeview-menu">
          @foreach ($items as $item)
          <li class="{{ Request::is('access')? "active":""}}"><a href="{{ route('access.show', [$item->report_id]) }}"><i class="  fa fa-newspaper-o"></i><span>{{ $item->report_name }}</span></a></li>
          @endforeach
        </ul>
      </li>
      @endforeach
  </ul>
  <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>