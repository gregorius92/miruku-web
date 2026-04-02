@extends('layouts.admin')
@section('title', 'Edit Section')

@section('admin-content')
<div class="w-full">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.sections.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Section: {{ $section->section_name }}</h1>
    </div>

    <form action="{{ route('admin.sections.update', $section) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
        @csrf @method('PUT')
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul (ID)</label>
                <input type="text" name="title" id="title_id" value="{{ old('title', $section->getRawOriginal('title')) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Judul (EN)
                </label>
                <input type="text" name="title_en" id="title_en" value="{{ old('title_en', $section->title_en) }}" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="Title in English">
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Subtitle (ID)</label>
                <input type="text" name="subtitle" id="subtitle_id" value="{{ old('subtitle', $section->getRawOriginal('subtitle')) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Subtitle (EN)
                </label>
                <input type="text" name="subtitle_en" id="subtitle_en" value="{{ old('subtitle_en', $section->subtitle_en) }}" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="Subtitle in English">
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            @if($section->section_name === 'cta')
            <div class="col-span-2 bg-blue-50/30 p-5 rounded-2xl border border-blue-100">
                <label class="block text-sm font-bold text-miruku-blue mb-2 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                    URL Video YouTube
                </label>
                <input type="text" name="content" value="{{ old('content', $section->getRawOriginal('content')) }}" 
                    class="w-full border border-blue-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue transition-all" 
                    placeholder="Contoh: https://www.youtube.com/watch?v=CH3rulpG7ac">
                <p class="text-[10px] text-gray-400 mt-2 italic">Masukkan link video YouTube yang ingin ditampilkan di section CTA.</p>
                <input type="hidden" name="content_en" value="{{ old('content_en', $section->content_en) }}">
            </div>
            @else
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Konten (ID)</label>
                <textarea name="content" rows="5" class="editor w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-y">{{ old('content', $section->getRawOriginal('content')) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Konten (EN)
                </label>
                <textarea name="content_en" rows="5" class="editor w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-y" placeholder="Content in English">{{ old('content_en', $section->content_en) }}</textarea>
            </div>
            @endif
        </div>
        @if($section->section_name === 'about')
        <div class="grid sm:grid-cols-3 gap-4 bg-blue-50/20 p-5 rounded-2xl border border-blue-100/50">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Display Rating ⭐</label>
                <input type="text" name="display_rating" value="{{ old('display_rating', $section->display_rating) }}" placeholder="Contoh: 4.9/5" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Total Ulasan (ID)</label>
                <input type="text" name="display_reviews" id="display_reviews_id" value="{{ old('display_reviews', $section->getRawOriginal('display_reviews')) }}" placeholder="Contoh: Dari 1000+ Ulasan" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Total Ulasan (EN)
                </label>
                <input type="text" name="display_reviews_en" id="display_reviews_en" value="{{ old('display_reviews_en', $section->display_reviews_en) }}" placeholder="Example: From 1000+ Reviews" class="w-full border border-blue-100 bg-blue-50/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gambar</label>
            @if($section->image_url) <div class="mb-2"><img src="{{ $section->image_url }}" class="h-20 rounded-lg border border-gray-200"></div> @endif
            <input type="file" name="image" accept="image/*" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm file:mr-3 file:text-xs file:font-medium file:bg-blue-50 file:text-miruku-blue file:border-0 file:rounded-lg file:px-3 file:py-1.5">
        </div>
        @endif
        <div class="flex items-center gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Urutan</label>
                <input type="number" name="order" value="{{ old('order', $section->order) }}" min="0" class="w-24 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div class="flex items-center gap-2 mt-5">
                <input type="checkbox" name="is_active" {{ old('is_active', $section->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-miruku-blue">
                <span class="ml-2 text-sm text-gray-600">Aktif</span>
            </div>
        </div>

        @if(in_array($section->section_name, ['about', 'benefits']))
        <div class="border-t border-gray-100 pt-8 mt-8" x-data="{ 
            features: {{ json_encode($section->features->map(function($f) { 
                return [
                    'id' => $f->id,
                    'icon' => $f->icon,
                    'title' => $f->getRawOriginal('title'),
                    'title_en' => $f->title_en,
                    'description' => $f->getRawOriginal('description'),
                    'description_en' => $f->description_en,
                ];
            })) }},
            icons: ['🥛', '✨', '💚', '🐄', '🌾', '🧀', '⭐', '🏆', '💎', '🥇', '🌿', '⚡', '🦾', '🧬', '🥗', '🧊', '🍃', '💧', '❄️'],
            addFeature() {
                this.features.push({ id: null, icon: '🥛', title: '', title_en: '', description: '', description_en: '' });
                this.$nextTick(() => {
                    const index = this.features.length - 1;
                    autoTranslate(`feat_t_id_${index}`, `feat_t_en_${index}`);
                    autoTranslate(`feat_d_id_${index}`, `feat_d_en_${index}`);
                });
            },
            removeFeature(index) {
                this.features.splice(index, 1);
            }
        }" x-init="$nextTick(() => { 
            features.forEach((_, i) => { 
                autoTranslate(`feat_t_id_${i}`, `feat_t_en_${i}`);
                autoTranslate(`feat_d_id_${i}`, `feat_d_en_${i}`);
            });
        })">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Daftar Keunggulan (Features)</h3>
                    <p class="text-sm text-gray-500">Kelola poin-poin keunggulan yang muncul di section About</p>
                </div>
                <button type="button" @click="addFeature()" class="inline-flex items-center gap-2 bg-blue-50 text-miruku-blue hover:bg-blue-100 font-semibold px-4 py-2 rounded-xl transition-colors text-sm">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Poin
                </button>
            </div>

            <div class="space-y-6">
                <template x-for="(feature, index) in features" :key="index">
                    <div class="bg-gray-50/50 rounded-2xl border border-gray-100 p-5 relative group/feat">
                        <input type="hidden" :name="`features[${index}][id]`" :value="feature.id">
                        
                        <div class="flex flex-col sm:flex-row gap-6">
                            <!-- Icon Picker -->
                            <div class="flex-shrink-0 w-20">
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Icon</label>
                                <div class="relative" x-data="{ open: false }">
                                    <button type="button" @click="open = !open" 
                                        class="w-14 h-14 bg-white border border-gray-200 rounded-2xl flex items-center justify-center text-2xl hover:border-miruku-blue hover:bg-blue-50/30 transition-all shadow-sm group/iconbtn"
                                        :class="open ? 'border-miruku-blue ring-4 ring-blue-50' : ''">
                                        <span x-text="feature.icon" class="transition-transform group-hover/iconbtn:scale-110"></span>
                                        <input type="hidden" :name="`features[${index}][icon]`" x-model="feature.icon">
                                    </button>

                                    <!-- Improved Dropdown -->
                                    <div x-show="open" 
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 translate-y-1"
                                        x-transition:enter-end="opacity-100 translate-y-0"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 translate-y-0"
                                        x-transition:leave-end="opacity-0 translate-y-1"
                                        @click.away="open = false" 
                                        class="absolute z-50 top-full mt-3 left-0 bg-white border border-gray-100 shadow-2xl rounded-2xl p-4 w-72"
                                        style="display: none;">
                                        
                                        <div class="grid grid-cols-5 gap-2.5">
                                            <template x-for="icon in icons">
                                                <button type="button" 
                                                    @click="feature.icon = icon; open = false" 
                                                    class="w-10 h-10 flex items-center justify-center text-xl rounded-xl transition-all hover:bg-blue-50 hover:scale-110" 
                                                    :class="feature.icon === icon ? 'bg-blue-100 text-miruku-blue ring-2 ring-miruku-blue/20' : 'text-gray-600'">
                                                    <span x-text="icon"></span>
                                                </button>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Content Inputs -->
                            <div class="flex-1 space-y-4">
                                <div class="grid sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Judul (ID)</label>
                                        <input type="text" :name="`features[${index}][title]`" :id="`feat_t_id_${index}`" x-model="feature.title" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-miruku-blue" placeholder="Nama Keunggulan">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-blue-400 uppercase tracking-wider mb-1.5">Judul (EN)</label>
                                        <input type="text" :name="`features[${index}][title_en]`" :id="`feat_t_en_${index}`" x-model="feature.title_en" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-miruku-blue" placeholder="Title in English">
                                    </div>
                                </div>
                                <div class="grid sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Deskripsi (ID)</label>
                                        <textarea :name="`features[${index}][description]`" :id="`feat_d_id_${index}`" x-model="feature.description" rows="2" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-miruku-blue resize-none" placeholder="Penjelasan singkat..."></textarea>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-blue-400 uppercase tracking-wider mb-1.5">Deskripsi (EN)</label>
                                        <textarea :name="`features[${index}][description_en]`" :id="`feat_d_en_${index}`" x-model="feature.description_en" rows="2" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-miruku-blue resize-none" placeholder="Description in English"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Remove Button -->
                        <button type="button" @click="removeFeature(index)" class="absolute -top-2 -right-2 w-8 h-8 bg-white border border-red-100 text-red-500 rounded-full shadow-sm flex items-center justify-center opacity-0 group-hover/feat:opacity-100 transition-all hover:bg-red-50">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </template>
            </div>
            
            <div x-show="features.length === 0" class="text-center py-12 border-2 border-dashed border-gray-100 rounded-2xl">
                <div class="text-4xl mb-2">💡</div>
                <p class="text-gray-400 text-sm">Belum ada poin keunggulan. Klik tombol "Tambah Poin" di atas.</p>
            </div>
        </div>
        @endif
        <div class="flex justify-end gap-3 border-t border-gray-100 pt-6">
            <a href="{{ route('admin.sections.index') }}" class="px-6 py-2.5 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors text-sm">Batal</a>
            <button type="submit" class="bg-miruku-blue hover:bg-miruku-dark text-white font-semibold px-6 py-2.5 rounded-xl transition-colors text-sm">Simpan</button>
        </div>
    </form>
</div>
<script>
    autoTranslate('title_id', 'title_en');
    autoTranslate('subtitle_id', 'subtitle_en');
    autoTranslate('display_reviews_id', 'display_reviews_en');
    autoTranslateSummernote('content', 'content_en');
</script>
@endsection
