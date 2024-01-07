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
            // ... other fields
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

    // API Endpoint to Index/Show Projects
    public function index()
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
    public function addMember(Request $request, Project $project, Member $member)
    {
        $project->members()->attach($member);

        return response()->json($project->fresh(), Response::HTTP_OK);
    }

    // API Endpoint to Get Members of a Specific Project
    public function getMembers(Project $project)
    {
        $members = $project->members;

        return response()->json($members, Response::HTTP_OK);
    }
}
