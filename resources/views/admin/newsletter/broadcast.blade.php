@extends('layouts.admin')

@section('title', __('admin.newsletter.broadcast_title'))

@section('admin-content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ __('admin.newsletter.broadcast_title') }}</h1>
            <p class="text-sm text-gray-500">{{ __('admin.newsletter.broadcast_subtitle') }}</p>
        </div>
        <a href="{{ route('admin.newsletter.index') }}" class="text-sm text-miruku-blue hover:underline flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            {{ __('admin.newsletter.back_to_list') }}
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.newsletter.send-broadcast') }}" method="POST" class="p-8">
            @csrf
            
            <div class="space-y-6">
                <!-- Subject -->
                <div>
                    <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('admin.newsletter.subject') }}</label>
                    <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                           placeholder="{{ __('admin.newsletter.subject_placeholder') }}"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-miruku-blue/20 focus:border-miruku-blue outline-none transition-all">
                </div>

                <!-- Body / Content -->
                <div>
                    <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('admin.newsletter.content') }}</label>
                    <textarea name="content" id="content" class="editor">{{ old('content') }}</textarea>
                    <p class="mt-2 text-xs text-gray-400 italic">
                        {{ __('admin.newsletter.content_tips') }}
                    </p>
                </div>

                <!-- Action Button -->
                <div class="pt-4 flex items-center justify-end gap-4">
                    <button type="button" @click="window.history.back()" class="px-6 py-3 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 transition-all">
                        {{ __('admin.common.cancel') }}
                    </button>
                    <button type="submit" class="bg-miruku-blue text-white px-8 py-3 rounded-xl text-sm font-bold shadow-lg shadow-miruku-blue/20 hover:bg-miruku-dark transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        {{ __('admin.newsletter.send_now') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Info Box -->
    <div class="mt-6 bg-blue-50 border border-blue-100 rounded-2xl p-6 flex gap-4">
        <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <h3 class="text-sm font-bold text-blue-900 mb-1">{{ __('admin.newsletter.info_title') }}</h3>
            <p class="text-xs text-blue-800 leading-relaxed opacity-80">
                {{ __('admin.newsletter.info_description', ['count' => \App\Models\NewsletterSubscriber::where('is_active', true)->count()]) }}
            </p>
        </div>
    </div>
</div>
@endsection
