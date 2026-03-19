<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/','/articles');


Route::get('/articles',[ArticleController::class,'index'])->name('articles.index');
Route::get('/articles/search/',[ArticleController::class,'search'])->name('articles.search');
Route::get('/articles/create',[ArticleController::class,'create'])->middleware('auth')->name('articles.create');
Route::get('/articles/autocomplete/tags/',[TagController::class,'getAutocompleteData'])->name('tags.autocomplete');
Route::get('/articles/autocomplete/categories/',[CategoryController::class,'getAutocompleteData'])->name('cats.autocomplete');
Route::get('/articles/{id}',[ArticleController::class,'show'])->name('articles.show');
Route::get('/articles/edit/{id}',[ArticleController::class,'edit'])->name('articles.edit');
Route::patch('/articles/edit/{id}',[ArticleController::class,'update'])->name('articles.update');
Route::get('/articles/category/{id}',[ArticleController::class,'indexByCategory'])->name('articles.index.cat');
Route::get('/articles/tag/{id}',[ArticleController::class,'indexByTag'])->name('articles.index.tag');

Auth::routes();
Route::post('/articles',[ArticleController::class,'store'])->middleware('auth')->name('articles.store');
Route::get('/articles/delete/{id}',[ArticleController::class,'destroy'])->middleware('auth')->name('articles.delete');

Route::get('/tags',[TagController::class,'index'])->middleware('auth')->middleware('is_admin')->name('tags.index');
Route::post('/tags',[TagController::class,'store'])->middleware('auth')->middleware('is_admin')->name('tags.store');
Route::get('/tags/create',[TagController::class,'create'])->middleware('auth')->middleware('is_admin')->name('tags.create');
Route::get('/tags/{id}/',[TagController::class,'show'])->middleware('auth')->middleware('is_admin')->name('tags.show');
Route::get('/tags/edit/{id}',[TagController::class,'edit'])->middleware('auth')->middleware('is_admin')->name('tags.edit');
Route::patch('/tags/edit/{id}',[TagController::class,'update'])->middleware('auth')->middleware('is_admin')->name('tags.update');
Route::get('/tags/delete/{id}',[TagController::class,'destroy'])->middleware('auth')->middleware('is_admin')->name('tags.delete');

Route::get('/categories',[CategoryController::class,'index'])->middleware('auth')->middleware('is_admin')->name('cats.index');
Route::post('/categories',[CategoryController::class,'store'])->middleware('auth')->middleware('is_admin')->name('cats.store');
Route::get('/categories/create',[CategoryController::class,'create'])->middleware('auth')->middleware('is_admin')->name('cats.create');
Route::get('/categories/{id}/',[CategoryController::class,'show'])->middleware('auth')->middleware('is_admin')->name('cats.show');
Route::get('/categories/edit/{id}',[CategoryController::class,'edit'])->middleware('auth')->middleware('is_admin')->name('cats.edit');
Route::patch('/categories/edit/{id}',[CategoryController::class,'update'])->middleware('auth')->middleware('is_admin')->name('cats.update');
Route::get('/categories/delete/{id}',[CategoryController::class,'destroy'])->middleware('auth')->middleware('is_admin')->name('cats.delete');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
