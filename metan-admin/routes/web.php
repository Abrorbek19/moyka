<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Stichoza\GoogleTranslate\GoogleTranslate;
use TCG\Voyager\Facades\Voyager;


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

Route::group(['prefix' => '/'], function () {
    Route::get('', function () {
        $carusel = DB::table('carusel')->get();
        $about = DB::table('about')->get();
        $location = DB::table('location')->get();
        $team = DB::table('team')->get();
        $commentary = DB::table('client_comment')->get();
        $items = DB::table('items')->where(['category'=>'about'])->get();
        $locale = Session::get('locale','uz');
        $news = DB::table('news')->orderBy('id','desc')->limit(3)->get();
        return view('template.index',compact('carusel','about','items','location','locale','team','commentary','news',));
    });
//
//    Route::get('translate/{local}',function ($local){
//        $lang = new GoogleTranslate('en');
//        return $lang->setSource('en')->setTarget($local)->translate("hello world");
//    });

    Route::get('lang/{locale}', function ($locale) {
        $langs = ['en', 'uz','ru'];
        if (in_array($locale, $langs)) {
            Session::put('locale', $locale);
            App::setLocale($locale);
        } else {
            Session::put('locale', "en");
            App::setLocale('en');
        }
        return redirect()->back();
    })->name('locale');

    Route::get('about', function () {
        $about = DB::table('about')->get();
        $items = DB::table('items')->where(['category'=>'about'])->get();
        $team = DB::table('team')->get();
        $locale = Session::get('locale','uz');
        return view('template.about',compact('locale','about','team','items'));
    });
    Route::get('service', function () {
        $commentary = DB::table('client_comment')->get();
        $locale = Session::get('locale','uz');
        return view('template.service',compact('locale','commentary'));
    });
    Route::get('price', function () {

        $locale = Session::get('locale','uz');
        return view('template.price',compact('locale'));
    });
    Route::get('location', function () {
        $locale = Session::get('locale','uz');
        $location = DB::table('location')->get();
        return view('template.location',compact('locale','location'));
    });
    Route::get('contact', function () {
        $information = \Illuminate\Support\Facades\DB::table('information')->get();
        $locale = Session::get('locale','uz');
        return view('template.contact',compact('locale','information'));
    });
    Route::get('blog', function () {
        $news = DB::table('news')->paginate(6);
        $locale = Session::get('locale','uz');
        return view('template.blog',compact('locale','news'));
    });

    Route::get('single/{id}', function ($id) {
        $locale = Session::get('locale','uz');
        $news = DB::table('news')->where('id',$id)->get();
        $post = DB::table('news')->get();
        $author = DB::table('author')->get();
        $comment = DB::table('comment')->where(['single_id'=>$id,'status'=>'true'])->get();
        $comment_count = DB::table('comment')->where(['single_id'=>$id,'status'=>'true'])->count();
        $posts = DB::table('news')->orderBy('id','desc')->limit(10)->get();
        return view('template.single',compact('news','post','posts','author','comment','comment_count','locale'));
    });
});


Route::resource("/message", \App\Http\Controllers\OrderController::class);

Route::resource("/comment", \App\Http\Controllers\CommentController::class);

Route::resource("/contact_message", \App\Http\Controllers\ContactController::class);

Route::resource("/news_email", \App\Http\Controllers\NewsEmailController::class);

Route::resource("/like", \App\Http\Controllers\LikeController::class);

Route::post('/unlike', [\App\Http\Controllers\LikeController::class, 'unlike'])->name('like.unlike');



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

