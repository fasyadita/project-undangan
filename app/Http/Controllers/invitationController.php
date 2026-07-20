<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon; // Wajib di-import biar format tanggal di view nggak error

class InvitationController extends Controller
{
    /**
     * Menampilkan halaman undangan pernikahan dengan dummy data.
     */
    public function show($slug)
    {
        // 1. Setup Dummy Data Undangan (dijadikan object)
        $invitation = (object) [
            'slug'           => $slug,
            'groom_nickname' => 'Bagas',
            'bride_nickname' => 'Putri',
            'groom_name'     => 'Bagas Pratama',
            'bride_name'     => 'Putri Maharani',
            'groom_father'   => 'Budi Santoso',
            'groom_mother'   => 'Siti Aminah',
            'bride_father'   => 'Haryanto',
            'bride_mother'   => 'Sri Lestari',
            'groom_photo'    => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=300&q=80',
            'bride_photo'    => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=300&q=80',
            'event_date'     => Carbon::parse('2026-10-25'), // Pakai Carbon biar ->translatedFormat() jalan
            'event_time'     => '08:00 WIB',
            'event_location' => 'Gedung Graha Saba',
            'event_address'  => 'Jl. Letjen Sutoyo No. 12, Malang',
            'event_map_url'  => 'https://maps.google.com',
            'music_url'      => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3', // Dummy audio
        ];

        // 2. Setup Dummy Data Tamu & Ucapan (dibungkus collection)
        $invitation->guests = collect([
            (object) [
                'name'       => 'Temen Nongkrong',
                'is_present' => true,
                'wish'       => 'Selamat menempuh hidup baru! Tolak nganggur, tolak revisi, tolak gaji di bawah UMR! 🔥',
                'created_at' => Carbon::now()->subHours(2), // 2 jam yang lalu
            ],
            (object) [
                'name'       => 'Mantan Terselubung',
                'is_present' => false,
                'wish'       => 'Maaf nggak bisa hadir, semoga lancar acaranya ya. Bahagia selalu!',
                'created_at' => Carbon::now()->subDays(1), // 1 hari yang lalu
            ]
        ]);

        return view('themes.' . $invitation->theme->folder_name ?? 'classic-emerald', compact('invitation'));
    }

    /**
     * Preview tema dengan dummy data (dipakai oleh halaman welcome).
     */
    public function preview($theme)
    {
        $allowedThemes = [
            'classic-emerald', 'rustic-gold', 'modern-minimalist',
            'elegant', 'rustic-floral', 'girl', 'undangan', 'invitation',
        ];

        if (!in_array($theme, $allowedThemes)) {
            abort(404);
        }

        $invitation = (object) [
            'slug'           => 'preview',
            'groom_nickname' => 'Bagas',
            'bride_nickname' => 'Putri',
            'groom_name'     => 'Bagas Pratama',
            'bride_name'     => 'Putri Maharani',
            'groom_father'   => 'Budi Santoso',
            'groom_mother'   => 'Siti Aminah',
            'bride_father'   => 'Haryanto',
            'bride_mother'   => 'Sri Lestari',
            'groom_photo'    => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=300&q=80',
            'bride_photo'    => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=300&q=80',
            'event_date'     => Carbon::parse('2026-10-25'),
            'event_time'     => '08:00 WIB',
            'event_location' => 'Gedung Graha Saba',
            'event_address'  => 'Jl. Letjen Sutoyo No. 12, Malang',
            'event_map_url'  => 'https://maps.google.com',
            'music_url'      => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3',
        ];

        $invitation->guests = collect([
            (object) [
                'name'       => 'Temen Nongkrong',
                'is_present' => true,
                'wish'       => 'Selamat menempuh hidup baru! Semoga sakinah, mawaddah, warahmah! 🔥',
                'created_at' => Carbon::now()->subHours(2),
            ],
            (object) [
                'name'       => 'Mantan Terselubung',
                'is_present' => false,
                'wish'       => 'Maaf nggak bisa hadir, semoga lancar acaranya ya. Bahagia selalu!',
                'created_at' => Carbon::now()->subDays(1),
            ]
        ]);

        return view('themes.' . $theme, compact('invitation'));
    }

    /**
     * Pura-pura memproses form RSVP.
     */
    public function rsvp(Request $request, $slug)
    {
        // Karena nggak ada database, kita nggak nyimpen apa-apa
        // Langsung balikin aja halamannya dengan pesan sukses
        return back()->with('rsvp_success', 'Terima kasih! RSVP dan ucapan Anda berhasil dikirim (Dummy Mode).');
    }

    /**
     * Pura-pura mencatat kunjungan (AJAX Fetch).
     */
    public function visit(Request $request, $slug)
    {
        // Langsung balikin response JSON sukses
        return response()->json([
            'status'  => 'success',
            'message' => 'Kunjungan berhasil dicatat (Dummy Mode)'
        ]);
    }
}