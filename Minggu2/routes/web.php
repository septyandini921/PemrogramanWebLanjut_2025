<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PageController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;

use App\Http\Controllers\PhotoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/* Jobsheet 2: Basic Routing */
Route::get('/hello', function () {
    return 'Hello, World!';
});

Route::get('/world', function() {
    return 'World!';
});

/* Route selamat datang */
Route::get('/selamatDatang', function() {
    return 'Selamat Datang';
});

/* Route about */
Route::get('/about', function() {
    return '2341760087 Nimas Septiandini';
});

/* Jobsheet 2: Route Parameters */
Route::get('/user/{name}', function ($name) {
    return 'Nama saya '.$name;
});

Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    return 'Pos ke-'.$postId." Komentar ke-: ".$commentId;
});

/*Route id halaman artikel*/ 
Route::get('articles/{id}', function ($id) {
    return 'Halaman Artikel dengan ID '.$id;
});

/* Jobsheet 2: Optional Parameters */
Route::get('user/{name?}', function ($name='John') {
    return 'Nama saya '.$name;
});

/* Jobsheet 2: Modifikasi controller */
Route::get('/hello', [WelcomeController::class,'hello']);

// Route::get('/', [PageController::class, 'index']);
// Route::get('/about', [PageController::class, 'about']);
// Route::get('/articles/{id}', [PageController::class, 'articles']);

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [AboutController::class, 'about']);
Route::get('/articles/{id}', [ArticleController::class, 'articles']);

Route::resource('photos', PhotoController::class);

Route::resource('photos', PhotoController::class)->only([ 'index', 'show'
]);

Route::resource('photos', PhotoController::class)->except([ 'create', 'store', 'update', 'destroy'
]);

// Route::get('/greeting', function() {
//     return view('blog.hello', ['name' => 'Nimas Septiandini']);
// });

Route::get('/greeting', [WelcomeController::class, 'greeting']);
