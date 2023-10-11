<?php

use App\Models\NewsPublication;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NewsPublicationController;
use App\Http\Controllers\SliderController;
use App\Models\Slider;

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

Auth::routes();

Route::get("/storage-link", function () {
    $targetFolder = storage_path("app/public");
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    symlink($targetFolder, $linkFolder);
});

Route::get('/', function () {
    $sliders = Slider::limit(5)->get();

    $news_publications =
        NewsPublication::select(DB::raw("
            title,
            DATE_FORMAT(publish_date, '%W, %d %M, %Y') as publish_date,
            category,
            short_description,
            content_type,
            image_path,
            content,
            slug
        "))
        ->where('content_type', '=', 'public')
        ->orderBy('publish_date', 'ASC')
        ->limit(3)
        ->get();

    return view('frontend.home', [
        'sliders' => $sliders,
        'news_publications' => $news_publications
    ]);
});

Route::resource('public', PublicController::class);
Route::get('/profile', [PublicController::class, 'profile'])->name('public.profile');
Route::get('/organization', [PublicController::class, 'organization'])->name('public.organization');
Route::get('/news', [PublicController::class, 'news'])->name('public.news');
Route::get('/news/{param}', [PublicController::class, 'news_detail'])->name('public.news_detail');
Route::get('/publication', [PublicController::class, 'publication'])->name('public.publication');
Route::get('/publication/{param}', [PublicController::class, 'publication_detail'])->name('public.publication_detail');
Route::get('/event', [PublicController::class, 'event'])->name('public.event');
Route::get('/event/{param}', [PublicController::class, 'event_detail'])->name('public.event_detail');
Route::get('/membership', [PublicController::class, 'membership'])->name('public.membership');

Route::middleware(['auth', ])->prefix('admin')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('user', UserController::class);
    Route::post('delete-user', [UserController::class, 'delete_user'])->name('delete-user');

    Route::post('get-data-user', [UserController::class, 'get_data_users'])->name('get-data-user');

    Route::resource('content', ContentController::class);

    Route::resource('slider', SliderController::class);
    Route::post('delete-slider', [SliderController::class, 'delete_slider'])->name('delete-slider');

    Route::resource('event', EventController::class);
    Route::post('delete-event', [EventController::class, 'delete_event'])->name('delete-event');

    Route::resource('news_publication', NewsPublicationController::class);
    Route::post('delete-news-publication', [NewsPublicationController::class, 'delete_news_publication'])->name('delete-news-publication');
});

Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::resource('member', MemberController::class);
});
