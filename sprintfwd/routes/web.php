<?php
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Define web routes for your application here.
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Members
Route::resource('members', MemberController::class);

// Teams
Route::resource('teams', TeamController::class);

// Projects
Route::resource('projects', ProjectController::class);

Route::get('/allteams', [TeamController::class, 'showAll']);
Route::get('/allprojects', [ProjectController::class, 'showAll']);
Route::get('/allmembers', [MemberController::class, 'showAll']);
Route::get('/members/updateteam/{id}', [MemberController::class, 'updateTeamView'])->name('members.updateTeam');
Route::get('/teams/getteammembers/{id}', [TeamController::class, 'getAllTeamMembers'])->name('teams.getTeamMembers');
//Route::get('/members/addmembertoproject/{id}', [ProjectController::class, 'addMemberView'])->name('projects.addMember');
Route::get('/members/{id}/addmembertoproject/', [MemberController::class, 'addProjectView'])->name('members.addProject');
Route::put('/members/{id}/addmembertoproject/', [MemberController::class, 'addMemberToProject'])->name('projects.addMember');
Route::get('/projects/getprojectmembers/{id}', [ProjectController::class, 'getMembers'])->name('projects.getProjectMembers');


