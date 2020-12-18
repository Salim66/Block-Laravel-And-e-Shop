<?php

use Illuminate\Support\Facades\Route;

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


//Frontend Routes
Route::get('/', 'App\Http\Controllers\FrontEndController@homePage');
Route::get('/blog', 'App\Http\Controllers\FrontEndController@blogPostPage')->name('blog');
Route::get('/blog-single/{slug}', 'App\Http\Controllers\FrontEndController@blogSinglePage')->name('blog.single');




Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Category Routes
Route::resource('post-category', 'App\Http\Controllers\CategoryController');
Route::delete('post-category/{id}', 'App\Http\Controllers\CategoryController@destroy');
Route::get('post-category-edit/{id}', 'App\Http\Controllers\CategoryController@edit')->name('category.edit');
Route::put('post-category-update', 'App\Http\Controllers\CategoryController@update')->name('category.update');
Route::get('post-category-unpublished/{id}', 'App\Http\Controllers\CategoryController@categoryUnpublished')->name('category.unpublished');
Route::get('post-category-published/{id}', 'App\Http\Controllers\CategoryController@categoryPublished')->name('category.published');


//Tags Routes
Route::resource('post-tag', 'App\Http\Controllers\TagController');
Route::get('post-tag-edit/{id}', 'App\Http\Controllers\TagController@edit');
Route::put('post-tag-update', 'App\Http\Controllers\TagController@update')->name('tag.update');
Route::get('post-tag-unpublished/{id}', 'App\Http\Controllers\TagController@unpublished')->name('tag.unpublished');
Route::get('post-tag-published/{id}', 'App\Http\Controllers\TagController@published')->name('tag.published');


//Post Routes
Route::resource('post', 'App\Http\Controllers\PostController');
Route::get('post-edit/{id}', 'App\Http\Controllers\PostController@edit');
Route::get('post.unpublished/{id}', 'App\Http\Controllers\PostController@unpublished')->name('post.unpublished');
Route::get('post.published/{id}', 'App\Http\Controllers\PostController@published')->name('post.published');
