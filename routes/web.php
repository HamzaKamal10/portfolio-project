<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectShowController;
use App\Livewire\Admin\EducationManager;
use App\Livewire\Admin\ExperienceManager;
use App\Livewire\Admin\ProfileEditor;
use App\Livewire\Admin\ProjectsManager;
use App\Livewire\Admin\SkillsManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// التعديل المضاف هنا لتوجيه الرابط الرئيسي تلقائياً للغة العربية
Route::get('/', function () {
    return redirect('/ar');
});

Route::get('/language/{locale}', function (Request $request, string $locale) {
    abort_unless(in_array($locale, ['ar', 'en'], true), 404);

    $request->session()->put('locale', $locale);

    return redirect()->back();
})->name('language.switch');


Route::prefix('{locale}')
    ->whereIn('locale', ['ar', 'en'])
    ->middleware('locale')
    ->group(function (): void {
        Route::get('/', HomeController::class)->name('home');

        Route::view('/projects', 'projects.index')->name('projects.index');

        Route::get('/projects/{project:slug}', ProjectShowController::class)
            ->name('projects.show');
    });


Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function (): void {
        Route::view('/', 'admin.dashboard')->name('dashboard');

        Route::get('/projects', ProjectsManager::class)->name('projects');
        Route::get('/skills', SkillsManager::class)->name('skills');
        Route::get('/experience', ExperienceManager::class)->name('experience');
        Route::get('/education', EducationManager::class)->name('education');
        Route::get('/profile', ProfileEditor::class)->name('profile');
    });

require __DIR__ . '/auth.php';
