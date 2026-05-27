@extends('layout.app')

@section('content')
<main>


    @include('layout.includes.pages._breadcrump', ["title" => "Edit Dictionary", "links" => [
    ["name" => "Home", "route" => "home"],
    ["name" => "Dictionary", "route" => "dictionary.index"],
    ["name" => "Edit Dictionary", "route" => "dictionary.edit", "params" => [$id]]
    ]])


    <div class="container-fluid">
        <div class="grid grid-cols-1 gap-5">

            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4">Edit Dictionary</h6>

                    <form method="POST" action="{{ route('dictionary.update', $id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-x-5">

                            @include('layout.includes.ui.fields._input', ["label" => "Word", "name" => "word", "placeholder" => "Enter Word", "type" => "text", "required" => true, "value" => old('word', $dictionary->word)])

                            @include('layout.includes.ui.fields._input', ["label" => "Translate", "name" => "translation", "placeholder" => "Enter Translate", "type" => "text", "required" => true, "value" => old('translation', $dictionary->translation)])

                            <div class="lg:col-span-3 mb-4">
                                <label class="inline-block mb-2 font-medium">Existing Audios</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @if($dictionary->audio_urls && count($dictionary->audio_urls))
                                        @foreach($dictionary->audio_urls as $audio)
                                            <div class="flex items-center gap-2 p-2 border border-default-200 rounded">
                                                <audio controls class="flex-grow">
                                                    <source src="{{ asset('storage/' . $audio) }}" type="audio/mpeg">
                                                </audio>
                                                <form action="{{ route('dictionary.audio.delete', $id) }}" method="POST" onsubmit="return confirm('Silmək istədiyinizə eminsiniz?')">
                                                    @csrf
                                                    <input type="hidden" name="audio_url" value="{{ $audio }}">
                                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M17 6h5v2h-2v13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V8H2V6h5V3a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1zm1 2H6v12h12zm-4.586 6l1.768 1.768l-1.414 1.414L12 15.414l-1.768 1.768l-1.414-1.414L10.586 14l-1.768-1.768l1.414-1.414L12 12.586l1.768-1.768l1.414 1.414zM9 4v2h6V4z" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-default-400">No audio files found.</p>
                                    @endif
                                </div>
                            </div>

                            @include('layout.includes.ui.fields._input', ["label" => "Add Audio", "name" => "audios[]", "placeholder" => "Upload Audio", "type" => "file", "required" => false, "accept" => "audio/*", "multiple" => true])

                            <div class="lg:col-span-3 mb-4">
                                <label class="inline-block mb-2 font-medium">Image</label>
                                @if($dictionary->image)
                                    <div class="flex items-center gap-4 mb-3">
                                        <img src="{{ asset('storage/' . $dictionary->image) }}"
                                             alt="Dictionary image"
                                             class="h-32 w-32 object-cover rounded-lg border border-default-200">
                                        <p class="text-sm text-default-400">Yeni şəkil yükləsəniz köhnəsi silinəcək.</p>
                                    </div>
                                @else
                                    <p class="text-default-400 text-sm mb-2">Şəkil yoxdur.</p>
                                @endif
                                <input type="file" name="image" accept="image/jpg,image/jpeg,image/png,image/webp"
                                       class="form-input">
                                @include('layout.includes.alerts._error', ['field' => 'image'])
                            </div>

                            @include('layout.includes.ui.fields._select', [
                                "label" => "Categories", 
                                "name" => "categories[]", 
                                "options" => $categories, 
                                "multiple" => true,
                                "selected" => old('categories', $dictionary->categories->pluck('id')->toArray())
                            ])

                            @include('layout.includes.ui._from_control_buttons')

                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

</main>
@endsection
