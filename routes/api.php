<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Category\PopularCategoriesController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\Newsletter\NewsletterController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\Tag\PopularTagsController;
use App\Http\Controllers\Tag\TagController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function (){

    Route::middleware('auth:sanctum')->group(function (){
       Route::get('logout', LogoutController::class);

        //User routes
        Route::apiResource('users', UserController::class);
        //Post routes
        Route::apiResource('posts', PostController::class);
        //Category routes
        Route::apiResource('categories', CategoryController::class);
        //Comment route
        Route::apiResource('comments', CommentController::class);
        //Project route
        Route::apiResource('projects', ProjectController::class);
        //Contact routes
        Route::get('contacts', [ContactController::class, 'index'])->name('contact.index');
        //Tags
        Route::apiResource('tags', TagController::class);
        //Newsletters
        Route::get('newsletters', [NewsletterController::class, 'index'])->name('newsletter.index');
    });

    Route::middleware('guest:sanctum')->group(function (){
        Route::post('register', RegisterController::class);
        Route::post('login', LoginController::class);
    });

    //public routes
    Route::get('posts', [PostController::class, 'index']);
    Route::get('posts/{post}', [PostController::class, 'show']);
//    Route::get('posts/{post}', [PostController::class, 'show']);
//    domain/posts/post-slug
//    domain/web-development/hello-world
    //Category routes
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/{category}', [CategoryController::class, 'show']);
    Route::get('popular_categories', PopularCategoriesController::class);
    //Project routes
    Route::get('projects', [ProjectController::class, 'index']);
    Route::get('projects/{project}', [ProjectController::class, 'show']);
    Route::get('popular_tags', PopularTagsController::class);
    //Tags
    Route::get('tags', [TagController::class, 'index']);
    //Newsletter route
    Route::post('newsletters', [NewsletterController::class, 'store'])->name('newsletter.store');
    //Contacts
    Route::post('contacts', [ContactController::class, 'store'])->name('contact.store');


});