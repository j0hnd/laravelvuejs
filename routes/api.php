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


Route::resource('members', 'Api\MemberController')->only(['index', 'store']);
Route::get('/members/{user}', 'Api\MemberController@edit')->name('member.edit');
Route::delete('/members/{user}', 'Api\MemberController@delete')->name('member.delete');
Route::patch('/members/{user}', 'Api\MemberController@update')->name('member.update');
