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
    <ul class="sidebar-menu" data-widget="tree">d
      <li class="header">Home</li>
      <!-- Optionally, you can add icons to the links -->
      <li class="{{ Request::is('/')? "active":""}}"><a href="/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

      @role('Administrator')
      <li class="header">Administrator</li>
      <!-- Optionally, you can add icons to the links -->
      <li class="{{ Request::is('users')? "active":""}}"><a href="{{ route('users.index') }}"><i class="fa fa-users"></i> <span>Users</span></a></li>

      <li class="{{ Request::is('roles')? "active":""}}"><a href="{{ route('roles.index') }}"><i class="fa fa-drivers-license-o"></i> <span>Roles</span></a></li>

      <li class="{{ Request::is('permissions')? "active":""}}"><a href="{{ route('permissions.index') }}"><i class="fa fa-eye"></i> <span>Permissions</span></a></li> 

      <li class="{{ Request::is('reports')? "active":""}}"><a href="{{ route('reports.index') }}"><i class="fa fa-file-pdf-o"></i> <span>Reports</span></a></li> 

      <li class="{{ Request::is('departaments')? "active":""}}"><a href="{{ route('departaments.index') }}"><i class="fa fa-tasks"></i> <span>Departaments</span></a></li> 
      @endrole
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>