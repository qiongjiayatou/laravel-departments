<?php

use App\Section;
use App\User;
use Illuminate\Support\Facades\Route;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function() {
    Route::resource('users', 'UserController')->except(['show']);
    Route::resource('sections', 'SectionController')->except(['show']);

    
});

Route::get('/test', function(Faker $faker) {
    $users = Section::find(1)->users;
    dd($users->pluck('id')->toArray());
});