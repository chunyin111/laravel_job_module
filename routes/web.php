<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterdUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use \App\Jobs\TranslateJob;
use \App\Models\Job;

/** test mail */
Route::get('test', function(){
    //method 1:
    // Illuminate\Support\Facades\Mail::to('douglaswong@test.com')->send(
    //     new \App\Mail\JobPosted();
    // );
    //method 2:
    // return new \App\Mail\JobPosted(); //testing

    //method 3:
    // dispatch(function(){ //派遣
    //     logger('hello from the queue!');
    // })->delay(5);

    //method 4: dedicated for job dispatch
    $job =  Job::first();
    TranslateJob::dispatch($job);
    return 'done';
});

Route::view('/', 'home');

// Route::controller(JobController::class)->group(function(){
//     //index
//     Route::get('/jobs','index');
    
//     //create
//     Route::get('/jobs/create', 'create');
    
//     //show (use {job} default is using in db is id)
//     Route::get('/jobs/{job}', 'show');
    
//     //store
//     Route::post('/jobs','store');
    
//     //edit
//     route::get('/jobs/{job}/edit','edit');
    
//     //update
//     route::patch('/jobs/{job}','update');
    
//     //destroy
//     route::delete('/jobs/{job}','destroy');
// });

//resource include index, store, create, update, destroy and edit
// Route::resource('jobs', JobController::class, /*['except' => 'store', 'only' => 'index']*/)->only(['index', 'show']);
    Route::get('/jobs',[JobController::class, 'index']);
    Route::get('/jobs/create', [JobController::class, 'create']);
    Route::post('/jobs',[JobController::class, 'store'])->middleware('auth');
    Route::get('/jobs/{job}', [JobController::class, 'show']);
    route::get('/jobs/{job}/edit',[JobController::class, 'edit'])->middleware('auth')->can('edit', 'job'); //the job refering {job}, if using policy it was folo the function name
    route::patch('/jobs/{job}',[JobController::class, 'update'])->middleware('auth')->can('edit', 'job');
    route::delete('/jobs/{job}',[JobController::class, 'destroy'])->middleware('auth')->can('edit', 'job');

//auth
Route::get('/register', [RegisterdUserController::class, 'create']);
Route::post('/register', [RegisterdUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

Route::view('/contact', 'contact');
