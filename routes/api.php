<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'Auth\LoginController@login');
Route::post('user-info', 'Auth\LoginController@getInfo')->middleware('auth:api');
Route::post('logout', 'Auth\LoginController@logout')->middleware('auth:api');

Route::post('vote', 'VoteController@store')->middleware(['auth:api','isVoter']);

Route::middleware(['auth:api'])->group(function () {
    Route::resource('candidates', 'CandidateController');
    Route::resource('candidates.members', 'MembersCandidateController');
});
