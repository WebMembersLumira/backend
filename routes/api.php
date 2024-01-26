<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;

Route::group([
    'prefix' => 'auth'
  ], function () {
    Route::post('register', [AuthController::class,'register']);
    Route::post('login', [AuthController::class,'login']);
    Route::group([
      'middleware' => 'auth:api'
    ], function(){
      Route::post('logout', [AuthController::class,'logout']);
      Route::post('refresh', [AuthController::class, 'refresh']);
      Route::get('me', [AuthController::class,'me']);
      Route::get('list-user', [AuthController::class,'listUser']);
      Route::post('update-users/{id}', [AuthController::class,'resetPassword']);
      Route::post('update-pw/{id}', [AuthController::class,'updatePw']);
      Route::delete('delete-user/{id}', [AuthController::class,'deleteUser']);
      
      // voting process
      Route::group([
        'middleware' => 'auth:api'
      ], function () {
        Route::get('list-myinvoice/{id}', [InvoiceController::class,'listInvoiceByUserId']);
        Route::get('detail-invoice/{id}', [InvoiceController::class,'detailInvoice']);
        Route::post('update-invoice/{id}', [InvoiceController::class,'updateInvoice']);
        Route::post('atur-tanggal', [InvoiceController::class,'aturTanggal']);
        Route::post('action-invoice', [InvoiceController::class,'actionInvoice']);
        Route::get('check-membership/{id}', [InvoiceController::class,'checkMembership']);
        Route::get('invoice-status/{id}', [InvoiceController::class,'listInvoiceByStatus']);
        Route::get('statistik-invoice', [InvoiceController::class,'getJumlahInvoice']);
        Route::get('list-invoice', [InvoiceController::class,'listInvoice']);
        Route::post('create-invoice', [InvoiceController::class,'createInvoice']);
        
        Route::get('get-link', [ServiceController::class,'getLink']);
        Route::post('set-link', [ServiceController::class,'setLink']);
        Route::get('get-rekening', [ServiceController::class,'getRekening']);
        Route::post('set-rekening', [ServiceController::class,'setRekening']);

        Route::get('list-langganan', [ServiceController::class,'listJenisLangganan']);
        Route::post('set-langganan', [ServiceController::class,'setJenisLangganan']);
        Route::delete('delete-langganan/{id}', [ServiceController::class,'deleteLangganan']);
      });
      
    });
  });
  

  



