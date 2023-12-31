<?php


use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\S13\FileStorageController;
use App\Http\Controllers\api\S16\CategoryController;
use App\Http\Controllers\api\S16\PostController;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// 19 Send mail
Route::prefix('S19')->group(function () {
    Route::post("send-mail", function () {
        try {
            // Mail::raw("Hello", function ($message) {
            //     $message->to('t1z4t@example.com')->subject('memek');
            // });

            // pake email yang kita buat dengan make:mail
            Mail::send(new OrderShipped);
            return response()->json(['message' => 'Email sent successfully']);
        } catch (\Exception $e) {
            // Tangani exception di sini
            // Misalnya, simpan pesan kesalahan dalam log atau berikan respons kesalahan yang sesuai
            return response()->json(['error' => 'Failed to send email'], 500);
        }
    });
});

Route::middleware('auth:sanctum')->group(function () {
    // 16 CRUD OPERATIONS
    Route::prefix('S16')->group(function () {
        Route::get('/posts/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/posts/trash', [PostController::class, 'trashed'])->name('posts.trash');
        Route::get('/posts/trash/{id}/restore', [PostController::class, 'restore'])->name('posts.trash.restore');
        Route::get('/posts/trash/{id}', [PostController::class, 'showTrashed'])->name('posts.trash.show');
        Route::delete('/posts/trash/{id}', [PostController::class, 'forceDelete'])->name('posts.trash.forceDelete');

        Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
        Route::post('/posts/{id}', [PostController::class, 'update'])->name('post.edit');
        Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

        Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
        Route::post('/posts', [PostController::class, 'store'])->name('posts.create');
    });
});



// 13 file storage
Route::prefix('S13')->middleware(['auth:sanctum'])->group(function () {
    Route::post('/upload', [FileStorageController::class, 'upload']);
    Route::get('/test', [FileStorageController::class, 'babi']);
});


// auth
Route::prefix('auth')->middleware(['guest'])->controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('login')->name('login');
    Route::post('/register', 'register')->name('register')->name('register');
    Route::get('/refresh', [AuthController::class, 'refresh'])->name('refresh');
});
Route::middleware('auth:sanctum')->post('/auth/logout', [AuthController::class, 'logout'])->name('logout');
