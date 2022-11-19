<?php

use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
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

Route::get('/input/hello', [InputController::class, 'hello']);
Route::post('/input/hello', [InputController::class, 'hello']);

Route::post('/input/hello/first', [InputController::class, 'helloFirstName']);

Route::post('/input/hello/input', [InputController::class, 'helloInput']);

Route::post('/input/hello/array', [InputController::class, 'helloArray']);
