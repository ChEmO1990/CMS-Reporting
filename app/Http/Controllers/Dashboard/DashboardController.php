<?php

namespace App\Http\Controllers\Dashboard;

use Auth;
use Session;
use App\Models\Report;
use App\Models\AccessReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_roles =  Auth::user()->roles()->get();
        $role_ids = array();
        $report_ids = array();
<<<<<<< HEAD
        
=======
        $rol_names = array();

>>>>>>> 9e332f481405076f474e3955855cce8468fe1b42
        foreach ($user_roles as $rol) {
            array_push($role_ids, $rol->id);
            array_push($rol_names, $rol->name);
        }

        $result = AccessReport::whereIn('role_id', $role_ids)->get();
        
        foreach ($result as $res) {
            array_push($report_ids, $res->report_id);
        }

        $reports = Report::whereIn('report_id', $report_ids)->get();
        $count_roles = $user_roles->count();
        $reports_count = $result->count();
        $roles = implode(" , ", $rol_names);

        return view('dashboard.index', compact('reports_count', 'count_roles', 'roles'))->with('page_title', 'Dashboard');
    }
}
