<?php

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

Route::get("/login", "appControl@index")->where("any", ".*");
Route::POST("/login/submitform", "appControl@loginSubmit");
Route::get("/logout", "appControl@logout");


Route::group(['middleware' => ['loginAuth']], function () {     

Route::post("/master/modul", "modulControl@index");
Route::post("/master/acl", "aclControl@index");
Route::POST("/master/aclGroup", "aclGroupControl@index");

Route::get("/acl", "aclControl@index");
Route::post("/aclgetR", "aclControl@aclGet");
Route::POST("/master/users", "userControl@index");

Route::POST("/master/opd", "opdControl@index");


Route::POST("/perizinan/permohonan", "permohonanControl@index");
Route::POST("/perizinan/perusahaan", "perusahaanControl@index");


Route::POST("/opd/izin", "opdIzinControl@index");



Route::POST("/surat/rekomendasi", "suratRekomendasiControl@index");

Route::get("/{any}", "appControl@index")->where("any", ".*");

});