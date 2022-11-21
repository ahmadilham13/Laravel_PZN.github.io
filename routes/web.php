<?php

use App\Exceptions\ValidationException;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use TheSeer\Tokenizer\Exception;

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

Route::get('/pzn', function() {
    return "Hello Ahmad Ilham";
});

Route::redirect('/youtube', '/pzn');

Route::fallback(function() {
    return "404 By Ahmad Ilham";
});

Route::get('/hello', function() {
    return view('hello', [
        "name" => "Ahmad Ilham1"
    ]);
});
// atau bisa gunakan ini....
Route::view('/hello-again', 'hello', ["name" => "Ahmad Ilham2"]);

Route::view('/hello-world', 'hello.world', ["name"=> "Ilham Ahmad"]);

Route::get('/products/{id}', function($product_id) {
    return "Product : $product_id";
})->name('product.detail');

Route::get('/products/{product}/item/{item}', function($product_id, $item_id) {
    return "Product : $product_id, Item : $item_id";
})->name('product.item.detail');

Route::get('/kategori/{id}', function ($kategori_id) {
    return "Kategori : $kategori_id";
})-> where('id', '[0-9]+')->name('kategori.detail');

Route::get('/users/{id?}', function($users_id = "404") {
    return "User : $users_id";
})->name('user.detail');

Route::get('/produk/{id}', function ($id) {
    $link = route('product.detail', ['id'=> $id]);
    return "Link : $link";
});

Route::get('/produk-redirect/{id}', function($id) {
    return redirect()->route('product.detail', ['id' => $id]);
});

Route::get('/controller/hello/request', [HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [HelloController::class, 'hello']);

Route::controller(InputController::class)->group(function() {
    Route::get('/input/hello', 'hello');
    Route::post('/input/hello', 'hello');
    Route::post('/input/hello/first', 'helloFirstName');
    Route::post('/input/hello/input', 'helloInput');
    Route::post('/input/hello/array', 'helloArray');
    Route::post('/input/type', 'inputType');
    Route::post('/input/filter/only', 'filterOnly');
    Route::post('/input/filter/except', 'filterExcept');
    Route::post('/input/filter/merge', 'filterMerge');    
});



Route::post('/file/upload', [FileController::class, 'upload'])->withoutMiddleware([VerifyCsrfToken::class]);

Route::get('/response/hello', [ResponseController::class, 'response']);

Route::get('/response/header', [ResponseController::class, 'header']);

Route::prefix('/response/type')->group(function() {
    Route::get('/view', [ResponseController::class, 'responseView']);
    Route::get('/json', [ResponseController::class, 'responseJson']);
    Route::get('/file', [ResponseController::class, 'responseFile']);
    Route::get('/download', [ResponseController::class, 'responseDownload']);
});

Route::get('/cookie/set', [CookieController::class, 'createCookie']);
Route::get('/cookie/get', [CookieController::class, 'getCookie']);
Route::get('/cookie/clear', [CookieController::class, 'clearCookie']);

Route::prefix('/redirect')->controller(RedirectController::class)->group(function() {
    Route::get('/from', 'redirectFrom');
    Route::get('/to', 'redirectTo');
    Route::get('/name', 'redirectName');
    Route::get('/hello/{name}/{asal}', 'redirectHello')->name('redirect-hello');
    Route::get('/named', function() {
        // return route('redirect-hello', ['name' => 'Ilham1', 'asal' => 'Jambi1']);
        // return url()->route('redirect-hello', ['name'=> 'ilham2', 'asal' => 'Jambi2']);
        return URL::route('redirect-hello', ['name' => 'Ilham3', 'asal' => 'Jambi3']);
    });
    Route::get('/action', 'redirectAction');
    Route::get('/away', 'redirectAway');
});

Route::middleware(['contoh:PZN,401'])->prefix('/middleware')->group(function() {
    Route::get('/api', function() {
        return "Ok";
    });
    
    Route::get('/group', function() {
        return "GROUP";
    });
});

Route::get('/url/action', function() {
    // return action([FormController::class, 'form'], []);
    // return url()->action([FormController::class, 'form'], []);
    return URL::action([FormController::class, 'form'], []);
});

Route::get('/form', [FormController::class, 'form']);
Route::post('/form', [FormController::class, 'submitForm']);

Route::get('url/current', function() {
    return URL::full();
});

Route::get('/session/create', [SessionController::class, 'createSession']);
Route::get('/session/get', [SessionController::class, 'getSession']);

Route::get('/error/sample', function() {
    throw new Exception('Sample Error');
});

Route::get('/error/manual', function() {
    report(new Exception('Sample Error'));
    return "Ok";
});
Route::get('/error/validation', function() {
    throw new ValidationException("Validation Error");
});

Route::get('/abort/400', function() {
    abort(400, "Ups Validation Error");
});

Route::get('/abort/401', function() {
    abort(401);
});
Route::get('/abort/500', function() {
    abort(500);
});