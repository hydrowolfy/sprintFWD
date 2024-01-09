<?php
// app/Http/Controllers/MemberController.php

namespace App\Http\Controllers;


use App\Models\Member;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MemberController extends Controller
{

    public function create()
    {
        $teams = Team::all();
        return view('members.create', compact('teams'));
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        $teams = Team::all();
        return view('members.edit', compact('member', 'teams'));
    }

    // API Endpoint to Create a Member
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'city',
            'state',
            'country',
            'team_id' => 'required'
        ]);

        $member = Member::create($request->all());

        return response()->json($member, Response::HTTP_CREATED);
    }

    // API Endpoint to Update a Member
    public function update(Request $request, Member $member)
    {
        $member->update($request->all());

        return response()->json($member, Response::HTTP_OK);
    }

    // API Endpoint to Delete a Member
    public function destroy(Member $member)
    {
        $member->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    // Endpoint to view Members
    public function index()
    {
        $members = Member::all();
        return view('members.index', compact('members'));
    }
   
    public function showAll()
    {
        $members = Member::all();

        return response()->json($members, Response::HTTP_OK);
    }

    // API Endpoint to Show a Specific Member
    public function show(Member $member)
    {
        return response()->json($member, Response::HTTP_OK);
    }

    // API Endpoint to Update the Team of a Member
    public function updateTeam(Request $request, Member $member)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
        ]);

        $member->team_id = $request->team_id;
        $member->save();

        return response()->json($member, Response::HTTP_OK);
    }
}
