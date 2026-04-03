@extends('layouts.admin')
@section('title', __('admin.posts.title'))

@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">{{ __('admin.posts.title') }}</h1>
        <p class="text-sm text-gray-500 mt-1">{{ __('admin.posts.subtitle') }}</p>
    </div>
    <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center gap-2 bg-miruku-blue text-white font-medium px-4 py-2.5 rounded-xl hover:bg-miruku-dark transition-colors text-sm">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        {{ __('admin.posts.add') }}
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="text-left px-5 py-3.5 font-semibold text-gray-600">{{ __('admin.posts.fields.title') }}</th>
                <th class="text-left px-5 py-3.5 font-semibold text-gray-600">{{ __('admin.posts.fields.published_at') }}</th>
                <th class="text-left px-5 py-3.5 font-semibold text-gray-600">{{ __('admin.posts.fields.views') }}</th>
                <th class="text-left px-5 py-3.5 font-semibold text-gray-600">{{ __('admin.common.status') }}</th>
                <th class="text-right px-5 py-3.5 font-semibold text-gray-600">{{ __('admin.common.actions') }}</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($posts as $post)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl overflow-hidden bg-gray-100 border border-gray-100 flex-shrink-0">
                            @if($post->image_url)
                            <img src="{{ $post->image_url }}" alt="" class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center text-xl bg-blue-50 text-miruku-blue opacity-50">📝</div>
                            @endif
                        </div>
                        <div class="max-w-xs xl:max-w-md truncate">
                            <div class="font-semibold text-gray-900 truncate">{{ $post->title }}</div>
                            <div class="text-xs text-gray-500 truncate">{{ $post->slug }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-5 py-4 text-gray-600">
                    {{ $post->published_at ? $post->published_at->format('d M Y H:i') : '-' }}
                </td>
                <td class="px-5 py-4 text-gray-600">
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        {{ number_format($post->view_count) }}
                    </div>
                </td>
                <td class="px-5 py-4">
                    @if($post->is_active)
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span> {{ __('admin.common.active') }}
                    </span>
                    @else
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> {{ __('admin.common.inactive') }}
                    </span>
                    @endif
                </td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.articles.edit', $post) }}" class="text-xs text-blue-600 hover:text-blue-700 font-medium px-3 py-1.5 rounded-lg hover:bg-blue-50 transition-colors">{{ __('admin.common.edit') }}</a>
                        <form action="{{ route('admin.articles.destroy', $post) }}" method="POST" onsubmit="return confirm('{{ __('admin.posts.delete_confirm') }}')">
                            @csrf @method('DELETE')
                            <button class="text-xs text-red-500 hover:text-red-600 font-medium px-3 py-1.5 rounded-lg hover:bg-red-50 transition-colors">{{ __('admin.common.delete') }}</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-12 text-gray-400">{{ __('admin.posts.empty') }}</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($posts->hasPages())
    <div class="px-5 py-4 border-t border-gray-100 text-xs">
        {{ $posts->links() }}
    </div>
    @endif
</div>
@endsection
