<?php

namespace App\Http\Controllers\Reports;

use App\Models\Report;
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
        $reports = Report::orderby('report_id', 'report_name')->paginate(5);
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

        return view('reports.create')
        ->with('reports', $reports)
        ->with('roles', $roles)
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
            'departament' =>'required',
        ]);

        $report_name = $request['report_name'];
        $report_url = $request['report_url'];
        $departament = $request['departament'];

        $report = Report::create($request->only('report_name', 'report_url', 'departament'));

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
        $roles = Role::get();
        $granted = AccessReport::where('report_id', $report_id)->get();
        return view('reports.edit', compact('report', 'roles', 'granted'))->with('page_title', 'Edit Report');
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
            'departament' =>'required',
        ]);

        $report = Report::findOrFail($report_id);
        $report->report_name = $request->input('report_name');
        $report->report_url = $request->input('report_url');
        $report->departament = $request->input('departament');
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
