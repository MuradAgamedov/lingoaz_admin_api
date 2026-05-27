@extends('layout.app')

@section('content')
<main>

    @include('layout.includes.pages._breadcrump', ["title" => "Dictionary", "links" => [
    ["name" => "Home", "route" => "home"],
    ["name" => "Dictionary", "route" => "dictionary.index"],
    ]])

    <div class="container-fluid">
        <div class="w-full">
            <div class="card w-full">
                <div class="card-body">

                    @include('layout.includes.pages._index_top', ["create" => "dictionary"])

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="text-left">
                                <tr>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">
                                        Dictionary ID
                                    </th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">
                                        Word
                                    </th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">
                                        Audio
                                    </th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">
                                        Translate
                                    </th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">
                                        Categories
                                    </th>   
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">
                                        User
                                    </th>
                                    <th class="px-3.5 py-2.5 font-semibold border-b border-default-200 dark:border-white/14">
                                        Action
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($dictionaries as $dictionary)
                                <tr>
                                    <td class="px-3.5 py-2.5 border-y border-default-200 dark:border-white/14">
                                        <a href="#!" class="text-primary">#{{ $dictionary->id }}</a>
                                    </td>

                                    <td class="px-3.5 py-2.5 border-y border-default-200 dark:border-white/14">
                                        {{ $dictionary->word }}
                                    </td>

                                    <td class="px-3.5 py-2.5 border-y border-default-200 dark:border-white/14">
                             
                                       @if($dictionary->audio_urls && count($dictionary->audio_urls))

                                            <div class="flex flex-col gap-2">

                                               @foreach($dictionary->audio_urls as $audio)

                                                    <audio controls class="w-full">
                                                        <source
                                                            src="{{ asset('storage/' . $audio) }}"
                                                            type="audio/mpeg"
                                                        >

                                                        Sizin brauzer audio elementini dəstəkləmir.
                                                    </audio>

                                                @endforeach

                                            </div>

                                        @else

                                            <span class="text-red-500">
                                                Audio yoxdur
                                            </span>

                                        @endif

                                    </td>

                                 <td class="px-3.5 py-2.5 border-y border-default-200 dark:border-white/14">

                                @if($dictionary->translation_json && count($dictionary->translation_json))

                                    <div class="flex flex-col gap-1">

                                        @foreach($dictionary->translation_json as $translation)

                                            <div class="text-xs break-words">
                                                - {{ $translation }}
                                            </div>

                                        @endforeach

                                    </div>

                                @else

                                    {{ $dictionary->translation }}

                                @endif

                            </td>

                                   
                                        
                                    <td class="px-3.5 py-2.5 border-y border-default-200 dark:border-white/14">
                                        <div class="flex flex-col gap-1">
                                            @foreach($dictionary->categories as $category)
                                                <span class="text-xs bg-primary/10 text-primary px-2 py-1 rounded">
                                                    {{ $category->title }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-3.5 py-2.5 border-y border-default-200 dark:border-white/14">
                                        {{ $dictionary?->user?->name }}
                                    </td>
                                    <td class="px-3.5 py-2.5 border-y border-default-200 dark:border-white/14">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('dictionary.meaning.index', $dictionary->id) }}" class="text-success hover:text-success-700" title="Add/View Meanings">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2z" />
                                                </svg>
                                            </a>

                                            @include('layout.includes.ui._edit_button', [
                                            'route' => 'dictionary.edit',
                                            'id' => $dictionary->id
                                            ])

                                            @include('layout.includes.ui._delete_button', [
                                            'route' => 'dictionary.destroy',
                                            'id' => $dictionary->id
                                            ])
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
 {{ $dictionaries->links('vendor.pagination.default') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
