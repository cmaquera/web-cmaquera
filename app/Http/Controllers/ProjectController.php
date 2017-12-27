<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("dashboard/projects");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data =  $request->all();
        $data['url_screenshot'] = null;
        
        if($request->hasFile('url_screenshot')){
            $data['url_screenshot'] = '/upload/projects/' . str_slug($data['name'], '-') . '-' . sha1(time()) . '.' . $request->file('url_screenshot')->getClientOriginalExtension(); 
            $request->file('url_screenshot')->move(public_path('/upload/projects/'), $data['url_screenshot']);
        }
        
        Project::create($data);
        
        return response()->json([
            'name' => $data['name'],
            'message' => 'Se guardo correctamente'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project =  Project::findOrFail($id);
        return $project;
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
        /*$project =  Project::findOrFail($id);
        
        $project->name = $request['name'];
        $project->description = $request['description'];
        $project->url_project = $request['url_project'];
        $project->url_screenshot = $request['url_screenshot'];
        
        $project->update();
        
        return $project;*/
        
        $data =  $request->all();
        $project =  Project::findOrFail($id);
        
        $data['url_screenshot'] = $project->url_screenshot;
        
        if($request->hasFile('url_screenshot')){
            if(!$project->url_screenshot == NULL){
                unlink(public_path($project->url_screenshot));
            }
            $data['url_screenshot'] = '/upload/projects/' . str_slug($data['name'], '-') . '-' . sha1(time()) . '.' . $request->file('url_screenshot')->getClientOriginalExtension(); 
            $request->file('url_screenshot')->move(public_path('/upload/projects/'), $data['url_screenshot']);
        }
        
        $project->update($data);
        
        return response()->json([
            'name' => $data['name'],
            'message' => 'Se actualizo correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return Project::destroy($id);
        $project  = Project::findOrFail($id);
        
        if(!$project->url_screenshot == NULL){
            unlink(public_path($project->url_screenshot));
        }
        
        Project::destroy($id);
        
        return response()->json([
            'name' => $project->name,
            'message' => 'Se elimino correctamente'
        ]);
    }
    
    public function getProjects(){
        
        $project = Project::select(['id', 'name', 'description', 'url_project', 'url_screenshot']);
        
        return Datatables::of($project)
            ->addColumn('action', function($project) {
                return '<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#projectEditForm" onclick="getProject(' . $project->id . ')"><i class="icon ion-android-refresh"></i> Modificar</button>
                        <button type="button" class="btn btn-outline-danger" onclick="deleteProject(' . $project->id . ')"><i class="icon ion-android-close"></i> Eliminar</button>';
            })->make(true);
    }
}
