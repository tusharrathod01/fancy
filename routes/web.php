<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\PartyMasterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\YearController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/password-forgot', [HomeController::class, 'password_forgot'])->name('password-forgot');
Route::post('/password-save', [HomeController::class, 'password_reset'])->name('resetpass.save');

//users
Route::get('/users', [HomeController::class, 'users'])->name('users');
Route::post('/user_update', [HomeController::class, 'user_update'])->name('user-update');
Route::get('/user_activity', [HomeController::class, 'user_activity'])->name('user-activity');
Route::post('/user-logs', [HomeController::class, 'user_logs'])->name('user.logs');
Route::post('/user-save', [HomeController::class, 'new_user'])->name('new.user.save');

Route::post('edit-user/', [HomeController::class, 'edit_user'])->name('edit.user');
Route::post('/new-user-update', [HomeController::class, 'user_update_new'])->name('new.user.update');
Route::post('/get-user', [HomeController::class, 'get_users'])->name('get.user');

// permissions
Route::post('permissions', [HomeController::class, 'permissions'])->name('user.permissions');
Route::post('permissions-update', [HomeController::class, 'permissions_update'])->name('user.permissions.update');

//masters
Route::get('masters/color', [MasterController::class, 'color'])->name('color');
Route::get('masters/shape', [MasterController::class, 'shape'])->name('shape');
Route::get('masters/size', [MasterController::class, 'size'])->name('size');
Route::get('masters/calarity', [MasterController::class, 'calarity'])->name('calarity');
Route::get('masters/type', [MasterController::class, 'type'])->name('type');
Route::get('masters/agtype', [MasterController::class, 'agtype'])->name('agtype');
Route::get('masters/currancy', [MasterController::class, 'currancy'])->name('currancy');
Route::get('masters/party', [MasterController::class, 'party'])->name('party');
Route::post('save-masters', [MasterController::class, 'save_masters'])->name('save.masters');
Route::post('get-masters/{types}', [MasterController::class, 'get_masters'])->name('get.masters');

// currency
Route::post('save-currency', [CurrencyController::class, 'save_currency'])->name('save.currency');
Route::post('get-currency/{types}', [CurrencyController::class, 'get_currency'])->name('get.currency');

// year
Route::get('/year', [YearController::class, 'index'])->name('year');
Route::get('/get-year', [YearController::class, 'get_year'])->name('get.year');
Route::post('/save-year', [YearController::class, 'save'])->name('year.save');

// party
Route::get('get-partys', [PartyMasterController::class, 'get'])->name('get.partys');
Route::get('get-party-details', [PartyMasterController::class, 'get_details'])->name('get.party.details');
Route::post('save-party', [PartyMasterController::class, 'save_party'])->name('save.party');
Route::get('get-currancy', [PartyMasterController::class, 'getCurrancy'])->name('get.currancy');
Route::get('/states/{countryId}', [PartyMasterController::class, 'getStates']);
Route::get('/cities/{stateId}', [PartyMasterController::class, 'getCities']);

//party report
Route::get('/party-report', [ReportController::class, 'Party_report'])->name('party_report');
Route::post('/get-party-report', [MasterController::class, 'Party_report'])->name('party.report');
Route::delete('/party-delete', [MasterController::class, 'Party_delete'])->name('party.delete');

//log activity
Route::get('my-activity', [ActivityController::class, 'myActivity'])->name('my.activity');
Route::post('get-my-activity', [ActivityController::class, 'getMyActivity'])->name('get.my.activity');
Route::post('get-activity-detail', [ActivityController::class, 'getMyActivityDetail'])->name('get.my.activity.detail');

