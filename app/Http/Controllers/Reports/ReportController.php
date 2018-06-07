<?php

namespace App\Http\Controllers\Reports;

use Auth;
use Session;
use App\Models\Report;
use App\Models\Departament;
use App\Models\AccessReport;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{

    public function __construct() {
        $this->middleware(['auth', 'isAdmin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::orderby('report_id', 'report_name')->paginate(20);
        return view('reports.index', compact('reports'))->with('page_title', 'Reports');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reports = Report::get();
        $roles = Role::get();
        $collection = Departament::all();
        $departaments = $collection->pluck('name');

        return view('reports.create')
        ->with('reports', $reports)
        ->with('roles', $roles)
        ->with('departaments', $departaments)
        ->with('page_title', 'Create Report');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        	'report_name'=>'required',
            'report_url' =>'required',
            'selected' =>'required',
        ]);

        $report_name = $request['report_name'];
        $report_url = $request['report_url'];

        //Get the element index selected
        $index_selected = $request['selected'];

        //Get all items from departament table
        $items = Departament::all();

        //Get only one item collection from index selected
        $item_selected = $items->values()->get($index_selected)->name;

        $report = new Report();
        $report->report_name = $report_name;
        $report->report_url = $report_url;
        $report->departament = $item_selected;
        $report->save();

        //Get roles selected
        $roles = $request['roles'];

        if(!empty($roles)) {
            foreach ($roles as $rol) {
                $access_report = new AccessReport();
                $access_report->role_id = $rol;
                $access_report->report_id = $report->report_id;
                $access_report->save();
            }
        }

        return redirect()->route('reports.index')
            ->with('flash_message', 'Report,
             '. $report->report_name.' created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('reports');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($report_id)
    {
        $report = Report::findOrFail($report_id);
        $current_roles = AccessReport::where('report_id', $report_id)->get();

        $ids = array();
        foreach ($current_roles as $grant) {
            array_push($ids, $grant->role_id);
        }

        $db_roles = Role::whereIn('id', $ids)->get()->all();

        $db_roles_ids = array();
        
        foreach ($db_roles as $db_rol) {
            array_push($db_roles_ids, $db_rol->id);
        }

        $roles_not_selected = Role::whereNotIn('id', $db_roles_ids)->get()->all();

        $collection = Departament::all();
        $departaments = $collection->pluck('name');

        return view('reports.edit', compact('report', 'db_roles', 'roles_not_selected', 'departaments'))->with('page_title', 'Edit Report');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $report_id)
    {
        $this->validate($request, [
        	'report_name'=>'required',
            'report_url' =>'required',
            'selected' =>'required',
        ]);

        //Get the element index selected
        $index_selected = $request['selected'];

        //Get all items from departament table
        $items = Departament::all();

        //Get only one item collection from index selected
        $item_selected = $items->values()->get($index_selected)->name;

        $report = Report::findOrFail($report_id);
        $report->report_name = $request->input('report_name');
        $report->report_url = $request->input('report_url');
        $report->departament = $item_selected;
        $report->save();

        //Get roles selected
        $roles = $request['roles'];

        //Get current roles from data base
        $current_roles = AccessReport::where('report_id', $report_id)->get();

        if(!empty($roles)) {
            foreach ($roles as $rol) {
                AccessReport::firstOrCreate(['role_id' => $rol, 'report_id' => $report->report_id]);
            }
            AccessReport::where('report_id', $report_id)->whereNotIn('role_id', $roles)->delete();
        } else {
            AccessReport::where('report_id', $report_id)->delete();
        }
        return redirect()->route('reports.show', $report->report_id)->with('flash_message', 'Report, '. $report->report_name.' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($report_id)
    {
        $report = Report::findOrFail($report_id);
        $report->delete();

        return redirect()->route('reports.index')
            ->with('flash_message',
             'Report successfully deleted');
    }
}