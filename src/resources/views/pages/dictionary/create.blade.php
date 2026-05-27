@extends('layout.app')

@section('content')
<main>

    @include('layout.includes.pages._breadcrump', ["title" => "Create Dictionary", "links" => [
    ["name" => "Home", "route" => "home"],
    ["name" => "Dictionary", "route" => "dictionary.index"],
    ["name" => "Create Dictionary", "route" => "dictionary.create"]
    ]])
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
    <div class="container-fluid">
        <div class="grid grid-cols-1 gap-5">

            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4">Create Dictionary</h6>

                    <form method="POST" action="{{ route('dictionary.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-x-5">

                            @include('layout.includes.ui.fields._input', ["label" => "Word", "name" => "word", "placeholder" => "Enter Word", "type" => "text", "required" => true, "value" => old('word')])

                            @include('layout.includes.ui.fields._input', ["label" => "Translate", "name" => "translation", "placeholder" => "Enter Translate", "type" => "text", "required" => true, "value" => old('translation')])

                            @include('layout.includes.ui.fields._input', ["label" => "Audio", "name" => "audios[]", "placeholder" => "Upload Audio", "type" => "file", "required" => true, "accept" => "audio/*", "multiple" => true])

                            @include('layout.includes.ui.fields._input', ["label" => "Image", "name" => "image", "placeholder" => "Upload Image", "type" => "file", "required" => false, "accept" => "image/jpg,image/jpeg,image/png,image/webp"])

                            @include('layout.includes.ui.fields._select', [
                                "label" => "Categories", 
                                "name" => "categories[]", 
                                "options" => $categories, 
                                "multiple" => true,
                                "selected" => old('categories')
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
