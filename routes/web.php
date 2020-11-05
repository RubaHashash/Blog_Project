<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
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



Route::get('users/{id}',function($id){
    return 'this is a user ' . $id;
});



Route::get('/posts', [PostsController::class,"viewPosts"]);
Route::get('/Myposts', [PostsController::class,"viewMyPosts"]);
Route::get('/posts/create', [PostsController::class,"create"]);
Route::get('/posts/{post}', [PostsController::class,"show"]);
Route::put('/posts/{post}', [PostsController::class,"update"]);
Route::get('/posts/{post}/edit', [PostsController::class,"edit"]);
Route::delete('/posts/{post}', [PostsController::class,"destroy"]);
Route::post('/posts', [PostsController::class,"store"]);