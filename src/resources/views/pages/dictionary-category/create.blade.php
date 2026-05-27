@extends('layout.app')

@section('content')
<main>

    @include('layout.includes.pages._breadcrump', ["title" => "Create Dictionary Category", "links" => [
    ["name" => "Home", "route" => "home"],
    ["name" => "Dictionary Category", "route" => "dictionary-category.index"],
    ["name" => "Create", "route" => "dictionary-category.create"]
    ]])

    <div class="container-fluid">
        <div class="grid grid-cols-1 gap-5">

            <div class="card">
                <div class="card-body">
                    <h6 class="card-title mb-4">Create Category</h6>

                    <form method="POST" action="{{ route('dictionary-category.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="grid lg:grid-cols-2 md:grid-cols-1 grid-cols-1 gap-x-5">
                            @include('layout.includes.ui.fields._input', ["label" => "Title", "name" => "title", "placeholder" => "Enter category title", "type" => "text", "required" => true, "value" => old('title')])

                            @include('layout.includes.ui.fields._input', ["label" => "Image", "name" => "image", "placeholder" => "Upload Image", "type" => "file", "required" => false, "accept" => "image/jpg,image/jpeg,image/png,image/webp"])
                        </div>

                        <div class="mt-6">
                            @include('layout.includes.ui._from_control_buttons')
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</main>
@endsection
