<?php
namespace App\Http\Controllers;

// app/Http/Controllers/TeamController.php

use App\Models\Member;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;

class TeamController extends Controller
{

    // API Endpoint to Create a Team
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $team = Team::create($request->all());

        return response()->json($team, Response::HTTP_CREATED);
    }

    // API Endpoint to Update a Team
    public function update(Request $request, Team $team)
    {
        $team->update($request->all());

        return response()->json($team, Response::HTTP_OK);
    }

    // API Endpoint to Delete a Team
    public function destroy(Team $team)
    {
        try {
            // Attempt to delete the team
            $team->delete();
    
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (QueryException $e) {
            // Check if the error is due to a foreign key constraint violation
            if ($e->errorInfo[1] == 1451) {
                return response()->json(['error' => 'Cannot delete the team. Delete associated members first.'], Response::HTTP_CONFLICT);
            }
    
            // If it's a different type of error, you can handle it accordingly
            return response()->json(['error' => 'An error occurred while deleting the team.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //Endpoint to Index/Show Teams
    public function index()
    {
        $teams = Team::all();
        return view('teams.index', compact('teams'));
    }
        // API Endpoint to Show Teams
    public function showAll()
    {
        $teams = Team::all();
        return response()->json($teams, Response::HTTP_OK);
    }

    // API Endpoint to Show a Specific Team
    public function show(Team $team)
    {
        return response()->json($team, Response::HTTP_OK);
    }

    // API Endpoint to Get Members of a Specific Team
    public function getMembers($id)
    {
        $members = Member::select('first_name','last_name')->where('team_id', $id)->get();
        return response()->json($members, Response::HTTP_OK);
    }

    public function create()
    {
        return view('teams.create');
    }

    public function edit($id)
    {
        $team = Team::findOrFail($id);
        return view('teams.edit', compact('team'));
    }
    public function getAllTeamMembers($id)
    {
        $members = Member::select('first_name','last_name')->where('team_id', $id)->get();
        return response()->json($members, Response::HTTP_OK);
    }

}
