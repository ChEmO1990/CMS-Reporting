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
        
        foreach ($user_roles as $rol) {
            array_push($role_ids, $rol->id);
        }

        $result = AccessReport::whereIn('role_id', $role_ids)->get();
        foreach ($result as $res) {
            array_push($report_ids, $res->report_id);
        }

        $reports = Report::whereIn('report_id', $report_ids)->get();

        return view('dashboard.index', compact('reports'))->with('page_title', 'My Reports');
    }
}
