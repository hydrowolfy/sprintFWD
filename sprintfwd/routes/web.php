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
});

// Members
Route::resource('members', MemberController::class);

// Teams
Route::resource('teams', TeamController::class);

// Projects
Route::resource('projects', ProjectController::class);
Route::get('/allteams', [TeamController::class, 'showAll']);
Route::get('/allprojects', [ProjectController::class, 'showAll']);
Route::get('/allmembers', [MemberController::class, 'showAll']);

// Additional routes for your bonus functionalities (if needed)
// ...

