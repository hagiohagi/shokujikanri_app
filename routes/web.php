<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });



// ルートディレクトリへのアクセスはログイン画面にリダイレクト
Route::redirect('/', '/login');

// ファイルパス取得用
Route::get('/images/{$meal_photo}', 'FileController@get_request_image')->where('meal_photo', '.*');

require __DIR__.'/auth.php';

Route::prefix('researchers')->name('researchers.')->group(function(){
    require __DIR__.'/researchers.php';
});

Route::prefix('admin')->name('admin.')->group(function(){
    require __DIR__.'/admin.php';
});

// 回答者側
Route::group(['middleware' => 'auth'], function () {
    Route::get('/complete', 'App\Http\Controllers\CompleteController@index');
    Route::get('/index', 'App\Http\Controllers\IndexController@index')->name('index');
    Route::get('/upload', 'App\Http\Controllers\UploadController@index');
    Route::post('/upload', 'App\Http\Controllers\UploadController@create');
    Route::get('/edit/{meal_id}', 'App\Http\Controllers\EditController@index');
    Route::post('edit/{meal_id}', 'App\Http\Controllers\EditController@update');
    Route::post('delete/{meal_id}', 'App\Http\Controllers\EditController@delete');
});
    
    // 研究者側
        Route::prefix('project')->middleware(['auth:researchers'])->group(function () {
            Route::get('/index', 'App\Http\Controllers\Project\IndexController@index');
            Route::get('/list/{survey_id}', 'App\Http\Controllers\Project\ListController@index');
            Route::get('/info/{survey_id}/{meal_id}', 'App\Http\Controllers\Project\InfoController@index');
        });
        
        // 管理者側
        Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
            Route::get('/user', 'App\Http\Controllers\Admin\UserController@index')->name('admin.user');
            Route::get('/user/register', 'App\Http\Controllers\Admin\UserRegisterController@index');
            Route::post('/user/register', 'App\Http\Controllers\Admin\UserRegisterController@register');
            Route::get('/user/{id}/edit', 'App\Http\Controllers\Admin\UserEditController@index');
            Route::post('/user/{id}/edit', 'App\Http\Controllers\Admin\UserEditController@update');
            // Route::post('/user/{id}/delete', 'App\Http\Controllers\Admin\UserEditController@delete');
            Route::get('/user/{id}/index', 'App\Http\Controllers\Admin\IndexController@index')->name('admin.index');
            Route::get('/user/{id}/upload', 'App\Http\Controllers\Admin\UploadController@index');
            Route::post('/user/{id}/upload', 'App\Http\Controllers\Admin\UploadController@create');
            Route::get('/user/{id}/edit/{meal_id}', 'App\Http\Controllers\Admin\EditController@index');
            Route::post('/user/{id}/edit/{meal_id}', 'App\Http\Controllers\Admin\EditController@update');
            Route::post('/user/{id}/delete/{meal_id}', 'App\Http\Controllers\Admin\EditController@delete');

            Route::get('/project', 'App\Http\Controllers\Admin\ProjectController@index')->name('admin.project');
            Route::get('/project/register', 'App\Http\Controllers\Admin\ProjectRegisterController@index');
            Route::post('/project/register', 'App\Http\Controllers\Admin\ProjectRegisterController@register');
            Route::get('/project/{survey_id}/list', 'App\Http\Controllers\Admin\ProjectListController@index');
            Route::get('/project/{id}/edit', 'App\Http\Controllers\Admin\ProjectEditController@index');
            Route::post('/project/{id}/edit', 'App\Http\Controllers\Admin\ProjectEditController@update');
            // Route::post('/project/{id}/delete', 'App\Http\Controllers\Admin\ProjectEditController@delete');
            Route::get('/user/import', 'App\Http\Controllers\Admin\UserImportController@index');
        
    });


