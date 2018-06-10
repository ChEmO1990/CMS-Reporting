<?php

namespace App\Http\Controllers\Departaments;

use App\Models\Departament;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartamentController extends Controller
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
        $departaments = Departament::paginate(20);
        return view('departaments.index', compact('departaments'))->with('page_title', 'Departaments');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departaments = Departament::all();

        return view('departaments.create', compact('departaments'))
        ->with('page_title', 'Create Departament');
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
    		'name'=>'required',
    		'description' =>'required',
    	]);

        $name = $request['name'];
        $description = $request['description'];

        $departament = Departament::create($request->only('name', 'description'));

        return redirect()
        ->route('departaments.index')
        ->with('flash_message', 'Departament,'. $departament->name. ' created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('departaments');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$departament = Departament::findOrFail($id);

    	return view('departaments.edit', compact('departament'))
    	->with('page_title', 'Edit Departament');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$this->validate($request, [
            'name'=>'required',
            'description'=>'required',
        ]);

        $departament = Departament::findOrFail($id);
        $departament->name = $request->input('name');
        $departament->description = $request->input('description');
        $departament->save();

        return redirect()->route('departaments.index')
            ->with('flash_message','Departament '. $departament->name. ' updated!')
            ->with('page_title', 'Departaments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departament = Departament::findOrFail($id);
        $departament->delete();

        return redirect()->route('departaments.index')
            ->with('flash_message',
             'Departament successfully deleted');
    }
}
