<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\FarmerAyudaController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CalamityReportController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('home', [HomeController::class, 'home'])->name('home');
Route::get('admindash', [AdminController::class, 'admindash'])
    ->name('admindash')
    ->middleware('auth'); // Ensure the user is authenticated

Route::get('admintestimonials', [AdminController::class, 'testimonials'])->name('admintestimonials');
// Route::get('feedback', [HomeController::class, 'feedback'])->name('userfeedback');
Route::get('farmersCrops', [AdminController::class, 'farmersCrops'])->name('farmersCrops');
Route::get('viewcrops', [FarmerController::class, 'viewfarmercrops'])->name('viewcrops');
Route::get('/feedback', [FeedbackController::class, 'index'])
    ->name('feedback.index')
    ->middleware('auth');  // Add your middleware here

Route::post('/submit-feedback', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('/weather/{cropId}', [WeatherController::class, 'getWeather']);
Route::get('/viewAllCrops', [AdminController::class, 'ViewAllCrops'])->name('viewAllCrops');

//login register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//farmer data
Route::get('/farmerdata', [FarmerController::class, 'farmerdata'])->name('farmerdata');
Route::post('/farmer-store', [FarmerController::class, 'store'])->name('farmer.store');

Route::get('/weather', [WeatherController::class, 'show'])->name('weather');
Route::get('/weather-data', [WeatherController::class, 'getWeatherData']);
Route::get('/get-soil-temperature', [WeatherController::class,'getSoilTemperature']);

//feedback edit de;lete
Route::get('/feedbacks/{feedback}/edit', [FeedbackController::class, 'edit'])->name('feedbacks.edit');
Route::put('/feedbacks/{feedback}', [FeedbackController::class, 'update'])->name('feedbacks.update');
Route::delete('/feedbacks/{feedback}', [FeedbackController::class, 'destroy'])->name('feedbacks.destroy');

//ayuda
Route::get('assistance', [AdminController::class, 'assistance'])->name('assistance');
// Route::get('/farmer-ayuda', [FarmerAyudaController::class, 'create'])->name('farmer-ayuda.create');

// Route to handle the form submission
Route::post('/farmer-ayuda', [FarmerAyudaController::class, 'store'])->name('farmer-ayuda.store');

//announcements
Route::post('/announcements/store', [AnnouncementController::class, 'store'])->name('announcements.store');
Route::get('announcement', [AdminController::class, 'announcement'])->name('announcement');

//calamity
Route::post('/calamity-report', [CalamityReportController::class, 'store'])->name('calamity-report.store');
Route::get('calamityReport', [HomeController::class, 'calamityReport'])->name('calamityReport');
Route::get('calamityReportAdmin', [AdminController::class, 'calamity'])->name('calamityReportAdmin');
Route::patch('/calamity-report/{id}/complete', [CalamityReportController::class, 'markAsCompleted'])->name('calamity-report.complete');
Route::delete('/calamity-report/{id}/delete', [CalamityReportController::class, 'delete'])->name('calamity-report.delete');
Route::post('calamity-report/upload-image/{id}', [CalamityReportController::class, 'uploadImage'])->name('calamity-report.upload-image');
Route::patch('calamity-report/cancel/{id}', [CalamityReportController::class, 'cancel'])->name('calamity-report.cancel');



//user  account
Route::get('userAccount', [AdminController::class, 'userAccount'])->name('userAccount');

Route::get('editAccount', [HomeController::class, 'editAccount'])->name('editAccount');
Route::put('/profile/update', [HomeController::class, 'updateProfile'])->name('profile.update');


//
