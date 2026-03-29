@extends('layouts.admin')
@section('title', 'Sections CMS')

@section('admin-content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Sections CMS</h1>
    <p class="text-sm text-gray-500 mt-1">Edit konten setiap section di homepage</p>
</div>

<div class="grid gap-4">
    @forelse($sections as $section)
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 flex items-center justify-between">
        <div>
            <span class="text-xs font-bold uppercase tracking-wider text-miruku-blue bg-blue-50 px-2.5 py-1 rounded-full">{{ $section->section_name }}</span>
            <h3 class="font-semibold text-gray-900 mt-2">{{ $section->title ?? '(No title)' }}</h3>
            <p class="text-sm text-gray-500 mt-1 truncate max-w-lg">{{ $section->subtitle }}</p>
        </div>
        <a href="{{ route('admin.sections.edit', $section) }}" class="flex-shrink-0 ml-4 text-sm text-blue-600 hover:text-blue-700 font-medium px-4 py-2 rounded-lg hover:bg-blue-50 transition-colors">Edit</a>
    </div>
    @empty
    <div class="text-center py-12 text-gray-400 bg-white rounded-2xl border border-gray-100">Tidak ada section.</div>
    @endforelse
</div>
@endsection
