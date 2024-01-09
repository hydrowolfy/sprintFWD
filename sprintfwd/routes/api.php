<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProjectController;

// API Endpoints for Members
Route::get('/members', [MemberController::class, 'index']);
Route::get('/members/{member}', [MemberController::class, 'show']);
Route::post('/members', [MemberController::class, 'store']);
Route::put('/members/{member}', [MemberController::class, 'update']);
Route::delete('/members/{member}', [MemberController::class, 'destroy']);

// API Endpoint to Update the Team of a Member
Route::put('/members/{member}/update-team', [MemberController::class, 'updateTeam']);

// API Endpoint to Get Members of a Specific Team
Route::get('/teams/{team}/members', [TeamController::class, 'getMembers']);

// API Endpoints for Teams
Route::get('/teams', [TeamController::class, 'index']);
Route::get('/teams/{team}', [TeamController::class, 'show']);
Route::get('/teams/all', [TeamController::class, 'showAll']);
Route::post('/teams', [TeamController::class, 'store']);
Route::put('/teams/{team}', [TeamController::class, 'update']);
Route::delete('/teams/{team}', [TeamController::class, 'destroy']);

// API Endpoints for Projects
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{project}', [ProjectController::class, 'show']);
Route::post('/projects', [ProjectController::class, 'store']);
Route::put('/projects/{project}', [ProjectController::class, 'update']);
Route::delete('/projects/{project}', [ProjectController::class, 'destroy']);

// API Endpoint to Add a Member to a Project
Route::put('/projects/{project}/add-member/{member}', [ProjectController::class, 'addMember']);

// API Endpoint to Get Members of a Specific Project
Route::get('/projects/{project}/members', [ProjectController::class, 'getMembers']);
