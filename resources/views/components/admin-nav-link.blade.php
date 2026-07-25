@props(['href', 'active' => false, 'icon' => ''])
<a href="{{ $href }}"
   class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-bold {{ $active ? 'bg-indigo-50 text-indigo-700' : 'text-slate-500 hover:bg-slate-50' }}">
    <span class="w-5 text-center">{{ $icon }}</span>
    {{ $slot }}
</a>
