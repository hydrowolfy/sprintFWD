<?php


namespace App\Http\Controllers;
// app/Http/Controllers/ProjectController.php

use App\Models\Project;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends Controller
{

    // API Endpoint to Create a Project
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $project = Project::create($request->all());

        return response()->json($project, Response::HTTP_CREATED);
    }

    // API Endpoint to Update a Project
    public function update(Request $request, Project $project)
    {
        $project->update($request->all());

        return response()->json($project, Response::HTTP_OK);
    }

    // API Endpoint to Delete a Project
    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function showAll()
    {
        $projects = Project::all();

        return response()->json($projects, Response::HTTP_OK);
    }
    // API Endpoint to Show a Specific Project
    public function show(Project $project)
    {
        return response()->json($project, Response::HTTP_OK);
    }

    // API Endpoint to Add a Member to a Project
    public function addMember( $projectID,  $memberID)
    {
        $project = Project::findOrFail($projectID);
        $member = Member::findOrFail($memberID);
        $project->members()->attach($member);
        $members =  $project->members()->get();
        return response()->json( $members , Response::HTTP_OK);
    }

    // API Endpoint to Get Members of a Specific Project
    public function getMembers($id)
    {
        $project = Project::findOrFail($id);

        $members =  $project->members()->get();
        
        return response()->json($members, Response::HTTP_OK);
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
    }
    
    public function create()
    {
        return view('projects.create');
    }

}
