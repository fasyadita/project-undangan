<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Theme;
use App\Models\Invitation;
use App\Models\Guest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed or get User
        $user = User::firstOrCreate(
            ['email' => 'fasya@example.com'],
            [
                'name' => 'Fasya Dita',
                'password' => bcrypt('password123'),
            ]
        );

        // 2. Seed Default Themes
        $themeEmerald = Theme::updateOrCreate(
            ['slug' => 'classic-emerald'],
            [
                'name' => 'Classic Emerald',
                'folder_name' => 'classic-emerald',
                'preview_image' => 'themes/classic-emerald.jpg',
                'is_premium' => false,
            ]
        );

        $themeGold = Theme::updateOrCreate(
            ['slug' => 'rustic-gold'],
            [
                'name' => 'Rustic Gold',
                'folder_name' => 'rustic-gold',
                'preview_image' => 'themes/rustic-gold.jpg',
                'is_premium' => true,
            ]
        );

        $themeMinimalist = Theme::updateOrCreate(
            ['slug' => 'modern-minimalist'],
            [
                'name' => 'Modern Minimalist',
                'folder_name' => 'modern-minimalist',
                'preview_image' => 'themes/modern-minimalist.jpg',
                'is_premium' => true,
            ]
        );

        // 3. Seed Invitation 1: Classic Emerald (Budi & Ani)
        $invitationEmerald = Invitation::updateOrCreate(
            ['slug' => 'budi-ani'],
            [
                'user_id' => $user->id,
                'theme_id' => $themeEmerald->id,
                'groom_name' => 'Budi Santoso',
                'groom_nickname' => 'Budi',
                'groom_father' => 'Joko Santoso',
                'groom_mother' => 'Sri Astuti',
                'groom_photo' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?q=80&w=500',
                'bride_name' => 'Ani Wijaya',
                'bride_nickname' => 'Ani',
                'bride_father' => 'Indra Wijaya',
                'bride_mother' => 'Kartini Wijaya',
                'bride_photo' => 'https://images.unsplash.com/photo-1549417229-aa67d3263c09?q=80&w=500',
                'event_date' => '2026-12-31',
                'event_time' => '09:00 WIB - Selesai',
                'event_location' => 'Auditorium Masjid Raya',
                'event_address' => 'Jl. Raya Pajajaran No. 123, Baranangsiang, Bogor, Jawa Barat',
                'event_map_url' => 'https://maps.google.com',
                'music_url' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3',
                'status' => 'active',
                'plan' => 'free',
                'gallery' => [
                    'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=600',
                    'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=600',
                    'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=600',
                ],
                'story' => [
                    [
                        'date' => 'Desember 2021',
                        'title' => 'Pertama Kali Bertemu',
                        'description' => 'Kami bertemu pertama kali di perpustakaan kampus saat sedang mengerjakan skripsi bersama.',
                    ],
                    [
                        'date' => 'Agustus 2023',
                        'title' => 'Menjalin Komitmen',
                        'description' => 'Setelah dua tahun berteman dekat, kami akhirnya memutuskan untuk menjalin hubungan berkomitmen serius.',
                    ],
                    [
                        'date' => 'Januari 2026',
                        'title' => 'Lamaran (Khithbah)',
                        'description' => 'Budi datang bersama keluarga besarnya untuk meminta izin mempersunting Ani secara resmi.',
                    ]
                ],
                'gift_accounts' => [
                    [
                        'bank' => 'BCA',
                        'number' => '1234567890',
                        'owner' => 'Budi Santoso',
                    ],
                    [
                        'bank' => 'Mandiri',
                        'number' => '0987654321',
                        'owner' => 'Ani Wijaya',
                    ]
                ]
            ]
        );

        Guest::firstOrCreate(
            ['invitation_id' => $invitationEmerald->id, 'name' => 'Eko Prasetyo'],
            [
                'is_present' => true,
                'guest_count' => 2,
                'wish' => 'Selamat menempuh hidup baru Budi & Ani! Semoga menjadi keluarga yang sakinah mawaddah warahmah. Aamiin!',
            ]
        );

        // 4. Seed Invitation 2: Rustic Gold (Riri & Arya)
        $invitationGold = Invitation::updateOrCreate(
            ['slug' => 'riri-arya'],
            [
                'user_id' => $user->id,
                'theme_id' => $themeGold->id,
                'groom_name' => 'Arya Pratama',
                'groom_nickname' => 'Arya',
                'groom_father' => 'Bambang Pratama',
                'groom_mother' => 'Rini Pratama',
                'groom_photo' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=500',
                'bride_name' => 'Riri Lestari',
                'bride_nickname' => 'Riri',
                'bride_father' => 'Agus Lestari',
                'bride_mother' => 'Dewi Lestari',
                'bride_photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=500',
                'event_date' => '2026-10-18',
                'event_time' => '10:00 WIB - Selesai',
                'event_location' => 'Villa Pine Hill Cibodas',
                'event_address' => 'Jl. Ciherang Kidul, Cipanas, Cianjur, Jawa Barat',
                'event_map_url' => 'https://maps.google.com',
                'music_url' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3',
                'status' => 'active',
                'plan' => 'premium',
                'gallery' => [
                    'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?q=80&w=600',
                    'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?q=80&w=600',
                    'https://images.unsplash.com/photo-1505944270255-72b8c68c6a70?q=80&w=600',
                ],
                'story' => [
                    [
                        'date' => 'Maret 2022',
                        'title' => 'Pertemuan Tak Sengaja',
                        'description' => 'Kami berteduh di kafe yang sama saat hujan badai di Bandung. Secangkir kopi hangat mempertemukan kami.',
                    ],
                    [
                        'date' => 'September 2024',
                        'title' => 'Petualangan Bersama',
                        'description' => 'Sebagai sesama pecinta alam, kami mendaki Gunung Prau bersama dan berjanji untuk selalu mendaki perjalanan hidup bersama.',
                    ]
                ],
                'gift_accounts' => [
                    [
                        'bank' => 'BNI',
                        'number' => '5554443322',
                        'owner' => 'Arya Pratama',
                    ],
                    [
                        'bank' => 'ShopeePay',
                        'number' => '08123456789',
                        'owner' => 'Riri Lestari',
                    ]
                ]
            ]
        );

        Guest::firstOrCreate(
            ['invitation_id' => $invitationGold->id, 'name' => 'Citra Kirana'],
            [
                'is_present' => true,
                'guest_count' => 1,
                'wish' => 'Happy wedding Riri & Arya! Senang sekali melihat perjalanan kalian sampai ke pelaminan. Bahagia selamanya ya!',
            ]
        );

        // 5. Seed Invitation 3: Modern Minimalist (Zara & Ray)
        $invitationMinimalist = Invitation::updateOrCreate(
            ['slug' => 'zara-ray'],
            [
                'user_id' => $user->id,
                'theme_id' => $themeMinimalist->id,
                'groom_name' => 'Ray Dimas',
                'groom_nickname' => 'Ray',
                'groom_father' => 'Herman Dimas',
                'groom_mother' => 'Ratih Dimas',
                'groom_photo' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=500',
                'bride_name' => 'Zara Amelia',
                'bride_nickname' => 'Zara',
                'bride_father' => 'Gunawan Amelia',
                'bride_mother' => 'Santi Amelia',
                'bride_photo' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=500',
                'event_date' => '2026-11-22',
                'event_time' => '11:00 WIB - Resepsi 13:00 WIB',
                'event_location' => 'The Glass House Ballroom',
                'event_address' => 'Sudirman Central Business District (SCBD) Lot 14, Jakarta Selatan',
                'event_map_url' => 'https://maps.google.com',
                'music_url' => 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-3.mp3',
                'status' => 'active',
                'plan' => 'premium',
                'gallery' => [
                    'https://images.unsplash.com/photo-1532712938310-34cb3982ef74?q=80&w=600',
                    'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?q=80&w=600',
                    'https://images.unsplash.com/photo-1519225495810-7517c319b53b?q=80&w=600',
                ],
                'story' => [
                    [
                        'date' => 'Juni 2023',
                        'title' => 'Pertemuan di Dunia Kerja',
                        'description' => 'Kami bekerja di satu perusahaan kreatif agensi. Berawal dari rekan kerja satu tim hingga menjadi belahan jiwa.',
                    ]
                ],
                'gift_accounts' => [
                    [
                        'bank' => 'Bank Mandiri',
                        'number' => '888777666555',
                        'owner' => 'Ray Dimas',
                    ],
                    [
                        'bank' => 'GoPay',
                        'number' => '082211223344',
                        'owner' => 'Zara Amelia',
                    ]
                ]
            ]
        );

        Guest::firstOrCreate(
            ['invitation_id' => $invitationMinimalist->id, 'name' => 'Faisal Reza'],
            [
                'is_present' => true,
                'guest_count' => 2,
                'wish' => 'Congratulations Zara and Ray! Wishing you a lifetime of love, laughter, and endless adventure. Cheers!',
            ]
        );
    }
}
