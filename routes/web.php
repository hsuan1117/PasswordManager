<?php

use App\Http\Controllers\Items;
use App\Http\Controllers\Settings;
use App\Http\Controllers\Vaults;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Item\WebsiteController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/vaults',[Vaults::class, 'list'])->name('vaults.list');
Route::get('/vaults/{id}',[Vaults::class, 'show'])->name('vaults.show');
Route::get('/vaults/{id}/add',[Items::class, 'add'])->name('items.add');
Route::get('/vaults/{id}/{item}',[Items::class, 'show'])->name('items.show');


Route::post('/add_item',[WebsiteController::class, 'add'])->name('action.items.add');
Route::post('/modify_item',[WebsiteController::class, 'modify'])->name('action.items.modify');
Route::post('/set_master_key',[Settings::class, 'setMasterKey'])->name('action.set_master_key');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('admin');
