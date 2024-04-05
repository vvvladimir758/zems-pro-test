<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\
{
    TaskController,
    ProjectController,
    ProjectVueController,
    ImageController, 
    TimeSpentController,
};
use App\Http\Controllers\StatisticController;

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();


Route::middleware(['auth'])->group(function () {
        
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        
        Route::resource('project', ProjectController::class);
        
        Route::controller(ProjectVueController::class)->group(function () {
            Route::get('/vue_projects', 'index');
            Route::get('/vue_projects_data', 'projects');
            Route::get('/vue_project/{project}','show');
        });
        
        Route::resource('task', TaskController::class);
        Route::get('/task_data/{taskId}',[TaskController::class, 'taskData']);
        
        Route::resource('time_spent', TimeSpentController::class);
        Route::post('/time_spent/stop/{id}', [TimeSpentController::class, 'stop']);
        
        
        Route::get('/images', [ImageController::class, 'index']);
        Route::post('/images/upload', [ImageController::class, 'store']);
        
        Route::get('/statistic', [StatisticController::class, 'index'])->name('statistic');

});