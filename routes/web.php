<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SessionController;
use App\Models\Post;
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
/*Route::get('/hello', function () {
    return view('welcome');
});*/

/*Route::get('/', function () {
    return ['message'=>'hello world' ];
});
// renvoi directement en json le tableau, ne renvoi pas 'array'... format de retour*/




/*Route::get('/posts', function () {
    return view('posts');
});
*/

Route::get('/', [\App\Http\Controllers\PostController::class,'index'])->name('home');


Route::get('/posts/{post:slug}', [\App\Http\Controllers\PostController::class,'show']);
    //->where('post', '[A-z0-9_\-]+');
//la contrainte viens a la fin de la route ce qui vient apres la flehce est une methode, expression reguliere avc les crochet le + veut dire au moin un, si on veut le caractere du tiret ou du point etc il faut un antislash mm pour lantislash
//lunderscore na pas besoin dechappement puis le tiret a besoin dun echappement donc mettre antislahs devant
//le + est un quantificateur -- au moin 1 element de notre expression reguliere
// ameliorer les performence - notion de cache serveur , a partir du moment ou ca a calculer une fois re affiche ca skipper letape de rechercher car les donné non pas cghanger



/*Route::get('/categories', function (){
    \Illuminate\Support\Facades\DB::listen(function ($q){
        logger($q->sql, $q->bindings);
    });
    $categories = \App\Models\Category::all();

    return view('posts',[
        'categories' => $categories,
    ]);
});*/

/*
Route::get('/users', function (){

    $users = \App\Models\User::all();

    return view('posts',[
        'users' => $users,
    ]);
});*/

Route::get('/users/{user:id}', function (\App\Models\User $user) {

    $posts = $user->posts->load('category','user');
    $user->load('posts.category');

    $categories=\App\Models\Category::whereHas('posts')->get();
    $users=\App\Models\User::whereHas('posts')->get();

    $page_title = $user->name;
    return view('posts', compact('user', 'page_title', 'posts', 'users','categories'));

});

Route::get('/register',[\App\Http\Controllers\RegisterController::class,'create'])->middleware('guest'); //middleware na pas dinfluence sur la vue mais sur la route
Route::post('/register',[\App\Http\Controllers\RegisterController::class,'store'])->middleware('guest');

Route::post('/logout',
[SessionController::class, 'destroy']
)->middleware('auth');

Route::get('/login',
    [SessionController::class, 'create']
)->middleware('guest');

Route::post('/sessions',
    [SessionController::class, 'store']
)->middleware('guest');


Route::post('/posts/{post}/comments', [\App\Http\Controllers\PostCommentController::class,'store'])->middleware('auth');


Route::post('/newsletter', NewsletterController::class);



Route::middleware('admins')->group(function(){
    Route::resource('admin/posts', AdminPostController::class)->except('show');
    /*Route::get('/admin/posts', [AdminPostController::class, 'index']);
    Route::get('/admin/posts/create', [AdminPostController::class, 'create']);
    Route::post('/admin/posts', [AdminPostController::class, 'store']);
    Route::get('/admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
    Route::patch('/admin/posts/{post}', [AdminPostController::class, 'update']);
    Route::delete('/admin/posts/{post}', [AdminPostController::class, 'destroy']);*/
});
