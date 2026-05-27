@if(session("error"))
@php
$message = session("error");
@endphp
<div class="px-4 py-3 text-sm text-danger rounded-md bg-danger/10 flex justify-between border-t-2 border-danger mt-3 error-box">
    <div>
        {{ $message }}
    </div>

    <button
        type="button"
        onclick="this.closest('.error-box').remove()"
        class="inline-flex text-primary/20 hover:text-primary focus:outline-hidden">
        <span class="sr-only">Dismiss</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
        </svg>
    </button>
</div>
@endif
