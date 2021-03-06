<?php

use App\Http\Controllers\UsersController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// App\Role::create([
//     'clave' => 'user',
//     'name' => 'Usuario final'
// ]);
// App\User::create([
//     'name' => 'Usuario Final',
//     'email' => 'final_user@mail.com',
//     'password' => bcrypt('user1234'),
//     'role_id' => 2
// ]);

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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('libro', 'LibroController')->names('libro');

Route::get('borrow/create/{libro}/{isbn}', 'BorrowController@create')->name('borrow.create')
    ->middleware('auth', 'roles:admin,user');

Route::get('borrow/myBorrows', 'BorrowController@myBorrows')
    ->name('borrow.myBorrows')->middleware('auth', 'roles:user,admin');

Route::resource('borrow', 'BorrowController',['except' => ['myBorrows','create']])->names('borrow');

Route::resource('usuarios', 'UsersController');
