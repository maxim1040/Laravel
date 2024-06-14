<?php

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FAQCategoryController;
use App\Http\Controllers\FAQQuestionController;


/*
|------------------------------------------------ ----------------------------------------
| Webroutes
|------------------------------------------------ ----------------------------------------
|
| Hier kunt u webroutes voor uw toepassing registreren. Deze
| routes worden geladen door de RouteServiceProvider en dat doen ze allemaal
| worden toegewezen aan de "web"-middlewaregroep. Maak er iets moois van!
|
*/

Route::get('/', [PostController::class,'index'])->name('index');

Route::get('/profile/{id}', 'UserController@showProfile')->name('profile');

Route::resource('posts', PostController::class);
Route::resource('users', UserController::class);

Route::get('like/{postid}', [LikeController::class, 'like']) -> name('like');
Route::get('user/{name}',   [UserController::class, 'profile']) -> name('profile');

Route::post('upload', 'UserController@uploadAvatar');
Route::post('/user', 'UserController@index'); 
Route::post('/home', 'HomeController@index') -> name('home'); 

Route::get('/profile/{id}', [UserController::class, 'showProfile'])->name('profile');
Route::get('/profile/{id}/edit', [UserController::class, 'editProfile'])->name('profile.edit');
Route::put('/profile/{id}', [UserController::class, 'update'])->name('profile.update');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/profile/{id}/upload_avatar', [UserController::class, 'uploadAvatar'])->name('profile.upload_avatar');

Route::get('/users/{id}/promote', [UserController::class, 'promoteToAdmin'])->name('promote.admin');

Route::get('FAQ',[FAQCategoryController::class, 'index'])->name('FAQ');
Route::post('FAQ/category/store',   [FAQCategoryController::class, 'store'])->name('FAQ.category.store');
Route::put('FAQ/category/update/{id}',   [FAQCategoryController::class, 'update'])->name('FAQ.category.update');
Route::get('FAQ/category/destroy/{id}',   [FAQCategoryController::class, 'destroy'])->name('FAQ.category.destroy');

Route::get('FAQ/create/{category}', [FAQQuestionController::class, 'create'])->name('FAQ.create');
Route::post('FAQ/store/{category}', [FAQQuestionController::class, 'store'])->name('FAQ.store');
Route::get('FAQ/edit/{id}', [FAQQuestionController::class, 'edit'])->name('FAQ.edit');
Route::put('FAQ/update/{id}', [FAQQuestionController::class, 'update'])->name('FAQ.update');
Route::get('FAQ/destroy/{id}', [FAQQuestionController::class, 'destroy'])->name('FAQ.destroy');

Route::get('/Source', function () {return view('About');})->name('About');



Auth::routes();
