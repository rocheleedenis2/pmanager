<?php

namespace App\Http\Controllers;

use App\Project;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $projects = Project::where('user_id', Auth::user()->id)->get();

            return view('projects.index', ['projects' => $projects]);
        }
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( $company_id = null)
    {
        $companies = null;
        if(!$company_id){
            $company = Company::where('user_id', Auth::user()->id)->get();
        }
        return view('projects.create', ['company_id'=>$company_id, 'companies'=>$companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $project = Project::create([
                        'name'=>$request->input('name'),
                        'description'=>$request->input('description'),
                        'company_id'=>$request->input('company_id'),
                        'user_id'=>Auth::user()->id
                    ]);
            if($project){
                return redirect()->route('projects.show', ['project'=>$project->id])
                        ->with('success', 'Project update sucessefully!');
            }
        }
        //redirect
        return back()->withUnput()->with('success', 'Error creating new project.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        // $project = Project::where('id', $project->id)->first();
        $project = Project::find($project->id);

        // $projects = Project::all();
        return view('projects.show', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $project = Project::find($project->id);

        // $projects = Project::all();
        return view('projects.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $companyUpdate = Project::where('id', $project->id)
                                    ->update([
                                                'name' => $request->input('name'),
                                                'description'=> $request->input('description')
                                    ]);
        if($companyUpdate){
            return redirect()->route('projects.show', ['project'=>$project->id])
                    ->with('success', 'Project update sucessefully!');
        }
        //redirect
        return back()->withUnput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $findCompany = Project::find($project->id);
        if($findCompany->delete()){
            return redirect()->route('projects.index')
                            ->with('success', 'Project deleted sucessefully!');
        }
        //redirect
        return back()->withUnput()
                    ->with('error', 'Project could not be deleted.');
    }
}