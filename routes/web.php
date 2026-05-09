<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TestPlanController;
use App\Http\Controllers\TestCaseController;
use App\Http\Controllers\TestResultController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

// Authenticated user
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $bookings = \App\Models\Booking::where('user_id', auth()->id())->with('event')->latest()->take(5)->get();
        $notes    = \App\Models\Note::where('user_id', auth()->id())->with('event')->orderByDesc('pinned')->latest()->take(4)->get();
        $plans    = \App\Models\TestPlan::where('user_id', auth()->id())->latest()->take(3)->get();
        $stats    = [
            'bookings' => \App\Models\Booking::where('user_id', auth()->id())->count(),
            'notes'    => \App\Models\Note::where('user_id', auth()->id())->count(),
            'plans'    => \App\Models\TestPlan::where('user_id', auth()->id())->count(),
            'events'   => \App\Models\Event::where('published', true)->count(),
        ];
        return view('dashboard', compact('bookings', 'notes', 'plans', 'stats'));
    })->name('dashboard');

    // Events booking
    Route::post('/events/{event}/book', [EventController::class, 'book'])->name('events.book');

    // Bookings
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');

    // Notes
    Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
    Route::put('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
    Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');

    // Test Plans
    Route::get('/tests', [TestPlanController::class, 'index'])->name('tests.index');
    Route::get('/tests/create', [TestPlanController::class, 'create'])->name('tests.create');
    Route::post('/tests', [TestPlanController::class, 'store'])->name('tests.store');
    Route::get('/tests/{test}', [TestPlanController::class, 'show'])->name('tests.show');
    Route::get('/tests/{test}/edit', [TestPlanController::class, 'edit'])->name('tests.edit');
    Route::put('/tests/{test}', [TestPlanController::class, 'update'])->name('tests.update');
    Route::delete('/tests/{test}', [TestPlanController::class, 'destroy'])->name('tests.destroy');

    // Test Cases
    Route::post('/tests/{test}/cases', [TestCaseController::class, 'store'])->name('tests.cases.store');
    Route::delete('/test-cases/{testCase}', [TestCaseController::class, 'destroy'])->name('tests.cases.destroy');

    // Test Results
    Route::post('/test-cases/{testCase}/results', [TestResultController::class, 'store'])->name('tests.results.store');

    // PDF exports
    Route::get('/pdf/test-plan/{test}', [PdfController::class, 'testPlan'])->name('pdf.test-plan');
    Route::get('/pdf/project', [PdfController::class, 'projectDoc'])->name('pdf.project');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('events', Admin\EventController::class);
    Route::resource('carousel', Admin\CarouselController::class)->except(['show','create','edit']);
});

require __DIR__.'/auth.php';
