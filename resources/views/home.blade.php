@if ($profile->resume_file)
    <a href="{{ asset('storage/' . $profile->resume_file) }}"
       target="_blank"
       rel="noopener noreferrer"
       download
       aria-label="{{ app()->getLocale() === 'ar' ? 'تحميل السيرة الذاتية بصيغة PDF' : 'Download resume PDF' }}"
       class="inline-flex items-center gap-2 rounded-lg bg-slate-900 px-5 py-3 font-semibold text-white hover:bg-slate-700">
        <span aria-hidden="true">↓</span>
        <span>{{ app()->getLocale() === 'ar' ? 'تحميل السيرة الذاتية PDF' : 'Download Resume PDF' }}</span>
    </a>
@endif
