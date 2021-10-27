<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdministrator;

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

Route::match(['get', 'post'], '/botman', 'BotManController@handle');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'role:superadministrator']], function() { 
    Route::prefix('super')->group(function(){
        //View
        Route::get('/administrator/view',[SuperAdministrator::class,'viewAdministrator'])->name('view.super.administrator');
        Route::get('/administrator/add/view',[SuperAdministrator::class,'viewAddPageAdmin'])->name('view.super.administrator.add');

        // //CRUD
        // Route::post('/administrator/add',[SuperAdministrator::class,'viewAddAdmin'])->name('view.super.add.admin');
        // Route::get('/administrator/edit/{id}',[SuperAdministrator::class,'viewEditAdmin'])->name('view.super.edit.admin');
        // Route::post('/administrator/update/{id}',[SuperAdministrator::class,'viewUpdateAdmin'])->name('view.super.update.admin');
        // Route::get('/administrator/delete/{id}',[SuperAdministrator::class,'viewDeleteAdmin'])->name('view.super.delete.admin');
    });
});
