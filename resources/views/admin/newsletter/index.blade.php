@extends('layouts.admin')
@section('title', __('admin.newsletter.title'))

@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">{{ __('admin.newsletter.title') }}</h1>
        <p class="text-sm text-gray-500 mt-1">{{ __('admin.newsletter.subtitle') }}</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('admin.newsletter.broadcast') }}" class="inline-flex items-center gap-2 bg-miruku-blue text-white font-bold px-4 py-2.5 rounded-xl hover:bg-miruku-dark transition-all shadow-lg shadow-miruku-blue/20 text-sm">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
            </svg>
            {{ __('admin.newsletter.send_broadcast') }}
        </a>
@if(request()->has('trashed'))
            <a href="{{ route('admin.newsletter.index') }}" class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 font-medium px-4 py-2.5 rounded-xl hover:bg-gray-200 transition-colors text-sm">
                {{ __('admin.newsletter.show_active') }}
            </a>
@else
            <a href="{{ route('admin.newsletter.index', ['trashed' => 1]) }}" class="inline-flex items-center gap-2 bg-red-50 text-red-700 font-medium px-4 py-2.5 rounded-xl hover:bg-red-100 transition-colors text-sm">
                {{ __('admin.newsletter.show_trashed') }}
            </a>
@endif
    </div>
</div>

@if(session('success'))
<div class="mb-6 p-4 bg-green-50 border border-green-100 text-green-700 rounded-2xl flex items-center gap-3">
    <svg class="w-5 h-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="text-left px-5 py-3.5 font-semibold text-gray-600">{{ __('admin.newsletter.email_address') }}</th>
                <th class="text-left px-5 py-3.5 font-semibold text-gray-600">{{ __('admin.common.status') }}</th>
                <th class="text-left px-5 py-3.5 font-semibold text-gray-600">{{ __('admin.newsletter.joined_date') }}</th>
                @if(request()->has('trashed'))
                <th class="text-left px-5 py-3.5 font-semibold text-gray-600">{{ __('admin.newsletter.deleted_date') }}</th>
                @endif
                <th class="text-right px-5 py-3.5 font-semibold text-gray-600">{{ __('admin.common.actions') }}</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($subscribers as $subscriber)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-miruku-blue font-bold text-xs">
                            {{ strtoupper(substr($subscriber->email, 0, 1)) }}
                        </div>
                        <span class="font-medium text-gray-900">{{ $subscriber->email }}</span>
                    </div>
                </td>
                <td class="px-5 py-4">
                    @if($subscriber->trashed())
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700">
                            {{ __('admin.newsletter.trashed') }}
                        </span>
                    @elseif($subscriber->is_active)
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700">
                            {{ __('admin.common.active') }}
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                            {{ __('admin.common.inactive') }}
                        </span>
                    @endif
                </td>
                <td class="px-5 py-4 text-gray-600">{{ $subscriber->created_at->format('M d, Y H:i') }}</td>
                @if(request()->has('trashed'))
                <td class="px-5 py-4 text-gray-600">{{ $subscriber->deleted_at->format('M d, Y H:i') }}</td>
                @endif
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-2">
                        @if($subscriber->trashed())
                            <form action="{{ route('admin.newsletter.restore', $subscriber->id) }}" method="POST">
                                @csrf
                                <button class="text-xs text-blue-600 hover:text-blue-700 font-medium px-3 py-1.5 rounded-lg hover:bg-blue-50 transition-colors">{{ __('admin.newsletter.restore') }}</button>
                            </form>
                        @else
                            <form action="{{ route('admin.newsletter.destroy', $subscriber->id) }}" method="POST" onsubmit="return confirm('{{ __('admin.newsletter.confirm_remove') }}')">
                                @csrf @method('DELETE')
                                <button class="text-xs text-red-500 hover:text-red-600 font-medium px-3 py-1.5 rounded-lg hover:bg-red-50 transition-colors">{{ __('admin.newsletter.remove') }}</button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="{{ request()->has('trashed') ? 5 : 4 }}" class="text-center py-12 text-gray-400">
                    {{ __('admin.newsletter.no_subscribers') }}
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($subscribers->hasPages())
    <div class="px-5 py-4 border-t border-gray-100">
        {{ $subscribers->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection
