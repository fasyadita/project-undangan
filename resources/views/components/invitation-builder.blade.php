<?php
 
use Livewire\Component;
use App\Models\Theme;
use App\Models\Invitation;
use App\Models\User;
 
new class extends Component
{
    public $currentStep = 1;
    
    // Step 1: Mempelai
    public $slug = '';
    public $groom_name = '';
    public $groom_nickname = '';
    public $groom_father = '';
    public $groom_mother = '';
    public $groom_photo = '';
    public $bride_name = '';
    public $bride_nickname = '';
    public $bride_father = '';
    public $bride_mother = '';
    public $bride_photo = '';
    
    // Step 2: Acara & Musik
    public $event_date = '';
    public $event_time = '';
    public $event_location = '';
    public $event_address = '';
    public $event_map_url = '';
    public $music_url = '';
    
    // Step 3: Galeri, Kisah, Rekening (JSONs)
    public $gallery_input = '';
    public $story_input = [];
    public $gift_input = [];
    
    // Step 4: Tema
    public $theme_id = null;
    
    public $themes = [];
 
    public function mount()
    {
        $this->themes = Theme::all();
        if ($this->themes->isNotEmpty()) {
            $this->theme_id = $this->themes->first()->id;
        }
        
        $this->story_input = [['date' => '', 'title' => '', 'description' => '']];
        $this->gift_input = [['bank' => '', 'number' => '', 'owner' => '']];
    }
 
    public function addStory()
    {
        $this->story_input[] = ['date' => '', 'title' => '', 'description' => ''];
    }
 
    public function removeStory($index)
    {
        unset($this->story_input[$index]);
        $this->story_input = array_values($this->story_input);
    }
 
    public function addGift()
    {
        $this->gift_input[] = ['bank' => '', 'number' => '', 'owner' => ''];
    }
 
    public function removeGift($index)
    {
        unset($this->gift_input[$index]);
        $this->gift_input = array_values($this->gift_input);
    }
 
    public function nextStep()
    {
        if ($this->currentStep == 1) {
            $this->validate([
                'slug' => 'required|alpha_dash|unique:invitations,slug',
                'groom_name' => 'required|string|max:255',
                'bride_name' => 'required|string|max:255',
            ], [
                'slug.required' => 'URL undangan (slug) wajib diisi.',
                'slug.unique' => 'URL ini sudah digunakan, silakan pilih nama lain.',
                'slug.alpha_dash' => 'URL hanya boleh berisi huruf, angka, dan tanda hubung (-).',
                'groom_name.required' => 'Nama mempelai pria wajib diisi.',
                'bride_name.required' => 'Nama mempelai wanita wajib diisi.',
            ]);
        } elseif ($this->currentStep == 2) {
            $this->validate([
                'event_date' => 'required|date',
                'event_time' => 'required|string',
                'event_location' => 'required|string',
                'event_address' => 'required|string',
            ], [
                'event_date.required' => 'Tanggal acara wajib diisi.',
                'event_time.required' => 'Waktu acara wajib diisi.',
                'event_location.required' => 'Tempat acara wajib diisi.',
                'event_address.required' => 'Alamat lengkap acara wajib diisi.',
            ]);
        }
        
        $this->currentStep++;
    }
 
    public function prevStep()
    {
        $this->currentStep--;
    }
 
    public function saveInvitation()
    {
        $this->validate([
            'theme_id' => 'required|exists:themes,id',
        ]);
 
        $story = array_filter($this->story_input, function($item) {
            return !empty($item['title']) && !empty($item['description']);
        });
 
        $gifts = array_filter($this->gift_input, function($item) {
            return !empty($item['bank']) && !empty($item['number']);
        });
 
        $gallery = array_filter(array_map('trim', explode(',', $this->gallery_input)));
 
        // Mengambil test user pertama yang sudah dibuat via Seeder
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Fasya Dita',
                'email' => 'fasya@example.com',
                'password' => bcrypt('password123'),
            ]);
        }
 
        $invitation = Invitation::create([
            'user_id' => $user->id,
            'theme_id' => $this->theme_id,
            'slug' => $this->slug,
            'groom_name' => $this->groom_name,
            'groom_nickname' => $this->groom_nickname,
            'groom_father' => $this->groom_father,
            'groom_mother' => $this->groom_mother,
            'groom_photo' => $this->groom_photo ?: 'https://images.unsplash.com/photo-1621600411688-4be93cc685e5?auto=format&fit=crop&q=80&w=300',
            'bride_name' => $this->bride_name,
            'bride_nickname' => $this->bride_nickname,
            'bride_father' => $this->bride_father,
            'bride_mother' => $this->bride_mother,
            'bride_photo' => $this->bride_photo ?: 'https://images.unsplash.com/photo-1591555200653-0397758ea121?auto=format&fit=crop&q=80&w=300',
            'event_date' => $this->event_date,
            'event_time' => $this->event_time,
            'event_location' => $this->event_location,
            'event_address' => $this->event_address,
            'event_map_url' => $this->event_map_url,
            'music_url' => $this->music_url ?: 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3',
            'gallery' => $gallery,
            'story' => array_values($story),
            'gift_accounts' => array_values($gifts),
            'status' => 'active',
            'plan' => 'free',
        ]);
 
        session()->flash('message', 'Undangan pernikahan berhasil dibuat!');
        return redirect()->to('/' . $invitation->slug);
    }

    public function getPreviewStyleProperty()
    {
        $theme = collect($this->themes)->firstWhere('id', $this->theme_id);
        $slug = $theme ? $theme->slug : 'classic-emerald';
        
        $styles = [
            'classic-emerald' => [
                'bg' => '#faf6ee',
                'primary' => '#3e5643',
                'secondary' => '#d98a6c',
                'text' => '#27382b',
                'border' => 'rgba(217, 138, 108, 0.3)',
                'cover_bg' => '#3e5643',
                'cover_text' => '#faf6ee',
                'date_bg' => 'rgba(39, 56, 43, 0.6)',
            ],
            'rustic-gold' => [
                'bg' => '#F9F3EB',
                'primary' => '#D4A373',
                'secondary' => '#6E473B',
                'text' => '#6E473B',
                'border' => 'rgba(212, 163, 115, 0.3)',
                'cover_bg' => '#D4A373',
                'cover_text' => '#F9F3EB',
                'date_bg' => 'rgba(110, 71, 59, 0.6)',
            ],
            'modern-minimalist' => [
                'bg' => '#FFFFFF',
                'primary' => '#111827',
                'secondary' => '#D5A094',
                'text' => '#111827',
                'border' => 'rgba(17, 24, 39, 0.2)',
                'cover_bg' => '#111827',
                'cover_text' => '#FFFFFF',
                'date_bg' => 'rgba(0, 0, 0, 0.6)',
            ],
            'elegant' => [
                'bg' => '#F8FAFC',
                'primary' => '#1E3A8A',
                'secondary' => '#94A3B8',
                'text' => '#0F172A',
                'border' => 'rgba(30, 58, 138, 0.3)',
                'cover_bg' => '#1E3A8A',
                'cover_text' => '#F8FAFC',
                'date_bg' => 'rgba(15, 23, 42, 0.6)',
            ],
            'invitation' => [
                'bg' => '#FAF5FF',
                'primary' => '#581C87',
                'secondary' => '#FBCFE8',
                'text' => '#3B0764',
                'border' => 'rgba(88, 28, 135, 0.3)',
                'cover_bg' => '#581C87',
                'cover_text' => '#FAF5FF',
                'date_bg' => 'rgba(59, 7, 100, 0.6)',
            ],
            'undangan' => [
                'bg' => '#F0FDF4',
                'primary' => '#065F46',
                'secondary' => '#FCE7F3',
                'text' => '#064E3B',
                'border' => 'rgba(6, 95, 70, 0.3)',
                'cover_bg' => '#065F46',
                'cover_text' => '#F0FDF4',
                'date_bg' => 'rgba(6, 78, 59, 0.6)',
            ],
            'rustic-floral' => [
                'bg' => '#FDF9F6',
                'primary' => '#A38570',
                'secondary' => '#A38570',
                'text' => '#4E342E',
                'border' => 'rgba(215, 196, 183, 0.3)',
                'cover_bg' => '#FDF9F6',
                'cover_text' => '#4E342E',
                'date_bg' => 'rgba(215, 196, 183, 0.6)',
            ],
        ];

        return $styles[$slug] ?? $styles['classic-emerald'];
    }

    public function getThemePreviewImage($slug)
    {
        $images = [
            'classic-emerald' => 'https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&q=80&w=400',
            'rustic-gold' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&q=80&w=400',
            'modern-minimalist' => 'https://images.unsplash.com/photo-1520854221256-17451cc331bf?auto=format&fit=crop&q=80&w=400',
            'elegant' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&fit=crop&q=80&w=400',
            'invitation' => 'https://images.unsplash.com/photo-1505909182942-e2f09aee3e89?auto=format&fit=crop&q=80&w=400',
            'undangan' => 'https://images.unsplash.com/photo-1469371670807-013ccf25f16a?auto=format&fit=crop&q=80&w=400',
            'rustic-floral' => 'https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?auto=format&fit=crop&q=80&w=400',
        ];

        return $images[$slug] ?? $images['classic-emerald'];
    }
};
?>
 
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

    <!-- LEFT COLUMN: WIZARD FORM BUILDER (Col span 7/8) -->
    <div class="lg:col-span-7 xl:col-span-8 p-6 md:p-8 bg-white border border-[#d98a6c]/15 rounded-3xl shadow-xl space-y-6">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-serif-luxury font-extrabold text-[#27382b]">
                Pembuat Undangan Digital
            </h2>
            <p class="text-slate-500 text-sm mt-1">Lengkapi form 4-langkah di bawah untuk meluncurkan undangan premium Anda</p>
            <div class="w-12 h-[2px] bg-[#d98a6c] mx-auto mt-4"></div>
        </div>
 
        <!-- Stepper Progress -->
        <div class="mb-8">
            <div class="flex items-center justify-between relative max-w-xl mx-auto">
                <!-- Line Behind -->
                <div class="absolute left-0 right-0 top-1/2 h-1 bg-[#edf2ec] -translate-y-1/2 rounded-full z-0"></div>
                <div class="absolute left-0 top-1/2 h-1 bg-[#3e5643] -translate-y-1/2 rounded-full transition-all duration-300 z-0" style="width: {{ (($currentStep - 1) / 3) * 100 }}%"></div>
 
                <!-- Step 1 -->
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full flex items-center justify-between text-sm font-bold transition-all duration-300 {{ $currentStep >= 1 ? 'bg-[#3e5643] text-white shadow-lg shadow-emerald-200' : 'bg-white text-slate-400 border border-slate-200' }}">
                        <span class="mx-auto">1</span>
                    </div>
                    <span class="text-xs font-semibold mt-2 {{ $currentStep >= 1 ? 'text-[#3e5643]' : 'text-slate-400' }}">Mempelai</span>
                </div>
 
                <!-- Step 2 -->
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full flex items-center justify-between text-sm font-bold transition-all duration-300 {{ $currentStep >= 2 ? 'bg-[#3e5643] text-white shadow-lg shadow-emerald-200' : 'bg-white text-slate-400 border border-slate-200' }}">
                        <span class="mx-auto">2</span>
                    </div>
                    <span class="text-xs font-semibold mt-2 {{ $currentStep >= 2 ? 'text-[#3e5643]' : 'text-slate-400' }}">Acara</span>
                </div>
 
                <!-- Step 3 -->
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full flex items-center justify-between text-sm font-bold transition-all duration-300 {{ $currentStep >= 3 ? 'bg-[#3e5643] text-white shadow-lg shadow-emerald-200' : 'bg-white text-slate-400 border border-slate-200' }}">
                        <span class="mx-auto">3</span>
                    </div>
                    <span class="text-xs font-semibold mt-2 {{ $currentStep >= 3 ? 'text-[#3e5643]' : 'text-slate-400' }}">Fitur</span>
                </div>
 
                <!-- Step 4 -->
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full flex items-center justify-between text-sm font-bold transition-all duration-300 {{ $currentStep >= 4 ? 'bg-[#3e5643] text-white shadow-lg shadow-emerald-200' : 'bg-white text-slate-400 border border-slate-200' }}">
                        <span class="mx-auto">4</span>
                    </div>
                    <span class="text-xs font-semibold mt-2 {{ $currentStep >= 4 ? 'text-[#3e5643]' : 'text-slate-400' }}">Tema</span>
                </div>
            </div>
        </div>
 
        <!-- Forms Content -->
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm min-h-[300px]">
            @if ($currentStep === 1)
                <!-- STEP 1: MEMPELAI -->
                <div class="space-y-6">
                    <h3 class="text-lg font-bold text-[#27382b] border-b pb-2 flex items-center gap-2">
                        <span class="w-2 h-6 bg-[#3e5643] rounded-full inline-block"></span>
                        Informasi Domain & Mempelai
                    </h3>
 
                    <!-- Slug / Link URL -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Link URL Undangan *</label>
                        <div class="flex rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                            <span class="inline-flex items-center px-4 bg-slate-50 border-r border-slate-200 text-slate-500 text-sm font-medium">
                                project-undangan.test/
                            </span>
                            <input type="text" wire:model.blur="slug" placeholder="budi-ani" 
                                   class="flex-1 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#d98a6c] text-slate-700">
                        </div>
                        @error('slug') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        <span class="text-xs text-slate-400 mt-1 block">Contoh: budi-dan-ani. Ini akan menjadi link akses undangan Anda.</span>
                    </div>
 
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4">
                        <!-- Mempelai Pria -->
                        <div class="p-4 bg-[#3e5643]/5 rounded-2xl border border-[#3e5643]/10 space-y-4">
                            <h4 class="font-bold text-[#3e5643] border-b border-[#3e5643]/10 pb-2">🤵 Mempelai Pria</h4>
                            
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-1">Nama Lengkap Pria *</label>
                                <input type="text" wire:model.live="groom_name" placeholder="Budi Santoso, S.Kom" 
                                       class="w-full px-4 py-2 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#d98a6c] bg-white">
                                @error('groom_name') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>
 
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-1">Nama Panggilan Pria</label>
                                <input type="text" wire:model.live="groom_nickname" placeholder="Budi" 
                                       class="w-full px-4 py-2 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#d98a6c] bg-white">
                            </div>
 
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <label class="block text-xs font-bold text-slate-600 mb-1">Ayah</label>
                                    <input type="text" wire:model.live="groom_father" placeholder="Ayah Budi" 
                                           class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#d98a6c] bg-white">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-600 mb-1">Ibu</label>
                                    <input type="text" wire:model.live="groom_mother" placeholder="Ibu Budi" 
                                           class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#d98a6c] bg-white">
                                </div>
                            </div>
 
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-1">Foto Mempelai Pria (URL)</label>
                                <input type="text" wire:model.live="groom_photo" placeholder="https://unsplash.com/... (atau kosong)" 
                                       class="w-full px-4 py-2 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#d98a6c] bg-white text-xs">
                            </div>
                        </div>
 
                        <!-- Mempelai Wanita -->
                        <div class="p-4 bg-[#d98a6c]/5 rounded-2xl border border-[#d98a6c]/10 space-y-4">
                            <h4 class="font-bold text-[#d98a6c] border-b border-[#d98a6c]/10 pb-2">👰 Mempelai Wanita</h4>
                            
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-1">Nama Lengkap Wanita *</label>
                                <input type="text" wire:model.live="bride_name" placeholder="Ani Rahmawati, S.E" 
                                       class="w-full px-4 py-2 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#d98a6c] bg-white">
                                @error('bride_name') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>
 
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-1">Nama Panggilan Wanita</label>
                                <input type="text" wire:model.live="bride_nickname" placeholder="Ani" 
                                       class="w-full px-4 py-2 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#d98a6c] bg-white">
                            </div>
 
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <label class="block text-xs font-bold text-slate-600 mb-1">Ayah</label>
                                    <input type="text" wire:model.live="bride_father" placeholder="Ayah Ani" 
                                           class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#d98a6c] bg-white">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-600 mb-1">Ibu</label>
                                    <input type="text" wire:model.live="bride_mother" placeholder="Ibu Ani" 
                                           class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#d98a6c] bg-white">
                                </div>
                            </div>
 
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-1">Foto Mempelai Wanita (URL)</label>
                                <input type="text" wire:model.live="bride_photo" placeholder="https://unsplash.com/... (atau kosong)" 
                                       class="w-full px-4 py-2 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#d98a6c] bg-white text-xs">
                            </div>
                        </div>
                    </div>
                </div>
            @endif
 
            @if ($currentStep === 2)
                <!-- STEP 2: ACARA -->
                <div class="space-y-6">
                    <h3 class="text-lg font-bold text-[#27382b] border-b pb-2 flex items-center gap-2">
                        <span class="w-2 h-6 bg-[#3e5643] rounded-full inline-block"></span>
                        Waktu & Tempat Acara Pernikahan
                    </h3>
 
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Tanggal Pernikahan *</label>
                            <input type="date" wire:model.live="event_date" 
                                   class="w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#d98a6c] text-slate-700 bg-white">
                            @error('event_date') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
 
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Waktu Pernikahan (Jam) *</label>
                            <input type="text" wire:model.live="event_time" placeholder="09:00 WIB - Selesai" 
                                   class="w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#d98a6c] text-slate-700 bg-white">
                            @error('event_time') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
 
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Tempat/Gedung *</label>
                        <input type="text" wire:model.live="event_location" placeholder="Balai Kartini / Masjid Agung Surabaya" 
                               class="w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#d98a6c] text-slate-700 bg-white">
                        @error('event_location') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
 
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Alamat Lengkap Tempat *</label>
                        <textarea wire:model.live="event_address" rows="3" placeholder="Jl. Gatot Subroto No.Kav. 37, Kuningan Timur, Jakarta Selatan" 
                                  class="w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#d98a6c] text-slate-700 bg-white"></textarea>
                        @error('event_address') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
 
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Google Maps Embed/Share URL</label>
                            <input type="text" wire:model.live="event_map_url" placeholder="https://maps.app.goo.gl/..." 
                                   class="w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#d98a6c] text-slate-700 bg-white">
                            <span class="text-xs text-slate-400 mt-1 block">Link share lokasi dari Google Maps.</span>
                        </div>
 
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Background Music URL (MP3)</label>
                            <input type="text" wire:model.live="music_url" placeholder="https://example.com/song.mp3 (atau kosong)" 
                                   class="w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#d98a6c] text-slate-700 bg-white">
                            <span class="text-xs text-slate-400 mt-1 block">Kosongkan untuk menggunakan musik instrumental default.</span>
                        </div>
                    </div>
                </div>
            @endif
 
            @if ($currentStep === 3)
                <!-- STEP 3: FITUR PREMIUM -->
                <div class="space-y-6">
                    <h3 class="text-lg font-bold text-[#27382b] border-b pb-2 flex items-center gap-2">
                        <span class="w-2 h-6 bg-[#3e5643] rounded-full inline-block"></span>
                        Fitur Tambahan (Galeri, Cerita, & Amplop Digital)
                    </h3>
 
                    <!-- Galeri Foto -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-slate-700">Galeri Foto Prewedding (URL terpisah tanda koma)</label>
                        <textarea wire:model.live="gallery_input" rows="2" placeholder="https://images.unsplash.com/photo-1, https://images.unsplash.com/photo-2" 
                                  class="w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#d98a6c] text-slate-700 text-sm bg-white"></textarea>
                        <span class="text-xs text-slate-400">Masukkan URL foto prewedding dipisahkan koma (`,`).</span>
                    </div>
 
                    <!-- Kisah Cinta (Dynamic List) -->
                    <div class="space-y-4 pt-4 border-t">
                        <div class="flex items-center justify-between">
                            <h4 class="font-bold text-[#27382b] text-sm">📅 Perjalanan Kisah Cinta (Timeline)</h4>
                            <button type="button" wire:click="addStory" class="px-3 py-1 bg-[#3e5643]/10 text-[#3e5643] hover:bg-[#3e5643]/20 rounded-lg text-xs font-bold transition">
                                + Tambah Cerita
                            </button>
                        </div>
 
                        <div class="space-y-3">
                            @foreach ($story_input as $index => $item)
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100 relative">
                                    <div class="md:col-span-3">
                                        <input type="text" wire:model.live="story_input.{{ $index }}.date" placeholder="Tahun / Tanggal" 
                                               class="w-full px-3 py-1.5 border border-slate-200 rounded-lg text-xs bg-white">
                                    </div>
                                    <div class="md:col-span-3">
                                        <input type="text" wire:model.live="story_input.{{ $index }}.title" placeholder="Judul (e.g. Pertama Ketemu)" 
                                               class="w-full px-3 py-1.5 border border-slate-200 rounded-lg text-xs font-bold bg-white">
                                    </div>
                                    <div class="md:col-span-5">
                                        <input type="text" wire:model.live="story_input.{{ $index }}.description" placeholder="Ceritakan singkat..." 
                                               class="w-full px-3 py-1.5 border border-slate-200 rounded-lg text-xs bg-white">
                                    </div>
                                    <div class="md:col-span-1 flex items-center justify-center">
                                        <button type="button" wire:click="removeStory({{ $index }})" class="p-1 text-slate-400 hover:text-rose-500">
                                            ❌
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
 
                    <!-- Rekening Amplop Digital (Dynamic List) -->
                    <div class="space-y-4 pt-4 border-t">
                        <div class="flex items-center justify-between">
                            <h4 class="font-bold text-[#27382b] text-sm">💳 Bank / E-Wallet untuk Amplop Digital</h4>
                            <button type="button" wire:click="addGift" class="px-3 py-1 bg-[#d98a6c]/10 text-[#d98a6c] hover:bg-[#d98a6c]/20 rounded-lg text-xs font-bold transition">
                                + Tambah Rekening
                            </button>
                        </div>
 
                        <div class="space-y-3">
                            @foreach ($gift_input as $index => $item)
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100 relative">
                                    <div class="md:col-span-3">
                                        <input type="text" wire:model.live="gift_input.{{ $index }}.bank" placeholder="BCA / Mandiri" 
                                               class="w-full px-3 py-1.5 border border-slate-200 rounded-lg text-xs bg-white">
                                    </div>
                                    <div class="md:col-span-4">
                                        <input type="text" wire:model.live="gift_input.{{ $index }}.number" placeholder="Nomor Rekening/HP" 
                                               class="w-full px-3 py-1.5 border border-slate-200 rounded-lg text-xs bg-white">
                                    </div>
                                    <div class="md:col-span-4">
                                        <input type="text" wire:model.live="gift_input.{{ $index }}.owner" placeholder="Nama Pemilik" 
                                               class="w-full px-3 py-1.5 border border-slate-200 rounded-lg text-xs bg-white font-semibold">
                                    </div>
                                    <div class="md:col-span-1 flex items-center justify-center">
                                        <button type="button" wire:click="removeGift({{ $index }})" class="p-1 text-slate-400 hover:text-rose-500">
                                            ❌
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
 
            @if ($currentStep === 4)
                <!-- STEP 4: PILIH TEMA & SIMPAN -->
                <div class="space-y-6">
                    <h3 class="text-lg font-bold text-[#27382b] border-b pb-2 flex items-center gap-2">
                        <span class="w-2 h-6 bg-[#3e5643] rounded-full inline-block"></span>
                        Pilih Desain Tema Undangan
                    </h3>
 
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($themes as $theme)
                            <div wire:click="$set('theme_id', {{ $theme->id }})" 
                                 class="group cursor-pointer overflow-hidden rounded-2xl border-2 transition-all duration-300 relative {{ $theme_id == $theme->id ? 'border-[#3e5643] shadow-lg shadow-emerald-100 ring-2 ring-[#3e5643]/30' : 'border-slate-100 hover:border-slate-300' }}">
                                
                                <!-- Premium badge -->
                                @if ($theme->is_premium)
                                    <span class="absolute top-2 right-2 z-10 bg-[#d98a6c] text-white text-[10px] px-2 py-0.5 rounded-full font-bold shadow-md">
                                        PREMIUM
                                    </span>
                                @else
                                    <span class="absolute top-2 right-2 z-10 bg-[#3e5643] text-white text-[10px] px-2 py-0.5 rounded-full font-bold shadow-md">
                                        FREE
                                    </span>
                                @endif
 
                                <!-- Preview Mockup -->
                                <div class="h-44 bg-slate-100 flex items-center justify-center overflow-hidden relative">
                                    <div class="absolute inset-0 bg-cover bg-center transition duration-300 group-hover:scale-105" 
                                         style="background-image: url('{{ $this->getThemePreviewImage($theme->slug) }}')">
                                    </div>
                                    <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition duration-300"></div>
                                </div>
 
                                <!-- Details -->
                                <div class="p-3 bg-white border-t border-slate-100">
                                    <h4 class="font-bold text-slate-800 text-sm group-hover:text-[#3e5643] transition">{{ $theme->name }}</h4>
                                    <p class="text-[11px] text-slate-400 capitalize mt-1">{{ $theme->is_premium ? 'Paket Premium' : 'Paket Gratis' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('theme_id') <span class="text-xs text-rose-500 block text-center mt-2">{{ $message }}</span> @enderror
                </div>
            @endif
        </div>
 
        <!-- Navigation Buttons -->
        <div class="mt-8 flex justify-between">
            @if ($currentStep > 1)
                <button type="button" wire:click="prevStep" 
                        class="px-6 py-2.5 font-bold text-slate-600 hover:bg-[#faf6ee] border border-slate-200 rounded-xl transition">
                    Kembali
                </button>
            @else
                <div></div> <!-- empty placeholder for layout -->
            @endif
 
            @if ($currentStep < 4)
                <button type="button" wire:click="nextStep" 
                        class="px-8 py-2.5 font-bold text-white bg-[#d98a6c] hover:bg-[#c67657] shadow-md shadow-orange-100 rounded-xl transition hover:scale-102 duration-300">
                    Lanjut
                </button>
            @else
                <button type="button" wire:click="saveInvitation" 
                        class="px-8 py-2.5 font-bold text-white bg-[#3e5643] hover:bg-[#27382b] shadow-md shadow-emerald-100 rounded-xl transition hover:scale-102 duration-300">
                    Simpan & Aktifkan!
                </button>
            @endif
        </div>
    </div>

    <!-- RIGHT COLUMN: MOBILE PHONE MOCK PREVIEW (Col span 5/4) -->
    <div class="lg:col-span-5 xl:col-span-4 hidden lg:block sticky top-24">
        <div class="bg-white border border-[#d98a6c]/15 rounded-3xl p-4 shadow-xl text-center space-y-4">
            
            <div class="flex items-center justify-between border-b pb-2">
                <span class="text-xs font-bold text-[#3e5643] tracking-widest uppercase">📱 Live Mobile Preview</span>
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-ping"></span>
            </div>

            <!-- SMARTPHONE MOCK FRAME -->
            <div class="relative w-[280px] h-[550px] mx-auto border-[10px] border-slate-900 rounded-[40px] shadow-2xl overflow-hidden bg-[#faf6ee]">
                
                <!-- Notch Speaker -->
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-28 h-4 bg-slate-900 rounded-b-2xl z-50"></div>
                <!-- Home Bar Indicator -->
                <div class="absolute bottom-1.5 left-1/2 -translate-x-1/2 w-20 h-1 bg-slate-400 rounded-full z-50"></div>

                <!-- PHONE SCREEN VIEWPORT -->
                <div class="h-full overflow-y-auto scrollbar-none pb-8 text-center text-xs relative select-none pointer-events-none transition-colors duration-500" style="background-color: {{ $this->previewStyle['bg'] }};">
                    
                    <!-- Cover Section Mock -->
                    <div class="h-[280px] text-white flex flex-col items-center justify-center p-4 relative overflow-hidden transition-colors duration-500" style="background-color: {{ $this->previewStyle['cover_bg'] }}; color: {{ $this->previewStyle['cover_text'] }};">
                        <div class="absolute inset-2 border rounded-xl pointer-events-none transition-colors duration-500" style="border-color: {{ $this->previewStyle['border'] }};"></div>
                        <span class="text-[8px] uppercase tracking-widest font-semibold mb-1 opacity-70">Wedding Invitation</span>
                        
                        <h4 class="text-xl font-serif-luxury leading-tight mt-1">
                            {{ $groom_nickname ?: 'Pria' }} & {{ $bride_nickname ?: 'Wanita' }}
                        </h4>
                        
                        <span class="inline-block mt-3 px-3 py-1 border rounded-full text-[8px] transition-colors duration-500" style="background-color: {{ $this->previewStyle['date_bg'] }}; border-color: {{ $this->previewStyle['border'] }};">
                            {{ $event_date ? \Carbon\Carbon::parse($event_date)->translatedFormat('d F Y') : '18 Mei 2026' }}
                        </span>
                        
                        <div class="mt-4 px-4 py-1.5 text-white text-[9px] font-bold rounded-full shadow transition-colors duration-500" style="background-color: {{ $this->previewStyle['secondary'] }};">
                            ✉️ Buka Undangan
                        </div>
                    </div>

                    <!-- Couple Profiles Mock -->
                    <div class="py-6 px-4 space-y-4">
                        <p class="font-serif-luxury italic text-[9px] transition-colors duration-500" style="color: {{ $this->previewStyle['primary'] }};">Assalamu’alaikum Wr. Wb.</p>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Groom -->
                            <div class="flex flex-col items-center space-y-1">
                                <div class="w-16 h-16 rounded-full overflow-hidden border bg-slate-200 transition-colors duration-500" style="border-color: {{ $this->previewStyle['secondary'] }};">
                                    <img src="{{ $groom_photo ?: 'https://images.unsplash.com/photo-1621600411688-4be93cc685e5?auto=format&fit=crop&q=80&w=150' }}" class="w-full h-full object-cover">
                                </div>
                                <span class="font-serif-luxury font-bold text-[10px] truncate max-w-full transition-colors duration-500" style="color: {{ $this->previewStyle['text'] }};">
                                    {{ $groom_name ?: 'Nama Lengkap Pria' }}
                                </span>
                                <span class="text-[8px] text-slate-400">Putra Ayah & Ibu</span>
                            </div>

                            <!-- Bride -->
                            <div class="flex flex-col items-center space-y-1">
                                <div class="w-16 h-16 rounded-full overflow-hidden border bg-slate-200 transition-colors duration-500" style="border-color: {{ $this->previewStyle['secondary'] }};">
                                    <img src="{{ $bride_photo ?: 'https://images.unsplash.com/photo-1591555200653-0397758ea121?auto=format&fit=crop&q=80&w=150' }}" class="w-full h-full object-cover">
                                </div>
                                <span class="font-serif-luxury font-bold text-[10px] truncate max-w-full transition-colors duration-500" style="color: {{ $this->previewStyle['text'] }};">
                                    {{ $bride_name ?: 'Nama Lengkap Wanita' }}
                                </span>
                                <span class="text-[8px] text-slate-400">Putri Ayah & Ibu</span>
                            </div>
                        </div>
                    </div>

                    <!-- Event Card Mock -->
                    <div class="py-4 px-4 space-y-3 transition-colors duration-500" style="background-color: {{ $this->previewStyle['primary'] }}; color: {{ $this->previewStyle['cover_text'] }};">
                        <h5 class="text-[9px] uppercase tracking-wider font-bold transition-colors duration-500" style="color: {{ $this->previewStyle['secondary'] }};">Detail Acara</h5>
                        <div class="p-3 rounded-xl border text-center space-y-1.5 shadow transition-colors duration-500" style="background-color: {{ $this->previewStyle['bg'] }}; color: {{ $this->previewStyle['text'] }}; border-color: {{ $this->previewStyle['border'] }};">
                            <span class="text-sm">🕌</span>
                            <p class="font-bold font-serif-luxury text-[10px] transition-colors duration-500" style="color: {{ $this->previewStyle['secondary'] }};">Akad & Resepsi</p>
                            <p class="text-[9px] font-bold">{{ $event_location ?: 'Nama Gedung / Tempat Pernikahan' }}</p>
                            <p class="text-[8px] text-slate-500 leading-normal">{{ $event_address ?: 'Alamat Lengkap Lokasi' }}</p>
                            <p class="text-[9px] font-semibold mt-1 transition-colors duration-500" style="color: {{ $this->previewStyle['text'] }};">{{ $event_time ?: '09:00 WIB - Selesai' }}</p>
                        </div>
                    </div>

                    <!-- Story Timeline Mock -->
                    @if (count(array_filter(array_column($story_input, 'title'))) > 0)
                        <div class="py-6 px-4 space-y-3 transition-colors duration-500" style="background-color: {{ $this->previewStyle['bg'] }};">
                            <h5 class="text-[9px] font-serif-luxury font-bold transition-colors duration-500" style="color: {{ $this->previewStyle['text'] }};">Kisah Perjalanan</h5>
                            <div class="space-y-3 border-l pl-3 text-left transition-colors duration-500" style="border-color: {{ $this->previewStyle['border'] }};">
                                @foreach($story_input as $story)
                                    @if(!empty($story['title']))
                                        <div class="relative">
                                            <span class="absolute -left-[16px] top-1 w-2.5 h-2.5 rounded-full border border-white transition-colors duration-500" style="background-color: {{ $this->previewStyle['secondary'] }};"></span>
                                            <span class="text-[8px] font-bold block transition-colors duration-500" style="color: {{ $this->previewStyle['secondary'] }};">{{ $story['date'] ?: 'Tanggal' }}</span>
                                            <p class="font-bold text-[9px] leading-tight transition-colors duration-500" style="color: {{ $this->previewStyle['text'] }};">{{ $story['title'] }}</p>
                                            <p class="text-[8px] text-slate-500 leading-normal mt-0.5">{{ $story['description'] }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Gift Cards Mock -->
                    @if (count(array_filter(array_column($gift_input, 'bank'))) > 0)
                        <div class="py-6 px-4 space-y-3 border-t transition-colors duration-500" style="background-color: {{ $this->previewStyle['bg'] }}; border-color: {{ $this->previewStyle['border'] }};">
                            <h5 class="text-[9px] font-serif-luxury font-bold transition-colors duration-500" style="color: {{ $this->previewStyle['text'] }};">Amplop Digital</h5>
                            <div class="space-y-2">
                                @foreach($gift_input as $gift)
                                    @if(!empty($gift['bank']))
                                        <div class="p-3 bg-white border rounded-xl relative shadow-sm text-left transition-colors duration-500" style="border-color: {{ $this->previewStyle['border'] }};">
                                            <span class="absolute top-1 right-2 text-[8px] font-extrabold uppercase transition-colors duration-500" style="color: {{ $this->previewStyle['secondary'] }};">{{ $gift['bank'] }}</span>
                                            <p class="text-[7px] text-slate-400 font-semibold mt-1">Nomor Rekening:</p>
                                            <p class="text-[10px] font-bold tracking-wider transition-colors duration-500" style="color: {{ $this->previewStyle['text'] }};">{{ $gift['number'] ?: 'xxxxxxxx' }}</p>
                                            <p class="text-[8px] text-slate-600 font-semibold">a.n. {{ $gift['owner'] ?: 'Pemilik Rekening' }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Footer Mock -->
                    <div class="py-4 text-[8px] transition-colors duration-500" style="background-color: {{ $this->previewStyle['primary'] }}; color: {{ $this->previewStyle['cover_text'] }}; opacity: 0.9;">
                        <p class="font-serif-luxury text-[9px] mb-1">
                            {{ $groom_nickname ?: 'Pria' }} & {{ $bride_nickname ?: 'Wanita' }}
                        </p>
                        <p>Powered by WeddingKita.com</p>
                    </div>

                </div>

            </div>
            
            <p class="text-[10px] text-slate-400">
                Visual mockup di atas akan berubah secara instan (*real-time*) setiap kali Anda mengedit formulir di sebelah kiri.
            </p>
        </div>
    </div>

</div>