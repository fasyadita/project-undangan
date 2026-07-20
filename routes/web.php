<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvitationController;

// ─── Halaman Utama ────────────────────────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', function () {
    return view('create');
});

// ─── Preview Tema (untuk welcome page, menggunakan dummy data) ─────────────────
Route::get('/preview/{theme}', [InvitationController::class, 'preview'])->name('preview');

// ─── Route Slug Dinamis (HARUS di paling bawah) ───────────────────────────────
Route::get('/{slug}', [InvitationController::class, 'show'])->name('invitation.show');
Route::post('/{slug}/rsvp', [InvitationController::class, 'rsvp'])->name('invitation.rsvp');
Route::post('/{slug}/visit', [InvitationController::class, 'visit'])->name('invitation.visit');
