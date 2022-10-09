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

Route::get('/john', function(){
    return 'Hello John';
});

Route::redirect('user', 'john');

Route::fallback(function(){
    return "404";
});

Route::view('/hello', 'hello', ['name' => 'John']);

Route::get('/hello-again', function(){
    return view('hello', ['name'=>'John']);
});

Route::get('hello-world', function(){
    return view('hello.world', ['name' => 'John']);
});

Route::get('/products/{id}', function($productId){
    return 'Product '. $productId;
})->name('product.detail');

Route::get('/products/{product}/item/{id}', function($productId, $itemId){
    return "Product $productId Item $itemId";
})->name('product.item.detail');

Route::get('/category/{id}', function($categoryId){
    return 'Category '. $categoryId;
})->where('id', '[0-9]+')->name('category.detail');

Route::get('/users/{id?}', function($userId = '404'){
    return "User $userId";
})->name('user.detail');

Route::get('/conflict/{name}', function($name){
    return "Conflict $name";
});

Route::get('/conflict/john', function(){
    return "Conflict John Doe";
});

Route::get('/produk/{id}', function($id){
    $link = route('product.detail', ['id' => $id]);
    return "Link $link";
});

Route::get('/produk-redirect/{id}', function($id){
    $link = redirect()->route('product.detail', ['id' => $id]);
    return "Link $link";
});

Route::get('/controller/hello/request', [HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [HelloController::class, 'hello']);

Route::controller(InputController::class)->group(function(){
    Route::get('/input/hello','hello');
    Route::post('/input/hello','hello');
    Route::post('/input/hello/first','helloFirst');
    Route::post('/input/hello/input','helloInput');
    Route::post('/input/hello/array','helloArray');
    Route::post('/input/filter/only','filterOnly');
    Route::post('/input/filter/except','filterExcept');
    Route::post('/input/merge','mergeInput');
});

Route::post('/file/upload', [FileController::class, 'upload'])->withoutMiddleware([VerifyCsrfToken::class]);

Route::get('/response/hello', [ResponseController::class, 'response']);
Route::get('/response/header', [ResponseController::class, 'header']);

Route::controller(ResponseController::class)-> prefix('response/type')->group(function(){
    Route::get('/view', 'responseView');
    Route::get('/json', 'responseJson');
    Route::get('/file', 'responseFile');
    Route::get('/download', 'responseDownload');
});

Route::get('/cookie/set', [CookieController::class, 'createCookie']);
Route::get('/cookie/get', [CookieController::class, 'getCookie']);
Route::get('/cookie/clear', [CookieController::class, 'clearCookie']);

Route::controller(RedirectController::class)->prefix('/redirect')->group(function(){
    Route::get('/to', 'redirectTo');
    Route::get('/from', 'redirectFrom');
    Route::get('/name/{name}', 'redirectHello')->name('redirect-hello');
    Route::get('named', function(){
        // return route('redirect-hello', ['name' => 'John']);
        // return url()->route('redirect-hello', ['name' => 'John']);
        return URL::route('redirect-hello', ['name' => 'John']);
    });
    Route::get('/name', 'redirectName');
    Route::get('/action', 'redirectAction');
    Route::get('/away', 'redirectAway');
});

Route::middleware(['contoh:RAHASIA,401'])->group(function(){
    Route::get('/middleware/api', function(){
        return 'OK';
    });
    Route::get('/middleware/group', function(){
        return 'GROUP';
    });
});

Route::get('/form/', [FormController::class, 'form']);
Route::post('/form/', [FormController::class, 'submitForm']);

Route::get('url/current', function(){
    return \Illuminate\Support\Facades\URL::full();
});
Route::get('/url/action', function(){
    // return action([FormController::class, 'form'], []);
    // return url()->action([FormController::class, 'form'], []);
    return URL::action([FormController::class, 'form']. []);
});

Route::prefix('/session')->controller(SessionController::class)->group(function(){
    Route::get('/create', 'createSession');
    Route::get('/get', 'getSession');
});

Route::get('/error/sample', function(){
    throw new Exception('Sample Error');
});
Route::get('/error/manual', function(){
    report(new Exception('Sample Error'));
    return "OK";
});
Route::get('/error/validation', function(){
    throw new ValidationException('Validation Error');
});

Route::prefix('/abort')->group(function(){
    Route::get('/400', function(){
        abort(400, 'Custom Error Page');
    });
    Route::get('/401', function(){
        abort(401);
    });
    Route::get('/500', function(){
        abort(500);
    });
});
